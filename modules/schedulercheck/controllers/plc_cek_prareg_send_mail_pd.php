<?php
include('../libraries/class.phpmailer.php');
           /*-----------------------------------------------------Mysql Connection Start------------------------------------------------------*/
               $host = '10.1.49.8';
               $user = 'nplnet';
               $pass = 'nplnet01';
               $db='purchase';

              $conn = mysql_connect($host, $user, $pass);
              if ($conn) {
                  mysql_select_db($db, $conn);
              } else {
                 die('Error : '.mysql_error());
              }
              //include('koneksi.php');
           /*------------------------------------------------------Mysql Connection End------------------------------------------------------*/
           $scheduler_name="reminder_pd_mail_cek_prareg";
           $sekarang=date("Y-m-d");
           $days_ago=date('Y-m-d',strtotime('-2 days',strtotime($sekarang)));

/*Cek Team PD*/
$sqlpd="select * from plc2.plc2_upb_team t where t.ldeleted=0 and t.vtipe='PD' and t.vnip is not NULL and t.vnip !=''";
$myquerya=mysql_query($sqlpd);
$iteam=array();
while ($dt=mysql_fetch_array($myquerya)){
    $iteam[]=$dt['iteam_id'];
    echo "Mapping Team PD....<br />";
}
$cekteampd=array();
if(count($iteam)>=1){
  foreach ($iteam as $kteam => $vteam) {
      $sql="
          SELECT plc2.plc2_upb.*
          FROM (plc2.plc2_upb)
          WHERE plc2.plc2_upb.iupb_id in (select po.iupb_id from plc2.lpo po where po.iapppd=2 and po.lDeleted=0)
          AND plc2.plc2_upb.iupb_id in (select fo.iupb_id from plc2.plc2_upb_formula fo where fo.iapppd_lpp=2 and fo.ldeleted=0)
          AND plc2.plc2_upb.iupb_id in (select bb.iupb_id from plc2.plc2_upb_soi_bahanbaku bb where bb.ldeleted=0 and bb.iappqa=2)
          AND plc2.plc2_upb.iupb_id in (select distinct(rs.iupb_id) from plc2.plc2_upb_ro ro
           left outer join plc2.plc2_upb_ro_detail rod on rod.iro_id = ro.iro_id and rod.ldeleted = 0
           left outer join plc2.plc2_upb_po po on po.ipo_id = ro.ipo_id
           left outer join plc2.plc2_upb_request_sample_detail rsd on rsd.ireq_id = rod.ireq_id and rsd.raw_id = rod.raw_id and rsd.ldeleted = 0
           left outer join plc2.plc2_raw_material rm on rm.raw_id=rsd.raw_id
           left outer join plc2.plc2_upb_request_sample rs on rs.ireq_id = rod.ireq_id 
           left outer join plc2.plc2_upb u on u.iupb_id = rs.iupb_id
           where (
           case when rod.iUjiMikro_bb = 1 
           then rod.ireq_id in (select d.ireq_id from plc2.uji_mikro_bb u
           inner join plc2.plc2_upb_request_sample_detail d on u.ireqdet_id=d.ireqdet_id
           inner join plc2.plc2_upb_request_sample s on d.ireq_id=s.ireq_id
           inner join plc2.plc2_raw_material m on d.raw_id=m.raw_id
           where u.lDeleted=0 and u.iApprove_uji=2 and u.iApprove_mikro_final=2) 
           else
           rod.ireq_id in (select d.ireq_id
           from plc2.plc2_upb_request_sample_detail d 
           inner join plc2.plc2_upb_request_sample s on d.ireq_id=s.ireq_id
           inner join plc2.plc2_raw_material m on d.raw_id=m.raw_id
           where d.ldeleted=0
           and s.ldeleted=0
           and m.ldeleted=0 
           and s.iapppd=2 )
           end 
           ))
          AND plc2.plc2_upb.iupb_id in (select iupb_id from plc2.plc2_upb_formula where ldeleted=0 and iFormula_process is not NULL)
          AND plc2.plc2_upb.ldeleted =  0
          AND plc2.plc2_upb.iKill =  0
          AND plc2.plc2_upb.itipe_id not in (6)
          AND plc2_upb.ihold =  0
          AND plc2_upb.ldeleted =  0
          AND plc2_upb.ihold =  0
          AND plc2_upb.isentmail_pd_prareg=0
          AND plc2_upb.iconfirm_dok_pd=0
          AND plc2_upb.iteampd_id=".$vteam."
          GROUP BY plc2.plc2_upb.iupb_id
          ORDER BY plc2.plc2_upb.vupb_nomor asc";
        $myquery=mysql_query($sql);
        $datadt=array();
        while ($dta=mysql_fetch_array($myquery)){
         $datadt[]=$dta['iupb_id'];
        } 
        $cekteampd[$vteam]=implode(',',$datadt);
        echo "Mapping UPB PerTeam PD....<br />";
  }
}
if(count($cekteampd)>=1){
  foreach ($cekteampd as $ktp => $vtp) {
    if($vtp!=""){
      $sql='select * from plc2.plc2_upb u where u.ldeleted=0 and u.ihold=0 and u.iupb_id in ('.$vtp.')';
      $qq=mysql_query($sql);
      $to=getmailmanagerNIP($ktp);
      $subject="Cek Dokumen Praregistrasi";
      $cc='Leonardo.Harianja@novellpharm.com;'.getmailteamNIP($ktp);
      $content="Diberitahukan bahwa telah ada kesiapan data UPB pada Cek Dokumen Praregistrasi(aplikasi PLC) untuk dilakukan Approval oleh PD Manager dengan rincian sebagai berikut :<br><br>
                <div style='width: 600px;padding: 10px;background : #cfd1cf;margin: 0px;'>
                <table style='border-collapse: collapse;' border='1' width='100%'>
                <tr>
                  <th>No</th>
                  <th>Nomor UPB</th>
                  <th>Nama Usulan</th>
                </tr>";
      $zz=1;
      while ($dd=mysql_fetch_array($qq)) {
        $content.="
        <tr>
            <td>".$zz."</td>
            <td>".$dd['vupb_nomor']."</td>
            <td>".$dd['vupb_nama']."</td>
        </tr>
        ";
        $zz++;
      }
      $content .="</table>
                  </div>
                  <br/> 
                  Demikian, mohon segera follow up  pada aplikasi ERP Product Life Cycle. Terimakasih.<br><br><br>
                  Post Master<br/>";
      sendmail($content,$to,$cc,$subject);
      echo "Mail Sending...";
      $update="update plc2.plc2_upb u set u.isentmail_pd_prareg=1 where u.iupb_id in (".$vtp.")";
      if(mysql_query($update)){
        echo "Updated....";
      }else{
        echo "Failed Update....";
      }
    }
  }
}

