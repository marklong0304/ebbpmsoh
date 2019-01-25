<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class gdashboard extends MX_Controller {
    function __construct() {
        parent::__construct();
$this->db_schedulercheck = $this->load->database('schedulercheck',false, true);
        $this->load->library('auth');
        $this->dbset = $this->load->database('hrd', true);
        $this->user = $this->auth->user();
    }
    function index($action = '') {
        $action = $this->input->get('action');
        //Bikin Object Baru Nama nya $grid      
        $grid = new Grid;
        $grid->setTitle('Dashboard');
        //dc.m_vendor  database.tabel
        $grid->setTable('hrd.scheduler_log');     
        $grid->setUrl('gdashboard');
        $grid->addList('master_scheduler.vNama_Scheduler','dScoreLog','iStatus','pic','scheduler_alert.SSID','scheduler_alert.istatus_alert');
        $grid->setSortBy('dScoreLog');
        $grid->setSortOrder('DESC'); //sort ordernya

    //    $grid->addFields('master_scheduler.vNama_Scheduler','dScoreLog','detail');

        //setting widht grid
        $grid ->setWidth('master_scheduler.vNama_Scheduler', '150'); 
        $grid->setWidth('dScoreLog', '120'); 
        $grid->setWidth('iStatus', '100'); 
        $grid->setWidth('pic', '150'); 
        $grid->setWidth('scheduler_alert.SSID', '80'); 
        $grid->setWidth('scheduler_alert.istatus_alert', '100'); 
        


        $grid->setAlign('iStatus', 'center'); 
        $grid->setAlign('dScoreLog', 'center'); 
        $grid->setAlign('scheduler_alert.SSID', 'center'); 
        $grid->setAlign('scheduler_alert.istatus_alert', 'center'); 

        //modif label
        $grid->setLabel('master_scheduler.vNama_Scheduler','Nama Scheduler'); //Ganti Label
        $grid->setLabel('dScoreLog','Last Run');
        $grid->setLabel('iStatus', 'Status'); 
        $grid->setLabel('pic', 'PIC'); 
        $grid->setLabel('scheduler_alert.SSID', 'SSID'); 
        $grid->setLabel('scheduler_alert.istatus_alert', 'Status'); 
        
        //$grid->setSearch('master_scheduler.vNama_Scheduler','dScoreLog');
        $grid->setRequired('master_scheduler.vNama_Scheduler');    //Field yg mandatori
        $grid->setRequired('dScoreLog');  //Field yg mandatori
        $grid->setFormUpload(TRUE);
        
        $grid->setJoinTable('hrd.master_scheduler', 'master_scheduler.iMaster_Scheduler_id = scheduler_log.iMaster_Scheduler_id', 'inner');
        $grid->setJoinTable('hrd.scheduler_alert', 'scheduler_alert.ischeduler_log_id = scheduler_log.ischeduler_log_id', 'left');
    // ini untuk dropdown jika ada field yang menggunakan pilihan
        $grid->changeFieldType('scheduler_alert.istatus_alert','combobox','',array(''=>'',0=>'Pending',1=>'Running'));
        $grid->setGridView('grid');
        
        switch ($action) {
                case 'json':
                        $grid->getJsonData();
                        break;
                case 'view':
                        $grid->render_form($this->input->get('id'), true);
                        break;
                case 'create':
                        $grid->render_form();
                        break;
                case 'getsatuan':
                        echo $this->getSatuan();
                        break;
                case 'createproses':
                        break;
                case 'update':
                        $grid->render_form($this->input->get('id'));
                        break;
                case 'updateproses':
                        echo $grid->updated_form();
                        break;
                case 'delete':
                        echo $grid->delete_row();
                        break;
                default:
                        $grid->render_grid();
                        break;
        }
    }


    public function manipulate_grid_button($button) {
        $piew ='<div id="news_ticker">
                    <span class="news_ticker">ALERT SCHEDULER</span>
                    <ul class="news_ticker" >';
                    $sch ="
                       select * 
                        from hrd.scheduler_alert a 
                        join hrd.scheduler_log b on b.iScheduler_log_id=a.ischeduler_log_id
                        join hrd.master_scheduler c on c.iMaster_Scheduler_id=b.iMaster_Scheduler_id
                        where 
                        a.lDeleted=0
                        and b.lDeleted=0
                        and c.lDeleted=0
                        and a.istatus_alert=0
                        and a.SSID is null
                    ";
                    $rows= $this->db_schedulercheck->query($sch)->result_array();

                       foreach ($rows as $row) {
                             $piew .= '<li class="news_ticker" ><span class="isi"> Scheduler '.$row['vNama_Scheduler'].' belum meimiliki PIC untuk check </span></li>';
                       }
                       
                        
        $piew .=   '</ul>
                </div>'; 
        $piew .='<style type="text/css">
                    #news_ticker {
                        background: -moz-linear-gradient(center top , #1e5f8f, #3496df) repeat-x scroll 0 0 rgba(0, 0, 0, 0);
                        width: 100%;
                        height: 27px;
                        overflow: hidden;
                        -webkit-border-radius: 4px;
                        -moz-border-radius: 4px;
                        border-radius: 4px;
                        padding: 3px;
                        position: relative;
                       
                        -moz-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.5);
                        box-shadow: inset 0px 1px 2px rgba(0,0,0,0.5);
                    } 
                    span.news_ticker{
                        float: left;
                        color: rgba(0,0,0,.8);
                        color: #fff;
                        
                        padding: 6px;
                        position: relative;
                        border-radius: 4px;
                        font-size: 12px;
                        -webkit-box-shadow: inset 0px 1px 1px rgba(255, 255, 255, 0.2), 0px 1px 1px rgba(0,0,0,0.5);
                       
                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#004b67", endColorstr="#003548",GradientType=0 );
                    }

                    ul.news_ticker{
                        float: left;
                        padding-left: 20px;
                        -webkit-animation: ticker 10s cubic-bezier(1, 0, .5, 0) infinite;
                        -moz-animation: ticker 10s cubic-bezier(1, 0, .5, 0) infinite;
                        -ms-animation: ticker 10s cubic-bezier(1, 0, .5, 0) infinite;
                        animation: ticker 10s cubic-bezier(1, 0, .5, 0) infinite;
                    }
                    ul.news_ticker:hover {
                        -webkit-animation-play-state: paused;
                        -moz-animation-play-state: paused;
                        -ms-animation-play-state: paused;
                        animation-play-state: paused;
                    }
                    li.news_ticker {line-height: 26px;}
                    #news_ticker span.isi {
                        color: #fff;
                        text-decoration: none;
                        font-size: 13px;
                    }

                    @-webkit-keyframes ticker {
                        0%   {margin-top: 0;}
                        25%  {margin-top: -26px;}
                        50%  {margin-top: -52px;}
                        75%  {margin-top: -78px;}
                        100% {margin-top: 0;}
                    }
                    @-moz-keyframes ticker {
                        0%   {margin-top: 0;}
                        25%  {margin-top: -26px;}
                        50%  {margin-top: -52px;}
                        75%  {margin-top: -78px;}
                        100% {margin-top: 0;}
                    }
                    @-ms-keyframes ticker {
                        0%   {margin-top: 0;}
                        25%  {margin-top: -26px;}
                        50%  {margin-top: -52px;}
                        75%  {margin-top: -78px;}
                        100% {margin-top: 0;}
                    }
                    @keyframes ticker {
                        0%   {margin-top: 0;}
                        25%  {margin-top: -26px;}
                        50%  {margin-top: -52px;}
                        75%  {margin-top: -78px;}
                        100% {margin-top: 0;}
                    }

                    
                </style>';
        $button['create'] = $piew;
        return $button;


         
    } 

    function manipulate_update_button($buttons, $rowData) {
        if ($this->input->get('action') == 'view') {unset($buttons['update']);}

    }
     function listBox_Action($row, $actions) {
            unset($actions['view']);
         return $actions;

    }



            

    function listBox_gdashboard_scheduler_alert_SSID($value, $pk, $name, $rowData) {
        if($_SERVER["HTTP_HOST"] == 'www.npl-net.com'){
            //production
            $url_edit = "http://www.npl-net.com/ss/rawproblems/detail/$value";
            

        }else if ($_SERVER["HTTP_HOST"] == 'dev.npl-net.com'){
            //development
            $url_edit = "http://dev.npl-net.com/ss/rawproblems/detail/$value";

        }else {
            
            //local
            $url_edit = "http://localhost/ss/rawproblems/detail/$value";
            
        }


        if ($value <> "") {
            
            $valval = "<a style='color:blue;' class='hrefSmooth' href='javascript:void(0);' title='".$value."' onclick=\"window.open('".$url_edit."', '_blank', 'width=800,height=600,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0,top=10,left=10');\">$value</a>";
        }else{
            $valval = '';
        }
        return $valval;
    }   

    function listBox_gdashboard_iStatus($value, $pk, $name, $rowData) {
        if ($rowData->iStatus<>0) {
            $o = '<div class="boxed" style="background:green;align:center;"></div>';

        }else{
            $o = '<div class="boxed" style="background:red; align:center;"></div>';
            

        }
        $o .='<style type="text/css">
                    .boxed {
                     
                      width: 90px;
                      height: 15px;
                      color: black bold;
                      text-align: center;
                      
                    } 
                    
                </style>';

        return $o;
    }
    
    function listBox_gdashboard_scheduler_alert_istatus_alert($value, $pk, $name, $rowData) {
        if ($value == "") {
            $o = 'Running';

        }else{
            if ($value<>0) {
                $o = 'Running';                
            }else{
                $o = 'Pending';
            }
            

        }
        return $o;
    }


    function listBox_gdashboard_pic($value, $pk, $name, $rowData) {
        $iMaster_Scheduler_id = $rowData->iMaster_Scheduler_id; 


                    $sqlcqjenis='select * from hrd.master_scheduler a where a.iMaster_Scheduler_id=
                            "'.$iMaster_Scheduler_id.'"
                        ';
                    $datajen= $this->db_schedulercheck->query($sqlcqjenis)->row_array();

                    if ($datajen['vtype_scheduler']==1) {
                        // jika tipe group, cari membernya siapa saja 
                        $sqlcqmmber='select * 
                                        from hrd.scheduler_group_pic a
                                        join hrd.scheduler_group_pic_detail b on b.iScheduler_grppic_id=a.iScheduler_grppic_id
                                        where a.lDeleted=0
                                        and b.lDeleted=0
                                        and a.iScheduler_grppic_id=
                                        "'.$datajen['iScheduler_grppic_id'].'"
                                    ';
                        $datammbr= $this->db_schedulercheck->query($sqlcqmmber)->result_array();
                        $picnya=''; 
                        $picnyains='';  
                        if (!empty($datammbr)) {
                                $i=1;
                                foreach ($datammbr as $dm ) {
                                    if ($i > 1) {
                                        $picnya .= ', '.$dm['vnip'].'';
                                        $picnyains .= ','.$dm['vnip'];
                                    }else{
                                        $picnya .= ''.$dm['vnip'].'';
                                        $picnyains .= ','.$dm['vnip'];
                                    }
                                    $i++;
                                }

                        }
                    }else{
                        // jika tipe solo , maka ambil cPIC nya 
                        $picnya= $datajen['cPic'];
                        $picnyains= '"'.$datajen['cPic'].'"';
                        
                    }



        return $picnya;
    }





     /*manipulasi view object form begin*/
  

     /*manipulasi view object form end*/

     /*Function Pendukung begin*/

     /*Function Pendukung end*/


    public function output(){
        $this->index($this->input->get('action'));
    }

}
