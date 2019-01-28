<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Form extends MX_Controller {
	private $url = 'form';
	private $model = 'm_member';
	private $limit = 5;
	function __construct() {
        parent::__construct();
		$this->load->model($this->model);
		//$this->load->library('content');
		//$this->load->helper('recaptcha');
		//$this->load->library('securimage');
    }
	
	public function registrasi(){
		//echo "TYEs";exit;
		$model = $this->model;
		$this->load->helper('recaptcha'); 
		
		$data['default_meta'] = 1;
		//$data['product'] = $p;
		$data['title'] = 'Product';
		$data['url']=$this->url;
		$data['header_description'] = 'Our Product';
		$this->load->view('registrasi/v_login',$data);
		
		
	}
	public function prosesregis() {
		
		$this->load->library('form_validation');
		//$this->load->library('email');
		
		$post = $this->input->post();
		//$val = $this->form_validation;
		//$inputCode = $this->input->post('imagecode');
		
		
		//$post['hash'] = md5(rand(0,1000));
		//$password = $post['vPassword'];
		$post['vPassword'] = md5($post['vPassword']);
		unset($post['vName']);
		unset($post['vEmail']);
		unset($post['vAddress']);
		unset($post['vTelepon']);
		unset($post['vEmail_company']);
		unset($post['vName_company']);
		unset($post['vAddress_company']);
		unset($post['vTelepon_company']);
		unset($post['vFax_company']);
		// $val->set_rules('recaptcha_challenge_field', 'Security Code', 'required|recaptcha_matches');
		
		
		$datanya = $this->db->insert('employee',$post);
		print_r($post);exit;
		if ($datanya) {
			echo 1;
		} else {
			echo "Insert error";
		}
		if ($datanya == true){
			if($this->db->insert('employee',$post)){
				$ema=str_replace('@', '%40', $post['email']);
				$config['mailtype'] = 'html';
				$config['charset'] = 'iso-8859-1';
				$config['wordwrap'] = TRUE;
				
				$this->email->initialize($config);
				$aktifasi	= anchor('home/user_activation/'.$ema.'/'.$post['hash'],'Activation Now');
				$message = ' <html>
								<head>
								</head>
								<body>
									<p>Selamat, account Anda telah sukses dibuat dengan data berikut: </p><br>
									<p>Nama	 : '.$post['name'].'</p>
									<p>Username : '.$post['email'].'</p>
									<p>Password : '.$password.'</p><br>
									<p>Terima kasih telah mendaftarkan diri Anda sebagai member website apotik.medicastore.com dan medicastore.com.</p>
									<p>
										Selanjutnya lakukan verifikasi untuk mengaktifkan account Anda dengan meng-klik link dibawah ini.
									</p>
									<p>'.$aktifasi.'</p>
									<p>Setelah dikonfirmasi, Anda akan mendapatkan akses penuh ke website dan Forum Komentar Medicasatore.</p><br><br>
									<p>- Medicastore Team</p>
									<p>Media Informasi Obat dan Penyakit</p>
									<p>--------------------------------------</p>
									<p>Kunjungi Apotik Online Medicastore di http://apotik.medicastore.com/ dan dapatkan harga yang kompetitif dari Apotik Medicastore.</p>
									<p>--------------------------------------</p>
								</body>
								</html>';
			
				$this->email->from('noreply@medicastore.com');
				$this->email->to($post['email']);
	
				$this->email->subject('Signup | Verification');
				$this->email->message($message);
				
				$this->email->send();
				echo 1;
				//echo $this->email->print_debugger();
			}
			else{
				echo "Insert error";
			}
		}
		else{
			echo 'Kode Tidak Sama, Ulangi!';
		}
	}



}