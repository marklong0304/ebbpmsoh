<!--- Bagian Dari JqGrid-->

<div style="overflow:auto;" class="boxContent">
 

<div class="full_colums">
<div class="top_form_head">
    <span class="form_head top-head-content"> Scheduler Generator </span>
</div>
</div>
<div class="clear"></div> 
<form enctype="multipart/form-data" id="myForm_dbf">
<div class="full_colums"> 
        <div class="form_horizontal_plc">
             <div class="rows_group">
                <label class="rows_label" for="openDBFLocation">Open Database</label>
                    <div class="rows_input">
                        <select id="openDatabase" class="openDatabase" name="openDatabase">
                           <option value="">-Select Databases-</option>
                           <?php 
                              foreach ($db as $db) {
                                echo '<option value="'.$db['Database'].'" 
                                onclick="javascript:modifTable(\''.$db['Database'].'\'); ">'.$db['Database'].'</option>';
                              }
                            ?>
                        </select>
                        <style>
                         #openDatabase{
                             width:350px;   
                         }
                        </style>
                        
                    </div>
                </div> 
            </div>
          <div class="form_horizontal_plc">
             <div class="rows_group">
                <label class="rows_label" for="selectCompany">Select Company</label>
                    <div class="rows_input">
                        <select id="selectCompany" class="selectCompany" name="selectCompany">
                           <option value="3">PT. NOVELL PHARMACEUTICAL LABORATORIES</option>
                           <option value="5">PT. ETERCON PHARMA</option>
                        </select>
                        <style>
                         #selectCompany{
                             width:350px;   
                         }
                        </style>
                        
                    </div>
                </div> 
            </div> 

         <!-- <div class="form_horizontal_plc">
            <div class="rows_group">
                <label class="rows_label" for="openDBFLocation">Open Table</label>
                    <div class="rows_input">
                      <div class="gantiTablle">
                        <select id="openTable" class="openTable" name="openTable">
                          <option value="">-Select Table-</option> 
                        </select> 
                        <style>
                         #openTable{
                             width:350px;   
                         }
                        </style>
                      </div>
                    </div>
                </div> 
            </div>  -->

        <div class="form_horizontal_plc">
            <div class="rows_group">
                <label class="rows_label" for="nm_dbf">DBF Name</label>
                <div class="rows_input">
                    <input id="nm_dbf" class="nm_dbf" placeholder="itemas" type="text" ftype="varchar" label="Name" value="" name="nm_dbf" size="30"> 
                    <style>
                     #nm_dbf{
                         width:100px;   
                     }
                    </style> 
                </div>
            </div> 
        </div>   
        <div class="form_horizontal_plc">
            <div class="rows_group">
                <label class="rows_label" for="dbf_path">DBF Path</label>
                <div class="rows_input">
                    <input id="dbf_path" class="dbf_path" placeholder="DATA/SALES" type="text" ftype="varchar" label="Name" value="" name="dbf_path" size="30"> 
                    <style>
                     #dbf_path{
                         width:340px;   
                     }
                    </style> 
                </div>
            </div> 
        </div>  
        <div class="form_horizontal_plc">
            <div class="rows_group">
                <label class="rows_label" for="primary_key">Primary Key</label>
                <div class="rows_input">
                    <input id="primary_key" class="primary_key" placeholder="C_iteno" type="text" ftype="varchar" label="Name" value="" name="primary_key" size="30"> Case Sensitive 
                    <style>
                     #primary_key{
                         width:100px;   
                     }
                    </style> 
                </div>
            </div> 
        </div>  

         <div class="form_horizontal_plc">
            <div class="rows_group">
                <label class="rows_label" for="forign_key">Forign Key</label>
                <div class="rows_input">
                    <input id="forign_key" class="forign_key" placeholder="C_iteno,Citemnumb" type="text" ftype="varchar" label="Name" value="" name="forign_key" size="30"> Case Sensitive 
                    <style>
                     #forign_key{
                         width:100px;   
                     }
                    </style> 
                </div>
            </div> 
        </div>  

        <div class="form_horizontal_plc">
            <div class="rows_group">
                <label class="rows_label" for="field_view">Field View</label>
                <div class="rows_input">
                    <input id="field_view" class="field_view" type="text" placeholder="c_itnam" type="varchar" label="Name" value="" name="field_view" size="30"> Case Sensitive
                    <style>
                     #field_view{
                         width:100px;   
                     }
                    </style> 
                </div>
            </div> 
        </div>   

        <div class="form_horizontal_plc">
            <div class="rows_group">
                <label class="rows_label" for="last_update">Last Update Field</label>
                <div class="rows_input">
                    <input id="last_update" class="last_update" placeholder="D_LSTUPDT" type="text" ftype="varchar" label="Name" value="" name="last_update" size="30"> Case Sensitive 
                    <style>
                     #last_update{
                         width:100px;   
                     }
                    </style> 
                </div>
            </div> 
        </div>   

        <div class="form_horizontal_plc">
            <div class="rows_group">
                <label class="rows_label" for="backback">Backdate Read</label>
                <div class="rows_input">
                    <input id="backback" placeholder="5" class="backback number" type="text" ftype="varchar" label="Name" value="" name="backback" size="30"> 
                    <style>
                     #backback{
                         width:30px;   
                     }
                    </style> 
                </div>
            </div> 
        </div>   

         <div class="form_horizontal_plc">
            <div class="rows_group">
                <label class="rows_label" for="openDBFLocation">Directory Module</label>
                    <div class="rows_input"> 
                        <select id="openModule" class="openModule" name="openModule">
                          <option value="">-Select Module-</option>  
                          <?php 
                             foreach ($modules as $mo) {
                                echo '<option value="'.$mo.'">'.$mo.'</option>'; 
                             }
                          ?>
                        </select> 
                        <style>
                         #openModule{
                             width:350px;   
                         }
                        </style> 
                    </div>
                </div> 
            </div> 
        <div class="form_horizontal_plc">
        <div class="rows_group">
            <label class="rows_label" for="createname">Name Controller</label>
                <div class="rows_input">
                    <input id="createname" class="createname" type="text" ftype="varchar" label="Name" value="" name="createname" size="30"> 
                    <style>
                     #createname{
                         width:340px;   
                     }
                    </style> 
                </div>
            </div> 
        </div>   
