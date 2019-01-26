<script type="text/javascript">
    $(document).ready(function() {
         $('#dataeses').fxdHdrCol({
            fixedCols: 3,
            width:     "100%",
            height:    200,
            colModal: [
              { width: 50, align: 'Right' },
                { width: 150, align: 'Left' },
                { width: 120, align: 'Center' },
                { width: 300, align: 'Left'},
                { width: 200, align: 'Center' },
                { width: 80, align: 'Center' },
                { width: 120, align: 'Center'},
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



</style>

<div class="dashcontent2left">
  <div id="inidiagram">
			ini diagram
  </div>
    <ul>
      <?php 
      $arr = array();
      $arr2='';
        $i=1;
        foreach ($red as  $redi) {
      ?>
       <?php 
          $rat = ($redi['jumred'] / $totallog);
                              if ($i > 1) {
                                $arr2 .= ','.$rat;
                                
                              }else{

                                $arr2 .= $rat;
                              }
                                 
                  

          array_push($arr, $rat);
          $i++;
        }
        ?>
      </ul>   
</div>  

<div class="dashcontent2right " >
	  <div class="dashheader2">
	       <table id="dataeses">
              <thead class="tehead">
              	<tr class="header-data">
                    <th>
                    	No
                    </th>
                    <th>
                    	Nama Scheduler
                    </th>
                    <th>
                    	Log Date
                    </th>
                    <th>
                      Error Message
                    </th>
                    <th>
                    	PIC
                    </th>
                    <th>
                    	SSID
                    </th>
                    <th>
                    	Start
                    </th>
                    <th>
                    	Finish
                    </th>
                    <th>
                    	Duration
                    </th>
               	</tr>
              </thead>
              	<tbody id="bodyeses">
                    <?php 
                      $i=1;
                      $kol='';
                      foreach ($rowss as $row ) {
                         $md5 = md5($row['vNama_Scheduler']);
                          $kolor = '#'.substr($md5, 0,6);
                          if ($i > 1) {
                                          if (strpos($kol, $kolor) !== false) {
                              // tidak masuk kolor, karena sudah ada 
                          }else{
                            $kol .= ',"'.$kolor.'"';    
                          }
                            
                            
                          }else{
                            $kol .= '"'.$kolor.'"';
                          }
                    ?>
                    <tr>
                      <td><?php echo $i ?></td>
                      <td style="background-color:<?php echo $kolor ?>;"><?php echo $row['vNama_Scheduler'] ?></td>
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
</div>  


<style type="text/css">
	
</style>

<script type="text/javascript">
	$(document).ready(function() {
        $("#inidiagram").sparkline([<?php echo $arr2 ?>], {
	    type: 'pie',
	    width: '250',
	    height: '150',
	    sliceColors: [<?php echo $kol ?>],
	    borderWidth: 0});

    });

    

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
