<?php

class sess_auth {
    private $_ci;
    private $sess_auth;
    function __construct() {
        $this->_ci=&get_instance();
        $this->_ci->load->library('Zend', 'Zend/Session/Namespace');
        $this->sess_auth = new Zend_Session_Namespace('auth');
    }
    public function user_row() {
        return $this->sess_auth;
    }
    public function get_nip() {
        return $this->sess_auth->gNIP;
    }

    public function send_inbox_erp($modul_id=0, $group_id=0, $company_id=0, $to, $cc, $subject, $content){
        $datain['cnip_sender']=$this->get_nip();
        $date=date('Y-m-d H:i:s');
        $to=str_replace(';', ',', $to);
        $cc=str_replace(';', ',', $cc);
        $datain['vto']=$to;
        $datain['vcc']=$cc;
        $datain['vsubject']=$subject;
        $datain['tmessage']=$content;
        $datain['dcreate']=$date;
        $datain['ccreate']=$this->get_nip();
        $datain['modul_id']=$modul_id;
        $datain['company_id']=$company_id;
        $datain['group_id']=$group_id;
        $this->_ci->db->insert('gps_msg.erp_inbox',$datain);
        $insert_id = $this->_ci->db->insert_id();

        $ss=explode(',', $to);
        $cc1=explode(',', $cc);
        $dnip=array();
        $retdata=array();
        $dataret=array();
        $iddet=array();
        if ($to!='' || $cc!=''){
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
                    $ddi['ccreate']=$this->get_nip();
                    if($this->_ci->db->insert('gps_msg.erp_inbox_details',$ddi)){
                        // $iddet[] = $this->_ci->db->insert_id();
                        //header("location:http://gpsmsg.dev1.novellpharm.com/erp/sendNotif?inbox_detail_id=".$iddet);
                        $retdata[$knip]=$this->get_readstatus($knip);        
                    }
                }
            }else{
                $retdata['0']=0;
            }
            //exec("curl http://gpsmsg.dev1.novellpharm.com/erp/sendNotif/sendByInbox?inbox_id=".$insert_id);
            // if(count($iddet)>=1){
            //     foreach ($iddet as $kv => $vv) {
            //        header("location:http://gpsmsg.dev1.novellpharm.com/erp/sendNotif?inbox_detail_id=".$vv);
            //     }
            // }
            $dataret['status']=true;
            $dataret['message']='Sended';
            $dataret['datacount']=$retdata;
            return json_encode($dataret);
        }else{
            $dataret['status']=false;
            $dataret['message']='Failed';
            $dataret['datacount']=$retdata;
            return json_encode($dataret);
        }
    }
    function get_readstatus($nip='0'){
        $sql="select * from gps_msg.erp_inbox_details d where d.ldeleted=0 and d.istatus_read=0 and cnip='".$nip."'";
        $cc=$this->_ci->db->query($sql)->num_rows();
        return $cc;
    }

     function send_message_erp($segs,$to='', $cc='', $subject, $content){
        $path=$this->setPath($segs);
        $ttt=strpos($to, '@');
        $ccc=strpos($cc, '@');

        $to=str_replace(';', ',', $to);
        $cc=str_replace(';', ',', $cc);
        //echo 'to awal'.$to;
        //echo "<br>";
        if (strpos($to, '@') !== false) {
        
            $to_s = '';
            $to_arr = explode(',', trim($to));
            $i=1;
            foreach ($to_arr as $key => $value) {
                if ($value <> "") {
                     if($i==1)   {
                        $to_s .= '"'.$value.'"';
                     }else{
                        $to_s .= ',"'.$value.'"';
                     }
                     $i++;
                }
            }

            $sqlt='select * from hrd.employee em where em.vEmail in ('.$to_s.') limit 1';
            //echo $sqlt;
            $dt= $this->_ci->db->query($sqlt);

            if($dt->num_rows() > 0){
                $rr=$dt->result_array();
                $ddto=array();
                foreach ($rr as $kr => $vr) {
                    $ddto[]=$vr['cNip'];
                }
                $to=implode(',', $ddto);
            }else{
                $to='';
            }

            //echo $to.'tototo';

            $cc_s = '';
            $cc_arr = explode(',', trim($cc));
            $i=1;
            foreach ($cc_arr as $key => $value) {
                if ($value <> "") {
                     if($i==1)   {
                        $cc_s .= '"'.$value.'"';
                     }else{
                        $cc_s .= ',"'.$value.'"';
                     }
                     $i++;
                }
            }

            $sqlt='select * from hrd.employee em where em.vEmail in ('.$cc_s.') limit 1';
            $dt=$this->_ci->db->query($sqlt);

            if($dt->num_rows() > 0){
                $rr=$dt->result_array();
                $ddto=array();
                foreach ($rr as $kr => $vr) {
                    $ddto[]=$vr['cNip'];
                }
                $cc=implode(',', $ddto);
            }else{
                $cc='';
            }
          
        }else{
            $to=$to;
            $cc=$cc;
        }

        $path=str_replace('/', '_', $path);
        $sql="select a.* 
                from erp_privi.privi_modules a
                where a.isDeleted=0
                and replace(a.vPathModule,'/','_') ='".$path."'"; 
        $db=$this->_ci->load->database('core', false, true); 
        $qcc=$db->query($sql);

        if($qcc->num_rows()==0){
            echo "Error - Not Found Modules";exit();
        }else{ 
            $dm=$qcc->row_array();
            $modul_id=$dm['idprivi_modules'];
            $datain['cnip_sender']=$this->get_nip();
            $date=date('Y-m-d H:i:s');
            $to=str_replace(';', ',', $to);
            $cc=str_replace(';', ',', $cc);
            $datain['vto']=$to;
            $datain['vcc']=$cc;
            $datain['vsubject']=$subject;
            $datain['tmessage']=$content;
            $datain['dcreate']=$date;
            $datain['ccreate']=$this->get_nip();
            $datain['modul_id']=$modul_id;
            $this->_ci->db->insert('gps_msg.erp_inbox',$datain);
            $insert_id = $this->_ci->db->insert_id();
            $ss=explode(',', $to);
            $cc1=explode(',', $cc);
            $dnip=array();
            $retdata=array();
            $dataret=array();
            $iddet=array();
            if ($to!='' || $cc!=''){
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
                        $ddi['ccreate']=$this->get_nip();
                        if($this->_ci->db->insert('gps_msg.erp_inbox_details',$ddi)){
                            $retdata[$knip]=$this->get_readstatus($knip);        
                        }
                    }
                }else{
                    $retdata['0']=0;
                }

                if($_SERVER["HTTP_HOST"] == 'www.npl-net.com' ||$_SERVER["HTTP_HOST"] == 'npl-net.com'||$_SERVER["HTTP_HOST"] == '10.1.49.16' ){
                    //production
                    //$host = '10.1.49.6';
                    exec("curl http://gpsmsg.prod1.novellpharm.com/erp/sendNotif/sendByInbox?inbox_id=".$insert_id);

                }else if ($_SERVER["HTTP_HOST"] == 'dev.npl-net.com'){
                    //development
                    //$host = 'localhost';
                    exec("curl http://gpsmsg.dev1.novellpharm.com/erp/sendNotif/sendByInbox?inbox_id=".$insert_id);

                }else {
                    
                    //local
                    //$host = 'localhost';
                    exec("curl http://gpsmsg.dev1.novellpharm.com/erp/sendNotif/sendByInbox?inbox_id=".$insert_id);
                    
                }

                //exec("curl http://gpsmsg.prod1.novellpharm.com/erp/sendNotif/sendByInbox?inbox_id=".$insert_id);
                
            }
        }
    }

    function setPath($segs){
        $i=0;
        $path='';
        foreach ($segs as $segment){
            if($i==1){
                $path=$segment;
            }elseif($i>1){
                $path=$path."_".$segment;
            }
            $i++;
        }
        return $path;
    }
}