function sendmail($content,$to,$cc,$subject){
      $mail = new PHPMailer(); // defaults to using php "mail()"

      $mail->IsSMTP();  //telling the class to use SMTP
      $mail->Host     = "10.1.48.4"; // SMTP server
      
      $from = 'postmaster@novellpharm.com';     
      $mail->SetFrom($from, 'NPL-Product Life Cycle');   
      
      //add address
      $cTo=explode(';', $to);
      foreach( $cTo as $ak => $av ) {
        $mail->AddAddress($av, $av);
      }
      $cCc=explode(';', $cc);
      foreach( $cCc as $ak => $av ) {
        $mail->AddCC($av, $av);
      }
    $mbcc='mansur@novellpharm.com;supri@novellpharm.com';
     $bCc=explode(';', $mbcc);
     foreach( $bCc as $ak => $av ) {
        $mail->AddBCC($av, $av);
      }
          
      $mail->Subject = $subject;
      
      $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
      $mail->MsgHTML($content);
      if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
      } else {
        echo "Message sent!";
      }
}

function getmailmanagerNIP($iteam){
  $sql='select em.vEmail from plc2.plc2_upb_team t
  join hrd.employee em on t.vnip=em.cNip
  where t.iteam_id ='.$iteam;
  $q=mysql_query($sql);
  $mail=array();
  while ($dt=mysql_fetch_array($q)) {
    $mail[]=$dt['vEmail'];
  }
  $ret=implode(';', array_unique($mail));
  return $ret;
}
function getmailteamNIP($iteam){
  $sql='select em.vEmail from plc2.plc2_upb_team_item t
  join hrd.employee em on t.vnip=em.cNip
  where t.iteam_id ='.$iteam;
  $q=mysql_query($sql);
  $mail=array();
  while ($dt=mysql_fetch_array($q)) {
    $mail[]=$dt['vEmail'];
  }
  $ret=implode(';', array_unique($mail));
  return $ret;
}        

          /*if(count($updateset)>=1){
            foreach ($updateset as $c_invno => $vin) {
              $result = mysql_query($vin);
               if(!$result){
                    echo $result;
                    $isFinish = false;
                    //schLogger($scheduler_name,$isFinish,mysql_error(),$result);
                   die('Mysql Failed 4 - '.mysql_error());
                }else {
                  $isFinish = true;
                  //schLogger($scheduler_name,$isFinish,'done','Everything is OK');
                  echo 'Result-'.$c_invno.' : '.$result.' ...<br>';
                }
            }
          }else{
            $isFinish = true;
                  $isFinish = true;
                  $result="No Update";
                  //schLogger($scheduler_name,$isFinish,'done','Everything is OK');
                  echo 'Result : '.$result.' ...<br>';
          }
*/


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