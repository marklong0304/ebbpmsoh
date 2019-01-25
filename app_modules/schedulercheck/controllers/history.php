<?php if (!defined('BASEPATH')) exit('No direct access is allowed');
class history extends MX_Controller {
	
	private $dbset;
	private $url;
	private $sess_auth;
	
	public function __construct() {
		parent::__construct();
$this->db_schedulercheck = $this->load->database('schedulercheck',false, true);
		$this->sess_auth = new Zend_Session_Namespace('auth');
		$this->url = 'history';
		$this->dbset = $this->load->database('hrd', true);
	}
	
	function index($action = '') {		
    	//Bikin Object Baru Nama nya $grid
    	$action = $this->input->get('action') ? $this->input->get('action') : 'piew';	
	
		$grid = new Grid;		
		$grid->setTitle('history');		
		$grid->setTable('hrd.masster_scheduler');		
		$grid->setUrl('history');		
		$grid->addFields('company','cPeriode','format');//
		$grid->setLabel('company','Company');
		$grid->setLabel('cPeriode','Periode');
		

			
		switch ($action) {		
			case 'piew':
				$sch ="
					select ms.iMaster_Scheduler_id
					,ms.vFunction
					,ms.iFunction
					,trim(ms.vNama_Scheduler) as vNama_Scheduler  
					,iScheduler_grppic_id
					,ms.iRepeat
					,ms.iDuration
					from hrd.master_scheduler ms 
					where ms.lDeleted=0
					#and ms.vNama_Scheduler='Stocknpl'
				";
				$rows= $this->db_schedulercheck->query($sch)->result_array();


				$data['rows']=$rows;
				$this->load->view('history',$data);
				break;
			default:
				$grid->render_grid();
				break;
		}
	}

	public function output(){
		$this->index('piew');
	}
}

?>
