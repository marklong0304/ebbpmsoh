<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class priv2_setup_modules_dtl extends MX_Controller {
	private $sess_auth;
	private $dbset;
        private $dbset2;
	private $url;
        var $idprivi_apps;
        var $iCompanyId;
        var $idprivi_group;
			
    function __construct() {
        parent::__construct();
        $this->sess_auth = new Zend_Session_Namespace('auth');
		$this->url = 'priv2_setup_modules_dtl'; 
		$this->dbset = $this->load->database('default', true);
    }
    function index($action = '') {		
    	//Bikin Object Baru Nama nya $grid
    	//$action = $this->input->get('action') ? $this->input->get('action') : 'create';		
            $grid = new Grid;		
            $grid->setTitle('Modules');		
            $grid->setTable('erp_privi.privi_modules');		
            $grid->setUrl('priv2_setup_modules_dtl');	
            $grid->addList('vNameModule', 'vPathModule', 'create', 'read', 'update', 'delete');
                                    
            $grid->setSearch('vNameModule');
            $grid->setQuery('isDeleted', '0');
            
            $grid->setWidth('isDeleted', '70');
            $grid->setWidth('tUpdatedAt', '100');
            $grid->setWidth('cUpdatedBy', '100');            
            $grid->setWidth('vNameModule', '150');            
            $grid->setWidth('vPathModule', '250');
            $grid->setWidth('read', '20');
            $grid->setWidth('create', '20');
            $grid->setWidth('update', '20');
            $grid->setWidth('delete', '20');
            
            $grid->setAlign('isDeleted', 'center');
            $grid->setAlign('tUpdatedAt', 'center');
            $grid->setAlign('cUpdatedBy', 'center');
            
            $grid->setSortBy('concat(if((Select a.idprivi_modules from erp_privi.privi_modules a where a.idprivi_modules = erp_privi.privi_modules.iParent LIMIT 1)IS NOT NULL , (Select if( a.iParent = 0, a.vCodeModule,if( b.iParent = 0,  concat(b.vCodeModule, a.vCodeModule ) , concat(c.vCodeModule,b.vCodeModule,a.vCodeModule ))) from erp_privi.privi_modules a LEFT JOIN erp_privi.privi_modules b ON b.idprivi_modules = a.iParent LEFT JOIN erp_privi.privi_modules c ON c.idprivi_modules = b.iParent where a.idprivi_modules = erp_privi.privi_modules.iParent LIMIT 1),erp_privi.privi_modules.vCodeModule ),  erp_privi.privi_modules.vCodeModule )');//vPathModule
            $grid->setSortOrder('ASC'); //sort ordernya
            
            $grid->setLabel('vCodeModule', 'Kode Module');
            $grid->setLabel('vNameModule', 'Nama Module');
            $grid->setLabel('vPathModule', 'Path Module');
            $grid->setLabel('tUpdatedAt', 'Tgl. Update');
            $grid->setLabel('cUpdatedBy', 'Update Oleh');
            $grid->setLabel('isDeleted', 'Status Record');
            $grid->setLabel('create', 'C');
            $grid->setLabel('read', 'R');
            $grid->setLabel('update', 'U');
            $grid->setLabel('delete', 'D');
            //$grid->setDeletedKey('isDeleted');
            
            $this->idprivi_apps = $this->input->get('idprivi_apps');
            $this->iCompanyId = $this->input->get('iCompanyId');
            $this->idprivi_group = $this->input->get('idprivi_group');
            
            $grid->setInputGet('_idprivi_apps', intval($this->idprivi_apps));
            $grid->setInputGet('_iCompanyId', intval($this->iCompanyId));
            $grid->setInputGet('_idprivi_group', intval($this->idprivi_group));
            
            
	    	$grid->setQuery('erp_privi.privi_modules.idprivi_apps', intval($this->input->get('_idprivi_apps')));            
            $grid->setForeignKey($this->idprivi_apps);
            
            $grid->hideTitleCol('create', TRUE);
            $grid->hideTitleCol('read', TRUE);
            $grid->hideTitleCol('update', TRUE);
            $grid->hideTitleCol('delete', TRUE);
            
            $grid->notSortCol('create', TRUE);
            $grid->notSortCol('read', TRUE);
            $grid->notSortCol('update', TRUE);
            $grid->notSortCol('delete', TRUE);

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
                    default:
                            $grid->render_grid();
                            break;
            }
        } 
        
        public function listbox_priv2_setup_modules_dtl_create($value, $pk, $name, $rowData) {                           
            $crud = 0; $st = (floatval($rowData->iType) == 0 ) ? "display: none": "";
            $sql = "SELECT iCrud FROM privi_group_pt_app_mod 
                    WHERE iCompanyId='".$this->input->get('_iCompanyId')."' 
                    AND idprivi_apps = '".$rowData->idprivi_apps."' 
                    AND idprivi_group = '".$this->input->get('_idprivi_group')."' 
                    AND idprivi_modules = '".$rowData->idprivi_modules."'";
            //echo $sql;
            $query = $this->dbset->query($sql);
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $crud = $row->iCrud;
            }
            
            //echo 'test : '.$crud;
            
            if ($crud == 15) {
                    $read   = ' checked';
                    $create = ' checked';
                    $update = ' checked';
                    $delete = ' checked';
            } else if ($crud == 14) {
                    $read   = ' checked';
                    $create = ' checked';
                    $update = '';
                    $delete = ' checked';
            } else if ($crud == 13) {
                    $read   = ' checked';
                    $create = ' checked';
                    $update = ' checked';
                    $delete = '';
            } else if ($crud == 12) {
                    $read   = ' checked';
                    $create = ' checked';
                    $update = '';
                    $delete = '';
            } else if ($crud == 11) {
                    $read   = '';
                    $create = ' checked';
                    $update = ' checked';
                    $delete = ' checked';
            } else if ($crud == 10) {
                    $read   = '';
                    $create = ' checked';
                    $update = '';
                    $delete = ' checked';
            } else if ($crud == 9) {
                    $read   = '';
                    $create = ' checked';
                    $update = ' checked';
                    $delete = '';
            } else if ($crud == 8) {
                    $read   = '';
                    $create = ' checked';
                    $update = '';
                    $delete = '';
            } else if ($crud == 7) {
                    $read   = ' checked';
                    $create = '';
                    $update = ' checked';
                    $delete = ' checked';
            } else if ($crud == 6) {
                    $read   = ' checked';
                    $create = '';
                    $update = '';
                    $delete = ' checked';
            } else if ($crud == 5) {
                    $read   = ' checked';
                    $create = '';
                    $update = ' checked';
                    $delete = '';
            } else if ($crud == 4) {
                    $read   = ' checked';
                    $create = '';
                    $update = '';
                    $delete = '';
            } else if ($crud == 3) {
                    $read   = '';
                    $create = '';
                    $update = ' checked';
                    $delete = ' checked';
            } else if ($crud == 2) {
                    $read   = '';
                    $create = '';
                    $update = '';
                    $delete = ' checked';
            } else if ($crud == 1) {
                    $read   = '';
                    $create = '';
                    $update = ' checked';
                    $delete = '';
            } else {
                    $read = '';
                    $create = '';
                    $update = '';
                    $delete = '';
            }
                            
            $o = "<input style='text-align:center;".$st."' onclick='setTo(create_".$rowData->idprivi_modules.");' type='checkbox' id='create_".$rowData->idprivi_modules."' name='create_".$rowData->idprivi_modules."' value='8' $create/>";
            $o .= "<input style='text-align:center;' type='hidden' id='tcreate_".$rowData->idprivi_modules."' name='tcreate_".$rowData->idprivi_modules."' value='".($create != '' ? 8 : 0)."' $create/>";            
            
            return $o;
        }
        
        public function listbox_priv2_setup_modules_dtl_read($value, $pk, $name, $rowData) {
            $crud = 0;
            $sql = "SELECT iCrud FROM privi_group_pt_app_mod 
                    WHERE iCompanyId='".$this->input->get('_iCompanyId')."' 
                    AND idprivi_apps = '".$rowData->idprivi_apps."' 
                    AND idprivi_group = '".$this->input->get('_idprivi_group')."' 
                    AND idprivi_modules = '".$rowData->idprivi_modules."'";
            //echo $sql;
            $query = $this->dbset->query($sql);
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $crud = $row->iCrud;
            }
            
            if ($crud == 15) {
                    $read   = ' checked';
                    $create = ' checked';
                    $update = ' checked';
                    $delete = ' checked';
            } else if ($crud == 14) {
                    $read   = ' checked';
                    $create = ' checked';
                    $update = '';
                    $delete = ' checked';
            } else if ($crud == 13) {
                    $read   = ' checked';
                    $create = ' checked';
                    $update = ' checked';
                    $delete = '';
            } else if ($crud == 12) {
                    $read   = ' checked';
                    $create = ' checked';
                    $update = '';
                    $delete = '';
            } else if ($crud == 11) {
                    $read   = '';
                    $create = ' checked';
                    $update = ' checked';
                    $delete = ' checked';
            } else if ($crud == 10) {
                    $read   = '';
                    $create = ' checked';
                    $update = '';
                    $delete = ' checked';
            } else if ($crud == 9) {
                    $read   = '';
                    $create = ' checked';
                    $update = ' checked';
                    $delete = '';
            } else if ($crud == 8) {
                    $read   = '';
                    $create = ' checked';
                    $update = '';
                    $delete = '';
            } else if ($crud == 7) {
                    $read   = ' checked';
                    $create = '';
                    $update = ' checked';
                    $delete = ' checked';
            } else if ($crud == 6) {
                    $read   = ' checked';
                    $create = '';
                    $update = '';
                    $delete = ' checked';
            } else if ($crud == 5) {
                    $read   = ' checked';
                    $create = '';
                    $update = ' checked';
                    $delete = '';
            } else if ($crud == 4) {
                    $read   = ' checked';
                    $create = '';
                    $update = '';
                    $delete = '';
            } else if ($crud == 3) {
                    $read   = '';
                    $create = '';
                    $update = ' checked';
                    $delete = ' checked';
            } else if ($crud == 2) {
                    $read   = '';
                    $create = '';
                    $update = '';
                    $delete = ' checked';
            } else if ($crud == 1) {
                    $read   = '';
                    $create = '';
                    $update = ' checked';
                    $delete = '';
            } else {
                    $read = '';
                    $create = '';
                    $update = '';
                    $delete = '';
            }
            $o = "<input style='text-align:center;' type='checkbox' onclick='setTo(read_".$rowData->idprivi_modules.");'  id='read_".$rowData->idprivi_modules."' name='read_".$rowData->idprivi_modules."' value='4' $read/>";
            $o .= "<input style='text-align:center;' type='hidden' id='tread_".$rowData->idprivi_modules."' name='tread_".$rowData->idprivi_modules."' value='".($read != '' ? 4 : 0)."' $read/>";
            
            return $o;
        }
        
        public function listbox_priv2_setup_modules_dtl_update($value, $pk, $name, $rowData) {
            $crud = 0; $st = (floatval($rowData->iType) == 0 ) ? "display: none": "";
            $sql = "SELECT iCrud FROM privi_group_pt_app_mod 
                    WHERE iCompanyId='".$this->input->get('_iCompanyId')."' 
                    AND idprivi_apps = '".$rowData->idprivi_apps."' 
                    AND idprivi_group = '".$this->input->get('_idprivi_group')."' 
                    AND idprivi_modules = '".$rowData->idprivi_modules."'";
            //echo $sql;
            $query = $this->dbset->query($sql);
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $crud = $row->iCrud;
            }
            
            if ($crud == 15) {
                    $read   = ' checked';
                    $create = ' checked';
                    $update = ' checked';
                    $delete = ' checked';
            } else if ($crud == 14) {
                    $read   = ' checked';
                    $create = ' checked';
                    $update = '';
                    $delete = ' checked';
            } else if ($crud == 13) {
                    $read   = ' checked';
                    $create = ' checked';
                    $update = ' checked';
                    $delete = '';
            } else if ($crud == 12) {
                    $read   = ' checked';
                    $create = ' checked';
                    $update = '';
                    $delete = '';
            } else if ($crud == 11) {
                    $read   = '';
                    $create = ' checked';
                    $update = ' checked';
                    $delete = ' checked';
            } else if ($crud == 10) {
                    $read   = '';
                    $create = ' checked';
                    $update = '';
                    $delete = ' checked';
            } else if ($crud == 9) {
                    $read   = '';
                    $create = ' checked';
                    $update = ' checked';
                    $delete = '';
            } else if ($crud == 8) {
                    $read   = '';
                    $create = ' checked';
                    $update = '';
                    $delete = '';
            } else if ($crud == 7) {
                    $read   = ' checked';
                    $create = '';
                    $update = ' checked';
                    $delete = ' checked';
            } else if ($crud == 6) {
                    $read   = ' checked';
                    $create = '';
                    $update = '';
                    $delete = ' checked';
            } else if ($crud == 5) {
                    $read   = ' checked';
                    $create = '';
                    $update = ' checked';
                    $delete = '';
            } else if ($crud == 4) {
                    $read   = ' checked';
                    $create = '';
                    $update = '';
                    $delete = '';
            } else if ($crud == 3) {
                    $read   = '';
                    $create = '';
                    $update = ' checked';
                    $delete = ' checked';
            } else if ($crud == 2) {
                    $read   = '';
                    $create = '';
                    $update = '';
                    $delete = ' checked';
            } else if ($crud == 1) {
                    $read   = '';
                    $create = '';
                    $update = ' checked';
                    $delete = '';
            } else {
                    $read = '';
                    $create = '';
                    $update = '';
                    $delete = '';
            }
            $o = "<input style='text-align:center;".$st."' type='checkbox' onclick='setTo(update_".$rowData->idprivi_modules.");' id='update_".$rowData->idprivi_modules."' name='update_".$rowData->idprivi_modules."' value='1' $update/>";
            $o .= "<input style='text-align:center;' type='hidden' id='tupdate_".$rowData->idprivi_modules."' name='tupdate_".$rowData->idprivi_modules."'  value='".($update != '' ? 1 : 0)."' $update/>";
            
            
            return $o;
        }
        
        public function listbox_priv2_setup_modules_dtl_delete($value, $pk, $name, $rowData) {
            $crud = 0; $st = (floatval($rowData->iType) == 0 ) ? "display: none": "";
            $sql = "SELECT iCrud FROM privi_group_pt_app_mod 
                    WHERE iCompanyId='".$this->input->get('_iCompanyId')."' 
                    AND idprivi_apps = '".$rowData->idprivi_apps."' 
                    AND idprivi_group = '".$this->input->get('_idprivi_group')."' 
                    AND idprivi_modules = '".$rowData->idprivi_modules."'";
            //echo $sql;
            $query = $this->dbset->query($sql);
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $crud = $row->iCrud;
            }
            
            if ($crud == 15) {
                    $read   = ' checked';
                    $create = ' checked';
                    $update = ' checked';
                    $delete = ' checked';
            } else if ($crud == 14) {
                    $read   = ' checked';
                    $create = ' checked';
                    $update = '';
                    $delete = ' checked';
            } else if ($crud == 13) {
                    $read   = ' checked';
                    $create = ' checked';
                    $update = ' checked';
                    $delete = '';
            } else if ($crud == 12) {
                    $read   = ' checked';
                    $create = ' checked';
                    $update = '';
                    $delete = '';
            } else if ($crud == 11) {
                    $read   = '';
                    $create = ' checked';
                    $update = ' checked';
                    $delete = ' checked';
            } else if ($crud == 10) {
                    $read   = '';
                    $create = ' checked';
                    $update = '';
                    $delete = ' checked';
            } else if ($crud == 9) {
                    $read   = '';
                    $create = ' checked';
                    $update = ' checked';
                    $delete = '';
            } else if ($crud == 8) {
                    $read   = '';
                    $create = ' checked';
                    $update = '';
                    $delete = '';
            } else if ($crud == 7) {
                    $read   = ' checked';
                    $create = '';
                    $update = ' checked';
                    $delete = ' checked';
            } else if ($crud == 6) {
                    $read   = ' checked';
                    $create = '';
                    $update = '';
                    $delete = ' checked';
            } else if ($crud == 5) {
                    $read   = ' checked';
                    $create = '';
                    $update = ' checked';
                    $delete = '';
            } else if ($crud == 4) {
                    $read   = ' checked';
                    $create = '';
                    $update = '';
                    $delete = '';
            } else if ($crud == 3) {
                    $read   = '';
                    $create = '';
                    $update = ' checked';
                    $delete = ' checked';
            } else if ($crud == 2) {
                    $read   = '';
                    $create = '';
                    $update = '';
                    $delete = ' checked';
            } else if ($crud == 1) {
                    $read   = '';
                    $create = '';
                    $update = ' checked';
                    $delete = '';
            } else {
                    $read = '';
                    $create = '';
                    $update = '';
                    $delete = '';
            }
            $o = "<input style='text-align:center;".$st."' type='checkbox' onclick='setTo(delete_".$rowData->idprivi_modules.");' id='delete_".$rowData->idprivi_modules."' name='delete_".$rowData->idprivi_modules."' value='2' $delete/>";
            $o .= "<input style='text-align:center;' type='hidden' id='tdelete_".$rowData->idprivi_modules."' name='tdelete_".$rowData->idprivi_modules."' value='".($delete != '' ? 2 : 0)."' $delete/>";
            
            
            return $o;
        }        
    
	public function output(){
		$this->index($this->input->get('action'));
	}
}
?>
