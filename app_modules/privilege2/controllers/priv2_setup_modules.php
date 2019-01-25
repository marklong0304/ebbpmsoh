<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class priv2_setup_modules extends MX_Controller {
	private $sess_auth;
	private $dbset;
        private $dbset2;
	private $url;
        var $idprivi_apps;        
			
    function __construct() {
        parent::__construct();
        $this->sess_auth = new Zend_Session_Namespace('auth');
        $this->url = 'priv2_setup_modules'; 
        $this->dbset = $this->load->database('default', true);        
    }
    function index($action = '') {		
            
    	//Bikin Object Baru Nama nya $grid
    	//$action = $this->input->get('action') ? $this->input->get('action') : 'create';	
        
            //echo 'idprivi_apps : '.$this->input->get('idprivi_apps');
            $grid = new Grid;	
            $grid->setTitle('Setup Modules');		
            $grid->setTable('erp_privi.privi_modules');		
            $grid->setUrl('priv2_setup_modules');	
            $grid->addList('vCodeModule', 'vNameModule', 'vPathModule', 'iParent', 'isDeleted');
            $grid->addFields('idprivi_apps', 'vCodeModule', 'vNameModule', 'vPathModule', 'iParent','iType', 'isDeleted');
            
            $grid->setLabel('vCodeModule', 'Kode Module');
            $grid->setLabel('vNameModule', 'Nama Module');
            $grid->setLabel('vPathModule', 'Path Module');
            $grid->setLabel('iType', 'Tipe ');
            $grid->setLabel('iParent', 'Parent');
            $grid->setLabel('tUpdatedAt', 'Tgl. Update');
            $grid->setLabel('cUpdatedBy', 'Update Oleh');
            $grid->setLabel('isDeleted', 'Status Record');
            $grid->setLabel('idprivi_apps', 'Application ID');
            
            $grid->setSearch('vCodeModule', 'vNameModule', 'isDeleted');
            //$grid->setQuery('isDeleted', '0');
            
            $grid->setWidth('vCodeModule', '250');
            $grid->setWidth('vNameModule', '150');
	    $grid->setWidth('vPathModule', '230');
            $grid->setWidth('iParent', '180');
            $grid->setWidth('isDeleted', '80');
            
            $grid->setAlign('isDeleted', 'center');
            $grid->setAlign('tUpdatedAt', 'center');
            $grid->setAlign('cUpdatedBy', 'center');
            
            $grid->setSortBy('concat(if((Select a.idprivi_modules from erp_privi.privi_modules a where a.idprivi_modules = erp_privi.privi_modules.iParent LIMIT 1)IS NOT NULL , (Select if( a.iParent = 0, a.vCodeModule,if( b.iParent = 0,  concat(b.vCodeModule, a.vCodeModule ) , concat(c.vCodeModule,b.vCodeModule,a.vCodeModule ))) from erp_privi.privi_modules a LEFT JOIN erp_privi.privi_modules b ON b.idprivi_modules = a.iParent LEFT JOIN erp_privi.privi_modules c ON c.idprivi_modules = b.iParent where a.idprivi_modules = erp_privi.privi_modules.iParent LIMIT 1),erp_privi.privi_modules.vCodeModule ),  erp_privi.privi_modules.vCodeModule )');
            $grid->setSortOrder('ASC'); //sort ordernya
            
            $grid->changeFieldType('idprivi_apps', 'hidden');
            $grid->changeFieldType('isDeleted','combobox', '', array(''=>' ', 0=>'Aktif', 1=>'Deleted'));                          
            $grid->changeFieldType('iType','combobox', '', array( 0=>'Menu', 1=>'Module'));                          
            
            
            $this->idprivi_apps = $this->input->get('idprivi_apps');            
            $grid->setInputGet('_idprivi_apps', $this->idprivi_apps);            
	    	$grid->setQuery('erp_privi.privi_modules.idprivi_apps', intval($this->input->get('_idprivi_apps')));
            
            $grid->setDeletedKey("isDeleted");
            $grid->setForeignKey($this->input->get('idprivi_apps'));
            
            //echo 'Foreign Key : '.$grid->getForeignKey();

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
        
        /*public function insertbox_priv2_setup_modules_idprivi_apps($field, $id) {
            $o = "<input type='hidden' name='".$field."' id='".$id."' value='".$this->input->get('foreign_key')."'/>".$this->input->get('foreign_key');
            
            return $o;
        }
        
        public function updatebox_priv2_setup_modules_idprivi_apps($field, $id) {
            $o = "<input type='hidden' name='".$field."' id='".$id."' value='".$this->input->get('foreign_key')."'/>".$this->input->get('foreign_key');
            
            return $o;
        }*/
        
        public function insertbox_priv2_setup_modules_iparent($field, $id) {            
            $sql = "Select idprivi_modules, vPathModule from privi_modules where isDeleted = 0 and idprivi_apps = '".$this->input->get('foreign_key')."'";
            //echo $sql;
            $o  = "<select name='".$id."' id='".$id."'>";
            $o .= "<option value='0'>Root</option>";
            $query = $this->dbset->query($sql);
            if ($query->num_rows() > 0) {
                foreach($query->result_array() as $r) {
                    $o .= "<option value='".$r['idprivi_modules']."'>".$r['vPathModule']."</option>";
                }
            }
            
            $o .= "</select>";
            
            //$o .= '<input type="hidden" value="'.$this->input->get('foreign_key').'" id="priv2_setup_modules_idprivi_apps" name="idprivi_apps">';
            $o .= '<input type="hidden" value="'.$this->input->get('foreign_key').'" id="priv2_setup_modules_idprivi_apps" name="priv2_setup_modules_idprivi_apps">';
            $o .= '<input type="hidden" value="'.$this->input->get('foreign_key').'" id="priv2_setup_modules_foreign_key" name="priv2_setup_modules_foreign_key">';
            
            return $o;
        }
        
        public function updatebox_priv2_setup_modules_iparent($field, $id, $value, $rowData) {   
            //echo 'aaa';
            //print_r($grid);
            //exit;
            $sql = "Select idprivi_modules, vPathModule from privi_modules where isDeleted = 0 and idprivi_apps = '".$rowData['idprivi_apps']."' order by vPathModule asc";
            //echo $sql;
            $o  = "<select name='".$id."' id='".$id."'>";
            $o .= "<option value='0'>Root</option>";
            $query = $this->dbset->query($sql);
            if ($query->num_rows() > 0) {
                foreach($query->result_array() as $r) {
                    if ($value == $r['idprivi_modules']) $selected = " selected";
                    else $selected = "";
                    $o .= "<option {$selected} value='".$r['idprivi_modules']."'>".$r['vPathModule']."</option>";
                }
            }
            
            $o .= "</select>";
            
            $o .= '<input type="hidden" value="'.$rowData['idprivi_apps'].'" id="priv2_setup_modules_idprivi_apps" name="idprivi_apps">';
            $o .= '<input type="hidden" value="'.$rowData['idprivi_apps'].'" id="priv2_setup_modules_foreign_key" name="foreign_key">';
            
            return $o;
        }
        
        public function listbox_priv2_setup_modules_iparent($value, $pk, $name, $rowData) {
		$sql = "Select vPathModule as nama from privi_modules where idprivi_modules='".$value."'";
		$query = $this->dbset->query($sql);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$nama = $row->nama;
		} else {
			$nama = '';
		}
		return $nama;
	}
        
        public function listbox_priv2_setup_modules_tupdatedat($value, $pk, $name, $rowData) {
		if ($value =='0000-00-00 00:00:00' || $value == null) {
			$tgl = '';
		} else {
			$tgl = date('d-m-Y H:i:s', strtotime($value));
		}

		return $tgl;
	}
        
        public function listbox_priv2_setup_modules_cupdatedby($value, $pk, $name, $rowData) {
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
	
	public function manipulate_grid_button($button) {    	
    	
    	unset($button['create']);
    	$url = base_url()."processor/privilege2/priv2/setup/modules?action=create&foreign_key=".$this->input->get('idprivi_apps')."&idprivi_apps=".$this->input->get('idprivi_apps')."&company_id=".$this->input->get('company_id')."&group_id=".$this->input->get('group_id')."&modul_id=".$this->input->get('modul_id');
    	$btn_baru  = "<script type='text/javascript'>
		    	function add_btn_$this->url(url, title) {
		    		browse_with_no_close(url, title);
		    	}    	 
    		</script>
    	";
    	//$btn_baru .= '<button id="button_add_perso_master_agama" name="button_add_perso_master_agama"
    	//		onclick="javascript:add_btn_'.$this->url.'(\''.$url.'\', \'MASTER AGAMA\');" class="icon-add ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary">Add New</button>';
    	$btn_baru .= '<span class="icon-add ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" onclick="add_btn_'.$this->url.'(\''.$url.'\', \'SETUP MODULES\')">Add New</span>';
    	
    	array_unshift($button, $btn_baru);
   
    	return $button;
    	
    }
	
	public function listBox_Action($row, $actions) {

    	unset($actions['view']);
    	unset($actions['edit']);
    	unset($actions['delete']);
        	
    	$url = base_url()."processor/privilege2/priv2/setup/modules?action=update&idprivi_app=".$row->idprivi_apps."&foreign_key=".$row->idprivi_apps."&id=".$row->idprivi_modules;
    	$edit  = "<script type'text/javascript'>
    							function edit_btn_".$this->url."(url, title) {
    								browse_with_no_close(url, title);
    							}
    						</script>";
    	$edit .= "<a href='#' onclick='javascript:edit_btn_".$this->url."(\"".$url."\", \"SETUP GROUPS\");'><center><span class='ui-icon ui-icon-pencil'></span></center></a>";
    	$actions['edit'] = $edit;
    	 
    	return $actions;
    }
        
        public function after_insert_processor($fields, $id, $post) {
            $cNip = $this->sess_auth->gNIP;
            $tgl  =  date('Y-m-d', mktime());
            $today = date('Y-m-d H:i:s', mktime());
            
            $sql = "Update privi_modules set idprivi_apps = '".$post['idprivi_apps']."', tCreatedAt = '".$today."', cCreatedBy='".$cNip."', 
                    tUpdatedAt = '".$today."', cUpdatedBy='".$cNip."' where idprivi_modules='".$id."'";
            $this->dbset->query($sql);
        }
        
        public function after_update_processor($fields, $id, $post) {
            $cNip = $this->sess_auth->gNIP;
            $tgl  =  date('Y-m-d', mktime());
            $today = date('Y-m-d H:i:s', mktime());

            $sql = "Update privi_modules set idprivi_apps = '".$post['idprivi_apps']."', 
                tUpdatedAt = '".$today."', cUpdatedBy='".$cNip."' where idprivi_modules='".$id."'";
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
                                            												$.get(url+'&action=update&id='+last_id+'&foreign_key='+foreign_id+'&idprivi_apps='+foreign_id, function(data) {
																									//$('div#form_'+grid).html(data);
																									$('#alert_dialog_form').html(data);
																									//$('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
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
                                      </script>";
		$button['save_back'] .= "<button type='button'
							name='button_create_".$this->url."'
							id='button_create_".$this->url."'
							class='icon-save ui-button'
							onclick='javascript:create_btn_back_".$this->url."(\"".$this->url."\", \"".base_url()."processor/privilege2/priv2/setup/modules?idprivi_apps=".$this->input->get('foreign_key')."&company_id=".$this->input->get('company_id')."&group_id=".$this->input->get('group_id')."&modul_id=".$this->input->get('modul_id')."\", this)'>Save Modules
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
							onclick='javascript:cancel_btn_".$this->url."(\"".$this->url."\", \"".base_url()."processor/privilege2/priv2/setup/modules?idprivi_apps=".$this->input->get('foreign_key')."&company_id=".$this->input->get('company_id')."&group_id=".$this->input->get('group_id')."&modul_id=".$this->input->get('modul_id')."\", this)'>Back 
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
                                                            custom_confirm(comfirm_message,function(){
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
                                      </script>";
		$button['update_back'] .= "<button type='button'
							name='button_update_".$this->url."'
							id='button_update_".$this->url."'
							class='icon-save ui-button'
							onclick='javascript:update_btn_back_".$this->url."(\"".$this->url."\", \"".base_url()."processor/privilege2/priv2/setup/modules?idprivi_apps=".$this->input->get('foreign_key')."&company_id=".$this->input->get('company_id')."&group_id=".$this->input->get('group_id')."&modul_id=".$this->input->get('modul_id')."\", this)'>Save Modules
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
                                                var idprivi_apps = $('#priv2_setup_modules_idprivi_apps').val();
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
							onclick='javascript:cancel_btn_".$this->url."(\"".$this->url."\", \"".base_url().'processor/privilege2/priv2/setup/modules?idprivi_apps='.$this->input->get('foreign_key').'&company_id='.$this->input->get('company_id')."&group_id=".$this->input->get('group_id')."&modul_id=".$this->input->get('modul_id')."\", this)'>Back 
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
        
	public function output(){
		$this->index($this->input->get('action'));
	}
}
?>