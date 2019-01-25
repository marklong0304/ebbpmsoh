 
        <?php
        ini_set('max_execution_time', 0);
        /* Generated by Sovdev 2 ERP CRUD Generator 2018-10-23 16:37:11 */
        /* Location: ./modules/menu/controllers/jenis_nvl.php */
        /* Please DO NOT modify this information : */ 
         
        /*------------------------------------------------------Instuction------------------------------------------------------*/
        /*
         hal hal yang perlu diperhatikan untuk diganti variablenya adalah sbb:
              $selectCompany='3'; 
         1. koneksi mysql
               $host = '10.1.49.6';
               $user = 'nplnet';
               $pass = 'nplnet01';
               $db='sales';


         2. ODBC Connection 
               $conn_db=odbc_connect('debef','','');

         3. Parameter 
               - $scheduler_name='jenis_nvl';
               - $BackdateI='360';
               - $tbsql='sales.jenis';
               - $pk=odbc_result($rs,'c_jenis');
               - $fPk='C_FACCODE';
               - $pkv=odbc_result($rs,'c_jenis').' - '.odbc_result($rs,'c_nmjenis');
               - $tbsch = 'plc2.scheduler_score';
               - $dbFile='jenis';
               - $dbfFile = realpath('//10.1.48.21/Sys2/DATA/SALES/jenis.dbf');
               - $sql='SELECT * FROM '.$dbFile.' where d_lastupdt BETWEEN #$tgl1# AND #$tgl2#';


         4. Refference 
            - https://www.connectionstrings.com/dbf-foxpro/
            - https://www.pcreview.co.uk/threads/import-dbf-files-with-memo-fields.2651051/
            - http://php.net/manual/en/function.odbc-exec.php

      */

        /*------------------------------------------------------Instuction------------------------------------------------------*/
         
            error_reporting(E_ALL);
            ini_set('display_errors', '1');

         
           /*-----------------------------------------------------Mysql Connection Start------------------------------------------------------*/
               $host = '10.1.49.8';
               $user = 'nplnet';
               $pass = 'nplnet01';
               $db='sales';

              $conn = mysql_connect($host, $user, $pass);
              if ($conn) {
                  mysql_select_db($db, $conn);
              } else {
                 die('Error : '.mysqli_error());
              }

              include('koneksi2.php');
           /*------------------------------------------------------Mysql Connection End------------------------------------------------------*/

         
             /*-----------------------------------------------------ODBC Connection Start-----------------------------------------------------*/
            $db='sales';
            $dbfFile = realpath('G:/DATA/SALES/jenis.dbf');
            $dbfDir = dirname($dbfFile);
            $dbfDir1 = 'G:/DATA/SALES';
            $conn_db = odbc_connect('Driver={Microsoft Visual FoxPro Driver};SourceType=DBF;SourceDB='.$dbfDir1.';Exclusive=No;Collate=Machine;NULL=NO;DELETED=YES;BACKGROUNDFETCH=NO;' , '', '');
         
            //=odbc_connect('vfpDriver','','');
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
              $scheduler_name='jenis_nvl';
              /*$tgl1='2017-07-06';
              $tgl2='2017-07-07';*/

              /*number of days back from now */
              $BackdateI='5';
              $last_update='-';

              
              $tgl2 = date('Ymd');
              $backback = strtotime('- '.$BackdateI.' days', strtotime($tgl2));
              $tgl1 = date('Ymd', $backback);

              /*Setting Table Destination*/
              $tbsql='sales.jenis';

              $dbFile='jenis';

              

              /*flag finish running*/
              $isFinish = false;


           /*------------------------------------------------------Parameter End------------------------------------------------------*/
         
                /* Select data from DBF*/
                /*parsing parameter with hastag (#) */
                 //$sql='SELECT * FROM '.$dbFile.' where d_lastupdt BETWEEN #$tgl1# AND #$tgl2#';

                 

                if($last_update<>'-'){
                  $sql = 'SELECT * From '.$dbFile.'  WHERE DTOS('.$dbFile.'.'.$last_update.') BETWEEN "'.$tgl1.'"  and "'.$tgl2.'" ';
                }else{
                  $sql='SELECT * FROM '.$dbFile.' ';
                }


                 
                 //echo $sql;
                 //exit;
             
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
                //function processingData(){
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
                    $pk=odbc_result($rs,'c_jenis'); 
                    
                    $fPk='c_jenis';
                    /*describe PK show when transfering*/
                    //$pkv= $pk;
                    $pkv=odbc_result($rs,'c_jenis').' - '.odbc_result($rs,'c_nmjenis');
                   
                    /*cek data existing in mysql table*/
                    /*param use here*/

                    $sqlUdah = 'select * from '.$tbsql.' a where a.iCompanyID= '.$selectCompany.'  
                                  AND a.'.$fPk.'= "'.$pk.'"  ' ;

                    $rowUdah = mysqli_fetch_array(mysqli_query($conn,$sqlUdah));

                    if (!empty($rowUdah)) 
                    {
                      // updating record when exists
                      $sa = '';
                      echo 'Updating ... '.$pk;
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


                
                        $sa.=' where  '  .$fPk. '   = "'.$pk.'"    ';
                   
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
                          $sa.=',iCompanyID';
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
              //}
                
           /*------------------------------------------------------Processing Data End------------------------------------------------------*/
        

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

                  $sql ='INSERT INTO '.$tbsch.'(vScheduler_Name, cType,dDateRunning,iStatus,dCreate,vErrorLogs ) 
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

                    
             