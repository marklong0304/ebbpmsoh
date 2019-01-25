<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Master_manufacture extends MX_Controller {
    function __construct() {
        parent::__construct();
		$this->load->library('auth');
    }
    function index($action = '') {
    	$grid = new Grid;
		$grid->setTitle('Manufacture');		
		$grid->setTable('hrd.mnf_manufacturer');		
		$grid->setUrl('master_manufacture');
		$grid->addList('vnmmanufacture','vcontact','ldeleted');
		$grid->setSortBy('vnmmanufacture');
		$grid->setSortOrder('asc');
		$grid->addFields('vmanufacture','vnmmanufacture','valamat','valamat2','vzip');
		$grid->addFields('vkota','inegara_id','vtelp1','vtelp2','vfax','vcontact','vemail1','vemail2','vurl','ldeleted');
		$grid->setLabel('vmanufacture', 'Kode');
		$grid->setLabel('vnmmanufacture', 'Nama');
		$grid->setLabel('valamat', 'Alamat1');
		$grid->setLabel('valamat2', 'Alamat2');
		$grid->setLabel('vzip', 'Kode Pos');
		$grid->setLabel('vkota', 'Kota');
		$grid->setLabel('inegara_id', 'Negara');
		$grid->setLabel('vtelp1', 'Telp1');
		$grid->setLabel('vtelp2', 'Telp2');
		$grid->setLabel('vfax', 'Fax');
		$grid->setLabel('vemail1', 'Email1');
		$grid->setLabel('vemail2', 'Email2');
		$grid->setLabel('vurl', 'Website');
		$grid->setLabel('vcontact', 'Contact Person');
		$grid->setLabel('ldeleted','Aktif');
		$grid->setSearch('vnmmanufacture','vcontact','ldeleted');
		$grid->setRequired('vmanufacture','vnmmanufacture','valamat');
		$grid->setRelation('inegara_id','hrd.mnf_negara','inegara_id','vnmnegara');
		$grid->changeFieldType('ldeleted', 'combobox', '', array(''=>'-', 0=>'Aktif', 1=>'Tidak Aktif'));
		$grid->changeFieldType('valamat2', 'text');
		
		$grid->setGridView('grid');
		
		switch ($action) {
			case 'json':
				$grid->getJsonData();
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
			case 'view':
				$grid->render_form($this->input->get('id'),TRUE);
				break;
			case 'updateproses':
				echo $grid->updated_form();
				break;
			default:
				$grid->render_grid();
				break;
		}
    }

	function output(){
    	$this->index($this->input->get('action'));
    }
}