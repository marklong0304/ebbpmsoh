<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class priv2_resetpwd extends MX_Controller {
	private $sess_auth;
	private $dbset;
        private $dbset2;
	private $url;
			
    function __construct() {
        parent::__construct();
        $this->sess_auth = new Zend_Session_Namespace('auth');
		$this->url = 'priv2_resetpwd'; 
		$this->dbset = $this->load->database('hrd', true);
    }
    function index($action = '') {		
    	//Bikin Object Baru Nama nya $grid
    	//$action = $this->input->get('action') ? $this->input->get('action') : 'create';		
            $grid = new Grid;		
            $grid->setTitle('Group Akses User');		
            $grid->setTable('hrd.employee');		
            $grid->setUrl('priv2_resetpwd');	
            $grid->addList('cNip', 'vName', 'iDivisionID', 'iDepartementID', 'iPostID','HP');
            $grid->addFields('cNip', 'vName','HP', 'dBirthday', 'groups');
                                    
            $grid->setSearch('cNip', 'iDivisionID', 'iDepartementID', 'vName');
            $grid->setQuery("(dResign = '0000-00-00' OR dResign > CURDATE())", null);
            
            $grid->setWidth('cNip', '50');
            $grid->setAlign('cNip', 'center');
            $grid->setWidth('vName', '200');
            $grid->setWidth('iDivisionID', '220');
            $grid->setWidth('iDepartementID', '225');
            $grid->setWidth('iPostID', '275');
            
            $grid->setSortBy('cNip');
            $grid->setSortOrder('DESC'); //sort ordernya
            
            $grid->setLabel('cNip', 'NIP');
            $grid->setLabel('vName', 'Nama Karyawan');
            $grid->setLabel('iDivisionID', 'Divisi');
            $grid->setLabel('iDepartementID', 'Departemen');
            $grid->setLabel('iPostID', 'Posisi/Jabatan');
            $grid->setLabel('dBirthday', 'Tgl. Lahir');
            
            //$grid->setDeletedKey('isDeleted');
            
            $grid->changeFieldType('isDeleted','combobox', '', array(0=>'Aktif', 1=>'Deleted'));//array(''=>'--Select--', 0=>'Aktif', 1=>'Deleted'));
            
			$grid->setQuery('hrd.employee.iCompanyId', $this->input->get('company_id'));//N08163
			
            //$grid->setDeletedPrivilege(false);
            $grid->setInsertPrivilege(false);

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
                    case 'searchDept':
                            $this->searchDept();
                            break;
					case 'updPhonebk':
							$this->updPhonebk();
							break;
                    default:
                            $grid->render_grid();
                            break;
            }
        }
        
		
		function updPhonebk(){
			
			$vHp  = $_POST['_hp'];
			$nip = $_POST['_nip'];
			$no2dpn = substr($vHp, 0, 2);                  
			if ($no2dpn == '08') {
				$nosisa = substr($vHp, 2, strlen($vHp));
				$no2dpn = "+628";
				$no_hp = $no2dpn."".$nosisa;
			}else {
				$nosisa = substr($vHp, 1, strlen($vHp));
				$no2dpn = "+62";
				//$no_hp  = $no2dpn."".$nosisa;
				$no_hp  = $vHp;
			}

			$no_hp = str_replace("+", "", $no_hp);
			
			//Cek Nomor HP karyawan itu;
			$sql = "SELECT cHP,lDeleted FROM general.phonebk WHERE 
                    cNip='".$nip."' AND cHP='".$no_hp."'";
			 $query = $this->dbset->query($sql);
                if ($query->num_rows() > 0) {
                    $row = $query->row();
                    $cHP = $row->cHP;
                    $lDeleted = $row->lDeleted;
                    
                    if ($no_hp==$cHP && $lDeleted==0){

                    }else{
                        //update yg aktiv jadi delete
                        $sql = "UPDATE general.phonebk SET lErp2fox=1, lDeleted=1 WHERE 
                               cNip='".$nip."' and lDeleted=0 ";
                        $this->dbset->query($sql);
						

                        //update yg sekarang jadi aktiv
                        $sql = "UPDATE general.phonebk SET lErp2fox=1, lDeleted=0 WHERE 
                               cNip='".$nip."' and cHP='".$no_hp."' ";
                        $this->dbset->query($sql);
						
						
                    }
                    

                }else{
				
					//update yg aktiv jadi delete
					$sql = "UPDATE general.phonebk SET lErp2fox=1, lDeleted=1 WHERE 
						   cNip='".$nip."' and lDeleted=0 ";
					$this->dbset->query($sql);
					
					
						
                    //kalo belom ada di insert
                    $sql = "INSERT INTO general.phonebk (cNip,cHP,lErp2fox,tCreated,cCreatedBy,tUpdated,cUpdatedBy) 
                        VALUES ('".$nip."', '".$no_hp."',1,CURRENT_TIMESTAMP,'".$this->sess_auth->gNIP."',CURRENT_TIMESTAMP,'".$this->sess_auth->gNIP."')";
                    $this->dbset->query($sql);
					
                }
				
				//Update Ke Employee
				$sql = "UPDATE hrd.employee SET vhp='".$no_hp."' WHERE cNip='".$nip."' ";
				$this->dbset->query($sql);
						
				echo $no_hp;
		}
		
        public function listBox_action($row, $actions) {			
			$actions['delete'] = '';
		
			return $actions;
		}
        
        public function searchbox_priv2_resetpwd_iDivisionID($field, $id) {
			
			$url = base_url().'processor/privilege2/priv2/authorization_list?action=searchDept&company_id='.$this->input->get('company_id').'&modul_id=0&group_id=0';

			$o = "<select name='".$id."' id='".$id."'>";
			$sql = "Select iDivId, vDescription from hrd.msdivision where lDeleted = 0 order by vDescription";
			$query = $this->dbset->query($sql);
			$o .= "<option value=''>Pilih Divisi</option>";
			if ($query->num_rows() > 0) {
				foreach($query->result_array() as $r) {
					$o .= "<option value='".$r['iDivId']."'>".$r['vDescription']."</option>";
				}
			}			
			$o .= '</select>';
			
			$o .= "<script type='text/javascript'>
                        $(document).ready(function() {
                            $('#search_grid_priv2_resetpwd_iDivisionID').change(function() {
                                  javascript:reload_grid('grid_".$this->url."');    
                                  loadDataSearch_".$this->url."('search_grid_priv2_resetpwd_iDepartementID', $('#search_grid_priv2_resetpwd_iDivisionID option:selected').val());                              
                            });
                        });
                        
                        function loadDataSearch_".$this->url."(control, param) {
                            $.get('".$url."',
                            {_control:control, _param:param},  function(data) {
                                    if (data.error == undefined) {
                                            $('#'+control).empty();
                                            $('#'+control).append('<option value=\'\'>[Pilih]</option>');
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
		
		public function searchbox_priv2_resetpwd_iDepartementID($field, $id) {

			$o = "<select name='".$id."' id='".$id."'>";
			$sql = "Select iDeptId, vDescription from hrd.msdepartement where lDeleted = 0 order by vDescription";
			$query = $this->dbset->query($sql);
			$o .= "<option value=''>Pilih Departemen</option>";
			if ($query->num_rows() > 0) {
				foreach($query->result_array() as $r) {
					$o .= "<option value='".$r['iDeptId']."'>".$r['vDescription']."</option>";
				}
			}			
			$o .= '</select>';
			
			$o .= "<script type='text/javascript'>
                        $(document).ready(function() {
                            $('#search_grid_priv2_resetpwd_iDepartementID').change(function() {								  
                                  javascript:reload_grid('grid_".$this->url."');                                  
                            });
                        });
                   </script>
                ";
			
			return $o;
		}
		
		public function listbox_priv2_resetpwd_ipostid($value, $pk, $name, $rowData) {
			$sql = "Select vDescription from hrd.position where iPostID = '".$value."'";
			$result = $this->dbset->querY($sql);
			if ($result->num_rows() > 0) {
				$row = $result->row();
				$nama_divisi = $row->vDescription;
			} else {
				$nama_divisi = "";
			}
			
			return $nama_divisi;
		}
		
		public function listbox_priv2_resetpwd_iDivisionID($value, $pk, $name, $rowData) {
			$sql = "Select vDescription from hrd.msdivision where iDivId = '".$value."'";
			$result = $this->dbset->querY($sql);
			if ($result->num_rows() > 0) {
				$row = $result->row();
				$nama_divisi = $row->vDescription;
			} else {
				$nama_divisi = "";
			}
			
			return $nama_divisi;
		}
		
		public function listbox_priv2_resetpwd_iDepartementID($value, $pk, $name, $rowData) {
			$sql = "Select vDescription from hrd.msdepartement where iDeptId = '".$value."'";
			$result = $this->dbset->querY($sql);
			if ($result->num_rows() > 0) {
				$row = $result->row();
				$nama_divisi = $row->vDescription;
			} else {
				$nama_divisi = "";
			}
			
			return $nama_divisi;
		}
		
		
		public function listbox_priv2_resetpwd_HP($value, $pk, $name, $rowData) {
			$cNip = $rowData->cNip;
			$sql = "SELECT cHP FROM general.phonebk WHERE lDeleted=0 AND cNip='".$cNip."'";
			$result = $this->dbset->querY($sql);
			if ($result->num_rows() > 0) {
				$row = $result->row();
				$cHP = $row->cHP;
			} else {
				$cHP = "";
			}
			
			return $cHP;
		}
        
		public function updatebox_priv2_resetpwd_HP($field, $id, $value, $data) {

			$cNip = $data['cNip'];
			$sql = "SELECT cHP FROM general.phonebk WHERE lDeleted=0 AND cNip='".$cNip."'";
			$result = $this->dbset->querY($sql);
			if ($result->num_rows() > 0) {
				$row = $result->row();
				$cHP = $row->cHP;
			} else {
				$cHP = "";
			}
			

            $o = "<input  size='20' type='text' name='".$id."' id='".$id."' value='".$cHP."'/> &nbsp";
			$o .= "<a onclick='updhp()' class='icon-save ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary' >Update HP</a>";
			$o .= "<script>
						function updhp(){
							var hp = $('#".$id."').val();
							if (hp==''){
								custom_alert('HP is empty');
								return false;
							}
							jwb = confirm('Update Phone Number ?');
							if (jwb==1){
								x = updPhonebk();
								custom_alert('Berhasilll');
							}
						}
						
						function updPhonebk() {
							var hp = $('#".$id."').val();
							var nip = $('#priv2_resetpwd_cNip').val();
                            return $.ajax({
                                    type: 'POST',
                                    url: '".base_url()."processor/privilege2/priv2/resetpwd?action=updPhonebk',
                                    data: '_hp='+hp+'&_nip='+nip, 
                                    async: false				    					
                            }).responseText
                        }
						
				</script>";
            return $o;
        }
		
		
        public function updatebox_priv2_resetpwd_cnip($field, $id, $value, $data) {			
            $o = "<input style='background-color:#DEDEDE;' readonly size='6' type='text' name='".$id."' id='".$id."' value='".$value."'/>";

            return $o;
        }
		
        public function updatebox_priv2_resetpwd_vname($field, $id, $value, $data) {			
            $o = "<input style='background-color:#DEDEDE;' readonly size='50' type='text' name='".$id."' id='".$id."' value='".$value."'/>";

            return $o;
        }
        
        public function updatebox_priv2_resetpwd_dbirthday($field, $id, $value, $data) {
            $tanggal = date('d-m-Y', strtotime($value));
            $o = "<input style='background-color:#DEDEDE;' readonly size='8' type='text' name='".$id."' id='".$id."' value='".$tanggal."'/>";
            $o .= "&nbsp;<i>Password Default : (".date('Ymd', strtotime($value)).")</i>";

            return $o;
        }
		
        public function insertbox_priv2_resetpwd_groups($field, $id) {
            return "Please Save Record First";
        }
        
        public function updatebox_priv2_resetpwd_groups($field, $id, $value, $data) { 
            //$modules = Modules::run("http://localhost/sourcepriv2/Privilege2/priv2/setup/modules?company_id=".$this->input->get('company_id')."&group_id=".$this->input->get('group_id')."&modul_id=".$this->input->get('modul_id'));
            //echo $modules;
            //print_r($data);
            $url  = base_url().'processor/privilege2/priv2/setup/groups_dtl/';
			$url2 = base_url().'processor/privilege2/priv2/reset/password?action=update';
            $o  = '<script type="text/javascript">';
            $o .= '$(document).ready(function() {    
                        $("#authorization_list").tabs();                         
                        
						
						browse_tab(\''.$url2.'&id='.$data['cNip'].'&company_id='.$this->input->get('company_id').'&modul_id='.$this->input->get('modul_id').'&group_id='.$this->input->get('group_id').'\',\'RESET PASSWORD\', \'reset_pwd\');
                        
                    });
                    ';
            $o .= '</script>';
            $o .= '<div id="authorization_list">';
            $o .= '<ul>
                        
						<li><a href="#reset_pwd">Reset Password</a></li>
                      </ul>
                      <div id="group_dtl"></div>
					  <div id="reset_pwd"></div>
                  ';
            $o .= '</div>';
            
            return $o;
        }
        
        public function listbox_priv2_resetpwd_tupdatedat($value, $pk, $name, $rowData) {
		if ($value =='0000-00-00 00:00:00' || $value == null) {
			$tgl = '';
		} else {
			$tgl = date('d-m-Y H:i:s', strtotime($value));
		}

		return $tgl;
	}
        
        public function listbox_priv2_resetpwd_cupdatedby($value, $pk, $name, $rowData) {
                $this->dbset = $this->load->database('default', false);
                $this->dbset2 = $this->load->database('hrd', true);
		$sql = "Select vName as nama from hrd.employee where cNip='".$value."'";
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

            $sql = "Update erp_privi.privi_authlist set tCreatedAt = '".$today."', cCreatedBy='".$cNip."', 
                    tUpdatedAt = '".$today."', cUpdatedBy='".$cNip."' where idprivi_apps='".$id."'";
            $this->dbset->query($sql);
        }
        
        public function after_update_processor($fields, $id, $post) {
            $cNip = $this->sess_auth->gNIP;
            $tgl  =  date('Y-m-d', mktime());
            $today = date('Y-m-d H:i:s', mktime());
			
		
            $sql = "Update erp_privi.privi_authlist set tUpdatedAt = '".$today."', cUpdatedBy='".$cNip."' where idprivi_apps='".$id."'";
            $this->dbset->query($sql);
        }
        
        /*public function before_insert_processor($fields, $post) {
            unset($post['groups']);
            
            return $post;
        }
        
        public function before_update_processor($fields, $post) {
            unset($post['modules']);
            
            return $post;
        }*/
		
	public function output(){
		$this->index($this->input->get('action'));
	}
	
	function searchDept() {
        
		$divid = $this->input->get('_param'); //company
		$data = array();
	
		if ($divid == 0) {
			$sql = "select a.iDeptID as id, a.vDescription as nama from hrd.msdepartement a order by a.vDescription";
		} else {
			$sql = "select a.iDeptID as id, a.vDescription as nama from hrd.msdepartement a where a.iDivID = '".$divid."' 
					order by a.vDescription";
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
	
	public function manipulate_update_button($button) {
		unset($button);		
		$button['update'] = '';
		
		return $button;
	}	
}
?>