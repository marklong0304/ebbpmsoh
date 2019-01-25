<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class priv2_reset_password extends MX_Controller {
	private $sess_auth;
	private $dbset;
	var $cNip;
	function __construct() {
        parent::__construct();
        $this->sess_auth = new Zend_Session_Namespace('auth');
		$this->url = 'priv2_reset_password'; 
		$this->dbset = $this->load->database('hrd', true);
                $this->load->library('MyInput');
    }
	
	function index($action = '') {		
    	//Bikin Object Baru Nama nya $grid
    	$action = $this->input->get('action') ? $this->input->get('action') : 'create';		
		$grid = new Grid;		
		$grid->setTitle('Reset Password');		
		$grid->setTable('hrd.employee');		
		$grid->setUrl('priv2_reset_password');		
		$grid->addFields('vPassword', 'vRptPassword');
		$grid->setLabel('vPassword', 'Password');
		$grid->setLabel('vRptPassword', 'Repeat Password');
		//$grid->setPk('cNip');

		switch ($action) {		
			case 'update':
				$grid->render_form($this->input->get('id'));
				break;
			case 'updateproses':
				$this->resetPwd();
				break;
			default:
				$grid->render_grid();
				break;
		}
    }
	
	public function resetPwd() {
		$nip   = $this->input->post('priv2_reset_password_ID', TRUE);
		$pass  = $this->input->post('priv2_reset_password_vPassword', FALSE);
		$rpass = $this->input->post('priv2_reset_password_vRptPassword', FALSE);
                
		$data['status'] = TRUE;
		$data['last_id'] = $nip;
		$data['message'] = "Password berhasil dirubah";
		try {
			$sql = "UPDATE hrd.employee set vPassword = md5('".$pass."') where cNip = '{$nip}'";
			
			$this->dbset->query($sql);
		}catch(Exception $e) {
			$data['status'] = FALSE;	
			$data['message'] = "Password gagal dirubah";
		}
		
		echo json_encode($data);		
		exit;
	}
	
	public function updateBox_priv2_reset_password_vPassword($field, $id) {
		$o = "<input type='password' name='{$id}' id='{$id}' size='30' class='fieldTextBox' value=''/>";
		$o.= "<b><i> Leave password, if you dont want to change password</b></i>";
		return $o;
	}
	
	public function updateBox_priv2_reset_password_vRptPassword($field, $id) {
		$o = "<input type='password' name='{$id}' id='{$id}' size='30' class='fieldTextBox' value=''/>";
		$o.= '<p class="validateTips padding-4"></p>';
		return $o;
	}
	
	public function manipulate_update_button($button) {
		unset($button['update']);
			
		$js  =  "<script type='text/javascript'>
							var tips = $( '.validateTips' );	

							$(document).ready(function() {								
								$('input[type=\"password\"]').val('');
							});
							
							function update_btn_back_".$this->url."(grid, url, dis) {
	
								var req = $('#form_update_'+grid+' input.required, #form_update_'+grid+' select.required, #form_update_'+grid+' textarea.required');
								var conf=0;
								var alert_message = '';
								var tot_err = 0;
								var vPass    = $('#priv2_reset_password_vPassword').val();
								var vRptPass = $('#priv2_reset_password_vRptPassword').val();
								
								
								var new_pass = $('#priv2_reset_password_vPassword'),
								rpt_pass     = $('#priv2_reset_password_vRptPassword');

								var bValid = true;
								bValid = bValid;
								bValid = bValid && checkRegexp( new_pass, /^([0-9a-zA-Z~!@#$%^&*_+=`-])+$/, 'Password field not allowed' );
								bValid = bValid && checkMatch(new_pass, rpt_pass)
								
								if(bValid){ 								
									custom_confirm(comfirm_message,function(){
										var dataForm = $('#form_update_'+grid).serializeArray();
										$.ajax({
											url: $('#form_update_'+grid).attr('action'),
											type: 'post',
											data: dataForm,
											success: function(data) {
												var o = $.parseJSON(data);
												var info = 'Error';
												var header = 'Error';
												var last_id = o.last_id;

												if(o.status == true) {
													info = 'Info';
													header = 'Info';
													$.get(url+'&action=update&id='+last_id, function(data) {
													   $('div#form_'+grid).html(data);												   
													});
													
													new_pass.removeClass( 'ui-state-error');	
													rpt_pass.removeClass( 'ui-state-error');	
													
												}
												_custom_alert(o.message,header,info, grid, 1, 20000);
											}
										})
									});										
								}
							}
							
							function checkLength( o, n, min, max ) {
								if ( o.val().length > max || o.val().length < min ) {
									o.addClass( 'ui-state-error' );
									updateTips( 'Length of ' + n + ' must be between ' +
										min + ' and ' + max + '.' );
									return false;
								} else {
									return true;
								}
							}

							function checkRegexp( o, regexp, n ) {
								if ( !( regexp.test( o.val() ) ) ) {
									o.addClass( 'ui-state-error' );
									updateTips( n );
									return false;
								} else {
									return true;
								}
							}

							function checkMatch(n, r){
								if( n.val() != r.val() ){
									r.addClass( 'ui-state-error' );
									updateTips( 'Password didn\'t match.' );
									return false;
								}else{
									return true;
								}
							}

							function updateTips( t ) {
								tips.text( t ).addClass( 'ui-state-highlight' );
								setTimeout(function() { 
									tips.removeClass( 'ui-state-highlight', 1500 );	
									tips.text('').removeClass( 'ui-state-highlight', 1500 );
								}, 1500 );
							}
						  </script>";
		$btnSave = "<button type='button'
							name='button_update_'.$this->url
							id='button_update_'.$this->url
							class='icon-save ui-button'
							onclick='javascript:update_btn_back_".$this->url."(\"".$this->url."\", \"".base_url()."processor/privilege2/priv2/reset/password?company_id=".$this->input->get('company_id')."&group_id=".$this->input->get('group_id')."&modul_id=".$this->input->get('modul_id')."\", this)'>Update
							</button>";
	
		//$cNip = $this->sess_auth->gNIP;
		
		$button['update'] = $btnSave.$js;
		
		return $button;
	}
	
	public function output(){
		$this->index('update');
	}
	
}