</div>  
</form>

<div class="control-group-btn">
<div class="left-control-group-btn">
    <button class="icon-search ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" ,id="btn_search_gps_map" ,="" onclick="javascript:create_controller();" type="button" name="btn_search_gps_map" role="button" aria-disabled="false">
    <span class="ui-button-icon-primary ui-icon ui-icon-search"></span>
    <span class="ui-button-text">Create</span>
    </button> 
</div>
</div>
</div>

<script type="text/javascript">
function create_controller(){ 
    var openDatabase = $('.openDatabase').val();
    var openTable = $('.openTable').val();
    var createname = $('.createname').val();
    var openModule = $('.openModule').val();
    var backback = $('.backback').val();
    var dbf_path = $('.dbf_path').val();
    var field_view = $('.field_view').val();
    var last_update = $('.last_update').val();
    var nm_dbf = $('.nm_dbf').val();
    var primary_key = $('.primary_key').val();
    var forign_key = $('.forign_key').val();
      
     
    if(openTable!="" && openDatabase!="" && createname!="" && openModule!="" && backback!="" && dbf_path!="" && field_view!="" && last_update!=""&& nm_dbf!=""&& primary_key!=""){
      $.ajax({
        type: "POST",
        async: false,
        url: "<?php echo $url ?>",
        data: $('#myForm_dbf').serialize(),  
        success: function(data) { 
          var o = $.parseJSON(data);
          if(o.pk==1){
            if(o.status == true) { 
              _custom_alert('<br>Create File Success <br>Location: ./modules/'+o.Nama_Module+'/controllers/'+o.Nama_Controller+'.php'); 
            }else{
              _custom_alert('<br>The file already exists, <br>please remove or modify the file'); 
            }
          }else{
            _custom_alert('Primary Key is not found');
          }
        },
      }); 
    }else{
      _custom_alert('Isi Data Dulu'); 
    }
}
function modifTable(db){ 
   $.ajax({
      type: "POST",
      async: false,
      url: "<?php echo $url2 ?>",
      data: {
        nameDB : db,
      },  
      success: function(data) {  
        $(".gantiTablle").html(data);
      },
    }); 
}
</script>
 