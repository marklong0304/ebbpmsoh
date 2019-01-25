<?php

$tahun =2016;
$host ="10.1.49.6";
$user ="nplnet";
$pass ="nplnet01";
$con = mysql_connect($host,$user,$pass);
if(!$con){
  echo 'die';
  exit;
}else{
  $sqlTrun ="TRUNCATE TABLE kanban.`temporary_pk_non_steril`";
  mysql_query($sqlTrun,$con);
  for($tahun=2016;$tahun<2019;$tahun++){
   $t1_p1 =$tahun.'-01-01';
   $t2_p1 =$tahun.'-06-30';

   $t1_p2 =$tahun.'-07-01';
   $t2_p2 =$tahun.'-12-31';

   if($tahun==2018){
    $val = 1;
   }else{
    $val = 2;
   }
   

   for($i=0;$i<$val;$i++){
     $sqlData = 'select CONCAT(d.id, "-", j.iProses_id) as keykey ,j.iProses_id,d.id as mbr_id,d.vNama as nm_produk ,
       e.vnama_jenis,h.vName as group_proses_qc,j.vProses_name,i.vName as nm_zat,
       d.vBatch_no,a.iCount,a.mapping_proses_perkategori_id,a.qc_mesin_waiting_id,a.mesin_waiting_id,d.vKode_obat,d.iCompany
       from kanban.kbn_qc_mesin_waiting a
       join kanban.kbn_qc_mesin_waiting_detail b on b.qc_mesin_waiting_id=a.qc_mesin_waiting_id
       join kanban.kbn_mesin_waiting c on c.mesin_waiting_id=a.mesin_waiting_id
       join kanban.kbn_mbr d on d.id=c.mbr_id
       join kanban.kbn_master_jenis e on e.ijenis_id=d.ijenis_id
       join kanban.kbn_qc_master_mapping_proses_perkategori f on f.mapping_proses_perkategori_id=a.mapping_proses_perkategori_id
       join kanban.kbn_qc_master_proses_group g on g.iProses_id=c.proses_qc_id
       join kanban.kbn_qc_master_group_kategori h on h.group_kategori_id=g.group_kategori_id
       join kanban.kbn_qc_master_zat_aktif i on i.zat_aktif_id=f.zat_aktif_id
       join kanban.kbn_master_proses j on j.iProses_id=g.iProses_id
       where
       a.iDeleted=0
       and b.iDeleted=0
       and d.iDeleted=0
       and e.iDeleted=0
       and f.iDeleted=0
       and g.iDeleted=0
       and h.iDeleted=0
       and i.iDeleted=0
       and a.qc_mesin_waiting_id in (
           select qc_mesin_waiting_id
           from kanban.kbn_qc_mesin_waiting_detail a
           where a.iFlow_qc_id=4
           and a.iDeleted=0
           and (a.dFinish_time is not null or a.dFinish_time !="0000-00-00 00:00:00")
           )
       and a.qc_mesin_waiting_id in (
           select qc_mesin_waiting_id
           from kanban.kbn_qc_mesin_waiting_detail a
           where
           a.iDeleted=0
           and (a.dFinish_time is not null or a.dFinish_time !="0000-00-00 00:00:00")
           and a.dFinish_time >="'.$t1_p1.'"
           and a.dFinish_time <="'.$t2_p1.'"
         )
       group by a.qc_mesin_waiting_id order by keykey ';

       $n=0;
       $result0 = mysql_query($sqlData,$con);
       while($d = mysql_fetch_array($result0)) {
         if(isset($total[$d['keykey']][$t1_p1])) {
           $total[$d['keykey']][$t1_p1]++;
         }else{
           $total[$d['keykey']][$t1_p1]=1;
         }
        $n++;
        echo 'Done '.$d['keykey'].'-'.$i.'-'.$n.'    ';
       }
       $cekcUpper="";

       //AllData Output
       $num = 0;
       $result1 = mysql_query($sqlData,$con);
       while($dt = mysql_fetch_array($result1)) {

         $sqlprewait='select a.dStart_time,a.dFinish_time
               from kanban.kbn_qc_mesin_waiting_detail a
               where a.qc_mesin_waiting_id="'.$dt['qc_mesin_waiting_id'].'"
               and a.iFlow_qc_id=2
               and a.iDeleted=0
               and a.isProses=0';
               $result_d0 = mysql_query($sqlprewait,$con);
               while($dataprepwait = mysql_fetch_array($result_d0)) {
                 $dStart_time_wait =$dataprepwait['dStart_time'];
                 $dFinish_time_wait=$dataprepwait['dFinish_time'];
               }

         $sqlolahpros='select a.dStart_time,a.dFinish_time
               from kanban.kbn_qc_mesin_waiting_detail a
               where a.qc_mesin_waiting_id="'.$dt['qc_mesin_waiting_id'].'"
               and a.iFlow_qc_id=4
               and a.iDeleted=0
               and a.isProses=1';
               $result_d1 = mysql_query($sqlolahpros,$con);
               while($dataolahpros = mysql_fetch_array($result_d1)) {
                 $dStart_time_pro =$dataolahpros['dStart_time'];
                 $dFinish_time_pro=$dataolahpros['dFinish_time'];
               }

         $next_count = $dt['iCount'] + 1;
         $sqlcekrt = 'select *
   						from kanban.kbn_qc_mesin_waiting a
   						where a.mesin_waiting_id="'.$dt['mesin_waiting_id'].'"
   						and a.mapping_proses_perkategori_id="'.$dt['mapping_proses_perkategori_id'].'"
   						and a.iCount="'.$next_count.'"';
              $sqlcekres  = mysql_query($sqlcekrt,$con);
              if (mysql_num_rows($sqlcekres)==0){
                $rts='N';
              }else{
                $rts='Y';
              }

            $retest           =$rts;
            $keykey           =$dt['keykey'];
            $iProses_id       =$dt['iProses_id'];
            $mbr_id           =$dt['mbr_id'];
            $nm_produk        =$dt['nm_produk'];
            $vnama_jenis      =$dt['vnama_jenis'];
            $group_proses_qc  =$dt['group_proses_qc'];
            $vProses_name     =$dt['vProses_name'];
            $nm_zat           =$dt['nm_zat'];
            $vBatch_no        =$dt['vBatch_no'];
            $iCount           =$dt['iCount'];
            $mapping_proses_perkategori_id  =$dt['mapping_proses_perkategori_id'];
            $qc_mesin_waiting_id=$dt['qc_mesin_waiting_id'];
            $mesin_waiting_id =$dt['mesin_waiting_id'];
            $vKode_obat       =$dt['vKode_obat'];
            $iCompany         =$dt['iCompany'];

            $count_tbl        =$total[$dt['keykey']][$t1_p1];
            $dPeriode         =$t1_p1.'/'.$t2_p1;

            $days             = getSelisih($t1_p1,$t2_p1,$mbr_id,$iProses_id,$vKode_obat,0);
            $days2             = getSelisih($t1_p1,$t2_p1,$mbr_id,$iProses_id,$vKode_obat,1);
            if($days<0){
              $days = -1*$days;
            }
            if($days2<0){
              $days2 = -1*$days2;
            }
            $selisih_hari     =$days;
            $selisih_hari_non     =$days2;
            $num++;

              $sqlIn = "INSERT INTO kanban.`temporary_pk_non_steril` (
                          `keykey`, `iProses_id`, `mbr_id`, `nm_produk`,
                          `vnama_jenis`, `group_proses_qc`, `vProses_name`,
                          `nm_zat`, `vBatch_no`, `iCount`, `mapping_proses_perkategori_id`,
                          `qc_mesin_waiting_id`, `mesin_waiting_id`, `vKode_obat`,
                          `dStart_time_wait`, `dFinish_time_wait`, `dStart_time_pro`,
                          `dFinish_time_pro`, `count_tbl`,
                          `selisih_hari`,`selisih_hari_non`, `dPeriode`,`retest`,`iCompany`)
                          VALUES (
                            '".$keykey."', '".$iProses_id."', '".$mbr_id."', '".$nm_produk."',
                            '".$vnama_jenis."', '".$group_proses_qc."', '".$vProses_name."',
                            '".$nm_zat."', '".$vBatch_no."', '".$iCount."', '".$mapping_proses_perkategori_id."',
                            '".$qc_mesin_waiting_id."', '".$mesin_waiting_id."', '".$vKode_obat."',
                            '".$dStart_time_wait."', '".$dFinish_time_wait."', '".$dStart_time_pro."',
                            '".$dFinish_time_pro."', '".$count_tbl."',
                            '".$selisih_hari."','".$selisih_hari_non."', '".$dPeriode."','".$retest."','".$iCompany."')";
              mysql_query($sqlIn,$con);
              echo 'Done Data Ins '.$dt['keykey'].'-'.$i.'-'.$num.'    ';
       }
       $t1_p1 = $t1_p2;
       $t2_p1 = $t2_p2;
     }
   }
}
function selisihHari($tglAwal, $tglAkhir, $ijenis=0){
    $tglLibur = array();

    if($ijenis==0){
      $sqlholi="select * from hrd.holiday holi
        where holi.bDeleted=0 and holi.ddate Between '".$tglAwal."' AND '".$tglAkhir."'";
      $sqlQ = mysql_query($sqlholi);

      while($dLi = mysql_fetch_array($sqlQ)) {
        array_push($tglLibur, $dLi['ddate']);
      }
    }

    $pecah1 = explode("-", date("Y-m-d",strtotime($tglAwal)));
    $date1 = $pecah1[2];
    $month1 = $pecah1[1];
    $year1 = $pecah1[0];

    $pecah2 = explode("-", date("Y-m-d",strtotime($tglAkhir)));
    $date2 = $pecah2[2];
    $month2 = $pecah2[1];
    $year2 =  $pecah2[0];

    $jd1 = GregorianToJD($month1, $date1, $year1);
    $jd2 = GregorianToJD($month2, $date2, $year2);

    $selisih = $jd2 - $jd1;

    $libur1=0;
    $libur2=0;
    $libur3=0;

    if($ijenis==0){
      for($i=1; $i<=$selisih; $i++){
          $tanggal = mktime(0, 0, 0, $month1, $date1+$i, $year1);
          $tglstr = date("Y-m-d", $tanggal);
          if (in_array($tglstr, $tglLibur))
          {
              $libur1++;
          }
          if ((date("N", $tanggal) == 7))
          {
              if (in_array($tglstr, $tglLibur))
              {
                  $libur1=$libur1-1;
              }
              $libur2++;
          }
          if ((date("N", $tanggal) == 6))
          {
              if (in_array($tglstr, $tglLibur))
              {
                  $libur1=$libur1-1;
              }
              $libur3++;
          }
      }
    }

    $hasil = $selisih-$libur1-$libur2-$libur3;
    //$hasil = $selisih-$libur1-$libur2-$libur3;
    // if($hasil>=0){
    //     if(date('H:i:s', strtotime($tglAwal)) > date('H:i:s', strtotime($tglAkhir))){
    //         $hasil=$hasil-1;
    //     }
    // }

    return $hasil;
}

