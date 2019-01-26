<?php 
ini_set('max_execution_time', 0);
error_reporting(E_ALL);
ini_set('display_errors', '1');

  /*-----------------------------------------------------Mysql Connection Start------------------------------------------------------*/
    $host = '10.1.49.6';
    $user = 'erp_scheduler';
    $pass = 'H?zdwDb[kU1z%}@)';
    $db='hrd';

    $conn = mysql_connect($host, $user, $pass);
    if ($conn) {
        mysql_select_db($db, $conn);
        //echo "masok pak eko";
    } else {
       die('Error : '.mysql_error());
    }
    //include('koneksi2.php');
  /*------------------------------------------------------Mysql Connection End------------------------------------------------------*/
$sqlArea="select * from hrd.ss_trf_area a where a.iAktif = 1";
$result2 = mysql_query($sqlArea); 
if(!empty($result2)){
  while($datas = mysql_fetch_array($result2)) {
    $cKode_area = $datas['cKode_area'];
    $cPic = $datas['cPic'];

    $vNama_area = $datas['vNama_area'];
    echo 'Running Transfer '.$cKode_area.' -> '.$vNama_area;
     
         
    /*-----------------------------------------------------Mysql Connection Start------------------------------------------------------*/
      include('koneksi2.php');
    /*------------------------------------------------------Mysql Connection End------------------------------------------------------*/

         
    /*-----------------------------------------------------ODBC Connection Start-----------------------------------------------------*/
    $db='hrd';
    $dbfFile = realpath('G:/DATA/TRANSFER/'.$cKode_area.'/rcvinfo.dbf');
    $dbfDir = dirname($dbfFile);
    $dbfDir1 = 'G:/DATA/TRANSFER';
    $conn_db = odbc_connect('Driver={Microsoft Visual FoxPro Driver};SourceType=DBF;SourceDB='.$dbfDir1.';Exclusive=No;Collate=Machine;NULL=NO;DELETED=YES;BACKGROUNDFETCH=NO;' , '', '');
     if (!$conn_db)
     {
        exit('Connection Failed: ' . $conn_db);
     }else{
        //echo 'Connected';
        //exit;
     }  
    /*------------------------------------------------------ODBC Connection End------------------------------------------------------*/
         
    /*------------------------------------------------------Parameter Start------------------------------------------------------*/
        $selectCompany='3'; 
        $scheduler_name='rcvinfo';
        
        $BackdateI='300';
        $tgl2 = date('Ymd');
        $backback = strtotime('- '.$BackdateI.' days', strtotime($tgl2));
        $tgl1 = date('Ymd', $backback);

      /*number of days back from now */
        
        $last_update='d_recv';
        $tbsql='hrd.rcvinfo';
        $dbFile='rcvinfo';

        /*flag finish running*/
        $isFinish = false;


    /*------------------------------------------------------Parameter End------------------------------------------------------*/
         
                if($last_update<>'-'){
                  $sql = 'SELECT * From '.$dbFile.'  WHERE DTOS('.$dbFile.'.'.$last_update.') BETWEEN "'.$tgl1.'"  and "'.$tgl2.'" ';
                }else{
                  $sql='SELECT * FROM '.$dbFile.' ';
                }


                 
                 /*echo $sql;
                 exit;*/
             
                $rs=odbc_exec($conn_db,$sql);

                if (!$rs)
                 {
                    exit('ODBC Exec failed: ' . $sql);
                 }else{
                    //echo 'Success Query';
                    //exit;
                 }  


                 /*Get Field Name*/
                 $arrNmKolom = array();
                 
                 for($i=1; $i <= odbc_num_fields($rs); $i++){
                  /*push field name to array*/
                  array_push($arrNmKolom,odbc_field_name($rs, $i) );

                 }

                 /*--------Create Table if not exist -------*/
                    $create_table='CREATE TABLE IF NOT EXISTS  '.$tbsql.'   (
                    id int(11) NOT NULL AUTO_INCREMENT,';
                    foreach ($arrNmKolom as $iKol => $vKolom) {
                       
                         $kDKolom=substr($vKolom,0,1);
                         $KolomType=get_type($kDKolom);

                         $create_table.=$vKolom.' '.$KolomType['jenis'].' '.$KolomType['fld'].' DEFAULT NULL, ';   
                       
                    }

                    $create_table.='D_export datetime DEFAULT CURRENT_TIMESTAMP,
                                    iCompanyID int(11),
                                    dCreate datetime DEFAULT NULL,
                                    dUpdate datetime DEFAULT NULL,
                                    cCreate Varchar(10) DEFAULT NULL,
                                    cUpdate Varchar(10) DEFAULT NULL,
                                    lDeleted int(1) DEFAULT 0,
                             PRIMARY KEY (id)
                       ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;';

                    if(mysqli_query($conn,$create_table)){
                       /*lanjut*/
                    }else{
                       schLogger($scheduler_name,$isFinish,mysqli_error(),$create_table);
                       die('Mysql Failed 1 - '.mysqli_error());
                    }

                 /*--------Create Table if not exist -------*/ 
         
                   /*------------------------------------------------Alter Column IF Exist  ------------------------------------------------------*/
                  $setArray = array();
                  $setArrayAlter = array();
                  $sqlCekfield = 'SELECT c.COLUMN_NAME
                                    FROM information_schema.COLUMNS c WHERE 
                                    c.TABLE_SCHEMA = '.$db.'  AND c.TABLE_NAME= '.$dbFile.'';   
                   
                  $myquery=mysqli_query($conn,$sqlCekfield);
                  while ($dt=mysqli_fetch_array($myquery)){
                    array_push($setArray,$dt['COLUMN_NAME']);
                  } 
                  foreach ($arrNmKolom as $iKol2 => $vKolom2) {
                    if(!in_array($vKolom2,$setArray)){
                      array_push($setArrayAlter,$vKolom2);
                    }
                  }
                  if(!empty($setArrayAlter)){
                    foreach ($setArrayAlter as $key => $valueIns) {
                      $kDKolom=substr($valueIns,0,1);
                      $KolomType=get_type($kDKolom);    
                      $sqlAlter = 'ALTER TABLE '.$db.'.'.$dbFile.' ADD '.$valueIns.' '.$KolomType['jenis'].' '.$KolomType['fld'].' NULL'; 
                      mysqli_query($conn,$sqlAlter);  
                    }
                  }  
                /*------------------------------------------------Processing Data Start------------------------------------------------------*/
                 //print_r($arrNmKolom);
                
                 if (!$rs)
                 {
                    exit('Error in SQL');
                 }

                 // $html used to show data
                 $html  ='';
                 $html .= '<table>';
                 $html .= '<tr>';
                 for($i=1; $i <= odbc_num_fields($rs); $i++){
                    $html .= '<th>'.odbc_field_name($rs, $i).'</th>'; 
                 

                 }
                 $html .= '</tr>';

                 
                 $arriSi= array(); 
                while (odbc_fetch_row($rs))
                {

                    /*describe PK Column & get Value of PK*/
                    $pk=odbc_result($rs,'c_fname'); 
                              $fk_1=odbc_result($rs,'d_filedate');
                                      $fk_2=odbc_result($rs,'c_filetime');
                                      $fk_3=odbc_result($rs,'d_recv');
                                      $fk_4=odbc_result($rs,'c_recv');
                                      
                                      
                              $fPk='c_fname';
                              /*describe PK show when transfering*/
                              //$pkv= $pk;
                              $pkv=odbc_result($rs,'c_fname').' - '.odbc_result($rs,'c_fname');
                             
                              /*cek data existing in mysql table*/
                              /*param use here*/

                              $sqlUdah = 'select * from '.$tbsql.' a where a.iCompanyID= '.$selectCompany.'  
                                            AND a.'.$fPk.'= "'.$pk.'"  AND a.d_filedate="'.$fk_1.'" AND a.c_filetime="'.$fk_2.'"
                                            AND a.d_recv="'.$fk_3.'"
                                            AND a.c_recv="'.$fk_4.'"
                                            AND a.cKode_area="'.$cKode_area.'"

                                             '  ;

                    $rowUdah = mysqli_fetch_array(mysqli_query($conn,$sqlUdah));

                    if (!empty($rowUdah)) 
                    {
                      // updating record when exists
                      $sa = '';
                      echo 'Updating ... '.$cKode_area.'===>'.$pk;
                      $sa.='UPDATE '.$tbsql.' SET ';
                      $i=0;

                        foreach ($arrNmKolom as $fd => $vd) {
                            $isinya = str_replace("'", '', odbc_result($rs,$vd)); 
                            if(trim($isinya)<>''){
                              if(trim($isinya)=='1899-12-30'){
                                $isinya = 'NULL';
                              }else{
                               $isinya = "'". $isinya ."'";
                              }
                            }else{
                               $isinya = 'NULL';
                            }


                            if($i==0){
                               $sa.= $vd.'=' .$isinya;
                            }else{
                              $sa.= ",".$vd.'=' .$isinya;
                            }

                            $i++;
                        }


                
                        $sa.=' where  '  .$fPk. '   = "'.$pk.'"  AND d_filedate="'.$fk_1.'" AND c_filetime="'.$fk_2.'" 
                                        AND d_recv="'.$fk_3.'"
                                        AND c_recv="'.$fk_4.'"
                                        AND cKode_area="'.$cKode_area.'"   ';
                   
                        echo '<br>';

                        if(!mysqli_query($conn,$sa)){
                            echo $sa;
                            $isFinish = false;
                            schLogger($scheduler_name,$isFinish,mysqli_error(),$sa);
                            die('Mysql Failed 2 - '.mysqli_error());
                        }
                            else {echo 'Transfering ...'.$pkv.' <br>';
                        }
                    }else{
                       $sa = '';
                       echo 'Inserting ... '.$pk;
                       $sa .='INSERT INTO '.$tbsql.'(';
                          $ic=0;
                          foreach ($arrNmKolom as $fd => $vd) {
                                if($ic==0){
                                   $sa.=$vd;
                                }else{
                                   $sa.=',' .$vd;
                                }
                                $ic++;
                          }
                          $sa.=',iCompanyID,cKode_area,cPic';
                       $sa.=')VALUES(';
                       $iR=0;

                        foreach ($arrNmKolom as $fd => $vd) {
                            $isinya = str_replace("'", '', odbc_result($rs,$vd)); 
                            if(trim($isinya)<>''){
                              if(trim($isinya)=='1899-12-30'){
                                $isinya = 'NULL';
                              }else{
                               $isinya = "'". $isinya ."'";
                              }
                            }else{
                               $isinya = 'NULL';
                            }


                            if($iR==0){
                               $sa.= $isinya;
                            }else{
                                $sa.=','.$isinya;
                            }
                            
                            $iR++;
                        }
                        $sa.=','.$selectCompany;
                        $sa .= ",'". $cKode_area ."'";
                        $sa .= ",'". $cPic ."'";
                        
                        

                        $sa.=');';
                       echo '<br>';
                       if(!mysqli_query($conn,$sa)){
                          echo $sa;
                          $isFinish = false;
                          schLogger($scheduler_name,$isFinish,mysqli_error(),$sa);
                          die('Mysql Failed 3 - '.mysqli_error());
                       }
                          else {echo 'Transfering ...'.$pkv.' <br>';
                       }



                    }
                }
         
                $html .= '</table>';
                $html .= '<br>';
         
                 /* Finish Processing Data*/
                 $isFinish = true;
                 schLogger($scheduler_name,$isFinish,'done','Everything is OK');

                 /*close odbc Connection*/
                 odbc_close($conn_db);

    /*br for info running*/
    echo "<br>";

  }
}else{

  echo "No Update";
}






  function schLogger($sched,$res,$notes,$warning){
    /*Setting Table score*/
    $tbsch = 'plc2.scheduler_score';

    $now = date('Y-m-d H:i:s');
    $cType = 'php';
    if($res===True){
       $iStatus = 1;
    }else{
       $iStatus = 0;
    }

   /* $sql ='INSERT INTO '.$tbsch.'(vScheduler_Name, cType,dDateRunning,iStatus,dCreate,vErrorLogs ) 
             VALUES("'. $sched .'",
                      "'. $cType .'",
                      "'. $now .'",
                      "'. $iStatus .'",
                      "'. $now .'",
                      "'. $notes .'"
                      )';

    if(!mysqli_query($conn,$sql)){
       echo $sql;
       die('Mysql Failed 4 - '.mysqli_error());
    }
       else {echo 'Logging ...<br>';
    }
  */

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
          $re['fld']='';
          break;
       case 'L': // Bit
       case 'l': // Bit
          $re['jenis']='int';
          $re['fld']='(11)';
          break;
       
       default:
          $re['jenis']='varchar';
          $re['fld']='(255)';
          break;
    }

    return $re;

  }    

    
  
?>