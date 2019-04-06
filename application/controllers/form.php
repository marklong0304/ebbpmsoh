<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Form extends MX_Controller {
	private $dbset;
	private $url = 'form';
	private $model = 'm_member';
	private $limit = 5;
	function __construct() {
        parent::__construct();
		$this->load->model($this->model);
		$this->db = $this->load->database('hrd',false, true);

		$this->url = 'approval_pengujian';
		$this->urlpath = 'pengujian/'.str_replace("_","/", $this->url);


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
		
		
		$nip 			= '1';
		//$password = $post['vPassword'];
		$nama 			= $post['vName'];
		$email 			= $post['vEmail'];
		$alamat1 		= $post['vAddress'];
		$telp1 			= $post['vTelepon'];
		$emailcompany 	= $post['vEmail_company'];
		$namacompany	= $post['vName_company'];
		$alamat2		= $post['vAddress_company'];
		$telpcompany	= $post['vTelepon_company'];
		$faxcompany		= $post['vFax_company'];
		$password5		= $post['vPassword'];
		$password		= md5($password5);
		
		// $val->set_rules('recaptcha_challenge_field', 'Security Code', 'required|recaptcha_matches');
		
		$data_user = array('cNip'=>$nip,'vEmail'=>$email,'vPassword'=>$password,'vName'=>$nama,'vAddress'=>$alamat1,'vTelepon'=>$telp1,
							'vEmail_company'=>$emailcompany,'vName_company'=>$namacompany,'vAddress_company'=>$alamat2,'vTelepon_company'=>$telpcompany
							,'vFax_company'=>$faxcompany);
									
		//$datanya = $this->m_member->insert_entry($post);
		$dbset = $this->load->database('hrd', true);

	    $datanya = $this->db->insert('hrd.employee', $data_user);
	    
	    $insert_id = $this->db->insert_id();
		//print_r($password);exit;
		
			if($datanya){
				/*$insert_id = $this->dbset->insert_id();*/

				/*
				$ema=str_replace('@', '%40', $post['vEmail']);
				$config['mailtype'] = 'html';
				$config['charset'] = 'iso-8859-1';
				$config['wordwrap'] = TRUE;
				
				$this->email->initialize($config);
				//$aktifasi	= anchor('home/user_activation/'.$ema.'/'.$post['hash'],'Activation Now');
				$message = ' <html>
								<head>
								</head>
								<body>
									<p>Selamat, account Anda telah sukses dibuat dengan data berikut: </p><br>
									<p>Nama	 : '.$post['vName'].'</p>
									<p>Username : '.$post['vEmail'].'</p>
									<p>Password : '.$password.'</p><br>
									<p>Terima kasih telah mendaftarkan diri Anda sebagai member website apotik.medicastore.com dan medicastore.com.</p>
									<p>
										Selanjutnya lakukan verifikasi untuk mengaktifkan account Anda dengan meng-klik link dibawah ini.
									</p>
									
									<p>Setelah dikonfirmasi, Anda akan mendapatkan akses penuh ke website dan Forum Komentar Medicasatore.</p><br><br>
									<p>- Medicastore Team</p>
									<p>Media Informasi Obat dan Penyakit</p>
									<p>--------------------------------------</p>
									<p>Kunjungi Apotik Online Medicastore di http://apotik.medicastore.com/ dan dapatkan harga yang kompetitif dari Apotik Medicastore.</p>
									<p>--------------------------------------</p>
								</body>
								</html>';
			
				$this->email->from('noreply@krpl.com');
				$this->email->to($post['email']);
	
				$this->email->subject('Signup | Verification');
				$this->email->message($message);
				
				$this->email->send();
				 * 
				 */

				$nomor = "C".str_pad($insert_id, 5, "0", STR_PAD_LEFT);
				$sql = "UPDATE hrd.employee SET cNip = '".$nomor."' WHERE ID=$insert_id LIMIT 1";
				$query = $this->db->query( $sql );


		        $subject = '';
		        $qsql="
		                select * from hrd.employee a where a.ID = '".$insert_id."'

		        ";
		        $rsql = $this->db->query($qsql)->row_array();

		        $subject = 'e-Pengujian -> Registrasi User '.$rsql['cNip'].' - '.$rsql['vName'];
	            $precontent = 'Ada Registrasi User baru ';

                if($subject <> ""){
                    $iAm = $this->whoAmI($rsql['cNip']);

                    $sqlEmpAr = 'select * from bbpmsoh.sysparam a where a.vVariable="MAIL_NEW_REG"';
                    $dEmpAr =  $this->db->query($sqlEmpAr)->row_array();
                    $sq= $dEmpAr['vContent'];
                    $dataTO = $this->db->query($sq)->result_array();

                    $to = '' ;                        
                    $cc = $iAm['cNip'] ;



                    $to = '0';
                    foreach ($dataTO as $toto) {
                        $to .=','.$toto['cNIP'];
                    }

                    $bccMail = 'select * from bbpmsoh.sysparam a where a.vVariable="MAIL_BCC"';
                    $dBcc =  $this->db->query($sqlEmpAr)->row_array();

                    $to = $to;
                    $cc = $dBcc['vContent'];

                    
                    $content="
                            <p>Diberitahukan bahwa ".$precontent." yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>
                            <br><br>  
                            <table border='1' style='width: 750px;border-collapse: collapse;'>
                                <tr>
                                        <td style='width: 30%;'><b>Nama Pemohon</b></td>
                                        <td> : ".$rsql['cNip'].' || '.$rsql['vName']."</td>
                                </tr>

                                <tr>
                                        <td style='width: 30%;'><b>Email</b></td>
                                        <td> :".$rsql['vEmail']."</td>
                                </tr>

                                <tr>
                                        <td><b>Alamat</b></td>
                                        <td> : ".nl2br($rsql['vAddress'])."</td>
                                </tr>

                                <tr>
                                        <td><b>No. Telepon</b></td>
                                        <td> :".$rsql['vTelepon']."</td>
                                </tr>

                                <tr>
                                        <td><b>Nama Perusahaan</b></td>
                                        <td> :".$rsql['vName_company']."</td>
                                </tr> 

                                <tr>
                                        <td><b>Alamat Perusahaan</b></td>
                                        <td> : ".nl2br($rsql['vAddress_company'])."</td>
                                </tr>

                                <tr>
                                        <td><b>No. Telepon Perusahaan</b></td>
                                        <td> :".$rsql['vTelepon']."</td>
                                </tr>

                                <tr>
                                        <td><b>Lokasi Modul</b></td>
                                        <td> e-Pengujian -> Transaksi -> Approval Registrasi</td>
                                </tr>
                                
                            </table> 

                        <br/> <br/>
                        Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>
                        Post Master"; 

                        $this->sess_auth->send_message_erp2(4272,$to, $cc, $subject, $content,$insert_id);
                }




				echo 1;
				redirect('success');
				//echo $this->email->print_debugger();
			}
			else{
				echo "Insert error";
			}
		
	}

	function whoAmI($nip) { 
        $sql = 'select b.vDescription as vdepartemen,a.*,b.*
                        from hrd.employee a 
                        join hrd.msdepartement b on b.iDeptID=a.iDepartementID
                        join hrd.position c on c.iPostId=a.iPostID
                        where a.cNip ="'.$nip.'"
                        ';
        
        $data = $this->db->query($sql)->row_array();
        return $data;
    }


	function success() {
		$data['active_link']="";
        $data['title']="Pendaftaran Sukses";
		//$this->template->display('v_success_signup',$data);
		$this->load->view('registrasi/success',$data);
	}

}