function getSelisih($tglAwal,$tglAkhir,$mbr_id,$iProses_id,$vKode_obat,$ijenis=0){
      $sqlp ='
      select  a.qc_mesin_waiting_id,
              CONCAT(d.id, "-", j.iProses_id) as keykey
        from kanban.kbn_qc_mesin_waiting a
        join kanban.kbn_qc_mesin_waiting_detail b on b.qc_mesin_waiting_id=a.qc_mesin_waiting_id
        join kanban.kbn_mesin_waiting c on c.mesin_waiting_id=a.mesin_waiting_id
        join kanban.kbn_mbr d on d.id=c.mbr_id
        join kanban.kbn_master_jenis e on e.ijenis_id=d.ijenis_id
        join kanban.kbn_qc_master_mapping_proses_perkategori f on f.mapping_proses_perkategori_id=a.mapping_proses_perkategori_id
        join kanban.kbn_qc_master_proses_group g on g.iProses_id=c.proses_qc_id
        join kanban.kbn_qc_master_group_kategori h on h.group_kategori_id=g.group_kategori_id
        join kanban.kbn_qc_master_zat_aktif i on i.zat_aktif_id=f.zat_aktif_id
        join kanban.kbn_master_proses j on j.iProses_id=g.iProses_id
        where
        a.iDeleted=0
        and b.iDeleted=0
        and d.iDeleted=0
        and e.iDeleted=0
        and f.iDeleted=0
        and g.iDeleted=0
        and h.iDeleted=0
        and i.iDeleted=0
        and a.qc_mesin_waiting_id in (
            select qc_mesin_waiting_id
            from kanban.kbn_qc_mesin_waiting_detail a
            where a.iFlow_qc_id=4
            and a.iDeleted=0
            and (a.dFinish_time is not null or a.dFinish_time !="0000-00-00 00:00:00")
            )
        and a.qc_mesin_waiting_id in (
            select qc_mesin_waiting_id
            from kanban.kbn_qc_mesin_waiting_detail a
            where
            a.iDeleted=0
            and (a.dFinish_time is not null or a.dFinish_time !="0000-00-00 00:00:00")
            and a.dFinish_time >="'.$tglAwal.'"
            and a.dFinish_time <="'.$tglAkhir.'"
          )
        and d.id ="'.$mbr_id.'"
        and j.iProses_id ="'.$iProses_id.'"
        and d.vKode_obat ="'.$vKode_obat.'"
        group by a.qc_mesin_waiting_id order by keykey ';

  $arStart = array();
  $arFinish = array();

  $ressult  = mysql_query($sqlp);
  if(empty($ressult)){
    return 0;
  }else{
    while($datas = mysql_fetch_array($ressult)) {
      $sqlprewait='select a.dStart_time,a.dFinish_time
          from kanban.kbn_qc_mesin_waiting_detail a
          where a.qc_mesin_waiting_id="'.$datas['qc_mesin_waiting_id'].'"
          and a.iFlow_qc_id=2
          and a.iDeleted=0
          and a.isProses=0';
          $result_d0 = mysql_query($sqlprewait);
          while($dataprepwait = mysql_fetch_array($result_d0)) {
            array_push($arStart,$dataprepwait['dStart_time']);
          }

    $sqlolahpros='select a.dStart_time,a.dFinish_time
          from kanban.kbn_qc_mesin_waiting_detail a
          where a.qc_mesin_waiting_id="'.$datas['qc_mesin_waiting_id'].'"
          and a.iFlow_qc_id=4
          and a.iDeleted=0
          and a.isProses=1';
          $result_d1 = mysql_query($sqlolahpros);
          while($dataolahpros = mysql_fetch_array($result_d1)) {
            array_push($arFinish,$dataolahpros['dFinish_time']);
          }
    }
    if(empty($arStart) or empty($arFinish)){
      return 0;
    }else{
      return selisihHari(min($arStart),max($arFinish),$ijenis);
    }
  }



}
