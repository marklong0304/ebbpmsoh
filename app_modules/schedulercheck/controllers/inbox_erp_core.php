<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class inbox_erp_core extends MX_Controller {
    function __construct() {
        parent::__construct();
        $this->db = $this->load->database('hrd',false, true);
		$this->load->library('auth');
		$this->user = $this->auth->user();
        $this->load->library('lib_utilitas');
    }
    function index($action = '') {
    	$action = $this->input->get('action');
    	//Bikin Object Baru Nama nya $grid		
		$grid = new Grid;
		$grid->setTitle('Inbox ERP');

		$grid->setTable('gps_msg.erp_inbox_details');		
		$grid->setUrl('inbox_erp_core');
		$grid->addList('pilih','erp_inbox.vsubject','dcreate','vNameSender','privi_modules.idprivi_apps','privi_modules.idprivi_modules','istatus_read');
		$grid->setSortBy('dcreate');
		$grid->setSortOrder('DESC');

		$grid->setAlign('pilih', 'center');
        $grid->setWidth('pilih', '35');
        $grid->setLabel('pilih', 'View');

        $grid->setAlign('vNameSender', 'left');
		$grid->setWidth('vNameSender', '150');
		$grid->setLabel('vNameSender', 'Sender');
		
		$grid->setAlign('erp_inbox.vsubject', 'left');
		$grid->setWidth('erp_inbox.vsubject', '250');
		$grid->setLabel('erp_inbox.vsubject', 'Subject');

		$grid->setAlign('dcreate', 'left');
		$grid->setWidth('dcreate', '150');
		$grid->setLabel('dcreate', 'Date Send');

		$grid->setAlign('privi_modules.idprivi_apps', 'left');
		$grid->setWidth('privi_modules.idprivi_apps', '150');
		$grid->setLabel('privi_modules.idprivi_apps', 'Application Name');

		$grid->setAlign('privi_modules.idprivi_modules', 'left');
		$grid->setWidth('privi_modules.idprivi_modules', '150');
		$grid->setLabel('privi_modules.idprivi_modules', 'Module Name');

		$grid->setAlign('istatus_read', 'center');
		$grid->setWidth('istatus_read', '150');
		$grid->setLabel('istatus_read', 'Status');

		$grid->addFields('subject','dsend','to','cc','lblcontent','content');

		$grid->setLabel('subject', 'Subject');
		$grid->setLabel('dsend', 'Date Send');
		$grid->setLabel('to', 'To');
		$grid->setLabel('cc', 'Cc');
		$grid->setLabel('lblcontent', 'Content');
		$grid->setLabel('content', '');

		$grid->setJoinTable('gps_msg.erp_inbox', 'erp_inbox.inbox_id = gps_msg.erp_inbox_details.inbox_id', 'inner');
		$grid->setJoinTable('erp_privi.privi_modules', 'privi_modules.idprivi_modules = gps_msg.erp_inbox.modul_id', 'inner');
		$grid->setJoinTable('erp_privi.privi_apps', 'privi_apps.idprivi_apps = erp_privi.privi_modules.idprivi_apps', 'inner');
		//$grid->setRelation('gps_msg.erp_inbox.modul_id','erp_privi.privi_modules','idprivi_modules','vNameModule','vNameModule','left',array('isDeleted'=>0),array('vNameModule'=>'asc'));
		$grid->setRelation('gps_msg.erp_inbox.cnip_sender','hrd.employee','cNip','vName','vNameSender','left',array('lDeleted'=>0),array('vName'=>'asc'));
		//$grid->setRelation('erp_privi.privi_modules.idprivi_apps','erp_privi.privi_apps','idprivi_apps','vAppName','vAppName','left',array('isDeleted'=>0),array('vAppName'=>'asc'));
		//$grid->changeFieldType('istatus_read','combobox','',array(''=>'-- Pilih --',0=>'New',1=>'Read'));
		$grid->setGridView('grid');
		$grid->setSearch('erp_inbox.vsubject','istatus_read','privi_modules.idprivi_apps','privi_modules.idprivi_modules');
		/*basic required start*/
		$grid->setQuery('erp_inbox_details.cnip like "%'.$this->user->gNIP.'%"', NULL);
		$grid->setQuery('erp_inbox_details.ldeleted', 0);
		$grid->setQuery('erp_inbox.ldeleted', 0);
		/*basic required finish*/
		switch ($action) {
			case 'json':
				$grid->getJsonData();
				break;
			case 'update_count_message':
				/*$dataret=$this->input->post();*/
				$dataret=array('N15748'=>'1000');
				$ii=0;
		    	$str='';
				foreach ($dataret as $kr => $vr) {
					if($ii==0){
						$str.="'".$kr."':'".$vr."'";
					}else{
						$str.=",'".$kr."':'".$vr."'";
					}
					$ii++;
				}
				$data['dataarray']=$str;
				echo $this->load->view('inbox_update_count_erp',$data,TRUE);
				exit();
				break;	
			case 'view':
				$grid->render_form($this->input->get('id'),TRUE);
				break;
            case 'get_module':
                echo $this->get_module();
                break;
			default:
				$grid->render_grid();
				break;
		}

    }

    function listBox_inbox_erp_core_pilih($value, $pk, $name, $rowData) {
        $get=$this->input->get();
        $sa='<a href="javascript:;" onclick="javascript:edit_btn(\''.base_url().'processor/schedulercheck/inbox/erp/core?action=view&id='.$pk.'&foreign_key='.$get['foreign_key'].'&company_id='.$get['company_id'].'&group_id='.$get['group_id'].'&modul_id='.$get['modul_id'].'\',\'inbox_erp_core\')"><center><span class="ui-icon ui-icon-lightbulb"></span></center></a>';
        return $sa;
    }

    function searchBox_inbox_erp_core_istatus_read($fields, $id) {
    	$arr=array(''=>'---Pilih---',0=>'New',1=>'Read');
    	$re='<select id="'.$id.'" name="'.$id.'">';
    	foreach ($arr as $kr => $vr) {
    		$re.='<option value="'.$kr.'">'.$vr.'</option>';
    	}
    	$re.='</select>';
    	return $re;
    }
    function searchBox_inbox_erp_core_privi_modules_idprivi_apps($fields, $id) {
    	$arr = $this->db->get_where('erp_privi.privi_apps', array('isDeleted' => 0))->result_array();
    	$re='<select id="search_grid_inbox_erp_core_privi_modules__idprivi_apps" name="search_grid_inbox_erp_core_privi_modules.idprivi_apps">';
    	$re.='<option value="">---Pilih---</option>';
    	foreach ($arr as $kr => $vr) {
    		$re.='<option value="'.$vr['idprivi_apps'].'">'.$vr['vAppName'].'</option>';
    	}
    	$re.='</select>';
        $re .= "<script>
                    $(document).ready(function() {
                        $('#search_grid_inbox_erp_core_privi_modules__idprivi_apps').change(function() {
                            $.ajax({
                                url: '".base_url()."processor/schedulercheck/inbox/erp/core?action=get_module',
                                type: 'POST',
                                data: '&app='+$(this).val(),
                                success: function(data) {
                                    $('#search_grid_inbox_erp_core_privi_modules__idprivi_modules').html(data);
                                }
                            })
                        })
                    })
                </script>";
    	return $re;
    }
    function searchBox_inbox_erp_core_privi_modules_idprivi_modules($fields, $id) {
    	$arr = $this->db->get_where('erp_privi.privi_modules', array('isDeleted' => 0, 'iType' => 1))->result_array();
    	$re='<select id="search_grid_inbox_erp_core_privi_modules__idprivi_modules" name="search_grid_inbox_erp_core_privi_modules.idprivi_modules">';
    	$re.='<option value="">---Pilih---</option>';
    	foreach ($arr as $kr => $vr) {
    		$re.='<option value="'.$vr['idprivi_modules'].'">'.$vr['vNameModule'].'</option>';
    	}
    	$re.='</select>';
    	return $re;
    }
    function listBox_inbox_erp_core_erp_inbox_vsubject($value, $pk, $name, $rowData) {
    	$v='';
    	$sql='select vsubject from gps_msg.erp_inbox where inbox_id='.$rowData->inbox_id;
    	$dt=$this->db->query($sql)->row_array();
    	if($rowData->istatus_read==0){
    		$v='<strong>'.$dt['vsubject'].'</strong>';
    	}else{
    		$v=$dt['vsubject'];
    	}
    	return $v;
    }

    function listBox_inbox_erp_core_dcreate($value, $pk, $name, $rowData) {
    	$v='';
    	if($rowData->istatus_read==0){
    		$v='<strong>'.$value.'</strong>';
    	}else{
    		$v=$value;
    	}
    	return $v;
    }
    function listBox_inbox_erp_core_vNameSender($value, $pk, $name, $rowData) {
    	$v='';
    	if($rowData->istatus_read==0){
    		$v='<strong>'.$value.'</strong>';
    	}else{
    		$v=$value;
    	}
    	return $v;
    }
    function listBox_inbox_erp_core_privi_modules_idprivi_apps($value, $pk, $name, $rowData) {
    	$v='';
    	$sql='select m.vNameModule as vNameModule,s.vAppName as vAppName from gps_msg.erp_inbox r
		left join erp_privi.privi_modules m on m.idprivi_modules=r.modul_id
		left join erp_privi.privi_apps s on s.idprivi_apps = m.idprivi_apps
		where r.inbox_id='.$rowData->inbox_id;
    	$dt=$this->db->query($sql)->row_array();
    	if($rowData->istatus_read==0){
    		$v='<strong>'.$dt['vAppName'].'</strong>';
    	}else{
    		$v=$dt['vAppName'];
    	}
    	return $v;
    }
    function listBox_inbox_erp_core_privi_modules_idprivi_modules($value, $pk, $name, $rowData) {
    	$sql='select m.vNameModule as vNameModule,s.vAppName as vAppName from gps_msg.erp_inbox r
			left join erp_privi.privi_modules m on m.idprivi_modules=r.modul_id
			left join erp_privi.privi_apps s on s.idprivi_apps = m.idprivi_apps
			where r.inbox_id='.$rowData->inbox_id;
    	$dt=$this->db->query($sql)->row_array();
    	if($rowData->istatus_read==0){
    		$v='<strong>'.$dt['vNameModule'].'</strong>';
    	}else{
    		$v=$dt['vNameModule'];
    	}
    	return $v;
    }
    function listBox_inbox_erp_core_istatus_read($value, $pk, $name, $rowData) {
    	$v='';
    	if($rowData->istatus_read==0){
    		$v='<strong>New</strong>';
    	}else{
    		$v='Read';
    	}
    	return $v;
    }

    function update_count_message($dataret){
		$ii=0;
    	$str='';
		foreach ($dataret as $kr => $vr) {
			if($ii==0){
				$str.="'".$kr."':'".$vr."'";
			}else{
				$str.=",'".$kr."':'".$vr."'";
			}
			$ii++;
		}
		$data['dataarray']=$str;
		echo $this->load->view('inbox_update_count_erp',$data);
		exit();
    }

    function updateBox_inbox_erp_core_dsend($field, $id, $value, $rowData) {
    	$qq=$this->getDataInbox($rowData['inbox_detail_id']);
    	$ret="";
    	if($qq->num_rows>=1){
    		$dr=$qq->row_array();
    		$ret=$dr['dcreate'];
    	}
    	if($rowData['istatus_read']==0){
    		$update['istatus_read']=1;
    		$update['dread']=date("Y-m-d H:i:s");
    		$update['dupdate']=date("Y-m-d H:i:s");
    		$update['dupdate']=$this->user->gNIP;
    		$this->db->where('inbox_detail_id',$rowData['inbox_detail_id']);
    		if($this->db->update('gps_msg.erp_inbox_details',$update)){
    			/*Tambahan Untuk Mengecek Jumlah Message UnRead*/
		        $sql='select * from gps_msg.erp_inbox_details i where i.ldeleted=0 and i.istatus_read=0 and i.cnip like "%'.$this->user->gNIP.'%"';
				$nilai=$this->db->query($sql)->num_rows();
    			$ret.='<script>';
    			$ret.="var socket1 = io.connect( 'http://10.1.49.8:19391');";
		    	$ret.='socket1.emit("update_count_erp_message", { 
					        new_count_erp: '.$nilai.',
					        nip_erp:"'.$this->user->gNIP.'"
					   	});';
				$ret.="$('#grid_inbox_erp_core').trigger('reloadGrid');";
		    	$ret.='</script>';
    		}
    	}
      	return $ret;
    }

    function updateBox_inbox_erp_core_subject($field, $id, $value, $rowData) {
    	$qq=$this->getDataInbox($rowData['inbox_detail_id']);
    	$ret="";
    	if($qq->num_rows>=1){
    		$dr=$qq->row_array();
    		$ret=$dr['vsubject'];
    	}
    	return $ret;
    }

    function updateBox_inbox_erp_core_to($field, $id, $value, $rowData) {
    	$qq=$this->getDataInbox($rowData['inbox_detail_id']);
    	$ret="";
    	if($qq->num_rows>=1){
    		$dr=$qq->row_array();
    		// $ret=$this->lib_utilitas->getvName($dr['vto']);
    	}
        $to = $this->getnameforcc($dr['vto']);
    	return $to;
    }

    function updateBox_inbox_erp_core_cc($field, $id, $value, $rowData) {
    	$qq=$this->getDataInbox($rowData['inbox_detail_id']);
    	$ret="";
    	if($qq->num_rows>=1){
    		$dr=$qq->row_array();
    		$ret=$dr['vcc'];
    	}
        $cc = $this->getnameforcc($ret);
    	return $cc;
    }

    function updateBox_inbox_erp_core_lblcontent($field, $id, $value, $rowData){
		$return = '<script>
			$("label[for=\'inbox_erp_core_lblcontent\']").css({"border": "1px solid #dddddd", "background": "#548cb6", "border-collapse": "collapse","width":"99%","font-weight":"bold","color":"#ffffff","text-align":"center","text-shadow": "0 1px 1px rgba(0, 0, 0, 0.3)","text-transform": "uppercase"});


		</script>';
		return $return;
	}

    function updateBox_inbox_erp_core_content($field, $id, $value, $rowData) {
    	$qq=$this->getDataInbox($rowData['inbox_detail_id']);
    	$modul_id=$this->input->get('modul_id');
    	$ret = '
				<script type="text/javascript">
					lb=$("label[for=\''.$id.'\']").parent();
					lb.css("background-color","#ffffff");
					$("label[for=\''.$id.'\']").hide();
					$("label[for=\''.$id.'\']").next().css("margin",10);
				</script>
			';
    	if($qq->num_rows>=1){
    		$dr=$qq->row_array();
    		$ret.="<div id='".$id."' style='background:#ffffff'>".$dr['tmessage'];

            $sqlMod = 'select * from erp_privi.privi_modules a where a.idprivi_modules ="'.$dr['modul_id'].'" ';
            $dMod = $this->db->query($sqlMod)->row_array();

                $reqBB = '<span class="file ui-button-text ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" id="'.$dMod['idprivi_modules'].'" rel="'.$dMod['vPathModule'].'" style="cursor:pointer;" group="47" role="button" aria-disabled="false"><span class="ui-button-text">'.$dMod['vNameModule'].'</span></span>';
                // $ret .="<hr> klik tombol berikut untuk melakukan follow up ".$reqBB;

            $ret .="</div>";
    	}
    	return $ret;
    }

    /*Maniupulasi Gird Start*/

	function manipulate_update_button($buttons, $rowData){
		unset($buttons['update']);
		return $buttons;
	}

	function getDataInbox($inbox_detail_id){
		$sql="select * from gps_msg.erp_inbox_details d
			join gps_msg.erp_inbox e on e.inbox_id=d.inbox_id
			where e.ldeleted=0 and d.ldeleted=0 and d.inbox_detail_id=".$inbox_detail_id;
		return $this->db->query($sql);
	}

