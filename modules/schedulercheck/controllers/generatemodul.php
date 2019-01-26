<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class generatemodul extends MX_Controller {
    function __construct() {
        parent::__construct();
        $this->dbset = $this->load->database('hrd',false, true);
        $this->load->library('auth');
        //$this->dbset = $this->load->database('hrd', true);
        $this->user = $this->auth->user();
    }
    function index($action = '') {
        $action = $this->input->get('action') ? $this->input->get('action') : 'piew';   
        $grid = new Grid;
        $grid->setTitle('CRUD Master'); 
        $grid->setTable('hrd.employee');     
        $grid->setUrl('generatemodul'); 
        
        switch ($action) {
                case 'piew': 
                        $data = array(
                            'url'=>base_url().'processor/schedulercheck/generatemodul?action=write',
                            'url2'=>base_url().'processor/schedulercheck/generatemodul?action=addTable',
                            'url3'=>base_url().'processor/schedulercheck/generatemodul?action=getField',
                            'db' => $this->dbset->query('SHOW DATABASES')->result_array(),
                            'modules' =>  scandir('modules',1),
                        );
                        $this->load->view('crudmaster/modul_pallete',$data); 
                        break;
                case 'write':
                        $this->write();
                        break;
                case 'addTable':
                        $this->addTable();
                        break;
                case 'getField':
                        $this->getField();
                        break;
                default:
                        $grid->render_grid();
                        break;
        }
    }
    function addTable(){
        $nameDB = $this->input->post('nameDB');
        $tables = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE `TABLE_SCHEMA` ='".$nameDB."'"; 
        $load_tb = $this->dbset->query($tables)->result_array();

        echo '<select id="openTable" class="openTable" name="openTable">';
        echo '<option value="">-Select Table-</option>';
        foreach ($load_tb as $lt) {
            echo '<option value="'.$lt['TABLE_NAME'].'" onclick="javascript:getField(\''.$nameDB.'\',\''.$lt['TABLE_NAME'].'\'); " >'.$lt['TABLE_NAME'].'</option>';
        }
        echo '</select>';
        echo '<style>
                 #openTable{
                     width:350px;   
                 }
                </style> ';
    }


    function getField(){

    	$nameDB = $this->input->post('nameDB');
    	$nameTb = $this->input->post('nameTb');
    	

    	$query ="SELECT c.`COLUMN_NAME`,c.`COLUMN_KEY` , c.`COLUMN_TYPE`, c.`DATA_TYPE`, c.`CHARACTER_MAXIMUM_LENGTH` FROM `information_schema`.`COLUMNS` c WHERE c.`TABLE_SCHEMA` = '".$nameDB."' AND c.`TABLE_NAME`='".$nameTb."'"; 
        $fields = $this->dbset->query($query)->result_array();

        $data['judul']='Ini Judul';
        $data['fields']=$fields;

    	$view = $this->load->view('crudmaster/form_field',$data,TRUE);
    	echo $view;

    }

    
    function write(){ 
        $createname = $this->input->post('createname');
        $openModule = $this->input->post('openModule'); 
        $openTable = $this->input->post('openTable'); 
        $openDatabase = $this->input->post('openDatabase'); 

        $txtinput = $this->input->post('txtinput'); 
        $showonform = $this->input->post('showonform'); 
        $txtlabel = $this->input->post('txtlabel'); 
        $jenis_input = $this->input->post('jenis_input'); 

        //print_r($_POST);

        /*
			Array
            (
                [openModule] => home
                [createname] => caca
                [openDatabase] => plc2
                [openTable] => analisa_bb
                [txtinput] => Array
                    (
                        [0] => ianalisa_bb 
                        [1] => vNo_analisa 
                        [2] => raw_id 
                        [3] => iupb_id 
                        
                    )

                [showonform] => Array
                    (
                        [0] => 0
                        [1] => 1
                        [2] => 1
                        [3] => 1
                        
                    )

                [txtlabel] => Array
                    (
                        [0] => ianalisa_bb
                        [1] => No Analisa
                        [2] => Bahan Baku
                        [3] => iupb_id 
                        
                    )

                [jenis_input] => Array
                    (
                        [0] => 2
                        [1] => 1
                        [2] => 2
                        [3] => 2
                        
                    )

            )


        */

        $r = array(
            'Nama Controller' => $createname,
            'Nama Module' => $openModule,
            'Nama Database' => $openDatabase,
            'Nama Table' => $openTable,
            'Generate By' => 'Softdev 2',
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


        $query ="SELECT c.`COLUMN_NAME`,c.`COLUMN_KEY` , c.`COLUMN_TYPE`, c.`DATA_TYPE`, c.`CHARACTER_MAXIMUM_LENGTH` FROM `information_schema`.`COLUMNS` c WHERE c.`TABLE_SCHEMA` = '".$openDatabase."' AND c.`TABLE_NAME`='".$openTable."'"; 

        $field = $this->dbset->query($query)->result_array();

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

        
        /*draw controller here*/
 
$html =" 
<?php
/* Generated by Softdev 2 ERP Module Generator ".date('Y-m-d H:i:s')." */
/* Location: ./modules/".$openModule."/controllers/".$createname_space.".php */
/* Please DO NOT modify this information : */ 


/*
    Preparation 
    1. untuk load view halaman upload , file berada pada folder partial;
    2. lib auth untuk fungsi check modul



    Parameter need to be change after generate 
    1. FOLDER_APP => change to folder name where this controllers should be there
    2. Static Dropdown => change value for option
    3. Dynamic Dropdown => Change query for option

    Table Sample 
    test.item && test.item_file_upload




*/
 


"; 

$html .= " 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ".$createname_space." extends MX_Controller {
    function __construct() {
        parent::__construct();
        /*\$this->dbset = \$this->load->database('schedulercheck',false, true);*/
        \$this->load->library('auth');
        \$this->db = \$this->load->database('hrd',false, true);
        \$this->user = \$this->auth->user();

       /* \$checkMod = \$this->auth->modul_set(\$this->input->get('modul_id'));
        \$this->validation =\$checkMod['iValidation'];*/

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
        \$grid->setSortOrder('DESC');  

        //List field
        \$grid->addFields(".$field_tb."); 

        //Setting Grid Width Name 
        /*
        Kamu bisa merubah nama label dari sini, Contoh :
        \$grid->setLabel('nama field','nama field yang akan diubah');

        */
";

/*here defined align width and label on module*/
$i=0;
foreach ($_POST['txtinput'] as $f =>$v) { 
    if($showonform[$i]==1){
    $html .= "
        \$grid->setWidth('".trim($v)."', '100');
        \$grid->setAlign('".trim($v)."', 'left');
        \$grid->setLabel('".trim($v)."','".$txtlabel[$i]."');
    ";
    }

$i++;
  
}

/*here defined align width and label on module*/

$html .= "
//Example modifikasi GRID ERP
    //- Set Query
        /*if (\$this->validation) {
            \$grid->setQuery('lDeleted = 0 ', null); 
        }*/

        

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
             ";
//$ljenis = array(1=>'Input Field', 2=>'Number', 3=>'Date Picker',4=>'Text Area',5=>'Dropdown Static',6=>'Dropdown Dynamic',7=>'Upload File');

/*cek ada tidak nya yang tipe upload*/
$i=0;
$ada= false;
foreach ($_POST['txtinput'] as $f =>$v) { 
    if($showonform[$i]==1){
        if ($jenis_input[$i] == 7) {
            $ada=true;
        }
    }
    $i++;
}


/*cek ada tidak nya yang tipe upload*/

if ($ada) {
    # ada yang tipe upload 
    $html .= "
                case 'createproses':
                    \$isUpload = \$this->input->get('isUpload');
                    \$lastId = \$this->input->get('lastId');

                    if(\$isUpload) {
                        

                    ";
                    
                    $i=0;
                    $ada= false;
                    foreach ($_POST['txtinput'] as $f =>$v) { 
                        if($showonform[$i]==1){
                            if ($jenis_input[$i] == 7) {

                                $html .="
                                            \$path = realpath('files/folder_app/".$createname_space."/".trim($v)."');

                                            if(!file_exists(\$path.'/'.\$lastId)){
                                                if (!mkdir(\$path.'/'.\$lastId, 0777, true)) { 
                                                    die('Failed upload, try again!');
                                                }
                                            }
                                        ";



                            }
                        }
                        $i++;
                    }
            

                    $i=0;
                    $ada= false;
                    foreach ($_POST['txtinput'] as $f =>$v) { 
                        if($showonform[$i]==1){
                            if ($jenis_input[$i] == 7) {
                                    // jika tipenya upload maka, define variable dan tabel untuk simpan datanya

                                $html .= "

                                        \$file_name_".trim($v)."= '';
                                        \$file_vKeterangan_".trim($v)." = array();
                                        \$fileId_".trim($v)." = array();

                                ";

                                $html .= "
                                        foreach(\$_POST as \$key=>\$value) {

                                            if (\$key == 'file_vKeterangan_".trim($v)."') {
                                                foreach(\$value as \$y=>\$u) {
                                                    \$file_vKeterangan_".trim($v)."[\$y] = \$u;
                                                }
                                            }

                                        }

                                        \$i=0;
                                        foreach (\$_FILES['fileupload_".trim($v)."']['error'] as \$key => \$error) {
                                            if (\$error == UPLOAD_ERR_OK) {
                                                \$tmp_name = \$_FILES['fileupload_".trim($v)."']['tmp_name'][\$key];
                                                \$name = \$_FILES['fileupload_".trim($v)."']['name'][\$key];
                                                
                                                \$now_u = date('Y_m_d__H_i_s');
                                                \$name_generate = \$i.'__'.\$now_u.'__'.\$_FILES['fileupload_".trim($v)."']['name'][\$key];

                                                \$now = date('Y-m-d H:i:s');
                                                \$logged_nip = \$this->user->gNIP;
                                                \$tabel_file = '".$openTable."_".trim($v)."';
                                                \$tabel_file_pk = ".$field_pk.";
                                                


                                                if(move_uploaded_file(\$tmp_name, \$path.'/'.\$lastId.'/'.\$name_generate)) {
                                                    \$sql[]= '
                                                        insert into ".$openDatabase.".".$openTable."_".trim($v)."('.\$tabel_file_pk.', vFilename, vFilename_generate, vKeterangan, dCreated, cCreate)
                                                        values('.\$lastId.'
                                                        ,".'"'.""."'.\$name.'"."".'"'." 
                                                        ,".'"'.""."'.\$name_generate.'"."".'"'." 
                                                        , ".'"'.""."'.\$file_vKeterangan_".trim($v)."[\$i].'"."".'"'." 
                                                        ,".'"'.""."'.\$now.'"."".'"'." 
                                                        ,".'"'.""."'.\$logged_nip.'"."".'"'." 
                                                        )

                                                    
                                                    ';
                                                    \$i++;   

                                                }else{

                                                    echo 'Upload ke folder gagal';  
                                                }


                                            }

                                        }

                                        foreach(\$sql as \$q) {
                                            try {
                                                \$this->dbset->query(\$q);
                                            }catch(Exception \$e) {
                                                die(\$e);
                                            }
                                        }
                                        
                                        \$r['message']='Data Berhasil Disimpan';
                                        \$r['status'] = TRUE;
                                        \$r['last_id'] = \$this->input->get('lastId');                    
                                        echo json_encode(\$r);



                                ";


                            }
                        }
                        $i++;
                    }



        $html .= "

                    }else{
                        echo \$grid->saved_form();
                    }
                    break;
                    
           ";


}else{
    $html .= "
                case 'createproses':
                    echo \$grid->saved_form();
                    break;
           ";
}

$html .= "       
           
            
            case 'update':
                    \$grid->render_form(\$this->input->get('id'));
                    break;

        ";


/*cek ada tidak nya yang tipe upload*/
$i=0;
$ada= false;
foreach ($_POST['txtinput'] as $f =>$v) { 
    if($showonform[$i]==1){
        if ($jenis_input[$i] == 7) {
            $ada=true;
        }
    }
    $i++;
}


/*cek ada tidak nya yang tipe upload*/

if ($ada) {
    # ada yang tipe upload 
    $html .= "
                case 'updateproses':
                    \$isUpload = \$this->input->get('isUpload');
                    \$post= \$this->input->post();
                    \$lastId = \$post['".$createname_space."_".$field_pk1."'];


                    ";
                    
                    $i=0;
                    $ada= false;
                    foreach ($_POST['txtinput'] as $f =>$v) { 
                        if($showonform[$i]==1){
                            if ($jenis_input[$i] == 7) {

                                $html .="
                                            \$path = realpath('files/folder_app/".$createname_space."/".trim($v)."');

                                            if(!file_exists(\$path.'/'.\$lastId)){
                                                if (!mkdir(\$path.'/'.\$lastId, 0777, true)) { 
                                                    die('Failed upload, try again!');
                                                }
                                            }
                                        ";



                            }
                        }
                        $i++;
                    }
            

                    $i=0;
                    $ada= false;
                    foreach ($_POST['txtinput'] as $f =>$v) { 
                        if($showonform[$i]==1){
                            if ($jenis_input[$i] == 7) {
                                    // jika tipenya upload maka, define variable dan tabel untuk simpan datanya

                                $html .= "

                                        \$file_name_".trim($v)."= '';
                                        \$file_vKeterangan_".trim($v)." = array();
                                        \$fileId_".trim($v)." = array();
                                        \$fileid = '';

                                        
                                        

                                ";

                                $html .= "
                                        foreach(\$_POST as \$key=>\$value) {

                                            if (\$key == 'file_vKeterangan_".trim($v)."') {
                                                foreach(\$value as \$y=>\$u) {
                                                    \$file_vKeterangan_".trim($v)."[\$y] = \$u;
                                                }
                                            }

                                            

                                            if (\$key == 'fileid_".trim($v)."') {
                                                \$i=0;
                                                foreach(\$value as \$k1=>\$v1) {
                                                    if(\$i==0){
                                                        \$fileid .= ".'"'."'".'"'.".\$v1.".'"'."'".'"'."".";
                                                    }else{
                                                        \$fileid .= ".'"'.",'".'"'.".\$v1.".'"'."'".'"'."".";
                                                    }
                                                    \$i++;
                                                }
                                            }


                                        }


                                ";

                                $html .="
                                            if(\$isUpload) {

                                                if(\$fileid!='' and \$lastId != ''){
                                                    \$tgl= date('Y-m-d H:i:s');
                                                     \$sql1 = 'update ".$openDatabase.".".$openTable."_".trim($v)."
                                                            set lDeleted=1
                                                            ,dUpdated= ".'"'.""."'.\$tgl.'"."".'"'." 
                                                            ,cUpdated= ".'"'.""."'.\$this->user->gNIP.'"."".'"'." 
                                                            where 
                                                            ".$field_pk1." = ".'"'.""."'.\$lastId.'"."".'"'." 
                                                            and 
                                                            ".$field_pk1."_".trim($v)." not in ("."'.\$fileid.'".")
                                                            

                                                            ';
                                                    \$this->dbset->query(\$sql1);
                                                }else{
                                                    \$tgl= date('Y-m-d H:i:s');
                                                    \$sql1 = 'update ".$openDatabase.".".$openTable."_".trim($v)."
                                                            set lDeleted=1
                                                            ,dUpdated= ".'"'.""."'.\$tgl.'"."".'"'." 
                                                            ,cUpdated= ".'"'.""."'.\$this->user->gNIP.'"."".'"'." 
                                                            where 
                                                            ".$field_pk1." = ".'"'.""."'.\$lastId.'"."".'"'." 

                                                            ';
                                                    \$this->dbset->query(\$sql1);
                                                }


                                                \$i=0;
                                                foreach (\$_FILES['fileupload_".trim($v)."']['error'] as \$key => \$error) {
                                                    if (\$error == UPLOAD_ERR_OK) {
                                                        \$tmp_name = \$_FILES['fileupload_".trim($v)."']['tmp_name'][\$key];
                                                        \$name = \$_FILES['fileupload_".trim($v)."']['name'][\$key];
                                                        \$now_u = date('Y_m_d__H_i_s');
                                                        \$name_generate = \$i.'__'.\$now_u.'__'.\$_FILES['fileupload_".trim($v)."']['name'][\$key];

                                                        \$now = date('Y-m-d H:i:s');
                                                        \$logged_nip = \$this->user->gNIP;
                                                        \$tabel_file = '".$openTable."_".trim($v)."';
                                                        \$tabel_file_pk = ".$field_pk.";
                                                        


                                                        if(move_uploaded_file(\$tmp_name, \$path.'/'.\$lastId.'/'.\$name_generate)) {
                                                            \$sql[]= '
                                                                insert into ".$openDatabase.".".$openTable."_".trim($v)."('.\$tabel_file_pk.', vFilename, vFilename_generate, vKeterangan, dCreated, cCreate)
                                                                values('.\$lastId.'
                                                                ,".'"'.""."'.\$name.'"."".'"'." 
                                                                ,".'"'.""."'.\$name_generate.'"."".'"'." 
                                                                , ".'"'.""."'.\$file_vKeterangan_".trim($v)."[\$i].'"."".'"'." 
                                                                ,".'"'.""."'.\$now.'"."".'"'." 
                                                                ,".'"'.""."'.\$logged_nip.'"."".'"'." 
                                                                )

                                                            
                                                            ';
                                                            \$i++;   

                                                        }else{

                                                            echo 'Upload ke folder gagal';  
                                                        }


                                                    }

                                                }

                                                foreach(\$sql as \$q) {
                                                    try {
                                                        \$this->dbset->query(\$q);
                                                    }catch(Exception \$e) {
                                                        die(\$e);
                                                    }
                                                }
                                                
                                                \$r['message']='Data Berhasil Disimpan';
                                                \$r['status'] = TRUE;
                                                \$r['last_id'] = \$this->input->get('lastId');                    
                                                echo json_encode(\$r);



                                        
                                        ";
                                $html .= "

                                            }else{

                                        ";
                                $html .= "

                                                if(\$fileid!='' and \$lastId != ''){
                                                    \$tgl= date('Y-m-d H:i:s');
                                                     \$sql1 = 'update ".$openDatabase.".".$openTable."_".trim($v)."
                                                            set lDeleted=1
                                                            ,dUpdated= ".'"'.""."'.\$tgl.'"."".'"'." 
                                                            ,cUpdated= ".'"'.""."'.\$this->user->gNIP.'"."".'"'." 
                                                            where 
                                                            ".$field_pk1." = ".'"'.""."'.\$lastId.'"."".'"'." 
                                                            and 
                                                            ".$field_pk1."_".trim($v)." not in ("."'.\$fileid.'".")
                                                            

                                                            ';
                                                    \$this->dbset->query(\$sql1);
                                                }else{
                                                    \$tgl= date('Y-m-d H:i:s');
                                                    \$sql1 = 'update ".$openDatabase.".".$openTable."_".trim($v)."
                                                            set lDeleted=1
                                                            ,dUpdated= ".'"'.""."'.\$tgl.'"."".'"'." 
                                                            ,cUpdated= ".'"'.""."'.\$this->user->gNIP.'"."".'"'." 
                                                            where 
                                                            ".$field_pk1." = ".'"'.""."'.\$lastId.'"."".'"'." 

                                                            ';
                                                    \$this->dbset->query(\$sql1);
                                                }




                                ";                                        

                                $html .="


                                                echo \$grid->updated_form();
                                            }
                                            break;
                                            
                                   ";



                            }
                        }
                        $i++;
                    }



        


}else{
    $html .="
            case 'updateproses':
                    echo \$grid->updated_form();
                    break;
        
        ";
}




$html .="
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
                case 'download':
                    \$this->download(\$this->input->get('file'));
                    break;
            default:
                    \$grid->render_grid();
                    break;
        }
    }



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

/*here manipulate input field*/
    //$ljenis = array(1=>'Input Field', 2=>'Number', 3=>'Date Picker',4=>'Text Area',5=>'Dropdown Static',6=>'Dropdown Dynamic',7=>'Upload File');
$i=0;
foreach ($_POST['txtinput'] as $f =>$v) { 
    if($showonform[$i]==1){
        switch ($jenis_input[$i]) {
            case '2':
                #number
                $html .="
                        function insertBox_".$createname_space."_".trim($v)."(\$field, \$id) {";
                        $html .="
                            \$return = '<input type=".'"text"'." name=".'"'.""."'.\$field.'"."".'"'."  id=".'"'.""."'.\$id.'"."".'"'."  class=".'"input_rows1 angka required"'." size=".'"10"'." />';";
                $html .="
                            return \$return;
                        }
                        ";

                $html .="
                        function updateBox_".$createname_space."_".trim($v)."(\$field, \$id, \$value, \$rowData) {";
                        $html .="
                                if (\$this->input->get('action') == 'view') {
                                     \$return= \$value; 
                                }else{ ";
                                $html .="
                                    \$return = '<input type=".'"text"'." name=".'"'.""."'.\$field.'"."".'"'."  id=".'"'.""."'.\$id.'"."".'"'."  class=".'"input_rows1 angka required"'." size=".'"10"'." value=".'"'.""."'.\$value.'"."".'"'."/>';";
                                $html .="

                                }
                                ";                                     
                $html .="
                            return \$return;
                        }
                        ";

                break;
            
            case '3':
            #date
                $html .="
                        function insertBox_".$createname_space."_".trim($v)."(\$field, \$id) {";
                        $html .="
                            \$return = '<input type=".'"text"'." name=".'"'.""."'.\$field.'"."".'"'."  id=".'"'.""."'.\$id.'"."".'"'."  class=".'"input_rows1 tanggal required"'." size=".'"8"'." />';";
                $html .="
                            return \$return;
                        }
                        ";


                $html .="
                        function updateBox_".$createname_space."_".trim($v)."(\$field, \$id, \$value, \$rowData) {";
                        $html .="
                                if (\$this->input->get('action') == 'view') {
                                     \$return= \$value; 
                                }else{ ";
                                $html .="
                                    \$return = '<input type=".'"text"'." name=".'"'.""."'.\$field.'"."".'"'."  id=".'"'.""."'.\$id.'"."".'"'."  class=".'"input_rows1 tanggal  required"'." size=".'"8"'." value=".'"'.""."'.\$value.'"."".'"'."/>';";
                                $html .="

                                }
                                ";                                     
                $html .="
                            return \$return;
                        }
                        ";


                break;

            case '4':
            #text Area
                $html .="
                        function insertBox_".$createname_space."_".trim($v)."(\$field, \$id) {";
                        $html .="
                            \$return = '<textarea name=".'"'.""."'.\$field.'"."".'"'." id=".'"'.""."'.\$id.'"."".'"'." class=".'"required"'." style=".'"width: 240px; height: 75px;"'." size=".'"250"'." maxlength =".'"250"'."></textarea>';";
                $html .="
                            return \$return;
                        }
                        ";


                $html .="
                        function updateBox_".$createname_space."_".trim($v)."(\$field, \$id, \$value, \$rowData) {";
                        $html .="
                                if (\$this->input->get('action') == 'view') {
                                     \$return= '<label title=".'"'."Note".'"'.">'.nl2br(\$value).'</label>'; 
                                }else{ ";
                                $html .="
                                    \$return = '<textarea name=".'"'.""."'.\$field.'"."".'"'." id=".'"'.""."'.\$id.'"."".'"'." class=".'"required"'." style=".'"width: 240px; height: 75px;"'." size=".'"250"'." maxlength =".'"250"'.">'.nl2br(\$value).'</textarea>';";
                                $html .="

                                }
                                ";                                     
                $html .="
                            return \$return;
                        }
                        ";
                break;
            case '5':
                # dropdown static
                $html .="
                        function insertBox_".$createname_space."_".trim($v)."(\$field, \$id) {";
                        $html .="
                            \$pilihan = array(0=>'--Pilih--',1=>'Satu', 2=>'Dua');
                            \$return = '<select class=".'"input_rows1 required"'." name=".'"'.""."'.\$field.'"."".'"'."  id=".'"'.""."'.\$id.'"."".'"'.">';            
                            foreach(\$pilihan as \$k=>\$v) {
                                \$return .= '<option value=".'"'.""."'.\$k.'"."".'"'.">"."'.\$v.'"."</option>';
                            }            
                            \$return .= '</select>';

                        ";
                $html .="
                            return \$return;
                        }
                        ";


                $html .="
                        function updateBox_".$createname_space."_".trim($v)."(\$field, \$id, \$value, \$rowData) {";
                        $html .="
                            \$pilihan = array(0=>'--Pilih--',1=>'Satu', 2=>'Dua');
                            if (\$this->input->get('action') == 'view') {
                                \$return = \$pilihan[\$value];
                            } else {
                                \$return = '<select class=".'"input_rows1 required"'." name=".'"'.""."'.\$field.'"."".'"'."  id=".'"'.""."'.\$id.'"."".'"'.">';            
                                foreach(\$pilihan as \$k=>\$v) {
                                    if (\$k == \$value) \$selected = ' selected';
                                    else \$selected = '';
                                    \$return .= '<option "."'.\$selected.'"." value=".'"'.""."'.\$k.'"."".'"'.">"."'.\$v.'"."</option>';
                                }            
                                \$return .= '</select>';
                            }
                                
                                ";                                     
                $html .="
                            return \$return;
                        }
                        ";



                break;

            case '6':
                # Dynamic Dropdown
                $html .="
                        function insertBox_".$createname_space."_".trim($v)."(\$field, \$id) {";
                        $html .="
                            
                            \$sql = 'select * from hrd.employee a  limit 10 ';
                            \$pilihan = \$this->dbset->query(\$sql)->result_array();

                            \$return = '<select class=".'"input_rows1 required"'." name=".'"'.""."'.\$field.'"."".'"'."  id=".'"'.""."'.\$id.'"."".'"'.">';            
                            foreach(\$pilihan as \$me) {
                                \$return .= '<option value="."'.\$me['cNip'].'".">"."'.\$me['vName'].'"."</option>';
                            }            
                            \$return .= '</select>';

                        ";
                $html .="
                            return \$return;
                        }
                        ";


                $html .="
                        function updateBox_".$createname_space."_".trim($v)."(\$field, \$id, \$value, \$rowData) {";
                        $html .="
                            

                            if (\$this->input->get('action') == 'view') {
                                \$sql = 'select * from hrd.employee a  where a.cNip ="."'."."\$value".".'"." ';
                                \$me = \$this->dbset->query(\$sql)->row_array();

                                \$return = \$me['vName'];
                            } else {
                                \$sql = 'select * from hrd.employee a  limit 10 ';
                                \$pilihan = \$this->dbset->query(\$sql)->result_array();

                                \$return = '<select  class=".'"input_rows1 required"'." name=".'"'.""."'.\$field.'"."".'"'."  id=".'"'.""."'.\$id.'"."".'"'.">';            
                                foreach(\$pilihan as \$me) {
                                    if (\$me['cNip'] == \$value) \$selected = ' selected';
                                    else \$selected = '';
                                    \$return .= '<option "."'.\$selected.'"." value="."'.\$me['cNip'].'".">"."'.\$me['vName'].'"."</option>';
                                }            
                                \$return .= '</select>';
                            }
                                
                                ";                                     
                $html .="
                            return \$return;
                        }
                        ";

                break;

                case '7':
                    # Upload File

                $html .="
                        function insertBox_".$createname_space."_".trim($v)."(\$field, \$id) {";
                        $html .="
                           

                           \$tabel_file = '".$openTable."_".trim($v)."';
                           \$tabel_file_pk = ".$field_pk.";
                           \$tabel_file_pk_id = '".$field_pk1."_".trim($v)."';

                           

                           \$data['date'] = date('Y-m-d H:i:s');    
                           \$data['tabel_file'] = \$tabel_file;
                           \$data['tabel_file_pk'] = \$tabel_file_pk;
                           \$data['nmfield'] = \$field;
                           \$data['tabel_file_pk_id'] = \$tabel_file_pk_id;
                           

                           \$return = '<input type=".'"hidden"'." name=".'"'.""."'.\$field.'"."".'"'."  id=".'"'.""."'.\$id.'"."".'"'."  class=".'"input_rows1"'." size=".'"30"'."  />';
                           \$return .= \$this->load->view('partial/".$createname_space."_".trim($v)."',\$data,TRUE);


                        ";
                $html .="
                            return \$return;
                        }
                        ";


                $html .="
                        function updateBox_".$createname_space."_".trim($v)."(\$field, \$id, \$value, \$rowData) {";
                $html .="
                           \$tabel_file = '".$openTable."_".trim($v)."';
                           \$tabel_file_pk = ".$field_pk.";
                           \$tabel_file_pk_id = '".$field_pk1."_".trim($v)."';

                           \$path = 'files/folder_app/".$createname_space."/".trim($v)."';
                           \$createname_space = '".$createname_space."';
                           \$tempat = '".$createname_space."/".trim($v)."';
                           \$FOLDER_APP = 'folder_app';


                            \$qr='select * from ".$openDatabase.".".$openTable."_".trim($v)." where lDeleted=0 and  ".$field_pk1." ="."'."."\$rowData[".$field_pk."]".".'"."  ';
                            \$data['rows'] = \$this->dbset->query(\$qr)->result_array();


                           \$data['date'] = date('Y-m-d H:i:s');    
                           \$data['tabel_file'] = \$tabel_file;
                           \$data['tabel_file_pk'] = \$tabel_file_pk;
                           \$data['tabel_file_pk_id'] = \$tabel_file_pk_id;
                           \$data['nmfield'] = \$field;
                           \$data['path'] = \$path;
                           \$data['FOLDER_APP'] = \$FOLDER_APP;
                           \$data['createname_space'] = \$createname_space;
                           \$data['tempat'] = \$tempat;

                           \$return = '<input type=".'"hidden"'." name=".'"'.""."'.\$field.'"."".'"'."  id=".'"'.""."'.\$id.'"."".'"'."  class=".'"input_rows1"'." size=".'"30"'."  />';
                           \$return .= \$this->load->view('partial/".$createname_space."_".trim($v)."',\$data,TRUE);

                ";
        $html .="
                    return \$return;
                }
                ";


                    break;

            default:
                # 1=> input field biasa
                $html .="
                        function insertBox_".$createname_space."_".trim($v)."(\$field, \$id) {";
                        $html .="
                            \$return = '<input type=".'"text"'." name=".'"'.""."'.\$field.'"."".'"'."  id=".'"'.""."'.\$id.'"."".'"'."  class=".'"input_rows1 required"'." size=".'"30"'."  />';";
                $html .="
                            return \$return;
                        }
                        ";


                $html .="
                        function updateBox_".$createname_space."_".trim($v)."(\$field, \$id, \$value, \$rowData) {";
                        $html .="
                                if (\$this->input->get('action') == 'view') {
                                     \$return= \$value; 
                                }else{ ";
                                $html .="
                                    \$return = '<input type=".'"text"'." name=".'"'.""."'.\$field.'"."".'"'."  id=".'"'.""."'.\$id.'"."".'"'."  class=".'"input_rows1  required"'." size=".'"30"'." value=".'"'.""."'.\$value.'"."".'"'."/>';";
                                $html .="

                                }
                                ";                                     
                $html .="
                            return \$return;
                        }
                        ";


                break;
        }

    }

$i++;
  
}

/*here manipulate input field*/


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
                    <input type=".'"'."hidden".'"'." name=".'"'."modul_id".'"'." value=".'"'."'.\$this->input->get('modul_id').'".'"'." />
                    <input type=".'"'."hidden".'"'." name=".'"'."lvl".'"'." value=".'"'."'.\$this->input->get('lvl').'".'"'." />
                    <input type=".'"'."hidden".'"'." name=".'"'."group_id".'"'." value=".'"'."'.\$this->input->get('group_id').'".'"'." />
                    
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
                    <input type=".'"'."hidden".'"'." name=".'"'."modul_id".'"'." value=".'"'."'.\$this->input->get('modul_id').'".'"'." />
                    <input type=".'"'."hidden".'"'." name=".'"'."lvl".'"'." value=".'"'."'.\$this->input->get('lvl').'".'"'." />
                    <input type=".'"'."hidden".'"'." name=".'"'."group_id".'"'." value=".'"'."'.\$this->input->get('group_id').'".'"'." />
                    
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
    //Standart Setiap table harus memiliki dCreated , cCreated, dUpdated, cUpdated
    function before_insert_processor(\$row, \$postData) {
        \$postData['dCreated'] = date('Y-m-d H:i:s');
        \$postData['cCreated']=\$this->user->gNIP;


        if(\$postData['isdraft']==true){
            \$postData['iSubmit']=0;
        } else{
            \$postData['iSubmit']=1;
        } 


        return \$postData;

    }
    function before_update_processor(\$row, \$postData) {
        \$postData['dUpdated'] = date('Y-m-d H:i:s');
        \$postData['cUpdated'] = \$this->user->gNIP;

        if(\$postData['isdraft']==true){
            \$postData['iSubmit']=0;
        } else{
            \$postData['iSubmit']=1;
        } 


        return \$postData; 
    }    
";

$html .="
    function after_insert_processor(\$fields, \$id, \$postData) {
        //Example After Insert
        /*
        \$cNip = \$this->sess_auth->gNIP; 
        \$sql = 'Place Query In Here';
        \$this->dbset->query(\$sql);
        */
    }

    function after_update_processor(\$fields, \$id, \$postData) {
        //Example After Update
        /*
        \$cNip = \$this->sess_auth->gNIP; 
        \$sql = 'Place Query In Here';
        \$this->dbset->query(\$sql);
        */
    }
";


$html .="
    function manipulate_insert_button(\$buttons) { 
        //Load Javascript In Here 
        \$cNip= \$this->user->gNIP;
        \$js = \$this->load->view('js/standard_js');
        \$js .= \$this->load->view('js/upload_js');

        \$iframe = '<iframe name=".'"'.$createname_space.'_frame"'." id=".'"'.$createname_space.'_frame"'." height=".'"0"'." width=".'"0"'."></iframe>';
        
        \$save_draft = '<button onclick=".'"'."javascript:save_draft_btn_multiupload(\'".$createname_space."\', \' '.base_url().'processor/folder_app/".$createname_space."?draft=true \',this,true )".'"'."  id=".'"'."button_save_draft_".$createname_space.'"'."  class=".'"'."ui-button-text icon-save".'"'." >Save as Draft</button>';
        \$save = '<button onclick=".'"'."javascript:save_btn_multiupload(\'".$createname_space."\', \' '.base_url().'processor/folder_app/".$createname_space."?company_id="."'."."\$this->input->get('company_id')".".'"."&group_id="."'."."\$this->input->get('group_id')".".'"."modul_id="."'."."\$this->input->get('modul_id')".".'"." \',this,true )".'"'."  id=".'"'."button_save_submit_".$createname_space.'"'."  class=".'"'."ui-button-text icon-save".'"'." >Save &amp; Submit</button>';

        

        \$buttons['save'] = \$iframe.\$save_draft.\$save.\$js;
        
        return \$buttons;
    }
";


$html .="
    function manipulate_update_button(\$buttons, \$rowData) { 
        \$peka=\$rowData[".$field_pk."];


        //Load Javascript In Here 
        \$cNip= \$this->user->gNIP;
        \$js = \$this->load->view('js/standard_js');
        \$js .= \$this->load->view('js/upload_js');

        \$iframe = '<iframe name=".'"'.$createname_space.'_frame"'." id=".'"'.$createname_space.'_frame"'." height=".'"0"'." width=".'"0"'."></iframe>';
        
        \$update_draft = '<button onclick=".'"'."javascript:update_draft_btn(\'".$createname_space."\', \' '.base_url().'processor/folder_app/".$createname_space."?draft=true \',this,true )".'"'."  id=".'"'."button_update_draft_".$createname_space.'"'."  class=".'"'."ui-button-text icon-save".'"'." >Update as Draft</button>';
        \$update = '<button onclick=".'"'."javascript:update_btn_back(\'".$createname_space."\', \' '.base_url().'processor/folder_app/".$createname_space."?company_id="."'."."\$this->input->get('company_id')".".'"."&group_id="."'."."\$this->input->get('group_id')".".'"."modul_id="."'."."\$this->input->get('modul_id')".".'"." \',this,true )".'"'."  id=".'"'."button_update_submit_".$createname_space.'"'."  class=".'"'."ui-button-text icon-save".'"'." >Update &amp; Submit</button>';

        \$approve = '<button onclick=".'"'."javascript:load_popup(\' '.base_url().'processor/folder_app/".$createname_space."?action=approve&$field_pk1="."'."."\$peka."."'&company_id="."'."."\$this->input->get('company_id')".".'"."&group_id="."'."."\$this->input->get('group_id')".".'"."&modul_id="."'."."\$this->input->get('modul_id')".".'"." \')".'"'."  id=".'"'."button_approve_".$createname_space.'"'."  class=".'"'."ui-button-text icon-save".'"'." >Approve</button>';
        \$reject = '<button onclick=".'"'."javascript:load_popup(\' '.base_url().'processor/folder_app/".$createname_space."?action=reject&$field_pk1="."'."."\$peka."."'&company_id="."'."."\$this->input->get('company_id')".".'"."&group_id="."'."."\$this->input->get('group_id')".".'"."&modul_id="."'."."\$this->input->get('modul_id')".".'"." \' )".'"'."  id=".'"'."button_reject_".$createname_space.'"'."  class=".'"'."ui-button-text icon-save".'"'." >Reject</button>';
        



        if (\$this->input->get('action') == 'view') {
            unset(\$buttons['update']);
        }
        else{ 
            \$buttons['update'] = \$iframe.\$update_draft.\$update.\$js;    
        }
        
        return \$buttons;
    }
";

$html .="
    function whoAmI(\$nip) { 
        \$sql = 'select b.vDescription as vdepartemen,a.*,b.*,c.iLvlemp 
                        from hrd.employee a 
                        join hrd.msdepartement b on b.iDeptID=a.iDepartementID
                        join hrd.position c on c.iPostId=a.iPostID
                        where a.cNip =".'"'."'."."\$nip".".'".'"'."
                        ';
        
        \$data = \$this->dbset->query(\$sql)->row_array();
        return \$data;
    }
";

$html .="
    function download(\$vFilename) { 
        \$this->load->helper('download');        
        \$name = \$vFilename;
        \$id = \$_GET['id'];
        \$tempat = \$_GET['path'];    
        \$path = file_get_contents('./files/folder_app/'.\$tempat.'/'.\$id.'/'.\$name);    
        force_download(\$name, \$path);


    }
";




$html .="
    //Output
    public function output(){
        \$this->index(\$this->input->get('action'));
    }

}
";




        /*draw controller here*/


        $dir = $path1."/controllers";
        $file_to_write = $createname_space.'.php';

        $r = array(
            'Nama_Controller' => $createname_space,
            'Nama_Module' => $openModule,
            'Nama_Database' => $openDatabase,
            'Nama_Table' => $openTable,
            'Generate_By' => 'Softdev 2',
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
