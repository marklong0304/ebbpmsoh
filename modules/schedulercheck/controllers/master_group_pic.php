<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class master_group_pic extends MX_Controller {
    function __construct() {
        parent::__construct();
$this->db_schedulercheck = $this->load->database('schedulercheck',false, true);
        $this->load->library('auth');
        $this->dbset = $this->load->database('hrd', true);
        $this->user = $this->auth->user();
    }
    function index($action = '') {
        $action = $this->input->get('action');
        //Bikin Object Baru Nama nya $grid      
        $grid = new Grid;
        $grid->setTitle('Master Group PIC');
        //dc.m_vendor  database.tabel
        $grid->setTable('hrd.scheduler_group_pic');     
        $grid->setUrl('master_group_pic');
        $grid->addList('vNama_group_pic','vDescription');
        $grid->setSortBy('vNama_group_pic');
        $grid->setSortOrder('asc'); //sort ordernya

        $grid->addFields('vNama_group_pic','vDescription','detail');

        //setting widht grid
        $grid ->setWidth('vNama_group_pic', '300'); 
        $grid->setWidth('vDescription', '100'); 

        //modif label
        $grid->setLabel('vNama_group_pic','Nama Group'); //Ganti Label
        $grid->setLabel('vDescription','Keterangan');
        
        $grid->setSearch('vNama_group_pic');
        $grid->setRequired('vNama_group_pic');    //Field yg mandatori
        $grid->setRequired('vDescription');  //Field yg mandatori
        $grid->setFormUpload(TRUE);
        
        
    // ini untuk dropdown jika ada field yang menggunakan pilihan
        //$grid->changeFieldType('vDescription','combobox','',array(''=>'Pilih',0=>'Yes',1=>'No'));
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
                case 'getsatuan':
                        echo $this->getSatuan();
                        break;
                case 'createproses':
                        $key = $_POST['vNama_group_pic'];
                        $cek_data = 'select * from hrd.scheduler_group_pic  a where a.vNama_group_pic = "'.$key.'" ';
                        $data_cek = $this->db_schedulercheck->query($cek_data)->row_array();
                        if (empty($data_cek) ) {
                             echo $grid->saved_form();
                        }else{
                            $r['status'] = FALSE;
                            $r['message'] = "Group Sudah ada";
                            echo json_encode($r);
                        }
                       
                        break;
                case 'update':
                        $grid->render_form($this->input->get('id'));
                        break;
                case 'updateproses':

                        $pk_chek = $_POST['vNama_group_pic'];
                        $sql = 'select * 
                                from hrd.scheduler_group_pic a
                                where a.lDeleted=0 
                                and a.vNama_group_pic = "'.$pk_chek.'" ' ;
                        $result = $this->db_schedulercheck->query($sql)->row_array();


                        $id = $_POST['master_group_pic_iScheduler_grppic_id'];
                        $sql2 = 'select * 
                                from hrd.scheduler_group_pic a
                                where a.lDeleted=0 
                                and a.iScheduler_grppic_id = "'.$id.'" ' ;
                        $old = $this->db_schedulercheck->query($sql2)->row_array();

                        


                        if (empty($result) or $old['vNama_group_pic'] == $pk_chek) {
                            echo $grid->updated_form();
                        }else{
                            $r['status'] = FALSE;
                            $r['message'] = "Group Sudah ada";
                            echo json_encode($r);

                        }
                        break;
                case 'delete':
                        echo $grid->delete_row();
                        break;
                default:
                        $grid->render_grid();
                        break;
        }
    }

     /*manipulasi view object form begin*/
    function insertBox_master_group_pic_vNama_group_pic($field, $id) {
        $return = '<input type="text" name="'.$field.'"  id="'.$id.'"   class="input_rows1 required" size="25" />';
        return $return;
    }
    function updateBox_master_group_pic_vNama_group_pic($field, $id, $value, $rowData) {
        if ($this->input->get('action') == 'view') {
            $return= $value;

        }
        else{
            $return = '<input type="text" name="'.$field.'"  id="'.$id.'" value="'.$value.'" class="input_rows1 required" size="25" />';
        }
        return $return;
    }

    function insertBox_master_group_pic_vDescription($field, $id) {
        $return     = "<textarea name='".$field."' id='".$id."' style='width: 350px; height: 100px;'size='250'  class=' input_rows1'></textarea>";      
        return $return;
    }
    function updateBox_master_group_pic_vDescription($field, $id, $value, $rowData) {
        if ($this->input->get('action') == 'view') {
            $return= nl2br($value) ;
        }
        else{
            $return     = "<textarea name='".$field."' id='".$id."' style='width: 350px; height: 100px;'size='250'  class=' input_rows1'>".nl2br($value)."</textarea>";     
        }

        return $return;
    }

    function insertBox_master_group_pic_detailx() {
        $data['date'] = date('Y-m-d H:i:s');    
        return $this->load->view('partial/group_pic_detail',$data,TRUE); 
    }

    function updateBox_master_group_pic_detailx($field, $id, $value, $rowData) {
        
        $data['rows'] = $this->db_schedulercheck->get_where('plc2.otc_produk_sejenis', array('iupb_id'=>$rowData['iupb_id'] , 'lDeleted'=>0))->result_array();

        return $this->load->view('partial/group_pic_detail',$data,TRUE);              
    }   

    function insertBox_master_group_pic_detail($field, $id) {
        
        return $this->load->view('partial/group_pic_detail','',TRUE);
    }
    
    function updateBox_master_group_pic_detail($field, $id, $value, $rowData) {
//        $data['member'] = $this->db_schedulercheck->get_where('hrd.scheduler_group_pic_detail', array('iScheduler_grppic_id'=>$rowData['iScheduler_grppic_id'] , 'lDeleted'=>0))->result_array();

        $cek_data = 'select *
                        from hrd.scheduler_group_pic_detail  a 
                        join hrd.employee b on cNip = a.vnip
                        where a.iScheduler_grppic_id = "'.$rowData['iScheduler_grppic_id'].'"  
                        and a.lDeleted=0 ';
        $data['member']= $this->db_schedulercheck->query($cek_data)->result_array();


        return $this->load->view('partial/group_pic_detail',$data,TRUE); 
    }




    function after_insert_processor ($row, $insertId, $postData) {
        $user = $this->auth->user();
        $nip = $postData['nip'];
        //$level = $postData['iLevel'];     
        foreach($nip as $k => $v) {
            $this->db_schedulercheck->insert('hrd.scheduler_group_pic_detail', array('iScheduler_grppic_id'=>$insertId,'vnip'=>$v,'ccreated'=>$user->gNIP,'tcreated'=>date('Y-m-d H:i:s')));
            //$this->db_schedulercheck->insert('plc2.scheduler_group_pic_detail', array('iScheduler_grppic_id'=>$insertId,'vnip'=>$v,'iLevel'=>$level[$k],'ccreated'=>$user->gNIP,'tcreated'=>date('Y-m-d H:i:s')));
        }
        return TRUE;
    }

    function after_update_processor ($row, $updateId, $postData) {
        $user = $this->auth->user();
        $nip = $postData['nip'];
        //$level = $postData['iLevel'];
        $this->db_schedulercheck->where('iScheduler_grppic_id', $updateId);
        if($this->db_schedulercheck->update('hrd.scheduler_group_pic_detail', array('ldeleted'=>1,'cupdated'=>$user->gNIP,'tupdated'=>date('Y-m-d H:i:s')))) {
            foreach($nip as $k => $v) {
                $this->db_schedulercheck->insert('hrd.scheduler_group_pic_detail', array('iScheduler_grppic_id'=>$updateId,'vnip'=>$v,'ccreated'=>$user->gNIP,'tcreated'=>date('Y-m-d H:i:s')));
            }
        }
        return TRUE;
    }


    function manipulate_update_button($buttons) {
        if ($this->input->get('action') == 'view') {unset($buttons['update']);}

        else{

        }
        return $buttons;
    }


     /*manipulasi view object form end*/

     /*Function Pendukung begin*/

     /*Function Pendukung end*/


    public function output(){
        $this->index($this->input->get('action'));
    }

}
