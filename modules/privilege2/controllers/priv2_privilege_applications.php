<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class priv2_privilege_applications extends MX_Controller {
	private $sess_auth;
    function __construct() {
        parent::__construct();
        $this->sess_auth = new Zend_Session_Namespace('auth');        
    }
    function index($action = '') {
    	$action = $this->input->get('action');
		
    	//Bikin Object Baru Nama nya $grid		
		$grid = new Grid;		
		$grid->setTitle('Applications');		
		$grid->setTable('erp_privi.privi_apps');		
		$grid->setUrl('priv2_privilege_applications');
		$grid->addList('vAppName', 'txtDesc');
		$grid->setSortBy('vAppName');
		$grid->setSortOrder('ASC'); //sort ordernya
		$grid->addFields('vAppName','txtDesc');
		$grid->setLabel('vAppName', 'Application Name'); //Ganti Label
		$grid->setLabel('txtDesc','Keterangan');
		$grid->setSearch('vAppName');
		$grid->setRequired('cJenis','cNama', 'iCompanyId', 'idga_ms_type', 'eMovingType');	//Field yg mandatori
		
		
		$grid->setQuery('erp_privi.privi_apps.isdeleted', 0);
		
		//multi select
		$grid->setMultiSelect(false);
		
		//Set View Gridnya (Default = grid)
		$grid->setGridView('grid');
		
		switch ($action) {
			case 'json':
				$grid->getJsonData();
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
			case 'view':
				$grid->render_form($this->input->get('id'), true);
				break;
			case 'updateproses':
				echo $grid->updated_form();
				break;
			default:
				$grid->render_grid();
				break;
		}
    }
	public function output(){
		$this->index($this->input->get('action'));
	}
	
	public function after_insert_processor($fields, $id, $post) {
		//$this->addFields(), $this->ci->db->insert_id(), $post
		$cNip = $this->sess_auth->gNIP;
		$today = date('Y-m-d H:i:s', mktime());
		
		$SQL = "UPDATE erp_privi.privi_apps set tCreatedAt = '{$tgl}', cCreatedBy='{$cNip}' where id = '{$id}'";
		$dbset = $this->load->database('hrd', true);
		try {
			$dbset->query($SQL);
		}catch(Exception $e) {
			die('error...');
		}
	}
	
	public function after_update_processor($fields, $id, $post, $old_data) {
		//$this->addFields(), $post[$pk], $post, $old_data
		$cNip = $this->sess_auth->gNIP;
		$today = date('Y-m-d H:i:s', mktime());
		
		$SQL = "UPDATE erp_privi.privi_apps set tUpdatedAt='{$today}', cUpdatedBy='{$cNip}' where id = '{$id}'";
		$dbset = $this->load->database('hrd', true);

		try {
			$dbset->query($SQL);
		}catch(Exception $e) {
			die('error...');
		}
	}
}