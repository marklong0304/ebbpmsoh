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

        $this->report    = $this->load->library('report');
        $url             = $_SERVER['HTTP_REFERER'];
        $company_id      = substr($url, strrpos($url, '/') + 1);
        $this->masterUrl = base_url()."processor/pengujian/mt04?company_id={$this->input->get('company_id')}";



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
		);



		$datagrid['addFields']=array(
				'iMt01'=>'No Request'
				
				,'vNama_perusahaan'=>'Nama Perusahaan'
				,'vAlamat_perusahaan'=>'Alamat Perusahaan'
				,'vTelepon_perusahaan'=>'Telp'
				,'vNama_sample'=>'Nama Sample'
				,'dTgl_terima_sample'=>'Tanggal Penerimaan Sample'
				,'dTgl_terima_serum'=>'Tanda Terima Standar/Antigen/Antiserum'
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

            case 'getDataMemo':
                echo $this->getDataMemo();
                break;
			case 'createproses':
   				echo $grid->saved_form();
                /*$post=$this->input->post();print_r($post);exit();
                $datah=array();
                $datah['iMt01']=$post['iMt01'];
                $datah['dTgl_terima_sample']=$post['mt04_dTgl_terima_sample'];
                $datah['dTgl_terima_serum']=$post['mt04_dTgl_terima_serum'];
                $datah['iSubmit']=$post['isdraft']==TRUE?0:1;
                $this->db->insert('bbpmsoh.mt04',$datah);
                $last_id=$this->db->insert_id();
                foreach ($post['mt04_iMt04_detail'] as $k => $vr) {
                    if($k==0){
                        foreach ($vr as $kvrd => $vrdet) {
                            $datad=array();
                            $datad['iMt04']=$last_id;
                            $datad['vAntiserum']=$post['mt04_vAntiserum'][$k][$kvrd];
                            $datad['vKadar']=$post['mt04_vAntiserum'][$k][$kvrd];
                            $datad['vAsal']=$post['mt04_vAsal'][$k][$kvrd];
                            $datad['vBatch']=$post['mt04_vBatch'][$k][$kvrd];
                            $datad['dTgl_expired']=$post['mt04_dTgl_expired'][$k][$kvrd];
                            $datad['vJumlah']=$post['mt04_vJumlah'][$k][$kvrd];
                            $datad['vKeterangan']=$post['mt04_vKeterangan'][$k][$kvrd];
                            $datad['cCreated']=$this->user->gNIP;
                            $datad['dCreated']=date("Y-m-d H:i:s");
                            $this->db->insert("bbpmsoh.mt04_detail",$datad);
                        }
                    }
                }
                $data['status']=TRUE;
                $data['last_id']=$last_id;
                $data['message']='data Berhasil di Update';
                echo json_encode($data);*/
				break;
			case 'update':
				$grid->render_form($this->input->get('id'));
				break;
			case 'view':
				$grid->render_form($this->input->get('id'),TRUE);
				break;
			case 'updateproses':
                $post=$this->input->post();
                $iddet=array();
                foreach ($post['mt04_iMt04_detail'] as $k => $vr) {
                    if($k!=0){
                        $iddet[]=$k;
                    }
                }
                if(count($iddet)>0){
                    $this->db->where_not_in('iMt04_detail',$iddet);
                    $this->db->update('bbpmsoh.mt04_detail',array('lDeleted'=>1));
                }else{
                    $this->db->where('iMt04',$this->input->post('mt04_iMt04'));
                    $this->db->update('bbpmsoh.mt04_detail',array('lDeleted'=>1));
                }
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
                $this->db->select('mt01.*,m_tujuan_pengujian.vNama_tujuan,employee.*')
                    ->from('bbpmsoh.mt01')
                    ->join('bbpmsoh.m_tujuan_pengujian','m_tujuan_pengujian.iM_tujuan_pengujian=bbpmsoh.mt01.iM_tujuan_pengujian')
                    ->join('hrd.employee','employee.cNip=bbpmsoh.mt01.iCustomer','left')
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

    function getDataMemo() {

        $id   = $this->input->post('id');   
        //echo $id; exit;   
        $data = array();

        $sql = "select a.*,b.*,b1.vnomor_03,c.*,b2.*
        from bbpmsoh.mt01 a
        left join bbpmsoh.mt03 b1 on b1.iMt01 = a.iMt01
        join bbpmsoh.mt04 b on b.iMt01 = a.iMt01
        join bbpmsoh.mt04_detail b2 on b2.iMt04 = b.iMt04
        left join hrd.employee c on c.cNip = a.iCustomer
        join bbpmsoh.m_tujuan_pengujian d on d.iM_tujuan_pengujian=a.iM_tujuan_pengujian
        WHERE b.iMt04 = '{$id}'";

       /* echo '<pre>'.$sql;
        exit;*/
        $query = $this->db->query($sql);

        foreach ($query->result() as $row) {
            
            

            $tanggal = $row->dtanggal_03;
            function tanggal_indo($tanggal, $cetak_hari = false)
            {
                $hari = array ( 1 =>    'Senin',
                            'Selasa',
                            'Rabu',
                            'Kamis',
                            'Jumat',
                            'Sabtu',
                            'Minggu'
                        );
                        
                $bulan = array (1 =>   'Januari',
                            'Februari',
                            'Maret',
                            'April',
                            'Mei',
                            'Juni',
                            'Juli',
                            'Agustus',
                            'September',
                            'Oktober',
                            'November',
                            'Desember'
                        );
                $split    = explode('-', $tanggal);
                $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
                
                if ($cetak_hari) {
                    $num = date('N', strtotime($tanggal));
                    return $hari[$num];
                }
                return $tgl_indo;
            }
            
            

            /*hrd*/
            $row_array['vName_company']    = ucwords(strtolower($row->vName_company));
            $row_array['vAddress_company']    = ucwords(strtolower($row->vAddress_company));
            $row_array['vTelepon_company']    = ucwords(strtolower($row->vTelepon_company));

            /*mt01*/
            $row_array['vNama_sample']     = ucwords(strtolower($row->vNama_sample));

            /*mt03*/
            $row_array['vnomor_03']     = ucwords(strtolower($row->vnomor_03));
            $row_array['dtanggal_03']            = tanggal_indo($row->dtanggal_03, false);

            /*mt04*/
            $row_array['dTgl_terima_sample']      = tanggal_indo($row->dTgl_terima_sample, false);
            $row_array['dTgl_terima_serum']      = tanggal_indo($row->dTgl_terima_serum, false);

            /*mt4 detail*/
            $row_array['vAntiserum']     = ucwords(strtolower($row->vAntiserum));
            $row_array['vKadar']     = ucwords(strtolower($row->vKadar));
            $row_array['vAsal']     = ucwords(strtolower($row->vAsal));
            $row_array['vBatch']     = ucwords(strtolower($row->vBatch));
            $row_array['dTgl_expired']      = tanggal_indo($row->dTgl_expired, false);
            $row_array['vJumlah']     = ucwords(strtolower($row->vJumlah));
            $row_array['vKeterangan']     = ucwords(strtolower($row->vKeterangan));



            array_push($data, $row_array);
        }

        echo json_encode($data);
    }

    function listBox_Action($row, $actions) {
        /*if ($row->iApprove>0) { 
                
        }*/
        if ($row->iSubmit>0) { 
            unset($actions['edit']);
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
            $return.='<option value="'.$vv['iMt01'].'">'.$vv['vNo_transaksi'].' - '.$vv['vNomor'].'</option>';
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
                    $("#mt04_vNama_sample").val(o.vNama_sample);
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
            $return.='<option value="'.$vv['iMt01'].'" '.$select.' >'.$vv['vNo_transaksi'].' - '.$vv['vNomor'].'</option>';
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
            $emte1=$this->getMT01($rowData['iMt01']);;
            $return = $emte1['vNo_transaksi'];
        }
        // $return=$this->db->last_query();
        return $return;
    }

    function getMT01($id){
        $sql= 'select * from bbpmsoh.mt01 a where a.lDeleted=0 and a.iMt01= "'.$id.'"';
        $dMt01 = $this->db->query($sql)->row_array();
        return $dMt01;
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
        $return = '<textarea name="'.$field.'" readonly="readonly" id="'.$id.'" class="required" style="width: 240px; height: 75px;" size="250" maxlength ="250"></textarea>';
        return $return;
    }
    
    function updateBox_mt04_vAlamat_perusahaan($field, $id, $value, $rowData) {
            if ($this->input->get('action') == 'view') {
                 $return= '<label title="Note">'.nl2br($value).'</label>'; 
            }else{ 
                $return = '<textarea name="'.$field.'" readonly="readonly" id="'.$id.'" class="required" style="width: 240px; height: 75px;" size="250" maxlength ="250">'.nl2br($value).'</textarea>';

            }
            
        return $return;
    }


    /*function insertBox_mt04_vAlamat_perusahaan($field, $id) {
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
    }*/

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
        $peka=$rowData['iMt04'];
         $cNip= $this->user->gNIP;
        $js = $this->load->view('js/mt04_js');
        $js .= $this->load->view('js/upload_js');

        $iframe = '<iframe name="'.$this->url.'_frame" id="'.$this->url.'_frame" height="0" width="0"></iframe>';
        
       
        $update_draft = '<button onclick="javascript:update_draft_btn(\''.$this->url.'\', \' '.base_url().'processor/'.$this->urlpath.'?draft=true&company_id='.$this->input->get('company_id').'&group_id='.$this->input->get('group_id').'&modul_id='.$this->input->get('modul_id').'\',this,true )"  id="button_update_draft_'.$this->url.'"  class="ui-button-text icon-save" >Update as Draft</button>';
        $update = '<button onclick="javascript:update_btn_back(\''.$this->url.'\', \' '.base_url().'processor/'.$this->urlpath.'?company_id='.$this->input->get('company_id').'&group_id='.$this->input->get('group_id').'&modul_id='.$this->input->get('modul_id').' \',this,true )"  id="button_update_submit_'.$this->url.'"  class="ui-button-text icon-save" >Update &amp; Submit</button>';
        $approve = '<button onclick="javascript:load_popup(\' '.base_url().'processor/'.$this->urlpath.'?action=approve&last_id='.$this->input->get('id').'&company_id='.$this->input->get('company_id').'&group_id='.$this->input->get('group_id').'&modul_id='.$this->input->get('modul_id').' \')"  id="button_approve_'.$this->url.'"  class="ui-button-text icon-save" >Approve</button>';
        $reject = '<button onclick="javascript:load_popup(\' '.base_url().'processor/'.$this->urlpath.'?action=reject&approve&last_id='.$this->input->get('id').'&company_id='.$this->input->get('company_id').'&group_id='.$this->input->get('group_id').'&modul_id='.$this->input->get('modul_id').' \' )"  id="button_reject_'.$this->url.'"  class="ui-button-text icon-save" >Reject</button>';

        $grid          = $this->url;
        $url           = $this->masterUrl;
        $btnUpk  = "<button class='ui-button icon-print' onClick='btnUpk_{$this->url}(\"{$url}\", \"{$grid}\", this)'>Print</button>";
        $btnUpk .= "<script>
                        function btnUpk_{$this->url}(url, grid, dis) {
    
                            custom_confirm('Print Dokumen ?', function() {
                                template = 'mt04.docx';
                                var loadFile = function(url, callback) {
                                    JSZipUtils.getBinaryContent(url, callback);
                                }
                                loadFile('../files/pengujian/template/'+template, function(err, content) {
                                    if (err) {throw e};

                                    $.ajax({
                                        url: url+'&action=getDataMemo',
                                        type: 'POST',
                                        dataType: 'json',
                                        data: '&id={$peka}',
                                        success: function(data) {

                                            doc = new Docxgen(content);

                                            doc.setData({
                                                'vName_company'   : data[0].vName_company,
                                                'vAddress_company'   : data[0].vAddress_company,
                                                'vTelepon_company'   : data[0].vTelepon_company,
                                                'vNama_sample'   : data[0].vNama_sample,
                                                'dTgl_terima_sample'   : data[0].dTgl_terima_sample,
                                                'dTgl_terima_serum'   : data[0].dTgl_terima_serum,
                                                'vAntiserum'   : data[0].vAntiserum,
                                                'vKadar'   : data[0].vKadar,
                                                'vAsal'   : data[0].vAsal,
                                                'vBatch'   : data[0].vBatch,
                                                'dTgl_expired'   : data[0].dTgl_expired,
                                                'vJumlah'   : data[0].vJumlah,
                                                'vKeterangan'   : data[0].vKeterangan,

                                            })

                                            doc.render()
                                            out = doc.getZip().generate({type:'blob'})

                                            nmdok = 'MT04';
                                            saveAs(out, nmdok+' - ' + data[0].vnomor_03 + '.docx')
                                        }
                                    })
                                })
                            })
                        }
                    </script>";

        
        if ($this->input->get('action') == 'view') {
            unset($buttons['update']);
            $buttons['update'] = $btnUpk;  
        }
        else{ 

            if($rowData['iSubmit']==0){
                $buttons['update'] = $iframe.$update_draft.$update.$js;    
            }


            /*if($rowData['iApprove']==0 && $rowData['iSubmit']==0){
                $buttons['update'] = $iframe.$update_draft.$update.$js;    
            }elseif($rowData['iApprove']==0 && $rowData['iSubmit']==1){
                $buttons['update'] = $iframe.$approve.$reject;
            }*/
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
    function after_insert_processor($fields, $id, $post) {
    	/*$post=$this->input->post();
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
    	}*/
                $last_id=$id;
                foreach ($post['mt04_iMt04_detail'] as $k => $vr) {
                    if($k==0){
                        foreach ($vr as $kvrd => $vrdet) {
                            $datad=array();
                            $datad['iMt04']=$last_id;
                            $datad['vAntiserum']=$post['mt04_vAntiserum'][$k][$kvrd];
                            $datad['vKadar']=$post['mt04_vAntiserum'][$k][$kvrd];
                            $datad['vAsal']=$post['mt04_vAsal'][$k][$kvrd];
                            $datad['vBatch']=$post['mt04_vBatch'][$k][$kvrd];
                            $datad['dTgl_expired']=$post['mt04_dTgl_expired'][$k][$kvrd];
                            $datad['vJumlah']=$post['mt04_vJumlah'][$k][$kvrd];
                            $datad['vKeterangan']=$post['mt04_vKeterangan'][$k][$kvrd];
                            $datad['cCreated']=$this->user->gNIP;
                            $datad['dCreated']=date("Y-m-d H:i:s");
                            $this->db->insert("bbpmsoh.mt04_detail",$datad);
                        }
                    }
                }
    }

    /*After Update*/
    function after_update_processor($fields, $id, $post) {
    	/*$post=$this->input->post();
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

    	// Insert Baru
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
	    }*/
        $last_id=$id;
        foreach ($post['mt04_iMt04_detail'] as $k => $vr) {
            if($k==0){
                foreach ($vr as $kvrd => $vrdet) {
                    $datad=array();
                    $datad['iMt04']=$last_id;
                    $datad['vAntiserum']=$post['mt04_vAntiserum'][$k][$kvrd];
                    $datad['vKadar']=$post['mt04_vAntiserum'][$k][$kvrd];
                    $datad['vAsal']=$post['mt04_vAsal'][$k][$kvrd];
                    $datad['vBatch']=$post['mt04_vBatch'][$k][$kvrd];
                    $datad['dTgl_expired']=$post['mt04_dTgl_expired'][$k][$kvrd];
                    $datad['vJumlah']=$post['mt04_vJumlah'][$k][$kvrd];
                    $datad['vKeterangan']=$post['mt04_vKeterangan'][$k][$kvrd];
                    $datad['cCreated']=$this->user->gNIP;
                    $datad['dCreated']=date("Y-m-d H:i:s");
                    $this->db->insert("bbpmsoh.mt04_detail",$datad);
                }
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

		$rsel=array('iAction','vAntiserum','vKadar','vAsal','vBatch','dTgl_expired','vJumlah','vKeterangan');
		$data = new StdClass;
		$i=0;
		$dataar=array();
        if($q->num_rows()!=0){
            $data->records=$q->num_rows();
    		foreach ($q->result() as $k) {
    			$data->rows[$i]['id']=$i;
    			$z=0;
    			foreach ($rsel as $dsel => $vsel) {
    				if($vsel=="iAction"){
    					$dataar[$z]="<input type='hidden' class='num_rows_".$nmTable."' value='".$i."' /><a href='javascript:;' onclick='javascript:hapus_row_".$nmTable."(".$i.")'><input type='hidden' name='mt04_iMt04_detail[".$k->iMt04_detail."][]' value='".$k->iMt04_detail."' /><center><span class='ui-icon ui-icon-trash'></span></center></a>";
    				}else{
    					$dataar[$z]="<p>".$k->{$vsel}."</p>";
    				}
    				$z++;
    			}
    			$data->rows[$i]['cell']=$dataar;
    			$i++;
    		}
        }else{
            $data->records=1;
            $data->rows[0]['id']=0;
            $dataar=array("<input type='hidden' class='num_rows_".$nmTable."' value='0' /><input type='hidden' name='mt04_iMt04_detail[0][]' value='0' /><a href='javascript:;' onclick='javascript:hapus_row_".$nmTable."(0)'><center><span class='ui-icon ui-icon-trash'></span></center></a>","<input type='text' name='mt04_vAntiserum[0][]' id='mt04_vAntiserum_0' class='required' size='25'>","<input type='text' name='mt04_vKadar[0][]' id='mt04_vKadar_0' class='required' size='15'>","<input type='text' name='mt04_vAsal[0][]' id='mt04_vAsal_0' class='required' size='15'>","<input type='text' name='mt04_vBatch[0][]' id='mt04_vBatch_0' class='required' size='15'>","<input type='text' name='mt04_dTgl_expired[0][]' id='mt04_dTgl_expired_0' class='required' size='15'>","<input type='text' name='mt04_vJumlah[0][]' id='mt04_vJumlah_0' class='required' size='15'","<input type='text' name='mt04_vKeterangan[0][]' id='mt04_vKeterangan_0' class='required' size='25'>");
            $data->rows[0]['cell']=$dataar;
        }
		return json_encode($data);
    }

}