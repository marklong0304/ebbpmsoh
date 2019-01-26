<style type="text/css">
    .datagrid1 table { border-collapse: collapse; text-align: left; width: 100%; } .datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 1px solid #006699; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }.datagrid table td, .datagrid table th { padding: 3px 10px; }.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; color:#FFFFFF; font-size: 15px; font-weight: bold; border-left: 1px solid #0070A8; } .datagrid table thead th:first-child { border: none; }.datagrid table tbody td { color: #00496B; border-left: 1px solid #E1EEF4;font-size: 12px;font-weight: normal; }.datagrid table tbody .alt td { background: #E1EEF4; color: #00496B; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }.datagrid table tfoot td div { border-top: 1px solid #006699;background: #E1EEF4;} .datagrid table tfoot td { padding: 0; font-size: 12px } .datagrid table tfoot td div{ padding: 2px; }.datagrid table tfoot td ul { margin: 0; padding:0; list-style: none; text-align: right; }.datagrid table tfoot  li { display: inline; }.datagrid table tfoot li a { text-decoration: none; display: inline-block;  padding: 2px 8px; margin: 1px;color: #FFFFFF;border: 1px solid #006699;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; }.datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover { text-decoration: none;border-color: #006699; color: #FFFFFF; background: none; background-color:#00557F;}div.dhtmlx_window_active, div.dhx_modal_cover_dv { position: fixed !important; }
</style>
<table border="1" style="border-collapse:collapse;" class="datagrid">
		<thead class="pala">

			<th style="width:200px;">
				PIC
			</th>
			<?php
				$date1= $firstday;
				while ( strtotime($date1) <= strtotime($lastday)) {
					echo '<th style="width:80px;" class="pala">';
					$time = new DateTime($date1);
					$rdate = $time->format('d-M');

			        echo $rdate;
			        echo '</th>';
			?>

			<?php 
					$date1 = date("Y-m-d" , strtotime("+1 day",strtotime($date1)));
				}
			 ?>
		</thead>
		<tbody>

			
				<?php 
					$allpic = str_replace('"', '', $allpic);
					$allpic = explode(",",$allpic);
				//	print_r($allpic);
				//	print_r($datas);
					foreach ($datas as $data) {
						//if (in_array($data['cNip'], $allpic)  ) {
							
						
				 ?>
							<tr>
								<td >
									<?php 
										$sqlem = 'select * from hrd.employee a where a.cNip="'.$data['cNip'].'" ';
										$datai = $this->db_schedulercheck->query($sqlem)->row_array();

										echo $datai['vName'] ;
									?>
								</td>
								<?php
									$date2= $firstday;
									while ( strtotime($date2) <= strtotime($lastday)) {
										$sqlisi = 'select count(*) as jum from hrd.master_jadwal_pic a where a.lDeleted=0 and a.cPic= "'.$data['cNip'].'"  and a.dDate ="'.$date2.'" ';
										$isi = $this->db_schedulercheck->query($sqlisi)->row_array();

									$holiday = '';
	                                if(date('N', strtotime($date2)) > 5) $holiday = 'holiday';

	                                $current_date=date("Y-m-d",strtotime($date2));
	                               // if(is_holiday($current_date)) $holiday = 'holiday';

										
								?>
									<td style="text-align:center;" class="<?php echo $holiday ?>">
								        <input type="checkbox" name="<?php echo $data['cNip'] ?>[dDate][]" value="<?php echo $date2 ?>" <?php echo ($isi['jum']>'0')?'checked':'' ?> >
								    </td>

								<?php 
										$date2 = date("Y-m-d" , strtotime("+1 day",strtotime($date2)));
									}
								 ?>

							</tr>		
				<?php 
						//}
					}
				?>
			
		</tbody>
</table>	

<script type="text/javascript">
	$(".holiday").css("background-color","#d2d2d2");
	$(".pala").css("background-color","#d2d2d2");
	
	$(".tanggal").datepicker({changeMonth:true,
							changeYear:true,
							dateFormat:"yy-mm-dd" });
</script>