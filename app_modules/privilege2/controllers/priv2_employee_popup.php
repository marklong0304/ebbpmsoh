<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class priv2_employee_popup extends MX_Controller {
	private $sess_auth;
	private $dbset;
    function __construct() {
        parent::__construct();
        $this->sess_auth = new Zend_Session_Namespace('auth');
        $this->dbset = $this->load->database('hrd', true);       
    }
    function index($action = '') {
    	$action = $this->input->get('action');
		
    	//Bikin Object Baru Nama nya $grid		
	$grid = new Grid;		
	$grid->setTitle('Employee');		
	$grid->setTable('hrd.employee');		
	$grid->setUrl('priv2_employee_popup');
	$grid->addList('pilih', 'cNip', 'vName', 'iDivisionID', 'iDepartementID');
	$grid->setSortBy('cNip');
	$grid->setSortOrder('ASC'); //sort ordernya
	$grid->setAlign('cNip', 'left'); //Align nya
	$grid->setWidth('cNip', '50'); 
	$grid->setAlign('vName', 'left'); //Align nya
	$grid->setWidth('vName', '290');
	$grid->setAlign('iDivisionID', 'left'); //Align nya
	$grid->setWidth('iDivisionID', '210');
	$grid->setAlign('iDepartementID', 'left'); //Align nya
	$grid->setWidth('iDepartementID', '200'); 
	$grid->setWidth('pilih', '30'); // width nya
	$grid->setAlign('pilih', 'center'); // align nya
	$grid->addFields('cNip', 'vName', 'pilih');
	
	$grid->setLabel('cNip', 'NIP'); //Ganti Label
	$grid->setLabel('vName', 'Nama Employee'); //Ganti Label
	$grid->setLabel('iDivisionID', 'Divisi'); //Ganti Label
	$grid->setLabel('iDepartementID', 'Departemen'); //Ganti Label
	$grid->setSearch('cNip','vName');
	
	$grid->setQuery('hrd.employee.dResign', '0000-00-00');
	
	$grid->hideTitleCol('pilih');
	$grid->notSortCol('pilih');
	
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
			case 'getlaststock':
				$this->getlaststok();
				break;
			default:
				$grid->render_grid();
				break;
		}
     }
	public function output(){
		$this->index($this->input->get('action'));
	}
	
	function listBox_priv2_employee_popup_iDivisionID($value, $pk, $name, $rowData) {
		$nama_divisi = '-';
		$sql = "SELECT vDescription from hrd.msdivision where iDivId = '".$rowData->iDivisionID."'";
		$query = $this->dbset->query($sql);
		if ( $query->num_rows() > 0 ) {
			$r = $query->row();
			$nama_divisi = $r->vDescription;
		}
		
		return $nama_divisi;
	}
	
	function listBox_priv2_employee_popup_iDepartementID($value, $pk, $name, $rowData) {
		$nama_divisi = '-';
		$sql = "SELECT vDescription from hrd.msdepartement where iDeptId = '".$rowData->iDepartementID."'";
		$query = $this->dbset->query($sql);
		if ( $query->num_rows() > 0 ) {
			$r = $query->row();
			$nama_divisi = $r->vDescription;
		}
		
		return $nama_divisi;
	}
	
	function listBox_priv2_employee_popup_pilih($value, $pk, $name, $rowData) {
		$o  = '<input type="radio" name="pilih" onClick="javascript:pilih_employee(\''.$rowData->cNip.'\',\''.$rowData->vName.'\') ;" />';
		$o .= '<script type="text/javascript">
				function pilih_employee(id, nama) {						
					$("#priv2_setup_usergroups_cNIP").val(id);
					$("#priv2_setup_usergroups_cNIP_text").val(nama);
						
					$("#popup_tambahan").dialog("close");
				}
			</script>';
		
		return $o;
	}
}