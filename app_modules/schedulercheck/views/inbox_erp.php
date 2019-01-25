 <style type="text/css">
     #accordion .ui-accordion-content {
            max-height: 300px;
        }
    #accordion{
        width: 250px;
        padding: 5px;
        margin: 5px;
    }
    .bc{
        background-color: white;
        width:270px;
        margin-left: 5px;
    }
 </style>
 <div class="content">
    <div class="box_content_form">
        <div class="full_colums">
            <div class="bc" style="float: left;"> 
                <div id="accordion">
                    <?php
                    foreach ($arrmenu as $km => $vm) {
                        echo "<h3 class='inbox_erp_app_details' onClick='getinboxmenuerp(".$vm['menu']['idApp'].",".$vm['menu']['idGroup'].")' dataIapp='".$vm['menu']['idApp']."' dataIdgroup='".$vm['menu']['idGroup']."'>".$vm['menu']['appName']."</h3>";
                        echo "<div id='details_inbox_erp_".$vm['menu']['idApp']."'></div>";
                    }
                    ?>                       
                </div><!-- div according -->
            </div>
            <dv class="content_inbox_erp" style="float: absolute;margin-left: 10px;background-color: #ffffff;width='100%'">dsadasdsa</div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<script>
$(function () {
   $( "#accordion" ).accordion({
      collapsible: true,
        active: 'none',
        autoHeight: false,
        navigation: true
    });
});
function getinboxmenuerp(idApp=0,idGroup=0) {
    var  wait = '<div id="loading_inbox_erp"><img src="'+base_url+'/assets/images/e-load.gif">',
    formAction=base_url+'processor/schedulercheck/inbox_erp?action=getInbox&company_id=<?php echo $ini->input->get("company_id")?>&idApp='+idApp+'&idGroup='+idGroup;
   $.ajax({
        url: formAction,  
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
};
 </script>