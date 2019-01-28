<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_member extends CI_Model {
	function __construct() {
        parent::__construct();
    }
   
	function get_activation($hash,$email) {
		$this->db->where('hash',$hash);
		$this->db->where('email',$email);
		$this->db->where('active',0);
   		$this->db->select('*');
		return $this->db->get('member');
	}
	function update_activation($datanya,$hash,$email) {
		$this->db->where('hash',$hash);
		$this->db->where('email',$email);
		$this->db->where('active',0);
		return $this->db->update('member', $datanya); 
	}
	function check_email($email) {
		$this->db->where('email',$email);
		$this->db->where('active',1);
		$this->db->select('*');
		return $this->db->get('member'); 
	}
	function get_user($id) {
		//$this->db->where('email',$email);
		$this->db->where('id',$id);
		$this->db->where('active',1);
		$this->db->select('*');
		return $this->db->get('member'); 
	}
	function update_profile($id,$datanya){
		$this->db->where('id',$id);
		return $this->db->update('member',$datanya);
	}
}