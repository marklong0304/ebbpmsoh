 
        <?php
        //ini_set('max_execution_time', 0);

        /* Generated by Softdev 2 ERP CRUD Generator 2018-12-10 14:10:07 */
        /* Location: ./modules/menu/controllers/ws_minord_nvl.php */
        /* Please DO NOT modify this information : */ 
         
          /*------------------------------------------------------New------------------------------------------------------*/
            $scheduler_name='ws_minord_nvl';
            include('syslog_fwd.php'); 
            ini_set('max_execution_time', 0);

            error_reporting(E_ALL);
            set_error_handler('myErrorHandler');
           
            ini_set('log_errors', '1');
            ini_set('display_errors', '0');



            function myErrorHandler($errno, $errstr, $errfile, $errline)
            {
                $scheduler_name='ws_minord_nvl';
                if (!(error_reporting() & $errno)) {
                   // This error code is not included in error_reporting, so let it fall
                   // through to the standard PHP error handler
                   return false;
                }

                 switch ($errno) {
                 case E_USER_ERROR:
                     echo '<b>My ERROR</b> [$errno] $errstr<br />';
                     echo '  Fatal error on line $errline in file $errfile';
                     echo ', PHP ' . PHP_VERSION . ' (' . PHP_OS . ')<br />';
                     echo 'Aborting...<br />';

                      $phrase  = $errstr;
                      $healthy = ['(', ')'];
                      $yummy   = ['*'];
                      $newPhrase = str_replace($healthy, $yummy, $phrase);

                      
                     SendToSyslog('sch_'.$scheduler_name,$newPhrase);
                     exit(1);
                     break;

                 case E_USER_WARNING:
                     echo '<b>My WARNING</b> [$errno] <br />';
                     $message = '<b>My WARNING</b> [$errno] $errstr<br />';
                     SendToSyslog('sch_'.$scheduler_name,$message);
                     break;

                 case E_USER_NOTICE:
                     echo '<b>My NOTICE</b> [$errno] $errstr<br />';
                      $phrase  = $errstr;
                      $healthy = ['(', ')'];
                      $yummy   = ['*'];
                      $newPhrase = str_replace($healthy, $yummy, $phrase);

                      
                     SendToSyslog('sch_'.$scheduler_name,$newPhrase);
                     
                     break;

                 default:
                     echo 'Unknown error type: ['.$errno.'] '.$errstr.' line '.$errline.'<br />'; 

                      $phrase  = $errstr;
                      $healthy = ['(', ')'];
                      $yummy   = ['*'];
                      $newPhrase = str_replace($healthy, $yummy, $phrase);

                      
                     SendToSyslog('sch_'.$scheduler_name,$newPhrase);

                     break;
                 }

                

               /* Don't execute PHP internal error handler */
               return true;
            }

         
          

          /*------------------------------------------------------New------------------------------------------------------*/


         
        /*------------------------------------------------------Instuction------------------------------------------------------*/
        /*
         hal hal yang perlu diperhatikan untuk diganti variablenya adalah sbb:
              $selectCompany='3'; 
         1. koneksi mysql
               $host = '10.1.49.6';
               $user = 'nplnet';
               $pass = 'nplnet01';
               $db='purchase';


         2. ODBC Connection 
               $conn_db=odbc_connect('debef','','');

         3. Parameter 
               - $scheduler_name='ws_minord_nvl';
               - $BackdateI='360';
               - $tbsql='purchase.minord';
               - $pk=odbc_result($rs,'C_ITEMNUMB');
               - $fPk='C_FACCODE';
               - $pkv=odbc_result($rs,'C_ITEMNUMB').' - '.odbc_result($rs,'C_ITEMNUMB');
               - $tbsch = 'plc2.scheduler_score';
               - $dbFile='minord';
               - $dbfFile = realpath('//10.1.48.21/Sys2/DATA/PURCHASE/minord.dbf');
               - $sql='SELECT * FROM '.$dbFile.' where d_lastupdt BETWEEN #$tgl1# AND #$tgl2#';


         4. Refference 
            - https://www.connectionstrings.com/dbf-foxpro/
            - https://www.pcreview.co.uk/threads/import-dbf-files-with-memo-fields.2651051/
            - http://php.net/manual/en/function.odbc-exec.php

      */

        /*------------------------------------------------------Instuction------------------------------------------------------*/
         
            error_reporting(E_ALL);
            ini_set('display_errors', '1');

         
           /*-----------------------------------------------------Mysql Connection Start
              ------------------------------------------------------
               $host = '10.1.49.8';
               $user = 'nplnet';
               $pass = 'nplnet01';
               $db='purchase';

              $conn = mysql_connect($host, $user, $pass);
              if ($conn) {
                  mysql_select_db($db, $conn);
              } else {
                 die('Error : '.mysqli_error());
              }
              */
              //include('koneksi2.php');
           /*------------------------------------------------------Mysql Connection End------------------------------------------------------*/

         
             /*-----------------------------------------------------ODBC Connection Start-----------------------------------------------------*/

            $cari = "CommandLine like '%ws_minord_nvl.bat%'"; 
            $cmd ='wmic process where "'.$cari.'" get commandline';
            exec($cmd, $output, $return_var);
            if(count($output)>5){ 
               SendToSyslog('sch_'.$scheduler_name,'Scheduler sedang Running');
               die();
            }else{
              SendToSyslog('sch_'.$scheduler_name,'Scheduler Running Start');
            $db='purchase';
            $dbfFile = realpath('G:/DATA/PURCHASE/minord.dbf');
            $dbfDir = dirname($dbfFile);
            $dbfDir1 = 'G:/DATA/PURCHASE';
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
              $scheduler_name='ws_minord_nvl';
              /* $tgl1='2017-07-06';
                 $tgl2='2017-07-07';
              */

              /*number of days back from now */
              $BackdateI='1';
              $last_update='D_LASTUPDT';

              
              $tgl2 = date('Ymd');
              $backback = strtotime('- '.$BackdateI.' days', strtotime($tgl2));
              $tgl1 = date('Ymd', $backback);

              /*Setting Table Destination*/
              $tbsql='purchase.minord';

              $dbFile='minord';

              

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

                /*new*/
                SendToSyslog('sch_'.$scheduler_name,'Select Data DBF : '.$sql);

                 
                 //echo $sql;
                 //exit;
             
                $rs=odbc_exec($conn_db,$sql);

                if (!$rs)
                 {
                    /*new*/
                    SendToSyslog('sch_'.$scheduler_name,'Failed Select Data DBF : '.$sql);
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

                     runSQLCreateTable($create_table,$scheduler_name);

                 /*--------Create Table if not exist -------*/ 
         
                   /*------------------------------------------------Alter Column IF Exist  ------------------------------------------------------*/

                    $altTable = runSQLAlterTableGetField($db,$dbFile,$scheduler_name);
                    $setArray = array();
                    $setArrayAlter = array();


                    foreach ($altTable['fields'] as $dt) {
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
                          runSQLAlterTableProses($sqlAlter,$scheduler_name);
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
                    $pk=odbc_result($rs,'C_ITEMNUMB'); 
                    $fk_1=odbc_result($rs,'C_FACCODE');
                              if(trim($fk_1)==''){
                                              $fk_1 = ' is NULL';
                                            }else{
                                              
                                              $fk_1 =  " = '".$fk_1."'";
                                            }
                                        $fk_2=odbc_result($rs,'C_FACCODE');
                              if(trim($fk_2)==''){
                                              $fk_2 = ' is NULL';
                                            }else{
                                              
                                              $fk_2 =  " = '".$fk_2."'";
                                            }
                                        $fk_3=odbc_result($rs,'C_SUPNUMB');
                              if(trim($fk_3)==''){
                                              $fk_3 = ' is NULL';
                                            }else{
                                              
                                              $fk_3 =  " = '".$fk_3."'";
                                            }
                                        
                    $fPk='C_ITEMNUMB';
                    /*describe PK show when transfering*/
                    //$pkv= $pk;
                    $pkv=odbc_result($rs,'C_ITEMNUMB').' - '.odbc_result($rs,'C_ITEMNUMB');
                   
                    /*cek data existing in mysql table*/
                    /*param use here*/

                    $sqlUdah = 'select a.* from '.$tbsql.' a where a.'.$fPk.'= "'.$pk.'"  AND a.C_FACCODE '.$fk_1.' AND a.C_FACCODE '.$fk_2.' AND a.C_SUPNUMB '.$fk_3.' and a.iCompanyID= '.$selectCompany.' ' ;

                      $phrase  = $sqlUdah;
                      $healthy = [ "'" , '"'];
                      $yummy   = ['_'];
                      $newPhrase = str_replace($healthy, $yummy, $phrase);

                    /*new*/
                    SendToSyslog('sch_'.$scheduler_name,'Check exist data: '.$newPhrase);

                    $rowcount = runSQLRaw($sqlUdah,$scheduler_name); 

                    if ($rowcount['rowcount'] > 0) 
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


                
                        $sa.=' where  '  .$fPk. '   = "'.$pk.'"  AND C_FACCODE '.$fk_1.' AND C_FACCODE '.$fk_2.' AND C_SUPNUMB '.$fk_3.'   AND iCompanyID= '.$selectCompany.' ' ;
                   
                        echo '<br>'; 
                        $runSQLInsertUpdate = runSQLUpdate($sa,$scheduler_name);
                        echo $runSQLInsertUpdate['message'];
                        echo '<br>';

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

                        $runSQLInsertUpdate = runSQLInsert($sa,$scheduler_name);
                        echo $runSQLInsertUpdate['message'];
                        echo '<br>';



                    }
                }
         
                $html .= '</table>';
                $html .= '<br>';
         
                 /* Finish Processing Data*/
                 $isFinish = true;
                 schLogger($scheduler_name,$isFinish,'done','Everything is OK');

                 /*close odbc Connection*/
                 odbc_close($conn_db);

                 SendToSyslog('sch_'.$scheduler_name,'Scheduler Running Finish');

              //}
                
           /*------------------------------------------------------Processing Data End------------------------------------------------------*/
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

                    
             