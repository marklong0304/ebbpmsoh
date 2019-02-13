 
<?php
/* Generated by Softdev 2 ERP Module Generator 2019-01-26 15:36:24 */
/* Location: ./modules/umum/controllers/verifikasi.php */
/* Please DO NOT modify this information : */ 


/*
    Preparation 
    1. untuk load view halaman upload , file berada pada folder partial;
    2. lib auth untuk fungsi check modul



    Parameter need to be change after generate 
    1. umum => change to folder name where this controllers should be there
    2. Static Dropdown => change value for option
    3. Dynamic Dropdown => Change query for option

    Table Sample 
    test.item && test.item_file_upload




*/
 


 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class verifikasi extends MX_Controller {
    function __construct() {
        parent::__construct();
        /*$this->dbset = $this->load->database('schedulercheck',false, true);*/
        $this->load->library('auth');
        $this->db = $this->load->database('hrd',false, true);
        $this->user = $this->auth->user();

       /* $checkMod = $this->auth->modul_set($this->input->get('modul_id'));
        $this->validation =$checkMod['iValidation'];*/

    }

    function index($action = '') {
        $action = $this->input->get('action');
        //Bikin Object Baru Nama nya $grid      
        $grid = new Grid;
        $grid->setTitle('verifikasi Customer');
        $grid->setTable('hrd.employee');      
        $grid->setUrl('verifikasi');

        //List Table
        $grid->addList('cNip','vName','vEmail','vTelepon','vEmail_company','vName_company','vTelepon_company','vFax_company'); 
        $grid->setSortBy('ID');
        $grid->setSortOrder('DESC');  

        //List field
        $grid->addFields('vName','vEmail','vAddress','vTelepon','vEmail_company','vName_company','vAddress_company','vTelepon_company','vFax_company'); 

        //Setting Grid Width Name 
        /*
        Kamu bisa merubah nama label dari sini, Contoh :
        $grid->setLabel('nama field','nama field yang akan diubah');

        */

        $grid->setWidth('vName', '100');
        $grid->setAlign('vName', 'left');
        $grid->setLabel('vName','Nama');
    
        $grid->setWidth('vEmail', '100');
        $grid->setAlign('vEmail', 'left');
        $grid->setLabel('vEmail','Email Pribadi');
    
        $grid->setWidth('vAddress', '100');
        $grid->setAlign('vAddress', 'left');
        $grid->setLabel('vAddress','Alamat Pribadi');
    
        $grid->setWidth('vTelepon', '100');
        $grid->setAlign('vTelepon', 'left');
        $grid->setLabel('vTelepon','Telepon Pribadi');
    
        $grid->setWidth('vEmail_company', '100');
        $grid->setAlign('vEmail_company', 'left');
        $grid->setLabel('vEmail_company','Email Perusahaan');
    
        $grid->setWidth('vName_company', '100');
        $grid->setAlign('vName_company', 'left');
        $grid->setLabel('vName_company','Nama Perusahaan');
    
        $grid->setWidth('vAddress_company', '100');
        $grid->setAlign('vAddress_company', 'left');
        $grid->setLabel('vAddress_company','Alamat Perusahaan');
    
        $grid->setWidth('vTelepon_company', '100');
        $grid->setAlign('vTelepon_company', 'left');
        $grid->setLabel('vTelepon_company','No Telp Perusahaan');
    
        $grid->setWidth('vFax_company', '100');
        $grid->setAlign('vFax_company', 'left');
        $grid->setLabel('vFax_company','No Fax Perusahaan');
    
        $grid->setWidth('vPassword', '100');
        $grid->setAlign('vPassword', 'left');
        $grid->setLabel('vPassword','vPassword ');
    
//Example modifikasi GRID ERP
    //- Set Query
        /*if ($this->validation) {
            $grid->setQuery('lDeleted = 0 ', null); 
        }*/

        $grid->setQuery('iVerifikasi = 0 ', null); 

        $grid->setQuery('lDeleted = 0 ', null); 
        $grid->setQuery('iDivisionID = 7 ', null); 

        

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
        $grid->setSearch('vName','vEmail','vTelepon','vEmail_company','vName_company','vTelepon_company','vFax_company');
        
    //set required
        $grid->setRequired('cNip','vName','vEmail','vAddress','vTelepon','vEmail_company','vName_company','vAddress_company','vTelepon_company','vFax_company','iCompanyID','iDivisionID','iDepartementID','iPostID','vPassword','lDeleted','cCreated','dCreated','cUpdated','dUpdated'); 
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
                    echo $grid->saved_form();
                    break;
                  
           
            
            case 'update':
                    $grid->render_form($this->input->get('id'));
                    break;

        
            case 'updateproses':
                    echo $grid->updated_form();
                    break;
        
        
            case 'delete':
                    echo $grid->delete_row();
                    break; 
            
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

                        function insertBox_verifikasi_vName($field, $id) {
                            $return = '<input type="text" name="'.$field.'"  id="'.$id.'"  class="input_rows1 required" size="30"  />';
                            return $return;
                        }
                        
                        function updateBox_verifikasi_vName($field, $id, $value, $rowData) {
                                if ($this->input->get('action') == 'view') {
                                     $return= $value; 
                                }else{ 
                                    $return = '<input type="text" name="'.$field.'"  id="'.$id.'"  class="input_rows1  required" size="30" value="'.$value.'"/>';

                                }
                                
                            return $return;
                        }
                        
                        function insertBox_verifikasi_vEmail($field, $id) {
                            $return = '<input type="text" name="'.$field.'"  id="'.$id.'"  class="input_rows1 required" size="30"  />';
                            return $return;
                        }
                        
                        function updateBox_verifikasi_vEmail($field, $id, $value, $rowData) {
                                if ($this->input->get('action') == 'view') {
                                     $return= $value; 
                                }else{ 
                                    $return = '<input type="text" name="'.$field.'"  id="'.$id.'"  class="input_rows1  required" size="30" value="'.$value.'"/>';

                                }
                                
                            return $return;
                        }
                        
                        function insertBox_verifikasi_vAddress($field, $id) {
                            $return = '<input type="text" name="'.$field.'"  id="'.$id.'"  class="input_rows1 required" size="30"  />';
                            return $return;
                        }
                        
                        function updateBox_verifikasi_vAddress($field, $id, $value, $rowData) {
                                if ($this->input->get('action') == 'view') {
                                     $return= $value; 
                                }else{ 
                                    $return = '<input type="text" name="'.$field.'"  id="'.$id.'"  class="input_rows1  required" size="30" value="'.$value.'"/>';

                                }
                                
                            return $return;
                        }
                        
                        function insertBox_verifikasi_vTelepon($field, $id) {
                            $return = '<input type="text" name="'.$field.'"  id="'.$id.'"  class="input_rows1 required" size="30"  />';
                            return $return;
                        }
                        
                        function updateBox_verifikasi_vTelepon($field, $id, $value, $rowData) {
                                if ($this->input->get('action') == 'view') {
                                     $return= $value; 
                                }else{ 
                                    $return = '<input type="text" name="'.$field.'"  id="'.$id.'"  class="input_rows1  required" size="30" value="'.$value.'"/>';

                                }
                                
                            return $return;
                        }
                        
                        function insertBox_verifikasi_vEmail_company($field, $id) {
                            $return = '<input type="text" name="'.$field.'"  id="'.$id.'"  class="input_rows1 required" size="30"  />';
                            return $return;
                        }
                        
                        function updateBox_verifikasi_vEmail_company($field, $id, $value, $rowData) {
                                if ($this->input->get('action') == 'view') {
                                     $return= $value; 
                                }else{ 
                                    $return = '<input type="text" name="'.$field.'"  id="'.$id.'"  class="input_rows1  required" size="30" value="'.$value.'"/>';

                                }
                                
                            return $return;
                        }
                        
                        function insertBox_verifikasi_vName_company($field, $id) {
                            $return = '<input type="text" name="'.$field.'"  id="'.$id.'"  class="input_rows1 required" size="30"  />';
                            return $return;
                        }
                        
                        function updateBox_verifikasi_vName_company($field, $id, $value, $rowData) {
                                if ($this->input->get('action') == 'view') {
                                     $return= $value; 
                                }else{ 
                                    $return = '<input type="text" name="'.$field.'"  id="'.$id.'"  class="input_rows1  required" size="30" value="'.$value.'"/>';

                                }
                                
                            return $return;
                        }
                        
                        function insertBox_verifikasi_vAddress_company($field, $id) {
                            $return = '<input type="text" name="'.$field.'"  id="'.$id.'"  class="input_rows1 required" size="30"  />';
                            return $return;
                        }
                        
                        function updateBox_verifikasi_vAddress_company($field, $id, $value, $rowData) {
                                if ($this->input->get('action') == 'view') {
                                     $return= $value; 
                                }else{ 
                                    $return = '<input type="text" name="'.$field.'"  id="'.$id.'"  class="input_rows1  required" size="30" value="'.$value.'"/>';

                                }
                                
                            return $return;
                        }
                        
                        function insertBox_verifikasi_vTelepon_company($field, $id) {
                            $return = '<input type="text" name="'.$field.'"  id="'.$id.'"  class="input_rows1 required" size="30"  />';
                            return $return;
                        }
                        
                        function updateBox_verifikasi_vTelepon_company($field, $id, $value, $rowData) {
                                if ($this->input->get('action') == 'view') {
                                     $return= $value; 
                                }else{ 
                                    $return = '<input type="text" name="'.$field.'"  id="'.$id.'"  class="input_rows1  required" size="30" value="'.$value.'"/>';

                                }
                                
                            return $return;
                        }
                        
                        function insertBox_verifikasi_vFax_company($field, $id) {
                            $return = '<input type="text" name="'.$field.'"  id="'.$id.'"  class="input_rows1 required" size="30"  />';
                            return $return;
                        }
                        
                        function updateBox_verifikasi_vFax_company($field, $id, $value, $rowData) {
                                if ($this->input->get('action') == 'view') {
                                     $return= $value; 
                                }else{ 
                                    $return = '<input type="text" name="'.$field.'"  id="'.$id.'"  class="input_rows1  required" size="30" value="'.$value.'"/>';

                                }
                                
                            return $return;
                        }
                        
                        function insertBox_verifikasi_vPassword($field, $id) {
                            $return = '<input type="text" name="'.$field.'"  id="'.$id.'"  class="input_rows1 required" size="30"  />';
                            return $return;
                        }
                        
                        function updateBox_verifikasi_vPassword($field, $id, $value, $rowData) {
                                if ($this->input->get('action') == 'view') {
                                     $return= $value; 
                                }else{ 
                                    $return = '<input type="text" name="'.$field.'"  id="'.$id.'"  class="input_rows1  required" size="30" value="'.$value.'"/>';

                                }
                                
                            return $return;
                        }
                        
    
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
                                    var url = "'.base_url().'processor/pengujian/verifikasi";                             
                                    if(o.status == true) { 
                                        $("#alert_dialog_form").dialog("close");
                                             $.get(url+"?action=update&id="+last_id, function(data) {
                                             $("div#form_verifikasi").html(data);
                                             
                                        });
                                        
                                    }
                                        reload_grid("grid_verifikasi");
                                }
                                
                             })
                         }
                     </script>';
            $echo .= '<h1>Approve</h1><br />';
            $echo .= '<form id="form_verifikasi_approve" action="'.base_url().'processor/pengujian/verifikasi?action=approve_process" method="post">';
            $echo .= '<div style="vertical-align: top;">';
            $echo .= 'Remark : 
                    <input type="hidden" name="ID" value="'.$this->input->get('ID').'" />
                    <input type="hidden" name="modul_id" value="'.$this->input->get('modul_id').'" />
                    <input type="hidden" name="lvl" value="'.$this->input->get('lvl').'" />
                    <input type="hidden" name="group_id" value="'.$this->input->get('group_id').'" />
                    
                    <textarea name="vRemark"></textarea>
            <button type="button" onclick="submit_ajax(\'form_verifikasi_approve\')">Approve</button>';
                
            $echo .= '</div>';
            $echo .= '</form>';
            return $echo;
        } 

        function approve_process() {
            $post = $this->input->post();
            $cNip= $this->user->gNIP;
            $vName= $this->user->gName;
            $ID = $post['ID'];
            $vRemark = $post['vRemark'];
            $lvl = $post['lvl'];

            //Letakan Query Update approve disini

            $dataD['iVerifikasi']=1;
            $dataD['cVerified']=$cNip;
            $dataD['dVerified']=date('Y-m-d H:i:s');
            $dataD['vRemark_verification']=$vRemark;
            

            
            $this->db->where('ID',$ID);
            $this->db->update('hrd.employee',$dataD);

            $data['status']  = true;
            $data['last_id'] = $post['ID'];
            return json_encode($data);
        }
    


    
        //Ini Merupakan Standart Reject yang digunakan di erp
        function reject_view() {
            $echo = '<script type="text/javascript">
                         function submit_ajax(form_id) {
                            var remark = $("#verifikasi_remark").val();
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
                                    var url = "'.base_url().'processor/pengujian/verifikasi";                             
                                    if(o.status == true) { 
                                        $("#alert_dialog_form").dialog("close");
                                             $.get(url+"?action=update&id="+last_id, function(data) {
                                             $("div#form_verifikasi").html(data);
                                             
                                        });
                                        
                                    }
                                        reload_grid("grid_verifikasi");
                                }
                                
                             })
                         }
                     </script>';
            $echo .= '<h1>Reject</h1><br />';
            $echo .= '<form id="form_verifikasi_reject" action="'.base_url().'processor/pengujian/verifikasi?action=reject_process" method="post">';
            $echo .= '<div style="vertical-align: top;">';
            $echo .= 'Remark : 
                    <input type="hidden" name="ID" value="'.$this->input->get('ID').'" />
                    <input type="hidden" name="modul_id" value="'.$this->input->get('modul_id').'" />
                    <input type="hidden" name="lvl" value="'.$this->input->get('lvl').'" />
                    <input type="hidden" name="group_id" value="'.$this->input->get('group_id').'" />
                    
                    <textarea name="vRemark" id="reject_verifikasi_remark"></textarea>
            <button type="button" onclick="submit_ajax(\'form_verifikasi_reject\')">Reject</button>';
                
            $echo .= '</div>';
            $echo .= '</form>';
            return $echo;
        }


        
        function reject_process() {
            $post = $this->input->post();
            $cNip= $this->user->gNIP;
            $vName= $this->user->gName;
            $ID = $post['ID'];
            $vRemark = $post['vRemark'];
            $lvl = $post['lvl'];

            //Letakan Query Update approve disini
            $dataD['iVerifikasi']=2;
            $dataD['cVerified']=$cNip;
            $dataD['dVerified']=date('Y-m-d H:i:s');
            $dataD['vRemark_verification']=$vRemark;
            
            $this->db->where('ID',$ID);
            $this->db->update('hrd.employee',$dataD);

            $data['status']  = true;
            $data['last_id'] = $post['ID'];
            return json_encode($data);
        }
    


    //Standart Setiap table harus memiliki dCreated , cCreated, dUpdated, cUpdated
    function before_insert_processor($row, $postData) {
        $postData['dCreated'] = date('Y-m-d H:i:s');
        $postData['cCreated']=$this->user->gNIP;


        /*if($postData['isdraft']==true){
            $postData['iSubmit']=0;
        } else{
            $postData['iSubmit']=1;
        } */


        return $postData;

    }
    function before_update_processor($row, $postData) {
        $postData['dUpdated'] = date('Y-m-d H:i:s');
        $postData['cUpdated'] = $this->user->gNIP;

        /*if($postData['isdraft']==true){
            $postData['iSubmit']=0;
        } else{
            $postData['iSubmit']=1;
        } */


        return $postData; 
    }    

    function after_insert_processor($fields, $id, $postData) {
        //Example After Insert
        /*
        $cNip = $this->sess_auth->gNIP; 
        $sql = 'Place Query In Here';
        $this->dbset->query($sql);
        */
    }

    function after_update_processor($fields, $id, $postData) {
        //Example After Update
        /*
        $cNip = $this->sess_auth->gNIP; 
        $sql = 'Place Query In Here';
        $this->dbset->query($sql);
        */
    }

   /* function manipulate_insert_button($buttons) { 
        //Load Javascript In Here 
        $cNip= $this->user->gNIP;
        $js = $this->load->view('js/standard_js');
        $js .= $this->load->view('js/upload_js');

        $iframe = '<iframe name="verifikasi_frame" id="verifikasi_frame" height="0" width="0"></iframe>';
        
        $save_draft = '<button onclick="javascript:save_draft_btn_multiupload(\'verifikasi\', \' '.base_url().'processor/pengujian/verifikasi?draft=true \',this,true )"  id="button_save_draft_verifikasi"  class="ui-button-text icon-save" >Save as Draft</button>';
        $save = '<button onclick="javascript:save_btn_multiupload(\'verifikasi\', \' '.base_url().'processor/pengujian/verifikasi?company_id='.$this->input->get('company_id').'&group_id='.$this->input->get('group_id').'modul_id='.$this->input->get('modul_id').' \',this,true )"  id="button_save_submit_verifikasi"  class="ui-button-text icon-save" >Save &amp; Submit</button>';

        

        $buttons['save'] = $iframe.$save_draft.$save.$js;
        
        return $buttons;
    }

    function manipulate_update_button($buttons, $rowData) { 
        $peka=$rowData['ID'];


        //Load Javascript In Here 
        $cNip= $this->user->gNIP;
        $js = $this->load->view('js/standard_js');
        $js .= $this->load->view('js/upload_js');

        $iframe = '<iframe name="verifikasi_frame" id="verifikasi_frame" height="0" width="0"></iframe>';
        
        $update_draft = '<button onclick="javascript:update_draft_btn(\'verifikasi\', \' '.base_url().'processor/pengujian/verifikasi?draft=true \',this,true )"  id="button_update_draft_verifikasi"  class="ui-button-text icon-save" >Update as Draft</button>';
        $update = '<button onclick="javascript:update_btn_back(\'verifikasi\', \' '.base_url().'processor/pengujian/verifikasi?company_id='.$this->input->get('company_id').'&group_id='.$this->input->get('group_id').'modul_id='.$this->input->get('modul_id').' \',this,true )"  id="button_update_submit_verifikasi"  class="ui-button-text icon-save" >Update &amp; Submit</button>';

        $approve = '<button onclick="javascript:load_popup(\' '.base_url().'processor/pengujian/verifikasi?action=approve&ID='.$peka.'&company_id='.$this->input->get('company_id').'&group_id='.$this->input->get('group_id').'&modul_id='.$this->input->get('modul_id').' \')"  id="button_approve_verifikasi"  class="ui-button-text icon-save" >Approve</button>';
        $reject = '<button onclick="javascript:load_popup(\' '.base_url().'processor/pengujian/verifikasi?action=reject&ID='.$peka.'&company_id='.$this->input->get('company_id').'&group_id='.$this->input->get('group_id').'&modul_id='.$this->input->get('modul_id').' \' )"  id="button_reject_verifikasi"  class="ui-button-text icon-save" >Reject</button>';
        



        if ($this->input->get('action') == 'view') {
            unset($buttons['update']);
        }
        else{ 
            $buttons['update'] = $iframe.$update_draft.$update.$js;    
        }
        
        return $buttons;
    }*/

    function manipulate_update_button($buttons, $rowData) { 
        $peka=$rowData['ID'];


        //Load Javascript In Here 
        $cNip= $this->user->gNIP;
        $js = $this->load->view('js/standard_js');
        $js .= $this->load->view('js/upload_js');

        $iframe = '<iframe name="verifikasi_frame" id="verifikasi_frame" height="0" width="0"></iframe>';
        
        $update_draft = '<button onclick="javascript:update_draft_btn(\'verifikasi\', \' '.base_url().'processor/pengujian/verifikasi?draft=true \',this,true )"  id="button_update_draft_verifikasi"  class="ui-button-text icon-save" >Update as Draft</button>';
        $update = '<button onclick="javascript:update_btn_back(\'verifikasi\', \' '.base_url().'processor/pengujian/verifikasi?company_id='.$this->input->get('company_id').'&group_id='.$this->input->get('group_id').'modul_id='.$this->input->get('modul_id').' \',this,true )"  id="button_update_submit_verifikasi"  class="ui-button-text icon-save" >Update &amp; Submit</button>';

        $approve = '<button onclick="javascript:load_popup(\' '.base_url().'processor/pengujian/verifikasi?action=approve&ID='.$peka.'&company_id='.$this->input->get('company_id').'&group_id='.$this->input->get('group_id').'&modul_id='.$this->input->get('modul_id').' \')"  id="button_approve_verifikasi"  class="ui-button-text icon-save" >Approve</button>';
        $reject = '<button onclick="javascript:load_popup(\' '.base_url().'processor/pengujian/verifikasi?action=reject&ID='.$peka.'&company_id='.$this->input->get('company_id').'&group_id='.$this->input->get('group_id').'&modul_id='.$this->input->get('modul_id').' \' )"  id="button_reject_verifikasi"  class="ui-button-text icon-save" >Reject</button>';
        



        if ($this->input->get('action') == 'view') {
            unset($buttons['update']);
        }
        else{ 
            if($rowData['iVerifikasi'] <> 0){
                unset($buttons['update']);
            }else{
                $buttons['update'] = $iframe.$approve.$reject.$js;        
            }
            
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
        
        $data = $this->dbset->query($sql)->row_array();
        return $data;
    }

    function download($vFilename) { 
        $this->load->helper('download');        
        $name = $vFilename;
        $id = $_GET['id'];
        $tempat = $_GET['path'];    
        $path = file_get_contents('./files/umum/'.$tempat.'/'.$id.'/'.$name);    
        force_download($name, $path);


    }

    //Output
    public function output(){
        $this->index($this->input->get('action'));
    }

}
