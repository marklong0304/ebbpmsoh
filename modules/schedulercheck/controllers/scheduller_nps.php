<?php
$scheduler_name = "scheduller_nps";


//RIGELTAMA DATABASE DI GP
$host = '10.1.49.8';
$user = 'erp_scheduler';
$pass = 'H?zdwDb[kU1z%}@)';
$db='hrd'; 
$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
  die('Error : '.mysqli_error());
}


include('syslog_fwd_dev.php'); 
ini_set('max_execution_time', 0);

//Untuk VERIFIKASI; 

$cari = "CommandLine like '%ws_order02_nvl.bat%'"; 
$cmd ='wmic process where "'.$cari.'" get commandline';
exec($cmd, $output, $return_var);
if(count($output)>5){ 
   SendToSyslog('sch_'.$scheduler_name,'Scheduler sedang Running');
   die();
}else{
  SendToSyslog('sch_'.$scheduler_name,'Scheduler Running Start');
//Ambil dari database sn_detail RIGELTAMA yang sudah masuk di didalam BOX / sudah di VERIFIKASI
$sql = 'SELECT sn.iurut, sn.iheader_id, sn.v_code_full FROM rigeltama_database.sn_detail sn where sn.`status` = 2';
SendToSyslog('sch_'.$scheduler_name,'Scheduler Running get VERIFIKASI SQL '.$sql.'');

$result = mysqli_query($conn,$sql); 
while ($dt=mysqli_fetch_array($result)){
	//Create Query UPDATE untuk NPS
	$sendUpdataL = "UPDATE nps.sn_details s SET s.iVerifikasiFlag = 1 
						WHERE s.id = '".$dt['iurut']."' and s.iHeader_id='".$dt['iheader_id']."' and s.vCodeFull='".$dt['v_code_full']."'"; 
	//Send To Laravel WEB API
	$respons = runSQLUpdate($sendUpdataL,$scheduler_name);
    if($respons['code']==0){ //Jika Done UPDATE sn Detail RIGELTAMA JADI 3
        SendToSyslog('sch_'.$scheduler_name,'Scheduler Running UPDATE SQL NPS '.$sendUpdataL.'');

    	$sqlUpdateR = "UPDATE rigeltama_database.sn_detail s SET s.`status` = 3 WHERE s.iurut = '".$dt['iurut']."' AND s.iheader_id = '".$dt['iheader_id']."' AND s.v_code_full ='".$dt['v_code_full']."'";

        SendToSyslog('sch_'.$scheduler_name,'Scheduler Running UPDATE SQL RIGEL '.$sqlUpdateR.'');

    	mysqli_query($conn,$sqlUpdateR); 
    	echo $sqlUpdateR;
    } 
    echo $respons['message'];
    echo '<br>';
} 

//Untuk Master Box

//Ambil dari database sn_detail RIGELTAMA yang sudah masuk di didalam BOX / sudah di SELESAI
$sql = 'SELECT bh.iboxheader_id, bh.iheader_id, bh.sn, bh.std_qtyperbox, bh.actual_qty FROM rigeltama_database.box_header bh where bh.`status` = 3';

SendToSyslog('sch_'.$scheduler_name,'Scheduler Running get DONE MASTER BOX SQL '.$sql.'');

$result = mysqli_query($conn,$sql); 
while ($dt=mysqli_fetch_array($result)){ 
	//Create Query INSERT untuk NPS
	$sendInsertL = "INSERT INTO nps.`box_header` 
				(`ibox_header`, `iHeader_id`, `vserial_number`, `dCreate`,`std_qtyperbox`,`actual_qty`) VALUES 
				(".$dt['iboxheader_id'].", ".$dt['iheader_id'].", '".$dt['sn']."', 
				'".date('Y-m-d H:i:s')."' ,'".$dt['std_qtyperbox']."','".$dt['actual_qty']."')";   
	//Send To Laravel WEB API	
	$respons = runSQLInsert($sendInsertL,$scheduler_name); 
	echo $respons['message'];
    echo '<br>';
    if($respons['code']==0){ //Jika Done TARIK DETAILNYA
    	//Ambil Detail Query Nya Dari RIGELTAMA DATAVASE
        SendToSyslog('sch_'.$scheduler_name,'Scheduler Running get INSERT NPS HEADER SQL '.$sendInsertL.'');

    	$sqlGet = "SELECT bd.iboxheader_id, bd.iurut, bd.date_entry FROM rigeltama_database.box_detail bd where bd.iboxheader_id = '".$dt['iboxheader_id']."'";
        echo $sqlGet;
        echo $respons['message'];
    	$resGet = mysqli_query($conn,$sqlGet); 
    	while ($dtGet=mysqli_fetch_array($resGet)){ 
    		//Create QUERY INSERT Detail untuk NPS
    		$sendInsertLG="INSERT INTO nps.`box_detail` (`ibox_header`, `id_sndetail`, `dCreate` ) VALUES (".$dtGet['iboxheader_id'].", ".$dtGet['iurut'].", '".date('Y-m-d H:i:s')."')";
            echo $sendInsertLG;
    		$responsG = runSQLInsert($sendInsertLG,$scheduler_name);  

            SendToSyslog('sch_'.$scheduler_name,'Scheduler Running get INSERT NPS DETAIL SQL '.$sendInsertLG.'');

    		echo $responsG['message'];
    		echo '<br>';
    	}

    	//UBAH STATUS JADI HAPUS
    	$sqlUpdateR = "UPDATE rigeltama_database.box_header bh set bh.`status` = 4 WHERE bh.iboxheader_id ='".$dt['iboxheader_id']."' AND bh.iheader_id='".$dt['iheader_id']."' AND bh.sn='".$dt['sn']."' ";
    	mysqli_query($conn,$sqlUpdateR); 

        SendToSyslog('sch_'.$scheduler_name,'Scheduler Running get UPDATE RIGEL BOX DONE '.$sqlUpdateR.'');

    	echo $sqlUpdateR;
    } 
    
} 


 
?>


