<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class priv2_setup_groups_dtl extends MX_Controller {
	private $sess_auth;
	private $dbset;
	private $dbset2;
	private $url;
	var $cNip;        
			
    function __construct() {
        parent::__construct();
        $this->sess_auth = new Zend_Session_Namespace('auth');
        $this->url = 'priv2_setup_groups_dtl'; 
        $this->dbset = $this->load->database('default', true);        
    }
    function index($action = '') {		
            
    	//Bikin Object Baru Nama nya $grid
    	//$action = $this->input->get('action') ? $this->input->get('action') : 'create';	
        
            //echo 'idprivi_apps : '.$this->input->get('idprivi_apps');
            $grid = new Grid;	
            $grid->setTitle('Setup Group Akses');		
            $grid->setTable('erp_privi.privi_authlist');		
            $grid->setUrl('priv2_setup_groups_dtl');	
            $grid->addList('iCompanyId', 'idprivi_apps', 'idprivi_group', 'isDeleted');
            $grid->addFields('iCompanyId', 'idprivi_apps', 'idprivi_group', 'isDeleted');
            
			//$grid->setLabel('cNip', 'NIP/Nama');, 
            $grid->setLabel('iCompanyId', 'Perusahaan');
            $grid->setLabel('idprivi_apps', 'Aplikasi');
            $grid->setLabel('idprivi_group', 'Group');
            $grid->setLabel('isDeleted', 'Status Record');
            
            $grid->setSearch('iCompanyId', 'idprivi_apps', 'isDeleted');//, 'idprivi_group');
            // $grid->setQuery('privi_authlist.isDeleted', '0');
            
            $grid->setWidth('iCompanyId', '300');
            $grid->setWidth('idprivi_apps', '150');
            $grid->setWidth('idprivi_group', '150');
            $grid->setWidth('isDeleted', '75');
            $grid->setAlign('isDeleted', 'center');
            
            $grid->setSortBy('idprivi_apps');
            $grid->setSortOrder('ASC'); //sort ordernya
            
            $grid->setRequired('iCompanyId', 'idprivi_apps', 'idprivi_group', 'isDeleted');            
            $grid->changeFieldType('isDeleted','combobox', '', array(''=>' ', 0=>'Aktif', 1=>'Deleted'));    			
                                    
            
            $this->cNip = $this->input->get('cNip');  
            $grid->setInputGet('_cNip', $this->input->get('cNip'));             
	    	$grid->setQuery('erp_privi.privi_authlist.cNIP', $this->input->get('_cNip'));
            
            $grid->setDeletedKey("isDeleted");
            $grid->setForeignKey($this->input->get('cNip'));

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
                    case 'searchGroup' :
                        $this->searchGroup();
                        break;
                    case 'searchgroup_akses' :
                        $this->searchGroupAkses();
                        break;                    
                    default:
                            $grid->render_grid();
                            break;
            }
        }             

		public function manipulate_grid_button($button) {    	
    	
			unset($button['create']);
			$url = base_url()."processor/privilege2/priv2/setup_groups_dtl?action=create&foreign_key=".$this->input->get('cNip')."&company_id=".$this->input->get('company_id')."&group_id=".$this->input->get('group_id')."&modul_id=".$this->input->get('modul_id');
			$btn_baru  = "<script type='text/javascript'>
					function add_btn_$this->url(url, title) {
						browse_with_no_close(url, title);
					}    	 
				</script>
			";
			//$btn_baru .= '<button id="button_add_perso_master_agama" name="button_add_perso_master_agama"
			//		onclick="javascript:add_btn_'.$this->url.'(\''.$url.'\', \'MASTER AGAMA\');" class="icon-add ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary">Add New</button>';
			$btn_baru .= '<span class="icon-add ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="add_btn_'.$this->url.'(\''.$url.'\', \'SETUP GROUPS DETAIL\')">Add New</span>';
			
			array_unshift($button, $btn_baru);
	   
			return $button;
			
		}
        
        public function searchbox_priv2_setup_groups_dtl_icompanyid($field, $id) {
            $url = base_url().'processor/privilege2/priv2/setup/groups_dtl?action=searchGroup&company_id='.$this->input->get('company_id').'&modul_id=0&group_id=0';
            
            $this->dbset = $this->load->database('default', false);
            $this->dbset2 = $this->load->database('hrd', true);
            
            $sql = "Select iCompanyId, vCompName from company where lDeleted = 0 order by vCompName asc";
            //echo $sql;
            $o  = "<select name='".$id."' id='".$id."'>";
            $o .= "<option value=''>Perusahaan</option>";
            $query = $this->dbset2->query($sql);
            if ($query->num_rows() > 0) {
                foreach($query->result_array() as $r) {
                    $o .= "<option value='".$r['iCompanyId']."'>".$r['vCompName']."</option>";
                }
            }
            
            $o .= "</select>"; 
            
            $o .= "<script type='text/javascript'>
                        $(document).ready(function() {
                            $('#search_grid_priv2_setup_groups_dtl_iCompanyId').change(function() {                                  
                                  javascript:reload_grid('grid_".$this->url."');
                                  loadDataSearch_".$this->url."('search_grid_priv2_setup_groups_dtl_idprivi_group', $('#search_grid_priv2_setup_groups_dtl_iCompanyId option:selected').val(), $('#search_grid_priv2_setup_groups_dtl_idprivi_apps option:selected').val());
                            });                                                        
                        });
                        
                        function loadDataSearch_".$this->url."(control, param, tipe) {
                            $.get('".$url."', 
                            {_control:control, _param:param, _tipe:tipe},  function(data) {
                                    if (data.error == undefined) {
                                            $('#'+control).empty();
                                            $('#'+control).append('<option value=\'0\'>[Pilih]</option>');
                                            for (var x=0;x<data.length;x++) {						
                                                    $('#'+control).append($('<option></option>').val(data[x].id).text(data[x].value));	
                                            }
                                    } else {
                                            //alert('Data Error');
                                            return false;
                                    }

                            },'json');
                        }
                   </script>
                ";
            $this->dbset = $this->load->database('default', true);
            $this->dbset2 = $this->load->database('hrd', false);
            
            return $o;
        }
        
        public function searchbox_priv2_setup_groups_dtl_idprivi_apps($field, $id) {  
            
            $url = base_url().'processor/privilege2/priv2/setup/groups_dtl?action=searchGroup&company_id='.$this->input->get('company_id').'&modul_id=0&group_id=0';
            
            $sql = "Select idprivi_apps, vAppName from privi_apps where isDeleted = 0 order by vAppName asc";
            //echo $sql;
            $o  = "<select name='".$id."' id='".$id."'>";
            $o .= "<option value=''>Aplikasi</option>";
            $query = $this->dbset->query($sql);
            if ($query->num_rows() > 0) {
                foreach($query->result_array() as $r) {
                    $o .= "<option value='".$r['idprivi_apps']."'>".$r['vAppName']."</option>";
                }
            }
            
            $o .= "</select>"; 
            
            $o .= "<script type='text/javascript'>
                        $(document).ready(function() {
                            $('#search_grid_priv2_setup_groups_dtl_idprivi_apps').change(function() {                                  
                                  javascript:reload_grid('grid_".$this->url."');                                
                                  loadDataSearch_".$this->url."('search_grid_priv2_setup_groups_dtl_idprivi_group', $('#search_grid_priv2_setup_groups_dtl_iCompanyId option:selected').val(), $('#search_grid_priv2_setup_groups_dtl_idprivi_apps option:selected').val());
                            });                                                        
                        });
                        
                        function loadDataSearch_".$this->url."(control, param, tipe) {
                            $.get('".$url."', 
                            {_control:control, _param:param, _tipe:tipe},  function(data) {
                                    if (data.error == undefined) {
                                            $('#'+control).empty();
                                            $('#'+control).append('<option value=\'0\'>[Pilih]</option>');
                                            for (var x=0;x<data.length;x++) {						
                                                    $('#'+control).append($('<option></option>').val(data[x].id).text(data[x].value));	
                                            }
                                    } else {
                                            //alert('Data Error');
                                            return false;
                                    }

                            },'json');
                        }
                   </script>
                ";
            
            return $o;
        }
        
        public function searchbox_priv2_setup_groups_dtl_idprivi_group($field, $id) {  
            
            $sql = "Select iID_GroupApp, vNamaGroup from privi_group_pt_app where isDeleted = 0";
            //echo $sql;
            $o  = "<select name='".$id."' id='".$id."'>";
            $o .= "<option value=''>Group</option>";
            $query = $this->dbset->query($sql);
            if ($query->num_rows() > 0) {
                foreach($query->result_array() as $r) {
                    $o .= "<option value='".$r['iID_GroupApp']."'>".$r['vNamaGroup']."</option>";
                }
            }
            
            $o .= "</select>"; 
            
            $o .= "<script type='text/javascript'>
                        $(document).ready(function() {
                            $('#search_grid_priv2_setup_groups_dtl_idprivi_group').change(function() {                                  
                                  javascript:reload_grid('grid_".$this->url."');
                            });
                        });
                   </script>
                ";
            
            return $o;
        }
        
        public function insertbox_priv2_setup_groups_dtl_icompanyid($field, $id) {     
            $this->dbset = $this->load->database('default', false);
            $this->dbset2 = $this->load->database('hrd', true);
            
            $sql = "Select iCompanyId, vCompName from company where lDeleted = 0 order by vCompName asc";
            //echo $sql;
            $o  = "<select name='".$id."' id='".$id."'>";
            $o .= "<option value='0'>Perusahaan</option>";
            $query = $this->dbset2->query($sql);
            if ($query->num_rows() > 0) {
                foreach($query->result_array() as $r) {
                    $o .= "<option value='".$r['iCompanyId']."'>".$r['vCompName']."</option>";
                }
            }
            
            $o .= "</select>"; 
            $this->dbset = $this->load->database('default', true);
            $this->dbset2 = $this->load->database('hrd', false);
            
            $url = base_url().'processor/privilege2/priv2/setup/groups_dtl?action=searchGroup&company_id='.$this->input->get('company_id').'&modul_id=0&group_id=0';
            $o .= "<script type='text/javascript'>
                    $(document).ready(function() {                            
                            $('#priv2_setup_groups_dtl_iCompanyId').change(function() {
                                    loadData_".$this->url."('priv2_setup_groups_dtl_idprivi_group', $('#priv2_setup_groups_dtl_iCompanyId option:selected').val(), $('#priv2_setup_groups_dtl_idprivi_apps option:selected').val());
                            });
                    });

                    function loadData_".$this->url."(control, param, tipe) {
                            $.get('".$url."', 
                            {_control:control, _param:param, _tipe:tipe},  function(data) {
                                    if (data.error == undefined) {
                                            $('#'+control).empty();
                                            $('#'+control).append('<option value=\'0\'>[Pilih]</option>');
                                            for (var x=0;x<data.length;x++) {						
                                                    $('#'+control).append($('<option></option>').val(data[x].id).text(data[x].value));	
                                            }
                                    } else {
                                            //alert('Data Error');
                                            return false;
                                    }

                            },'json');
                    }
              </script>";
            
            return $o;
        }
        
        public function updatebox_priv2_setup_groups_dtl_icompanyid($field, $id, $value, $rowData) {   
            $this->dbset = $this->load->database('default', false);
            $this->dbset2 = $this->load->database('hrd', true);
                
            $sql = "Select iCompanyId, vCompName from company where lDeleted = 0 order by vCompName asc";
            //echo $sql;
            $o  = "<select name='".$id."' id='".$id."' disabled>";
            $o .= "<option value='0'>Perusahaan</option>";
            $query = $this->dbset2->query($sql);
            if ($query->num_rows() > 0) {
                foreach($query->result_array() as $r) {
                    if ($value == $r['iCompanyId']) $selected = " selected";
                    else $selected = "";
                    $o .= "<option {$selected} value='".$r['iCompanyId']."'>".$r['vCompName']."</option>";
                }
            }
            
            $o .= "</select>";
            
            $this->dbset = $this->load->database('default', true);
            $this->dbset2 = $this->load->database('hrd', false);
            
            $url = base_url().'processor/privilege2/priv2/setup/groups_dtl?action=searchGroup&company_id='.$this->input->get('company_id').'&modul_id=0&group_id=0';
            $o .= "<script type='text/javascript'>
                    $(document).ready(function() {                            
                            $('#priv2_setup_groups_dtl_iCompanyId').change(function() {
                                    loadData_".$this->url."('priv2_setup_groups_dtl_idprivi_group', $('#priv2_setup_groups_dtl_iCompanyId option:selected').val(), $('#priv2_setup_groups_dtl_idprivi_apps option:selected').val());
                            });
                    });

                    function loadData_".$this->url."(control, param, tipe) {
                            $.get('".$url."', 
                            {_control:control, _param:param, _tipe:tipe},  function(data) {
                                    if (data.error == undefined) {
                                            $('#'+control).empty();
                                            $('#'+control).append('<option value=\'0\'>[Pilih]</option>');
                                            for (var x=0;x<data.length;x++) {						
                                                    $('#'+control).append($('<option></option>').val(data[x].id).text(data[x].value));	
                                            }
                                    } else {
                                            //alert('Data Error');
                                            return false;
                                    }

                            },'json');
                    }
              </script>";
            
            return $o;
        }
        
        public function insertbox_priv2_setup_groups_dtl_idprivi_apps($field, $id) {            
            $sql = "Select idprivi_apps, vAppName from privi_apps where isDeleted = 0 order by vAppName asc";
            //echo $sql;
            $o  = "<select name='".$id."' id='".$id."'>";
            $o .= "<option value='0'>Aplikasi</option>";
            $query = $this->dbset->query($sql);
            if ($query->num_rows() > 0) {
                foreach($query->result_array() as $r) {
                    $o .= "<option value='".$r['idprivi_apps']."'>".$r['vAppName']."</option>";
                }
            }
            
            $o .= "</select>";            
            $o .= '<input type="hidden" value="'.$this->input->get('foreign_key').'" id="priv2_setup_groups_dtl_foreign_key" name="priv2_setup_groups_dtl_foreign_key">';
            $o .= '<input type="hidden" value="'.$this->input->get('foreign_key').'" id="priv2_setup_groups_dtl_cNIP" name="priv2_setup_groups_dtl_cNIP">';
            
            $url = base_url().'processor/privilege2/priv2/setup/groups_dtl?action=searchGroup&company_id='.$this->input->get('company_id').'&modul_id=0&group_id=0';
            $o .= "<script type='text/javascript'>
                    $(document).ready(function() {                            
                            $('#priv2_setup_groups_dtl_idprivi_apps').change(function() {
                                    loadData_".$this->url."('priv2_setup_groups_dtl_idprivi_group', $('#priv2_setup_groups_dtl_iCompanyId option:selected').val(), $('#priv2_setup_groups_dtl_idprivi_apps option:selected').val());
                            });
                    });

                    function loadData_".$this->url."(control, param, tipe) {
                            $.get('".$url."', 
                            {_control:control, _param:param, _tipe:tipe},  function(data) {
                                    if (data.error == undefined) {
                                            $('#'+control).empty();
                                            $('#'+control).append('<option value=\'0\'>[Pilih]</option>');
                                            for (var x=0;x<data.length;x++) {						
                                                    $('#'+control).append($('<option></option>').val(data[x].id).text(data[x].value));	
                                            }
                                    } else {
                                            //alert('Data Error');
                                            return false;
                                    }

                            },'json');
                    }
              </script>";
            
            return $o;
        }
        
        public function updatebox_priv2_setup_groups_dtl_idprivi_apps($field, $id, $value, $rowData) {              
            $sql = "Select idprivi_apps, vAppName from privi_apps where isDeleted = 0 order by vAppName asc";
            $o  = "<select name='".$id."' id='".$id."' disabled>";
            $o .= "<option value='0'>Aplikasi</option>";
            $query = $this->dbset->query($sql);
            if ($query->num_rows() > 0) {
                foreach($query->result_array() as $r) {
                    if ($value == $r['idprivi_apps']) $selected = " selected";
                    else $selected = "";
                    $o .= "<option {$selected} value='".$r['idprivi_apps']."'>".$r['vAppName']."</option>";
                }
            }
            
            $o .= "</select>";
            
            $o .= '<input type="hidden" value="'.$rowData['cNIP'].'" id="priv2_setup_groups_dtl_foreign_key" name="priv2_setup_groups_dtl_foreign_key">';
            $o .= '<input type="hidden" value="'.$rowData['cNIP'].'" id="priv2_setup_groups_dtl_cNIP" name="priv2_setup_groups_dtl_cNIP">';
            
            $url = base_url().'processor/privilege2/priv2/setup/groups_dtl?action=searchGroup&company_id='.$this->input->get('company_id').'&modul_id=0&group_id=0';
            $o .= "<script type='text/javascript'>
                    $(document).ready(function() {                            
                            $('#priv2_setup_groups_dtl_idprivi_apps').change(function() {
                                    loadData_".$this->url."('priv2_setup_groups_dtl_idprivi_group', $('#priv2_setup_groups_dtl_iCompanyId option:selected').val(), $('#priv2_setup_groups_dtl_idprivi_apps option:selected').val());
                            });
                    });

                    function loadData_".$this->url."(control, param, tipe) {
                            $.get('".$url."', 
                            {_control:control, _param:param, _tipe:tipe},  function(data) {
                                    if (data.error == undefined) {
                                            $('#'+control).empty();
                                            $('#'+control).append('<option value=\'0\'>[Pilih]</option>');
                                            for (var x=0;x<data.length;x++) {						
                                                    $('#'+control).append($('<option></option>').val(data[x].id).text(data[x].value));	
                                            }
                                    } else {
                                            //alert('Data Error');
                                            return false;
                                    }

                            },'json');
                    }
              </script>";
            
            return $o;
        }
        
        public function listbox_priv2_setup_groups_dtl_tupdatedat($value, $pk, $name, $rowData) {
		if ($value =='0000-00-00 00:00:00' || $value == null) {
			$tgl = '';
		} else {
			$tgl = date('d-m-Y H:i:s', strtotime($value));
		}

		return $tgl;
	}
        
        public function listbox_priv2_setup_groups_dtl_cupdatedby($value, $pk, $name, $rowData) {
                $this->dbset = $this->load->database('default', false);
                $this->dbset2 = $this->load->database('hrd', true);
		$sql = "Select vName as nama from employee where cNip='".$value."'";
		$query = $this->dbset2->query($sql);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$nama = $row->nama;
		} else {
			$nama = '';
		}
		
                $this->dbset = $this->load->database('default', true);
                $this->dbset2 = $this->load->database('hrd', false);
		return $nama;
	}
        
        function listBox_priv2_setup_groups_dtl_icompanyid($value, $pk, $name, $rowData) {
                $this->dbset = $this->load->database('default', false);    
                $this->dbset2 = $this->load->database('hrd', true);    
		$sql = "Select vCompName from company where iCompanyId = '".$value."'";
                $query = $this->dbset2->query($sql);
                if ($query->num_rows() > 0) {
                    $row = $query->row();
                    $name = $row->vCompName;
                } else {
                    $name = '';
                }
                $this->dbset = $this->load->database('default', true);    
                $this->dbset2 = $this->load->database('hrd', false);            
	
                return $name;
	}
        
        function listBox_priv2_setup_groups_dtl_idprivi_apps($value, $pk, $name, $rowData) { 
		$sql = "Select vAppName from privi_apps where idprivi_apps = '".$value."'";
                $query = $this->dbset->query($sql);
                if ($query->num_rows() > 0) {
                    $row = $query->row();
                    $name = $row->vAppName;
                } else {
                    $name = '';
                }            
	
                return $name;
	}
        
        function listBox_priv2_setup_groups_dtl_idprivi_group($value, $pk, $name, $rowData) { 
		$sql = "Select vNamaGroup from privi_group_pt_app where iID_GroupApp = '".$value."'";
                $query = $this->dbset->query($sql);
                if ($query->num_rows() > 0) {
                    $row = $query->row();
                    $name = $row->vNamaGroup;
                } else {
                    $name = '';
                }            
	
                return $name;
	}
        
        public function insertbox_priv2_setup_groups_dtl_idprivi_group($field, $id) {            
            $sql = "Select iID_GroupApp, vNamaGroup from privi_group_pt_app where isDeleted = 0 order by vNamaGroup asc";
            //echo $sql;
            $o  = "<select name='".$id."' id='".$id."'>";
            $o .= "<option value='0'>Group</option>";
            $query = $this->dbset->query($sql);
            if ($query->num_rows() > 0) {
                foreach($query->result_array() as $r) {
                    $o .= "<option value='".$r['iID_GroupApp']."'>".$r['vNamaGroup']."</option>";
                }
            }
            
            $o .= "</select>";
            
            return $o;
        }
        
        public function updatebox_priv2_setup_groups_dtl_idprivi_group($field, $id, $value, $rowData) {   
            if ($rowData['iCompanyId'] == 0 && $rowData['idprivi_apps'] == 0) {
                $sql = "Select iID_GroupApp, vNamaGroup from privi_group_pt_app where isDeleted = 0 order by vNamaGroup asc";            
            } else {
                $sql = "Select iID_GroupApp, vNamaGroup from privi_group_pt_app 
                        where isDeleted = 0 and iCompanyId = '".$rowData['iCompanyId']."' 
                        and idprivi_apps = '".$rowData['idprivi_apps']."'";     
            }
            
            $o  = "<select name='".$id."' id='".$id."'>";
            $o .= "<option value='0'>Group</option>";
            $query = $this->dbset->query($sql);
            if ($query->num_rows() > 0) {
                foreach($query->result_array() as $r) {
                    if ($value == $r['iID_GroupApp']) $selected = " selected";
                    else $selected = "";
                    $o .= "<option {$selected} value='".$r['iID_GroupApp']."'>".$r['vNamaGroup']."</option>";
                }
            }
            
            $o .= "</select>";
            
            return $o;
        }
        
        public function after_insert_processor($fields, $id, $post) {
            $cNip = $this->sess_auth->gNIP;
            $tgl  =  date('Y-m-d', mktime());
            $today = date('Y-m-d H:i:s', mktime());
            
            $sql = "Update privi_authlist set cNip = '".$post['cNIP']."', tCreatedAt = '".$today."', cCreatedBy='".$cNip."', 
                    tUpdatedAt = '".$today."', cUpdatedBy='".$cNip."' where iID_Authlist='".$id."'";
            $this->dbset->query($sql);
        }
        
        public function after_update_processor($fields, $id, $post) {
            $cNip = $this->sess_auth->gNIP;
            $tgl  =  date('Y-m-d', mktime());
            $today = date('Y-m-d H:i:s', mktime());

            $sql = "Update privi_authlist set cNip = '".$post['cNIP']."', 
                tUpdatedAt = '".$today."', cUpdatedBy='".$cNip."' where iID_Authlist='".$id."'";
            $this->dbset->query($sql);
        }
        
        public function manipulate_insert_button($button) {
            unset($button['save']);
            unset($button['save_back']);
            unset($button['cancel']);
            
            $button['save_back']  =  "<script type='text/javascript'>
                                            function create_btn_back_".$this->url."(grid, url, dis) {		
                                                    //var idprivi_apps = $('#priv2_setup_modules_idprivi_apps').val();
                                                    //url += '&idprivi_apps='+idprivi_apps;
                                                    
                                                    var req = $('#form_create_'+grid+' input.required, #form_create_'+grid+' select.required, #form_create_'+grid+' textarea.required');
                                                    var conf=0;
                                                    var alert_message = '';
                                                    var tot_err = 0;
                                                    var adaDiStockOpname = 0;
                                                    var statusStockOpname = 0;
                                                    $.each(req, function(i,v){
                                                            $(this).removeClass('error_text');
                                                            if($(this).val() == '') {
                                                                    var id = $(this).attr('id');
                                                                    var label = $(\"label[for=\''+id+\'']\").text();
                                                                    label = label.replace('*','');
                                                                    alert_message += '<br /><b>'+label+'</b> '+required_message;			
                                                                    $(this).addClass('error_text');			
                                                                    conf++;
                                                            }		
                                                    })
                                                    if(conf > 0) {
                                                            //$('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
                                                            _custom_alert(alert_message,'Error!','info',grid, 1, 5000);
                                                    }
                                                    else {

                                                            i=0;
                                                            if ($('#priv2_setup_groups_dtl_iCompanyId option:selected').val() == 0) {
                                                                alert('Perusahaan wajib diisi');
                                                                $('#priv2_setup_groups_dtl_iCompanyId').focus();
                                                                
                                                                return false;
                                                            }
                                                            
                                                            if ($('#priv2_setup_groups_dtl_idprivi_apps option:selected').val() == 0) {
                                                                alert('Aplikasi wajib diisi');
                                                                $('#priv2_setup_groups_dtl_idprivi_apps').focus();
                                                                
                                                                return false;
                                                            }
                                                            
                                                            if ($('#priv2_setup_groups_dtl_idprivi_group option:selected').val() == 0) {
                                                                alert('Group wajib diisi');
                                                                $('#priv2_setup_groups_dtl_idprivi_group').focus();
                                                                
                                                                return false;
                                                            }
                                                            
                                                            if ($('#priv2_setup_groups_dtl_isDeleted option:selected').val() == '') {
                                                                alert('Status Record wajib diisi');
                                                                $('#priv2_setup_groups_dtl_isDeleted').focus();
                                                                
                                                                return false;
                                                            }
                                                            
                                                            //alert($('#priv2_setup_groups_dtl_cNIP').val());
                                                            var ada = search_".$this->url."(
                                                                    $('#priv2_setup_groups_dtl_cNIP').val(), 
                                                                    $('#priv2_setup_groups_dtl_iCompanyId option:selected').val(), 
                                                                    $('#priv2_setup_groups_dtl_idprivi_apps option:selected').val(), 
                                                                    $('#priv2_setup_groups_dtl_idprivi_group option:selected').val());
                                                            var ada_ = ada.split('~');
                                                            //console.log(ada);        
                                                            if (ada_[0] > 0) {
                                                                alert('Anda telah terdaftar di group '+ada_[1]+'. Periksa kembali isian anda');
                                                                return false;
                                                            } 
															
							    							var _companyId = $('#priv2_setup_groups_dtl_iCompanyId').val();

                                                            custom_confirm(comfirm_message,function(){
                                                                    $.ajax({
                                                                            url: $('#form_create_'+grid).attr('action'),
                                                                            type: 'post',
                                                                            data: $('#form_create_'+grid).serialize(),
                                                                            success: function(data) {
                                                                                    var o = $.parseJSON(data);
                                                                                    var info = 'Error';
                                                                                    var header = 'Error';
                                                                                    var last_id = o.last_id;
                                                                                    var foreign_id = o.foreign_id;
																					
                                                                                    
                                                                                    if(o.status == true) {
                                                                                            //alert(foreign_id);
                                                                                            /*$.get(url+'&action=update&id='+last_id+'&foreign_key='+foreign_id, function(data) {
                                                                                                    $('div#grid_wraper_'+grid).html(data);
                                                                                                    $('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
                                                                                            });
                                                                                            $.get(url, function(data){
                                                                                                    $('div#grid_wraper_'+grid).html(data);
                                                                                                    $('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
                                                                                            })*/
                                                            								$('#grid_'+grid).trigger('reloadGrid');
																							$.get(url+'&action=update&id='+last_id+'&foreign_key='+foreign_id+'&iCompanyId='+_companyId+'&idprivi_apps='+foreign_id, function(data) {																									
																									$('#alert_dialog_form').html(data);
																							});
                                                                                            info = 'info';
                                                                                            header = 'Info';
                                                                                    }
                                                                                    _custom_alert(o.message,header,info, grid, 1, 20000);
                                                                            }
                                                                    })
                                                            });
                                                    }
                                            }
                                            
                                            function search_".$this->url."(cnip, icompanyid, idprivi_apps, idprivi_group) {							
                                                    return $.ajax({
                                                            type: 'POST',
                                                            url: '".base_url()."processor/privilege2/priv2/setup/groups_dtl?action=searchgroup_akses&_cnip='+cnip+'&_companyId='+icompanyid+'&_priviappsId='+idprivi_apps+'&_privigroupId='+idprivi_group,
                                                            data: '_cnip='+cnip+'&_companyId='+icompanyid+'&_priviappsId='+idprivi_apps+'&_privigroupId='+idprivi_group, 
                                                            async: false				    					
                                                    }).responseText
                                            }
                                      </script>";
		$button['save_back'] .= "<button type='button'
							name='button_create_".$this->url."'
							id='button_create_".$this->url."'
							class='icon-save ui-button'
							onclick='javascript:create_btn_back_".$this->url."(\"".$this->url."\", \"".base_url()."processor/privilege2/priv2/setup/groups_dtl?cNip=".$this->input->get('foreign_key')."&company_id=".$this->input->get('company_id')."&group_id=".$this->input->get('group_id')."&modul_id=".$this->input->get('modul_id')."\", this)'>Save Group Akses
							</button>";
                
                $button['cancel']  =  "<script type='text/javascript'>
										function cancel_btn_".$this->url."(grid, url, dis) {	                                                
											/*$.get(url, function(data){
												$('div#grid_wraper_'+grid).html(data);
												$('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
											 })
											 info = 'info';
											 header = 'Info';*/
											 //_custom_alert(o.message,header,info, grid, 1, 20000);
                                                                                         $('#alert_dialog_form').dialog('close');
										}
								  </script>";
			$button['cancel'] .= "<button type='button'
								name='button_cancel_".$this->url."'
								id='button_cancel_".$this->url."'
								class='icon-save ui-button'
								onclick='javascript:cancel_btn_".$this->url."(\"".$this->url."\", \"".base_url()."processor/privilege2/priv2/setup/groups?idprivi_apps=".$this->input->get('foreign_key')."&company_id=".$this->input->get('company_id')."&group_id=".$this->input->get('group_id')."&modul_id=".$this->input->get('modul_id')."\", this)'>Close 
								</button>";
                
        /*$button['cancel']  =  "<script type='text/javascript'>
                                            function cancel_btn_".$this->url."(grid, url, dis) {	                                                
                                                $.get(url, function(data){
                                                    $('div#grid_wraper_'+grid).html(data);
                                                    $('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
                                                 })
                                                 info = 'info';
                                                 header = 'Info';
                                                 //_custom_alert(o.message,header,info, grid, 1, 20000);
                                            }
                                      </script>";
		$button['cancel'] .= "<button type='button'
							name='button_cancel_".$this->url."'
							id='button_cancel_".$this->url."'
							class='icon-save ui-button'
							onclick='javascript:cancel_btn_".$this->url."(\"".$this->url."\", \"".base_url()."processor/privilege2/priv2/setup/groups_dtl?cNip=".$this->input->get('foreign_key')."&company_id=".$this->input->get('company_id')."&group_id=".$this->input->get('group_id')."&modul_id=".$this->input->get('modul_id')."\", this)'>Back 
							</button>";*/
            
            return $button;
        }
        
        public function manipulate_update_button($button) {
            unset($button['update']);
            unset($button['update_back']);
            unset($button['cancel']);
            
            $button['update_back']  =  "<script type='text/javascript'>
                                            function update_btn_back_".$this->url."(grid, url, dis) {		
                                                    //var idprivi_apps = $('#priv2_setup_modules_idprivi_apps').val();
                                                    //url += '&idprivi_apps='+idprivi_apps;
                                                    
                                                    var req = $('#form_update_'+grid+' input.required, #form_update_'+grid+' select.required, #form_update_'+grid+' textarea.required');
                                                    var conf=0;
                                                    var alert_message = '';
                                                    var tot_err = 0;
                                                    var adaDiStockOpname = 0;
                                                    var statusStockOpname = 0;
                                                    $.each(req, function(i,v){
                                                            $(this).removeClass('error_text');
                                                            if($(this).val() == '') {
                                                                    var id = $(this).attr('id');
                                                                    var label = $(\"label[for=\''+id+\'']\").text();
                                                                    label = label.replace('*','');
                                                                    alert_message += '<br /><b>'+label+'</b> '+required_message;			
                                                                    $(this).addClass('error_text');			
                                                                    conf++;
                                                            }		
                                                    })
                                                    if(conf > 0) {
                                                            //$('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
                                                            _custom_alert(alert_message,'Error!','info',grid, 1, 5000);
                                                    }
                                                    else {

                                                            i=0;
                                                            
                                                            
                                                            if ($('#priv2_setup_groups_dtl_iCompanyId option:selected').val() == 0) {
                                                                alert('Perusahaan wajib diisi');
                                                                $('#priv2_setup_groups_dtl_iCompanyId').focus();
                                                                
                                                                return false;
                                                            }
                                                            
                                                            if ($('#priv2_setup_groups_dtl_idprivi_apps option:selected').val() == 0) {
                                                                alert('Aplikasi wajib diisi');
                                                                $('#priv2_setup_groups_dtl_idprivi_apps').focus();
                                                                
                                                                return false;
                                                            }
                                                            
                                                            if ($('#priv2_setup_groups_dtl_idprivi_group option:selected').val() == 0) {
                                                                alert('Group wajib diisi');
                                                                $('#priv2_setup_groups_dtl_idprivi_group').focus();
                                                                
                                                                return false;
                                                            }
                                                            
                                                            if ($('#priv2_setup_groups_dtl_isDeleted option:selected').val() == '') {
                                                                alert('Status Record wajib diisi');
                                                                $('#priv2_setup_groups_dtl_isDeleted').focus();
                                                                
                                                                return false;
                                                            }
                                                            
                                                            //alert($('#priv2_setup_groups_dtl_cNIP').val());
                                                            /*var ada = search_".$this->url."(
                                                                    $('#priv2_setup_groups_dtl_cNIP').val(), 
                                                                    $('#priv2_setup_groups_dtl_iCompanyId option:selected').val(), 
                                                                    $('#priv2_setup_groups_dtl_idprivi_apps option:selected').val(), 
                                                                    $('#priv2_setup_groups_dtl_idprivi_group option:selected').val());
                                                            var ada_ = ada.split('~');
                                                            //console.log(ada);        
                                                            if (ada_[0] > 0) {
                                                                alert('Anda telah terdaftar di group '+ada_[1]+'. Periksa kembali isian anda');
                                                                return false;
                                                            } */
															
							    							var _companyId = $('#priv2_setup_groups_dtl_iCompanyId').val();


                                                            custom_confirm(comfirm_message,function(){
                                                                    $('#priv2_setup_groups_dtl_iCompanyId').attr('disabled', false);
                                                                    $('#priv2_setup_groups_dtl_idprivi_apps').attr('disabled', false);
                                                                    
                                                                    $.ajax({
                                                                            url: $('#form_update_'+grid).attr('action'),
                                                                            type: 'post',
                                                                            data: $('#form_update_'+grid).serialize(),
                                                                            success: function(data) {
                                                                                    var o = $.parseJSON(data);
                                                                                    var info = 'Error';
                                                                                    var header = 'Error';
                                                                                    var last_id = o.last_id;
                                                                                    var foreign_id = o.foreign_id;
                                                                                    if(o.status == true) {
                                                                                            //alert(idprivi_apps);
                                                                                            /*$.get(url+'&action=update&id='+last_id+'&foreign_key='+foreign_id, function(data) {
                                                                                                    $('div#grid_wraper_'+grid).html(data);
                                                                                                    $('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
                                                                                            });
                                                                                            $.get(url, function(data){
                                                                                                    $('div#grid_wraper_'+grid).html(data);
                                                                                                    $('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
                                                                                            })*/
                                                                                            
                                            						   reload_grid('grid_'+grid);
                                                                                           
                                                                                           
                                                                                            info = 'info';
                                                                                            header = 'Info';
                                                                                    }
                                                                                    $('#priv2_setup_groups_dtl_iCompanyId').attr('disabled', true);
                                                                                    $('#priv2_setup_groups_dtl_idprivi_apps').attr('disabled', true);
                                                                                    $('#alert_dialog_form').dialog('close');
                                                                                    _custom_alert(o.message,header,info, grid, 1, 20000);
                                                                            }
                                                                    })
                                                            });
                                                    }
                                            }
                                      </script>";
		$button['update_back'] .= "<button type='button'
							name='button_update_".$this->url."'
							id='button_update_".$this->url."'
							class='icon-save ui-button'
							onclick='javascript:update_btn_back_".$this->url."(\"".$this->url."\", \"".base_url()."processor/privilege2/priv2/setup/groups_dtl?cNip=".$this->input->get('foreign_key')."&company_id=".$this->input->get('company_id')."&group_id=".$this->input->get('group_id')."&modul_id=".$this->input->get('modul_id')."\", this)'>Save Group Akses
							</button>";
                
                $button['cancel']  =  "<script type='text/javascript'>
										function cancel_btn_".$this->url."(grid, url, dis) {	                                                
											/*$.get(url, function(data){
												$('div#grid_wraper_'+grid).html(data);
												$('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
											 })
											 info = 'info';
											 header = 'Info';*/
											 //_custom_alert(o.message,header,info, grid, 1, 20000);
                                                                                         $('#alert_dialog_form').dialog('close');
										}
								  </script>";
			$button['cancel'] .= "<button type='button'
								name='button_cancel_".$this->url."'
								id='button_cancel_".$this->url."'
								class='icon-save ui-button'
								onclick='javascript:cancel_btn_".$this->url."(\"".$this->url."\", \"".base_url()."processor/privilege2/priv2/setup/groups?idprivi_apps=".$this->input->get('foreign_key')."&company_id=".$this->input->get('company_id')."&group_id=".$this->input->get('group_id')."&modul_id=".$this->input->get('modul_id')."\", this)'>Close 
								</button>";
                
        /*$button['cancel']  =  "<script type='text/javascript'>
                                            function cancel_btn_".$this->url."(grid, url, dis) {	
                                                //var idprivi_apps = $('#priv2_setup_groups_dtl_cNip').val();
                                                //url += '&cNip='+idprivi_apps;
                                                
                                                $.get(url, function(data){
                                                    $('div#grid_wraper_'+grid).html(data);
                                                    $('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
                                                 })
                                                 info = 'info';
                                                 header = 'Info';
                                                 //_custom_alert(o.message,header,info, grid, 1, 20000);
                                            }
                                      </script>";
		$button['cancel'] .= "<button type='button'
							name='button_cancel_".$this->url."'
							id='button_cancel_".$this->url."'
							class='icon-save ui-button'
							onclick='javascript:cancel_btn_".$this->url."(\"".$this->url."\", \"".base_url().'processor/privilege2/priv2/setup/groups_dtl?cNip='.$this->input->get('foreign_key').'&company_id='.$this->input->get('company_id')."&group_id=".$this->input->get('group_id')."&modul_id=".$this->input->get('modul_id')."\", this)'>Back 
							</button>";*/
                
                if ($this->input->get('action') == 'view') unset($button['update_back']);
                else '';
            
            return $button;
        }
        
        /*public function before_insert_processor($fields, $post) {
            echo 'a'.$this->input->get('foreign_key');
            $post['idprivi_apps'] = $this->input->get('foreign_key');
            
            print_r($post);
            exit;
            
            return $post;
        }
        
        public function before_update_processor($fields, $post) {
            $post['idprivi_apps'] = $this->input->get('foreign_key');
            
            return $post;
        }*/
        
        /*public function listBox_action($row, $actions) {
			$actions['delete'] = '';
		return $actions;
	}*/
	
	public function listBox_Action($row, $actions) {
    	unset($actions['view']);
    	unset($actions['edit']);
    	unset($actions['delete']);
    
    	$url = base_url()."processor/privilege2/priv2/setup_groups_dtl?action=update&id=".$row->iID_Authlist."&foreign_key=".$this->input->get('cNip')."&company_id=".$this->input->get('company_id')."&group_id=".$this->input->get('group_id')."&modul_id=".$this->input->get('modul_id');
    	$edit  = "<script type'text/javascript'>
    							function edit_btn_".$this->url."(url, title) {
    								browse_with_no_close(url, title);
    							}
    						</script>";
    	$edit .= "<a href='#' onclick='javascript:edit_btn_".$this->url."(\"".$url."\", \"SETUP GROUPS DETAIL\");'><center><span class='ui-icon ui-icon-pencil'></span></center></a>";
    	$actions['edit'] = $edit;
    	 
    	return $actions;
    }
        
	public function output(){
		$this->index($this->input->get('action'));
	}
        
        function searchGroupAkses() {
            
            $cNip          = $this->input->get('_cnip');
            $iCompanyId    = $this->input->get('_companyId');
            $iPriviAppsId  = $this->input->get('_priviappsId');
            $iPriviGroupId = $this->input->get('_privigroupId');
            $nama_group = "";
            
            $sql = "Select a.iID_Authlist, a.idprivi_group from privi_authlist a 
                    where a.cNIP = '".$cNip."' 
                    and a.iCompanyId = '".$iCompanyId."' 
                    and a.idprivi_apps = '".$iPriviAppsId."'"; 
                    //and a.idprivi_group = '".$iPriviGroupId."'";
            //echo $sql;
            $query = $this->dbset->query($sql);
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $sql2 = "Select vNamaGroup from privi_group_pt_app where iID_GroupApp='".$row->idprivi_group."'";
                $query2 = $this->dbset->query($sql2);
                if ($query2->num_rows() > 0) {
                    $row2 = $query2->row();
                    $nama_group = $row2->vNamaGroup;
                }
                $x = 1;
            } else { 
                $x = 0;
            }
            
            echo $x."~".$nama_group;
            exit;
        }
        
        function searchGroup() {
	
		$company = $this->input->get('_param'); //company
                $apps = $this->input->get('_tipe'); //apps
		$data = array();
	
                if ($company == 0 && $apps == 0) {
                    $sql = "Select a.iID_GroupApp as id, a.vNamaGroup as nama 
                            from privi_group_pt_app a where isDeleted = 0 and a.iID_GroupApp = 0 
                            order by a.vNamaGroup";
                } else {
                    $sql = "Select a.iID_GroupApp as id, a.vNamaGroup as nama 
                            from privi_group_pt_app a where isDeleted = 0 and a.iCompanyId = '".$company."' 
                            and idprivi_apps = '".$apps."' order by a.vNamaGroup";
                }
                
		//echo $sql;
		$query = $this->dbset->query($sql);
		if ($query->num_rows > 0) {
			foreach($query->result_array() as $line) {
	
				$row_array['value'] = trim($line['nama']);
				$row_array['id']    = $line['id'];
	
				array_push($data, $row_array);
			}
		}
	
		echo json_encode($data);
		exit;
	}
}
?>