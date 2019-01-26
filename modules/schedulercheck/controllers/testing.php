<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class testing extends MX_Controller {
    function __construct() {
        parent::__construct();
$this->db_schedulercheck = $this->load->database('schedulercheck',false, true);
        $this->load->library('auth');
        $this->user = $this->auth->user();
        $this->load->library('Zend','Zend/Session/Namespace');
        $this->sess_auth = new Zend_Session_Namespace('auth');
    }
    function index($action = '') {
       switch ($action) {
           case 'loadjs':
                $data['judul'] ='ini judul';
                $ret=$this->load->view('test',$data);
                echo $ret;
               break;
           default:
                $menu        = array();
                $draw_menu   = array();
                
                $id_PT          = $this->input->get('company_id');
                 
                if (!empty($id_PT)){
                    $menu = $this->getAPP($this->sess_auth->gNIP, $id_PT);
                }else{
                    $menu = $this->getAPP($this->sess_auth->gNIP, $this->sess_auth->gComId);
                }
                
                if (sizeOf($menu) > 0) {
                    foreach($menu as $key=>$val) {
                        $draw_menu[] = array('menu'=>$val);
                    }
                }
                
                $data['arrmenu'] = $draw_menu;
                $data['ini']=$this;
                echo $this->load->view('inbox_erp',$data,TRUE);
            break;
       }
        
    	    	
    }



	public function output(){
		$this->index($this->input->get('action'));
	}

}
