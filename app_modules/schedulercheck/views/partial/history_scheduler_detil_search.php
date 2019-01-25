<script type="text/javascript">
    $(document).ready(function() {
        $('#dataeses').fxdHdrCol({
            fixedCols: 2,
            width:     "100%",
            height:    200,
            colModal: [
              { width: 50, align: 'Right' },
                { width: 120, align: 'Center' },
                { width: 300, align: 'Left' },
                { width: 150, align: 'Left'},
                { width: 80, align: 'Center' },
                { width: 120, align: 'Center' },
                { width: 120, align: 'Center'},
                { width: 120, align: 'Center'},
                
            ],
            sort: false
        });

    });
</script>
<style type="text/css">
	.tehead{
	   background-color: #5c9ccc;
	}
	#dashdatabody tr:nth-child(odd) {
	   background-color: #ccc;
	}

	#bodyeses tr:nth-child(odd) {
	   background-color: #ccc;
	}

	#bodyalert tr:nth-child(odd) {
	   background-color: #ccc;
	}

	.dashcontent2left{
	  width: 20%;
	  float: left;

	}

	.dashcontent2right{
	  width: 78%;
	  float: left;
	}


</style>

	<div class="dashcontent2left">
			<div id="inidiagram">
				
			</div>
	</div>

	<div class="dashcontent2right" >
		<table id="dataeses" >
			<thead class="tehead">
				<th>No</th>
				<th>
                	Log Date
                </th>
                <th>
                  Error Message
                </th>
				<th>PIC</th>
				<th>SSID</th>
				<th>Start</th>
				<th>Finish</th>
				<th>Duration</th>
			</thead>
			<tbody id="bodyeses">
				<?php 
					//print_r($rows);
					$i=1;	
					foreach ($rows as $row ) {
					
				?>
				<tr>
					<td><?php echo $i ?></td>
					<td><?php echo $row['dlog'] ?></td>
                    <td><?php echo $row['vErrorLogs'] ?></td>
					<td><?php echo $row['vpic'] ?></td>
					<td>
						<?php 
							$value = $row['SSID'];
							if($_SERVER["HTTP_HOST"] == 'www.npl-net.com'){
					            //production
					            $url_edit = "http://www.npl-net.com/ss/rawproblems/detail/$value";
					            

					        }else if ($_SERVER["HTTP_HOST"] == 'dev.npl-net.com'){
					            //development
					            $url_edit = "http://dev.npl-net.com/ss/rawproblems/detail/$value";

					        }else {
					            
					            //local
					            $url_edit = "http://localhost/ss/rawproblems/detail/$value";
					            
					        }


					        if ($value <> "") {
					            
					            $valval = "<a style='color:blue;' class='hrefSmooth' href='javascript:void(0);' title='".$value."' onclick=\"window.open('".$url_edit."', '_blank', 'width=800,height=600,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0,top=10,left=10');\">$value</a>";
					        }else{
					            $valval = '';
					        }
						 ?>
						<?php echo $valval  ?>

					</td>
					<td><?php echo $row['date_posted'] ?></td>
					<td><?php echo $row['tMarkedAsFinished'] ?></td>
					<td><?php echo $row['durasi'] ?></td>
				</tr>
				<?php 
					$i++;
					}
				 ?>
			</tbody>
		</table>
	</div>

<!-- DivTable.com -->

<script type="text/javascript">
    $("#inidiagram").sparkline([<?php echo $red ?>,<?php echo $ijo ?>], {
    type: 'pie',
    width: '250',
    height: '150',
    sliceColors: ['#c10505','#3aba13'],
    borderWidth: 0});

</script>

<?php 
    $url_memo_launch = base_url()."processor/schedulercheck/partial/view?action=gettabeldatadashdate";  
    $url_header = base_url()."processor/schedulercheck/partial/view/?action=gettabeldatadashsrcdate"; 
?>

<script type="text/javascript">

      $("#btsrc_sc").die();
      $("#btsrc_sc").live("click",function(){
        
    	 $.ajax({
	           url: '<?php echo $url_memo_launch  ?>', 
	           type: "POST", 
	           data: {
	                  iMaster_Scheduler_id: $("#src_iMaster_Scheduler_id").val(),
	                  src_startdate: $("#src_startdate").val(),
	                  src_finishdate: $("#src_finishdate").val(),
	                  }, 
	           success: function(response){
	               $(".dashcontent2").html(response);
	           }

	      });

	      $.ajax({
	                url: '<?php echo $url_header  ?>',
	                type: "post",
	                data: {
	                  iMaster_Scheduler_id: $("#src_iMaster_Scheduler_id").val(),
	                  src_startdate: $("#src_startdate").val(),
	                  src_finishdate: $("#src_finishdate").val(),
	                  },
	                dataType: "json",
	                success: function( data ) {
	                    
	                    $.each(data, function(index, element) {
	                      $("#src_iMaster_Scheduler_id").val(element.iMaster_Scheduler_id);
	                      $("#src_startdate").val(element.periodeawal);
	                      $("#src_finishdate").val(element.periodeakhir);
	          


	                    })
	                }

	                
	      })

      })
</script>
