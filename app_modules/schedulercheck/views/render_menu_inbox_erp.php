<style type="text/css">
  .table_erp_inbox_erp_menu{
   /* border:1px solid #e3e3e3;
   border-radius: 5px;
   border-collapse: collapse; */
   font-family: arial;
   color:#000000;
   width: '150px'
  }
  .table_erp_inbox_erp_menu tbody td{
   /*  border-top: 1px solid #e3e3e3; */
    padding: 5px;
  }
 
  .table_erp_inbox_erp_menu tbody tr:nth-child(even){
    background: #F6F5FA;
  }
 
  .table_erp_inbox_erp_menu tbody tr:hover{
    background: #EAE9F5
  }
  .menu_inbox_erp{
    border-bottom:  1px solid #e3e3e3;
    padding: 5px;
  }
</style>
<?php  
foreach ($datamenu as $kmn => $vmn) {
  ?>
    <?php 
    if($vmn!='' or $vmn!=0){ 
      //Cek Apakah Ada email yang ada
      $datapesan=$ini->getlistpesan($vmn);
      if($datapesan['query']->num_rows()>=1){
      echo '<div id="menu_inbox_erp_'.$vmn.'" class="menu_inbox_erp" width="100%">';
      $dtmn=$ini->getmoduledetails($vmn);
      echo "<span onClick='showinboxerp(".$vmn.")' style='cursor:pointer;padding-top:10px' ><b>".$dtmn['vNameModule']."</b></span>";
    ?>
    
    <table class="table_erp_inbox_erp_menu" id="table_erp_inbox_erp_menu_<?php echo $vmn ?>" width="100%" style="display: none;">
    <tbody>
       <?php 
       foreach ($datapesan['query']->result_array() as $kv => $vv) {
         echo "<tr style='cursor:pointer;' onClick='getDetailsEmails(".$vmn.")'>";
         echo "<td>";
         $style=$vv['istatus_read']==0?'font-weight: bold;':'';
         echo "<p style='".$style."'>".$vv['vsubject']."</p>";
         echo "</td>";
         echo "</tr>";
       }
       ?>
       </tbody>
    </table>
  </div>
<?php
    }
    }//Cek Data Pesan
}
?>
<script type="text/javascript">
  function showinboxerp(id=0){
    $("#table_erp_inbox_erp_menu_"+id).toggle();
  }
  function getDetailsEmails(idmod){
    var  wait = '<div id="loading_inbox_erp"><img src="'+base_url+'/assets/images/e-load.gif">';
    $.ajax({
        url: base_url+'processor/inbox_erp?action=',  
        type: 'POST',
        beforeSend: function()
            {
                $("div#details_inbox_erp_"+idApp).html(wait);
            },
        success: function(data)
            {
               $("div#details_inbox_erp_"+idApp).html(data);
            },
            error: function()
            {
                $("div#details_inbox_erp_"+idApp).html("Error - Not Found address");
            }

    });
  }
</script>