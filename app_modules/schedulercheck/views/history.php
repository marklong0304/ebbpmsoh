<style type="text/css">
.histwrapper{
   
   width: 100%;
   background-color: #cccccc
}
.histheader{
   
   width: 100%;
   height: 100px;
   background-color: #6699cc
}
.histcontent{
   
   width: 100%;
   height: 410px;
   background-color: #99ccff
}
.histfooter{
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

    <div class="histwrapper">
        <div class="histheader">
            Search Panel
            <table width="40%" border="1" style="border-collapse:collapse;">
              <tr>
                <td>Scheduler Name </td>
                <td colspan="4">
                   <?php 
                    $sql_sc = 'select * from hrd.master_scheduler a where a.lDeleted=0 order by a.vNama_Scheduler';
                    $rows = $this->db_schedulercheck->query($sql_sc)->result_array();

                    $o  = "<select name='iMaster_Scheduler_id' id='iMaster_Scheduler_id' >";    
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
                  : <input type="text" name="startdate"  id="startdate" class=" tanggal input_rows1 required" size="8" />
                </td>
                <td width="5%">to</td>
                <td width="15%">
                  : <input type="text" name="finishdate"  id="finishdate" class=" tanggal input_rows1 required" size="8" />
                </td>
                <td width="20%">
                  <span  id="btsrc_sc"  class=" ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary buttonserch">Search</span>

                </td>
              </tr>
            </table>
        </div>	    
        <div id="histcontent" class="histcontent">
            content
        </div> 	       

    </div>

<script type="text/javascript">
      // datepicker
       $(".tanggal").datepicker({changeMonth:true,
                    changeYear:true,
                    dateFormat:"yy-mm-dd" });

      // input number
         $(".angka").numeric();

<?php $url_memo_launch = base_url()."processor/schedulercheck/partial/view?action=gethistsch";  ?>
$("#btsrc_sc").die();
$("#btsrc_sc").live('click',function(){
              var iMaster_Scheduler_id = $("#iMaster_Scheduler_id").val();
              var startdate = $("#startdate").val();
              var finishdate = $("#finishdate").val();

              if (startdate == "") {
                  _custom_alert('Periode awal tidak boleh kosong','Error!','info','grid', 1, 5000);

              }else if (finishdate == ""){
                _custom_alert('Periode akhir tidak boleh kosong','Error!','info','grid', 1, 5000);
                
              }else if (finishdate < startdate ){
                _custom_alert('Periode akhir tidak boleh kurang dari periode awal','Error!','info','grid', 1, 5000);
              }else{
                  // partial_view 
                  $.ajax({
                       url: '<?php echo $url_memo_launch  ?>', 
                       type: "POST", 
                       data: {
                              iMaster_Scheduler_id: iMaster_Scheduler_id,
                              startdate: startdate,
                              finishdate: finishdate,
                              }, 
                       success: function(response){
                           $("#histcontent").html(response);
                       }

                  });
                  
              }



            


})

</script>    