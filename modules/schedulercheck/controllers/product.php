 
<?php
/* Generated by Softdev 2 ERP Module Generator 2018-11-06 15:11:57 */
/* Location: ./modules/menu/controllers/product.php */
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
 


 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class product extends MX_Controller {
    function __construct() {
        parent::__construct();
        $this->db = $this->load->database('hrd',false, true);
        $this->db_schedulercheck = $this->load->database('schedulercheck',false, true);
        $this->load->library('auth');
        $this->user = $this->auth->user();

        $checkMod = $this->auth->modul_set($this->input->get('modul_id'));
        $this->validation =$checkMod['iValidation'];


    }

    function index($action = '') {
        $action = $this->input->get('action');
        //Bikin Object Baru Nama nya $grid      
        $grid = new Grid;
        $grid->setTitle('Product');
        $grid->setTable('test.item');      
        $grid->setUrl('product');

        //List Table
        $grid->addList('vNama_item'); 
        $grid->setSortBy('iItem');
        $grid->setSortOrder('DESC');  

        //List field
        $grid->addFields('vNama_item','file_upload'); 

        //Setting Grid Width Name 
        /*
        Kamu bisa merubah nama label dari sini, Contoh :
        $grid->setLabel('nama field','nama field yang akan diubah');

        */

        $grid->setWidth('vNama_item', '100');
        $grid->setAlign('vNama_item', 'left');
        $grid->setLabel('vNama_item','Nama Item');
    
        $grid->setWidth('file_upload', '100');
        $grid->setAlign('file_upload', 'left');
        $grid->setLabel('file_upload','File Upload');
    
//Example modifikasi GRID ERP
    //- Set Query
        if ($this->validation) {
            $grid->setQuery('lDeleted = 0 ', null); 
        }

        

/*
    - Set Query
        $grid->setQuery('lDeleted = 0 ', null); 
        $grid->setQuery('plc2_upb.iupb_id IN (select distinct(bk.iupb_id) from plc2.plc2_upb_spesifikasi_fg bk where bk.iappqa=2 and bk.ldeleted=0)', null);  

    - Join Table
        $grid->setJoinTable('hrd.employee', 'employee.cNip = pk_master.vnip', 'inner');

    - Change Field Name
        $grid->changeFieldType('ideleted','combobox','',array(''=>'Pilih',0=>'Aktif',1=>'Tidak aktif'));
*/

    //set search
        $grid->setSearch('vNama_item');
        
    //set required
        $grid->setRequired('vNama_item','file_upload','dCreate','cCreated','dUpdate','cUpdate','lDeleted'); 
        $grid->setGridView('grid');


        switch ($action) {
            case 'json':
                    $grid->getJsonData();
                    break;
            case 'view':
                    $grid->render_form($this->input->get('id'), true);
                    break;

             case 'create':
                    $grid->render_form();
                    break;
             
                case 'createproses':
                    $isUpload = $this->input->get('isUpload');
                    $lastId = $this->input->get('lastId');

                    if($isUpload) {

                        /*echo $_POST['ke'];
                        exit;*/
                        

                    
                                            $path = realpath('files/schedulercheck/product/file_upload');

                                            if(!file_exists($path.'/'.$lastId)){
                                                if (!mkdir($path.'/'.$lastId, 0777, true)) { 
                                                    die('Failed upload, try again!');
                                                }
                                            }
                                        

                                        $file_name_file_upload= '';
                                        $file_vKeterangan_file_upload = array();
                                        $fileId_file_upload = array();

                                
                                        foreach($_POST as $key=>$value) {

                                            if ($key == 'file_vKeterangan_file_upload') {
                                                foreach($value as $y=>$u) {
                                                    $file_vKeterangan_file_upload[$y] = $u;
                                                }
                                            }

                                        }

                                        $i=0;
                                        foreach ($_FILES['fileupload_file_upload']['error'] as $key => $error) {
                                            if ($error == UPLOAD_ERR_OK) {
                                                $tmp_name = $_FILES['fileupload_file_upload']['tmp_name'][$key];
                                                $name = $_FILES['fileupload_file_upload']['name'][$key];
                                                
                                                $now_u = date('Y_m_d__H_i_s');
                                                $name_generate = $i.'__'.$now_u.'__'.$_FILES['fileupload_file_upload']['name'][$key];

                                                $now = date('Y-m-d H:i:s');
                                                $logged_nip = $this->user->gNIP;
                                                $tabel_file = 'item_file_upload';
                                                $tabel_file_pk = 'iItem';
                                                


                                                if(move_uploaded_file($tmp_name, $path.'/'.$lastId.'/'.$name_generate)) {
                                                    $sql[]= '
                                                        insert into test.item_file_upload('.$tabel_file_pk.', vFilename, vFilename_generate, vKeterangan, dCreate, cCreate)
                                                        values('.$lastId.'
                                                        ,"'.$name.'" 
                                                        ,"'.$name_generate.'" 
                                                        , "'.$file_vKeterangan_file_upload[$i].'" 
                                                        ,"'.$now.'" 
                                                        ,"'.$logged_nip.'" 
                                                        )

                                                    
                                                    ';
                                                    $i++;   

                                                }else{

                                                    echo 'Upload ke folder gagal';  
                                                }


                                            }

                                        }

                                        foreach($sql as $q) {
                                            try {
                                                $this->db_schedulercheck->query($q);
                                            }catch(Exception $e) {
                                                die($e);
                                            }
                                        }
                                        
                                        $r['message']='Data Berhasil Disimpan';
                                        $r['status'] = TRUE;
                                        $r['last_id'] = $this->input->get('lastId');                    
                                        echo json_encode($r);



                                

                    }else{
                        echo $grid->saved_form();
                    }
                    break;
                    
                  
           
            
            case 'update':
                    $grid->render_form($this->input->get('id'));
                    break;

        
                case 'updateproses':
                    $isUpload = $this->input->get('isUpload');
                    $post= $this->input->post();
                    $lastId = $post['product_iItem'];


                    
                                            $path = realpath('files/schedulercheck/product/file_upload');

                                            if(!file_exists($path.'/'.$lastId)){
                                                if (!mkdir($path.'/'.$lastId, 0777, true)) { 
                                                    die('Failed upload, try again!');
                                                }
                                            }
                                        

                                        $file_name_file_upload= '';
                                        $file_vKeterangan_file_upload = array();
                                        $fileId_file_upload = array();
                                        $fileid = '';

                                        
                                        

                                
                                        foreach($_POST as $key=>$value) {

                                            if ($key == 'file_vKeterangan_file_upload') {
                                                foreach($value as $y=>$u) {
                                                    $file_vKeterangan_file_upload[$y] = $u;
                                                }
                                            }

                                            

                                            if ($key == 'fileid_file_upload') {
                                                $i=0;
                                                foreach($value as $k1=>$v1) {
                                                    if($i==0){
                                                        $fileid .= "'".$v1."'";
                                                    }else{
                                                        $fileid .= ",'".$v1."'";
                                                    }
                                                    $i++;
                                                }
                                            }


                                        }


                                
                                            if($isUpload) {

                                                if($fileid!='' and $lastId != ''){
                                                    $tgl= date('Y-m-d H:i:s');
                                                     $sql1 = 'update test.item_file_upload
                                                            set lDeleted=1
                                                            ,dUpdate= "'.$tgl.'" 
                                                            ,cUpdate= "'.$this->user->gNIP.'" 
                                                            where 
                                                            iItem = "'.$lastId.'" 
                                                            and 
                                                            iItem_file_upload not in ('.$fileid.')
                                                            

                                                            ';
                                                    $this->db_schedulercheck->query($sql1);
                                                }else{
                                                    $tgl= date('Y-m-d H:i:s');
                                                    $sql1 = 'update test.item_file_upload
                                                            set lDeleted=1
                                                            ,dUpdate= "'.$tgl.'" 
                                                            ,cUpdate= "'.$this->user->gNIP.'" 
                                                            where 
                                                            iItem = "'.$lastId.'" 

                                                            ';
                                                    $this->db_schedulercheck->query($sql1);
                                                }


                                                $i=0;
                                                foreach ($_FILES['fileupload_file_upload']['error'] as $key => $error) {
                                                    if ($error == UPLOAD_ERR_OK) {
                                                        $tmp_name = $_FILES['fileupload_file_upload']['tmp_name'][$key];
                                                        $name = $_FILES['fileupload_file_upload']['name'][$key];
                                                        $now_u = date('Y_m_d__H_i_s');
                                                        $name_generate = $i.'__'.$now_u.'__'.$_FILES['fileupload_file_upload']['name'][$key];

                                                        $now = date('Y-m-d H:i:s');
                                                        $logged_nip = $this->user->gNIP;
                                                        $tabel_file = 'item_file_upload';
                                                        $tabel_file_pk = 'iItem';
                                                        


                                                        if(move_uploaded_file($tmp_name, $path.'/'.$lastId.'/'.$name_generate)) {
                                                            $sql[]= '
                                                                insert into test.item_file_upload('.$tabel_file_pk.', vFilename, vFilename_generate, vKeterangan, dCreate, cCreate)
                                                                values('.$lastId.'
                                                                ,"'.$name.'" 
                                                                ,"'.$name_generate.'" 
                                                                , "'.$file_vKeterangan_file_upload[$i].'" 
                                                                ,"'.$now.'" 
                                                                ,"'.$logged_nip.'" 
                                                                )

                                                            
                                                            ';
                                                            $i++;   

                                                        }else{

                                                            echo 'Upload ke folder gagal';  
                                                        }


                                                    }

                                                }

                                                foreach($sql as $q) {
                                                    try {
                                                        $this->db_schedulercheck->query($q);
                                                    }catch(Exception $e) {
                                                        die($e);
                                                    }
                                                }
                                                
                                                $r['message']='Data Berhasil Disimpan';
                                                $r['status'] = TRUE;
                                                $r['last_id'] = $this->input->get('lastId');                    
                                                echo json_encode($r);



                                        
                                        

                                            }else{

                                        

                                                if($fileid!='' and $lastId != ''){
                                                    $tgl= date('Y-m-d H:i:s');
                                                     $sql1 = 'update test.item_file_upload
                                                            set lDeleted=1
                                                            ,dUpdate= "'.$tgl.'" 
                                                            ,cUpdate= "'.$this->user->gNIP.'" 
                                                            where 
                                                            iItem = "'.$lastId.'" 
                                                            and 
                                                            iItem_file_upload not in ('.$fileid.')
                                                            

                                                            ';
                                                    $this->db_schedulercheck->query($sql1);
                                                }else{
                                                    $tgl= date('Y-m-d H:i:s');
                                                    $sql1 = 'update test.item_file_upload
                                                            set lDeleted=1
                                                            ,dUpdate= "'.$tgl.'" 
                                                            ,cUpdate= "'.$this->user->gNIP.'" 
                                                            where 
                                                            iItem = "'.$lastId.'" 

                                                            ';
                                                    $this->db_schedulercheck->query($sql1);
                                                }




                                


                                                echo $grid->updated_form();
                                            }
                                            break;
                                            
                                   
            case 'delete':
                    echo $grid->delete_row();
                    break; 
            /*
                //Ini Merupakan Standart Case Untuk Approve

                case 'approve':
                    echo $this->approve_view();
                    break;
                case 'approve_process':
                    echo $this->approve_process();
                    break;
                case 'reject':
                    echo $this->reject_view();
                    break;
                case 'reject_process':
                    echo $this->reject_process();
                    break;

                
            */ 
                case 'download':
                    $this->download($this->input->get('file'));
                    break;
            default:
                    $grid->render_grid();
                    break;
        }
    }



    //Jika Ingin Menambahkan Seting grid seperti button edit enable dalam kondisi tertentu
    /* 
    function listBox_Action($row, $actions) {
        if ($row->vNo_Or<>'' || $row->vNo_Or<>NULL) { 
                unset($actions['edit']);
        }
        return $actions;
    } 
    */

                        function insertBox_product_vNama_item($field, $id) {
                            $return = '<input type="text" name="'.$field.'"  id="'.$id.'"  class="input_rows1 required" size="30"  />';
                            return $return;
                        }
                        
                        function updateBox_product_vNama_item($field, $id, $value, $rowData) {
                                if ($this->input->get('action') == 'view') {
                                     $return= $value; 
                                }else{ 
                                    $return = '<input type="text" name="'.$field.'"  id="'.$id.'"  class="input_rows1  required" size="30" value="'.$value.'"/>';

                                }
                                
                            return $return;
                        }
                        
                        function insertBox_product_file_upload($field, $id) {
                           

                           $tabel_file = 'item_file_upload';
                           $tabel_file_pk = 'iItem';
                           $tabel_file_pk_id = 'iItem_file_upload';

                           

                           $data['date'] = date('Y-m-d H:i:s');    
                           $data['tabel_file'] = $tabel_file;
                           $data['tabel_file_pk'] = $tabel_file_pk;
                           $data['nmfield'] = $field;
                           $data['tabel_file_pk_id'] = $tabel_file_pk_id;
                           

                           $return = '<input type="hidden" name="'.$field.'"  id="'.$id.'"  class="input_rows1" size="30"  />';
                           $return .= $this->load->view('partial/product_file_upload',$data,TRUE);


                        
                            return $return;
                        }
                        
                        function updateBox_product_file_upload($field, $id, $value, $rowData) {
                           $tabel_file = 'item_file_upload';
                           $tabel_file_pk = 'iItem';
                           $tabel_file_pk_id = 'iItem_file_upload';

                           $path = 'files/schedulercheck/product/file_upload';
                           $createname_space = 'product';
                           $tempat = 'product/file_upload';
                           $FOLDER_APP = 'schedulercheck';


                            $qr='select * from test.item_file_upload where lDeleted=0 and  iItem ='.$rowData['iItem'].'  ';
                            $data['rows'] = $this->db_schedulercheck->query($qr)->result_array();


                           $data['date'] = date('Y-m-d H:i:s');    
                           $data['tabel_file'] = $tabel_file;
                           $data['tabel_file_pk'] = $tabel_file_pk;
                           $data['tabel_file_pk_id'] = $tabel_file_pk_id;
                           $data['nmfield'] = $field;
                           $data['path'] = $path;
                           $data['FOLDER_APP'] = $FOLDER_APP;
                           $data['createname_space'] = $createname_space;
                           $data['tempat'] = $tempat;

                           $return = '<input type="hidden" name="'.$field.'"  id="'.$id.'"  class="input_rows1" size="30"  />';
                           $return .= $this->load->view('partial/product_file_upload',$data,TRUE);

                
                    return $return;
                }
                
    /*
        //Ini Merupakan Standart Approve yang digunakan di erp
        function approve_view() {
            $echo = '<script type="text/javascript">
                         function submit_ajax(form_id) {
                            return $.ajax({
                                url: $("#"+form_id).attr("action"),
                                type: $("#"+form_id).attr("method"),
                                data: $("#"+form_id).serialize(),
                                success: function(data) {
                                    var o = $.parseJSON(data);
                                    var last_id = o.last_id;
                                    var url = "'.base_url().'processor/menu/product";                             
                                    if(o.status == true) { 
                                        $("#alert_dialog_form").dialog("close");
                                             $.get(url+"?action=update&id="+last_id, function(data) {
                                             $("div#form_product").html(data);
                                             
                                        });
                                        
                                    }
                                        reload_grid("grid_product");
                                }
                                
                             })
                         }
                     </script>';
            $echo .= '<h1>Approve</h1><br />';
            $echo .= '<form id="form_product_approve" action="'.base_url().'processor/menu/product?action=approve_process" method="post">';
            $echo .= '<div style="vertical-align: top;">';
            $echo .= 'Remark : 
                    <input type="hidden" name="iItem" value="'.$this->input->get('iItem').'" />
                    <input type="hidden" name="modul_id" value="'.$this->input->get('modul_id').'" />
                    <input type="hidden" name="lvl" value="'.$this->input->get('lvl').'" />
                    <input type="hidden" name="group_id" value="'.$this->input->get('group_id').'" />
                    
                    <textarea name="vRemark"></textarea>
            <button type="button" onclick="submit_ajax(\'form_product_approve\')">Approve</button>';
                
            $echo .= '</div>';
            $echo .= '</form>';
            return $echo;
        } 

        function approve_process() {
            $post = $this->input->post();
            $cNip= $this->user->gNIP;
            $vName= $this->user->gName;
            $iItem = $post['iItem'];
            $vRemark = $post['vRemark'];
            $lvl = $post['lvl'];

            //Letakan Query Update approve disini

            $data['status']  = true;
            $data['last_id'] = $post['iItem'];
            return json_encode($data);
        }
    */


    /*
        //Ini Merupakan Standart Reject yang digunakan di erp
        function reject_view() {
            $echo = '<script type="text/javascript">
                         function submit_ajax(form_id) {
                            var remark = $("#product_remark").val();
                            if (remark=="") {
                                alert("Remark tidak boleh kosong ");
                                return
                            }

                            return $.ajax({
                                url: $("#"+form_id).attr("action"),
                                type: $("#"+form_id).attr("method"),
                                data: $("#"+form_id).serialize(),
                                success: function(data) {
                                    var o = $.parseJSON(data);
                                    var last_id = o.last_id;
                                    var url = "'.base_url().'processor/menu/product";                             
                                    if(o.status == true) { 
                                        $("#alert_dialog_form").dialog("close");
                                             $.get(url+"?action=update&id="+last_id, function(data) {
                                             $("div#form_product").html(data);
                                             
                                        });
                                        
                                    }
                                        reload_grid("grid_product");
                                }
                                
                             })
                         }
                     </script>';
            $echo .= '<h1>Reject</h1><br />';
            $echo .= '<form id="form_product_reject" action="'.base_url().'processor/menu/product?action=reject_process" method="post">';
            $echo .= '<div style="vertical-align: top;">';
            $echo .= 'Remark : 
                    <input type="hidden" name="iItem" value="'.$this->input->get('iItem').'" />
                    <input type="hidden" name="modul_id" value="'.$this->input->get('modul_id').'" />
                    <input type="hidden" name="lvl" value="'.$this->input->get('lvl').'" />
                    <input type="hidden" name="group_id" value="'.$this->input->get('group_id').'" />
                    
                    <textarea name="vRemark" id="reject_product_remark"></textarea>
            <button type="button" onclick="submit_ajax(\'form_product_reject\')">Reject</button>';
                
            $echo .= '</div>';
            $echo .= '</form>';
            return $echo;
        }


        
        function reject_process() {
            $post = $this->input->post();
            $cNip= $this->user->gNIP;
            $vName= $this->user->gName;
            $iItem = $post['iItem'];
            $vRemark = $post['vRemark'];
            $lvl = $post['lvl'];

            //Letakan Query Update approve disini

            $data['status']  = true;
            $data['last_id'] = $post['iItem'];
            return json_encode($data);
        }
    */


    //Standart Setiap table harus memiliki dCreate , cCreated, dupdate, cUpdate
    function before_insert_processor($row, $postData) {
        $postData['dCreate'] = date('Y-m-d H:i:s');
        $postData['cCreated']=$this->user->gNIP;


        if($postData['isdraft']==true){
            $postData['iSubmit']=0;
        } else{
            $postData['iSubmit']=1;
        } 


        return $postData;

    }
    function before_update_processor($row, $postData) {
        $postData['dUpdate'] = date('Y-m-d H:i:s');
        $postData['cUpdate'] = $this->user->gNIP;

        if($postData['isdraft']==true){
            $postData['iSubmit']=0;
        } else{
            $postData['iSubmit']=1;
        } 


        return $postData; 
    }    

    function after_insert_processor($fields, $id, $postData) {
        //Example After Insert
        /*
        $cNip = $this->sess_auth->gNIP; 
        $sql = 'Place Query In Here';
        $this->db_schedulercheck->query($sql);
        */
    }

    function after_update_processor($fields, $id, $postData) {
        //Example After Update
        /*
        $cNip = $this->sess_auth->gNIP; 
        $sql = 'Place Query In Here';
        $this->db_schedulercheck->query($sql);
        */
    }

    function manipulate_insert_button($buttons, $rowData) { 
        //Load Javascript In Here 
        $cNip= $this->user->gNIP;
        $js = $this->load->view('js/standard_js');
        $js .= $this->load->view('js/upload_js');

        $iframe = '<iframe name="product_frame" id="product_frame" height="0" width="0"></iframe>';
        
        $save_draft = '<button onclick="javascript:save_draft_btn_multiupload(\'product\', \' '.base_url().'processor/schedulercheck/product?draft=true \',this,true )"  id="button_save_draft_product"  class="ui-button-text icon-save" >Save as Draft</button>';
        $save = '<button onclick="javascript:save_btn_multiupload(\'product\', \' '.base_url().'processor/schedulercheck/product?company_id='.$this->input->get('company_id').'&group_id='.$this->input->get('group_id').'modul_id='.$this->input->get('modul_id').' \',this,true )"  id="button_save_submit_product"  class="ui-button-text icon-save" >Save &amp; Submit</button>';

        

        $buttons['save'] = $iframe.$save_draft.$save.$js;
        
        return $buttons;
    }

    function manipulate_update_button($buttons, $rowData) { 
        $peka=$rowData['iItem'];


        //Load Javascript In Here 
        $cNip= $this->user->gNIP;
        $js = $this->load->view('js/standard_js');
        $js .= $this->load->view('js/upload_js');

        $iframe = '<iframe name="product_frame" id="product_frame" height="0" width="0"></iframe>';
        
        $update_draft = '<button onclick="javascript:update_draft_btn(\'product\', \' '.base_url().'processor/schedulercheck/product?draft=true \',this,true )"  id="button_update_draft_product"  class="ui-button-text icon-save" >Update as Draft</button>';
        $update = '<button onclick="javascript:update_btn_back(\'product\', \' '.base_url().'processor/schedulercheck/product?company_id='.$this->input->get('company_id').'&group_id='.$this->input->get('group_id').'modul_id='.$this->input->get('modul_id').' \',this,true )"  id="button_update_submit_product"  class="ui-button-text icon-save" >Update &amp; Submit</button>';

        $approve = '<button onclick="javascript:load_popup(\' '.base_url().'processor/schedulercheck/product?action=approve&iItem='.$peka.'&company_id='.$this->input->get('company_id').'&group_id='.$this->input->get('group_id').'&modul_id='.$this->input->get('modul_id').' \')"  id="button_approve_product"  class="ui-button-text icon-save" >Approve</button>';
        $reject = '<button onclick="javascript:load_popup(\' '.base_url().'processor/schedulercheck/product?action=reject&iItem='.$peka.'&company_id='.$this->input->get('company_id').'&group_id='.$this->input->get('group_id').'&modul_id='.$this->input->get('modul_id').' \' )"  id="button_reject_product"  class="ui-button-text icon-save" >Reject</button>';
        



        if ($this->input->get('action') == 'view') {
            unset($buttons['update']);
        }
        else{ 
            $buttons['update'] = $iframe.$update_draft.$update.$js;    
        }
        
        return $buttons;
    }

    function whoAmI($nip) { 
        $sql = 'select b.vDescription as vdepartemen,a.*,b.*,c.iLvlemp 
                        from hrd.employee a 
                        join hrd.msdepartement b on b.iDeptID=a.iDepartementID
                        join hrd.position c on c.iPostId=a.iPostID
                        where a.cNip ="'.$nip.'"
                        ';
        
        $data = $this->db_schedulercheck->query($sql)->row_array();
        return $data;
    }

    function download($vFilename) { 
        $this->load->helper('download');        
        $name = $vFilename;
        $id = $_GET['id'];
        $tempat = $_GET['path'];    
        $path = file_get_contents('./files/schedulercheck/'.$tempat.'/'.$id.'/'.$name);    
        force_download($name, $path);


    }

    //Output
    public function output(){
        $this->index($this->input->get('action'));
    }

}