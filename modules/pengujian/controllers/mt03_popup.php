<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class mt03_popup extends MX_Controller {
    function __construct() {
        parent::__construct();
		$this->load->library('auth');
        $this->db = $this->load->database('hrd',false, true);
        $this->user = $this->auth->user();
        $this->_field = $this->input->get('field');
        $this->_last_id = $this->input->get('last_id');
    }
    function index($action = '') {
    	//Bikin Object Baru Nama nya $grid		
		$grid = new Grid;		
		$grid->setTitle('List Sample');		
		$grid->setTable('bbpmsoh.mt01');		
		$grid->setUrl('mt03_popup');
		$grid->addList('pilih','vNo_transaksi','vNama_produsen','vNama_sample','dTanggal','employee.vName','m_tujuan_pengujian.vNama_tujuan');
		$grid->setSortBy('vNo_transaksi');
		$grid->setSortOrder('DESC');

		$grid->setWidth('vNo_transaksi', '55');
		$grid->setWidth('vNama_produsen', '190');
		$grid->setWidth('vNama_sample', '210');
		$grid->setWidth('dTanggal', '115');
		$grid->setWidth('pilih', '25');
		$grid->setWidth('employee.vName_company', '150');

		$grid->setLabel('vNo_transaksi', 'No. Transaksi');
		$grid->setLabel('vNama_produsen', 'Produsen');
		$grid->setLabel('vNama_sample', 'Sample');
		$grid->setLabel('dTanggal', 'Tgl Request');
		$grid->setLabel('employee.vName_company', 'Produsen');

		$grid->setLabel('employee.vName', 'Pemohon');

		

		$grid->setLabel('m_tujuan_pengujian.vNama_tujuan', 'Tujuan Pengujian');

		$grid->setSearch('vNo_transaksi','vNama_produsen','vNama_sample');
		$grid->setAlign('vNo_transaksi', 'center');
		$grid->setAlign('pilih', 'center');
		$grid->setInputGet('field',$this->_field);
		$grid->setInputGet('last_id',$this->_last_id);
		$grid->hideTitleCol('pilih');
		$grid->notSortCol('pilih');
		$grid->setJoinTable('hrd.company', 'company.iCompanyId = mt01.iCustomer', 'left');
		$grid->setJoinTable('hrd.employee', 'employee.cNip = mt01.iCustomer', 'inner');
		$grid->setJoinTable('bbpmsoh.mt02', 'mt02.iMt01 = bbpmsoh.mt01.iMt01', 'inner');
		$grid->setJoinTable("bbpmsoh.m_tujuan_pengujian","m_tujuan_pengujian.iM_tujuan_pengujian=mt01.iM_tujuan_pengujian");

		/*basic required start*/
			$grid->setQuery('bbpmsoh.mt01.lDeleted', 0);
			$grid->setQuery('bbpmsoh.mt02.iApprove', 2);
			$and=$this->_last_id!=0?' AND iMt01 != '.$this->_last_id:'';
			$grid->setQuery('mt01.iMt01 NOT IN (select iMt01 from bbpmsoh.mt03 where lDeleted=0 '.$and.' )', NULL);

		
		switch ($action) {
			case 'json':
				$grid->getJsonData();
				break;			
			default:
				$grid->render_grid();
				break;
		}
    }

	function output(){
    	$this->index($this->input->get('action'));
    }

    function listBox_mt03_popup_employee_vCompName($value, $pk, $name, $rowData){
    	$value=str_replace('. ','',$value);
    	return $value;

    }

	function listBox_mt03_popup_pilih($value, $pk, $name, $rowData) {
		$vCompName=str_replace('. ','',$rowData->employee__vName);

		$vBatch_lot = $rowData->vBatch_lot;
		$dTgl_kadaluarsa = $rowData->dTgl_kadaluarsa;
		

		
		$o = '<input type="radio" name="pilih" onClick="javascript:pilih_upb_fst('.$pk.',\''.$rowData->vNo_transaksi.'\',\''.$vCompName.'\',\''.$rowData->vNama_sample.'\',\''.$rowData->vNama_produsen.'\',\''.$rowData->vBatch_lot.'\',\''.$rowData->dTgl_kadaluarsa.'\',\''.$rowData->m_tujuan_pengujian__vNama_tujuan.'\') ;" /><script type="text/javascript">
				function pilih_upb_fst (id, vNo_transaksi, vCompName, vNama_sample, vNama_produsen, vBatch_lot, dTgl_kadaluarsa, vNama_tujuan){			
					custom_confirm("Yakin ?", function(){
						$("#'.$this->input->get('field').'_iMt01").val(id);
						$("#'.$this->input->get('field').'_iMt01_dis").val(vNo_transaksi);
						$("#'.$this->input->get('field').'_vCompName").val(vCompName);
						$("#'.$this->input->get('field').'_vNama_sample").val(vNama_sample);
						$("#'.$this->input->get('field').'_vNama_produsen").val(vNama_produsen);
						$("#'.$this->input->get('field').'_iAda_batch_dis").val(vBatch_lot);
						$("#'.$this->input->get('field').'_iTgl_expired_dis").val(dTgl_kadaluarsa);
						$("#'.$this->input->get('field').'_vNama_tujuan").val(vNama_tujuan);

						$("#'.$this->input->get('field').'_vBatch").val(vBatch_lot);
						$("#'.$this->input->get('field').'_dTgl_expired").val(dTgl_kadaluarsa);
						

						$("#alert_dialog_form").dialog("close");
					});
				}
		</script>';
		return $o;
	}
}
