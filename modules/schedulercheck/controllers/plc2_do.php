<?php
           /*-----------------------------------------------------Mysql Connection Start------------------------------------------------------*/
             /*  $host = '10.1.49.16';
               $user = 'nplnet';
               $pass = 'nplnet01';
               $db='purchase';

              $conn = mysql_connect($host, $user, $pass);
              if ($conn) {
                  mysql_select_db($db, $conn);
              } else {
                 die('Error : '.mysql_error());
              }*/
              include('koneksi.php');
           /*------------------------------------------------------Mysql Connection End------------------------------------------------------*/
           $scheduler_name="plc2_do";
           $sekarang=date("Y-m-d");
           $days_ago=date('Y-m-d',strtotime('-10 days',strtotime($sekarang)));
          $sql="
            SELECT a.c_invno,h.c_nosrt,a.c_dorno,a.d_dueda,a.d_prndo,b.c_cunam,a.c_corno,h.c_nosj
              FROM sales.aremas a
              join sales.cusmas01 b on b.c_cusno=a.c_cusno
              join sales.corent01 c on c.c_corno=a.c_corno
              join sales.dsrtjln d on d.c_invno=a.c_invno
              join sales.hsrtjln h on h.c_nosrt=d.c_nosrt
             # where a.c_prndo='T'
              #and c.c_type <> 'S'
             # and a.d_dueda >= '".$days_ago."' and a.d_dueda <='".$sekarang."'
              #and 
              where  h.d_lastupdt >= '".$days_ago."' and h.d_lastupdt <='".$sekarang."'
              group by a.c_invno
              order by a.c_dorno";
          $myquery=mysql_query($sql);
          $datadt=array();
          $data=array();
          while ($dt=mysql_fetch_array($myquery)){
            $data[]=$dt['c_invno'];
            $datadt[$dt['c_invno']]['c_nosrt']=$dt['c_nosrt'];
            $datadt[$dt['c_invno']]['c_dorno']=$dt['c_dorno'];
            $datadt[$dt['c_invno']]['d_dueda']=$dt['d_dueda'];
            $datadt[$dt['c_invno']]['d_prndo']=$dt['d_prndo'];
            $datadt[$dt['c_invno']]['c_cunam']=$dt['c_cunam'];
            $datadt[$dt['c_invno']]['c_corno']=$dt['c_corno'];
            $datadt[$dt['c_invno']]['c_nosj']=$dt['c_nosj'];
            echo "Loading Temp Data - ".$dt['c_invno']." <br />";
          }
          //echo $sql;
          /*Cek Insert atau update*/
          $updateset=array();
          foreach ($data as $kd => $vd) {
             $c_invno=$vd;
              $sqlcek="select iInvno_id from plc2.plc2_do d where d.c_invno='".$c_invno."'";
              $dt2=mysql_fetch_array(mysql_query($sqlcek));
              if(!empty($dt2)){
                $iInvno_id=$dt2['iInvno_id'];
                $updateset[$c_invno]="UPDATE plc2.plc2_do do set do.c_invno='".$c_invno."', do.cNosrt='".$datadt[$vd]['c_nosrt']."', do.c_dorno='".$datadt[$vd]['c_dorno']."', do.d_dueda='".$datadt[$vd]['d_dueda']."', do.d_prndo='".$datadt[$vd]['d_prndo']."', c_cunam='".$datadt[$vd]['c_cunam']."', c_corno='".$datadt[$vd]['c_corno']."', c_nosj='".$datadt[$vd]['c_nosj']."' where iInvno_id=".$iInvno_id;
                 
              }else{
                  $updateset[$c_invno]="INSERT INTO plc2.plc2_do (c_invno,cNosrt,c_dorno,d_dueda,d_prndo,c_cunam,c_corno,c_nosj) VALUE ('".$c_invno."','".$datadt[$vd]['c_nosrt']."','".$datadt[$vd]['c_dorno']."','".$datadt[$vd]['d_dueda']."','".$datadt[$vd]['d_prndo']."','".$datadt[$vd]['c_cunam']."','".$datadt[$vd]['c_corno']."','".$datadt[$vd]['c_nosj']."')";
                 
              }
              echo "Cheking Update or Insert - ".$vd." <br />";
          }

          if(count($updateset)>=1){
            foreach ($updateset as $c_invno => $vin) {
              $result = mysql_query($vin);
               if(!$result){
                    echo $result;
                    $isFinish = false;
                    schLogger($scheduler_name,$isFinish,mysql_error(),$result);
                   die('Mysql Failed 4 - '.mysql_error());
                }else {
                  $isFinish = true;
                  schLogger($scheduler_name,$isFinish,'done','Everything is OK');
                  echo 'Result-'.$c_invno.' : '.$result.' ...<br>';
                }
            }
          }else{
            $isFinish = true;
                  $isFinish = true;
                  $result="No Update";
                  schLogger($scheduler_name,$isFinish,'done','Everything is OK');
                  echo 'Result : '.$result.' ...<br>';
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