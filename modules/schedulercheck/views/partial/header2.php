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
<table id="dashdata" width="85%" border="1" style="border-collapse:collapse;">
  <thead class ="tehead" id="dashdatahead">
    <tr>
      <th>
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

      <tr class="teer"  id="teer_<?php echo $iMaster_Scheduler_id  ?>" idscheduler="<?php echo $row['iMaster_Scheduler_id'] ?>">
        <td>
          <?php echo $i ?>
        </td>
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
