<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class mt04 extends MX_Controller {
    function __construct() {
        parent::__construct();
		 $this->load->library('auth');
        $this->db = $this->load->database('hrd',false, true);
        $this->user = $this->auth->user();

		$this->title = 'MT 04';
		$this->url = 'mt04';
		$this->urlpath = 'pengujian/'.str_replace("_","/", $this->url);

		$this->maintable = 'bbpmsoh.mt04';	
		$this->main_table = $this->maintable;	
		$this->main_table_pk = 'iMt04';	
		$datagrid['islist'] = array(
			'mt01.vNo_transaksi' => array('label'=>'No Request','width'=>100,'align'=>'center','search'=>true)
			,'mt01.vNama_produsen' => array('label'=>'Produsen','width'=>200,'align'=>'left','search'=>true)
			,'mt01.vNama_sample' => array('label'=>'Nama Sample','width'=>300,'align'=>'left','search'=>true)
			/*,'dTgl_terima_sample' => array('label'=>'Tgl Terima Sample','width'=>150,'align'=>'center','search'=>false)
			,'dTgl_terima_serum' => array('label'=>'Tgl Terima Antiserum','width'=>150,'align'=>'center','search'=>false)*/
			,'iSubmit' => array('label'=>'Submit','width'=>150,'align'=>'left','search'=>true)
			,'iApprove' => array('label'=>'Approval','width'=>150,'align'=>'left','search'=>true)
		);

		$datagrid['addFields']=array(
				'iMt01'=>'No Request'
				
				,'vNama_perusahaan'=>'Nama Perusahaan'
				,'vAlamat_perusahaan'=>'Alamat Perusahaan'
				,'vTelepon_perusahaan'=>'Telp'
				,'vNama_sample'=>'Nama Sample'
				,'dTgl_terima_sample'=>'Tanggal Terima Sample'
				,'dTgl_terima_serum'=>'Tanggal Penerimaan Sample '
				,'form_sample_label'=>'Tanda Terima Standar/Antigen/Antiserum'
				,'form_sample'=>''
				);
		$datagrid['shortBy']=array('dUpdated'=>'Desc');
	
		$datagrid['setQuery']=array(
								0=>array('vall'=>'mt04.lDeleted','nilai'=>0)
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

		$grid->setJoinTable('bbpmsoh.mt01', 'mt01.iMt01 = bbpmsoh.mt04.iMt01', 'inner');

		$grid->changeFieldType('iSubmit', 'combobox','',array(''=>'--select--', 0=>'Draft', 1=>'Submit'));
		$grid->changeFieldType('iApprove', 'combobox','',array(''=>'--select--', 0=>'Waiting Approval', 1=>'Rejected', 2=>'Approved'));

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
            case 'GetDataIM01':
                $where=array('mt01.lDeleted'=>0,'mt01.iMt01'=>$this->input->post('id'));
                $this->db->select('mt01.*,m_tujuan_pengujian.vNama_tujuan')
                    ->from('bbpmsoh.mt01')
                    ->join('bbpmsoh.m_tujuan_pengujian','m_tujuan_pengujian.iM_tujuan_pengujian=bbpmsoh.mt01.iM_tujuan_pengujian')
                    ->join('hrd.employee','employee.cNip=bbpmsoh.mt01.iCustomer')
                    ->where($where);
                $row=$this->db->get()->row_array();
                echo json_encode($row);
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

    function listBox_Action($row, $actions) {
        if ($row->iApprove>0) { 
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

    function insertBox_mt04_iMt01($field, $id) {
        $ff=str_replace("form_","", $field);
        $where=array('lDeleted'=>0,'iApprove'=>2);
        $this->db->select('*')
            ->from('bbpmsoh.mt01')
            ->where($where)
            ->where('mt01.iMt01 not in (select iMt01 from bbpmsoh.mt04 where lDeleted=0)');
        $row=$this->db->get()->result_array();
        $return='<select id="'.$id.'" name="'.$ff.'" class="required">';
        $return.='<option value="">---Pilih---</option>';
        foreach ($row as $kk => $vv) {
        $return.='<option value="'.$vv['iMt01'].'">'.$vv['vAntiserum'].'</option>';
        }
        $return.='</select>';
        $return.='<script>';
        $return.='$("#'.$id.'").change(function(){
            $.ajax({
                url: base_url+"processor/pengujian/mt04?action=GetDataIM01",
                type: "post",
                data: {
                    id: $(this).val(),
                },
                success: function( data ) {
                    var o = $.parseJSON(data);
                    $("#mt04_vNama_sample").val(o.vNama_produsen);
                    $("#mt04_vNama_perusahaan").val(o.vName_company);
                    $("#mt04_vAlamat_perusahaan").val(o.vAddress_company);
                    $("#mt04_vTelepon_perusahaan").val(o.vTelepon_company);
                    
                }
            });
        })';
        $return.='</script>';
        $return .= '<input type="hidden" name="isdraft" id="isdraft" class="input_rows1 " size="30"  />';
        // $return=$this->db->last_query();
        return $return;
    }

    function updateBox_mt04_iMt01($field,$id,$value,$rowData){
        $ff=str_replace("form_","", $field);
        $where=array('lDeleted'=>0,'iApprove'=>2);
        $this->db->select('*')
            ->from('bbpmsoh.mt01')
            ->where($where)
            ->where('bbpmsoh.mt01.iMt01 NOT IN (select iMt01 from bbpmsoh.mt04 where lDeleted=0 AND iMt01 !='.$value.' )');
        $row=$this->db->get()->result_array();
        $return='<select id="'.$id.'" name="'.$ff.'" class="required">';
        $return.='<option value="">---Pilih---</option>';
        foreach ($row as $kk => $vv) {
            $select=$value==$vv['iMt01']?'selected':'';
            if($value==$vv['iMt01']){
                $value=$vv['vAntiserum'];
            }
            $return.='<option value="'.$vv['iMt01'].'" '.$select.' >'.$vv['vAntiserum'].'</option>';
        }
        $return.='</select>';
        $return.='<script>';
        $return.='$("#'.$id.'").change(function(){
            $.ajax({
                url: base_url+"processor/pengujian/mt04?action=GetDataIM01",
                type: "post",
                data: {
                    id: $(this).val(),
                },
                success: function( data ) {
                    var o = $.parseJSON(data);
                    $("#mt04_vNama_sample").val(o.vNama_produsen);
                    $("#mt04_vNama_perusahaan").val(o.vName_company);
                    $("#mt04_vAlamat_perusahaan").val(o.vAddress_company);
                    $("#mt04_vTelepon_perusahaan").val(o.vTelepon_company);
                }
            });
        })';
        $return.='</script>';
        $return .= '<input type="hidden" name="isdraft" id="isdraft" class="input_rows1 " size="30"  />';
        if($this->input->get('action')=='view'){
            $return=$value;
        }
        // $return=$this->db->last_query();
        return $return;
    }




    function insertBox_mt04_vNama_perusahaan($field, $id) {
        $ff=str_replace("form_","", $field);
        $return = '<input type="text" name="'.$ff.'" id="'.$id.'" value="" readonly="readonly">';
        return $return;
    }

    function updateBox_mt04_vNama_perusahaan($field,$id,$value,$rowData){
        $ff=str_replace("form_","", $field);
        $return = '<input type="text" name="'.$ff.'" id="'.$id.'" value="'.$value.'" readonly="readonly">';
        if($this->input->get('action')=='view'){
            $return=$value;
        }
        return $return;
    }

    function insertBox_mt04_vAlamat_perusahaan($field, $id) {
        $ff=str_replace("form_","", $field);
        $return = '<input type="text" name="'.$ff.'" id="'.$id.'" value="" readonly="readonly">';
        return $return;
    }

    function updateBox_mt04_vAlamat_perusahaan($field,$id,$value,$rowData){
        $ff=str_replace("form_","", $field);
        $return = '<input type="text" name="'.$ff.'" id="'.$id.'" value="'.$value.'" readonly="readonly">';
        if($this->input->get('action')=='view'){
            $return=$value;
        }
        return $return;
    }

    function insertBox_mt04_vTelepon_perusahaan($field, $id) {
        $ff=str_replace("form_","", $field);
        $return = '<input type="text" name="'.$ff.'" id="'.$id.'" value="" readonly="readonly">';
        return $return;
    }

    function updateBox_mt04_vTelepon_perusahaan($field,$id,$value,$rowData){
        $ff=str_replace("form_","", $field);
        $return = '<input type="text" name="'.$ff.'" id="'.$id.'" value="'.$value.'" readonly="readonly">';
        if($this->input->get('action')=='view'){
            $return=$value;
        }
        return $return;
    }


    function insertBox_mt04_vNama_sample($field, $id) {
        $ff=str_replace("form_","", $field);
        $return = '<input type="text" name="'.$ff.'" id="'.$id.'" value="" readonly="readonly">';
        return $return;
    }

    function updateBox_mt04_vNama_sample($field,$id,$value,$rowData){
        $ff=str_replace("form_","", $field);
        $return = '<input type="text" name="'.$ff.'" id="'.$id.'" value="'.$value.'" readonly="readonly">';
        if($this->input->get('action')=='view'){
            $return=$value;
        }
        return $return;
    }



    function manipulate_update_button($buttons, $rowData) {
         $cNip= $this->user->gNIP;
        $js = $this->load->view('js/mt04_js');
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
            if($rowData['iApprove']==0 && $rowData['iSubmit']==0){
                $buttons['update'] = $iframe.$update_draft.$update.$js;    
            }elseif($rowData['iApprove']==0 && $rowData['iSubmit']==1){
                $buttons['update'] = $iframe.$approve.$reject;
            }
        }
        
        return $buttons;
    }

	function manipulate_insert_button($buttons){        
        $cNip= $this->user->gNIP;
        $js = $this->load->view('js/mt04_js');
        $js .= $this->load->view('js/upload_js');

        $iframe = '<iframe name="'.$this->url.'_frame" id="'.$this->url.'_frame" height="0" width="0"></iframe>';
        
       $save_draft = '<button onclick="javascript:save_draft_btn_multiupload(\''.$this->url.'\', \' '.base_url().'processor/'.$this->urlpath.'?draft=true&company_id='.$this->input->get('company_id').'&group_id='.$this->input->get('group_id').'&modul_id='.$this->input->get('modul_id').'\',this,true )"  id="button_save_draft_'.$this->url.'"  class="ui-button-text icon-save" >Save as Draft</button>';
        $save = '<button onclick="javascript:save_btn_multiupload(\''.$this->url.'\', \' '.base_url().'processor/'.$this->urlpath.'?company_id='.$this->input->get('company_id').'&group_id='.$this->input->get('group_id').'&modul_id='.$this->input->get('modul_id').' \',this,true )"  id="button_save_submit_'.$this->url.'"  class="ui-button-text icon-save" >Save &amp; Submit</button>';

        $buttons['save'] = $iframe.$save_draft.$save.$js;
        
        return $buttons;
	}

	/*List Box*/
	function listBox_mt04_iappqa_uji($value) {
		if($value==0){$vstatus='Waiting for approval';}
		elseif($value==1){$vstatus='Rejected';}
		elseif($value==2){$vstatus='Approved';}
		return $vstatus;
	}

	function listBox_mt04_ini_nilai($value, $pk, $name, $rowData) {
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
	function insertBox_mt04_dTgl_terima_sample($field, $id) {
		$return = '<input name="'.$id.'" id="'.$id.'" type="text" size="20" class="input_tgl datepicker required" style="width:100px"/>';
	        $return .=  '<script>
	                        $("#'.$id.'").datepicker({dateFormat:"yy-mm-dd"});
	                    </script>';
        return $return;
    }

    function updateBox_mt04_dTgl_terima_sample($field, $id, $value, $rowData) {
        $return = '<input value="'.$value.'" name="'.$id.'" id="'.$id.'" type="text" size="20" class="input_tgl datepicker required" style="width:100px"/>';
        $return .=  '<script>
                        $("#'.$id.'").datepicker({dateFormat:"yy-mm-dd"});
                    </script>';
        if($this->input->get('action')=='view'){
            $return=$value;
        }
        return $return;
    }



    function insertBox_mt04_dTgl_terima_serum($field, $id) {
		$return = '<input name="'.$id.'" id="'.$id.'" type="text" size="20" class="input_tgl datepicker required" style="width:100px"/>';
	        $return .=  '<script>
	                        $("#'.$id.'").datepicker({dateFormat:"yy-mm-dd"});
	                    </script>';
        return $return;
    }

    function updateBox_mt04_dTgl_terima_serum($field, $id, $value, $rowData) {
        $return = '<input value="'.$value.'" name="'.$id.'" id="'.$id.'" type="text" size="20" class="input_tgl datepicker required" style="width:100px"/>';
        $return .=  '<script>
                        $("#'.$id.'").datepicker({dateFormat:"yy-mm-dd"});
                    </script>';
        if($this->input->get('action')=='view'){
            $return=$value;
        }
        return $return;
    }


   	function insertBox_mt04_form_sample_label($field, $id) {
		$return = '<script>
			$("label[for=\''.$id.'\']").css({"border": "1px solid #A3619D", "background-color": "#A3619D", "border-collapse": "collapse","width":"99%","font-weight":"bold","color":"#ffffff","text-shadow": "0 1px 1px rgba(0, 0, 0, 0.3)","text-transform": "uppercase", "text-align":"center"});
		</script>';
		return $return;
	}
	function insertBox_mt04_form_sample($field, $id) {
		
		$data["field"]=$field;
		$data["id"]=$id;
		$data["url"]=$this->url;
		$data["urlpath"]=$this->urlpath;
		$data["get"]=$this->input->get();
		$data["post"]=$this->input->post();
		$return=$this->load->view('grid/mt04_details',$data,TRUE);
		
		return $return;
	}

	

	function updateBox_mt04_form_vAlamat($field,$id,$value,$rowData){
		$ff=str_replace("form_","", $field);
		$value=isset($rowData[$ff])?$rowData[$ff]:"";
        $return = '<textarea id="'.$id.'" name="'.$ff.'" class="required">'.$value.'</textarea>';
        return $return;
    }

    function updateBox_mt04_form_sample_label($field,$id,$value,$rowData){
		$return = '<script>
			$("label[for=\''.$id.'\']").css({"border": "1px solid #A3619D", "background-color": "#A3619D", "border-collapse": "collapse","width":"99%","font-weight":"bold","color":"#ffffff","text-shadow": "0 1px 1px rgba(0, 0, 0, 0.3)","text-transform": "uppercase", "text-align":"center"});
		</script>';
		return $return;
	}
	function updateBox_mt04_form_sample($field,$id,$value,$rowData){
		
		$data["field"]=$field;
		$data["id"]=$id;
		$data["url"]=$this->url;
		$data["urlpath"]=$this->urlpath;
		$data["get"]=$this->input->get();
		$data["post"]=$this->input->post();
		$data["pk"]=$rowData['iMt04'];
		$return=$this->load->view('grid/mt04_details',$data,TRUE);
		
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
        return $postData;
    }

    /*After Insert*/
    function after_insert_processor($fields, $id, $postData) {
    	$post=$this->input->post();
    	foreach ($post as $kp => $vp) {
    		if($kp=="grid_details_iMt01"){
    			foreach ($vp as $key => $value) {
    				if($key==0){
    					foreach ($value as $kdet => $nilai) {
		    				$datainsert=array();
			    			$datainsert['iMt04']=$id;
			    			$datainsert['iMt01']=$nilai;
			    			$datainsert['dCreated']=date("Y-m-d H:i:s");
		    				$datainsert['cCreated']=$this->user->gNIP;
		    				$this->db->insert('bbpmsoh.mt04_detail',$datainsert);
    					}
    				}
    			}
    		}
    	}
    }

    /*After Update*/
    function after_update_processor($fields, $id, $postData) {
    	$post=$this->input->post();
	    $din=array();
	    $dup=array();
	    $pkid=array();
    	foreach ($post as $kp => $vp) {
    		if($kp=="grid_details_iMt01"){
    			foreach ($vp as $key => $value) {
    				if($key==0){
    					foreach ($value as $kdet => $nilai) {
    						$din[$kdet]=$nilai;
    					}
    				}else{
    					$pkid[]=$key;
    					$dup[$key]=$value[0];
    				}
    			}
    		}
    	}

    	/*Insert Baru*/
    	$this->db->where("iMt04",$id);
    	if(count($pkid)>0){
    		$this->db->where_not_in("iMt04_detail",$pkid);
    	}
    	$dataupdate=array("lDeleted"=>1,"cUpdated"=>$this->user->gNIP,"dUpdated"=>date("Y-m-d H:i:s"));
    	$this->db->update("bbpmsoh.mt04_detail",$dataupdate);

    	if(count($dup)>0){
    		foreach ($dup as $kup => $vup) {
    			$dataupdate2=array();
    			$dataupdate2["cUpdated"]=$this->user->gNIP;
    			$dataupdate2["dUpdated"]=date("Y-m-d H:i:s");
    			$dataupdate2["iMt01"]=$vup;
    			$this->db->where("iMt04_detail",$kup);
    			$this->db->update("bbpmsoh.mt04_detail",$dataupdate2);
    		}
    	}
    	if(count($din)>0){
	    	foreach ($din as $kin => $val) {
	    		$datainsert=array();
				$datainsert['iMt04']=$id;
				$datainsert['iMt01']=$val;
				$datainsert['dCreated']=date("Y-m-d H:i:s");
				$datainsert['cCreated']=$this->user->gNIP;
				$this->db->insert('bbpmsoh.mt04_detail',$datainsert);
	    	}
	    }
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
                                        $.get(base_url+"processor/pengujian/mt04?action=view&id="+last_id+"&group_id="+o.group_id+"&modul_id="+o.modul_id, function(data) {
                                             $("div#form_mt04").html(data);
                                        });
                                    
                                }
                                    reload_grid("grid_mt04");
                            }
                            
                         })
                     }
                 </script>';
        $echo .= '<h1>Approval</h1><br />';
        $echo .= '<form id="form_mt04_approve" action="'.base_url().'processor/pengujian/mt04?action=approve_process" method="post">';
        $echo .= '<div style="vertical-align: top;">';
        $echo .= 'Remark : 
                <input type="hidden" name="last_id" value="'.$this->input->get('last_id').'" />
                <input type="hidden" name="group_id" value="'.$this->input->get('group_id').'" />
                <input type="hidden" name="modul_id" value="'.$this->input->get('modul_id').'" />
                <textarea name="vRemark"></textarea>
        <button type="button" onclick="submit_ajax(\'form_mt04_approve\')">Approve</button>';
            
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
        $dataupdate['iApprove']= 2;
        $this->db->where('iMt04',$post['last_id'])
                    ->update('bbpmsoh.mt04',$dataupdate);

        $data['group_id']=$post['group_id'];
        $data['modul_id']=$post['modul_id'];
        $data['status']  = true;
        $data['last_id'] = $post['last_id'];
        
        return json_encode($data);
    }

    function reject_view() {
        $echo = '<script type="text/javascript">
                     function submit_ajax(form_id) {
                        var remark = $("#reject_mt04_vRemark").val();
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
                                var url = "'.base_url().'processor/pengujian/mt04";                             
                                if(o.status == true) {
                                    
                                    $("#alert_dialog_form").dialog("close");
                                         $.get(url+"?action=view&id="+last_id+"&group_id="+o.group_id+"&modul_id="+o.modul_id, function(data) {
                                         $("div#form_mt04").html(data);
                                    });
                                    
                                }
                                    reload_grid("grid_mt04");
                            }
                            
                         })
                    
                     }
                 </script>';
        $echo .= '<h1>Reject</h1><br />';
        $echo .= '<form id="form_mt04_reject" action="'.base_url().'processor/pengujian/mt04?action=reject_process" method="post">';
        $echo .= '<div style="vertical-align: top;">';
        $echo .= 'Remark : 
                <input type="hidden" name="last_id" value="'.$this->input->get('last_id').'" />
                <input type="hidden" name="group_id" value="'.$this->input->get('group_id').'" />
                <input type="hidden" name="modul_id" value="'.$this->input->get('modul_id').'" />
                <textarea name="vRemark"></textarea>
        <button type="button" onclick="submit_ajax(\'form_mt04_reject\')">Reject</button>';
            
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
        $dataupdate['iApprove']= 1;
        $this->db->where('iMt04',$post['last_id'])
                    ->update('bbpmsoh.mt04',$dataupdate);
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
				where mt01.iMt01 IN (select iMt01 from bbpmsoh.mt03 where iApprove=2 and lDeleted=0) 
				AND mt01.iMt01 NOT IN (select iMt01 from bbpmsoh.mt04_detail where lDeleted=0)
				AND mt01.vAntiserum like "%'.$term.'%" and mt01.lDeleted=0 order by vAntiserum ASC';
    	$dt=$this->db->query($sql);
    	$data = array();
    	if($dt->num_rows>0){
    		foreach($dt->result_array() as $line) {
	
				$row_array['value'] = trim($line['vAntiserum']);
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
    		,'mt04_detail.lDeleted'=>0
    		);
    	$this->db->select("*")
    				->from("bbpmsoh.mt04_detail")
    				->where($where);
    	$q=$this->db->get(); 

		$rsel=array('iAction'=>'Del','vAntiserum'=>'Nama Standar/Antigen/Antiserum','vKadar'=>'Nama Sample','vAsal'=>'Produsen','vBatch'=>'Zat Aktif / Strain','dTgl_expired'=>'No. Registrasi','vJumlah'=>'No. Batch','vKeterangan'=>'Waktu Kadaluarsa');
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
				}elseif($dsel=="vAntiserum"){
					$dataar[$z]="<input type='text' name='grid_details_nomor_request[".$k->iMt04_detail."][]' id='grid_details_nomor_request_".$i."' value='".$k->vAntiserum."' class='get_sample_req required' size='25'><input type='hidden' name='grid_details_iMt01[".$k->iMt04_detail."][]' id='grid_details_iMt01_".$i."' value='".$k->iMt01."' class='required' size='25'>";
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