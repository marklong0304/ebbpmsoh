<style type="text/css">
.dashwrapper{
   
   width: 100%;
   height: 678px;
   background-color: #cccccc
}
.dashheader{
   
   width: 100%;
   height: 50%;
   background-color: #6699cc
}

.dashheader1{
   
   width: 100%;
   height: 30%;

}

.dashheader2{
   
   width: 100%;
   height: 250px;
   overflow: scroll;

}



.dashcontent{
   
   width: 100%;
   height: 45%;
   background-color: #99ccff
}

.dashcontent1{
   
   width: 100%;
   height: 20%;

}

.dashcontent2{
   
   width: 100%;
   height: 80%;
   

}

.dashcontent2left{
  width: 20%;
  float: left;

}

.dashcontent2right{
  width: 78%;
  float: left;
}

.dashfooter{
   float: left;
   width: 100%;

   background-color: #cfcfcf
}
.buttonserch {
    padding: 0.4em 1em 0.4em 2.1em;
}
#iMaster_Scheduler_id{
  width:300px;  
}


</style>    

    <div class="dashwrapper">
        <div class="dashheader">

          <div class="dashheader1">
            <table id="dashdatared" width="85%" border="1" style="border-collapse:collapse;margin:auto;">
              <thead id="dashdataredhead">
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
              </thead>
              <tbody id="dashdataredbody">
                <?php 
                  $i=1;
                  $t = 5000;
                  foreach ($rowsRed as $row ) {
                    $iMaster_Scheduler_id = $row['iMaster_Scheduler_id']; 
                    if ($i <> 1) {
                      $tt = $t*2;  
                    }else{
                      $tt = $t;
                    }

                    if ($row['iStatus']<>1) {
                       $kolkol = '#c10505';                 
                    }else{
                       $kolkol = '';                 
                    }   

                    
                 ?>
                  <tr class="teer"  id="teer_<?php echo $iMaster_Scheduler_id  ?>" idscheduler="<?php echo $row['iMaster_Scheduler_id'] ?>">
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
                      <?php echo $row['SSID']  ?>
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
          <div class="dashheader2">
            <table id="dashdata" width="85%" border="1" style="border-collapse:collapse;margin:auto;">
              <thead id="dashdatahead">
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

                  <tr class="teer"  id="teer_<?php echo $iMaster_Scheduler_id  ?>" idscheduler="<?php echo $row['iMaster_Scheduler_id'] ?>">
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
                      <?php echo $row['SSID']  ?>
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
        <div id="dashcontent" class="dashcontent">
            <div class="dashcontent1">
              <table width="40%" border="1" style="border-collapse:collapse;">
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

            <div class="dashcontent2">
                <div class="dashcontent2left">
                  <div id="inidiagram">
      
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
                
                <div class="dashcontent2right">
                        &nbsp; <h3>History Scheduler </h3> 
                        <table id="dataeses" border="1" style="border-collapse:collapse;" width="100%">
                          <thead>
                            <th>No</th>
                            <th>Nama Scheduler</th>
                            <th>Date</th>
                            <th>PIC</th>
                            <th>SSID</th>
                            <th>Start</th>
                            <th>Finish</th>
                            <th>Duration</th>
                          </thead>
                          <tbody>
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
        <div id="dashfooter" class="dashfooter">
            <?php 
              $piew ='<div id="news_ticker">
                        <span class="news_ticker">ALERT SCHEDULER</span>
                          <ul class="news_ticker" >';
                     
                        
              $piew .=   '</ul>
                    </div>'; 
              $piew .='<style type="text/css">
                    #news_ticker {
                        background: -moz-linear-gradient(center top , #1e5f8f, #3496df) repeat-x scroll 0 0 rgba(0, 0, 0, 0);
                        width: 100%;
                        height: 27px;
                        overflow: hidden;
                        -webkit-border-radius: 4px;
                        -moz-border-radius: 4px;
                        border-radius: 4px;
                        padding: 3px;
                        position: relative;
                       
                        -moz-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.5);
                        box-shadow: inset 0px 1px 2px rgba(0,0,0,0.5);
                    } 
                    span.news_ticker{
                        float: left;
                        color: rgba(0,0,0,.8);
                        color: #fff;
                        
                        padding: 6px;
                        position: relative;
                        border-radius: 4px;
                        font-size: 12px;
                        -webkit-box-shadow: inset 0px 1px 1px rgba(255, 255, 255, 0.2), 0px 1px 1px rgba(0,0,0,0.5);
                       
                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#004b67", endColorstr="#003548",GradientType=0 );
                    }

                    ul.news_ticker{
                        float: left;
                        padding-left: 20px;
                        -webkit-animation: ticker 10s cubic-bezier(1, 0, .5, 0) infinite;
                        -moz-animation: ticker 10s cubic-bezier(1, 0, .5, 0) infinite;
                        -ms-animation: ticker 10s cubic-bezier(1, 0, .5, 0) infinite;
                        animation: ticker 10s cubic-bezier(1, 0, .5, 0) infinite;
                    }
                    ul.news_ticker:hover {
                        -webkit-animation-play-state: paused;
                        -moz-animation-play-state: paused;
                        -ms-animation-play-state: paused;
                        animation-play-state: paused;
                    }
                    li.news_ticker {line-height: 26px;}
                    #news_ticker span.isi {
                        color: #fff;
                        text-decoration: none;
                        font-size: 13px;
                    }

                    @-webkit-keyframes ticker {
                        0%   {margin-top: 0;}
                        25%  {margin-top: -26px;}
                        50%  {margin-top: -52px;}
                        75%  {margin-top: -78px;}
                        100% {margin-top: 0;}
                    }
                    @-moz-keyframes ticker {
                        0%   {margin-top: 0;}
                        25%  {margin-top: -26px;}
                        50%  {margin-top: -52px;}
                        75%  {margin-top: -78px;}
                        100% {margin-top: 0;}
                    }
                    @-ms-keyframes ticker {
                        0%   {margin-top: 0;}
                        25%  {margin-top: -26px;}
                        50%  {margin-top: -52px;}
                        75%  {margin-top: -78px;}
                        100% {margin-top: 0;}
                    }
                    @keyframes ticker {
                        0%   {margin-top: 0;}
                        25%  {margin-top: -26px;}
                        50%  {margin-top: -52px;}
                        75%  {margin-top: -78px;}
                        100% {margin-top: 0;}
                    }
                      </style>';
       
              echo $piew


             ?>
        </div>  
    </div>

