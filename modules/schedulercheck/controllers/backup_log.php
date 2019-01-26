 
        <?php
          
           $host = '10.1.49.6';
           $user = 'nplnet';
           $pass = 'nplnet01';
           $db='hrd';

              $conn = mysql_connect($host, $user, $pass);
              if ($conn) {
                  mysql_select_db($db, $conn);
              } else {
                 die('Error : '.mysql_error());
              }
          
               
              echo "HATI - HATI data akan dihapus Permanen !!!!!!!!!<br>";
              $sql_cek = 'SELECT sl.* , TIMESTAMPDIFF(MONTH,sl.`dCreate`,NOW()) AS cekBulan FROM hrd.`scheduler_log` sl WHERE TIMESTAMPDIFF(MONTH,sl.`dCreate`,NOW()) > 6'; 

              if(!mysql_query($sql_cek)){
                 echo $sql_cek.'<br>';
                 die('Mysql Failed 4 - '.mysql_error());
              } else {
                 	echo 'Cecking success ...<br>';
                 	$rowUdah = mysql_fetch_array(mysql_query($sql_cek));
					if (empty($rowUdah)) {
						echo "Data Kosong ....<br>!!"; 
					}else{
						while($r = mysql_fetch_array(mysql_query($sql_cek))){ 
							$que = "INSERT INTO hrd.`scheduler_log_backup` (`iScheduler_log_id`, `iMaster_Scheduler_id`, `iStatus`, `dScoreLog`, `dCreate`, `lDeleted`, `vErrorLogs`, `STATUSBACKUP`) VALUES ('".$r['iScheduler_log_id']."', '".$r['iMaster_Scheduler_id']."', '".$r['iStatus']."', '".$r['dScoreLog']."', '".$r['dCreate']."','".$r['lDeleted']."', '".$r['vErrorLogs']."', 'BACKUP--DELETE')";
							if(!mysql_query($que)){
			                 	echo $que.'<br>';
			                 	die('Mysql Failed 4 - '.mysql_error());
			              	}else{
			              		echo 'Insert Success ...<br>';
			              	} 
						}

						$hapus = "DELETE FROM hrd.`scheduler_log` WHERE TIMESTAMPDIFF(MONTH,`dCreate`,NOW()) > 6";
						if(!mysql_query($hapus)){
		                 	echo $que.'<br>';
		                 	die('Mysql Failed 4 - '.mysql_error());
		              	}else{
		              		echo 'Delete Success ...<br>';
		              	} 
					}
              }
 
                    
             