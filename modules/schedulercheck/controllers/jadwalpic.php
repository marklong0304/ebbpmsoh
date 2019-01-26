<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class jadwalpic extends MX_Controller {
    function __construct() {
        parent::__construct();
$this->db_schedulercheck = $this->load->database('schedulercheck',false, true);
        $this->load->library('auth');
        $this->dbset = $this->load->database('hrd', true);
        $this->user = $this->auth->user();
        $this->url = 'jadwalpic'; 
        
        //$this->load->helper('mgt');
    }
    function index($action = '') {
        $action = $this->input->get('action') ? $this->input->get('action') : 'create'; 
        //Bikin Object Baru Nama nya $grid      
        $grid = new Grid;
        $grid->setTitle('Jadwal PIC');
        //dc.m_vendor  database.tabel
        $grid->setTable('hrd.master_scheduler');     
        $grid->setUrl('jadwalpic');
        $grid->addList('vNama_Scheduler','vtype_scheduler','iDuration','tRunning_time','vAlert','vDescription');
        $grid->setSortBy('vNama_Scheduler');
        $grid->setSortOrder('asc'); //sort ordernya

        $grid->addFields('jadwaldetil');

        //setting widht grid
        $grid ->setWidth('vNama_Scheduler', '200'); 
        $grid ->setWidth('vtype_scheduler', '100'); 
        $grid ->setWidth('iDuration', '100'); 
        $grid ->setWidth('tRunning_time', '100'); 
        $grid ->setWidth('vAlert', '100'); 
        $grid->setWidth('vDescription', '300'); 

        //modif label
        $grid->setLabel('vNama_Scheduler','Nama Scheduler'); //Ganti Label
        $grid->setLabel('vDescription','Keterangan');
        $grid->setLabel('vtype_scheduler','Tipe');
        $grid->setLabel('iScheduler_grppic_id','Group PIC');
        $grid->setLabel('iDuration','Durasi');
        $grid->setLabel('tRunning_time','Running Time');
        $grid->setLabel('vAlert','Re-Alert Time');
        $grid->setLabel('cPic','PIC');

        //align
        $grid->setAlign('vtype_scheduler','center');
        $grid->setAlign('iDuration','right');
        $grid->setAlign('tRunning_time','center');
        $grid->setAlign('vAlert','right');
        

        
        
        $grid->setSearch('vNama_Scheduler');
        $grid->setRequired('vNama_Scheduler');    //Field yg mandatori
        $grid->setRequired('vDescription');  //Field yg mandatori
        $grid->setFormUpload(TRUE);
        
        
    // ini untuk dropdown jika ada field yang menggunakan pilihan
        //$grid->changeFieldType('vDescription','combobox','',array(''=>'Pilih',0=>'Yes',1=>'No'));
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
                    $ins = array();
                   // print_r($_POST);
                        $startdate =$_POST['startdate']; 
                        $enddate =$_POST['finishdate'] ;
                        $cboPic =$_POST['cboPic'] ;

                        
                        if (isset($_POST)) {
                            $cNip = $this->user->gNIP;
                            $tUpdated = date('Y-m-d H:i:s', mktime());
                            $bulan = date('m');
                            $enip = $cboPic;
                            

                            /*$bulbul = substr($value, 5,2);
                                                    // delete jadwal sebelumnya
                                                    $SQL = "UPDATE hrd.master_jadwal_pic set lDeleted='1', dupdate='{$tUpdated}', cUpdate='{$cNip}' where month(dDate) = '{$bulbul}'  and cPic = '{$nip}' ";*/

                            if($cboPic <> "All"){
                               
                                $SQL = "UPDATE hrd.master_jadwal_pic set lDeleted='1', dupdate='{$tUpdated}', cUpdate='{$cNip}' where dDate >= '{$startdate}' and dDate <= '{$enddate}'  and cPic = '".$cboPic."' ";
                               
                                $this->db_schedulercheck->query($SQL);
                            }else{

                                 $SQL = "UPDATE hrd.master_jadwal_pic set lDeleted='1', dupdate='{$tUpdated}', cUpdate='{$cNip}' where dDate >= '{$startdate}' and dDate <= '{$enddate}' ";
                               
                                $this->db_schedulercheck->query($SQL);

                            }

                            if (is_array($_POST) || is_object($_POST))
                            {
                                $i=1;
                                foreach ( $_POST as $nip => $tgl) {
                                    $ins['cPic'] = $nip;
                                    $enipnya = $nip;
                                   
                                    
                                   



                                    if (is_array($tgl) || is_object($tgl))
                                    {
                                        foreach ( $tgl as $key=> $values) {
                                            if (is_array($values) || is_object($values))
                                            {
                                                foreach ( $values as $key2 => $value) {
                                                    

                                                    

                                                    //$ins['dDate'] = date('Y-m-'.$value); 
                                                    $ins['dDate'] = $value; 
                                                    // query delete 
                                                    $this->db_schedulercheck->insert('hrd.master_jadwal_pic', $ins);    


                                                }
                                            }
                                        }
                                    }
                                    $i++;
                                }
                            }


                            

                        }
                        $r['status'] = TRUE;
                        $r['message'] = "Data Updated.";
                        echo json_encode($r);
                      //  echo $grid->saved_form();
                        break;
                case 'update':
                        $grid->render_form($this->input->get('id'));
                        break;
                case 'updateproses':
                        echo $grid->updated_form();
                        break;

                case 'getPic':
                    echo $this->getPic();
                break;  

                case 'delete':
                        echo $grid->delete_row();
                        break;
                default:
                        $grid->render_grid();
                        break;
        }
    }

     /*manipulasi view object form begin*/

    function insertBox_jadwalPic_jadwaldetil($field, $id) {
        
        $sqlpic = ' select a.cPic from hrd.master_scheduler a where a.lDeleted=0 and a.cPic is not null
                    union 
                    select b.vnip from hrd.scheduler_group_pic_detail b where b.lDeleted=0 
                    union 
                    select c.cNip from hrd.employee c where c.cNip = "'.$this->user->gNIP.'"
                    ';
        $datas = $this->db_schedulercheck->query($sqlpic)->result_array();
       
        $periodeawal = date('Y-m-01'); // hard-coded '01' for first day
        $periodeakhir = date('Y-m-t');
        $last_day_this_month  = date('t');

        
        $firstday = $periodeawal;
        $lastday  =$periodeakhir;
       

        $cNip = $this->user->gNIP;
        $data['firstday']=$firstday;
        $data['lastday']=$lastday;

        $data['judul']='ini judul';
        $data['datas']=$datas;
        $data['nmbulan']=date('F, Y');
        $data['meNip']=$cNip;
        $data['elPic'] = $this->listPICNew($cNip,date('Y-m-d'));//listPIC($pic,true);
        $data['periodeawal']=$periodeawal;
        $data['periodeakhir']=$periodeakhir;

        $return = $this->load->view('partial/piccalendar',$data,TRUE);

        $return .='<script>
                    
                    $(".rows_label[for=jadwalpic_jadwaldetil]").hide();
                    $(".rows_label[for=jadwalpic_jadwaldetil]").next().css("margin-left","0");
                    </script>';
        return $return;
    }

    function listPICNew($nip=null,$resignDate=null,$division=null,$isAll=false) {
        
        $this->auth->setNip( $nip );
        $this->auth->setResignDate( $resignDate );
        $this->auth->setDivision( $division );
        $this->auth->setSortBy( 'vName' );
        
        $arrSelf = $this->auth->getSelf();

       // print_r($arrSelf);
        
        $rows = $this->auth->getInferior( '', $arrSelf );
       // print_r($rows);
        $allpic = '';
        $opt = "<select name=\"cboPic\" id=\"cboPic\">
                        <option value='All'>All</option>";
        if($isAll) {
            $opt.= "<option value='all'>ALL</option>";
            foreach($rows as $row){
                $opt.="<option value=".$row['cNip'];
                //if($row['cNip']==$nip)$opt.=" selected='selected'";
                $opt.=">" . $this->capital_name($row['vName']) . "</option>";
            }
        } else {
            $i=1;
            foreach($rows as $key => $row){
                $allpic .= ',"'.$row['cNip'].'"';
                
                
                


                $opt.="<option value=".$row['cNip'];
                if($row['cNip']==$nip)$opt.=" selected='selected'";
                $opt.=">" . $this->capital_name($row['vName']) . "</option>";
                
            $i++;
            }
        }       
        $opt .= "</select>";
        $allpic= ltrim($allpic, ',');
        //$opt .= "<input type='text' name='allpic' value=".$allpic.">";
        $opt .= "<span id='allpic' style='display:none;'>".$allpic."<span>";
        return $opt;
        
    }

    function capital_name($name, $semua = ''){
        $name = trim($name);
        $name_exp = explode(' ',$name);
        $i=0;
        $ret='';
        foreach($name_exp as $e){
            $nama = trim($e);
            $nama=ucwords(strtolower($e));

            if($ret=='')$ret .= $nama;
            else $ret = $ret.' '.$nama;
            
            if(!$semua){
                if($i==1)return $ret;
            }
            $i++;
        }
        return $ret;
    }




    

    function manipulate_update_button($buttons) {
        if ($this->input->get('action') == 'view') {unset($buttons['update']);}

        else{

        }
        return $buttons;
    }


    function getPic() {
            $term = $this->input->get('term');      
            $data = array();
            $sql = "select * 
                    from hrd.employee a
                    join hrd.company b on a.iCompanyID=b.iCompanyId
                    where 
                    a.lDeleted=0
                    and a.iDivisionID in (6) 
                    and a.dresign='0000-00-00'
                    and  ( a.vName like '%".$term."%'  or a.cNip like '%".$term."%' )
                    ";
            $query = $this->db_schedulercheck->query($sql);
            if ($query->num_rows > 0) {
                foreach($query->result_array() as $line) {
                    $row_array['value'] = trim($line['cNip']).' - '.trim($line['vName']);
                    $row_array['nip']    = $line['cNip'];
                    $row_array['nama']    = trim($line['vName']);
                    $row_array['company']    = $line['vCompName'];
                    $row_array['status']    = $line['cEmpStat'];
                    $row_array['dPassProbation']    = $line['dPassProbation'];
                    

                    array_push($data, $row_array);
                }
            }
            echo json_encode($data);
            exit;
    }


    function before_insert_processor($row, $postData) {

        
            if($postData['vtype_scheduler']==1){
                $postData['cPic']=null;
            } 
            
        
        $postData['dCreate'] = date('Y-m-d H:i:s');
        $postData['cCreated'] =$this->user->gNIP;


        
        
        return $postData;

    }

    function before_update_processor($row, $postData) {
    
        // ubah status submit
        if($postData['vtype_scheduler']==1){
                $postData['cPic']=null;
        } 

        $postData['dupdate'] = date('Y-m-d H:i:s');
        $postData['cUpdate'] =$this->user->gNIP;
        
        return $postData;

    }

    function listBox_jadwalPic_vtype_scheduler($value) {
        if($value==0){$vstatus='Solo';}
        elseif($value==1){$vstatus='Group';}
        return $vstatus;
    }



     /*manipulasi view object form end*/

     /*Function Pendukung begin*/

     /*Function Pendukung end*/


    public function output(){
        $this->index($this->input->get('action'));
    }

}
