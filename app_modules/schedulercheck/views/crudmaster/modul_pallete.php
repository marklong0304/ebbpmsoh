<!--- Bagian Dari JqGrid-->

<div style="overflow:auto;" class="boxContent">
 

<div class="full_colums">
<div class="top_form_head">
    <span class="form_head top-head-content"> Generate Modul ERP</span>
</div>
</div>
<div class="clear"></div> 
<form enctype="multipart/form-data" id="myForm_dbf">
<div class="full_colums"> 
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
          </div> 


          <div class="form_horizontal_plc">
              <div class="drawField">
                ini draw field
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

    if(openTable!="" && openDatabase!="" && createname!="" && openModule!=""){
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

function getField(db,tabel){ 
   $.ajax({
      type: "POST",
      async: false,
      url: "<?php echo $url3 ?>",
      data: {
        nameDB : db,
        nameTb : tabel,
      },  
      success: function(data) {  
        $(".drawField").html(data);
      },
    }); 
}


</script>
 