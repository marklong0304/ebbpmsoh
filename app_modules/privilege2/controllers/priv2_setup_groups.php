<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class priv2_setup_groups extends MX_Controller {
	private $sess_auth;
	private $dbset;
        private $dbset2;
	private $url;
        var $idprivi_apps;
			
    function __construct() {
        parent::__construct();
        $this->sess_auth = new Zend_Session_Namespace('auth');
        $this->url = 'priv2_setup_groups'; 
        $this->dbset = $this->load->database('default', true);
    }
    
    function index($action = '') {		
    	//Bikin Object Baru Nama nya $grid
    	//$action = $this->input->get('action') ? $this->input->get('action') : 'create';		
            $grid = new Grid;		
            $grid->setTitle('Setup Groups');		
            $grid->setTable('erp_privi.privi_group_pt_app');		
            $grid->setUrl('priv2_setup_groups');	
            $grid->addList('iCompanyId', 'vNamaGroup', 'txtDesc', 'isDeleted');//, 'tUpdatedAt', 'cUpdatedBy');
            $grid->addFields('idprivi_apps', 'iCompanyId', 'idprivi_group', 'vNamaGroup', 'txtDesc', 'isDeleted', 'modules');
            
            //$grid->setJoinTable('hrd.Company', 'erp_privi.privi_group_pt_app.iCompanyId = hrd.Company.iCompanyId', 'INNER');
                                    
            //$grid->setSearch('iCompanyId', 'idprivi_apps', 'vNamaGroup', 'isDeleted');
            $grid->setSearch('iCompanyId', 'vNamaGroup', 'isDeleted');
            //$grid->setQuery('isDeleted', '0');
            
            $grid->setWidth('iCompanyId', '300');
            $grid->setWidth('vNamaGroup', '150');
            $grid->setWidth('txtDesc', '250');
            $grid->setWidth('isDeleted', '80');
            
            $grid->setAlign('isDeleted', 'center');
            $grid->setAlign('tUpdatedAt', 'center');
            $grid->setAlign('cUpdatedBy', 'center');
            
            $grid->setSortBy('idprivi_apps');
            $grid->setSortOrder('ASC'); //sort ordernya
                        
            $grid->setLabel('iCompanyId', 'Perusahaan');
            $grid->setLabel('idprivi_apps', 'Aplikasi');
            $grid->setLabel('idprivi_group', 'Group ID');
            $grid->setLabel('vNamaGroup', 'Nama Group');
            $grid->setLabel('tUpdatedAt', 'Tgl. Update');
            $grid->setLabel('cUpdatedBy', 'Update Oleh');
            $grid->setLabel('isDeleted', 'Status Record');
            $grid->setLabel('txtDesc', 'Keterangan');
            $grid->setLabel('modules', ' ');
            
            $this->idprivi_apps = $this->input->get('idprivi_apps');
            $grid->setForeignKey($this->idprivi_apps);
            
            $grid->setInputGet('_idprivi_apps', intval($this->idprivi_apps));
	    	$grid->setQuery('erp_privi.privi_group_pt_app.idprivi_apps', intval($this->input->get('_idprivi_apps')));            
            
            $grid->setRequired('iCompanyId', 'idprivi_apps', 'idprivi_group');            
            //$grid->changeFieldType('idprivi_apps', 'hidden');
            $grid->changeFieldType('idprivi_group', 'hidden');
            $grid->changeFieldType('isDeleted','combobox', '', array(0=>'Aktif', 1=>'Deleted'));//array(''=>'--Select--', 0=>'Aktif', 1=>'Deleted'));
            
            $grid->setDeletedKey("isDeleted");
                        

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
                            echo $grid->updated_form($this->input->get('id'));
                            break;
                    case 'delete':
                            echo $grid->delete_row();
                            break;
                    case 'search_groups':
                            echo $this->search_groups();
                            break;
                    case 'searchGroup' :
                            $this->searchGroup();
                            break;
                    default:
                    		$grid->render_grid();
                            break;
            }
        }
        
        public function searchbox_priv2_setup_groups_icompanyid($field, $id) {
        	$url = base_url().'processor/privilege2/priv2/setup/groups?action=searchGroup&company_id='.$this->input->get('company_id').'&modul_id=0&group_id=0';
        
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
                            $('#search_grid_priv2_setup_groups_iCompanyId').change(function() {
                                  javascript:reload_grid('grid_".$this->url."');
                                  loadDataSearch_".$this->url."('search_grid_priv2_setup_groups_dtl_idprivi_group', $('#search_grid_priv2_setup_groups_iCompanyId option:selected').val(), $('#search_grid_priv2_setup_groups_idprivi_apps option:selected').val());
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
        
        public function searchbox_priv2_setup_groups_idprivi_apps($field, $id) {
        
        	$url = base_url().'processor/privilege2/priv2/setup/groups?action=searchGroup&company_id='.$this->input->get('company_id').'&modul_id=0&group_id=0';
        
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
                            $('#search_grid_priv2_setup_groups_idprivi_apps').change(function() {
                                  javascript:reload_grid('grid_".$this->url."');
                                  loadDataSearch_".$this->url."('search_grid_priv2_setup_groups_idprivi_group', $('#search_grid_priv2_setup_groups_iCompanyId option:selected').val(), $('#search_grid_priv2_setup_groups_idprivi_apps option:selected').val());
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
        
        public function insertbox_priv2_setup_groups_icompanyid($field, $id) {
            $this->dbset = $this->load->database('default', false);
            $this->dbset2 = $this->load->database('hrd', true);
            
            $sql = "Select iCompanyId, vCompName from company where lDeleted = 0";
            //echo $sql;
            $o  = "<select name='".$id."' id='".$id."'>";
            $o .= "<option value='0'></option>";
            $query = $this->dbset2->query($sql);
            if ($query->num_rows() > 0) {
                foreach($query->result_array() as $r) {
                    $o .= "<option value='".$r['iCompanyId']."'>".$r['vCompName']."</option>";
                }
            }
            
            $o .= "</select>";
            
            $o .= '<input type="hidden" value="'.$this->input->get('foreign_key').'" id="priv2_setup_groups_idprivi_apps" name="priv2_setup_groups_idprivi_apps">';
            $o .= '<input type="hidden" value="'.$this->input->get('foreign_key').'" id="priv2_setup_groups_foreign_key" name="priv2_setup_groups_foreign_key">';
            
            $this->dbset = $this->load->database('default', true);
            $this->dbset2 = $this->load->database('hrd', false);
            
            return $o;
        }
        
        public function updatebox_priv2_setup_groups_icompanyid($field, $id, $value, $rowData) {
            $this->dbset = $this->load->database('default', false);
            $this->dbset2 = $this->load->database('hrd', true);
            
            $sql = "Select iCompanyId, vCompName from company where lDeleted = 0";
            //echo $sql;
            $o  = "<select name='".$id."' id='".$id."'>";
            $o .= "<option value='0'></option>";
            $query = $this->dbset2->query($sql);
            if ($query->num_rows() > 0) {
                foreach($query->result_array() as $r) {
                    if ($value == $r['iCompanyId']) $selected = " selected";
                    else $selected = "";
                    $o .= "<option {$selected} value='".$r['iCompanyId']."'>".$r['vCompName']."</option>";
                }
            }
            
            $o .= "</select>";
            
            $o .= '<input type="hidden" value="'.$this->input->get('foreign_key').'" id="priv2_setup_groups_idprivi_apps" name="priv2_setup_groups_idprivi_apps">';
            $o .= '<input type="hidden" value="'.$this->input->get('foreign_key').'" id="priv2_setup_groups_foreign_key" name="priv2_setup_groups_foreign_key">';
            
            $this->dbset = $this->load->database('default', true);
            $this->dbset2 = $this->load->database('hrd', false);
            
            
            return $o;
        }
        
        public function insertbox_priv2_setup_groups_idprivi_apps($field, $id) {
            
            /*$sql = "Select idprivi_apps, vAppName from privi_apps where isDeleted = 0";
            $o  = "<select name='".$field."' id='".$id."'>";
            $o .= "<option value='0'></option>";
            $query = $this->dbset->query($sql);
            if ($query->num_rows() > 0) {
                foreach($query->result_array() as $r) {
                    $o .= "<option value='".$r['idprivi_apps']."'>".$r['vAppName']."</option>";
                }
            }
            
            $o .= "</select>";
            */
            
            $sql = "Select vAppName from privi_apps where isDeleted = 0 and idprivi_apps = '".$this->input->get('foreign_key')."'";            
            $query = $this->dbset->query($sql);
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $nama_apps = $row->vAppName;
            } else {
                $nama_apps = "";
            }
            $o  = "<input type='hidden' name='".$id."' id='".$id."' value='".$this->input->get('foreign_key')."'/> ".$nama_apps;
            
            return $o;
        }
        
        public function updatebox_priv2_setup_groups_idprivi_apps($field, $id, $value, $rowData) {
            
            $sql = "Select vAppName from privi_apps where isDeleted = 0 and idprivi_apps = '".$value."'";            
            $query = $this->dbset->query($sql);
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $nama_apps = $row->vAppName;
            } else {
                $nama_apps = "";
            }
            $o  = "<input type='hidden' name='".$id."' id='".$id."' value='".$value."'/> ".$nama_apps;
            
            /*$sql = "Select idprivi_apps, vAppName from privi_apps where isDeleted = 0";
            $o  = "<select name='".$field."' id='".$id."'>";
            $o .= "<option value='0'></option>";
            $query = $this->dbset->query($sql);
            if ($query->num_rows() > 0) {
                foreach($query->result_array() as $r) {
                    if ($value == $r['idprivi_apps']) $selected = " selected";
                    else $selected = "";
                    $o .= "<option {$selected} value='".$r['idprivi_apps']."'>".$r['vAppName']."</option>";
                }
            }
            
            $o .= "</select>";
            */
            
            return $o;
        }
        
        public function insertbox_priv2_setup_groups_modules($field, $id) {
            return "Please Save Record First";
        }
        
        public function updatebox_priv2_setup_groups_modules($field, $id, $value, $data) { 
            /*
             * $SQL = "SELECT idprivi_modules, iCrud FROM privi_group_pt_app_mod 
				WHERE iCompanyId = '{$iCompanyId}'
				AND idprivi_apps = '{$ipriviApp}' 
				AND idprivi_group = '{$ipriviGroup}'
				AND idprivi_modules = '{$ipriviMod}'";
             */
            //print_r($data);
            $url = base_url().'processor/privilege2/priv2/setup/modules_dtl/';                         
            $o  = '<script type="text/javascript">';
            $o .= '$(document).ready(function() {
                        browse_tab(\''.$url.'?idprivi_apps='.$data['idprivi_apps'].'&iCompanyId='.$data['iCompanyId']
                                        .'&idprivi_group='.$data['iID_GroupApp'].'&company_id='.$this->input->get('company_id')
                                        .'&modul_id=0&group_id=0\',\'MODULES\', \'mod_dtl\');                        
                        $("#checklist").tabs();  
                    });
                    ';
            $o .= '</script>';
            $o .= '<div id="checklist">';
            $o .= '<ul>
                        <li><a href="#mod_dtl">Modules</a></li>
                      </ul>
                      <div id="mod_dtl">
                      </div>
                      ';
            $o .= '</div>';
            //$url = base_url().'processor/privilege2/priv2/setup/groups/';        
            //$o =' <button type="button" class="icon-save ui-button" onClick="javascript:browse(\''.$url.'?id='.$data['idprivi_apps'].'&company_id='.$this->input->get('company_id').'&modul_id='.$this->input->get('modul_id').'&group_id='.$this->input->get('group_id').'\',\'MODULES\')">Modules</button>
            //';
            
            return $o;
        }
        
        function listBox_priv2_setup_groups_icompanyid($value, $pk, $name, $rowData) {
            $this->dbset = $this->load->database('default', false);
            $this->dbset2 = $this->load->database('hrd', true);
            $sql = "Select vCompName as nama from company where iCompanyId='".$value."'";
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
        
        function listBox_priv2_setup_groups_idprivi_apps($value, $pk, $name, $rowData) { 
            
            $sql = "Select vAppName as nama from privi_apps where idprivi_apps='".$value."'";
            //echo $sql;
            $query = $this->dbset->query($sql);
            if ($query->num_rows() > 0) {
                    $row = $query->row();
                    $nama = $row->nama;
            } else {
                    $nama = '';
            }
            
            return $nama;
        }
        
        public function listbox_priv2_setup_groups_tupdatedat($value, $pk, $name, $rowData) {
		if ($value =='0000-00-00 00:00:00' || $value == null) {
			$tgl = '';
		} else {
			$tgl = date('d-m-Y H:i:s', strtotime($value));
		}

		return $tgl;
	}
        
        public function listbox_priv2_setup_groups_cupdatedby($value, $pk, $name, $rowData) {
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
        
        public function after_insert_processor($fields, $id, $post) {
            $cNip = $this->sess_auth->gNIP;
            $tgl  =  date('Y-m-d', mktime());
            $today = date('Y-m-d H:i:s', mktime());
            
            //$this->save_modules_dtl($_POST, $id);
            
            $sql = "Update privi_group_pt_app set tCreatedAt = '".$today."', cCreatedBy='".$cNip."', 
                    tUpdatedAt = '".$today."', cUpdatedBy='".$cNip."' where iID_GroupApp='".$id."'";
            $this->dbset->query($sql);
        }
        
        public function after_update_processor($fields, $id, $post) {
            $cNip = $this->sess_auth->gNIP;
            $tgl  =  date('Y-m-d', mktime());
            $today = date('Y-m-d H:i:s', mktime());
            
            
            $this->save_modules_dtl($_POST, $id);

            $sql = "Update privi_group_pt_app set tUpdatedAt = '".$today."', cUpdatedBy='".$cNip."' 
                    where iID_GroupApp='".$id."'";
            $this->dbset->query($sql);
        }
        
        /*public function before_insert_processor($fields, $post) {            
            unset($post['modules']);
            unset($post['vCodeModule']);
            unset($post['vNameModule']);
            unset($post['foreign_key']);
            //modules dtl
            unset($post['create']);
            unset($post['read']);
            unset($post['update']);
            unset($post['delete']);
            
            foreach($post as $key=>$val) {
                    if(preg_match('/^read_(.*)$/' , $key , $match)){                                
                            unset($post[$key]);
                    }
                    if(preg_match('/^tread_(.*)$/' , $key , $match)){                                
                            unset($post[$key]);
                    }

                    if(preg_match('/^create_(.*)$/' , $key , $match)){
                            unset($post[$key]);
                    }
                    
                    if(preg_match('/^tcreate_(.*)$/' , $key , $match)){
                            unset($post[$key]);
                    }

                    if(preg_match('/^update_(.*)$/' , $key , $match)){
                            unset($post[$key]);
                    }
                    if(preg_match('/^tupdate_(.*)$/' , $key , $match)){
                            unset($post[$key]);
                    }

                    if(preg_match('/^delete_(.*)$/' , $key , $match)){
                            unset($post[$key]);
                    }
                    if(preg_match('/^tdelete_(.*)$/' , $key , $match)){
                            unset($post[$key]);
                    }
            }
            
            return $post;
        }
        
        public function before_update_processor($fields, $post) {
            
            unset($post['modules']);
            unset($post['vCodeModule']);
            unset($post['vNameModule']);
            unset($post['foreign_key']);
            
            //modules dtl
            unset($post['create']);
            unset($post['read']);
            unset($post['update']);
            unset($post['delete']);
                        
            foreach($post as $key=>$val) {
                    if(preg_match('/^read_(.*)$/' , $key , $match)){                                
                            unset($post[$key]);
                    }
                    if(preg_match('/^tread_(.*)$/' , $key , $match)){                                
                            unset($post[$key]);
                    }

                    if(preg_match('/^create_(.*)$/' , $key , $match)){
                            unset($post[$key]);
                    }
                    
                    if(preg_match('/^tcreate_(.*)$/' , $key , $match)){
                            unset($post[$key]);
                    }

                    if(preg_match('/^update_(.*)$/' , $key , $match)){
                            unset($post[$key]);
                    }
                    if(preg_match('/^tupdate_(.*)$/' , $key , $match)){
                            unset($post[$key]);
                    }

                    if(preg_match('/^delete_(.*)$/' , $key , $match)){
                            unset($post[$key]);
                    }
                    if(preg_match('/^tdelete_(.*)$/' , $key , $match)){
                            unset($post[$key]);
                    }
            }
            
            return $post;
        }*/
    
	public function output(){
		$this->index($this->input->get('action'));
	}
	
	public function manipulate_grid_button($button) {    	
    	
    	unset($button['create']);
    	$url = base_url()."processor/privilege2/priv2/setup/groups?action=create&foreign_key=".$this->input->get('idprivi_apps')."&idprivi_apps=".$this->input->get('idprivi_apps')."&company_id=".$this->input->get('company_id')."&group_id=".$this->input->get('group_id')."&modul_id=".$this->input->get('modul_id');
    	$btn_baru  = "<script type='text/javascript'>
		    	function add_btn_$this->url(url, title) {
		    		browse_with_no_close(url, title);
		    	}    	 
    		</script>
    	";
    	//$btn_baru .= '<button id="button_add_perso_master_agama" name="button_add_perso_master_agama"
    	//		onclick="javascript:add_btn_'.$this->url.'(\''.$url.'\', \'MASTER AGAMA\');" class="icon-add ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary">Add New</button>';
    	$btn_baru .= '<span class="icon-add ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="add_btn_'.$this->url.'(\''.$url.'\', \'SETUP GROUPS\')">Add New</span>';        
    	
    	array_unshift($button, $btn_baru);
   
    	return $button;
    	
    }
    
    
    
    public function listBox_Action($row, $actions) {
    	
    	unset($actions['view']);
    	unset($actions['edit']);
    	unset($actions['delete']);
        	
    	$url = base_url()."processor/privilege2/priv2/setup/groups?action=update&idprivi_app=".$row->idprivi_apps."&foreign_key=".$row->idprivi_apps."&id=".$row->iID_GroupApp;
    	$edit  = "<script type'text/javascript'>
    							function edit_btn_".$this->url."(url, title) {
    								browse_with_no_close(url, title);
    							}
    						</script>";
    	$edit .= "<a href='#' onclick='javascript:edit_btn_".$this->url."(\"".$url."\", \"SETUP GROUPS\");'><center><span class='ui-icon ui-icon-pencil'></span></center></a>";
    	$actions['edit'] = $edit;
    	 
    	return $actions;
    }
        
    public function manipulate_insert_button($button) {
            unset($button['save']);
            unset($button['save_back']);
            unset($button['cancel']);
            
            $button['save_back']  =  "<script type='text/javascript'>
                                            function create_btn_back_".$this->url."(grid, url, dis) {		
                                                    //var idprivi_apps = $('#priv2_setup_groups_idprivi_apps').val();
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
                                                            if (tot_err > 0) {
                                                                    alert('Lengkapi isian Anda');
                                                                    return false;
                                                            }
                                                            var _companyId = $('#priv2_setup_groups_iCompanyId option:selected').val();
                                                            var _priviappsId = $('#priv2_setup_groups_idprivi_apps').val();
                                                            
                                                            //alert(_companyId);
                                                            //alert(_priviappsId);
                                                            var privi_group_id = search_".$this->url."(_companyId, _priviappsId);
                                                            //alert(privi_group_id);
                                                            $('#priv2_setup_groups_idprivi_group').val(privi_group_id);

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
                                                                                            //alert(o.message);
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
                                            
                                            function search_".$this->url."(icompanyid, idprivi_apps) {							
                                                    return $.ajax({
                                                            type: 'POST',
                                                            url: '".base_url()."processor/privilege2/priv2/setup/groups?action=search_groups&_companyId='+icompanyid+'&_priviappsId='+idprivi_apps,
                                                            data: '_companyId='+icompanyid+'&_priviappsId='+idprivi_apps, 
                                                            async: false				    					
                                                    }).responseText
                                            }
                                            
                                            function setTo(id) {
												var id1 = id.name;
												var id2 = (id1).split('_');
												if (id2[0] == 'create') {
													if ($('#'+id1).attr('checked')) {
														$('#tcreate_'+id2[1]).attr('value', $('#'+id1).val());
													} else {
														$('#tcreate_'+id2[1]).attr('value', 0);
													}
												} else if (id2[0] == 'read') {
													if ($('#'+id1).attr('checked')) {
														$('#tread_'+id2[1]).attr('value', $('#'+id1).val());
													} else {
														$('#tread_'+id2[1]).attr('value', 0);
													}
												} else if (id2[0] == 'update') {
													if ($('#'+id1).attr('checked')) {
														$('#tupdate_'+id2[1]).attr('value', $('#'+id1).val());
													} else {
														$('#tupdate_'+id2[1]).attr('value', 0);
													}
												} else if (id2[0] == 'delete') {
													if ($('#'+id1).attr('checked')) {
														$('#tdelete_'+id2[1]).attr('value', $('#'+id1).val());
													} else {
														$('#tdelete_'+id2[1]).attr('value', 0);
													}
												} else {
													//do nothing
												}
											}
                                      </script>";
			$button['save_back'] .= "<button type='button'
								name='button_create_".$this->url."'
								id='button_create_".$this->url."'
								class='icon-save ui-button'
								onclick='javascript:create_btn_back_".$this->url."(\"".$this->url."\", \"".base_url()."processor/privilege2/priv2/setup/groups?idprivi_apps=".$this->input->get('foreign_key')."&company_id=".$this->input->get('company_id')."&group_id=".$this->input->get('group_id')."&modul_id=".$this->input->get('modul_id')."\", this)'>Save Groups
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
            
            return $button;
        }
        
        public function manipulate_update_button($button) {
            unset($button['update']);
            unset($button['update_back']);
            unset($button['cancel']);
            
            $button['update_back']  =  "<script type='text/javascript'>
                                            function update_btn_back_".$this->url."(grid, url, dis) {		
                                                    //var idprivi_apps = $('#priv2_setup_groups_idprivi_apps').val();
                                                    //url += '&foreign_key='+idprivi_apps;
                                                    
                                                    //alert(url);
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

                                                            if (tot_err > 0) {
                                                                    alert('Lengkapi isian Anda');
                                                                    return false;
                                                            }

                                                            custom_confirm(comfirm_message,function(){
                                                                    //console.log($('#form_update_'+grid).serialize());
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
                                                                                    //alert(foreign_id);
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
                                                                                            //alert(o.message);
                                                                                            info = 'info';
                                                                                            header = 'Info';
                                                                                    }
                                                                                    _custom_alert(o.message,header,info, grid, 1, 20000);
                                                                            }
                                                                    })
                                                            });
                                                    }
                                            }
                                            
                                            function setTo(id) {
												var id1 = id.name;
												var id2 = (id1).split('_');
												if (id2[0] == 'create') {
													if ($('#'+id1).attr('checked')) {
														$('#tcreate_'+id2[1]).attr('value', $('#'+id1).val());
													} else {
														$('#tcreate_'+id2[1]).attr('value', 0);
													}
												} else if (id2[0] == 'read') {
													if ($('#'+id1).attr('checked')) {
														$('#tread_'+id2[1]).attr('value', $('#'+id1).val());
													} else {
														$('#tread_'+id2[1]).attr('value', 0);
													}
												} else if (id2[0] == 'update') {
													if ($('#'+id1).attr('checked')) {
														$('#tupdate_'+id2[1]).attr('value', $('#'+id1).val());
													} else {
														$('#tupdate_'+id2[1]).attr('value', 0);
													}
												} else if (id2[0] == 'delete') {
													if ($('#'+id1).attr('checked')) {
														$('#tdelete_'+id2[1]).attr('value', $('#'+id1).val());
													} else {
														$('#tdelete_'+id2[1]).attr('value', 0);
													}
												} else {
													//do nothing
												}
											}
                                           	
                                           	
                                      </script>";
			$button['update_back'] .= "<button type='button'
											name='button_update_".$this->url."'
											id='button_update_".$this->url."'
											class='icon-save ui-button'
											onclick='javascript:update_btn_back_".$this->url."(\"".$this->url."\", \"".base_url()."processor/privilege2/priv2/setup/groups?idprivi_apps=".$this->input->get('foreign_key')."&company_id=".$this->input->get('company_id')."&group_id=".$this->input->get('group_id')."&modul_id=".$this->input->get('modul_id')."\", this)'>Save Groups
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
										var idprivi_apps = $('#priv2_setup_groups_idprivi_apps').val();
										url += '&idprivi_apps='+idprivi_apps;
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
									onclick='javascript:cancel_btn_".$this->url."(\"".$this->url."\", \"".base_url().'processor/privilege2/priv2/setup/groups?idprivi_apps='.$this->input->get('foreign_key').'&company_id='.$this->input->get('company_id')."&group_id=".$this->input->get('group_id')."&modul_id=".$this->input->get('modul_id')."\", this)'>Back 
								  </button>";*/
                
                if ($this->input->get('action') == 'view') unset($button['update_back']);
                else '';
            
            return $button;
        }
        
        public function save_modules_dtl($post, $id) {
            $cNip = $this->sess_auth->gNIP;
            $tgl  =  date('Y-m-d', mktime());
            $today = date('Y-m-d H:i:s', mktime());
            
            $idprivi_group = 0;
            $idprivi_GroupApp = 0;
            $iCompanyId = 0;
            $idprivi_apps = 0;
            
            $all_id = array();
            $read   = array();
            $create = array();
            $update = array();
            $delete = array();
                        
            //print_r($_POST);
            //exit;
            foreach($post as $key=>$val) {  
                if(preg_match('/^tread_(.*)$/' , $key , $match)){
                        $dtl_no = intval($match[1]);
                        $read[$dtl_no] = intval($val);	

                        if (!in_array($dtl_no, $all_id)) $all_id[] = $dtl_no;
                }

                if(preg_match('/^tcreate_(.*)$/' , $key , $match)){
                        $dtl_no = intval($match[1]);
                        $create[$dtl_no] = intval($val);	

                        if (!in_array($dtl_no, $all_id)) $all_id[] = $dtl_no;
                }

                if(preg_match('/^tupdate_(.*)$/' , $key , $match)){
                        $dtl_no = intval($match[1]);
                        $update[$dtl_no] = intval($val);	

                        if (!in_array($dtl_no, $all_id)) $all_id[] = $dtl_no;
                }

                if(preg_match('/^tdelete_(.*)$/' , $key , $match)){
                        $dtl_no = intval($match[1]);
                        $delete[$dtl_no] = intval($val); 	

                        if (!in_array($dtl_no, $all_id)) $all_id[] = $dtl_no;
                }
                
                if ($key == 'idprivi_group') {
                        $idprivi_group = $val;
                }

                if ($key == 'priv2_setup_groups_iCompanyId') {
                        $iCompanyId = $val;
                }

                if ($key == 'priv2_setup_groups_idprivi_apps') {
                        $idprivi_apps = $val;
                }

                if ($key == 'iID_GroupApp') {
                        $idprivi_GroupApp = $val;
                }

                if ($key == 'vNamaGroup') {
                        $vNamaGroup = $val;
                }

                if ($key == 'txtDesc') {
                        $vtxtDesc = $val;
                }
            }
            
            //print_r($read);
            //print_r($create);
            //print_r($update);
            //print_r($delete);
            //print_r($all_id);
            //exit;
            $queries = array();
            
            //delete dulu biar gak ribet
            /*$sql = "delete from privi_group_pt_app_mod 
                    where iCompanyId = '".$iCompanyId."' and idprivi_apps = '".$idprivi_apps."' 
                    and idprivi_group = '".$idprivi_GroupApp."'";
            $this->dbset->query($sql);
            */
            
            foreach($all_id as $val) {
                    $total_crud =  (array_key_exists($val, $read) ? $read[$val] : 0) + 
                                                   (array_key_exists($val, $create) ? $create[$val] : 0) + 
                                                   (array_key_exists($val, $update) ? $update[$val] : 0) + 
                                                   (array_key_exists($val, $delete) ? $delete[$val] : 0);
                    $sql = "SELECT count(iCrud) as `std`, isDeleted from privi_group_pt_app_mod 
                                   where iCompanyId='{$iCompanyId}' 
                                   AND idprivi_apps='{$idprivi_apps}' 
                                   AND idprivi_group='{$id}' 
                                   AND idprivi_modules='{$val}'";

                   $query = $this->dbset->query($sql);
                   if ( $query->num_rows > 0 ) {
                           $row = $query->row();
                           $std = $row->std;
                           $isDeleted = $row->isDeleted;

                           if ($std == 0) {
                                $queries[] = "INSERT INTO privi_group_pt_app_mod 
                                            (iCompanyId, idprivi_group, idprivi_apps, idprivi_modules, iCrud, tCreatedAt, cCreatedBy) 
                                            VALUES ('{$iCompanyId}', '{$id}', '{$idprivi_apps}', '{$val}', '{$total_crud}', '{$today}', '{$cNip}')";
                           } else {
                                $queries[] = "UPDATE privi_group_pt_app_mod
                                SET iCrud= '{$total_crud}', 
                                cUpdatedBy='{$cNip}', 
                                isDeleted = '0' 
                                WHERE iCompanyId='{$iCompanyId}' 
                                AND idprivi_group = '{$id}' 
                                AND idprivi_apps = '{$idprivi_apps}' 
                                AND idprivi_modules = '{$val}'";
                           }
                   }
            }
		
            //print_r($queries);  
            //die('a');
            if (sizeOf($queries) > 0) {
                    foreach($queries as $q) {
                            try {
                                    $this->dbset->query($q);
                                    //$x = '1|'.$id;
                            }catch(Exception $e) {
                                    //$x = '0|'.$id;
                                    die('Error : '.$e->toString());
                            }
                    }
            } else {
                    //berarti dia gak update app_mod
                    $x = '1|'.$id;
            }
        }
        
        function search_groups() {
            $companyId = $this->input->get('_companyId');
            $priviappsId = $this->input->get('_priviappsId');
            $lastprivi_group = 0;
            $sql = "Select max(idprivi_group) as c from privi_group_pt_app 
                where iCompanyId = '".$companyId."' and idprivi_apps='".$priviappsId."'";
            $query = $this->dbset->query($sql);
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $lastprivi_group = $row->c + 1; 
            } else {
                $lastprivi_group++;
            }
            
            echo $lastprivi_group;
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
