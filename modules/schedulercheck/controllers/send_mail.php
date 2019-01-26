<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class send_mail extends MX_Controller {
    function __construct() {
        parent::__construct();
$this->db_schedulercheck = $this->load->database('schedulercheck',false, true);
        $this->load->library('auth');
        $this->user = $this->auth->user();
    }
    function index($action = '') {
        switch ($action) {
            case 'send_mail':
                $p=$this->input->post();
                $g=$this->input->get();
                $date=date('Y-m-d H:i:s');
                $datain=array();
                $datain['cnip_sender']=$this->user->gNIP;
                $datain['vto']=$p['send_mail_to'];
                $datain['vcc']=$p['send_mail_cc'];
                $datain['vsubject']=$p['send_mail_subject'];
                $datain['tmessage']=$p['send_mail_message'];
                $datain['dcreate']=$date;
                $datain['ccreate']=$this->user->gNIP;
                $datain['modul_id']=$g['modul_id'];
                $datain['company_id']=$g['company_id'];
                $datain['group_id']=$g['group_id'];
                $this->db_schedulercheck->insert('gps_msg.erp_inbox',$datain);
                $insert_id = $this->db_schedulercheck->insert_id();//di lebokke ning table gedhe
                /*jupuk PIC ne soko wong sing dikirim*/
                $ss=explode(',', $p['send_mail_to']);
                $cc1=explode(',', $p['send_mail_cc']);
                $dnip=array();
                $retdata=array();
                $dataret=array();
                $iddet=array();
                if(count($ss>=1)){
                    foreach ($ss as $ks => $vs) {
                        $dnip[$vs]=0;
                    }
                }
                if(count($cc1>=1)){
                    foreach ($cc1 as $ks => $vs) {
                        $dnip[$vs]=0;
                    }
                }
                if(count($dnip)>=1){
                    foreach ($dnip as $knip => $vnip) {
                        $ddi=array();
                        $ddi['inbox_id']=$insert_id;
                        $ddi['cnip']=$knip;
                        $ddi['dcreate']=$date;
                        $ddi['ccreate']=$this->user->gNIP;
                        if($this->db_schedulercheck->insert('gps_msg.erp_inbox_details',$ddi)){
                            $iddet[] = $this->db_schedulercheck->insert_id();
                            $retdata[$knip]=$this->get_readstatus($knip);        
                        }
                    }
                }else{
                    $retdata['0']=0;
                }
               if($_SERVER["HTTP_HOST"] == 'www.npl-net.com' ||$_SERVER["HTTP_HOST"] == 'npl-net.com'||$_SERVER["HTTP_HOST"] == '10.1.49.16' ){
                    //production
                    //$host = '10.1.49.6';
                    //exec("curl http://gpsmsg.prod1.novellpharm.com/erp/sendNotif/sendByInbox?inbox_id=".$insert_id);
                    exec("curl -XPOST -d 'lang=id&inbox_id=".$insert_id."' 'https://gpsmsg.prod2.novellpharm.com/api/gpsmsg-send-byinbox'");

                }else if ($_SERVER["HTTP_HOST"] == 'dev.npl-net.com'){
                    //development
                    //$host = 'localhost';
                    //exec("curl http://gpsmsg.dev1.novellpharm.com/erp/sendNotif/sendByInbox?inbox_id=".$insert_id);
                    exec("curl -XPOST -d 'lang=id&inbox_id=".$insert_id."' 'https://gpsmsg.dev2.novellpharm.com/api/gpsmsg-send-byinbox'");

                }else {
                    
                    //local
                    //$host = 'localhost';
                    exec("curl -XPOST -d 'lang=id&inbox_id=".$insert_id."' 'https://gpsmsg.dev2.novellpharm.com/api/gpsmsg-send-byinbox'");
                    
                }

                $dataret['status']=true;
                $dataret['message']='Sended';
                $dataret['datacount']=$retdata;
                echo json_encode($dataret);
                break;
            
            default:
                $get=$this->input->get();
                $gg=array();
                foreach ($get as $key => $value) {
                    $gg[]=$key.'='.$value;
                }
                $ss=implode('&', $gg);
                $data['urlform']=base_url().'processor/schedulercheck/send_mail?action=send_mail&'.$ss;//alamat kanggo nyimpen email sing dikirim
                $data['field']='send_mail';
                $data['button'] = '<button onclick="javascript:send_nodejs_tes()" class="ui-button-text icon-save" id="button">Send</button>';//tombol kanggo ngirim
                echo  $this->load->view('test_send_node',$data,TRUE);
                break;
        }
        
    }
    public function output(){
        $this->index($this->input->get('action'));
    }

    function get_readstatus($nip='0'){//iki kanggo nonton sing durung di woco
        $sql="select * from gps_msg.erp_inbox_details d where d.ldeleted=0 and d.istatus_read=0 and cnip='".$nip."'";
        $cc=$this->db_schedulercheck->query($sql)->num_rows();
        return $cc;
    }

}
