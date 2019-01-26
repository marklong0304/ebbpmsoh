<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class priv2_setup_application extends MX_Controller {
	private $sess_auth;
	private $dbset;
    private $dbset2;
	private $url;
			
    function __construct() {
        parent::__construct();
        $this->sess_auth = new Zend_Session_Namespace('auth');
        $this->url = 'priv2_setup_application'; 
        $this->dbset = $this->load->database('default', true);
    }
    function index($action = '') {		
    	//Bikin Object Baru Nama nya $grid
    	//$action = $this->input->get('action') ? $this->input->get('action') : 'create';		
            $grid = new Grid;		
            $grid->setTitle('Setup Aplikasi');		
            $grid->setTable('erp_privi.privi_apps');		
            $grid->setUrl('priv2_setup_application');	
            $grid->addList('vAppName', 'txtDesc', 'isDeleted', 'tUpdatedAt', 'cUpdatedBy');
            $grid->addFields('vAppName', 'txtDesc', 'isDeleted', 'modules');
                                    
            $grid->setSearch('vAppName', 'isDeleted');
            //$grid->setQuery('isDeleted', '0');
			$grid->setWidth('vAppName', '250');
			$grid->setWidth('txtDesc', '400');
            $grid->setWidth('isDeleted', '80');
            $grid->setWidth('tUpdatedAt', '130');
            $grid->setWidth('cUpdatedBy', '120');
            
            $grid->setAlign('isDeleted', 'center');
            $grid->setAlign('tUpdatedAt', 'center');
            $grid->setAlign('cUpdatedBy', 'left');
            
            $grid->setSortBy('vAppName');
            $grid->setSortOrder('ASC'); //sort ordernya
            
            $grid->setLabel('vAppName', 'Nama Aplikasi');
            $grid->setLabel('txtDesc', 'Deskripsi Aplikasi');
            $grid->setLabel('tUpdatedAt', 'Tgl. Update');
            $grid->setLabel('cUpdatedBy', 'Update Oleh');
            $grid->setLabel('isDeleted', 'Status Record');
            $grid->setLabel('modules', ' ');
            
            $grid->setRequired('vAppName', 'txtDesc');
            
            //$grid->setDeletedKey('isDeleted');
            //$grid->setPk('idprivi_apps');
            
            $grid->changeFieldType('isDeleted','combobox', '', array(0=>'Aktif', 1=>'Deleted'));//array(''=>'--Select--', 0=>'Aktif', 1=>'Deleted'));

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
        
        public function insertbox_priv2_setup_application_modules($field, $id) {
            return "Please Save Record First";
        }
        
        public function updatebox_priv2_setup_application_modules($field, $id, $value, $data) { 
            //$modules = Modules::run("http://localhost/sourcepriv2/Privilege2/priv2/setup/modules?company_id=".$this->input->get('company_id')."&group_id=".$this->input->get('group_id')."&modul_id=".$this->input->get('modul_id'));
            //echo $modules;
            $url = base_url().'processor/privilege2/priv2/setup/modules/';   
            $url2 = base_url().'processor/privilege2/priv2/setup/groups/';
	    $url3 = base_url().'processor/privilege2/priv2/setup/usergroups/';
            $o  = '<table width="100%" style="margin-top:30px;margin-bottom:10px;margin-right:5px;margin-left:-185px">';
            $o .= '<tr><td>';
            $o .= '<script type="text/javascript">';
            $o .= '$(document).ready(function() {    
                        $("#'.$this->url.'_setup_application").tabs();
			browse_tab(\''.$url3.'?idprivi_apps='.$data['idprivi_apps'].'&company_id='.$this->input->get('company_id').'&modul_id='.$this->input->get('modul_id').'&group_id='.$this->input->get('group_id').'\',\'USER GROUP\', \''.$this->url.'_usergroup\');                        
                        browse_tab(\''.$url2.'?idprivi_apps='.$data['idprivi_apps'].'&company_id='.$this->input->get('company_id').'&modul_id='.$this->input->get('modul_id').'&group_id='.$this->input->get('group_id').'\',\'GROUP\', \''.$this->url.'_group\');                        
                        browse_tab(\''.$url.'?idprivi_apps='.$data['idprivi_apps'].'&company_id='.$this->input->get('company_id').'&modul_id='.$this->input->get('modul_id').'&group_id='.$this->input->get('group_id').'\',\'MODULE\', \''.$this->url.'_module\');                        
                        
                    });
                    ';
            $o .= '</script>';
            $o .= '<div id="'.$this->url.'_setup_application" width="100%">';
            $o .= '<ul>                        
                        <li><a href="#'.$this->url.'_module">Modules</a></li>
			<li><a href="#'.$this->url.'_group">Group</a></li>
			<li><a href="#'.$this->url.'_usergroup">User Group</a></li>
                      </ul>                      
                      <div id="'.$this->url.'_module"></div>
		      <div id="'.$this->url.'_group"></div>
		      <div id="'.$this->url.'_usergroup"></div>
                  ';
            $o .= '</div>';
            $o .= '</td></tr>';            
            $o .= '</table>';
            return $o;
        }
        
        public function listbox_priv2_setup_application_tupdatedat($value, $pk, $name, $rowData) {
			if ($value =='0000-00-00 00:00:00' || $value == null) {
				$tgl = '';
			} else {
				$tgl = date('d-m-Y H:i:s', strtotime($value));
			}
	
			return $tgl;
		}
        
        public function listbox_priv2_setup_application_cupdatedby($value, $pk, $name, $rowData) {
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

            $sql = "Update privi_apps set tCreatedAt = '".$today."', cCreatedBy='".$cNip."', 
                    tUpdatedAt = '".$today."', cUpdatedBy='".$cNip."' where idprivi_apps='".$id."'";
            $this->dbset->query($sql);
        }
        
        public function after_update_processor($fields, $id, $post) {        	
            $cNip = $this->sess_auth->gNIP;
            $tgl  =  date('Y-m-d', mktime());
            $today = date('Y-m-d H:i:s', mktime());

            $sql = "Update privi_apps set tUpdatedAt = '".$today."', cUpdatedBy='".$cNip."' where idprivi_apps='".$id."'";
            $this->dbset->query($sql);
        }
        
        /*public function before_insert_processor($fields, $post) {  
            //print_r($post);
            unset($post['groups_vNamaGroup']);
            unset($post['groups_isDeleted']);
            unset($post['iCompanyId']);
            unset($post['modules']);
            unset($post['modules_vCodeModule']);
            unset($post['modules_vNameModule']);
            unset($post['modules_isDeleted']);
            
            return $post;
        }
        
        public function before_update_processor($fields, $post) {
            //print_r($post);
            unset($post['groups_vNamaGroup']);
            unset($post['groups_isDeleted']);
            unset($post['iCompanyId']);
            unset($post['modules']);
            unset($post['modules_vCodeModule']);
            unset($post['modules_vNameModule']);
            unset($post['modules_isDeleted']);
            
            return $post;
        }*/
    
	public function output(){
		$this->index($this->input->get('action'));
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
                                                                                            $.get(url+'&action=update&id='+last_id+'&foreign_key='+foreign_id, function(data) {
                                                                                                    $('div#form_'+grid).html(data);
                                                                                                    $('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
                                                                                            });
                                                                                            /*$.get(url, function(data){
                                                                                                    $('div#grid_wraper_'+grid).html(data);
                                                                                                    $('html, body').animate({scrollTop:$('#'+grid).offset().top - 20}, 'slow');
                                                                                            })*/
                                            												reload_grid('grid_'+grid);
                                            		
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
							onclick='javascript:create_btn_back_".$this->url."(\"".$this->url."\", \"".base_url()."processor/privilege2/priv2/setup/application?company_id=".$this->input->get('company_id')."&group_id=".$this->input->get('group_id')."&modul_id=".$this->input->get('modul_id')."\", this)'>Save Application
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
							onclick='javascript:cancel_btn_".$this->url."(\"".$this->url."\", \"".base_url()."processor/privilege2/priv2/setup/application?company_id=".$this->input->get('company_id')."&group_id=".$this->input->get('group_id')."&modul_id=".$this->input->get('modul_id')."\", this)'>Back
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
	
	
                                                            if (tot_err > 0) {
                                                                    alert('Lengkapi isian Anda');
                                                                    return false;
                                                            }
                                                            
                                                            custom_confirm(comfirm_message,function(){           
                                                                    //console.log($('#form_update_'+grid).attr('action'));                                						
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
                                                                                            //alert(last_id);
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
							onclick='javascript:update_btn_back_".$this->url."(\"".$this->url."\", \"".base_url()."processor/privilege2/priv2/setup/application?company_id=".$this->input->get('company_id')."&group_id=".$this->input->get('group_id')."&modul_id=".$this->input->get('modul_id')."\", this)'>Save Application
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
							onclick='javascript:cancel_btn_".$this->url."(\"".$this->url."\", \"".base_url().'processor/privilege2/priv2/setup/application?company_id='.$this->input->get('company_id')."&group_id=".$this->input->get('group_id')."&modul_id=".$this->input->get('modul_id')."\", this)'>Back
							</button>";*/
	
		if ($this->input->get('action') == 'view') unset($button['update_back']);
		else '';
	
		return $button;
	}
}
?>
