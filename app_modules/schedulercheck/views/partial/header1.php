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
      <tr class="teer" style="background-color:<?php echo $kolkol  ?>" id="teer_<?php echo $iMaster_Scheduler_id  ?>" idscheduler="<?php echo $row['iMaster_Scheduler_id'] ?>">
        <td>
          <?php echo $row['vNama_Scheduler']  ?>
        </td>
        <td>
          <?php echo $row['dScoreLog']  ?>
        </td>
        <td>
          <?php echo $row['dScoreLog']  ?>
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