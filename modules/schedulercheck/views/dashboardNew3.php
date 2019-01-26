<div id="bodydash">
	<div class="mask">
	  <div class="colleft">
	        
	    <div class="col1">
	        <div class="headerR">
	          Scheduler tidak memiliki PIC
	        </div> 
	        <div style="" id="tabel2">
	        	<div  class="kolomalert" id="kolomalert" >
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
				    				if ($noname['isAda']<>0) {
				    					//ada jadwal 
				    				}else{
				    		?>
				    			<tr>
					    			<td><?php echo $i ?></td>
					    			<td><?php echo $noname['vNama_Scheduler'] ?></td>
				    			</tr>	
				    		<?php 
				    			$i++;
				    			}
				    		} ?>
				    		
				    	</tbody>
				    </table>
			    </div> 

	        </div>
	    </div>
	    <div class="col2">
	        <div class="headerL">
	          Scheduler Dashboard
	        </div> 
	        <div style="" id="tabel1"> 
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
						            	$sq = 'select c.SSID
												from  hrd.scheduler_alert c 
												left join hrd.ss_raw_problems d on d.id=c.SSID 
												where c.lDeleted=0
												and c.ischeduler_log_id= "'.$row['ischeduler_log_id'].'"
												limit 1';
										$dq = $this->db_schedulercheck->query($sq)->row_array();
										
										if (!empty($dq)) {
											$valle=$dq['SSID'];
										}else{
											$valle='';
										}

						              //$value = $row['SSID'];
										$value = $valle;
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
	    </div> 
	  </div>
	</div>
	<div class="wrapper">
	    <div class="content">
	        <div class="headerC">
	          History Scheduler
	        </div> 
	        <div style="" id="tabel3"> 
    			<div id="dashcontent" class="dashcontent">
		            <div class="dashcontent1 ">
		              <table width="60%" style="border-collapse:collapse; margin-bottom:1%;">
			                <tr>
			                  <td width="15%" style="padding-left:2%;" >Scheduler Name </td>
			                  <td width="15%" >
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

			                  <td width="5%">Date</td>
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
		                  <?php 
		                  	if (empty($arr2)) {
		                  		// tidak ada error 
		                  ?>
		                  	<div id="inidiagrambersih">
		      					
		                  	</div>
		                  <?php 
		                  	}else{
		                   ?>

		                  	<div id="inidiagram">
		      					
		                  	</div>

		                  <?php 
		                  	}
		                   ?>
		                 
		                    
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

				                                 $dlink=explode("/",base_url());
											     $dlink[3]="ss";
											     $linkss=implode("/",$dlink);
											     $url_edit =  $linkss."rawproblems/detail/$value";

				                                  	 // if($_SERVER["HTTP_HOST"] == 'www.npl-net.com'){
				                                    //       //production
				                                    //       $url_edit = "http://www.npl-net.com/ss/rawproblems/detail/$value";
				                                          

				                                    //   }else if ($_SERVER["HTTP_HOST"] == 'dev.npl-net.com'){
				                                    //       //development
				                                    //       $url_edit =  $linkss."rawproblems/detail/$value";

				                                    //   }else {
				                                          
				                                    //       //local
				                                    //       $url_edit = "http://localhost/ss/rawproblems/detail/$value";
				                                          
				                                    //   }


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
	    </div>         
	</div>
</div>	
<style type="text/css">
	.tehead{
		background-color: #5c9ccc;
	}
	.dashcontent2left{
	  width: 20%;
	  float: left;
	  text-align: center;
	  position: center;
	  

	}
	#inidiagram{
		padding-left: 15%;
	}

	.dashcontent2right{
	  width: 78%;
	  float: left;
	}

	#bodydash{
		height:87vh;
		width: 100%;
	}

    #tabel1{
      float: left;
      box-shadow: 0px 0px 2px rgb(0, 0, 0); opacity: 1;
      background-color: #fff;
      height: 99%;
      width: 99%;
    }
    #tabel2{
      float: left;
      box-shadow: 0px 0px 2px rgb(0, 0, 0); opacity: 1;
      background-color: #fff;
      height: 99%;
      width: 99%;
    }
    #tabel3{
      float: left;
      
      box-shadow: 0px 0px 2px rgb(0, 0, 0); opacity: 1;
      background-color: #fff;
      height: 88%;
      width: 98%;
      margin-left: 1%;

    }
    .mask{
       position: relative;
       overflow: hidden;
       width: 100%;
       height: 50%;
       
    }
    .header{
       text-align: center;
       float: left;
       width: 100%;
       
    }
    .headerR{
       text-align: left;
       float: left;
       width: 100%;
       font-size: 14px;
       font-family: Georgia, serif;
       margin-bottom: 2%;
       
    }

    .headerL{
       text-align: left;
       float: left;
       width: 100%;
       font-size: 14px;
       font-family: Georgia, serif;
       margin-bottom: 1%;
       
    }

    .headerC{
       text-align: left;
       float: left;
       width: 100%;
       font-size: 14px;
       font-family: Georgia, serif;
       margin-bottom: 1%;
       margin-left: 1%;
       
    }

    .colleft{
       position: relative;
       width: 100%;
       right: 25%;
    }
    .col1{
      /*RIGHT*/
       position: relative;
       float: left;
       width: 23%;
       height: 91%;
       left: 101%;
       
    }
    .col2{
      /*LEFT*/
       position: relative;
       float: left;
       width: 73%;
       left: 3%;
       height: 91%;

    }
    .footer{
       float: left;
       width: 100%;
       
    }

    .wrapper{
       
       width: 100%;
       height: 50%;
       margin-top: 1%;
       
    }

    .content{
       float: left;
       width: 100%;
       height: 100%;
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
            height:    300,
            colModal: [
            	{ width: 50, align: 'Right' },
                { width: 200, align: 'Left' },
                { width: 150},
                { width: 80, align: 'Center' },
                { width: 200, align: 'Center' },
                { width: 80, align: 'Center' },
                { width: 120, align: 'Center' },
                
            ],
            sort: false
        });

       	$('#tabelalert').fxdHdrCol({
            width:     "100%",
            height:    300,
            colModal: [
            	{ width: 30, align: 'Right' },
                { width: 250, align: 'Left' },
                
            ],
            sort: false
        });

    });




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

       


        $("#inidiagram").sparkline([<?php echo $arr2 ?>], {
		    type: 'pie',
		    width: '250',
		    height: '150',
		    sliceColors: [<?php echo $kol ?>],
		    borderWidth: 0
		});

		$("#inidiagrambersih").sparkline([0], {
		    type: 'pie',
		    width: '250',
		    height: '150',
		    sliceColors: ["green"],
		    borderWidth: 0
		});



    });
</script>


<?php 

// load content 
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
	// trigger search 

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

