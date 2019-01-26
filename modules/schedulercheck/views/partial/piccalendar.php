<style type="text/css">
    .datagrid table { border-collapse: collapse; text-align: left; width: 100%; } .datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 1px solid #006699; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }.datagrid table td, .datagrid table th { padding: 3px 10px; }.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; color:#FFFFFF; font-size: 15px; font-weight: bold; border-left: 1px solid #0070A8; } .datagrid table thead th:first-child { border: none; }.datagrid table tbody td { color: #00496B; border-left: 1px solid #E1EEF4;font-size: 12px;font-weight: normal; }.datagrid table tbody .alt td { background: #E1EEF4; color: #00496B; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }.datagrid table tfoot td div { border-top: 1px solid #006699;background: #E1EEF4;} .datagrid table tfoot td { padding: 0; font-size: 12px } .datagrid table tfoot td div{ padding: 2px; }.datagrid table tfoot td ul { margin: 0; padding:0; list-style: none; text-align: right; }.datagrid table tfoot  li { display: inline; }.datagrid table tfoot li a { text-decoration: none; display: inline-block;  padding: 2px 8px; margin: 1px;color: #FFFFFF;border: 1px solid #006699;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; }.datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover { text-decoration: none;border-color: #006699; color: #FFFFFF; background: none; background-color:#00557F;}div.dhtmlx_window_active, div.dhx_modal_cover_dv { position: fixed !important; }
</style>
<div id="bodysearch">
	 <table width="45%" style="border-collapse:collapse;margin-bottom:2%;margin-left:2%;" >
                <tr >
            		<td>PIC </td>
	                <td colspan="4">
	                    <?php 
	                    	echo $elPic

	                     ?>


		            </td>

	                <td width="5%">Date</td>
	                <td width="20%">
	                   : <input type="text" name="startdate" class="tanggal"  id="src_jadwal_start" value="<?php echo $periodeawal ?> " class=" tanggal input_rows1 required" size="8" />
	                </td>
	                <td width="5%">to</td>
	                <td width="20%">
	                   : <input type="text" name="finishdate" class="tanggal" id="src_jadwal_end" value="<?php echo $periodeakhir ?> " class=" tanggal input_rows1 required" size="8" />
	                </td>
	                <td width="5%">
	                    <span  id="btsrc_jadwal"  class=" ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary buttonserch">Search</span>

	                </td>
                </tr>
              </table>

</div>
<style type="text/css">
	.tehaPic{
		width:350px;
	}
</style>
<div id="bodytabelpic" style="margin-left:2%;">
	<table border="1" style="border-collapse:collapse;" class="datagrid">
		<thead>
			<tr>
					

			<th class="tehaPic pala">
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
			</tr>
		</thead>
		<tbody>
			
				<?php 
					foreach ($datas as $data) {
						if ($meNip == $data['cPic']) {
							
						
				 ?>
							<tr>
								<td>
									<?php 
										$sqlem = 'select * from hrd.employee a where a.cNip="'.$meNip.'" ';
										$datai = $this->db_schedulercheck->query($sqlem)->row_array();

										echo $datai['vName'] ;
									?>
								</td>
								<?php
									$date2= $firstday;
									while ( strtotime($date2) <= strtotime($lastday)) {
										$sqlisi = 'select count(*) as jum from hrd.master_jadwal_pic a where a.lDeleted=0 and a.cPic= "'.$meNip.'"  and a.dDate ="'.$date2.'" ';
										$isi = $this->db_schedulercheck->query($sqlisi)->row_array();

										$holiday = '';
		                                if(date('N', strtotime($date2)) > 5) $holiday = 'holiday';

		                                $current_date=date("Y-m-d",strtotime($date2));
		                                if($this->auth->is_holiday($current_date)) $holiday = 'holiday';

										
								?>
									<td style="text-align:center;" class="<?php echo $holiday ?>">
								        <input type="checkbox" name="<?php echo $data['cPic'] ?>[dDate][]" value="<?php echo $date2 ?>" <?php echo ($isi['jum']>'0')?'checked':'' ?> >
								    </td>

								<?php 
										$date2 = date("Y-m-d" , strtotime("+1 day",strtotime($date2)));
									}
								 ?>


								
								 
							</tr>		
				<?php 
						}
					}
				?>
			
		</tbody>
	</table>	
</div>

<?php 
    $url_get_jadwal = base_url()."processor/schedulercheck/partial/view?action=getJadwal";  
?>

<script type="text/javascript">
		$(".holiday").css("background-color","#d2d2d2");
		$(".pala").css("background-color","#d2d2d2");

      $("#btsrc_jadwal").die();
      $("#btsrc_jadwal").live("click",function(){
        
       $.ajax({
             url: '<?php echo $url_get_jadwal  ?>', 
             type: "POST", 
             data: {
             		allpic :$("#allpic").text(),
             		cboPic :$("#cboPic").val(),
                    src_jadwal_start: $("#src_jadwal_start").val(),
                    src_jadwal_end: $("#src_jadwal_end").val(),
                    }, 
             success: function(response){
                 $("#bodytabelpic").html(response);
             }

        });

        

      })
</script>

<script type="text/javascript">
	$(".tanggal").datepicker({changeMonth:true,
							changeYear:true,
							dateFormat:"yy-mm-dd" });
</script>