/*Maniupulasi Gird end*/
/*manipulasi view object form start*/

	public function output(){
		$this->index($this->input->get('action'));
	}

    function getnameforcc($cc) {

        $arrcc = array();

        if ($cc != '') {
            $x_cc = explode(',', $cc);
            foreach ($x_cc as $k => $v) {
                $query = $this->db->select('cNip, vName')->get_where('hrd.employee', array('cNip' => $v));
                if ($query->num_rows() > 0) {
                    $row = $query->row();
                    $arrcc[$k] = "[$row->cNip] $row->vName";                
                }                
            }

            if (!empty($arrcc)) {
                $i_cc = implode(', ', $arrcc);
            } else {
                $i_cc = "<span>&nbsp</span>";
            }
        } else {
            $i_cc = "<span>&nbsp</span>";
        }
        return $i_cc;
    } 

    function get_module() {

        $app = $this->input->post('app');

        $query = $this->db->order_by('vNameModule')->get_where('erp_privi.privi_modules', array('idprivi_apps' => $app, 'isDeleted' => 0, 'iType' => 1));

        $o = "<option value=''>-- Pilih --</option>";

        foreach ($query->result() as $row) {
            $o .= "<option value='{$row->idprivi_modules}'>{$row->vNameModule}</option>";
        }

        return $o;
    }

}
