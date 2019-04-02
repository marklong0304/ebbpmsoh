<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class mt8b extends MX_Controller {
    function __construct() {
        parent::__construct();
		 $this->load->library('auth');
        $this->db = $this->load->database('hrd',false, true);
        $this->user = $this->auth->user();

		$this->title = 'MT 8B';
		$this->url = 'mt8b';
		$this->urlpath = 'pengujian/'.str_replace("_","/", $this->url);
		$this->group = $this->auth->checkgroup($this->user->gNIP);
		$this->maintable = 'bbpmsoh.mt08b';	
		$this->main_table = $this->maintable;	
		$this->main_table_pk = 'iMt8b';	
		$datagrid['islist'] = array(
			'mt01.vNomor' => array('label'=>'Nomor','width'=>100,'align'=>'center','search'=>true)
			,'vNama_sample' => array('label'=>'Nama Sample','width'=>250,'align'=>'left','search'=>true)
			,'iSubmit' => array('label'=>'Submit','width'=>150,'align'=>'left','search'=>true)
			,'iApprove_unit_uji' => array('label'=>'Approval','width'=>150,'align'=>'left','search'=>true)
			,'iKesimpulan' => array('label'=>'Kesimpulan Uji Khusus','width'=>200,'align'=>'center','search'=>true)
			
		);

		$datagrid['jointableinner']=array(
            0=>array('bbpmsoh.mt01'=>'mt01.iMt01=bbpmsoh.mt08b.iMt01')
            );


		$datagrid['addFields']=array(
				'iMt01'=>'Nomor '
				,'uji_fisik' => 'Pengujian'
				,'iKesimpulan'  => 'Kesimpulan Uji Khusus'
				);
		$datagrid['shortBy']=array('mt08b.dUpdated'=>'DESC');
	
		$datagrid['setQuery']=array(
								0=>array('vall'=>'mt08b.lDeleted','nilai'=>0)
								);
		$datagrid['isRequired']=array('all_form');
		
		$this->datagrid=$datagrid;
    }

    function index($action = '') {
    	$grid = new Grid;		
		$grid->setTitle($this->title);		
		$grid->setTable($this->maintable );
		$grid->setUrl($this->url);

		/*Untuk Field*/
		foreach ($this->datagrid as $kv => $vv) {
			/*Untuk List*/
			if($kv=='islist'){
				foreach ($vv as $list => $vlist) {
					$grid->addList($list);
					foreach ($vlist as $kdis => $vdis) {
						if($kdis=='label'){
							$grid->setLabel($list, $vdis);
						}
						if($kdis=='width'){
							$grid->setWidth($list, $vdis);
						}
						if($kdis=='align'){
							$grid->setAlign($list, $vdis);
						}
						if($kdis=='search' && $vdis==true){
							$grid->setSearch($list);
						}
					}
				}
			}

			/*Untuk Short List*/
			if($kv=='shortBy'){
				foreach ($vv as $list => $vlist) {
					$grid->setSortBy($list);
					$grid->setSortOrder($vlist);
				}
			}

			if($kv=='addFields'){
				foreach ($vv as $list => $vlist) {
					$grid->addFields($list);
					$grid->setLabel($list, $vlist);
				}
			}

			if($kv=='inputGet'){
				foreach ($vv as $list => $vlist) {
					$grid->setInputGet($list,$vlist);
				}
			}

			if($kv=='jointableinner'){
				foreach ($vv as $list => $vlist) {
					foreach ($vlist as $tbjoin => $onjoin) {
						$grid->setJoinTable($tbjoin, $onjoin, 'inner');
					}
				}
			}
			if($kv=='setQuery'){
				foreach ($vv as $list => $vlist) {
					$grid->setQuery($vlist['vall'], $vlist['nilai']);
				}
			}
			if($kv=='isRequired'){
                foreach ($vv as $list => $vlist) {
                    if($vlist=="all_form"){
                        foreach ($this->datagrid['addFields'] as $kfield => $vfield) {
                            $grid->setRequired($kfield);
                        }
                    }
                }
            }

		}

		$grid->setJoinTable('bbpmsoh.mt01', 'mt08b.iMt01 = mt01.iMt01', 'inner');
		$grid->setJoinTable('bbpmsoh.m_jenis_sediaan', 'm_jenis_sediaan.iM_jenis_sediaan = mt01.iM_jenis_sediaan', 'inner');

		$grid->changeFieldType('iKesimpulan','combobox','',array(''=>'Belum ditentukan',1=>'Tidak memenuhi syarat', 2=>'Memenuhi syarat'));
		$grid->changeFieldType('iSubmit', 'combobox','',array(''=>'--select--', 0=>'Draft', 1=>'Submit'));
		$grid->changeFieldType('iApprove_unit_uji', 'combobox','',array(''=>'--select--', 0=>'Waiting Approval', 1=>'Rejected', 2=>'Approved'));


		/*
            idprivi_group;vNamaGroup
            11 ; QA
            10;Keuangan
            9;Tu
            8;Kepala balai
            7;Customer
            4;Admin Virologi
            5;Admin Farmastetik & Premiks
            3;Admin Biologik
            6;Admin SPHU
            2;Admini Yanji
            1;Administrator


        */ 
        $groupnya = $this->checkgroup($this->user->gNIP);             
        if( $groupnya['idprivi_group']== 11){
            $grid->setQuery('mt08b.iSubmit',1);     
        }



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
			case 'delete':
				echo $grid->delete_row();
				break;

			/*Option Case*/
			case 'getDetailsReq':
				echo $this->getDetailsReq();
				break;
			case 'get_data_prev':
				echo $this->get_data_prev();
				break;
			case 'getDetailsData':
				$post=$this->input->post();
				$arr=array(
					'mt01.iMt01'=>$post['iMt01']	
				);
				$this->db->select("mt01.*,m_jenis_sediaan.vJenis_sediaan")
						->from("bbpmsoh.mt01")
						->join('bbpmsoh.m_jenis_sediaan','m_jenis_sediaan.iM_jenis_sediaan=mt01.iM_jenis_sediaan')
						->where($arr);
				$row=$this->db->get()->row_array();
				echo json_encode($row);
				break;

			/*Confirm*/
			case 'confirm':
                echo $this->confirm_view();
                break;
            case 'confirm_process':
                echo $this->confirm_process();
                break;
            case 'approve':
                echo $this->approve_view();
                break;
            case 'approve_process':
                echo $this->approve_process();
                break;
            case 'reject':
                echo $this->reject_view();
                break;
            case 'reject_process':
                echo $this->reject_process;
                break;
			case 'uploadFile':
				$lastId=$this->input->get('lastId');
				$dataFieldUpload=$this->lib_plc->getUploadFileFromField($this->input->get('modul_id'));
				if(count($dataFieldUpload)>0){
					foreach ($dataFieldUpload as $kf => $vUpload) {
						$pathf=$vUpload['filepath'];
						$path = realpath($pathf);
						if(!file_exists($path."/".$lastId)){
							if (!mkdir($path."/".$lastId, 0777, true)) { //id review
								die('Failed upload, try again!');
							}
						}

						$fKeterangan = array();
						foreach($_POST as $key=>$value) {						
							if ($key == 'plc2_'.$this->url.'_'.$vUpload['vNama_field']."_".$vUpload['filename'].'_fileketerangan') {
								foreach($value as $k=>$v) {
									$fKeterangan[$k] = $v;
								}
							}
						}
						$i=0;
						foreach ($_FILES['plc2_'.$this->url.'_'.$vUpload['vNama_field']."_".$vUpload['filename'].'_upload_file']["error"] as $key => $error) {
							if ($error == UPLOAD_ERR_OK) {
								$tmp_name = $_FILES['plc2_'.$this->url.'_'.$vUpload['vNama_field']."_".$vUpload['filename'].'_upload_file']["tmp_name"][$key];
								$name =$_FILES['plc2_'.$this->url.'_'.$vUpload['vNama_field']."_".$vUpload['filename'].'_upload_file']["name"][$key];
								$data['filename'] = $name;
								$data['dInsertDate'] = date('Y-m-d H:i:s');
								$filenameori=$name;
								$now_u = date('Y_m_d__H_i_s');
                                $name_generate = $i.'__'.$now_u.'__'.$name;
									if(move_uploaded_file($tmp_name, $path."/".$lastId."/".$name_generate)) {
										$datainsert=array();
										$datainsert[$vUpload['fieldheader']]=$lastId;
										$datainsert[$vUpload['fdcreate']]= date('Y-m-d H:i:s');
										$datainsert[$vUpload['fccreate']]= $this->user->gNIP;
										$datainsert[$vUpload['ffilename']]= $name;
										$datainsert['vFilename_generate']= $name_generate;
										$datainsert[$vUpload['fvketerangan']]= $fKeterangan[$i];
										$this->db_plc0->insert($vUpload['filetable'],$datainsert);
										$i++;	
									}
									else{
										echo "Upload ke folder gagal";	
									}
							}
						}
					}
					$r['message']="Data Berhasil Disimpan";
					$r['status'] = TRUE;
					$r['last_id'] = $this->input->get('lastId');					
					echo json_encode($r);

				}else{
					$r['message']="Data Upload Not Found";
					$r['status'] = TRUE;
					$r['last_id'] = $this->input->get('lastId');					
					echo json_encode($r);
				}
				break;
			default:
				$grid->render_grid();
				break;
		}
    }

    function checkgroup($nip){
        $sql = "select *,a.idprivi_group,a.vNamaGroup 
                from erp_privi.privi_group_pt_app a 
                join erp_privi.privi_apps b on b.idprivi_apps=a.idprivi_apps
                join erp_privi.privi_authlist c on c.idprivi_apps=b.idprivi_apps and c.idprivi_group=a.iID_GroupApp
                where 
                b.idprivi_apps=130
                and 
                c.cNIP='".$nip."' ";
        $ret = $this->db->query($sql)->row_array();
        return $ret;
    }
    function updateBox_mt8b_uji_fisik($name, $id, $value, $rowData) {
		$this->db->where('iMt8b', $rowData['iMt8b']);
		$this->db->where('lDeleted', 0);
		$data['rows'] = $this->db->get('bbpmsoh.mt08b_fisik')->result_array();
		$data['browse_url'] = base_url().'processor/plc/browse/bb';
		return $this->load->view('partial/8b_fisik', $data, TRUE);
	}
	function insertBox_mt8b_uji_fisik($name, $id) {
		$data['rows'] = array();
		$data['browse_url'] = base_url().'processor/plc/browse/bb';
		return $this->load->view('partial/8b_fisik', $data, TRUE);
	}



    function listBox_Action($row, $actions) {
        if ($row->iApprove_unit_uji>0) { 
                unset($actions['edit']);
        }
        if ($row->iSubmit>0) { 
                unset($actions['delete']);
        }
        return $actions;
    }

	function output(){
    	$this->index($this->input->get('action'));
    }

    function manipulate_update_button($buttons, $rowData) {
         $cNip= $this->user->gNIP;
        $js = $this->load->view('js/mt8b_js');
        $js .= $this->load->view('js/upload_js');

        $iframe = '<iframe name="'.$this->url.'_frame" id="'.$this->url.'_frame" height="0" width="0"></iframe>';
        
       
        $update_draft = '<button onclick="javascript:update_draft_btn(\''.$this->url.'\', \' '.base_url().'processor/'.$this->urlpath.'?draft=true&company_id='.$this->input->get('company_id').'&group_id='.$this->input->get('group_id').'&modul_id='.$this->input->get('modul_id').'\',this,true )"  id="button_update_draft_'.$this->url.'"  class="ui-button-text icon-save" >Update as Draft</button>';
        $update = '<button onclick="javascript:update_btn_back(\''.$this->url.'\', \' '.base_url().'processor/'.$this->urlpath.'?company_id='.$this->input->get('company_id').'&group_id='.$this->input->get('group_id').'&modul_id='.$this->input->get('modul_id').' \',this,true )"  id="button_update_submit_'.$this->url.'"  class="ui-button-text icon-save" >Update &amp; Submit</button>';
        $approve = '<button onclick="javascript:load_popup(\' '.base_url().'processor/'.$this->urlpath.'?action=approve&last_id='.$this->input->get('id').'&company_id='.$this->input->get('company_id').'&group_id='.$this->input->get('group_id').'&modul_id='.$this->input->get('modul_id').' \')"  id="button_approve_'.$this->url.'"  class="ui-button-text icon-save" >Approve</button>';
        $reject = '<button onclick="javascript:load_popup(\' '.base_url().'processor/'.$this->urlpath.'?action=reject&approve&last_id='.$this->input->get('id').'&company_id='.$this->input->get('company_id').'&group_id='.$this->input->get('group_id').'&modul_id='.$this->input->get('modul_id').' \' )"  id="button_reject_'.$this->url.'"  class="ui-button-text icon-save" >Reject</button>';
        
        if ($this->input->get('action') == 'view') {
            unset($buttons['update']);
        }
        else{ 
            if($rowData['iApprove_unit_uji']==0 && $rowData['iSubmit']==0){
                $buttons['update'] = $iframe.$update_draft.$update.$js;    
            }elseif($rowData['iApprove_unit_uji']==0 && $rowData['iSubmit']==1){
                $buttons['update'] = $iframe.$approve.$reject;
            }
        }
        
        return $buttons;
    }

	function manipulate_insert_button($buttons){        
        $cNip= $this->user->gNIP;
        $js = $this->load->view('js/mt8b_js');
        $js .= $this->load->view('js/upload_js');

        $iframe = '<iframe name="'.$this->url.'_frame" id="'.$this->url.'_frame" height="0" width="0"></iframe>';
        
       $save_draft = '<button onclick="javascript:save_draft_btn_multiupload(\''.$this->url.'\', \' '.base_url().'processor/'.$this->urlpath.'?draft=true&company_id='.$this->input->get('company_id').'&group_id='.$this->input->get('group_id').'&modul_id='.$this->input->get('modul_id').'\',this,true )"  id="button_save_draft_'.$this->url.'"  class="ui-button-text icon-save" >Save as Draft</button>';
        $save = '<button onclick="javascript:save_btn_multiupload(\''.$this->url.'\', \' '.base_url().'processor/'.$this->urlpath.'?company_id='.$this->input->get('company_id').'&group_id='.$this->input->get('group_id').'&modul_id='.$this->input->get('modul_id').' \',this,true )"  id="button_save_submit_'.$this->url.'"  class="ui-button-text icon-save" >Save &amp; Submit</button>';

        $buttons['save'] = $iframe.$save_draft.$save.$js;
        
        return $buttons;
	}

	/*List Box*/
	function listBox_mt8b_iappqa_uji($value) {
		if($value==0){$vstatus='Waiting for approval';}
		elseif($value==1){$vstatus='Rejected';}
		elseif($value==2){$vstatus='Approved';}
		return $vstatus;
	}

	function listBox_mt8b_ini_nilai($value, $pk, $name, $rowData) {
		$this->db_plc0->select("formula.vNo_formula");
		$this->db_plc0->from("pddetail.formula");
		$this->db_plc0->join("pddetail.formula_process","formula_process.iFormula_process=formula.iFormula_process");
		$this->db_plc0->join("plc2.plc2_upb_formula","plc2_upb_formula.iupb_id=formula_process.iupb_id");
		$this->db_plc0->where("plc2_upb_formula.ifor_id",$rowData->ifor_id);
		$this->db_plc0->order_by("formula.iFormula","DESC");
		$ggg=$this->db_plc0->get();
		$return="-";
		if($ggg->num_rows()>0){
			$row=$ggg->row_array();
			$return=$row['vNo_formula'];
		}
		return $return;
	}

	/*Manipulate Insert/Update Form*/
	function insertBox_mt8b_iMt01($field, $id) {
		$arr=array(
			'mt01.lDeleted'=>0
			,'mt06.lDeleted'=>0	
			,'mt06.iApprove_sphu'=>2	
			,'mt06.iDist_virologi'=>1	
		);
		$this->db->select("mt01.*")
				->from("bbpmsoh.mt01")
				->join("bbpmsoh.mt06","mt06.iMt01=bbpmsoh.mt01.iMt01")
				->where('bbpmsoh.mt01.iMt01 NOT IN (select iMt01 from bbpmsoh.mt08b where lDeleted=0 AND iApprove_unit_uji in (0,2) )')
				->where($arr);

		$return="<select name='".$id."' id='".$id."' class='required'>";
		$return.="<option value=''>---Pilih---</option>";
		$qq=$this->db->get();
		if($qq->num_rows()>0){
			foreach ($qq->result_array() as $key => $value) {
				$return.="<option value='".$value['iMt01']."'>".$value['vNo_transaksi']." | ".$value['vNama_sample']."</option>";
			}
		}
		$return.="</select>";
		$return.="<div id='info_mt01'>";
				$return .= " <table cellspacing='0' cellpadding='3' style='width: 50%; border: 1px solid #dddddd; background: #DBC0D2 none repeat; border-collapse: collapse'>
					 	<tr>
					 		<td style='width: 30%;'>No Batch / Lot</td>
					 		<td >: <span id='det_vBatch_lot'></span></td>
					 	</tr>
					 	<tr>
					 		<td style='width: 30%;'>Waktu Kadaluarsa</td>
					 		<td >: <span id='det_dTgl_kadaluarsa'></span>  </td>
					 	</tr>
					 	<tr>
					 		<td style='width: 30%;'>No Reg Deptan</td>
					 		<td >: <span id='det_vNo_registrasi'></span> </td>
					 	</tr>
					 </table>";
		$return.="</div>";

		$return.="<script>";
		$return.="$('#".$id."').change(function(){
			$.ajax({
                url:base_url+'processor/pengujian/mt8b?action=getDetailsData',
                type: 'post',
                data: {iMt01:$(this).val()},
                success: function(data) {
                    //alert(isUpload);
                    var o = $.parseJSON(data);
                    $('#det_vNama_sample').text(o.vNama_sample);
                    $('#det_vBatch_lot').text(o.vBatch_lot);
                    $('#det_dTgl_kadaluarsa').text(o.dTgl_kadaluarsa);
                    $('#det_vNo_registrasi').text(o.vNo_registrasi);
                    $('#mt8b_vJenis_sediaan').text(o.vJenis_sediaan);
                    $('#mt8b_vKemasan').text(o.vKemasan);
                    $('#mt8b_vJenis_sediaan').text(o.vJenis_sediaan);
                }
			});
		});";
		$return.="</script>";
		$return .= '<input type="hidden" name="isdraft" id="isdraft" class="input_rows1 " size="30"  />';
        return $return;
    }

    function updateBox_mt8b_iMt01($field,$id,$value,$rowData){
    	$viewval = $value;
        $arr=array(
			'mt01.lDeleted'=>0
			,'mt06.lDeleted'=>0	
			,'mt06.iApprove_sphu'=>2	
			,'mt06.iDist_virologi'=>1	
		);

        $this->db->select('*')
            ->from('bbpmsoh.mt01')
            ->join("bbpmsoh.mt06","mt06.iMt01=bbpmsoh.mt01.iMt01")
            ->where($arr)
            ->where('bbpmsoh.mt01.iMt01 NOT IN (select iMt01 from bbpmsoh.mt08b where lDeleted=0 AND iMt01 !='.$value.' )');
        $row=$this->db->get()->result_array();

        $sqlinfo = 'select * from bbpmsoh.mt01 a where a.iMt01= "'.$value.'" ';
        $dMt01 = $this->db->query($sqlinfo)->row_array();
        $return='<select id="'.$id.'" name="'.$field.'" class="required">';
        $return.='<option value="">---Pilih---</option>';
        foreach ($row as $kk => $vv) {
            $select=$value==$vv['iMt01']?'selected':'';
            if($value==$vv['iMt01']){
                $value=$vv['vNomor'];
            }
            $return.='<option value="'.$vv['iMt01'].'" '.$select.' >'.$vv['vNomor'].'</option>';
        }
        $return.='</select>';
        $return.="<div id='info_mt01'>";
				$return .= " <table cellspacing='0' cellpadding='3' style='width: 50%; border: 1px solid #dddddd; background: #DBC0D2 none repeat; border-collapse: collapse'>
					 	<tr>
					 		<td style='width: 30%;'>No Batch / Lot</td>
					 		<td >: <span id='det_vBatch_lot'>".$dMt01['vBatch_lot']."</span></td>
					 	</tr>
					 	<tr>
					 		<td style='width: 30%;'>Waktu Kadaluarsa</td>
					 		<td >: <span id='det_dTgl_kadaluarsa'>".$dMt01['dTgl_kadaluarsa']."</span>  </td>
					 	</tr>
					 	<tr>
					 		<td style='width: 30%;'>No Reg Deptan</td>
					 		<td >: <span id='det_vNo_registrasi'>".$dMt01['vNo_registrasi']."</span> </td>
					 	</tr>
					 </table>";
		$return.="</div>";

		$return.="<script>";
		$return.="$('#".$id."').change(function(){
			$.ajax({
                url:base_url+'processor/pengujian/mt8b?action=getDetailsData',
                type: 'post',
                data: {iMt01:$(this).val()},
                success: function(data) {
                    //alert(isUpload);
                    var o = $.parseJSON(data);
                    $('#det_vNama_sample').text(o.vNama_sample);
                    $('#det_vBatch_lot').text(o.vBatch_lot);
                    $('#det_dTgl_kadaluarsa').text(o.dTgl_kadaluarsa);
                    $('#det_vNo_registrasi').text(o.vNo_registrasi);
                    $('#mt8b_vJenis_sediaan').text(o.vJenis_sediaan);
                    $('#mt8b_vKemasan').text(o.vKemasan);
                    $('#mt8b_vJenis_sediaan').text(o.vJenis_sediaan);
                }
			});
		});";
		$return.="</script>";
        $return .= '<input type="hidden" name="isdraft" id="isdraft" class="input_rows1 " size="30"  />';
        if($this->input->get('action')=='view'){
            $return=$value;
            $sqlinfo = 'select * from bbpmsoh.mt01 a where a.iMt01= "'.$viewval.'" ';
        	$dMt01 = $this->db->query($sqlinfo)->row_array();
            $return.="<div id='info_mt01'>";
				$return .= " <table cellspacing='0' cellpadding='3' style='width: 50%; border: 1px solid #dddddd; background: #DBC0D2 none repeat; border-collapse: collapse'>
					 	<tr>
					 		<td style='width: 30%;'>Nama Sample</td>
					 		<td >: <span id='det_vNama_sample'>".$dMt01['vNama_sample']."</span> </td>
					 	</tr>
					 	<tr>
					 		<td style='width: 30%;'>No Batch / Lot</td>
					 		<td >: <span id='det_vBatch_lot'>".$dMt01['vBatch_lot']."</span></td>
					 	</tr>
					 	<tr>
					 		<td style='width: 30%;'>Waktu Kadaluarsa</td>
					 		<td >: <span id='det_dTgl_kadaluarsa'>".$dMt01['dTgl_kadaluarsa']."</span>  </td>
					 	</tr>
					 	<tr>
					 		<td style='width: 30%;'>No Reg Deptan</td>
					 		<td >: <span id='det_vNo_registrasi'>".$dMt01['vNo_registrasi']."</span> </td>
					 	</tr>
					 </table>";
		$return.="</div>";


        }
        // $return=$this->db->last_query();
        return $return;
    }

   /* ,'vBatch_lot'=>'No Batch/Lot'
				,'dTgl_kadaluarsa'=>'Waktu Kadaluarsa'
				,'vNo_registrasi'=>'No Reg Deptan'
				,'vKemasan'=>'Kemasan/dosis'
				,'vJenis_sediaan'=>'Sifat/Jenis Obat'
				,'dTanggal_terima_sample'=>'Tanggal Terima Sample'
				,'vAcuanProsedur'=>'Acuan Prosedur Pengambilan Obat'
				,'vPenyimpangan'=>'Penyimpangan, Perubahan atau Pengecualian'
				,'vNo_transaksi'=>'Nomor Pengujian'*/

	function insertBox_mt8b_vBatch_lot($field, $id) {
		$return="<input type='text' name='".$id."' id='".$id."' value='' size='35' readonly='readonly' />";
		return $return;
    }
	function insertBox_mt8b_dTgl_kadaluarsa($field, $id) {
		$return="<input type='text' name='".$id."' id='".$id."' value='' size='35' readonly='readonly' />";
		return $return;
    }
	function insertBox_mt8b_vNo_registrasi($field, $id) {
		$return="<input type='text' name='".$id."' id='".$id."' value='' size='35' readonly='readonly' />";
		return $return;
    }
	function insertBox_mt8b_vKemasan($field, $id) {
		$return="<input type='text' name='".$id."' id='".$id."' value='' size='35' readonly='readonly' />";
		return $return;
    }
	function insertBox_mt8b_vJenis_sediaan($field, $id) {
		$return="<input type='text' name='".$id."' id='".$id."' value='' size='35' readonly='readonly' />";
		return $return;
    }
     function insertBox_mt8b_dTanggal_terima_sample($field, $id) {
    	$ff=str_replace("form_","", $field);
        $return = '<input name="'.$ff.'" id="'.$id.'" type="text" size="20" class="input_tgl datepicker required" style="width:130px"/>';
        $return .=  '<script>
                            $("#'.$id.'").datepicker({dateFormat:"yy-mm-dd"});
                        
                    </script>';
        return $return;
    }
    function insertBox_mt8b_vAcuanProsedur($field, $id) {
		$return="<input type='text' name='".$id."' id='".$id."' value='SK Mentan No. 69S/Kpts/TN.260/8/9/96.' size='35' />";
		return $return;
    }
    function insertBox_mt8b_vPenyimpangan($field, $id) {
		$return="<input type='text' name='".$id."' id='".$id."' value='' size='35' />";
		return $return;
    }
    function insertBox_mt8b_vNo_transaksi($field, $id) {
		$return="<input type='text' name='".$id."' id='".$id."' value='' size='35' readonly='readonly' />";
		return $return;
    }
	
    /*Function Tambahan*/

    function before_insert_processor($row, $postData) {
    	$postData['dCreated']=date("Y-m-d H:i:s");
    	$postData['cCreated']=$this->user->gNIP;
        if($postData['isdraft']==true){
            $postData['iSubmit']=0;
            
        } 
        else{
            $postData['iSubmit']=1;
        }

        if($postData['mt8b_iKesimpulan']==""){
        	$postData['iKesimpulan']=NULL;
        }
        

        return $postData;

    }
    function before_update_processor($row, $postData) {
    	$postData['dUpdated']=date("Y-m-d H:i:s");
    	$postData['cUpdated']=$this->user->gNIP;

        if($postData['isdraft']==true){
            $postData['iSubmit']=0;
            $postData['iKesimpulan']=NULL;
            
        } 
        else{
            $postData['iSubmit']=1;
        }

        return $postData;
    }

    /*After Insert*/
    function after_insert_processor($fields, $id, $postData) {
    	$post = $this->input->post();
    	$idet['iMt8b'] = $id;

		$idet['vKandungan'] = $post['vKandungan'];
$idet['vKandungan_metoda'] = $post['vKandungan_metoda'];
$idet['vKandungan_mutu'] = $post['vKandungan_mutu'];
$idet['dKandungan_tanggal'] = $post['dKandungan_tanggal'];
$idet['vIdentitas'] = $post['vIdentitas'];
$idet['vIdentitas_metoda'] = $post['vIdentitas_metoda'];
$idet['vIdentitas_mutu'] = $post['vIdentitas_mutu'];
$idet['dIdentitas_tanggal'] = $post['dIdentitas_tanggal'];
$idet['vVirus'] = $post['vVirus'];
$idet['vVirus_metoda'] = $post['vVirus_metoda'];
$idet['vVirus_mutu'] = $post['vVirus_mutu'];
$idet['dVirus_tanggal'] = $post['dVirus_tanggal'];
$idet['vInaktivasi_jenis'] = $post['vInaktivasi_jenis'];
$idet['vInaktivasi_perlakuan'] = $post['vInaktivasi_perlakuan'];
$idet['vInaktivasi_persen'] = $post['vInaktivasi_persen'];
$idet['vInaktivasi_kontrol'] = $post['vInaktivasi_kontrol'];
//$idet['vInaktivasi_lain'] = $post['vInaktivasi_lain'];
$idet['vInaktivasi_metoda'] = $post['vInaktivasi_metoda'];
$idet['vInaktivasi_mutu'] = $post['vInaktivasi_mutu'];
$idet['dInaktivasi_tanggal'] = $post['dInaktivasi_tanggal'];
$idet['vPotensi'] = $post['vPotensi'];
$idet['vPotensi_jenis'] = $post['vPotensi_jenis'];
$idet['vPotensi_umur'] = $post['vPotensi_umur'];
$idet['vPotensi_bb'] = $post['vPotensi_bb'];
$idet['vPotensi_perlakuan'] = $post['vPotensi_perlakuan'];
$idet['vPotensi_kontrol'] = $post['vPotensi_kontrol'];
$idet['vPotensi_persen'] = $post['vPotensi_persen'];
$idet['vPotensi_mdl'] = $post['vPotensi_mdl'];
$idet['vPotensi_cdl'] = $post['vPotensi_cdl'];
$idet['vPotensi_metoda'] = $post['vPotensi_metoda'];
$idet['vPotensi_mutu'] = $post['vPotensi_mutu'];
$idet['dPotensi_tanggal'] = $post['dPotensi_tanggal'];
$idet['vPatologi'] = $post['vPatologi'];
$idet['vPatologi_jenis'] = $post['vPatologi_jenis'];
$idet['vPatologi_umur'] = $post['vPatologi_umur'];
$idet['vPatologi_bb'] = $post['vPatologi_bb'];
$idet['vPatologi_perlakuan'] = $post['vPatologi_perlakuan'];
$idet['vPatologi_kontrol'] = $post['vPatologi_kontrol'];
$idet['vPatologi_persen'] = $post['vPatologi_persen'];
$idet['vPatologi_mdl'] = $post['vPatologi_mdl'];
$idet['vPatologi_cdl'] = $post['vPatologi_cdl'];
$idet['vPatologi_metoda'] = $post['vPatologi_metoda'];
$idet['vPatologi_mutu'] = $post['vPatologi_mutu'];
$idet['dPatologi_tanggal'] = $post['dPatologi_tanggal'];
$idet['vLain'] = $post['vLain'];
$idet['vLain_metoda'] = $post['vLain_metoda'];
$idet['vLain_mutu'] = $post['vLain_mutu'];
$idet['dLain_tanggal'] = $post['dLain_tanggal'];





		
		$this->db->insert('bbpmsoh.mt08b_fisik', $idet);
		



    }

    /*After Update*/
    function after_update_processor($fields, $id, $postData) {
    	$post=$this->input->post();
	    
	    $idet['vKandungan'] = $post['vKandungan'];
		$idet['vKandungan_metoda'] = $post['vKandungan_metoda'];
		$idet['vKandungan_mutu'] = $post['vKandungan_mutu'];
		$idet['dKandungan_tanggal'] = $post['dKandungan_tanggal'];
		$idet['vIdentitas'] = $post['vIdentitas'];
		$idet['vIdentitas_metoda'] = $post['vIdentitas_metoda'];
		$idet['vIdentitas_mutu'] = $post['vIdentitas_mutu'];
		$idet['dIdentitas_tanggal'] = $post['dIdentitas_tanggal'];
		$idet['vVirus'] = $post['vVirus'];
		$idet['vVirus_metoda'] = $post['vVirus_metoda'];
		$idet['vVirus_mutu'] = $post['vVirus_mutu'];
		$idet['dVirus_tanggal'] = $post['dVirus_tanggal'];
		$idet['vInaktivasi_jenis'] = $post['vInaktivasi_jenis'];
		$idet['vInaktivasi_perlakuan'] = $post['vInaktivasi_perlakuan'];
		$idet['vInaktivasi_persen'] = $post['vInaktivasi_persen'];
		$idet['vInaktivasi_kontrol'] = $post['vInaktivasi_kontrol'];
		//$idet['vInaktivasi_lain'] = $post['vInaktivasi_lain'];
		$idet['vInaktivasi_metoda'] = $post['vInaktivasi_metoda'];
		$idet['vInaktivasi_mutu'] = $post['vInaktivasi_mutu'];
		$idet['dInaktivasi_tanggal'] = $post['dInaktivasi_tanggal'];
		$idet['vPotensi'] = $post['vPotensi'];
		$idet['vPotensi_jenis'] = $post['vPotensi_jenis'];
		$idet['vPotensi_umur'] = $post['vPotensi_umur'];
		$idet['vPotensi_bb'] = $post['vPotensi_bb'];
		$idet['vPotensi_perlakuan'] = $post['vPotensi_perlakuan'];
		$idet['vPotensi_kontrol'] = $post['vPotensi_kontrol'];
		$idet['vPotensi_persen'] = $post['vPotensi_persen'];
		$idet['vPotensi_mdl'] = $post['vPotensi_mdl'];
		$idet['vPotensi_cdl'] = $post['vPotensi_cdl'];
		$idet['vPotensi_metoda'] = $post['vPotensi_metoda'];
		$idet['vPotensi_mutu'] = $post['vPotensi_mutu'];
		$idet['dPotensi_tanggal'] = $post['dPotensi_tanggal'];
		$idet['vPatologi'] = $post['vPatologi'];
		$idet['vPatologi_jenis'] = $post['vPatologi_jenis'];
		$idet['vPatologi_umur'] = $post['vPatologi_umur'];
		$idet['vPatologi_bb'] = $post['vPatologi_bb'];
		$idet['vPatologi_perlakuan'] = $post['vPatologi_perlakuan'];
		$idet['vPatologi_kontrol'] = $post['vPatologi_kontrol'];
		$idet['vPatologi_persen'] = $post['vPatologi_persen'];
		$idet['vPatologi_mdl'] = $post['vPatologi_mdl'];
		$idet['vPatologi_cdl'] = $post['vPatologi_cdl'];
		$idet['vPatologi_metoda'] = $post['vPatologi_metoda'];
		$idet['vPatologi_mutu'] = $post['vPatologi_mutu'];
		$idet['dPatologi_tanggal'] = $post['dPatologi_tanggal'];
		$idet['vLain'] = $post['vLain'];
		$idet['vLain_metoda'] = $post['vLain_metoda'];
		$idet['vLain_mutu'] = $post['vLain_mutu'];
		$idet['dLain_tanggal'] = $post['dLain_tanggal'];


    	$this->db->where('iMt8b', $id);
		$this->db->update('bbpmsoh.mt08b_fisik', $idet);

	}

    	


    /*Confirm View*/

    function confirm_view() { 
                $echo = '<script type="text/javascript">
                             function submit_ajax(form_id) {
                                return $.ajax({
                                    url: $("#"+form_id).attr("action"),
                                    type: $("#"+form_id).attr("method"),
                                    data: $("#"+form_id).serialize(),
                                    success: function(data) {
                                        var o = $.parseJSON(data);
                                        var last_id = o.last_id;
                                        var group_id = o.group_id;
                                        var modul_id = o.modul_id;
                                        var url = "'.base_url().'processor/'.$this->urlpath.'";                             
                                        if(o.status == true) { 
                                            $("#alert_dialog_form").dialog("close");
                                                 $.get(url+"?action=update&id="+last_id+"&foreign_key=0&company_id=3&group_id="+group_id+"&modul_id="+modul_id, function(data) {
                                                 $("div#form_'.$this->url.'").html(data);
                                                 
                                            });
                                            
                                        }
                                            reload_grid("grid_'.$this->url.'");
                                    }
                                    
                                 })
                             }
                         </script>';
                $echo .= '<h1>Confirm</h1><br />';
                $echo .= '<form id="form_'.$this->url.'_confirm" action="'.base_url().'processor/'.$this->urlpath.'?action=confirm_process" method="post">';
                $echo .= '<div style="vertical-align: top;">';
                $echo .= 'Remark : 
                        <input type="hidden" name="'.$this->main_table_pk.'" value="'.$this->input->get($this->main_table_pk).'" />
                        <input type="hidden" name="modul_id" value="'.$this->input->get('modul_id').'" />
                        <input type="hidden" name="group_id" value="'.$this->input->get('group_id').'" />
                        <input type="hidden" name="iM_modul_activity" value="'.$this->input->get('iM_modul_activity').'" />
                        
                        <textarea name="vRemark"></textarea>
                <button type="button" onclick="submit_ajax(\'form_'.$this->url.'_confirm\')">Confirm</button>';
                    
                $echo .= '</div>';
                $echo .= '</form>';
                return $echo;
            } 

     function confirm_process() {
        $post = $this->input->post();
        $cNip= $this->user->gNIP;
        $vName= $this->user->gName;
        $pk = $post[$this->main_table_pk];
        $vRemark = $post['vRemark'];
        $modul_id = $post['modul_id'];
        $iM_modul_activity = $post['iM_modul_activity'];

        $activity = $this->db->get_where('plc3.m_modul_activity', array('iM_modul_activity'=>$iM_modul_activity, 'lDeleted'=>0))->row_array();

        $field = $activity['vFieldName'];
        $update = array($field => 2);
        $this->db->where($this->main_table_pk, $pk);
        $this->db->update($this->main_table, $update);

        $peka=$this->main_table_pk;
        $iupb_id[]=$this->lib_plc->getUpbId($peka,$pk);

        $this->lib_plc->InsertActivityModule($iupb_id,$modul_id,$pk,$activity['iM_activity'],$activity['iSort'],$vRemark,2);
        
        $data['status']  = true;
        $data['last_id'] = $post[$this->main_table_pk];
        $data['group_id'] = $post['group_id'];
        $data['modul_id'] = $post['modul_id'];
        return json_encode($data);
    }

    function approve_view() {
        $echo = '<script type="text/javascript">
                     function submit_ajax(form_id) {

                        return $.ajax({
                            url: $("#"+form_id).attr("action"),
                            type: $("#"+form_id).attr("method"),
                            data: $("#"+form_id).serialize(),
                            success: function(data) {
                                var o = $.parseJSON(data);
                                var last_id = o.last_id;                            
                                if(o.status == true) {
                                    $("#alert_dialog_form").dialog("close");
                                        $.get(base_url+"processor/pengujian/mt8b?action=view&id="+last_id+"&group_id="+o.group_id+"&modul_id="+o.modul_id, function(data) {
                                             $("div#form_mt8b").html(data);
                                        });
                                    
                                }
                                    reload_grid("grid_mt8b");
                            }
                            
                         })
                     }
                 </script>';
        $echo .= '<h1>Approval</h1><br />';
        $echo .= '<form id="form_mt8b_approve" action="'.base_url().'processor/pengujian/mt8b?action=approve_process" method="post">';
        $echo .= '<div style="vertical-align: top;">';
        $echo .= 'Remark : 
                <input type="hidden" name="last_id" value="'.$this->input->get('last_id').'" />
                <input type="hidden" name="group_id" value="'.$this->input->get('group_id').'" />
                <input type="hidden" name="modul_id" value="'.$this->input->get('modul_id').'" />
                <textarea name="vRemark"></textarea>
        <button type="button" onclick="submit_ajax(\'form_mt8b_approve\')">Approve</button>';
            
        $echo .= '</div>';
        $echo .= '</form>';
        return $echo;
    }

    function approve_process(){
        $post = $this->input->post();
        $dataupdate['cUpdated']= $this->user->gNIP;
        $dataupdate['dUpdated']= date('Y-m-d H:i:s');
        $dataupdate['cApprove']= $this->user->gNIP;
        $dataupdate['dApprove']= date('Y-m-d H:i:s');
        $dataupdate['vRemark']= $post['vRemark'];
        $dataupdate['iApprove_unit_uji']= 2;
        $this->db->where('iMt8b',$post['last_id'])
                    ->update('bbpmsoh.mt08b',$dataupdate);

        $data['group_id']=$post['group_id'];
        $data['modul_id']=$post['modul_id'];
        $data['status']  = true;
        $data['last_id'] = $post['last_id'];
        
        return json_encode($data);
    }

    function reject_view() {
        $echo = '<script type="text/javascript">
                     function submit_ajax(form_id) {
                        var remark = $("#reject_mt8b_vRemark").val();
                        if (remark=="") {
                            alert("Remark tidak boleh kosong ");
                            return
                        }
                        return $.ajax({
                            url: $("#"+form_id).attr("action"),
                            type: $("#"+form_id).attr("method"),
                            data: $("#"+form_id).serialize(),
                            success: function(data) {
                                var o = $.parseJSON(data);
                                var last_id = o.last_id;
                                var url = "'.base_url().'processor/pengujian/mt8b";                             
                                if(o.status == true) {
                                    
                                    $("#alert_dialog_form").dialog("close");
                                         $.get(url+"?action=view&id="+last_id+"&group_id="+o.group_id+"&modul_id="+o.modul_id, function(data) {
                                         $("div#form_mt8b").html(data);
                                    });
                                    
                                }
                                    reload_grid("grid_mt8b");
                            }
                            
                         })
                    
                     }
                 </script>';
        $echo .= '<h1>Reject</h1><br />';
        $echo .= '<form id="form_mt8b_reject" action="'.base_url().'processor/pengujian/mt8b?action=reject_process" method="post">';
        $echo .= '<div style="vertical-align: top;">';
        $echo .= 'Remark : 
                <input type="hidden" name="last_id" value="'.$this->input->get('last_id').'" />
                <input type="hidden" name="group_id" value="'.$this->input->get('group_id').'" />
                <input type="hidden" name="modul_id" value="'.$this->input->get('modul_id').'" />
                <textarea name="vRemark"></textarea>
        <button type="button" onclick="submit_ajax(\'form_mt8b_reject\')">Reject</button>';
            
        $echo .= '</div>';
        $echo .= '</form>';
        return $echo;
    }

    function reject_process () {
         $post = $this->input->post();
        $dataupdate['cUpdated']= $this->user->gNIP;
        $dataupdate['dUpdated']= date('Y-m-d H:i:s');
        $dataupdate['cApprove']= $this->user->gNIP;
        $dataupdate['dApprove']= date('Y-m-d H:i:s');
        $dataupdate['vRemark']= $post['vRemark'];
        $dataupdate['iApprove_unit_uji']= 1;
        $this->db->where('iMt8b',$post['last_id'])
                    ->update('bbpmsoh.mt08b',$dataupdate);
        $data['group_id']=$post['group_id'];
        $data['modul_id']=$post['modul_id'];
        $data['status']  = true;
        $data['last_id'] = $post['last_id'];
        
        return json_encode($data);
    }

    function getDetailsReq() {
    	$term = $this->input->get('term');
    	$sql='select mt01.*,m_tujuan_pengujian.cKode from bbpmsoh.mt01
    			join bbpmsoh.m_tujuan_pengujian on m_tujuan_pengujian.iM_tujuan_pengujian=mt01.iM_tujuan_pengujian
				where mt01.iMt01 IN (select iMt01 from bbpmsoh.mt03 where iApprove_unit_uji=2 and lDeleted=0) 
				AND mt01.iMt01 NOT IN (select iMt01 from bbpmsoh.mt8b_detail where lDeleted=0)
				AND mt01.vNomor like "%'.$term.'%" and mt01.lDeleted=0 order by vNomor ASC';
    	$dt=$this->db->query($sql);
    	$data = array();
    	if($dt->num_rows>0){
    		foreach($dt->result_array() as $line) {
	
				$row_array['value'] = trim($line['vNomor']);
				$row_array['id']    = $line['iMt01'];
				foreach ($line as $kline => $vline) {
					$row_array[$kline]=$vline;
				}
	
				array_push($data, $row_array);
			}
    	}
    	echo json_encode($data);
		exit;
    }

    function get_data_prev(){
    	$post=$this->input->post();
    	$get=$this->input->get();
    	$nmTable=isset($post["nmTable"])?$post["nmTable"]:"0";
    	$grid=isset($post["grid"])?$post["grid"]:"0";
    	$id=isset($post["id"])?$post["id"]:"0";

    	$where=array(
    		$this->main_table_pk=>$id
    		,'mt8b_detail.lDeleted'=>0
    		);
    	$this->db->select("mt01.*,m_tujuan_pengujian.cKode,mt8b_detail.iMt8b_detail")
    				->from("bbpmsoh.mt8b_detail")
    				->join("bbpmsoh.mt01","mt01.iMt01=mt8b_detail.iMt01")
    				->join("bbpmsoh.m_tujuan_pengujian","m_tujuan_pengujian.iM_tujuan_pengujian=mt01.iM_tujuan_pengujian")
    				->where($where);
    	$q=$this->db->get(); 

		$rsel=array('iAction'=>'Del','vNomor'=>'Nomor Pengujian','vNama_sample'=>'Nama Sample','vNama_produsen'=>'Produsen','vZat_aktif'=>'Zat Aktif / Strain','vNo_registrasi'=>'No. Registrasi','vBatch_lot'=>'No. Batch','dTgl_kadaluarsa'=>'Waktu Kadaluarsa','vKemasan'=>'Kemasan','iJumlah_diserahkan'=>'Jumlah Sample','cKode'=>'Keterangan');
		$data = new StdClass;
		$data->records=$q->num_rows();
		$i=0;
		$dataar=array();
		foreach ($q->result() as $k) {
			$data->rows[$i]['id']=$i;
			$z=0;
			foreach ($rsel as $dsel => $vsel) {
				if($dsel=="iAction"){
					$dataar[$z]="<input type='hidden' class='num_rows_".$nmTable."' value='".$i."' /><a href='javascript:;' onclick='javascript:hapus_row_".$nmTable."(".$i.")'><center><span class='ui-icon ui-icon-trash'></span></center></a>";
				}elseif($dsel=="vNomor"){
					$dataar[$z]="<input type='text' name='grid_details_nomor_request[".$k->iMt8b_detail."][]' id='grid_details_nomor_request_".$i."' value='".$k->vNomor."' class='get_sample_req required' size='25'><input type='hidden' name='grid_details_iMt01[".$k->iMt8b_detail."][]' id='grid_details_iMt01_".$i."' value='".$k->iMt01."' class='required' size='25'>";
				}else{
					$dataar[$z]="<p id='grid_".$dsel."_".$i."'>".$k->{$dsel}."</p>";
				}
				$z++;
			}
			$data->rows[$i]['cell']=$dataar;
			$i++;
		}
		return json_encode($data);
    }

}