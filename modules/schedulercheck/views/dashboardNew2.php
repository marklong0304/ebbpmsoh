<!--
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()?>assets/jquery-ui-1.10.0.custom.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()?>assets/jquery.tablesorter.js" />
-->


<style type="text/css">
	.mask{
	   position: relative;
	   overflow: hidden;
	   margin: 0px auto;
	   width: 100%;
	   height:100%;
	

	}


	.colleft{
	   position: relative;
	   width: 100%;
	   height: 100%;
	   margin-top: 2%;

	}
	.col1{
	   position: relative;
	   overflow: hidden;
	   float: left;
	   width: 70%;

	}
	.col2{
	   position: relative;
	   overflow: hidden;
	   float: left;
	   width: 29%;

	}
	.footer{
	   float: left;
	   width: 100%;
	   background-color: #b4caf7
	}
	.dashheader{
	   width: 100%;
	   height: 300px;
	   overflow-y: auto;
	   margin-left: 17%;
		

	}


	.dashheader2{
	   width: 100%;
	   height: 120px;
	   overflow: scroll;
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


<script type="text/javascript">
    $(document).ready(function() {
        $('#dashdata').fxdHdrCol({
            width:     "100%",
            height:    400,
            colModal: [
            	{ width: 50, align: 'Right' },
                { width: 200, align: 'Left' },
                { width: 100},
                { width: 100, align: 'Center' },
                { width: 150, align: 'Center' },
                { width: 80, align: 'Center' },
                { width: 80, align: 'Right' },
                
            ],
            sort: false
        });
    });

     $(document).ready(function() {
         $('#dataeses').fxdHdrCol({
            fixedCols: 3,
            width:     "100%",
            height:    120,
            colModal: [
            	{ width: 50, align: 'Right' },
                { width: 150, align: 'Left' },
                { width: 120, align: 'Center'},
                { width: 200, align: 'Center' },
                { width: 80, align: 'Center' },
                { width: 120, align: 'Center'},
                { width: 120, align: 'Center'},
                { width: 120, align: 'Center'},
                
            ],
            sort: false
        });

        $('#tabelalert').fxdHdrCol({
            width:     "100%",
            height:    180,
            colModal: [
            	{ width: 50, align: 'Right' },
                { width: 200, align: 'Left' },
                
            ],
            sort: false
        });

    });

</script>




<div class="mask">
    <div class="header">
    	<span style="text-align:center;"><h3>Scheduler Dashboard</h3></span>
		  <div class="dashheader">
		    <table id="dashdata">
		      <thead class ="tehead">
			        <tr class="header-data">
			        	<th class="nomb">
			        		No
			        	</th>
				        <th>
						  Schedule Name
			            </th>
			            <th>
			              Last Run
			            </th>
			            <th>
			              Alert
			            </th>
			            <th>
			              PIC
			            </th>
			            <th>
			              SSID
			            </th>
			            <th>
			              Status
			            </th>
			        </tr>
		      </thead>
		        <tbody id="dashdatabody">
		            <?php 
		              $i=1;
		              $t = 5000;
		              foreach ($rowssch as $row ) {
		                if ($i <> 1) {
		                  $tt = $t*2;  
		                }else{
		                  $tt = $t;
		                }
		                  
		                if ($row['iStatus']<>1) {
		                   $kolkol = '#c10505';                 
		                }else{
		                   $kolkol = 'green';                 
		                }   
		                $iMaster_Scheduler_id = $row['iMaster_Scheduler_id']; 

		              ?>

		              <tr   id="teer_<?php echo $iMaster_Scheduler_id  ?>" idscheduler="<?php echo $row['iMaster_Scheduler_id'] ?>">
		                <td><?php echo $i ?></td>
		                <td>
		                  <?php echo $row['vNama_Scheduler']  ?>
		                </td>
		                <td>
		                  <?php echo $row['dScoreLog']  ?>
		                </td>
		                <td style="background-color:<?php echo $kolkol  ?>">
		                  
		                </td>
		                <td>
		                  <?php 
		                    $iMaster_Scheduler_id = $row['iMaster_Scheduler_id']; 


		                    $sqlcqjenis='select * from hrd.master_scheduler a where a.iMaster_Scheduler_id=
		                            "'.$iMaster_Scheduler_id.'"
		                        ';
		                    $datajen= $this->db_schedulercheck->query($sqlcqjenis)->row_array();

		                    if ($datajen['vtype_scheduler']==1) {
		                        // jika tipe group, cari membernya siapa saja 
		                        $sqlcqmmber='select * 
		                                        from hrd.scheduler_group_pic a
		                                        join hrd.scheduler_group_pic_detail b on b.iScheduler_grppic_id=a.iScheduler_grppic_id
		                                        where a.lDeleted=0
		                                        and b.lDeleted=0
		                                        and a.iScheduler_grppic_id=
		                                        "'.$datajen['iScheduler_grppic_id'].'"
		                                    ';
		                        $datammbr= $this->db_schedulercheck->query($sqlcqmmber)->result_array();
		                        $picnya=''; 
		                        $picnyains='';  
		                        if (!empty($datammbr)) {
		                                $ii=1;
		                                foreach ($datammbr as $dm ) {
		                                    if ($ii > 1) {
		                                        $picnya .= ', '.$dm['vnip'].'';
		                                        $picnyains .= ' , '.$dm['vnip'];
		                                    }else{
		                                        $picnya .= ''.$dm['vnip'].'';
		                                        $picnyains .= ' , '.$dm['vnip'];
		                                    }
		                                    $ii++;
		                                }

		                        }
		                    }else{
		                        // jika tipe solo , maka ambil cPIC nya 
		                        $picnya= $datajen['cPic'];
		                        $picnyains= '"'.$datajen['cPic'].'"';
		                        
		                    }

		                    echo $picnya;


		                  ?>
		                </td>
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
		                <td>
		                  <?php echo $row['setatus']  ?>
		                </td>
		              </tr>

		              <?php 
		                $url_memo_launch = base_url()."processor/schedulercheck/partial/view?action=gettabeldatadash";  
		                $url_header = base_url()."processor/schedulercheck/partial/view/?action=gettabeldatadashsrc"; 
		              ?>

		               <script type="text/javascript">
		                  $("#teer_<?php echo $iMaster_Scheduler_id  ?>").die();
		                  $("#teer_<?php echo $iMaster_Scheduler_id  ?>").live("click",function(){
		                  
		                      $.ajax({
		                           url: '<?php echo $url_memo_launch  ?>', 
		                           type: "POST", 
		                           data: {
		                                  iMaster_Scheduler_id: $(this).attr("idscheduler"),
		                                  }, 
		                           success: function(response){
		                               $(".dashcontent2").html(response);
		                           }

		                      });

		                      $.ajax({
		                                url: '<?php echo $url_header  ?>',
		                                type: "post",
		                                data: {
		                                  iMaster_Scheduler_id: $(this).attr("idscheduler"),
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
		            
		            <?php 
		              $i++;
		              $t+=500;
		            } 
		              $tt=($t*2)+1000;
		            ?>
	          	</tbody>
		    </table>
		  </div>
	</div> 
    <div class="colleft">
	    <div class="col1">
	        <div id="dashcontent" class="dashcontent">
	            <div class="dashcontent1 ">
	              <table width="60%" style="border-collapse:collapse; margin-bottom:1%;">
		                <tr>
		                  <td>Scheduler Name </td>
		                  <td colspan="4">
		                     <?php 
		                      $sql_sc = 'select * from hrd.master_scheduler a where a.lDeleted=0 order by a.vNama_Scheduler';
		                      $rows = $this->db_schedulercheck->query($sql_sc)->result_array();

		                      $o  = "<select name='iMaster_Scheduler_id' id='src_iMaster_Scheduler_id' >";    
		                          $o .= "<option  value='all'>All</option>";    
		                      foreach($rows as $row) {
		                          $o .= "<option  value='".$row['iMaster_Scheduler_id']."'>".$row['vNama_Scheduler']."</option>";
		                      }            
		                      $o .= "</select>";

		                      echo $o;
		                      ?>


		                  </td>
		                  
		                </tr>
		                <tr>
		                  <td width="30%">Date</td>
		                  <td width="15%">
		                    : <input type="text" name="startdate"  id="src_startdate" value="<?php echo $periodeawal ?> " class=" tanggal input_rows1 required" size="8" />
		                  </td>
		                  <td width="5%">to</td>
		                  <td width="15%">
		                    : <input type="text" name="finishdate"  id="src_finishdate" value="<?php echo $periodeakhir ?> " class=" tanggal input_rows1 required" size="8" />
		                  </td>
		                  <td width="20%">
		                    <span  id="btsrc_sc"  class=" ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary buttonserch">Search</span>

		                  </td>
		                </tr>
	              </table>

	            </div> 

	            <div class="dashcontent2"  >
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
	                          if ($i > 1) {
	                            $arr2 .= ','.$redi['jumred'];
	                            
	                          }else{
	                            $arr2 .= $redi['jumred'];
	                          }
	                                  

	                          array_push($arr, $redi['jumred']);
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
			                            	Date
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
			                                $md5 = md5($i);
			                                $kolor = '#'.substr($md5, 0,6);
			                                if ($i > 1) {
			                                  $kol .= '",'.$kolor.'"';
			                                  
			                                }else{
			                                  $kol .= '"'.$kolor.'"';
			                                }
			                            ?>
			                            <tr>
			                              <td><?php echo $i ?></td>
			                              <td style="background-color:<?php echo $kolor ?>;"><?php echo $row['vNama_Scheduler'] ?></td>
			                              <td><?php echo $row['mulai'] ?></td>
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
			            
	            </div> 
	        </div> 	  
	    </div>

	    <div  class="col2 kolomalert" id="kolomalert" >
		    <table id="tabelalert" width="98%"  border="1" style="border-collapse:collapse;">
		    	<thead class="tehead">
		    		<tr>
			    		<th>No</th>
			    		<th>Nama Scheduler</th>
		    		</tr>
		    	</thead>
		    	<tbody id="bodyalert">
		    		<?php 

		    			$i=1;
		    			foreach ($nonames as $noname){
		    		?>
		    			<tr>
			    			<td><?php echo $i ?></td>
			    			<td><?php echo $noname['vNama_Scheduler'] ?></td>
		    			</tr>	
		    		<?php 
		    		$i++;
		    		} ?>
		    		
		    	</tbody>
		    </table>
	    </div> 
	</div>

    
</div>



<style type="text/css">
	.tehead{
		background-color: blue;
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
<script type="text/javascript">
    $("#inidiagram").sparkline([<?php echo $arr2 ?>], {
    type: 'pie',
    width: '250',
    height: '150',
    sliceColors: [<?php echo $kol ?>],
    borderWidth: 0});

</script>    

<?php 
    $url_memo_launch1 = base_url()."processor/schedulercheck/partial/view?action=gettabeldatadashdate";  
    $url_header1 = base_url()."processor/schedulercheck/partial/view/?action=gettabeldatadashsrcdate"; 
    $url_noname = base_url()."processor/schedulercheck/partial/view/?action=getnonames"; 

    $url_divheader1 = base_url()."processor/schedulercheck/partial/view/?action=getheader1"; 
    $url_divheader2 = base_url()."processor/schedulercheck/partial/view/?action=getheader2"; 
    $url_divalert = base_url()."processor/schedulercheck/partial/view/?action=getalert"; 
?>

<script type="text/javascript">
  

  function loadContent(){
        // load data detil and diagram
        $.ajax({
             url: '<?php echo $url_memo_launch1  ?>', 
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

        // load value of search
        $.ajax({
                  url: '<?php echo $url_header1  ?>',
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
         
        });

        
         
        // GET HEADER 2 , data scheduler log
        $.ajax({
             url: '<?php echo $url_divheader2  ?>', 
             type: "POST", 
             data: {
                    iMaster_Scheduler_id: $("#src_iMaster_Scheduler_id").val(),
                    src_startdate: $("#src_startdate").val(),
                    src_finishdate: $("#src_finishdate").val(),
                    }, 
             success: function(response){
                 $(".dashheader").html(response);
             }

        });

        // load noname
        $.ajax({
                  url: '<?php echo $url_noname  ?>',
                  type: "post",
                  data: {
                    iMaster_Scheduler_id: $("#src_iMaster_Scheduler_id").val(),
                    src_startdate: $("#src_startdate").val(),
                    src_finishdate: $("#src_finishdate").val(),
                    },
                success: function(response){
                	$("#kolomalert").html(response);
             	}

         
        });

      



  }

 // loadContent(); // This will run on page load
  setInterval(function(){
      loadContent() // this will run after every 5MENIT
  }, 500000);



</script>

<?php 
    $url_memo_launch11 = base_url()."processor/schedulercheck/partial/view?action=gettabeldatadashdate";  
    $url_header11 = base_url()."processor/schedulercheck/partial/view/?action=gettabeldatadashsrcdate"; 
?>
<script type="text/javascript">

      $("#btsrc_sc").die();
      $("#btsrc_sc").live("click",function(){
        
    	 $.ajax({
	           url: '<?php echo $url_memo_launch11  ?>', 
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
	                url: '<?php echo $url_header11  ?>',
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
