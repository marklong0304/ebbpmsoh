<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class aplikasimonitoring extends MX_Controller {
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
        $grid->setTable('hrd.svn_info');     
        $grid->setUrl('aplikasimonitoring'); 
        
        switch ($action) {
            case 'piew': 
                    $data = array( 
                        'db' => $this->db_schedulercheck->query('SELECT * FROM hrd.svn_info s where s.vDescription is not null
                                  order by s.vDescription LIMIT 5')->result_array(), 
                    );
                    $this->load->view('version_monitoring/dashboard',$data); 
                    break; 
            default:
                    $grid->render_grid();
                    break;
        }
    }
     
    public function output(){
        $this->index($this->input->get('action'));
    }

}
