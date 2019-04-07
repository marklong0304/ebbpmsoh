<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class mt02 extends MX_Controller {
    var $masterUrl;
    function __construct() {
        parent::__construct();
         $this->load->library('auth');
        $this->db = $this->load->database('hrd',false, true);
        $this->user = $this->auth->user();

        $this->title = 'MT 02';
        $this->url = 'mt02';
        $this->urlpath = 'pengujian/'.str_replace("_","/", $this->url);
        $this->masterUrl = base_url()."processor/pengujian/mt02?company_id={$this->input->get('company_id')}";

        $this->maintable = 'bbpmsoh.mt02';  
        $this->main_table = $this->maintable;   
        $this->main_table_pk = 'iMt02'; 
        $datagrid['islist'] = array(
            'mt01.vNo_transaksi' => array('label'=>'No Transaksi','width'=>100,'align'=>'center','search'=>true)
            ,'mt01.vNama_produsen' => array('label'=>'Nama Produsen','width'=>300,'align'=>'left','search'=>true)
            ,'dTgl_Kontrak' => array('label'=>'Tanggal Kontrak','width'=>100,'align'=>'center','search'=>false)
            ,'iSubmit' => array('label'=>'Submit','width'=>100,'align'=>'center','search'=>true)
            ,'iApprove' => array('label'=>'Approval','width'=>100,'align'=>'center','search'=>true)
        );

        $datagrid['jointableinner']=array(
            0=>array('bbpmsoh.mt01'=>'mt01.iMt01=bbpmsoh.mt02.iMt01')
            );

        $datagrid['addFields']=array(
                'iMt01'=>'Nomor Transaksi'
                ,'vNama_sample'=>'Nama Sample'
                ,'vAcuan_metode_uji'=>'Acuan Metode'
                ,'dTgl_Kontrak'=>'Tanggal Kontrak'
                ,'p1_nama'=>'Nama Pihak I'
                ,'p1_jabatan' =>'Jabatan Pihak I'
                ,'p1_perusahaan'=>'Perusahaan Pihak I'
                ,'p1_alamat'=>'Alamat Pihak I'
                //,'p1_an'=>'Pihak I Atas Nama'
                ,'p2_nama'=>'Nama Pihak II'
                ,'p2_jabatan'=>'Jabatan Pihak II'
                ,'vKeterangan'=>'Keterangan'
                );
        $datagrid['isRequired']=array('all_form');
        $datagrid['shortBy']=array('mt02.dUpdated'=>'Desc');
    
        $datagrid['setQuery']=array(
                                0=>array('vall'=>'mt02.lDeleted','nilai'=>0)
                                );
        
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

        $groupnya = $this->checkgroup($this->user->gNIP);             
        if( $groupnya['idprivi_group']== 7){
            $grid->setQuery('mt01.iCustomer',$this->user->gNIP );     
        }


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
            case 'GetDataIM01':
                $where=array('mt01.lDeleted'=>0,'mt01.iMt01'=>$this->input->post('id'));
                $this->db->select('mt01.*,m_tujuan_pengujian.vNama_tujuan,employee.*')
                    ->from('bbpmsoh.mt01')
                    ->join('bbpmsoh.m_tujuan_pengujian','m_tujuan_pengujian.iM_tujuan_pengujian=bbpmsoh.mt01.iM_tujuan_pengujian')
                    ->join('hrd.employee','employee.cNip=bbpmsoh.mt01.iCustomer')
                    ->where($where);
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
                echo $this->reject_process();
                break;
            case 'getDataMemo':
                echo $this->getDataMemo();
                break;
            default:
                $grid->render_grid();
                break;
        }
    }

    function getDataMemo() {

        $id   = $this->input->post('id');
       
        $data = array(); 

        $sql = "select b.vNo_transaksi, DAYOFMONTH(a.dTgl_Kontrak) as tgl, year(a.dTgl_Kontrak) as tahun, a.* from bbpmsoh.mt02 a
				left join bbpmsoh.mt01 b on b.iMt01 = a.iMt01
                WHERE a.iMt01 = '{$id}'";
        $query = $this->db->query($sql);
        
        foreach ($query->result() as $row) {
            $row_array['vNo_transaksi']             = ucwords(strtolower($row->vNo_transaksi));
            $row_array['p1_nama']                	= $row->p1_nama;
            $row_array['p1_jabatan']         		= ucwords(strtolower($row->p1_jabatan));
            $row_array['p1_perusahaan']          	= $row->p1_perusahaan;
            $row_array['p1_alamat']              	= ucwords(strtolower($row->p1_alamat));
			$row_array['p1_an']          			= $row->p1_an;
			$row_array['p2_nama']          			= $row->p2_nama;
			$row_array['p2_jabatan']          		= $row->p2_jabatan;
			$row_array['vNama_sample']          	= $row->vNama_sample;
			$row_array['vAcuan_metode_uji']        	= $row->vAcuan_metode_uji;
			$row_array['vKeterangan']          		= $row->vKeterangan;
			
			$tanggal = $row->dTgl_Kontrak;
			function bulan_indo($tanggal)
			{
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
				$split = explode('-', $tanggal);
				return $bulan[ (int)$split[1] ];
			}

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
				$split 	  = explode('-', $tanggal);
				$tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
				
				if ($cetak_hari) {
					$num = date('N', strtotime($tanggal));
					return $hari[$num];
				}
				return $tgl_indo;
			}
			//echo tanggal_indo ('2016-03-20'); // Hasil: 20 Maret 2016;
			//echo tanggal_indo ('2016-03-20', true); // Hasil: Minggu, 20 Maret 2016
			//echo tanggal_indo('2016-03-20');
			
			$row_array['dTgl_Kontrak']          	= $row->tgl;
			$row_array['dTgl_tahun']          		= $row->tahun;
			$row_array['dTgl_bulan']          		= bulan_indo($row->dTgl_Kontrak);
			$row_array['dTgl_hari']          			= tanggal_indo($row->dTgl_Kontrak, true);
			
            array_push($data, $row_array);
        }
		
        echo json_encode($data);
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

    function getMT01($id){
        $sql= 'select * from bbpmsoh.mt01 a where a.lDeleted=0 and a.iMt01= "'.$id.'"';
        $dMt01 = $this->db->query($sql)->row_array();
        return $dMt01;
    }
    function manipulate_update_button($buttons, $rowData) {
        $peka=$rowData['iMt01'];
        
        $cNip= $this->user->gNIP;
        $js = $this->load->view('js/standard_js');
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
                                template = 'mt02.docx';
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
                                                
                                                'p1_nama' : data[0].p1_nama,
                                                'p1_jabatan' : data[0].p1_jabatan,
                                                'p1_perusahaan' : data[0].p1_perusahaan,
                                                'p1_alamat' : data[0].p1_alamat,
                                                'p1_an' : data[0].p1_an,
                                                'p2_nama' : data[0].p2_nama,
                                                'p2_jabatan' : data[0].p2_jabatan,
                                                'vNama_sample' : data[0].vNama_sample,
                                                'vAcuan_metode_uji' : data[0].vAcuan_metode_uji,
                                                'vKeterangan' : data[0].vKeterangan,
                                                'dTgl_Kontrak' : data[0].dTgl_Kontrak,
                                                'dTgl_bulan' : data[0].dTgl_bulan,
                                                'dTgl_tahun' : data[0].dTgl_tahun,
                                                'dTgl_hari' : data[0].dTgl_hari,
                                            })

                                            doc.render()
                                            out = doc.getZip().generate({type:'blob'})

                                            nmdok = 'MT02';
                                            saveAs(out, nmdok+' - ' + data[0].vNo_transaksi + '.docx')
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
            if($rowData['iApprove']==0 && $rowData['iSubmit']==0){
                
                $groupnya = $this->checkgroup($this->user->gNIP);             
                if( $groupnya['idprivi_group']== 7){
                    $buttons['update'] = 'MT02 Belum disubmit oleh Admin Yanji <br>'.$iframe.$update_draft.$js; 
                }else{
                    $buttons['update'] = $iframe.$update_draft.$update.$js; 
                }

            }elseif($rowData['iApprove']==0 && $rowData['iSubmit']==1){
                $mt01Nya = $this->getMT01($rowData['iMt01']);

                if($this->user->gNIP == $mt01Nya['iCustomer']){
                    $buttons['update'] = $iframe.$approve.$reject;    
                }else{
                    $buttons['update'] = 'Butuh Approval dari Customer';
                }
                
            }
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
    function listBox_mt02_iappqa_uji($value) {
        if($value==0){$vstatus='Waiting for approval';}
        elseif($value==1){$vstatus='Rejected';}
        elseif($value==2){$vstatus='Approved';}
        return $vstatus;
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
    //'iMt01','dTgl_Kontrak','p1_nama','p1_jabatan','p1_perusahaan','p1_alamat','p1_an','p2_nama','p2_jabatan','vNama_sample','vAcuan_metode_uji','vKeterangan'
    /*Manipulate Insert/Update Form*/
    function insertBox_mt02_iMt01($field, $id) {
        $ff=str_replace("form_","", $field);
        $where=array('lDeleted'=>0,'iApprove'=>2);
        $this->db->select('*')
            ->from('bbpmsoh.mt01')
            ->where($where)
            ->where('mt01.iMt01 not in (select iMt01 from bbpmsoh.mt02 where lDeleted=0)');
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
                url: base_url+"processor/pengujian/mt02?action=GetDataIM01",
                type: "post",
                data: {
                    id: $(this).val(),
                },
                success: function( data ) {
                    var o = $.parseJSON(data);
                    $("#mt02_vNama_sample").val(o.vNama_sample);
                    //$("#mt02_vAcuan_metode_uji").val(o.vNama_tujuan);
                    $("#mt02_p1_nama").val(o.vName);
                    $("#mt02_p1_perusahaan").val(o.vNama_produsen);
                    $("#mt02_p1_alamat").val(o.vAlamat_produsen);
                }
            });
        })';
        $return.='</script>';
        $return .= '<input type="hidden" name="isdraft" id="isdraft" class="input_rows1 " size="30"  />';
        // $return=$this->db->last_query();
        return $return;
    }

    function insertBox_mt02_p1_nama($field, $id) {
        $return = '<input type="text" readonly="readonly" name="'.$field.'"  id="'.$id.'"  class="input_rows1 required" size="30"  />';
        return $return;
    }
    
    function updateBox_mt02_p1_nama($field, $id, $value, $rowData) {
            if ($this->input->get('action') == 'view') {
                 $return= $value; 
            }else{ 
                $return = '<input type="text" readonly="readonly" name="'.$field.'"  id="'.$id.'"  class="input_rows1  required" size="30" value="'.$value.'"/>';

            }
            
        return $return;
    }



    function insertBox_mt02_p1_perusahaan($field, $id) {
        $return = '<input type="text" readonly="readonly" name="'.$field.'"  id="'.$id.'"  class="input_rows1 required" size="30"  />';
        return $return;
    }
    
    function updateBox_mt02_p1_perusahaan($field, $id, $value, $rowData) {
            if ($this->input->get('action') == 'view') {
                 $return= $value; 
            }else{ 
                $return = '<input type="text" readonly="readonly" name="'.$field.'"  id="'.$id.'"  class="input_rows1  required" size="30" value="'.$value.'"/>';

            }
            
        return $return;
    }


    function insertBox_mt02_p1_alamat($field, $id) {
        $return = '<textarea name="'.$field.'" readonly="readonly" id="'.$id.'" class="required" style="width: 240px; height: 75px;" size="250" maxlength ="250"></textarea>';
        return $return;
    }
    
    function updateBox_mt02_p1_alamat($field, $id, $value, $rowData) {
            if ($this->input->get('action') == 'view') {
                 $return= '<label title="Note">'.nl2br($value).'</label>'; 
            }else{ 
                $return = '<textarea name="'.$field.'" readonly="readonly" id="'.$id.'" class="required" style="width: 240px; height: 75px;" size="250" maxlength ="250">'.nl2br($value).'</textarea>';

            }
            
        return $return;
    }



    function insertBox_mt02_vNama_sample($field, $id) {
        $ff=str_replace("form_","", $field);
        $return = '<input type="text" name="'.$ff.'" id="'.$id.'" value="" readonly="readonly">';
        return $return;
    }
    function insertBox_mt02_vAcuan_metode_uji($field, $id) {
        $ff=str_replace("form_","", $field);
        $return = '<input type="text" name="'.$ff.'" id="'.$id.'" value="" >';
        return $return;
    }
    function insertBox_mt02_dTgl_Kontrak($field, $id) {
        $ff=str_replace("form_","", $field);
       $return = '<input name="'.$ff.'" id="'.$id.'" type="text" size="20" class="input_tgl datepicker required" style="width:130px"/>';
        $return .=  '<script>
                            $("#'.$id.'").datepicker({dateFormat:"yy-mm-dd"});
                        
                    </script>';
        return $return;
    } 

    function updateBox_mt02_iMt01($field,$id,$value,$rowData){
        $ff=str_replace("form_","", $field);
        $where=array('lDeleted'=>0,'iApprove'=>2);
        $this->db->select('*')
            ->from('bbpmsoh.mt01')
            ->where($where)
            ->where('bbpmsoh.mt01.iMt01 NOT IN (select iMt01 from bbpmsoh.mt02 where lDeleted=0 AND iMt01 !='.$value.' )');
        $row=$this->db->get()->result_array();
        $return='<select id="'.$id.'" name="'.$ff.'" class="required">';
        $return.='<option value="">---Pilih---</option>';
        foreach ($row as $kk => $vv) {
            $select=$value==$vv['iMt01']?'selected':'';
            if($value==$vv['iMt01']){
                $value=$vv['vNomor'];
            }
            $return.='<option value="'.$vv['iMt01'].'" '.$select.' >'.$vv['vNo_transaksi'].' - '.$vv['vNomor'].'</option>';
        }
        $return.='</select>';
        $return.='<script>';
        $return.='$("#'.$id.'").change(function(){
            $.ajax({
                url: base_url+"processor/pengujian/mt02?action=GetDataIM01",
                type: "post",
                data: {
                    id: $(this).val(),
                },
                success: function( data ) {
                    var o = $.parseJSON(data);
                    $("#mt02_vNama_sample").val(o.vNama_sample);
                    //$("#mt02_vAcuan_metode_uji").val(o.vNama_tujuan);
                    $("#mt02_p1_nama").val(o.vName);
                    $("#mt02_p1_perusahaan").val(o.vNama_produsen);
                    $("#mt02_p1_alamat").val(o.vAlamat_produsen);
                    

                    
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
    function updateBox_mt02_vNama_sample($field,$id,$value,$rowData){
        $ff=str_replace("form_","", $field);
        $return = '<input type="text" name="'.$ff.'" id="'.$id.'" value="'.$value.'" readonly="readonly">';
        if($this->input->get('action')=='view'){
            $return=$value;
        }
        return $return;
    }
    function updateBox_mt02_vAcuan_metode_uji($field,$id,$value,$rowData){
        $ff=str_replace("form_","", $field);
        $return = '<input type="text" name="'.$ff.'" id="'.$id.'" value="'.$value.'" >';
         if($this->input->get('action')=='view'){
            $return=$value;
        }
        return $return;
    }
    function updateBox_mt02_dTgl_Kontrak($field,$id,$value,$rowData){
        $ff=str_replace("form_","", $field);
        $return = '<input name="'.$ff.'" id="'.$id.'" type="text" size="20" class="input_tgl datepicker required" value="'.$value.'" style="width:130px"/>';
        $return .=  '<script>
                            $("#'.$id.'").datepicker({dateFormat:"yy-mm-dd"});
                        
                    </script>';
        if($this->input->get('action')=='view'){
            $return=$value;
        }
        return $return;
    }

    
    /*Function Tambahan*/

    function before_insert_processor($row, $postData) {
        $postData['dCreated']=date("Y-m-d H:i:s");
        $postData['cCreated']=$this->user->gNIP;
        $postData['p1_an']= $postData['p1_nama'];

        
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
        $postData['p1_an']= $postData['p1_nama'];
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
                                        $.get(base_url+"processor/pengujian/mt02?action=view&id="+last_id+"&group_id="+o.group_id+"&modul_id="+o.modul_id, function(data) {
                                             $("div#form_mt02").html(data);
                                        });
                                    
                                }
                                    reload_grid("grid_mt02");
                            }
                            
                         })
                     }
                 </script>';
        $echo .= '<h1>Approval</h1><br />';
        $echo .= '<form id="form_mt02_approve" action="'.base_url().'processor/pengujian/mt02?action=approve_process" method="post">';
        $echo .= '<div style="vertical-align: top;">';
        $echo .= 'Remark : 
                <input type="hidden" name="last_id" value="'.$this->input->get('last_id').'" />
                <input type="hidden" name="group_id" value="'.$this->input->get('group_id').'" />
                <input type="hidden" name="modul_id" value="'.$this->input->get('modul_id').'" />
                <textarea name="vRemark"></textarea>
        <button type="button" onclick="submit_ajax(\'form_mt02_approve\')">Approve</button>';
            
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
        $this->db->where('iMt02',$post['last_id'])
                    ->update('bbpmsoh.mt02',$dataupdate);

        $data['group_id']=$post['group_id'];
        $data['modul_id']=$post['modul_id'];
        $data['status']  = true;
        $data['last_id'] = $post['last_id'];
        
        return json_encode($data);
    }

    function reject_view() {
        $echo = '<script type="text/javascript">
                     function submit_ajax(form_id) {
                        var remark = $("#reject_mt02_vRemark").val();
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
                                var url = "'.base_url().'processor/pengujian/mt02";                             
                                if(o.status == true) {
                                    
                                    $("#alert_dialog_form").dialog("close");
                                         $.get(url+"?action=view&id="+last_id+"&group_id="+o.group_id+"&modul_id="+o.modul_id, function(data) {
                                         $("div#form_mt02").html(data);
                                    });
                                    
                                }
                                    reload_grid("grid_mt02");
                            }
                            
                         })
                    
                     }
                 </script>';
        $echo .= '<h1>Reject</h1><br />';
        $echo .= '<form id="form_mt02_reject" action="'.base_url().'processor/pengujian/mt02?action=reject_process" method="post">';
        $echo .= '<div style="vertical-align: top;">';
        $echo .= 'Remark : 
                <input type="hidden" name="last_id" value="'.$this->input->get('last_id').'" />
                <input type="hidden" name="group_id" value="'.$this->input->get('group_id').'" />
                <input type="hidden" name="modul_id" value="'.$this->input->get('modul_id').'" />
                <textarea name="vRemark"></textarea>
        <button type="button" onclick="submit_ajax(\'form_mt02_reject\')">Reject</button>';
            
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
        $this->db->where('iMt02',$post['last_id'])
                    ->update('bbpmsoh.mt02',$dataupdate);
        $data['group_id']=$post['group_id'];
        $data['modul_id']=$post['modul_id'];
        $data['status']  = true;
        $data['last_id'] = $post['last_id'];
        
        return json_encode($data);
    }

    function getDetailsReq() {
        $term = $this->input->get('term');
        $sql='select mt03.*,m_tujuan_pengujian.cKode from bbpmsoh.mt01
                join bbpmsoh.m_tujuan_pengujian on m_tujuan_pengujian.iM_tujuan_pengujian=mt01.iM_tujuan_pengujian
                where mt01.vNomor like "%'.$term.'%" and mt01.lDeleted=0 order by vNomor ASC';
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
            ,'mt02.lDeleted'=>0
            );
        $this->db->select("mt01.*,m_tujuan_pengujian.cKode,mt02.iMt02")
                    ->from("bbpmsoh.mt02")
                    ->join("bbpmsoh.mt01","mt01.iMt01=mt02.iMt01")
                    ->join("bbpmsoh.m_tujuan_pengujian","m_tujuan_pengujian.iM_tujuan_pengujian=mt01.iM_tujuan_pengujian")
                    ->where($where);
        $q=$this->db->get(); 

        $rsel=array('vNomor'=>'Nomor Pengujian','vNama_sample'=>'Nama Sample','vNama_produsen'=>'Produsen','vZat_aktif'=>'Zat Aktif / Strain','vNo_registrasi'=>'No. Registrasi','vBatch_lot'=>'No. Batch','dTgl_kadaluarsa'=>'Waktu Kadaluarsa','vKemasan'=>'Kemasan','iJumlah_diserahkan'=>'Jumlah Sample','cKode'=>'Keterangan');
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
                    $dataar[$z]="<input type='hidden' class='num_rows_".$nmTable."' value='".$i."' /><input type='text' name='grid_details_nomor_request[".$k->iMt02."][]' id='grid_details_nomor_request_".$i."' value='".$k->vNomor."' class='get_sample_req_".$nmTable." required' size='25'><input type='hidden' name='".$this->url."_iMt01' id='grid_details_".$nmTable."_iMt01_".$i."' value='".$k->iMt01."' class='required' size='25'>";
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