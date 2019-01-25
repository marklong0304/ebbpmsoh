<style type="text/css">
	.boxed {
	  display: inline-block;
	  border: 1px solid black ;
	  width: 150px;
	  height: 100px;
	  color: black bold;
	  text-align: center;
	  
	  position: relative;

	} 


	
	span.sc {
	  display: inline-block;
	  vertical-align: middle;
	  font-size: 18px;
	}




</style>

<?php 
	foreach ($rows as $row ) {
		$sqllstlog='select * from hrd.scheduler_log a 
		where a.iMaster_Scheduler_id="'.$row['iMaster_Scheduler_id'].'"
		order by a.iScheduler_log_id DESC limit 1';
		$datallog= $this->db_schedulercheck->query($sqllstlog)->row_array();	

		if (empty($datallog)) {
			$color = 'grey';
			$time='-';
		}else{
			if ($datallog['iStatus']<>0) {
				$color = 'Green';	
			}else{
				$color = 'red';	
			}
			$time=$datallog['dCreate'] ;
		}

 ?>
 	<div class="boxed" style="background:<?php echo $color ?>;">

	  
	  <span class='sc'>
	  		<strong><?php echo  $row['vNama_Scheduler'] ?> </strong>

	  </span>
	  	  		<br>	
	  		<?php echo $time ?>
	</div>


<?php 
}
?>