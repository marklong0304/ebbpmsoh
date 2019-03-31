<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class mt07 extends MX_Controller {
    function __construct() {
        parent::__construct();
		 $this->load->library('auth');
        $this->db = $this->load->database('hrd',false, true);
        $this->user = $this->auth->user();

		$this->title = 'MT 07';
		$this->url = 'mt07';
		$this->urlpath = 'pengujian/'.str_replace("_","/", $this->url);

		$this->maintable = 'bbpmsoh.mt07';	
		$this->main_table = $this->maintable;	
		$this->main_table_pk = 'iMt07';	
		$datagrid['islist'] = array(
			'vKepada_yth' => array('label'=>'Kepada','width'=>300,'align'=>'left','search'=>true)
			,'iSubmit' => array('label'=>'Submit','width'=>150,'align'=>'left','search'=>true)
			//,'iApprove_unit_uji' => array('label'=>'Approval','width'=>150,'align'=>'left','search'=>true)
		);

		$datagrid['jointableinner']=array(
            0=>array('bbpmsoh.mt06'=>'mt06.iMt01=bbpmsoh.mt07.iMt01')
            );

		$datagrid['addFields']=array(
				'form_vKepada_yth'=>'Kepada Yth,'
				,'form_dTanggal'=>'Tanggal'
				,'form_sample_label'=>'Informasi Sample'
				,'form_sample'=>''
				);
		$datagrid['shortBy']=array('dUpdated'=>'Desc');
	
		$datagrid['setQuery']=array(
								0=>array('vall'=>'mt07.lDeleted','nilai'=>0)
								,1=>array('vall'=>'mt06.lDeleted','nilai'=>0)
								,1=>array('vall'=>'mt07.iSubmit','nilai'=>1)
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
			1;Administrator
			2;Admini Yanji
			3;Admin Biologik
			4;Admin Virologi
			5;Admin Farmastetik & Premiks
			6;Admin SPHU
			7;Customer


		*/

		$groupnya = $this->checkgroup($this->user->gNIP);  

		switch ($groupnya['idprivi_group']) {
		           	case '1':
		           	case '2':
		           		break;
		           	case '3':
		    			$grid->setQuery('mt06.iDist_bakteri',1);     
		           		break;

		           	case '4':
		           		$grid->setQuery('mt06.iDist_virologi',1);     
		           		break;

		           	case '5':
		           		$grid->setQuery('mt06.iDist_farmastetik',1);     
		           		break;
		           	
		           	default:
		           		# code...
		           		break;
		           }           
        



		$grid->changeFieldType('iSubmit', 'combobox','',array(''=>'--select--', 0=>'Draft', 1=>'Submit'));
		$grid->changeFieldType('iApprove_unit_uji', 'combobox','',array(''=>'--select--', 0=>'Waiting Approval', 1=>'Rejected', 2=>'Approved'));

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



	function output(){
    	$this->index($this->input->get('action'));
    }

    function manipulate_update_button($buttons, $rowData) {
         $cNip= $this->user->gNIP;
        $js = $this->load->view('js/standard_js');
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
            }/*elseif($rowData['iApprove_unit_uji']==0 && $rowData['iSubmit']==1){
                $buttons['update'] = $iframe.$approve.$reject;
            }*/
        }
        
        return $buttons;
    }

	function manipulate_insert_button($buttons){        
        $cNip= $this->user->gNIP;
        $js = $this->load->view('js/standard_js');
        $js .= $this->load->view('js/upload_js');

        $iframe = '<iframe name="'.$this->url.'_frame" id="'.$this->url.'_frame" height="0" width="0"></iframe>';
        
       $save_draft = '<button onclick="javascript:save_draft_btn_multiupload(\''.$this->url.'\', \' '.base_url().'processor/'.$this->urlpath.'?draft=true&company_id='.$this->input->get('company_id').'&group_id='.$this->input->get('group_id').'&modul_id='.$this->input->get('modul_id').'\',this,true )"  id="button_save_draft_'.$this->url.'"  class="ui-button-text icon-save" >Save as Draft</button>';
        $save = '<button onclick="javascript:save_btn_multiupload(\''.$this->url.'\', \' '.base_url().'processor/'.$this->urlpath.'?company_id='.$this->input->get('company_id').'&group_id='.$this->input->get('group_id').'&modul_id='.$this->input->get('modul_id').' \',this,true )"  id="button_save_submit_'.$this->url.'"  class="ui-button-text icon-save" >Save &amp; Submit</button>';

        $buttons['save'] = $iframe.$save_draft.$save.$js;
        
        return $buttons;
	}

	/*List Box*/
	 function listBox_Action($row, $actions) {
        if ($row->iApprove_unit_uji>0) { 
                unset($actions['edit']);
        }
        if ($row->iSubmit>0) { 
                unset($actions['delete']);
        }
        return $actions;
    }
	function listBox_mt07_iappqa_uji($value) {
		if($value==0){$vstatus='Waiting for approval';}
		elseif($value==1){$vstatus='Rejected';}
		elseif($value==2){$vstatus='Approved';}
		return $vstatus;
	}

	function listBox_mt07_ini_nilai($value, $pk, $name, $rowData) {
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
	function insertBox_mt07_form_vKepada_yth($field, $id) {
		$ff=str_replace("form_","", $field);
        $return = '<input type="text" name="'.$ff.'"  id="'.$id.'"  class="input_rows1 required" size="37"  />';
        $return .= '<input type="hidden" name="isdraft" id="isdraft" class="input_rows1 " size="30"  />';
        return $return;
    }

    function insertBox_mt07_form_dTanggal($field, $id) {
    	$ff=str_replace("form_","", $field);
        $return = '<input name="'.$ff.'" id="'.$id.'" type="text" size="20" class="input_tgl datepicker required" style="width:130px"/>';
        $return .=  '<script>
                            $("#'.$id.'").datepicker({dateFormat:"yy-mm-dd"});
                        
                    </script>';
        return $return;
    }

    function insertBox_mt07_form_DistribusiUnit($field, $id) {
    	$return = "<input type='checkbox' name='iDist_virologi' value='1' class='getDistribusiUnit' />Virologi <br /><input type='checkbox' class='getDistribusiUnit' name='iDist_bakteri' value='1' />Bakteriologi <br /><input type='checkbox' name='iDist_farmastetik' value='1' class='getDistribusiUnit' />Farmasetik dan Premiks<br /><input type='checkbox' name='iDist_patologi' class='getDistribusiUnit' value='1' />Patologi";
        return $return;
    }

   	function insertBox_mt07_form_sample_label($field, $id) {
		$return = '<script>
			$("label[for=\''.$id.'\']").css({"border": "1px solid #A3619D", "background-color": "#A3619D", "border-collapse": "collapse","width":"99%","font-weight":"bold","color":"#ffffff","text-shadow": "0 1px 1px rgba(0, 0, 0, 0.3)","text-transform": "uppercase", "text-align":"center"});
		</script>';
		return $return;
	}
	function insertBox_mt07_form_sample($field, $id) {
		
		$data["field"]=$field;
		$data["id"]=$id;
		$data["url"]=$this->url;
		$data["urlpath"]=$this->urlpath;
		$data["get"]=$this->input->get();
		$data["post"]=$this->input->post();
		$return=$this->load->view('grid/mt07_details',$data,TRUE);
		
		return $return;
	}

	function updateBox_mt07_form_vKepada_yth($field,$id,$value,$rowData){
		$ff=str_replace("form_","", $field);
		$value=isset($rowData[$ff])?$rowData[$ff]:"";
		$return = '<input type="text" name="'.$ff.'"  id="'.$id.'" value="'.$value.'"  class="input_rows1 required" size="37"  />';
        $return .= '<input type="hidden" name="isdraft" id="isdraft" class="input_rows1 " size="30"  />';
        return $return;
	}

	function updateBox_mt07_form_dTanggal($field,$id,$value,$rowData){
		$ff=str_replace("form_","", $field);
		$value=isset($rowData[$ff])?$rowData[$ff]:"";
         $return = '<input name="'.$ff.'" id="'.$id.'" type="text" size="20" class="input_tgl datepicker required" value="'.$value.'" style="width:130px"/>';
        $return .=  '<script>
                            $("#'.$id.'").datepicker({dateFormat:"yy-mm-dd"});
                        
                    </script>';
        return $return;
    }
    function updateBox_mt07_form_DistribusiUnit($field,$id,$value,$rowData){
    	$iDist_virologi=$rowData["iDist_virologi"]==1?"checked=''":"";
    	$iDist_bakteri=$rowData["iDist_bakteri"]==1?"checked=''":"";
    	$iDist_farmastetik=$rowData["iDist_farmastetik"]==1?"checked=''":"";
    	$iDist_patologi=$rowData["iDist_patologi"]==1?"checked=''":"";
		$return = "<input class='getDistribusiUnit' type='checkbox' name='iDist_virologi' ".$iDist_virologi." value='1' />Virologi <br /><input type='checkbox' class='getDistribusiUnit' name='iDist_bakteri' ".$iDist_bakteri." value='1' />Bakteriologi <br /><input type='checkbox' name='iDist_farmastetik' ".$iDist_farmastetik." value='1' class='getDistribusiUnit' />Farmasetik dan Premiks<br /><input type='checkbox' name='iDist_patologi' ".$iDist_patologi." value='1' class='getDistribusiUnit' />Patologi";
        return $return;
    }

    function updateBox_mt07_form_sample_label($field,$id,$value,$rowData){
		$return = '<script>
			$("label[for=\''.$id.'\']").css({"border": "1px solid #A3619D", "background-color": "#A3619D", "border-collapse": "collapse","width":"99%","font-weight":"bold","color":"#ffffff","text-shadow": "0 1px 1px rgba(0, 0, 0, 0.3)","text-transform": "uppercase", "text-align":"center"});
		</script>';
		return $return;
	}
	function updateBox_mt07_form_sample($field,$id,$value,$rowData){
		
		$data["field"]=$field;
		$data["id"]=$id;
		$data["url"]=$this->url;
		$data["urlpath"]=$this->urlpath;
		$data["get"]=$this->input->get();
		$data["post"]=$this->input->post();
		$data["pk"]=$rowData['iMt07'];
		$return=$this->load->view('grid/mt07_details',$data,TRUE);
		
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
    	
    }

    /*After Update*/
    function after_update_processor($fields, $id, $postData) {
    
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
                                        $.get(base_url+"processor/pengujian/mt07?action=view&id="+last_id+"&group_id="+o.group_id+"&modul_id="+o.modul_id, function(data) {
                                             $("div#form_mt07").html(data);
                                        });
                                    
                                }
                                    reload_grid("grid_mt07");
                            }
                            
                         })
                     }
                 </script>';
        $echo .= '<h1>Approval</h1><br />';
        $echo .= '<form id="form_mt07_approve" action="'.base_url().'processor/pengujian/mt07?action=approve_process" method="post">';
        $echo .= '<div style="vertical-align: top;">';
        $echo .= 'Remark : 
                <input type="hidden" name="last_id" value="'.$this->input->get('last_id').'" />
                <input type="hidden" name="group_id" value="'.$this->input->get('group_id').'" />
                <input type="hidden" name="modul_id" value="'.$this->input->get('modul_id').'" />
                <textarea name="vRemark"></textarea>
        <button type="button" onclick="submit_ajax(\'form_mt07_approve\')">Approve</button>';
            
        $echo .= '</div>';
        $echo .= '</form>';
        return $echo;
    }

    function approve_process(){
        $post = $this->input->post();
        $dataupdate['cUpdated']= $this->user->gNIP;
        $dataupdate['dUpdated']= date('Y-m-d H:i:s');
        $dataupdate['cApprove_unit_uji']= $this->user->gNIP;
        $dataupdate['dApprove_unit_uji']= date('Y-m-d H:i:s');
        $dataupdate['vRemark_unit_uji']= $post['vRemark'];
        $dataupdate['iApprove_unit_uji']= 2;
        $this->db->where('iMt07',$post['last_id'])
                    ->update('bbpmsoh.mt07',$dataupdate);

        $data['group_id']=$post['group_id'];
        $data['modul_id']=$post['modul_id'];
        $data['status']  = true;
        $data['last_id'] = $post['last_id'];
        
        return json_encode($data);
    }

    function reject_view() {
        $echo = '<script type="text/javascript">
                     function submit_ajax(form_id) {
                        var remark = $("#reject_mt07_vRemark").val();
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
                                var url = "'.base_url().'processor/pengujian/mt07";                             
                                if(o.status == true) {
                                    
                                    $("#alert_dialog_form").dialog("close");
                                         $.get(url+"?action=view&id="+last_id+"&group_id="+o.group_id+"&modul_id="+o.modul_id, function(data) {
                                         $("div#form_mt07").html(data);
                                    });
                                    
                                }
                                    reload_grid("grid_mt07");
                            }
                            
                         })
                    
                     }
                 </script>';
        $echo .= '<h1>Reject</h1><br />';
        $echo .= '<form id="form_mt07_reject" action="'.base_url().'processor/pengujian/mt07?action=reject_process" method="post">';
        $echo .= '<div style="vertical-align: top;">';
        $echo .= 'Remark : 
                <input type="hidden" name="last_id" value="'.$this->input->get('last_id').'" />
                <input type="hidden" name="group_id" value="'.$this->input->get('group_id').'" />
                <input type="hidden" name="modul_id" value="'.$this->input->get('modul_id').'" />
                <textarea name="vRemark"></textarea>
        <button type="button" onclick="submit_ajax(\'form_mt07_reject\')">Reject</button>';
            
        $echo .= '</div>';
        $echo .= '</form>';
        return $echo;
    }

    function reject_process () {
        $post = $this->input->post();
        $dataupdate['cUpdated']= $this->user->gNIP;
        $dataupdate['dUpdated']= date('Y-m-d H:i:s');
        $dataupdate['cApprove_unit_uji']= $this->user->gNIP;
        $dataupdate['dApprove_unit_uji']= date('Y-m-d H:i:s');
        $dataupdate['vRemark_unit_uji']= $post['vRemark'];
        $dataupdate['iApprove_unit_uji']= 1;
        $this->db->where('iMt07',$post['last_id'])
                    ->update('bbpmsoh.mt07',$dataupdate);
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
				where mt01.iMt01 IN (select iMt01 from bbpmsoh.mt06 where iApprove_sphu=2 and lDeleted=0) 
				AND mt01.iMt01 NOT IN (select iMt01 from bbpmsoh.mt07 where lDeleted=0)
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
    		,'mt07.lDeleted'=>0
    		);
    	$this->db->select("mt01.*,m_tujuan_pengujian.cKode,mt07.iMt07,mt07.vSuhu_penyimpanan,mt07.vKeterangan")
    				->from("bbpmsoh.mt07")
    				->join("bbpmsoh.mt01","mt01.iMt01=mt07.iMt01")
    				->join("bbpmsoh.m_tujuan_pengujian","m_tujuan_pengujian.iM_tujuan_pengujian=mt01.iM_tujuan_pengujian")
    				->where($where);
    	$q=$this->db->get(); 

		//$rsel=array('vNomor'=>'Nomor Pengujian','vNama_sample'=>'Nama Sample','vNama_produsen'=>'Produsen','vZat_aktif'=>'Zat Aktif / Strain','vNo_registrasi'=>'No. Registrasi','vBatch_lot'=>'No. Batch','dTgl_kadaluarsa'=>'Waktu Kadaluarsa','vKemasan'=>'Kemasan','iJumlah_diserahkan'=>'Jumlah Sample','cKode'=>'Keterangan');
		$rsel=array('vNomor'=>'Nomor Pengujian','vSuhu_penyimpanan'=>'Suhu Penyimpanan','vKeterangan'=>'Keterangan','vZat_aktif'=>'Zat Aktif / Strain','vBatch_lot'=>'No. Batch','dTgl_kadaluarsa'=>'Waktu Kadaluarsa','iJumlah_diserahkan'=>'Jumlah Sample');
		$data = new StdClass;
		$data->records=$q->num_rows();
		$i=0;
		$dataar=array();
		foreach ($q->result() as $k) {
			$data->rows[$i]['id']=$i;
			$z=0;
			foreach ($rsel as $dsel => $vsel) {
				if($dsel=="iAction"){
					$dataar[$z]="<a href='javascript:;' onclick='javascript:hapus_row_".$nmTable."(".$i.")'><center><span class='ui-icon ui-icon-trash'></span></center></a>";
				}elseif($dsel=="vNomor"){
					$dataar[$z]="<input type='hidden' class='num_rows_".$nmTable."' value='".$i."' /><input type='text' name='grid_details_nomor_request[".$k->iMt07."][]' id='grid_details_nomor_request_".$i."' value='".$k->vNomor."' class='get_sample_req_".$nmTable." required' size='25'><input type='hidden' name='".$this->url."_iMt01' id='grid_details_".$nmTable."_iMt01_".$i."' value='".$k->iMt01."' class='required' size='25'>";
				}elseif($dsel=="vSuhu_penyimpanan"){
					$dataar[$z]="<input type='hidden' class='num_rows_".$nmTable."' value='".$i."' /><input type='text' name='".$this->url."_vSuhu_penyimpanan' id='grid_details_".$nmTable."_vSuhu_penyimpanan_".$i."' value='".$k->vSuhu_penyimpanan."' class='required' size='25'>";
				}elseif($dsel=="vKeterangan"){
					$dataar[$z]="<input type='hidden' class='num_rows_".$nmTable."' value='".$i."' /><input type='text' name='".$this->url."_vKeterangan' id='grid_details_".$nmTable."_vKeterangan_".$i."' value='".$k->vKeterangan."' class='required' size='25'>";
				}else{
					$dataar[$z]="<p id='grid_".$nmTable."_".$dsel."_".$i."'>".$k->{$dsel}."</p>";
				}
				$z++;
			}
			$data->rows[$i]['cell']=$dataar;
			$i++;
		}
		return json_encode($data);
    }

}