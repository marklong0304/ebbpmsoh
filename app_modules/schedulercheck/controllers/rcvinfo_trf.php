<?php 

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
    shell_exec("curl  'http://10.1.49.54/controllers/rcvinfo.php?kode=".$cKode_area."&cPic=".$cPic."'");
    echo "<br>";

  }
}else{

  echo "No Update";
}
    
  
?>