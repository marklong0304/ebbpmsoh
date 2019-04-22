<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class mt8a extends MX_Controller {
    function __construct() {
        parent::__construct();
		 $this->load->library('auth');
        $this->db = $this->load->database('hrd',false, true);
        $this->user = $this->auth->user();

		$this->title = 'MT 8A';
		$this->url = 'mt8a';
		$this->urlpath = 'pengujian/'.str_replace("_","/", $this->url);
		$this->group = $this->auth->checkgroup($this->user->gNIP);
		$this->maintable = 'bbpmsoh.mt08a';	
		$this->main_table = $this->maintable;	
		$this->main_table_pk = 'iMt8a';	
		$datagrid['islist'] = array(
			'mt03.vnomor_03' => array('label'=>'Nomor Pengujian','width'=>100,'align'=>'center','search'=>true)
			,'mt01.vNama_sample' => array('label'=>'Nama Sample','width'=>250,'align'=>'left','search'=>true)
			,'iSubmit' => array('label'=>'Submit','width'=>150,'align'=>'left','search'=>true)
			,'iApprove_unit_uji' => array('label'=>'Approval Yanji','width'=>150,'align'=>'left','search'=>true)
			,'iApprove_qa' => array('label'=>'Approval QA','width'=>150,'align'=>'left','search'=>true)
			,'iKesimpulan' => array('label'=>'Kesimpulan Uji Umum','width'=>200,'align'=>'center','search'=>false)
			
		);

		$datagrid['jointableinner']=array(
            0=>array('bbpmsoh.mt01'=>'mt01.iMt01=bbpmsoh.mt08a.iMt01')
            ,1=>array('bbpmsoh.mt03'=>'mt01.iMt01=bbpmsoh.mt03.iMt01')
            );


		$datagrid['addFields']=array(
				'iMt01'=>'Nomor Pengujian '
				,'uji_fisik' => 'Pengujian'
				,'iKesimpulan'  => 'Kesimpulan Uji Umum'
				);
		$datagrid['shortBy']=array('mt08a.dUpdated'=>'DESC');
	
		$datagrid['setQuery']=array(
								0=>array('vall'=>'mt08a.lDeleted','nilai'=>0)
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
            $grid->setQuery('mt08a.iSubmit',1);     
        }

        

		$grid->setJoinTable('bbpmsoh.mt01', 'mt08a.iMt01 = mt01.iMt01', 'inner');
		$grid->setJoinTable('bbpmsoh.m_jenis_sediaan', 'm_jenis_sediaan.iM_jenis_sediaan = mt01.iM_jenis_sediaan', 'inner');

		$grid->changeFieldType('iKesimpulan','combobox','',array(''=>'Belum ditentukan',1=>'Tidak memenuhi syarat', 2=>'Memenuhi syarat'));
		$grid->changeFieldType('iSubmit', 'combobox','',array(''=>'--select--', 0=>'Draft', 1=>'Submit'));
		$grid->changeFieldType('iApprove_unit_uji', 'combobox','',array(''=>'--select--', 0=>'Waiting Approval', 1=>'Rejected', 2=>'Approved'));
		$grid->changeFieldType('iApprove_qa', 'combobox','',array(''=>'--select--', 0=>'Waiting Approval', 1=>'Rejected', 2=>'Approved'));

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
                echo $this->reject_process(0);
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

    function updateBox_mt8a_uji_fisik($name, $id, $value, $rowData) {
		$this->db->where('iMt8a', $rowData['iMt8a']);
		$this->db->where('lDeleted', 0);
		$data['rows'] = $this->db->get('bbpmsoh.mt08a_fisik')->result_array();
		$data['browse_url'] = base_url().'processor/plc/browse/bb';
		return $this->load->view('partial/8a_fisik', $data, TRUE);
	}
	function insertBox_mt8a_uji_fisik($name, $id) {
		$data['rows'] = array();
		$data['browse_url'] = base_url().'processor/plc/browse/bb';
		return $this->load->view('partial/8a_fisik', $data, TRUE);
	}



    function listBox_Action($row, $actions) {
        if ($row->iApprove_qa > 1 && $row->iApprove_unit_uji > 1 ) { 
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


    function manipulate_update_button($buttons, $rowData) {
         $cNip= $this->user->gNIP;
        $js = $this->load->view('js/mt8a_js');
        $js .= $this->load->view('js/upload_js');

        $iframe = '<iframe name="'.$this->url.'_frame" id="'.$this->url.'_frame" height="0" width="0"></iframe>';
        
       
        $update_draft = '<button onclick="javascript:update_draft_btn(\''.$this->url.'\', \' '.base_url().'processor/'.$this->urlpath.'?draft=true&company_id='.$this->input->get('company_id').'&group_id='.$this->input->get('group_id').'&modul_id='.$this->input->get('modul_id').'\',this,true )"  id="button_update_draft_'.$this->url.'"  class="ui-button-text icon-save" >Update as Draft</button>';
        $update = '<button onclick="javascript:update_btn_back(\''.$this->url.'\', \' '.base_url().'processor/'.$this->urlpath.'?company_id='.$this->input->get('company_id').'&group_id='.$this->input->get('group_id').'&modul_id='.$this->input->get('modul_id').' \',this,true )"  id="button_update_submit_'.$this->url.'"  class="ui-button-text icon-save" >Update &amp; Submit</button>';
        $approve = '<button onclick="javascript:load_popup(\' '.base_url().'processor/'.$this->urlpath.'?action=approve&last_id='.$this->input->get('id').'&company_id='.$this->input->get('company_id').'&group_id='.$this->input->get('group_id').'&modul_id='.$this->input->get('modul_id').' \')"  id="button_approve_'.$this->url.'"  class="ui-button-text icon-save" >Approve</button>';
        $reject = '<button onclick="javascript:load_popup(\' '.base_url().'processor/'.$this->urlpath.'?action=reject&approve&last_id='.$this->input->get('id').'&company_id='.$this->input->get('company_id').'&group_id='.$this->input->get('group_id').'&modul_id='.$this->input->get('modul_id').' \' )"  id="button_reject_'.$this->url.'"  class="ui-button-text icon-save" >Reject</button>';
        

        $groupnya = $this->checkgroup($this->user->gNIP);             
       
       	 /*
            idprivi_group;vNamaGroup
            11 : QA
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


        


        if ($this->input->get('action') == 'view') {
            unset($buttons['update']);
        }
        else{ 
        	unset($buttons['update']);
            if($rowData['iSubmit']==0){
            	if($groupnya['idprivi_group'] == 3){
             		$buttons['update'] = $iframe.$update_draft.$update.$js;    
		        }

                
            }elseif($rowData['iSubmit']==1){

            	if($groupnya['idprivi_group'] == 11 and $rowData['iApprove_qa'] <> 2 ){
             		$buttons['update'] = $iframe.$approve.$reject;
             	}
		        if($groupnya['idprivi_group'] == 2 and $rowData['iApprove_unit_uji'] <> 2 ){
		            $buttons['update'] = $iframe.$approve.$reject;
		        }


                
            }
        }
        
        return $buttons;
    }

	function manipulate_insert_button($buttons){        
        $cNip= $this->user->gNIP;
        $js = $this->load->view('js/mt8a_js');
        $js .= $this->load->view('js/upload_js');

        $iframe = '<iframe name="'.$this->url.'_frame" id="'.$this->url.'_frame" height="0" width="0"></iframe>';
        
       $save_draft = '<button onclick="javascript:save_draft_btn_multiupload(\''.$this->url.'\', \' '.base_url().'processor/'.$this->urlpath.'?draft=true&company_id='.$this->input->get('company_id').'&group_id='.$this->input->get('group_id').'&modul_id='.$this->input->get('modul_id').'\',this,true )"  id="button_save_draft_'.$this->url.'"  class="ui-button-text icon-save" >Save as Draft</button>';
        $save = '<button onclick="javascript:save_btn_multiupload(\''.$this->url.'\', \' '.base_url().'processor/'.$this->urlpath.'?company_id='.$this->input->get('company_id').'&group_id='.$this->input->get('group_id').'&modul_id='.$this->input->get('modul_id').' \',this,true )"  id="button_save_submit_'.$this->url.'"  class="ui-button-text icon-save" >Save &amp; Submit</button>';

        $buttons['save'] = $iframe.$save_draft.$save.$js;
        
        return $buttons;
	}

	/*List Box*/
	function listBox_mt8a_iappqa_uji($value) {
		if($value==0){$vstatus='Waiting for approval';}
		elseif($value==1){$vstatus='Rejected';}
		elseif($value==2){$vstatus='Approved';}
		return $vstatus;
	}

	function listBox_mt8a_ini_nilai($value, $pk, $name, $rowData) {
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
	function insertBox_mt8a_iMt01($field, $id) {
		$arr=array(
			'mt01.lDeleted'=>0
			,'mt06.lDeleted'=>0	
			,'mt06.iApprove_sphu'=>2	
		);
		$this->db->select("mt01.*,mt03.*")
				->from("bbpmsoh.mt01")
				->join("bbpmsoh.mt06","mt06.iMt01=bbpmsoh.mt01.iMt01")
				->join("bbpmsoh.mt03","mt03.iMt01=bbpmsoh.mt01.iMt01")
				->where('bbpmsoh.mt01.iMt01 NOT IN (select iMt01 from bbpmsoh.mt08a where lDeleted=0 AND iApprove_unit_uji in (0,2) )')
                //->where('bbpmsoh.mt01.iMt01 IN (select iMt01 from bbpmsoh.mt06 where lDeleted=0 AND ( iDist_virologi =1 or iDist_bakteri = 1) )')
                ->where('bbpmsoh.mt01.iMt01 IN (select iMt01 from bbpmsoh.mt06 where lDeleted=0 AND (iDist_bakteri = 1) )')
				->where($arr);

		$return="<select name='".$id."' id='".$id."' class='required'>";
		$return.="<option value=''>---Pilih---</option>";
		$qq=$this->db->get();
		if($qq->num_rows()>0){
			foreach ($qq->result_array() as $key => $value) {
				$return.="<option value='".$value['iMt01']."'>".$value['vnomor_03']." | ".$value['vNama_sample']."</option>";
			}
		}
		$return.="</select>";
		$return.="<div id='info_mt01'>";
				$return .= " <table cellspacing='0' cellpadding='3' style='width: 70%; border: 1px solid #dddddd; background: #DBC0D2 none repeat; border-collapse: collapse'>
					 	
					 	<tr>
					 		<td style='width: 30%;'>No Batch / Lot</td>
					 		<td >: <span id='det_vBatch_lot'></span></td>
					 	</tr>
					 	<tr>
					 		<td style='width: 30%;'>Waktu Kadaluarsa</td>
					 		<td >: <span id='det_dTgl_kadaluarsa'></span>  </td>
					 	</tr>
					 	<tr>
					 		<td style='width: 30%;'>No Reg Kementan</td>
					 		<td >: <span id='det_vNo_registrasi'></span> </td>
					 	</tr>
					 </table>";
		$return.="</div>";

		$return.="<script>";
		$return.="$('#".$id."').change(function(){
			$.ajax({
                url:base_url+'processor/pengujian/mt8a?action=getDetailsData',
                type: 'post',
                data: {iMt01:$(this).val()},
                success: function(data) {
                    //alert(isUpload);
                    var o = $.parseJSON(data);
                    $('#det_vNama_sample').text(o.vNama_sample);
                    $('#det_vBatch_lot').text(o.vBatch_lot);
                    $('#det_dTgl_kadaluarsa').text(o.dTgl_kadaluarsa);
                    $('#det_vNo_registrasi').text(o.vNo_registrasi);
                    $('#mt8a_vJenis_sediaan').text(o.vJenis_sediaan);
                    $('#mt8a_vKemasan').text(o.vKemasan);
                    $('#mt8a_vJenis_sediaan').text(o.vJenis_sediaan);
                }
			});
		});";
		$return.="</script>";
		$return .= '<input type="hidden" name="isdraft" id="isdraft" class="input_rows1 " size="30"  />';
        return $return;
    }

    function updateBox_mt8a_iMt01($field,$id,$value,$rowData){
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
            ->join("bbpmsoh.mt03","mt03.iMt01=bbpmsoh.mt01.iMt01")
            ->where($arr)
            ->where('bbpmsoh.mt01.iMt01 NOT IN (select iMt01 from bbpmsoh.mt08a where lDeleted=0 AND iMt01 !='.$value.' )')
            ->where('bbpmsoh.mt01.iMt01 IN (select iMt01 from bbpmsoh.mt06 where lDeleted=0 AND ( iDist_virologi =1 or iDist_bakteri = 1) )');
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
            $return.='<option value="'.$vv['iMt01'].'" '.$select.' >'.$vv['vnomor_03'].' - '.$vv['vNama_sample'].'</option>';
        }
        $return.='</select>';
        $return.="<div id='info_mt01'>";
				$return .= " <table cellspacing='0' cellpadding='3' style='width: 70%; border: 1px solid #dddddd; background: #DBC0D2 none repeat; border-collapse: collapse'>
					 	
					 	<tr>
					 		<td style='width: 30%;'>No Batch / Lot</td>
					 		<td >: <span id='det_vBatch_lot'>".$dMt01['vBatch_lot']."</span></td>
					 	</tr>
					 	<tr>
					 		<td style='width: 30%;'>Waktu Kadaluarsa</td>
					 		<td >: <span id='det_dTgl_kadaluarsa'>".$dMt01['dTgl_kadaluarsa']."</span>  </td>
					 	</tr>
					 	<tr>
					 		<td style='width: 30%;'>No Reg Kementan</td>
					 		<td >: <span id='det_vNo_registrasi'>".$dMt01['vNo_registrasi']."</span> </td>
					 	</tr>
					 </table>";
		$return.="</div>";

		$return.="<script>";
		$return.="$('#".$id."').change(function(){
			$.ajax({
                url:base_url+'processor/pengujian/mt8a?action=getDetailsData',
                type: 'post',
                data: {iMt01:$(this).val()},
                success: function(data) {
                    //alert(isUpload);
                    var o = $.parseJSON(data);
                    $('#det_vNama_sample').text(o.vNama_sample);
                    $('#det_vBatch_lot').text(o.vBatch_lot);
                    $('#det_dTgl_kadaluarsa').text(o.dTgl_kadaluarsa);
                    $('#det_vNo_registrasi').text(o.vNo_registrasi);
                    $('#mt8a_vJenis_sediaan').text(o.vJenis_sediaan);
                    $('#mt8a_vKemasan').text(o.vKemasan);
                    $('#mt8a_vJenis_sediaan').text(o.vJenis_sediaan);
                }
			});
		});";
		$return.="</script>";
        $return .= '<input type="hidden" name="isdraft" id="isdraft" class="input_rows1 " size="30"  />';
        if($this->input->get('action')=='view'){
            $sqlinfo = 'select * 
            			from bbpmsoh.mt01 a 
            			join bbpmsoh.mt03 b on b.iMt01=a.iMt01
            			where a.iMt01= "'.$viewval.'" ';
            			
        	$dMt01 = $this->db->query($sqlinfo)->row_array();
        	$return = $dMt01['vnomor_03'];
            $return.="<div id='info_mt01'>";
				$return .= " <table cellspacing='0' cellpadding='3' style='width: 70%; border: 1px solid #dddddd; background: #DBC0D2 none repeat; border-collapse: collapse'>
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
					 		<td style='width: 30%;'>No Reg Kementan</td>
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

	function insertBox_mt8a_vBatch_lot($field, $id) {
		$return="<input type='text' name='".$id."' id='".$id."' value='' size='35' readonly='readonly' />";
		return $return;
    }
	function insertBox_mt8a_dTgl_kadaluarsa($field, $id) {
		$return="<input type='text' name='".$id."' id='".$id."' value='' size='35' readonly='readonly' />";
		return $return;
    }
	function insertBox_mt8a_vNo_registrasi($field, $id) {
		$return="<input type='text' name='".$id."' id='".$id."' value='' size='35' readonly='readonly' />";
		return $return;
    }
	function insertBox_mt8a_vKemasan($field, $id) {
		$return="<input type='text' name='".$id."' id='".$id."' value='' size='35' readonly='readonly' />";
		return $return;
    }
	function insertBox_mt8a_vJenis_sediaan($field, $id) {
		$return="<input type='text' name='".$id."' id='".$id."' value='' size='35' readonly='readonly' />";
		return $return;
    }
     function insertBox_mt8a_dTanggal_terima_sample($field, $id) {
    	$ff=str_replace("form_","", $field);
        $return = '<input name="'.$ff.'" id="'.$id.'" type="text" size="20" class="input_tgl datepicker required" style="width:130px"/>';
        $return .=  '<script>
                            $("#'.$id.'").datepicker({dateFormat:"yy-mm-dd"});
                        
                    </script>';
        return $return;
    }
    function insertBox_mt8a_vAcuanProsedur($field, $id) {
		$return="<input type='text' name='".$id."' id='".$id."' value='SK Mentan No. 69S/Kpts/TN.260/8/9/96.' size='35' />";
		return $return;
    }
    function insertBox_mt8a_vPenyimpangan($field, $id) {
		$return="<input type='text' name='".$id."' id='".$id."' value='' size='35' />";
		return $return;
    }
    function insertBox_mt8a_vNo_transaksi($field, $id) {
		$return="<input type='text' name='".$id."' id='".$id."' value='' size='35' readonly='readonly' />";
		return $return;
    }
	
    /*Function Tambahan*/

    function before_insert_processor($row, $postData) {
    	$postData['dCreated']=date("Y-m-d H:i:s");
    	$postData['cCreated']=$this->user->gNIP;
        if($postData['isdraft']==true){
            $postData['iSubmit']=0;
            $postData['iKesimpulan']=NULL;
            
        } 
        else{
            $postData['iSubmit']=1;
        }

       
        return $postData;

    }
    function before_update_processor($row, $postData) {
    	$postData['dUpdated']=date("Y-m-d H:i:s");
    	$postData['cUpdated']=$this->user->gNIP;
        if($postData['isdraft']==true){
            $postData['iSubmit']=0;
        } 
        else{
            $postData['iSubmit']=1;
        }

        if($postData['mt8a_iKesimpulan']==""){
        	$postData['iKesimpulan']=NULL;
        }
        return $postData;
    }

    /*After Insert*/
    function after_insert_processor($fields, $id, $postData) {
    	$post = $this->input->post();
    	$idet['iMt8a'] = $id;

		$idet['vWarna'] = $post['vWarna'];
		$idet['vWarna_metoda'] = $post['vWarna_metoda'];
		$idet['vWarna_mutu'] = $post['vWarna_mutu'];
		$idet['dWarna_tanggal'] = $post['dWarna_tanggal'];


		$idet['vAsing'] = $post['vAsing'];
		$idet['vAsing_metoda'] = $post['vAsing_metoda'];
		$idet['vAsing_mutu'] = $post['vAsing_mutu'];
		$idet['dAsing_tanggal'] = $post['dAsing_tanggal'];


		$idet['vHomogen'] = $post['vHomogen'];
		$idet['vHomogen_metoda'] = $post['vHomogen_metoda'];
		$idet['vHomogen_mutu'] = $post['vHomogen_mutu'];
		$idet['dHomogen_tanggal'] = $post['dHomogen_tanggal'];


		$idet['vVakum'] = $post['vVakum'];
		$idet['vVakum_metoda'] = $post['vVakum_metoda'];
		$idet['vVakum_mutu'] = $post['vVakum_mutu'];
		$idet['dVakum_tanggal'] = $post['dVakum_tanggal'];
		$idet['vLembab'] = $post['vLembab'];
		$idet['vLembab_metoda'] = $post['vLembab_metoda'];
		$idet['vLembab_mutu'] = $post['vLembab_mutu'];
		$idet['dLembab_tanggal'] = $post['dLembab_tanggal'];
		$idet['vMurni_apus'] = $post['vMurni_apus'];
		$idet['vMurni_37'] = $post['vMurni_37'];
		$idet['vMurni_metoda'] = $post['vMurni_metoda'];
		$idet['vMurni_mutu'] = $post['vMurni_mutu'];
		$idet['dMurni_tanggal'] = $post['dMurni_tanggal'];
		$idet['vSteril_37'] = $post['vSteril_37'];
		$idet['vSteril_22'] = $post['vSteril_22'];
		$idet['vSteril_metoda'] = $post['vSteril_metoda'];
		$idet['vSteril_mutu'] = $post['vSteril_mutu'];
		$idet['dSteril_tanggal'] = $post['dSteril_tanggal'];
		$idet['vDisolasi'] = $post['vDisolasi'];
		$idet['vDisolasi_metoda'] = $post['vDisolasi_metoda'];
		$idet['vDisolasi_mutu'] = $post['vDisolasi_mutu'];
		$idet['dDisolasi_tanggal'] = $post['dDisolasi_tanggal'];
		$idet['vKontaminasi_mico'] = $post['vKontaminasi_mico'];
		$idet['vKontaminasi_salmon'] = $post['vKontaminasi_salmon'];
		$idet['vKontaminasi_jamur'] = $post['vKontaminasi_jamur'];
		$idet['vKontaminasi_coli'] = $post['vKontaminasi_coli'];
		$idet['vKontaminasi_lain'] = $post['vKontaminasi_lain'];
		$idet['vKontaminasi_metoda'] = $post['vKontaminasi_metoda'];
		$idet['vKontaminasi_mutu'] = $post['vKontaminasi_mutu'];
		$idet['dKontaminasi_tanggal'] = $post['dKontaminasi_tanggal'];
		$idet['vLain'] = $post['vLain'];
		$idet['vLain_metoda'] = $post['vLain_metoda'];
		$idet['vLain_mutu'] = $post['vLain_mutu'];
		$idet['dLain_tanggal'] = $post['dLain_tanggal'];


		
		$this->db->insert('bbpmsoh.mt08a_fisik', $idet);
		



    }

    /*After Update*/
    function after_update_processor($fields, $id, $postData) {
    	$post=$this->input->post();
	    
	    $idet['vWarna'] = $post['vWarna'];
		$idet['vWarna_metoda'] = $post['vWarna_metoda'];
		$idet['vWarna_mutu'] = $post['vWarna_mutu'];
		$idet['dWarna_tanggal'] = $post['dWarna_tanggal'];


		$idet['vAsing'] = $post['vAsing'];
		$idet['vAsing_metoda'] = $post['vAsing_metoda'];
		$idet['vAsing_mutu'] = $post['vAsing_mutu'];
		$idet['dAsing_tanggal'] = $post['dAsing_tanggal'];


		$idet['vHomogen'] = $post['vHomogen'];
		$idet['vHomogen_metoda'] = $post['vHomogen_metoda'];
		$idet['vHomogen_mutu'] = $post['vHomogen_mutu'];
		$idet['dHomogen_tanggal'] = $post['dHomogen_tanggal'];

		$idet['vVakum'] = $post['vVakum'];
		$idet['vVakum_metoda'] = $post['vVakum_metoda'];
		$idet['vVakum_mutu'] = $post['vVakum_mutu'];
		$idet['dVakum_tanggal'] = $post['dVakum_tanggal'];
		$idet['vLembab'] = $post['vLembab'];
		$idet['vLembab_metoda'] = $post['vLembab_metoda'];
		$idet['vLembab_mutu'] = $post['vLembab_mutu'];
		$idet['dLembab_tanggal'] = $post['dLembab_tanggal'];
		$idet['vMurni_apus'] = $post['vMurni_apus'];
		$idet['vMurni_37'] = $post['vMurni_37'];
		$idet['vMurni_metoda'] = $post['vMurni_metoda'];
		$idet['vMurni_mutu'] = $post['vMurni_mutu'];
		$idet['dMurni_tanggal'] = $post['dMurni_tanggal'];
		$idet['vSteril_37'] = $post['vSteril_37'];
		$idet['vSteril_22'] = $post['vSteril_22'];
		$idet['vSteril_metoda'] = $post['vSteril_metoda'];
		$idet['vSteril_mutu'] = $post['vSteril_mutu'];
		$idet['dSteril_tanggal'] = $post['dSteril_tanggal'];
		$idet['vDisolasi'] = $post['vDisolasi'];
		$idet['vDisolasi_metoda'] = $post['vDisolasi_metoda'];
		$idet['vDisolasi_mutu'] = $post['vDisolasi_mutu'];
		$idet['dDisolasi_tanggal'] = $post['dDisolasi_tanggal'];
		$idet['vKontaminasi_mico'] = $post['vKontaminasi_mico'];
		$idet['vKontaminasi_salmon'] = $post['vKontaminasi_salmon'];
		$idet['vKontaminasi_jamur'] = $post['vKontaminasi_jamur'];
		$idet['vKontaminasi_coli'] = $post['vKontaminasi_coli'];
		$idet['vKontaminasi_lain'] = $post['vKontaminasi_lain'];
		$idet['vKontaminasi_metoda'] = $post['vKontaminasi_metoda'];
		$idet['vKontaminasi_mutu'] = $post['vKontaminasi_mutu'];
		$idet['dKontaminasi_tanggal'] = $post['dKontaminasi_tanggal'];
		$idet['vLain'] = $post['vLain'];
		$idet['vLain_metoda'] = $post['vLain_metoda'];
		$idet['vLain_mutu'] = $post['vLain_mutu'];
		$idet['dLain_tanggal'] = $post['dLain_tanggal'];

    	$this->db->where('iMt8a', $id);
		$this->db->update('bbpmsoh.mt08a_fisik', $idet);

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
                                        $.get(base_url+"processor/pengujian/mt8a?action=view&id="+last_id+"&group_id="+o.group_id+"&modul_id="+o.modul_id, function(data) {
                                             $("div#form_mt8a").html(data);
                                        });
                                    
                                }
                                    reload_grid("grid_mt8a");
                            }
                            
                         })
                     }
                 </script>';
        $echo .= '<h1>Approval</h1><br />';
        $echo .= '<form id="form_mt8a_approve" action="'.base_url().'processor/pengujian/mt8a?action=approve_process" method="post">';
        $echo .= '<div style="vertical-align: top;">';
        $echo .= 'Remark : 
                <input type="hidden" name="last_id" value="'.$this->input->get('last_id').'" />
                <input type="hidden" name="group_id" value="'.$this->input->get('group_id').'" />
                <input type="hidden" name="modul_id" value="'.$this->input->get('modul_id').'" />
                <textarea name="vRemark"></textarea>
        <button type="button" onclick="submit_ajax(\'form_mt8a_approve\')">Approve</button>';
            
        $echo .= '</div>';
        $echo .= '</form>';
        return $echo;
    }

    function approve_process(){
        $post = $this->input->post();
        $dataupdate['cUpdated']= $this->user->gNIP;
        $dataupdate['dUpdated']= date('Y-m-d H:i:s');
        
        $groupnya = $this->checkgroup($this->user->gNIP);             
       
       	 /*
            idprivi_group;vNamaGroup
            11 : QA
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

        $sqlgetMt1 = 'select * from bbpmsoh.mt08a a where a.iMt8a = "'.$post['last_id'].'"';
        $dmete1 = $this->db->query($sqlgetMt1)->row_array();
        $iMt01 = $dmete1['iMt01'];
        $subject = '';
        $qsql="
                select * 
                from bbpmsoh.mt01 a 
                join hrd.employee b on b.cNip=a.iCustomer
                join bbpmsoh.m_tujuan_pengujian c on c.iM_tujuan_pengujian=a.iM_tujuan_pengujian
                where a.lDeleted=0 
                and a.iMt01 = '".$iMt01."'

        ";
        $rsql = $this->db->query($qsql)->row_array();

        if($groupnya['idprivi_group'] == 11){
     		/*QA*/
     		$dataupdate['cApprove_qa']= $this->user->gNIP;
	        $dataupdate['dApprove_qa']= date('Y-m-d H:i:s');
	        $dataupdate['vRemark_qa']= $post['vRemark'];
	        $dataupdate['iApprove_qa']= 2;

	        $subject = 'e-Pengujian -> Approve QA MT8A '.$rsql['vNo_transaksi'];
            $precontent = 'Admin QA telah melakukan Approval Pengujian MT8A';



     	}else{
     		$dataupdate['cApprove']= $this->user->gNIP;
	        $dataupdate['dApprove']= date('Y-m-d H:i:s');
	        $dataupdate['vRemark']= $post['vRemark'];
	        $dataupdate['iApprove_unit_uji']= 2;

	        $subject = 'e-Pengujian -> Approve Yanji MT8A '.$rsql['vNo_transaksi'];
            $precontent = 'Admin Yanji telah melakukan Approval Pengujian MT8A';



     	}
		 

        
        $updet = $this->db->where('iMt8a',$post['last_id'])->update('bbpmsoh.mt08a',$dataupdate);

        if($updet){
        		

                if($subject <> ""){
                    $qsql="
                            select * 
                            from bbpmsoh.mt01 a 
                            join hrd.employee b on b.cNip=a.iCustomer
                            join bbpmsoh.m_tujuan_pengujian c on c.iM_tujuan_pengujian=a.iM_tujuan_pengujian
                            where a.lDeleted=0 
                            and a.iMt01 = '".$iMt01."'

                    ";
                    $rsql = $this->db->query($qsql)->row_array();

                    $iAm = $this->whoAmI($this->user->gNIP);

                    $to = $rsql['cNip_requestor'] ;                        
                    $cc = $iAm['cNip'] ;

                    $sqlEmpAr = 'select * from bbpmsoh.sysparam a where a.vVariable="MAIL_SERTIFIKAT_APP"';
                    $dEmpAr =  $this->db->query($sqlEmpAr)->row_array();
                    $sq= $dEmpAr['vContent'];
                    $dataTO = $this->db->query($sq)->result_array();

                    $to = '0';
                    foreach ($dataTO as $toto) {
                        $to .=','.$toto['cNIP'];
                    }

                    $bccMail = 'select * from bbpmsoh.sysparam a where a.vVariable="MAIL_BCC"';
                    $dBcc =  $this->db->query($bccMail)->row_array();

                    $to = $to;
                    $cc = $this->user->gNIP.','.$dBcc['vContent'];

                    
                    $content="
                            <p>Diberitahukan bahwa ".$precontent." yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>
                            <br><br>  
                            <table border='1' style='width: 750px;border-collapse: collapse;'>
                                <tr>
                                        <td style='width: 30%;'><b>Nomor Transaksi</b></td>
                                        <td> : ".$rsql['vNo_transaksi']."</td>
                                </tr>

                                <tr>
                                        <td style='width: 30%;'><b>Nama Pemohon</b></td>
                                        <td> : ".$rsql['cNip'].' || '.$rsql['vName']."</td>
                                </tr>


                                <tr>
                                        <td><b>No Permintaan</b></td>
                                        <td> : ".$rsql['vNomor']."</td>
                                </tr> 
                                <tr>
                                        <td><b>Perihal</b></td>
                                        <td> :".$rsql['vPerihal']."</td>
                                </tr> 

                                <tr>
                                        <td><b>Nama Perusahaan</b></td>
                                        <td> :".$rsql['vName_company']."</td>
                                </tr> 

                                <tr>
                                        <td><b>Alamat</b></td>
                                        <td> : ".nl2br($rsql['vAddress_company'])."</td>
                                </tr>

                                <tr>
                                        <td><b>Nama Produsen</b></td>
                                        <td> :".$rsql['vNama_produsen']."</td>
                                </tr> 

                                <tr>
                                        <td><b>Alamat Produsen</b></td>
                                        <td> : ".nl2br($rsql['vAlamat_produsen'])."</td>
                                </tr>

                                <tr>
                                        <td><b>Tujuan Pengujian Mutu</b></td>
                                        <td> : ".$rsql['vNama_tujuan']."</td>
                                </tr>

                                <tr>
                                        <td><b>Nama Sample</b></td>
                                        <td> : ".$rsql['vNama_sample']."</td>
                                </tr>  
                                <tr>
                                        <td><b>Status</b></td>
                                        <td> : Approve</td>
                                </tr>

                                <tr>
                                        <td><b>Lokasi Modul</b></td>
                                        <td> e-Pengujian -> Transaksi -> MT8A</td>
                                </tr>
                                
                            </table> 

                        <br/> <br/>
                        Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>
                        Post Master"; 

                        $this->sess_auth->send_message_erp($this->uri->segment_array(),$to, $cc, $subject, $content);
                }

        }


        $data['group_id']=$post['group_id'];
        $data['modul_id']=$post['modul_id'];
        $data['status']  = true;
        $data['last_id'] = $post['last_id'];
        
        return json_encode($data);
    }

    function reject_view() {
        $echo = '<script type="text/javascript">
                     function submit_ajax(form_id) {
                        var remark = $("#reject_mt8a_vRemark").val();
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
                                var url = "'.base_url().'processor/pengujian/mt8a";                             
                                if(o.status == true) {
                                    
                                    $("#alert_dialog_form").dialog("close");
                                         $.get(url+"?action=view&id="+last_id+"&group_id="+o.group_id+"&modul_id="+o.modul_id, function(data) {
                                         $("div#form_mt8a").html(data);
                                    });
                                    
                                }
                                    reload_grid("grid_mt8a");
                            }
                            
                         })
                    
                     }
                 </script>';
        $echo .= '<h1>Reject</h1><br />';
        $echo .= '<form id="form_mt8a_reject" action="'.base_url().'processor/pengujian/mt8a?action=reject_process" method="post">';
        $echo .= '<div style="vertical-align: top;">';
        $echo .= 'Remark : 
                <input type="hidden" name="last_id" value="'.$this->input->get('last_id').'" />
                <input type="hidden" name="group_id" value="'.$this->input->get('group_id').'" />
                <input type="hidden" name="modul_id" value="'.$this->input->get('modul_id').'" />
                <textarea name="vRemark"></textarea>
        <button type="button" onclick="submit_ajax(\'form_mt8a_reject\')">Reject</button>';
            
        $echo .= '</div>';
        $echo .= '</form>';
        return $echo;
    }

    function reject_process () {
        $post = $this->input->post();
        $dataupdate['cUpdated']= $this->user->gNIP;
        $dataupdate['dUpdated']= date('Y-m-d H:i:s');
       	
       	$groupnya = $this->checkgroup($this->user->gNIP);             
       
       	 /*
            idprivi_group;vNamaGroup
            11 : QA
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
        $sqlgetMt1 = 'select * from bbpmsoh.mt08a a where a.iMt8a = "'.$post['last_id'].'"';
        $dmete1 = $this->db->query($sqlgetMt1)->row_array();
        $iMt01 = $dmete1['iMt01'];
        $subject = '';
        $qsql="
                select * 
                from bbpmsoh.mt01 a 
                join hrd.employee b on b.cNip=a.iCustomer
                join bbpmsoh.m_tujuan_pengujian c on c.iM_tujuan_pengujian=a.iM_tujuan_pengujian
                where a.lDeleted=0 
                and a.iMt01 = '".$iMt01."'

        ";
        $rsql = $this->db->query($qsql)->row_array();

         $dataupdate['iSubmit']= 0;
        if($groupnya['idprivi_group'] == 11){
     		/*QA*/
     		$dataupdate['cApprove_qa']= $this->user->gNIP;
	        $dataupdate['dApprove_qa']= date('Y-m-d H:i:s');
	        $dataupdate['vRemark_qa']= $post['vRemark'];
	        $dataupdate['iApprove_qa']= 1;

	        $subject = 'e-Pengujian -> Reject QA MT8A '.$rsql['vNo_transaksi'];
            $precontent = 'Admin QA telah melakukan Approval Pengujian MT8A';
	        

     	}else{
     		$dataupdate['cApprove']= $this->user->gNIP;
	        $dataupdate['dApprove']= date('Y-m-d H:i:s');
	        $dataupdate['vRemark']= $post['vRemark'];
	        $dataupdate['iApprove_unit_uji']= 1;
	        $dataupdate['iApprove_qa']= 1;
	        
     	}

        $updet = $this->db->where('iMt8a',$post['last_id'])->update('bbpmsoh.mt08a',$dataupdate);

        if($updet){
        		

                if($subject <> ""){
                    $qsql="
                            select * 
                            from bbpmsoh.mt01 a 
                            join hrd.employee b on b.cNip=a.iCustomer
                            join bbpmsoh.m_tujuan_pengujian c on c.iM_tujuan_pengujian=a.iM_tujuan_pengujian
                            where a.lDeleted=0 
                            and a.iMt01 = '".$iMt01."'

                    ";
                    $rsql = $this->db->query($qsql)->row_array();

                    $iAm = $this->whoAmI($this->user->gNIP);

                    $to = $rsql['cNip_requestor'] ;                        
                    $cc = $iAm['cNip'] ;

                    $sqlEmpAr = 'select * from bbpmsoh.sysparam a where a.vVariable="MAIL_SERTIFIKAT_APP"';
                    $dEmpAr =  $this->db->query($sqlEmpAr)->row_array();
                    $sq= $dEmpAr['vContent'];
                    $dataTO = $this->db->query($sq)->result_array();

                    $to = '0';
                    foreach ($dataTO as $toto) {
                        $to .=','.$toto['cNIP'];
                    }

                    $bccMail = 'select * from bbpmsoh.sysparam a where a.vVariable="MAIL_BCC"';
                    $dBcc =  $this->db->query($bccMail)->row_array();

                    $to = $to;
                    $cc = $this->user->gNIP.','.$dBcc['vContent'];

                    
                    $content="
                            <p>Diberitahukan bahwa ".$precontent." yang membutuhkan Follow up, dengan rincian sebagai berikut : <p>
                            <br><br>  
                            <table border='1' style='width: 750px;border-collapse: collapse;'>
                                <tr>
                                        <td style='width: 30%;'><b>Nomor Transaksi</b></td>
                                        <td> : ".$rsql['vNo_transaksi']."</td>
                                </tr>

                                <tr>
                                        <td style='width: 30%;'><b>Nama Pemohon</b></td>
                                        <td> : ".$rsql['cNip'].' || '.$rsql['vName']."</td>
                                </tr>


                                <tr>
                                        <td><b>No Permintaan</b></td>
                                        <td> : ".$rsql['vNomor']."</td>
                                </tr> 
                                <tr>
                                        <td><b>Perihal</b></td>
                                        <td> :".$rsql['vPerihal']."</td>
                                </tr> 

                                <tr>
                                        <td><b>Nama Perusahaan</b></td>
                                        <td> :".$rsql['vName_company']."</td>
                                </tr> 

                                <tr>
                                        <td><b>Alamat</b></td>
                                        <td> : ".nl2br($rsql['vAddress_company'])."</td>
                                </tr>

                                <tr>
                                        <td><b>Nama Produsen</b></td>
                                        <td> :".$rsql['vNama_produsen']."</td>
                                </tr> 

                                <tr>
                                        <td><b>Alamat Produsen</b></td>
                                        <td> : ".nl2br($rsql['vAlamat_produsen'])."</td>
                                </tr>

                                <tr>
                                        <td><b>Tujuan Pengujian Mutu</b></td>
                                        <td> : ".$rsql['vNama_tujuan']."</td>
                                </tr>

                                <tr>
                                        <td><b>Nama Sample</b></td>
                                        <td> : ".$rsql['vNama_sample']."</td>
                                </tr>  
                                <tr>
                                        <td><b>Status</b></td>
                                        <td> : Reject</td>
                                </tr>

                                <tr>
                                        <td><b>Lokasi Modul</b></td>
                                        <td> e-Pengujian -> Transaksi -> MT8A</td>
                                </tr>
                                
                            </table> 

                        <br/> <br/>
                        Demikian, mohon segera follow up  pada aplikasi e-Pengujian. Terimakasih.<br><br><br>
                        Post Master"; 

                        $this->sess_auth->send_message_erp($this->uri->segment_array(),$to, $cc, $subject, $content);
                }

        }


        $data['group_id']=$post['group_id'];
        $data['modul_id']=$post['modul_id'];
        $data['status']  = true;
        $data['last_id'] = $post['last_id'];
        
        return json_encode($data);
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

    function getDetailsReq() {
    	$term = $this->input->get('term');
    	$sql='select mt01.*,m_tujuan_pengujian.cKode from bbpmsoh.mt01
    			join bbpmsoh.m_tujuan_pengujian on m_tujuan_pengujian.iM_tujuan_pengujian=mt01.iM_tujuan_pengujian
				where mt01.iMt01 IN (select iMt01 from bbpmsoh.mt03 where iApprove_unit_uji=2 and lDeleted=0) 
				AND mt01.iMt01 NOT IN (select iMt01 from bbpmsoh.mt8a_detail where lDeleted=0)
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
    		,'mt8a_detail.lDeleted'=>0
    		);
    	$this->db->select("mt01.*,m_tujuan_pengujian.cKode,mt8a_detail.iMt8a_detail")
    				->from("bbpmsoh.mt8a_detail")
    				->join("bbpmsoh.mt01","mt01.iMt01=mt8a_detail.iMt01")
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
					$dataar[$z]="<input type='text' name='grid_details_nomor_request[".$k->iMt8a_detail."][]' id='grid_details_nomor_request_".$i."' value='".$k->vNomor."' class='get_sample_req required' size='25'><input type='hidden' name='grid_details_iMt01[".$k->iMt8a_detail."][]' id='grid_details_iMt01_".$i."' value='".$k->iMt01."' class='required' size='25'>";
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