<script type="text/javascript">
       
        $.fn.infiniteScrollUp=function(){
            var self=this,kids=self.children()
            kids.slice(12).hide()
            setInterval(function(){
                kids.filter(':hidden').eq(0).fadeIn()
                kids.eq(0).fadeOut(function(){
                    $(this).appendTo(self)
                    kids=self.children()
                })
            },1000)
            return this
        }
        $(function(){
            $('#dashdatabody').infiniteScrollUp()
        })
    

        $.fn.infiniteScrollUp=function(){
              var self=this,kids=self.children()
              kids.slice(5).hide()
              setInterval(function(){
                  kids.filter(':hidden').eq(0).fadeIn()
                  kids.eq(0).fadeOut(3000,function(){
                      $(this).appendTo(self)
                      kids=self.children()
                  })
              },1500)
              return this
        }
        $(function(){
            $('#dashdataredbody').infiniteScrollUp()
        })
</script>


<style type="text/css">
  #dataeses td{
    text-align: center;
  }
  /* DivTable.com */
  .divTable{
    display: table;
    width: 100%;
  }
  .divTableCell {
    
    display: table-cell;
    padding: 3px 10px;
  }

</style>

<script type="text/javascript">
    $("#inidiagram").sparkline([<?php echo $arr2 ?>], {
    type: 'pie',
    width: '300',
    height: '200',
    sliceColors: [<?php echo $kol ?>],
    borderWidth: 0});

</script>

<?php 
    $url_memo_launch1 = base_url()."processor/schedulercheck/partial/view?action=gettabeldatadashdate";  
    $url_header1 = base_url()."processor/schedulercheck/partial/view/?action=gettabeldatadashsrcdate"; 
?>

<script type="text/javascript">

      $("#btsrc_sc").die();
      $("#btsrc_sc").live("click",function(){
        
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

                  
        })

      })
</script>


<?php 
    $url_memo_launch1 = base_url()."processor/schedulercheck/partial/view?action=gettabeldatadashdate";  
    $url_header1 = base_url()."processor/schedulercheck/partial/view/?action=gettabeldatadashsrcdate"; 

    $url_divheader1 = base_url()."processor/schedulercheck/partial/view/?action=getheader1"; 
    $url_divheader2 = base_url()."processor/schedulercheck/partial/view/?action=getheader2"; 
    $url_divalert = base_url()."processor/schedulercheck/partial/view/?action=getalert"; 
?>

<script type="text/javascript">
  

  function loadContent(){
        
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
         
        })

        // GET HEADER 1 
        $.ajax({
             url: '<?php echo $url_divheader1  ?>', 
             type: "POST", 
             data: {
                    iMaster_Scheduler_id: $("#src_iMaster_Scheduler_id").val(),
                    src_startdate: $("#src_startdate").val(),
                    src_finishdate: $("#src_finishdate").val(),
                    }, 
             success: function(response){
                 $(".dashheader1").html(response);
             }

        });
         
        // GET HEADER 2 
        $.ajax({
             url: '<?php echo $url_divheader2  ?>', 
             type: "POST", 
             data: {
                    iMaster_Scheduler_id: $("#src_iMaster_Scheduler_id").val(),
                    src_startdate: $("#src_startdate").val(),
                    src_finishdate: $("#src_finishdate").val(),
                    }, 
             success: function(response){
                 $(".dashheader2").html(response);
             }

        });
      
        // DATA Alert
        $.ajax({
             url: '<?php echo $url_divalert  ?>', 
             type: "POST", 
             data: {
                    iMaster_Scheduler_id: $("#src_iMaster_Scheduler_id").val(),
                    src_startdate: $("#src_startdate").val(),
                    src_finishdate: $("#src_finishdate").val(),
                    }, 
             success: function(response){
                 $(".dashfooter").html(response);
             }

        });


  }

 // loadContent(); // This will run on page load
  setInterval(function(){
      loadContent() // this will run after every 6MENIT
  }, 360000);



</script>