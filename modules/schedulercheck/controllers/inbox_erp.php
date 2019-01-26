<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class inbox_erp extends MX_Controller {
    function __construct() {
        parent::__construct();
$this->db = $this->load->database('hrd',false, true);
        $this->load->library('auth');
        $this->user = $this->auth->user();
        $this->load->library('Zend','Zend/Session/Namespace');
        $this->sess_auth = new Zend_Session_Namespace('auth');
    }
    function index($action = '') {
       switch ($action) {
           case 'getInbox':
               $g=$this->input->get();
               $nip=$this->sess_auth->gNIP;
               $pt=$g['company_id'];
               $appId=$g['idApp'];
               $group=$g['idGroup'];
               $renderMenu = $this->getAppMenuModules($nip, $pt, $appId, 0, $group);
               $data['datamenu']=explode(",", $renderMenu);
               $data['ini']=$this;
               $ret=$this->load->view('render_menu_inbox_erp',$data,TRUE);
               echo $ret;
            break;

            case 'sendJSONCount':
                $g=$this->input->get();
                $p=$this->input->post();
                $path=str_replace('/', '_', $p['grid']);
                $sql="select a.* 
                        from erp_privi.privi_modules a
                        where a.isDeleted=0
                        and replace(a.vPathModule,'/','_') ='".$path."'";
                $qcc=$this->db->query($sql);
                $msg= "";
                $retdata=array();
                $detdat=array();
                if($qcc->num_rows()==0){
                    $msg= "Error - Not Found Modules";
                }else{
                    $ddd=$qcc->row_array();
                    $sq='select * from gps_msg.erp_inbox g
                        where g.ldeleted=0 and g.send_count=0 and g.modul_id='.$ddd['idprivi_modules'].' order by g.inbox_id DESC';
                    $dinbox=$this->db->query($sq)->row_array();
                    /*Update Jika Sudah di Send*/
                    $dupd['send_count']=1;
                    $inbox_id=$dinbox['inbox_id'];
                    $this->db->where('inbox_id',$inbox_id);
                    $this->db->update('gps_msg.erp_inbox',$dupd);
                    
                    /*Get PIC*/

                    $qq='select * from gps_msg.erp_inbox_details d
                    join gps_msg.erp_inbox e on e.inbox_id=d.inbox_id
                    where e.ldeleted=0 and d.ldeleted=0 and d.istatus_read=0 and d.inbox_id='.$inbox_id;

                    $dqq=$this->db->query($qq);
                    if($dqq->num_rows()>=1){
                        foreach ($dqq->result_array() as $kdqq => $vdqq) {
                            $retdata[$vdqq['cnip']]=$this->get_readstatus($vdqq['cnip']);
                            $detdat[$vdqq['cnip']]=$vdqq;
                        }
                    }
                    $msg= "Sended";
                }
                $dataret['status']=true;
                $dataret['message']=$msg;
                $dataret['datacount']=$retdata;
                $dataret['detailinbox']=$detdat;
                echo json_encode($dataret);
            break; 

            case 'getJSONCountbyNIP': 
                $nilai=0;
                if($this->user->gNIP!=''){
                    $sql='select * from gps_msg.erp_inbox_details i where i.ldeleted=0 and i.istatus_read=0 and i.cnip like "%'.$this->user->gNIP.'%"';
                    $nilai=$this->db->query($sql)->num_rows();
                }
                $ret['count']=$nilai;
                echo json_encode($ret);    
               break; 
           default:
                $menu        = array();
                $draw_menu   = array();
                
                $id_PT          = $this->input->get('company_id');
                 
                if (!empty($id_PT)){
                    $menu = $this->getAPP($this->sess_auth->gNIP, $id_PT);
                }else{
                    $menu = $this->getAPP($this->sess_auth->gNIP, $this->sess_auth->gComId);
                }
                
                if (sizeOf($menu) > 0) {
                    foreach($menu as $key=>$val) {
                        $draw_menu[] = array('menu'=>$val);
                    }
                }
                
                $data['arrmenu'] = $draw_menu;
                $data['ini']=$this;
                echo $this->load->view('inbox_erp',$data,TRUE);
            break;
       }
        
    	    	
    }

    /*Get Count*/
    function get_readstatus($nip='0'){//iki kanggo nonton sing durung di woco
        $sql="select * from gps_msg.erp_inbox_details d where d.ldeleted=0 and d.istatus_read=0 and cnip='".$nip."'";
        $cc=$this->db->query($sql)->num_rows();
        return $cc;
    }

    /*Jupuk Hak Akses Aplikasi*/
    function getAPP($nip,$pt){
        $sql = "SELECT ( t1.cNIP ) AS 'nip'
                        , ( t1.iCompanyId ) AS 'comId'
                        , ( SELECT tx1.vCompName FROM hrd.company tx1 WHERE tx1.iCompanyId = t1.iCompanyId) AS 'compName'
                        , ( t1.idprivi_apps)AS 'idApp'
                        , ( SELECT tx2.vAppName FROM privi_apps tx2 WHERE tx2.idprivi_apps = t1.idprivi_apps) AS 'appName'
                        , ( t1.idprivi_group)AS 'idGroup'
                        , t2.isDeleted
                FROM
                    privi_authlist t1
                    LEFT JOIN 
                    privi_apps t2 ON t1.idprivi_apps = t2.idprivi_apps
                WHERE
                    t1.cNIP = '".$nip."'
                    AND t1.isDeleted = '0'
                    AND t2.isDeleted = '0' 
                    AND t1.iCompanyId   = '".$pt."'
                    ORDER BY t2.vAppName ASC";
      
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            $rtr = array('no_access');
            return $rtr;
        }
    }

    function getmoduledetails($idprivi_modules=0){
        $sql="select * from erp_privi.privi_modules m where m.idprivi_modules=".$idprivi_modules;
        return $this->db->query($sql)->row_array();
    }

    function getAppMenuModules($nip, $pt, $appId, $index, $group) {     
        
        $sql = "SELECT a.cNIP, (SELECT vCompName FROM hrd.company WHERE iCompanyId = a.iCompanyId) AS `Company`,
                (SELECT vAppName FROM privi_apps WHERE idprivi_apps = a.idprivi_apps) AS `AppName`,
                a.idprivi_apps AS `App_ID`, a.idprivi_group AS `group`, c.idprivi_modules AS `id`, d.idprivi_modules, c.iCrud,
                d.vCodeModule AS vCodeModule, d.vPathModule AS `Mod_Path`, d.iParent AS `parent_id`, d.vNameModule AS `text` 
                FROM privi_authlist a LEFT JOIN  privi_group_pt_app b ON  a.iCompanyId = b.iCompanyId AND a.idprivi_apps = b.idprivi_apps 
                AND a.idprivi_group = b.iID_GroupApp LEFT JOIN privi_group_pt_app_mod c ON 
                b.iCompanyId = c.iCompanyId AND b.idprivi_apps = c.idprivi_apps AND b.iID_GroupApp = c.idprivi_group LEFT JOIN 
                privi_modules d ON c.idprivi_apps = d.idprivi_apps AND c.idprivi_modules = d.idprivi_modules
                WHERE a.cNIP = '{$nip}' AND a.iCompanyId = '{$pt}' AND a.idprivi_group = '{$group}' 
                AND a.idprivi_apps = '{$appId}' AND a.isDeleted = '0' AND d.isDeleted = '0'  
                AND c.iCrud > 0 AND d.iParent = '{$index}' order by d.vCodeModule asc";
        
        //echo $sql;
        $q = $this->db->query($sql);
        
        if($q->num_rows() == 0) {
            return false;
        }
        
        $tree = '';        
        foreach($q->result_array() as $arr) {                           
            
            $sql1 = "SELECT a.cNIP, (SELECT vCompName FROM hrd.company WHERE iCompanyId = a.iCompanyId) AS `Company`,
                (SELECT vAppName FROM privi_apps WHERE idprivi_apps = a.idprivi_apps) AS `AppName`,
                a.idprivi_apps AS `App_ID`, a.idprivi_group AS `group`, c.idprivi_modules AS `id`, d.idprivi_modules, c.iCrud,
                d.vCodeModule AS vCodeModule, d.vPathModule AS `Mod_Path`, d.iParent AS `parent_id`, d.vNameModule AS `text` 
                FROM privi_authlist a LEFT JOIN  privi_group_pt_app b ON  a.iCompanyId = b.iCompanyId AND a.idprivi_apps = b.idprivi_apps 
                AND a.idprivi_group = b.iID_GroupApp LEFT JOIN privi_group_pt_app_mod c ON 
                b.iCompanyId = c.iCompanyId AND b.idprivi_apps = c.idprivi_apps AND b.iID_GroupApp = c.idprivi_group LEFT JOIN 
                privi_modules d ON c.idprivi_apps = d.idprivi_apps AND c.idprivi_modules = d.idprivi_modules
                WHERE a.cNIP = '{$nip}' AND a.iCompanyId = '{$pt}' AND a.idprivi_group = '{$group}' 
                AND a.idprivi_apps = '{$appId}' AND a.isDeleted = '0' AND d.isDeleted = '0'  
                AND c.iCrud > 0 AND d.iParent = '{$arr['id']}' order by d.vCodeModule asc";
            
            $subFileCount=$this->db->query($sql1);          
            if($subFileCount->num_rows() > 0){
                $tree .= $this->getAppMenuModules($nip, $pt, $appId,"".$arr['id']."", "".$arr['group']."");
            } else {
               $tree.=$arr['id'].',';
            }
        }
               
    
        return $tree;
    }

    function getlistpesan($modul_id=0){
        $sql="select * from gps_msg.erp_inbox_details d
        join gps_msg.erp_inbox e on e.inbox_id=d.inbox_id
        where e.ldeleted=0 and d.ldeleted=0 
        and e.modul_id=".$modul_id." and d.cnip like '%".$this->sess_auth->gNIP."%'
        order by d.dcreate DESC
        ";
        $data['sql']=$sql;
        $data['query']=$this->db->query($sql);
        return $data;

    }

	public function output(){
		$this->index($this->input->get('action'));
	}

}
