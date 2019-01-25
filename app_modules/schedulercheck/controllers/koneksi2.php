<?php 

$host = '10.1.49.6';
$user = 'erp_scheduler';
$pass = 'H?zdwDb[kU1z%}@)';
$db='hrd';
/*$host = '10.1.49.221';
$user = 'robot_dbf_sql_01';
$pass = 'Robot_dbf_sql_01';
$db='purchase';*/
$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
  die('Error : '.mysqli_error());
}

?>