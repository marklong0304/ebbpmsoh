<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class inject_ssid extends MX_Controller {
    function __construct() {

        parent::__construct();
$this->db_schedulercheck = $this->load->database('schedulercheck',false, true);
        $this->load->library('auth');
        $this->dbset = $this->load->database('plc', true);
        $this->user = $this->auth->user();
        $this->url = 'inject_ssid'; 
        $this->load->library('excellib/PHPExcel');
    
    
    }

    
  function index($action = '') {
      $action = $this->input->get('action') ? $this->input->get('action') : 'create'; 
        //Bikin Object Baru Nama nya $grid    
      $grid = new Grid;
      $grid->setTitle('Inject SSID GPSM');
      //dc.m_vendor  database.tabel
      $grid->setTable('hrd.ss_raw_problems');   
      $grid->setUrl('inject_ssid');

      $grid->addFields('vFile','cNip','cDate');

      //setting widht grid

      $grid->setLabel('vFile','Import File');
      $grid->setLabel('cNip','Dummy By');
      $grid->setLabel('cDate','Dummy at');
      $grid->setFormUpload(TRUE);

      
    
      //Set View Gridnya (Default = grid)
      $grid->setGridView('grid');
      
      switch ($action) {
        case 'json':
          $grid->getJsonData();
          break;      
        case 'create':
          $grid->render_form();
          break;
        case 'createproses':
          if (isset($_FILES['vFile'])) {

                  if($_FILES['vFile']['tmp_name']){

                    if(!$_FILES['vFile']['error'])
                    {


                        $inputFile = $_FILES['vFile']['tmp_name'];
                        $extension = strtoupper(pathinfo($inputFile, PATHINFO_EXTENSION));
                        
                        //if($extension == 'XLSX' || $extension == 'ODS' || $extension == 'TMP' ){

                          

                            //Read spreadsheeet workbook
                            try {
                                 $inputFileType = PHPExcel_IOFactory::identify($inputFile);
                                 $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                                     $objPHPExcel = $objReader->load($inputFile);
                            } catch(Exception $e) {
                                    die($e->getMessage());
                            }

                            //Get worksheet dimensions
                            $sheet = $objPHPExcel->getSheet(0); 
                            $highestRow = $sheet->getHighestRow(); 
                            $highestColumn = $sheet->getHighestColumn();

                            //echo "sini";
                            //Loop through each row of the worksheet in turn
                            for ($row = 2; $row <= $highestRow; $row++){ 
                                    //  Read a row of data into an array
                                    // rowData urutan NO,NO UPB
                                    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
                                    foreach($rowData as $list) 
                                    { 
                                      $problem_subject = $list[1]; // Problem Subject
                                    }


                                    $picnya = $this->user->gNIP;
                                    $picnyains = $this->user->gNIP;

                                    $id       = '';
                                    $subject = 'Akses GPSM Error untuk User '.$problem_subject;
                                    $isproject=0;
                                    $deadline =  date('Y-m-d', strtotime("+7 days"));
                                    $date_posted     = date('Y-m-d H:i:s');
                                    $description = 'Akses GPSM Error untuk User '.$problem_subject;
                                    $solution = NULL;
                                    
                                    
                                    $uppernya = $this->whoisupper($picnya);
                                    /*$posted_by=$uppernya['cUpper'];
                                    $requestor = $uppernya['cUpper'];*/
                                    $posted_by= $this->user->gNIP;
                                    //$requestor = $this->user->gNIP;
                                    if($this->user->gNIP=='N14615'){
                                      $requestor = 'N16945';
                                    }else{
                                      $requestor = 'N14615';
                                    }
                                    
                                    $category=94; //NPL System
                                    $pic2 = $picnyains;
                                    $confidential='N';
                                    $location = 2;// NPL HO
                                    $activity = 4;
                                    $company = 3 ; // Novell
                                    $parent_id = '';
                                    $assignTime = $date_posted;
                                    $validateBy = $requestor;
                                    
                                    $typeId = 25 ;//Program Application error
                                    $estimated_start=$date_posted;
                                    $estimated_finish=$deadline;
                                    $startDuration=$date_posted;
                                    $statusForm='NO';
                                    $crType='0';
                                    $crPrior=0;
                                    $crJustify = $description;
                                    $crImpact='tidak bisa login gpsm';
                                    $approveNip=$uppernya['cUpper'];


                                    $last_update_by='Auto';
                                    $aidiss = $this->saveRaw($id,$subject,$isproject,$deadline,$date_posted,$description,$solution,$posted_by,$requestor,$category,$pic2,$last_update_by,$confidential,$location,$activity,$company,$parent_id,$assignTime,$validateBy,$typeId,$estimated_start,$estimated_finish,$startDuration,$statusForm,$crType,$crPrior,$crJustify,$crImpact,$approveNip);

                                    /*if ($aidiss) {
                                      echo "Insert -  ".$subject ;
                                    }else{
                                      echo "Failed - ".$subject;
                                    }*/
                                    //INSERT INTO `ss_raw_problems` (`RefID`, `parent_id`, `problem_subject`, `problem_description`, `proposed_solution`, `requestor`, `pic`, `Priority`, `typeId`, `support_type`, `activity_id`, `eAcceptanceStat`, `date_posted`, `posted_by`, `deadline`, `assignTime`, `estimated_start`, `estimated_finish`, `estimatedDuration`, `actual_start`, `actual_finish`, `tMarkedAsFinished`, `finishing_by`, `confirm_date`, `validateDate`, `validateBy`, `validateDesc`, `verified`, `confidential`, `date_printed`, `EditCounter`, `RefEditCounter`, `Deleted`, `checked`, `LocationID`, `Time_Quadrant`, `CompanyId_support`, `satisfaction_value`, `inspectedDate`, `moduleId`, `updateSchedule`, `fixedSchedule`, `startDuration`, `taskSequence`, `parentLink`, `link`, `linkUpdate`, `documentationDate`, `picDoc`, `statusForm`, `crType`, `crPrior`, `crJustify`, `crImpact`, `crPM`, `crAtasan1`, `approveNip`, `approveDate`, `approveNote`, `rejectDate`, `rejectNote`, `taskStatus`, `mContrib`, `totSpendTime`, `confirmPP`, `bobot`, `eApproveReject`, `cNipConfirmSchedule`, `iScheduleFreq`, `ins_start`, `ins_finish`, `ins_duration`, `date_entry`, `tCreatedAt`, `last_update_by`, `iPriority`, `cKategori`, `dTarget`, `cTahun`, `cSemester`, `cProjRequestor`, `dTargetTw`, `dTgl_selesai`, `dSubmit_requirement`, `dAkhir_analisa`, `dAkhir_design_ui`, `iSizeProject`, `dTarget_deliver`, `dDeliver_Team`, `dTarget_finish`, `dTarget_testing`, `dTarget_implement`, `iClosePm`, `cClosePm`, `dclosePm`, `iCloseReq`, `cCloseReq`, `dcloseReq`, `iCloseGm`, `cCloseGm`, `dcloseGm`, `iRevisionID`, `iStatus`, `idlastFinish`, `dPreliminary`, `dPostponed`, `dCanceled`) VALUES (0, 0, 'GPS spv lampung (an. martono/E00260)', 'mas, minta tlg bantu cek gps massenger spv lampung (martono/E00260) krn laporan gps dari MR selalu terlambat masuknya (mis. MR kirim gps hari ini, laporan gps nya esok harinya baru msk ke spv), berikut nama2 MR nya :\n1. subhan/E00526\n2. eko zuliarantoko/E01340\n3. leo amar/E01460\n4. solihin/E03959\n\nmohon bantuannya\n\ntks,\niin\n', '', 'E00418', 'N13986,N14615,N17770', NULL, 28, 94, 11, 'Accepted', '2018-01-26 12:43:39', 'E00418', '2018-01-26', NULL, NULL, NULL, 0, '2018-01-29 07:45:35', '2018-01-29 07:47:17', '2018-01-29 07:47:45', 'N13986', '2018-02-07 12:21:59', NULL, '', 'undefined', 'T', 'N', NULL, 1, 0, 'No', 'No', 5, NULL, 3, 100, NULL, '0', NULL, 0, '2018-02-07 12:21:59', 1, 0, 0, NULL, NULL, NULL, 'NO', 'undefined', 0, '', '', NULL, NULL, '', NULL, NULL, NULL, NULL, 'Finish', NULL, NULL, 0, NULL, 0, '', 0, NULL, NULL, NULL, NULL, '2018-02-07 12:21:59', 'E00418', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, 9, 0, NULL, NULL, NULL);




                                    
                                    /*$cek_upb='select * 
                                            from plc2.plc2_upb a 
                                            where a.vupb_nomor = "'.$vupb_nomor.'"
                                            ';
                                    $dupb = $this->db_schedulercheck->query($cek_upb)->row_array();

                                    if (!empty($dupb)) {
                                      $cNip = $this->user->gNIP;
                                      $tUpdated = date('Y-m-d H:i:s', mktime());
                                      $SQL = "UPDATE plc2.plc2_upb set vnipKill='{$cNip}', dateKill='{$tUpdated}', iKill='1' where vupb_nomor = '{$vupb_nomor}'";
                                      $this->db_schedulercheck->query($SQL);  
                                    }*/

                            }

                        /*}
                        else{
                            echo "Please upload an XLSX or ODS file";
                        }*/
                    }
                    else{
                      echo $_FILES['spreadsheet']['error'];
                    }
                 }


            $r['message'] ='Dummy Success';
            $r['status'] = TRUE;
            //$r['last_id'] = 1;
            
            echo json_encode($r);

            

          }else{
            $r['status'] = False;
            //$r['last_id'] = 1;
            $r['message'] = 'Tidak ada File diupload';
            echo json_encode($r);
          } 

          break;
        default:
          $grid->render_form();
          break;
        }
    
  
  }



  function whoisupper($picnya){
    $sqlem = 'select * from hrd.employee a where a.cNip in ("'.$picnya.'")  limit 1';
    return $datai = $this->db_schedulercheck->query($sqlem)->row_array();
  }

  function saveRaw($id,$subject,$isproject,$deadline,$date_posted,$description,$solution,$posted_by,$requestor,$category,$pic2,$last_update_by,$confidential,$location,$activity,$company,$parent_id,$assignTime,$validateBy,$typeId,$estimated_start,$estimated_finish,$startDuration,$statusForm,$crType,$crPrior,$crJustify,$crImpact,$approveNip) {

      $id       = $id;
      $company  = $company;
      $location = $location;
      $category = $category;
      $pic      = $pic2;
      $activity = $activity;
      $module = '0';
      $confidential    =  $confidential;
      $requestor       = $requestor;
      $direksi         = (trim($requestor) == 'N00923') ? TRUE : FALSE;
      $subject         = str_replace('>', '', $subject);
      $deadline        = $deadline  ;
      $description     = $description ;
      
      $solution        = $solution;
      $parent          = $parent_id;
      $doneby          = $validateBy;
      $typeId          = $typeId;
      $atasanRequestor = $approveNip; //getDirectSuperior($requestor);
      $statusForm = 'NO';
      
      $approveNip = $approveNip;

      //echo "sampe sini cuy";
      $data = array(
          'problem_subject' => $subject,
          'RefID' => $isproject,
          'deadline' => $deadline,
          'date_posted' => $date_posted,
          'problem_description' => $description,
          'proposed_solution' => $solution,
          'posted_by' => $posted_by,
          'requestor' => $requestor,
          'support_type' => $category,
          'pic' => $pic2,
          'last_update_by' => $last_update_by,
          'confidential' => 'N',
          'LocationID' => $location,
          'activity_id' => $activity,
          'CompanyId_support' => $company,
          'parent_id' => $parent_id,
          'assignTime' => $assignTime,
          /*'validateDesc' => '',
          'validateBy' => $validateBy,*/
          // tidak butuh verificator , request pak eddy tgl 13-01-2017
          'validateDesc' => '',
          'validateBy' => '',
          'typeId' => $typeId,
          'fixedSchedule' => 0,
          'estimated_start' => $estimated_start,
          'estimated_finish' => $estimated_finish,
          'startDuration' => $startDuration,
          'taskSequence' => 0,
          'statusForm' => $statusForm,
          'crType' => $crType,
          'crPrior' => $crPrior,
          'crJustify' => $crJustify,
          'crImpact' => $crImpact,
          'approveNip' => $approveNip,
          'last_update_by' =>$pic,

          /*bagian auto finish*/
          'finishing_by' =>$pic,
          'tMarkedAsFinished' =>date('Y-m-d H:i:s', strtotime("+600 second")),
          'actual_start' =>date('Y-m-d H:i:s', strtotime("+300 second")),
          'actual_finish' =>date('Y-m-d H:i:s', strtotime("+600 second")),
          'taskStatus' =>'Finish'

          /*a.finishing_by='N07484' , 
          a.tMarkedAsFinished=a.date_posted+ interval 600 second,
          a.actual_start= a.date_posted+ interval 300 second,
          a.actual_finish=a.date_posted+ interval 600 second,
          a.taskStatus='Finish'*/
      );

      $data['eAcceptanceStat'] = 'Accepted';
      if ($direksi) {
          $data['crAtasan1']   = $requestor;
          $data['approveDate'] = date('Y-m-d H:i:s');
      }
      $where   = array(
          'id' => $id
      );

      $ff      = '1';

      $data['proposed_solution']='';
    $rawBack = $this -> db -> insert('hrd.ss_raw_problems', $data); 
    $idrawback=$this->db_schedulercheck->insert_id();
    return $idrawback;
  }          





    /*manipulasi view object form end*/
    function insertBox_inject_ssid_vFile($field, $id) {
          $return = '<input type="file" name="'.$field.'" id="'.$id.'"  class="input_rows1 required" size="15" />';
          return $return;
    }

    function insertBox_inject_ssid_cNip($field, $id) {
        $return = $this->user->gName;
        return $return;
    }

    function insertBox_inject_ssid_cDate($field, $id) {
        $return =date('Y-m-d H:i:s');
        return $return;
    }


    function before_insert_processor($row, $postData) {
      $postData['dcreate'] = date('Y-m-d H:i:s');
      $postData['cCreated'] =$this->user->gNIP;
      return $postData;

    } 


  

  



  public function output(){
    $this->index($this->input->get('action'));
  }

}
