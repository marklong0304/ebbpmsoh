 
        <?php
        /* Generated by Sovdev 2 ERP CRUD Generator 2017-08-24 09:58:33 */
        /* Location: ./modules/schedulercheck/controllers/trial_batpacka_etc.php */
        /* Please DO NOT modify this information : */ 
         
        /*------------------------------------------------------Instuction------------------------------------------------------*/
        /*
         hal hal yang perlu diperhatikan untuk diganti variablenya adalah sbb:
              $selectCompany='5'; 
         1. koneksi mysql
               $host = '10.1.49.8';
               $user = 'nplnet';
               $pass = 'nplnet01';
               $db='prdtrial';


         2. ODBC Connection 
               $conn=odbc_connect('debef','','');

         3. Parameter 
               - $scheduler_name='trial_batpacka_etc';
               - $BackdateI='1';
               - $tbsql='prdtrial.batpacka';
               - $pk=odbc_result($rs,'c_iteno');
               - $fPk='C_FACCODE';
               - $pkv=odbc_result($rs,'c_iteno').' - '.odbc_result($rs,'c_iteno');
               - $tbsch = 'plc2.scheduler_score';
               - $dbFile='batpacka';
               - $dbfFile = realpath('//10.1.48.21/Sys2/data/emba/prdtrial/batpacka.dbf');
               - $sql='SELECT * FROM  where d_lastupdt BETWEEN #$tgl1# AND #$tgl2#';


         4. Refference 
            - https://www.connectionstrings.com/dbf-foxpro/
            - https://www.pcreview.co.uk/threads/import-dbf-files-with-memo-fields.2651051/
            - http://php.net/manual/en/function.odbc-exec.php

      */

        /*------------------------------------------------------Instuction------------------------------------------------------*/
         
            error_reporting(E_ALL);
            ini_set('display_errors', '1');

         
           /*-----------------------------------------------------Mysql Connection Start------------------------------------------------------*/
              //  $host = '10.1.49.8';
              //  $user = 'nplnet';
              //  $pass = 'nplnet01';
              //  $db='prdtrial';

              // $conn = mysql_connect($host, $user, $pass);
              // if ($conn) {
              //     mysql_select_db($db, $conn);
              // } else {
              //    die('Error : '.mysql_error());
              // }
              include('koneksi.php');
           /*------------------------------------------------------Mysql Connection End------------------------------------------------------*/

         
             /*-----------------------------------------------------ODBC Connection Start-----------------------------------------------------*/

            $dbfFile = realpath('G:/data/emba/prdtrial/batpacka.dbf');
            $dbfDir = dirname($dbfFile);
            $dbfDir1 = 'G:/data/emba/prdtrial';
            $conn = odbc_connect('Driver={Microsoft Visual FoxPro Driver};SourceType=DBF;SourceDB='.$dbfDir1.';Exclusive=No;Collate=Machine;NULL=NO;DELETED=YES;BACKGROUNDFETCH=NO;' , '', '');
         
            //=odbc_connect('vfpDriver','','');
             if (!$conn)
             {
                exit('Connection Failed: ' . $conn);
             }else{
                //echo 'Connected';
                //exit;
             }  
            /*------------------------------------------------------ODBC Connection End------------------------------------------------------*/
         
          /*------------------------------------------------------Parameter Start------------------------------------------------------*/
              $selectCompany='5'; 
              $scheduler_name='trial_batpacka_etc';
              /*='2017-07-06';
              ='2017-07-07';*/

              /*number of days back from now */
              $BackdateI='1';
              $last_update='d_lastupdt';

              
$tgl2 = date('Ymd');
              $backback = strtotime('- '.$BackdateI.' days', strtotime($tgl2));
              $tgl1 = date('Ymd', $backback);

              /*Setting Table Destination*/
              $tbsql='prdtrial.batpacka';

              $dbFile='batpacka';

              

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


                 
                 //echo ;
                 //exit;
             
                $rs=odbc_exec($conn,$sql);

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

                    if(mysql_query($create_table)){
                       /*lanjut*/
                    }else{
                       schLogger($scheduler_name,$isFinish,mysql_error(),$create_table);
                       die('Mysql Failed 1 - '.mysql_error());
                    }

                 /*--------Create Table if not exist -------*/

         
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
                    $pk=odbc_result($rs,'c_iteno');
                    $fPk='c_iteno';

                    /*describe PK show when transfering*/
                    //$pkv= $pk;
                    $pkv=odbc_result($rs,'c_iteno').' - '.odbc_result($rs,'c_iteno');
                   
                    /*cek data existing in mysql table*/
                    /*param use here*/

                    $sqlUdah = 'select * from '.$tbsql.' a where a.'.$fPk.'= "'.$pk.'" and  iCompanyID = "'.$selectCompany.'" ' ;
                    $rowUdah = mysql_fetch_array(mysql_query($sqlUdah));

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


                
                        $sa.=' where  '.$fPk.'  = "'.$pk.'" and  iCompanyID = "'.$selectCompany.'"    ';
                   
                        echo '<br>';

                        if(!mysql_query($sa)){
                            echo $sa;
                            $isFinish = false;
                            schLogger($scheduler_name,$isFinish,mysql_error(),$sa);
                            die('Mysql Failed 2 - '.mysql_error());
                        }
                            else {echo 'Transfering ...'.$pkv.'-'.$scheduler_name.' <br>';
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
                       if(!mysql_query($sa)){
                          echo $sa;
                          $isFinish = false;
                          schLogger($scheduler_name,$isFinish,mysql_error(),$sa);
                          die('Mysql Failed 3 - '.mysql_error());
                       }
                          else {echo 'Transfering ...'.$pkv.'-'.$scheduler_name.' <br>';
                       }



                    }
                }
         
                $html .= '</table>';
                $html .= '<br>';
         
                 /* Finish Processing Data*/
                 $isFinish = true;
                 schLogger($scheduler_name,$isFinish,'done','Everything is OK');

                 /*close odbc Connection*/
                 odbc_close($conn);
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

                    
             