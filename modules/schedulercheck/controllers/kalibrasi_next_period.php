<?php
/*-----------------------------------------------------Mysql Connection Start------------------------------------------------------*/
  $host = '10.1.49.8';
  $user = 'erp_scheduler';
  $pass = 'H?zdwDb[kU1z%}@)';
  $db='hrd';

  $conn = mysql_connect($host, $user, $pass);
  if ($conn) {
      mysql_select_db($db, $conn);
  } else {
     die('Error : '.mysql_error());
  }
  //include('koneksi.php');
/*------------------------------------------------------Mysql Connection End------------------------------------------------------*/
$scheduler_name="kalibrasi_next_period";

echo "-------------SCHEDULLER KALIBRASI NEXT PERIODE----------";

$itahun=date("Y");
$id_ms_periode=1;
$iperiodeold=0;
$sql="select * from kalibrasi.periode pe where pe.ldeleted=0 order by pe.iperiode_id DESC LIMIT 1";
$myquery=mysql_query($sql);
while ($dt=mysql_fetch_array($myquery)){
    $pems=$dt['id_ms_periode'];
    $iperiodeold=$dt['iperiode_id'];
    if($pems==4){
        $itahun=$dt['itahun']+1;
    }else{
        $itahun=$dt['itahun'];
        $id_ms_periode=$pems+1;
    }
}
if($iperiodeold>0){

    /*Insert Untuk kalibrasi Periode*/

    $sqlinsert="INSERT INTO kalibrasi.periode (itahun, id_ms_periode, tapp_jadwal, tapp_induk, dcreate, ccreate) VALUES ('".$itahun."', '".$id_ms_periode."', NULL, NULL, '".date('Y-m-d H:i:s')."', 'SYS')";
    $result = mysql_query($sqlinsert);
    if(!$result){
        echo $result;
        $isFinish = false;
        //schLogger($scheduler_name,$isFinish,mysql_error(),$result);
       die('Mysql Failed 4 - '.mysql_error());
    }else {
      $isFinish = true;
      //schLogger($scheduler_name,$isFinish,'done','Everything is OK');
      $iperiode_id=mysql_insert_id();
      echo 'Result-Insert '.$itahun.'-'.$id_ms_periode.' - periode id - '.$iperiode_id.' : '.$result.' ...<br>';
      $sqllog="select * from kalibrasi.logbook lo where lo.ldeleted=0 and lo.iperiode_id=".$iperiodeold;
      $myquerylog=mysql_query($sqllog);
      while ($dtdet=mysql_fetch_array($myquerylog)){
          $sqlinsertdet="INSERT INTO kalibrasi.logbook (iperiode_id, iMaster_asset_id, dcreate, ccreate) VALUES ('".$iperiode_id."', '".$dtdet['iMaster_asset_id']."', '".date('Y-m-d H:i:s')."', 'SYS')";
          $resultdet = mysql_query($sqlinsertdet);
          if(!$resultdet){
              echo $resultdet;
              $isFinish = false;
              //schLogger($scheduler_name,$isFinish,mysql_error(),$resultdet);
             die('Mysql Failed 4 - '.mysql_error());
          }else {
            $isFinish = true;
            //schLogger($scheduler_name,$isFinish,'done','Everything is OK');
            echo 'Result-Inserting '.$dtdet['iMaster_asset_id'].' - periode id - '.$iperiode_id.' : '.$resultdet.' ...<br>';

          }
      }
  }
}


function schLogger($sched,$res,$notes,$warning){
    /*Setting Table score*/
    $tbsch = 'plc2.scheduler_scored';

    $now = date('Y-m-d H:i:s');
    $cType = 'php';
    if($res===True){
       $iStatus = 1;
    }else{
       $iStatus = 0;
    }

    $sql ='INSERT INTO '.$tbsch.'(vScheduler_Name, cType,dDateRunning,iStatus,dCreate,vErrorLogs ) 
             VALUES("'. $sched .'",
                      "'. $cType .'",
                      "'. $now .'",
                      "'. $iStatus .'",
                      "'. $now .'",
                      "'. $notes .'"
                      )';

    if(!mysql_query($sql)){
       echo $sql;
       die('Mysql Failed 4 - '.mysql_error());
    }
       else {echo 'Logging ...<br>';
    }


 }


  function get_type($type='V'){
    switch ($type) {
       case 'C': //Varchar
       case 'c': //Varchar
          $re['jenis']='varchar';
          $re['fld']='(255)';
          break;
       case 'D': //Varchar
       case 'd': //Varchar
          $re['jenis']='date';
          $re['fld']='';
          break;
       case 'N': // Number
       case 'n': // Number
          $re['jenis']='float'; 
          break;
       case 'L': // Bit
       case 'l': // Bit
          $re['jenis']='int'; 
          $re['fld']='11';
          break;
       
       default:
          $re['jenis']='varchar';
          $re['fld']='(255)';
          break;
    }

    return $re;

  }
?>