<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class createcrud extends MX_Controller {
    function __construct() {
        parent::__construct();
$this->db_schedulercheck = $this->load->database('schedulercheck',false, true);
        $this->load->library('auth');
        $this->dbset = $this->load->database('hrd', true);
        $this->user = $this->auth->user();
    }
    function index($action = '') {
        $action = $this->input->get('action') ? $this->input->get('action') : 'piew';   
        $grid = new Grid;
        $grid->setTitle('CRUD Master'); 
        $grid->setTable('hrd.scheduler_group_pic');     
        $grid->setUrl('createcrud'); 
        
        switch ($action) {
                case 'piew': 
                        $data = array(
                            'url'=>base_url().'processor/schedulercheck/createcrud?action=write',
                            'url2'=>base_url().'processor/schedulercheck/createcrud?action=addTable',
                            'db' => $this->db_schedulercheck->query('SHOW DATABASES')->result_array(),
                            'modules' =>  scandir('modules',1),
                        );
                        $this->load->view('crudmaster/create_dashboard',$data); 
                        break;
                case 'write':
                        $this->write();
                        break;
                case 'addTable':
                        $this->addTable();
                        break;
                default:
                        $grid->render_grid();
                        break;
        }
    }
    function addTable(){
        $nameDB = $this->input->post('nameDB');
        $tables = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE `TABLE_SCHEMA` ='".$nameDB."'"; 
        $load_tb = $this->db_schedulercheck->query($tables)->result_array();

        echo '<select id="openTable" class="openTable" name="openTable">';
        echo '<option value="">-Select Table-</option>';
        foreach ($load_tb as $lt) {
            echo '<option value="'.$lt['TABLE_NAME'].'">'.$lt['TABLE_NAME'].'</option>';
        }
        echo '</select>';
        echo '<style>
                 #openTable{
                     width:350px;   
                 }
                </style> ';
    }
    
    function write(){ 
        $createname = $this->input->post('createname'); 
        $openModule = $this->input->post('openModule'); 
        $openTable = $this->input->post('openTable'); 
        $openDatabase = $this->input->post('openDatabase'); 

        $r = array(
            'Nama Controller' => $createname,
            'Nama Module' => $openModule,
            'Nama Database' => $openDatabase,
            'Nama Table' => $openTable,
            'Generate By' => 'Sovdev 2(N16945)',
            );

        $createname_up = strtoupper($createname); 
        $createname_space = strtolower(str_replace(' ', '_', $createname));


        //Create Controller Folder
        $path1 = realpath("modules/".$openModule);
        if(!file_exists($path1."/controllers")){
            if (!mkdir($path1."/controllers", 0777, true)) { 
                die('Failed');
            }
        } 

        //Create View Folder

        // $path2 = realpath("modules/".$openModule);
        // if(!file_exists($path2."/views")){
        //     if (!mkdir($path2."/views", 0777, true)) { 
        //         die('Failed');
        //     }
        // }  

        //Create Controller Struktur ERP
        /*
            example :
            modules/ariesERP/ 
        */
        $query ="SELECT c.`COLUMN_NAME`,c.`COLUMN_KEY` , c.`COLUMN_TYPE`, c.`DATA_TYPE`, c.`CHARACTER_MAXIMUM_LENGTH` FROM `information_schema`.`COLUMNS` c WHERE c.`TABLE_SCHEMA` = '".$openDatabase."' AND c.`TABLE_NAME`='".$openTable."'"; 

        $field = $this->db_schedulercheck->query($query)->result_array();

        $field_tb = "";
        $field_pk = "";
        $field_pk1 = "";
        $i =0;
        $pk =0;
        foreach ($field as $f) {   
            if($f['COLUMN_KEY']=="PRI"){
                $field_pk = "'".$f['COLUMN_NAME']."'";
                $field_pk1 = $f['COLUMN_NAME'];
                $pk++;
            }else{
                if($i==0){
                    $field_tb .= "'".$f['COLUMN_NAME']."'";
                }else{
                    $field_tb .= ",'".$f['COLUMN_NAME']."'";
                }
                $i++; 
            } 
        }

 
        $html =" 
        <?php
        /* Generated by Sovdev 2 ERP CRUD Generator ".date('Y-m-d H:i:s')." */
        /* Location: ./modules/".$openModule."/controllers/".$createname_space.".php */
        /* Please DO NOT modify this information : */ 
        "; 


        $html .= " 
        if ( ! defined('BASEPATH')) exit('No direct script access allowed');
        class ".$createname_space." extends MX_Controller {
            function __construct() {
                parent::__construct();
$this->db_schedulercheck = $this->load->database('schedulercheck',false, true);
                \$this->load->library('auth');
                \$this->db = \$this->load->database('hrd', true);
                \$this->user = \$this->auth->user();
            }
            function index(\$action = '') {
                \$action = \$this->input->get('action');
                //Bikin Object Baru Nama nya \$grid      
                \$grid = new Grid;
                \$grid->setTitle('".$createname_up."');
                \$grid->setTable('".$openDatabase.".".$openTable."');      
                \$grid->setUrl('".$createname_space."');

                //List Table
                \$grid->addList(".$field_tb."); 
                \$grid->setSortBy(".$field_pk.");
                \$grid->setSortOrder('asc');  

                //List field
                \$grid->addFields(".$field_tb."); 

                //Setting Grid Width Name 
                /*
                    Kamu bisa merubah nama label dari sini, Contoh :
                    \$grid->setLabel('nama field','nama field yang akan diubah');

                */
        ";

        foreach ($field as $f) { 
          if($f['COLUMN_KEY']!="PRI"){
            $html .= "
                \$grid->setWidth('".$f['COLUMN_NAME']."', '100');
                \$grid->setAlign('".$f['COLUMN_NAME']."', 'left');
                \$grid->setLabel('".$f['COLUMN_NAME']."','".strtoupper($f['COLUMN_NAME'])."');
            ";
          }
        }

        $html .= "
                //Example modifikasi GRID ERP
                /*
                    - Set Query
                        \$grid->setQuery('lDeleted = 0 ', null); 
                        \$grid->setQuery('plc2_upb.iupb_id IN (select distinct(bk.iupb_id) from plc2.plc2_upb_spesifikasi_fg bk where bk.iappqa=2 and bk.ldeleted=0)', null);  

                    - Join Table
                        \$grid->setJoinTable('hrd.employee', 'employee.cNip = pk_master.vnip', 'inner');

                    - Change Field Name
                        \$grid->changeFieldType('ideleted','combobox','',array(''=>'Pilih',0=>'Aktif',1=>'Tidak aktif'));
                */

                 //set search
                \$grid->setSearch(".$field_tb.");
                
                //set required
                \$grid->setRequired(".$field_tb."); 

                \$grid->setGridView('grid');

                switch (\$action) {
                    case 'json':
                            \$grid->getJsonData();
                            break;
                    case 'view':
                            \$grid->render_form(\$this->input->get('id'), true);
                            break;
                    case 'create':
                            \$grid->render_form();
                            break;
                    case 'createproses':
                            echo \$grid->saved_form();
                            break;
                    case 'update':
                            \$grid->render_form(\$this->input->get('id'));
                            break;
                    case 'updateproses':
                            echo \$grid->updated_form();
                            break;
                    case 'delete':
                            echo \$grid->delete_row();
                            break; 
                    /*
                        //Ini Merupakan Standart Case Untuk Approve

                        case 'approve':
                            echo \$this->approve_view();
                            break;
                        case 'approve_process':
                            echo \$this->approve_process();
                            break;
                        case 'reject':
                            echo \$this->reject_view();
                            break;
                        case 'reject_process':
                            echo \$this->reject_process();
                            break; 
                    */ 
                    default:
                            \$grid->render_grid();
                            break;
                }
            }
            //Create Manipulate Field 

            //Jika Ingin Menambahkan Seting grid seperti button edit enable dalam kondisi tertentu
            /* 
            function listBox_Action(\$row, \$actions) {
                if (\$row->vNo_Or<>'' || \$row->vNo_Or<>NULL) { 
                        unset(\$actions['edit']);
                }
                return \$actions;
            } 
            */
        ";
 
        foreach ($field as $f) { 
          if($f['COLUMN_KEY']!="PRI"){  

            //INSERT BOX
           
            $html .="
            function insertBox_".$createname_space."_".$f['COLUMN_NAME']."(\$field, \$id) {";

            if($f['DATA_TYPE']=="text"){ 
                $html .="
                \$return = '<textarea name=".'"'.""."'.\$field.'"."".'"'." id=".'"'.""."'.\$id.'"."".'"'." class=".'"required"'." style=".'"width: 240px; height: 50px;"'." size=".'"250"'." maxlength =".'"250"'."></textarea>';";
                $html .="
                \$return .= '<script>
                                $(".'"'."#'.\$id.'".'"'.").keyup(function() {
                                    var len = this.value.length;
                                        if (len >= 250) {
                                            this.value = this.value.substring(0, 255);
                                        }
                                    $(".'"'."#maxlengthnote_'.\$id.'".'"'.").text(255 - len);
                                });
                             </script>';";   
                $html .="
                \$return .= '<br/>tersisa <span id=".'"'."maxlengthnote_'.\$id.'".'"'.">250</span> karakter<br/>';"; 
            
            }else if($f['DATA_TYPE']=="varchar" || $f['DATA_TYPE']=="char"){
                $html .="
                \$return = '<input type=".'"text"'." name=".'"'.""."'.\$field.'"."".'"'."  id=".'"'.""."'.\$id.'"."".'"'."  class=".'"input_rows1 required"'." size=".'"30"'." maxlength = ".'"'.$f['CHARACTER_MAXIMUM_LENGTH'].'"'." />';";
                $html .="
                \$return .= '<script>
                                $(".'"'."#'.\$id.'".'"'.").keyup(function() {
                                    var len = this.value.length;
                                        if (len >= 250) {
                                            this.value = this.value.substring(0, ".$f['CHARACTER_MAXIMUM_LENGTH'].");
                                        }
                                    $(".'"'."#maxlengthnote_'.\$id.'".'"'.").text(".$f['CHARACTER_MAXIMUM_LENGTH']." - len);
                                });
                             </script>';";   
                $html .="
                \$return .= '<br/>tersisa <span id=".'"'."maxlengthnote_'.\$id.'".'"'.">".$f['CHARACTER_MAXIMUM_LENGTH']."</span> karakter<br/>';";

            }
            else if($f['DATA_TYPE']=="int" || $f['DATA_TYPE']=="float" || $f['DATA_TYPE']=="double" || $f['DATA_TYPE']=="tinyint"){
                $html .="
                \$return = '<input type=".'"text"'." name=".'"'.""."'.\$field.'"."".'"'."  id=".'"'.""."'.\$id.'"."".'"'."  class=".'"input_rows1 required"'." size=".'"30"'." />';";
                $html .="
                \$return .= '<script>
                                $(".'"'."#'.\$id.'".'"'.").keyup(function() {
                                     this.value = this.value.replace(/[^0-9\.]/g,".'""'.");
                                });
                             </script>';";    
            }
            else if($f['DATA_TYPE']=="date" || $f['DATA_TYPE']=="datetime"){
                $html .="
                \$return = '<input type=".'"text"'." name=".'"'.""."'.\$field.'"."".'"'."  id=".'"'.""."'.\$id.'"."".'"'."  class=".'"input_rows1 required"'." size=".'"30"'." />';";
                $html .="
                \$return .= '<script>
                                $(".'"'."#'.\$id.'".'"'.").datepicker({  changeMonth:true,
                                        changeYear:true,
                                        dateFormat:".'"'."yy-mm-dd".'"'."}); 
                             </script>';";    
            }
            else{
                $html .="
                \$return = '<input type=".'"text"'." name=".'"'.""."'.\$field.'"."".'"'."  id=".'"'.""."'.\$id.'"."".'"'."  class=".'"input_rows1 required"'." size=".'"30"'." />';";
            }

            //UPDATE BOX
            $html .="
                return \$return;
            }
            function updateBox_".$createname_space."_".$f['COLUMN_NAME']."(\$field, \$id, \$value, \$rowData) {";

            if($f['DATA_TYPE']=="text"){
                $html .="
                if (\$this->input->get('action') == 'view') {
                     \$return= '<label title=".'"'."Note".'"'.">'.nl2br(\$value).'</label>'; 
                }else{";
                $html .="
                    \$return = '<textarea name=".'"'.""."'.\$field.'"."".'"'." id=".'"'.""."'.\$id.'"."".'"'." class=".'"required"'." style=".'"width: 240px; height: 50px;"'." size=".'"250"'." maxlength =".'"250"'.">'.nl2br(\$value).'</textarea>';
                }";

            }else if($f['DATA_TYPE']=="int" || $f['DATA_TYPE']=="float" || $f['DATA_TYPE']=="double" || $f['DATA_TYPE']=="tinyint"){
                $html .="
                if (\$this->input->get('action') == 'view') {
                     \$return= \$value; 
                }else{";

                $html .="
                \$return = '<input type=".'"text"'." name=".'"'.""."'.\$field.'"."".'"'."  id=".'"'.""."'.\$id.'"."".'"'."  class=".'"input_rows1 required"'." size=".'"30"'." value=".'"'.""."'.\$value.'"."".'"'."/>';";
                $html .="
                \$return .= '<script>
                                $(".'"'."#'.\$id.'".'"'.").keyup(function() {
                                     this.value = this.value.replace(/[^0-9\.]/g,".'""'.");
                                });
                             </script>';
                }"; 

            } else if($f['DATA_TYPE']=="date" || $f['DATA_TYPE']=="datetime"){
                $html .="
                if (\$this->input->get('action') == 'view') {
                     \$return= \$value; 
                }else{";

                $html .="
                \$return = '<input type=".'"text"'." name=".'"'.""."'.\$field.'"."".'"'."  id=".'"'.""."'.\$id.'"."".'"'."  class=".'"input_rows1 required"'." size=".'"30"'." value=".'"'.""."'.\$value.'"."".'"'."/>';";
                $html .="
                \$return .= '<script>
                                $(".'"'."#'.\$id.'".'"'.").datepicker({
                                    changeMonth:true,
                                    changeYear:true,
                                    dateFormat:".'"'."yy-mm-dd".'"'."
                                });
                             </script>';
                }"; 

            } else if($f['DATA_TYPE']=="varchar" || $f['DATA_TYPE']=="char"){
                $html .="
                if (\$this->input->get('action') == 'view') {
                     \$return= \$value; 
                }else{";

                $html .="
                \$return = '<input type=".'"text"'." name=".'"'.""."'.\$field.'"."".'"'."  id=".'"'.""."'.\$id.'"."".'"'."  class=".'"input_rows1 required"'." size=".'"30"'." maxlength = ".'"'.$f['CHARACTER_MAXIMUM_LENGTH'].'"'."  value=".'"'.""."'.\$value.'"."".'"'."/>';";
                $html .="
                \$return .= '<script>
                                $(".'"'."#'.\$id.'".'"'.").keyup(function() {
                                    var len = this.value.length;
                                        if (len >= ".$f['CHARACTER_MAXIMUM_LENGTH'].") {
                                            this.value = this.value.substring(0, ".$f['CHARACTER_MAXIMUM_LENGTH'].");
                                        }
                                    $(".'"'."#maxlengthnote_'.\$id.'".'"'.").text(".$f['CHARACTER_MAXIMUM_LENGTH']." - len);
                                });
                             </script>';";   
                $html .="
                \$return .= '<br/>tersisa <span id=".'"'."maxlengthnote_'.\$id.'".'"'.">".$f['CHARACTER_MAXIMUM_LENGTH']."</span> karakter<br/>';

                }";

            }else{
                $html .="
                    if (\$this->input->get('action') == 'view') {
                        \$return= \$value; 
                    }
                    else{
                        \$return = '<input type=".'"text"'." name=".'"'.""."'.\$field.'"."".'"'."  id=".'"'.""."'.\$id.'"."".'"'." value=".'"'.""."'.\$value.'"."".'"'." class=".'"input_rows1 required"'." size=".'"30"'." />';
                    }";
            }


            $html .=" 
                return \$return;
            }   
            "; 
          }
        }


        //Tambahan Untuk Proses Proses Approve dan Reject

        $html .="
            /*
                //Ini Merupakan Standart Approve yang digunakan di erp
 
                function approve_view() {
                    \$echo = '<script type=".'"'."text/javascript".'"'.">
                                 function submit_ajax(form_id) {
                                    return \$.ajax({
                                        url: \$(".'"'."#".'"'."+form_id).attr(".'"'."action".'"'."),
                                        type: \$(".'"'."#".'"'."+form_id).attr(".'"'."method".'"'."),
                                        data: \$(".'"'."#".'"'."+form_id).serialize(),
                                        success: function(data) {
                                            var o = \$.parseJSON(data);
                                            var last_id = o.last_id;
                                            var url = ".'"'."'.base_url().'processor/".$openModule."/".$createname_space."".'"'.";                             
                                            if(o.status == true) { 
                                                \$(".'"'."#alert_dialog_form".'"'.").dialog(".'"'."close".'"'.");
                                                     \$.get(url+".'"'."?action=update&id=".'"'."+last_id, function(data) {
                                                     \$(".'"'."div#form_".$createname_space."".'"'.").html(data);
                                                     
                                                });
                                                
                                            }
                                                reload_grid(".'"'."grid_".$createname_space."".'"'.");
                                        }
                                        
                                     })
                                 }
                             </script>';
                    \$echo .= '<h1>Approve</h1><br />';
                    \$echo .= '<form id=".'"'."form_".$createname_space."_approve".'"'." action=".'"'."'.base_url().'processor/".$openModule."/".$createname_space."?action=approve_process".'"'." method=".'"'."post".'"'.">';
                    \$echo .= '<div style=".'"'."vertical-align: top;".'"'.">';
                    \$echo .= 'Remark : 
                            <input type=".'"'."hidden".'"'." name=".'"'."".$field_pk1."".'"'." value=".'"'."'.\$this->input->get(".$field_pk.").'".'"'." />
                            <input type=".'"'."hidden".'"'." name=".'"'."lvl".'"'." value=".'"'."'.\$this->input->get('lvl').'".'"'." />
                            <input type=".'"'."hidden".'"'." name=".'"'."group_id".'"'." value=".'"'."'.\$this->input->get('group_id').'".'"'." />
                            <input type=".'"'."hidden".'"'." name=".'"'."modul_id".'"'." value=".'"'."'.\$this->input->get('modul_id').'".'"'." />
                            <textarea name=".'"'."vRemark".'"'."></textarea>
                    <button type=".'"'."button".'"'." onclick=".'"'."submit_ajax(\'form_".$createname_space."_approve\')".'"'.">Approve</button>';
                        
                    \$echo .= '</div>';
                    \$echo .= '</form>';
                    return \$echo;
                } 
 
                function approve_process() {
                    \$post = \$this->input->post();
                    \$cNip= \$this->user->gNIP;
                    \$vName= \$this->user->gName;
                    \$".$field_pk1." = \$post[".$field_pk."];
                    \$vRemark = \$post['vRemark'];
                    \$lvl = \$post['lvl'];
 
                    //Letakan Query Update approve disini

                    \$data['status']  = true;
                    \$data['last_id'] = \$post[".$field_pk."];
                    return json_encode(\$data);
                }
            */

        ";

        $html .="
            /*
                //Ini Merupakan Standart Reject yang digunakan di erp

                function reject_view() {
                    \$echo = '<script type=".'"'."text/javascript".'"'.">
                                 function submit_ajax(form_id) {
                                    var remark = \$(".'"'."#".$createname_space."_remark".'"'.").val();
                                    if (remark==".'"'."".'"'.") {
                                        alert(".'"'."Remark tidak boleh kosong ".'"'.");
                                        return
                                    }

                                    return \$.ajax({
                                        url: \$(".'"'."#".'"'."+form_id).attr(".'"'."action".'"'."),
                                        type: \$(".'"'."#".'"'."+form_id).attr(".'"'."method".'"'."),
                                        data: \$(".'"'."#".'"'."+form_id).serialize(),
                                        success: function(data) {
                                            var o = \$.parseJSON(data);
                                            var last_id = o.last_id;
                                            var url = ".'"'."'.base_url().'processor/".$openModule."/".$createname_space."".'"'.";                             
                                            if(o.status == true) { 
                                                \$(".'"'."#alert_dialog_form".'"'.").dialog(".'"'."close".'"'.");
                                                     \$.get(url+".'"'."?action=update&id=".'"'."+last_id, function(data) {
                                                     \$(".'"'."div#form_".$createname_space."".'"'.").html(data);
                                                     
                                                });
                                                
                                            }
                                                reload_grid(".'"'."grid_".$createname_space."".'"'.");
                                        }
                                        
                                     })
                                 }
                             </script>';
                    \$echo .= '<h1>Reject</h1><br />';
                    \$echo .= '<form id=".'"'."form_".$createname_space."_reject".'"'." action=".'"'."'.base_url().'processor/".$openModule."/".$createname_space."?action=reject_process".'"'." method=".'"'."post".'"'.">';
                    \$echo .= '<div style=".'"'."vertical-align: top;".'"'.">';
                    \$echo .= 'Remark : 
                            <input type=".'"'."hidden".'"'." name=".'"'."".$field_pk1."".'"'." value=".'"'."'.\$this->input->get(".$field_pk.").'".'"'." />
                            <input type=".'"'."hidden".'"'." name=".'"'."lvl".'"'." value=".'"'."'.\$this->input->get('lvl').'".'"'." />
                            <input type=".'"'."hidden".'"'." name=".'"'."group_id".'"'." value=".'"'."'.\$this->input->get('group_id').'".'"'." />
                            <input type=".'"'."hidden".'"'." name=".'"'."modul_id".'"'." value=".'"'."'.\$this->input->get('modul_id').'".'"'." />
                            <textarea name=".'"'."vRemark".'"'." id=".'"'."reject_".$createname_space."_remark".'"'."></textarea>
                    <button type=".'"'."button".'"'." onclick=".'"'."submit_ajax(\'form_".$createname_space."_reject\')".'"'.">Reject</button>';
                        
                    \$echo .= '</div>';
                    \$echo .= '</form>';
                    return \$echo;
                }


                
                function reject_process() {
                    \$post = \$this->input->post();
                    \$cNip= \$this->user->gNIP;
                    \$vName= \$this->user->gName;
                    \$".$field_pk1." = \$post[".$field_pk."];
                    \$vRemark = \$post['vRemark'];
                    \$lvl = \$post['lvl'];
 
                    //Letakan Query Update approve disini

                    \$data['status']  = true;
                    \$data['last_id'] = \$post[".$field_pk."];
                    return json_encode(\$data);
                }
            */

        ";

        $html .="
            //Standart Setiap table harus memiliki dCreate , cCreated, dupdate, cUpdate
            function before_insert_processor(\$row, \$postData) {
                \$postData['dCreate'] = date('Y-m-d H:i:s');
                \$postData['cCreated']=\$this->user->gNIP;
                return \$postData;

            }
            function before_update_processor(\$row, \$postData) {
                \$postData['dupdate'] = date('Y-m-d H:i:s');
                \$postData['cUpdate'] = \$this->user->gNIP;
                return \$postData; 
            }    
        ";

        $html .="
            function after_insert_processor(\$fields, \$id, \$postData) {
                //Example After Insert
                /*
                \$cNip = \$this->sess_auth->gNIP; 
                \$sql = 'Place Query In Here';
                \$this->db_schedulercheck->query(\$sql);
                */
            }
    
            function after_update_processor(\$fields, \$id, \$postData) {
                //Example After Update
                /*
                \$cNip = \$this->sess_auth->gNIP; 
                \$sql = 'Place Query In Here';
                \$this->db_schedulercheck->query(\$sql);
                */
            }";

        $html .="
            function manipulate_update_button(\$buttons, \$rowData) { 
                //Load Javascript In Here 
                if (\$this->input->get('action') == 'view') {
                    unset(\$buttons['update']);
                }
                else{ 
                    
                }
                
                return \$buttons;
            }";
        $html .="
            //Output
            public function output(){
                \$this->index(\$this->input->get('action'));
            }
        }";
 
        $dir = $path1."/controllers";
        $file_to_write = $createname_space.'.php';

        $r = array(
            'Nama_Controller' => $createname_space,
            'Nama_Module' => $openModule,
            'Nama_Database' => $openDatabase,
            'Nama_Table' => $openTable,
            'Generate_By' => 'Sovdev 2(N16945)',
        ); 

        if($pk==0){
             $r['status'] = false;
             $r['pk'] = 0;
        }else{
            if (file_exists($dir . '/' . $file_to_write)) {
                $r['status'] = false;
                $r['pk'] = 1;
            }else { 
                $r['status'] = true; 
                $r['pk'] = 1;
                $file = fopen($dir . '/' . $file_to_write,"w"); 
                $content_to_write = $html;
                fwrite($file, $content_to_write); 
                fclose($file);
            }
        }
        
 
        echo json_encode($r); 
    }
    public function output(){
        $this->index($this->input->get('action'));
    }

}
