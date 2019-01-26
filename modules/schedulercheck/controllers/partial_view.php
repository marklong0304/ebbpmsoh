<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Partial_view extends MX_Controller {
    function __construct() {
        parent::__construct();
$this->db_schedulercheck = $this->load->database('schedulercheck',false, true);
		$this->load->library('auth');
		$this->dbset = $this->load->database('dosier', true);
		$this->dbset2 = $this->load->database('hrd', true);
		$this->user = $this->auth->user();
    }

    function index($action = '') {
    	$action = $this->input->get('action');

    	switch ($action) {
			case 'gethistsch':
				echo $this->gethistsch();
				break;
			case 'gettabeldatadash':
				echo $this->gettabeldatadash();
				break;
			case 'gettabeldatadashsrc':
				echo $this->gettabeldatadashsrc();
				break;
			case 'gettabeldatadashdate':
				echo $this->gettabeldatadashdate();
				break;
			case 'gettabeldatadashsrcdate':
				echo $this->gettabeldatadashsrcdate();
				break;
			case 'getheader1':
				echo $this->getheader1();
				break;
			case 'getheader2':
				echo $this->getheader2();
				break;
			case 'getalert':
				echo $this->getalert();
				break;
			case 'getnonames':
				echo $this->nonames();
				break;
			case 'getJadwal':
				echo $this->getJadwal();
				break;
			default:
				echo $this->gethistsch();
				break;
		}

    }

    function gethistsch(){
    	$periodeawal=$_POST['startdate'];
    	$periodeakhir=$_POST['finishdate'];
    	$iMaster_Scheduler_id= $_POST['iMaster_Scheduler_id'];

    	$data['judul'] = 'ini judul';
    	if ($iMaster_Scheduler_id <> 'all') {
    		// per scheduler
			$sqlijo = '
				select count(*) as jumijo
				from hrd.scheduler_log a 
				join hrd.master_scheduler b on b.iMaster_Scheduler_id=a.iMaster_Scheduler_id
				where 
				a.lDeleted=0
				and b.lDeleted=0
				and a.iStatus=1
				and b.iMaster_Scheduler_id="'.$iMaster_Scheduler_id.'"
				and date(a.dScoreLog) >="'.$periodeawal.'"
				and date(a.dScoreLog) <="'.$periodeakhir.'"
							';

			$sqlred = '
				select count(*) as jumred 
				from hrd.scheduler_log a 
				join hrd.master_scheduler b on b.iMaster_Scheduler_id=a.iMaster_Scheduler_id
				where 
				a.lDeleted=0
				and b.lDeleted=0
				and a.iStatus=0
				and b.iMaster_Scheduler_id="'.$iMaster_Scheduler_id.'"
				and date(a.dScoreLog) >="'.$periodeawal.'"
				and date(a.dScoreLog) <="'.$periodeakhir.'"
							';

			$sqldata = 'select *,c.dCreate as mulai,d.pic as vpic,c.SSID,d.date_posted,d.tMarkedAsFinished,if (d.tMarkedAsFinished="0000-00-00 00:00:00",0, TIMEDIFF(d.tMarkedAsFinished,d.date_posted) ) as durasi
						from hrd.scheduler_log a 
						join hrd.master_scheduler b on b.iMaster_Scheduler_id=a.iMaster_Scheduler_id
						join hrd.scheduler_alert c on c.ischeduler_log_id=a.iScheduler_log_id
						join hrd.ss_raw_problems d on d.id=c.SSID
						where 
						a.lDeleted=0
						and b.lDeleted=0
						and a.iStatus=0
						and c.lDeleted=0
						and d.Deleted="No"
						and b.iMaster_Scheduler_id="'.$iMaster_Scheduler_id.'"
						and date(a.dScoreLog) >="'.$periodeawal.'"
						and date(a.dScoreLog) <="'.$periodeakhir.'"
						';


    		$view = $this->load->view('partial/history_scheduler_detil_search',$data,TRUE);
    	}else{
    		//all
    		$view = $this->load->view('partial/history_scheduler_all_search',$data,TRUE);
    	}

    	
		return $view;

    }
	function gettabeldatadash(){
			$periodeakhir=date('Y-m-d') ;
			$monthakhir=date('m') ;
			$iMaster_Scheduler_id = $_POST['iMaster_Scheduler_id'];

			$time = new DateTime($periodeakhir);
			$datenya =$time;
			$rdate = $datenya->format('Y-');
			$s = $rdate.'01-01';
							
			if ($monthakhir > 6) {
				// ini semester 2 , awal YYYY-07-01
				$s = $rdate.'07-01';
			}else{
				// in iawal semeter 1 YYYY-01-01
				$s = $rdate.'01-01';
			}

			$periodeawal = date("Y-m-d",strtotime($s));

			$sqlijo = '
				select count(*) as jumijo
				from hrd.scheduler_log a 
				join hrd.master_scheduler b on b.iMaster_Scheduler_id=a.iMaster_Scheduler_id
				where 
				a.lDeleted=0
				and b.lDeleted=0
				and a.iStatus=1
				and b.iMaster_Scheduler_id="'.$iMaster_Scheduler_id.'"
				and date(a.dScoreLog) >="'.$periodeawal.'"
				and date(a.dScoreLog) <="'.$periodeakhir.'"
							';
			$dataijo = $this->db_schedulercheck->query($sqlijo)->row_array();
				//echo $sqlijo ;
				//echo "<br>";

			$sqlred = '
				select count(*) as jumred 
				from hrd.scheduler_log a 
				join hrd.master_scheduler b on b.iMaster_Scheduler_id=a.iMaster_Scheduler_id
				where 
				a.lDeleted=0
				and b.lDeleted=0
				and a.iStatus=0
				and b.iMaster_Scheduler_id="'.$iMaster_Scheduler_id.'"
				and date(a.dScoreLog) >="'.$periodeawal.'"
				and date(a.dScoreLog) <="'.$periodeakhir.'"
							';
			$datared = $this->db_schedulercheck->query($sqlred)->row_array();
			//echo $sqlred ;
			
			$sqldata = 'select 

						b.vNama_Scheduler,c.dCreate as mulai,d.pic as vpic,c.SSID,d.date_posted,d.tMarkedAsFinished
						,if (d.tMarkedAsFinished="0000-00-00 00:00:00",0, TIMEDIFF(d.tMarkedAsFinished,d.date_posted) ) as durasi
						,a.vErrorLogs,b.iMaster_Scheduler_id,a.dScoreLog as dlog
						from hrd.scheduler_log a 
						join hrd.master_scheduler b on b.iMaster_Scheduler_id=a.iMaster_Scheduler_id
						left join hrd.scheduler_alert c on c.ischeduler_log_id=a.iScheduler_log_id
						left join hrd.ss_raw_problems d on d.id=c.SSID
						where 
						a.lDeleted=0
						and b.lDeleted=0
						and a.iStatus=0
						and b.iMaster_Scheduler_id="'.$iMaster_Scheduler_id.'"
						and date(a.dScoreLog) >="'.$periodeawal.'"
						and date(a.dScoreLog) <="'.$periodeakhir.'"
						';
			$rows = $this->db_schedulercheck->query($sqldata)->result_array();

			$data['ijo']= $dataijo['jumijo'];
			$data['red']= $datared['jumred'];
			$data['rows']= $rows;
			$view = $this->load->view('partial/history_scheduler_detil_search',$data,TRUE);
			return $view;

	}

	function gettabeldatadashsrc(){
			$data = array();
			$periodeakhir=date('Y-m-d') ;
			$monthakhir=date('m') ;
			$iMaster_Scheduler_id = $_POST['iMaster_Scheduler_id'];

			$time = new DateTime($periodeakhir);
			$datenya =$time;
			$rdate = $datenya->format('Y-');
			$s = $rdate.'01-01';
							
			if ($monthakhir > 6) {
				// ini semester 2 , awal YYYY-07-01
				$s = $rdate.'07-01';
			}else{
				// in iawal semeter 1 YYYY-01-01
				$s = $rdate.'01-01';
			}

			$periodeawal = date("Y-m-d",strtotime($s));

		 	
		 	$row_array['iMaster_Scheduler_id'] = trim($iMaster_Scheduler_id);
		 	$row_array['periodeakhir'] = trim($periodeakhir);
		 	$row_array['periodeawal'] = trim($periodeawal);
		 	
		 	array_push($data, $row_array);
		 	echo json_encode($data);
		    exit;
	}

	function gettabeldatadashdate(){

		$iMaster_Scheduler_id = $_POST['iMaster_Scheduler_id'];
		$periodeawal =$_POST['src_startdate'];
		$periodeakhir =$_POST['src_finishdate'];
		
		
		
		
		if ($iMaster_Scheduler_id <> 'all') {
			$sqldata = 'select 
						b.vNama_Scheduler,c.dCreate as mulai,d.pic as vpic,c.SSID,d.date_posted,d.tMarkedAsFinished
						,if (d.tMarkedAsFinished="0000-00-00 00:00:00",0, TIMEDIFF(d.tMarkedAsFinished,d.date_posted) ) as durasi
						,a.vErrorLogs,b.iMaster_Scheduler_id,a.dScoreLog as dlog
						from hrd.scheduler_log a 
						join hrd.master_scheduler b on b.iMaster_Scheduler_id=a.iMaster_Scheduler_id
						left join hrd.scheduler_alert c on c.ischeduler_log_id=a.iScheduler_log_id
						left join hrd.ss_raw_problems d on d.id=c.SSID
						where 
						a.lDeleted=0
						and b.lDeleted=0
						and a.iStatus=0
						and b.iMaster_Scheduler_id="'.$iMaster_Scheduler_id.'"
						and date(a.dScoreLog) >="'.$periodeawal.'"
						and date(a.dScoreLog) <="'.$periodeakhir.'"
						';

			$sqlijo = '
				select count(*) as jumijo
				from hrd.scheduler_log a 
				join hrd.master_scheduler b on b.iMaster_Scheduler_id=a.iMaster_Scheduler_id
				where 
				a.lDeleted=0
				and b.lDeleted=0
				and a.iStatus=1
				and b.iMaster_Scheduler_id="'.$iMaster_Scheduler_id.'"
				and date(a.dScoreLog) >="'.$periodeawal.'"
				and date(a.dScoreLog) <="'.$periodeakhir.'"
						';
		

			$sqlred = '
				select count(*) as jumred 
				from hrd.scheduler_log a 
				join hrd.master_scheduler b on b.iMaster_Scheduler_id=a.iMaster_Scheduler_id
				where 
				a.lDeleted=0
				and b.lDeleted=0
				and a.iStatus=0
				and b.iMaster_Scheduler_id="'.$iMaster_Scheduler_id.'"
				and date(a.dScoreLog) >="'.$periodeawal.'"
				and date(a.dScoreLog) <="'.$periodeakhir.'"
						';
			$datared = $this->db_schedulercheck->query($sqlred)->row_array();
			$data['red']= $datared['jumred'];
			$dataijo = $this->db_schedulercheck->query($sqlijo)->row_array();
		
			$rows = $this->db_schedulercheck->query($sqldata)->result_array();

			$data['ijo']= $dataijo['jumijo'];
			
			$data['rows']= $rows;
						
		}else{
			// all scheduler
			$sch ='
					SELECT  b.iMaster_Scheduler_id, b.vNama_Scheduler,m1.dScoreLog,m1.iStatus,c.SSID, if(m1.iStatus=1,"Running","Pending") as setatus
					# m1.*
					FROM hrd.scheduler_log m1 LEFT JOIN hrd.scheduler_log m2
					 ON (m1.iMaster_Scheduler_id = m2.iMaster_Scheduler_id AND m1.iScheduler_log_id < m2.iScheduler_log_id)
					join hrd.master_scheduler b on b.iMaster_Scheduler_id=m1.iMaster_Scheduler_id 
					left join hrd.scheduler_alert c on c.ischeduler_log_id=m1.iScheduler_log_id
					left join hrd.ss_raw_problems d on d.id=c.SSID
					WHERE m2.iScheduler_log_id IS NULL
					and m1.lDeleted=0
					and b.lDeleted=0
					order by m1.iStatus 
				#	and m1.iStatus=1
				#	and date(m1.dScoreLog)="2016-11-15"
				';
				$rowssch= $this->db_schedulercheck->query($sch)->result_array();

				$schRed ='
					SELECT b.iMaster_Scheduler_id, b.vNama_Scheduler,m1.dScoreLog,m1.iStatus,c.SSID, if(m1.iStatus=1,"Running","Pending") as setatus
					FROM hrd.scheduler_log m1 
					
					join hrd.master_scheduler b on b.iMaster_Scheduler_id=m1.iMaster_Scheduler_id 
					join hrd.scheduler_alert c on c.ischeduler_log_id=m1.iScheduler_log_id
					left join hrd.ss_raw_problems d on d.id=c.SSID
					WHERE 
					
					 m1.lDeleted=0
					and b.lDeleted=0
					and c.istatus_alert=0
					and date(m1.dScoreLog)=Curdate()
				';
				$rowsRed= $this->db_schedulercheck->query($schRed)->result_array();

				// all scheduler

				$periodeakhir=date('Y-m-d') ;
				$monthakhir=date('m') ;
				$time = new DateTime($periodeakhir);
				$datenya =$time;
				$rdate = $datenya->format('Y-');
				$s = $rdate.'01-01';
								
				if ($monthakhir > 6) {
					// ini semester 2 , awal YYYY-07-01
					$s = $rdate.'07-01';
				}else{
					// in iawal semeter 1 YYYY-01-01
					$s = $rdate.'01-01';
				}

				$periodeawal = date("Y-m-d",strtotime($s));


				$sqldata = 'select 

						b.vNama_Scheduler,c.dCreate as mulai,d.pic as vpic,c.SSID,d.date_posted,d.tMarkedAsFinished
						,if (d.tMarkedAsFinished="0000-00-00 00:00:00",0, TIMEDIFF(d.tMarkedAsFinished,d.date_posted) ) as durasi
						,a.vErrorLogs,b.iMaster_Scheduler_id,a.dScoreLog as dlog
						from hrd.scheduler_log a 
						join hrd.master_scheduler b on b.iMaster_Scheduler_id=a.iMaster_Scheduler_id
						left join hrd.scheduler_alert c on c.ischeduler_log_id=a.iScheduler_log_id
						left join hrd.ss_raw_problems d on d.id=c.SSID
						where 
						a.lDeleted=0
						and b.lDeleted=0
						and a.iStatus=0
						and date(a.dScoreLog) >="'.$periodeawal.'"
						and date(a.dScoreLog) <="'.$periodeakhir.'"
						';
				//echo $sqldata;
				$sqlijo = '
					select count(*) as jumijo
					from hrd.scheduler_log a 
					join hrd.master_scheduler b on b.iMaster_Scheduler_id=a.iMaster_Scheduler_id
					where 
					a.lDeleted=0
					and b.lDeleted=0
					and a.iStatus=1
					and date(a.dScoreLog) >="'.$periodeawal.'"
					and date(a.dScoreLog) <="'.$periodeakhir.'"
							';
			

				$sqlred = '
					select b.iMaster_Scheduler_id,b.vNama_Scheduler,count(*) as jumred 
					from hrd.scheduler_log a 
					join hrd.master_scheduler b on b.iMaster_Scheduler_id=a.iMaster_Scheduler_id
					where 
					a.lDeleted=0
					and b.lDeleted=0
					and a.iStatus=0
					and date(a.dScoreLog) >="'.$periodeawal.'"
					and date(a.dScoreLog) <="'.$periodeakhir.'"
					group by b.iMaster_Scheduler_id
							';
				$datared = $this->db_schedulercheck->query($sqlred)->result_array();
				$data['red']= $datared;


				$sqlnoname =	'select 
				if(a.vtype_scheduler=0, 
					(select count(*) from hrd.master_jadwal_pic b where b.lDeleted=0 and b.cPic=a.cPic and b.dDate = Curdate() )
					#else
					,
					( 
						(select count(*)
						from hrd.scheduler_group_pic b1 
						JOIN hrd.scheduler_group_pic_detail b2 on b2.iScheduler_grppic_id=b1.iScheduler_grppic_id
						JOIN hrd.master_jadwal_pic b3 on b3.cPic = b2.vnip
						where b1.lDeleted=0
						and b2.lDeleted=0
						and b3.lDeleted=0
						and b1.iScheduler_grppic_id=a.iScheduler_grppic_id
						and b3.dDate=Curdate()
					)
					
					)
				) as isAda,
				a.*
				 
				from hrd.master_scheduler a where a.lDeleted=0';
				$datanoname = $this->db_schedulercheck->query($sqlnoname)->result_array();
				$data['nonames']= $datanoname;



				$dataijo = $this->db_schedulercheck->query($sqlijo)->row_array();
				
				$rowss = $this->db_schedulercheck->query($sqldata)->result_array();

				$data['ijo']= $dataijo['jumijo'];
				
				$data['rowss']= $rowss;
				
				//$view = $this->load->view('partial/history_scheduler_all_search',$data,TRUE);

				$sqltot = 'select count(*) as logtotal
							from hrd.scheduler_log	aa where aa.lDeleted=0';
				$datatot = $this->db_schedulercheck->query($sqltot)->row_array();
				$data['totallog']= $datatot['logtotal'];

				$data['periodeakhir']=$periodeakhir;
				$data['periodeawal']=$periodeawal;

				$data['rowssch']=$rowssch;
				$data['rowsRed']=$rowsRed;
		}			
		
		
		if ($iMaster_Scheduler_id <> 'all') {
			$view = $this->load->view('partial/history_scheduler_detil_search',$data,TRUE);
		}else{
			$view = $this->load->view('partial/history_scheduler_all_search',$data,TRUE);
		}
		
		return $view;

	}

	function gettabeldatadashsrcdate(){
			$data = array();
			$iMaster_Scheduler_id = $_POST['iMaster_Scheduler_id'];
			$periodeawal =$_POST['src_startdate'];
			$periodeakhir =$_POST['src_finishdate'];

		 	
		 	$row_array['iMaster_Scheduler_id'] = trim($iMaster_Scheduler_id);
		 	$row_array['periodeakhir'] = trim($periodeakhir);
		 	$row_array['periodeawal'] = trim($periodeawal);
		 	
		 	array_push($data, $row_array);
		 	echo json_encode($data);
		    exit;
	}


	function getheader1(){

				$sch ='
					SELECT  b.iMaster_Scheduler_id, b.vNama_Scheduler,m1.dScoreLog,m1.iStatus,c.SSID, if(m1.iStatus=1,"Running","Pending") as setatus
					# m1.*
					FROM hrd.scheduler_log m1 LEFT JOIN hrd.scheduler_log m2
					 ON (m1.iMaster_Scheduler_id = m2.iMaster_Scheduler_id AND m1.iScheduler_log_id < m2.iScheduler_log_id)
					join hrd.master_scheduler b on b.iMaster_Scheduler_id=m1.iMaster_Scheduler_id 
					left join hrd.scheduler_alert c on c.ischeduler_log_id=m1.iScheduler_log_id
					left join hrd.ss_raw_problems d on d.id=c.SSID
					WHERE m2.iScheduler_log_id IS NULL
					and m1.lDeleted=0
					and b.lDeleted=0
					and m1.iStatus=1
				#	and date(m1.dScoreLog)="2016-11-15"
				';
				$rowssch= $this->db_schedulercheck->query($sch)->result_array();

				$schRed ='
					SELECT b.iMaster_Scheduler_id, b.vNama_Scheduler,m1.dScoreLog,m1.iStatus,c.SSID, if(m1.iStatus=1,"Running","Pending") as setatus
					FROM hrd.scheduler_log m1 
					
					join hrd.master_scheduler b on b.iMaster_Scheduler_id=m1.iMaster_Scheduler_id 
					join hrd.scheduler_alert c on c.ischeduler_log_id=m1.iScheduler_log_id
					left join hrd.ss_raw_problems d on d.id=c.SSID
					WHERE 
					
					 m1.lDeleted=0
					and b.lDeleted=0
					and c.istatus_alert=0
					and date(m1.dScoreLog)="2016-11-16" 
				';
				$rowsRed= $this->db_schedulercheck->query($schRed)->result_array();

				// all scheduler

				$periodeakhir=date('Y-m-d') ;
				$monthakhir=date('m') ;
				$time = new DateTime($periodeakhir);
				$datenya =$time;
				$rdate = $datenya->format('Y-');
				$s = $rdate.'01-01';
								
				if ($monthakhir > 6) {
					// ini semester 2 , awal YYYY-07-01
					$s = $rdate.'07-01';
				}else{
					// in iawal semeter 1 YYYY-01-01
					$s = $rdate.'01-01';
				}

				$periodeawal = date("Y-m-d",strtotime($s));


				$sqldata = 'select b.vNama_Scheduler,c.dCreate as mulai,d.pic as vpic,c.SSID,d.date_posted,d.tMarkedAsFinished,if (d.tMarkedAsFinished="0000-00-00 00:00:00",0, TIMEDIFF(d.tMarkedAsFinished,d.date_posted) ) as durasi
						from hrd.scheduler_log a 
						join hrd.master_scheduler b on b.iMaster_Scheduler_id=a.iMaster_Scheduler_id
						join hrd.scheduler_alert c on c.ischeduler_log_id=a.iScheduler_log_id
						join hrd.ss_raw_problems d on d.id=c.SSID
						where 
						a.lDeleted=0
						and b.lDeleted=0
						and a.iStatus=0
						and c.lDeleted=0
						and d.Deleted="No"
						and date(a.dScoreLog) >="'.$periodeawal.'"
						and date(a.dScoreLog) <="'.$periodeakhir.'"
						';
				//echo $sqldata;
				$sqlijo = '
					select count(*) as jumijo
					from hrd.scheduler_log a 
					join hrd.master_scheduler b on b.iMaster_Scheduler_id=a.iMaster_Scheduler_id
					where 
					a.lDeleted=0
					and b.lDeleted=0
					and a.iStatus=1
					and date(a.dScoreLog) >="'.$periodeawal.'"
					and date(a.dScoreLog) <="'.$periodeakhir.'"
							';
			

				$sqlred = '
					select b.iMaster_Scheduler_id,b.vNama_Scheduler,count(*) as jumred 
					from hrd.scheduler_log a 
					join hrd.master_scheduler b on b.iMaster_Scheduler_id=a.iMaster_Scheduler_id
					where 
					a.lDeleted=0
					and b.lDeleted=0
					and a.iStatus=0
					and date(a.dScoreLog) >="'.$periodeawal.'"
					and date(a.dScoreLog) <="'.$periodeakhir.'"
					group by b.iMaster_Scheduler_id
							';
				$datared = $this->db_schedulercheck->query($sqlred)->result_array();
				$data['red']= $datared;

				$dataijo = $this->db_schedulercheck->query($sqlijo)->row_array();
				
				$rowss = $this->db_schedulercheck->query($sqldata)->result_array();

				$data['ijo']= $dataijo['jumijo'];
				
				$data['rowss']= $rowss;
				
				//$view = $this->load->view('partial/history_scheduler_all_search',$data,TRUE);



				$data['periodeakhir']=$periodeakhir;
				$data['periodeawal']=$periodeawal;

				$data['rowssch']=$rowssch;
				$data['rowsRed']=$rowsRed;
				$view = $this->load->view('partial/header1',$data,true);
				return $view;
	}

	function getheader2(){

				$sch ='
					SELECT  b.iMaster_Scheduler_id, b.vNama_Scheduler,m1.dScoreLog,m1.iStatus,c.SSID, if(m1.iStatus=1,"Running","Pending") as setatus
					# m1.*
					FROM hrd.scheduler_log m1 LEFT JOIN hrd.scheduler_log m2
					 ON (m1.iMaster_Scheduler_id = m2.iMaster_Scheduler_id AND m1.iScheduler_log_id < m2.iScheduler_log_id)
					join hrd.master_scheduler b on b.iMaster_Scheduler_id=m1.iMaster_Scheduler_id 
					left join hrd.scheduler_alert c on c.ischeduler_log_id=m1.iScheduler_log_id
					left join hrd.ss_raw_problems d on d.id=c.SSID
					WHERE m2.iScheduler_log_id IS NULL
					and m1.lDeleted=0
					and b.lDeleted=0
					order by m1.iStatus 
				';
				$rowssch= $this->db_schedulercheck->query($sch)->result_array();

				$schRed ='
					SELECT b.iMaster_Scheduler_id, b.vNama_Scheduler,m1.dScoreLog,m1.iStatus,c.SSID, if(m1.iStatus=1,"Running","Pending") as setatus
					FROM hrd.scheduler_log m1 
					
					join hrd.master_scheduler b on b.iMaster_Scheduler_id=m1.iMaster_Scheduler_id 
					join hrd.scheduler_alert c on c.ischeduler_log_id=m1.iScheduler_log_id
					left join hrd.ss_raw_problems d on d.id=c.SSID
					WHERE 
					
					 m1.lDeleted=0
					and b.lDeleted=0
					and c.istatus_alert=0
					and date(m1.dScoreLog)="2016-11-16" 
				';
				$rowsRed= $this->db_schedulercheck->query($schRed)->result_array();

				// all scheduler

				$periodeakhir=date('Y-m-d') ;
				$monthakhir=date('m') ;
				$time = new DateTime($periodeakhir);
				$datenya =$time;
				$rdate = $datenya->format('Y-');
				$s = $rdate.'01-01';
								
				if ($monthakhir > 6) {
					// ini semester 2 , awal YYYY-07-01
					$s = $rdate.'07-01';
				}else{
					// in iawal semeter 1 YYYY-01-01
					$s = $rdate.'01-01';
				}

				$periodeawal = date("Y-m-d",strtotime($s));


				$sqldata = 'select b.vNama_Scheduler,c.dCreate as mulai,d.pic as vpic,c.SSID,d.date_posted,d.tMarkedAsFinished,if (d.tMarkedAsFinished="0000-00-00 00:00:00",0, TIMEDIFF(d.tMarkedAsFinished,d.date_posted) ) as durasi
						from hrd.scheduler_log a 
						join hrd.master_scheduler b on b.iMaster_Scheduler_id=a.iMaster_Scheduler_id
						join hrd.scheduler_alert c on c.ischeduler_log_id=a.iScheduler_log_id
						join hrd.ss_raw_problems d on d.id=c.SSID
						where 
						a.lDeleted=0
						and b.lDeleted=0
						and a.iStatus=0
						and c.lDeleted=0
						and d.Deleted="No"
						and date(a.dScoreLog) >="'.$periodeawal.'"
						and date(a.dScoreLog) <="'.$periodeakhir.'"
						';
				//echo $sqldata;
				$sqlijo = '
					select count(*) as jumijo
					from hrd.scheduler_log a 
					join hrd.master_scheduler b on b.iMaster_Scheduler_id=a.iMaster_Scheduler_id
					where 
					a.lDeleted=0
					and b.lDeleted=0
					and a.iStatus=1
					and date(a.dScoreLog) >="'.$periodeawal.'"
					and date(a.dScoreLog) <="'.$periodeakhir.'"
							';
			

				$sqlred = '
					select b.iMaster_Scheduler_id,b.vNama_Scheduler,count(*) as jumred 
					from hrd.scheduler_log a 
					join hrd.master_scheduler b on b.iMaster_Scheduler_id=a.iMaster_Scheduler_id
					where 
					a.lDeleted=0
					and b.lDeleted=0
					and a.iStatus=0
					and date(a.dScoreLog) >="'.$periodeawal.'"
					and date(a.dScoreLog) <="'.$periodeakhir.'"
					group by b.iMaster_Scheduler_id
							';
				$datared = $this->db_schedulercheck->query($sqlred)->result_array();
				$data['red']= $datared;

				$dataijo = $this->db_schedulercheck->query($sqlijo)->row_array();
				
				$rowss = $this->db_schedulercheck->query($sqldata)->result_array();

				$data['ijo']= $dataijo['jumijo'];
				
				$data['rowss']= $rowss;
				
				//$view = $this->load->view('partial/history_scheduler_all_search',$data,TRUE);



				$data['periodeakhir']=$periodeakhir;
				$data['periodeawal']=$periodeawal;

				$data['rowssch']=$rowssch;
				$data['rowsRed']=$rowsRed;
				
			
				$view = $this->load->view('partial/header2',$data,true);
				return $view;

	}

	function getalert(){

				$sch ='
					SELECT  b.iMaster_Scheduler_id, b.vNama_Scheduler,m1.dScoreLog,m1.iStatus,c.SSID, if(m1.iStatus=1,"Running","Pending") as setatus
					# m1.*
					FROM hrd.scheduler_log m1 LEFT JOIN hrd.scheduler_log m2
					 ON (m1.iMaster_Scheduler_id = m2.iMaster_Scheduler_id AND m1.iScheduler_log_id < m2.iScheduler_log_id)
					join hrd.master_scheduler b on b.iMaster_Scheduler_id=m1.iMaster_Scheduler_id 
					left join hrd.scheduler_alert c on c.ischeduler_log_id=m1.iScheduler_log_id
					left join hrd.ss_raw_problems d on d.id=c.SSID
					WHERE m2.iScheduler_log_id IS NULL
					and m1.lDeleted=0
					and b.lDeleted=0
					and m1.iStatus=1
				#	and date(m1.dScoreLog)="2016-11-15"
				';
				$rowssch= $this->db_schedulercheck->query($sch)->result_array();

				$schRed ='
					SELECT b.iMaster_Scheduler_id, b.vNama_Scheduler,m1.dScoreLog,m1.iStatus,c.SSID, if(m1.iStatus=1,"Running","Pending") as setatus
					FROM hrd.scheduler_log m1 
					
					join hrd.master_scheduler b on b.iMaster_Scheduler_id=m1.iMaster_Scheduler_id 
					join hrd.scheduler_alert c on c.ischeduler_log_id=m1.iScheduler_log_id
					left join hrd.ss_raw_problems d on d.id=c.SSID
					WHERE 
					
					 m1.lDeleted=0
					and b.lDeleted=0
					and c.istatus_alert=0
					and date(m1.dScoreLog)="2016-11-16" 
				';
				$rowsRed= $this->db_schedulercheck->query($schRed)->result_array();

				// all scheduler

				$periodeakhir=date('Y-m-d') ;
				$monthakhir=date('m') ;
				$time = new DateTime($periodeakhir);
				$datenya =$time;
				$rdate = $datenya->format('Y-');
				$s = $rdate.'01-01';
								
				if ($monthakhir > 6) {
					// ini semester 2 , awal YYYY-07-01
					$s = $rdate.'07-01';
				}else{
					// in iawal semeter 1 YYYY-01-01
					$s = $rdate.'01-01';
				}

				$periodeawal = date("Y-m-d",strtotime($s));


				$sqldata = 'select b.vNama_Scheduler,c.dCreate as mulai,d.pic as vpic,c.SSID,d.date_posted,d.tMarkedAsFinished,if (d.tMarkedAsFinished="0000-00-00 00:00:00",0, TIMEDIFF(d.tMarkedAsFinished,d.date_posted) ) as durasi
						from hrd.scheduler_log a 
						join hrd.master_scheduler b on b.iMaster_Scheduler_id=a.iMaster_Scheduler_id
						join hrd.scheduler_alert c on c.ischeduler_log_id=a.iScheduler_log_id
						join hrd.ss_raw_problems d on d.id=c.SSID
						where 
						a.lDeleted=0
						and b.lDeleted=0
						and a.iStatus=0
						and c.lDeleted=0
						and d.Deleted="No"
						and date(a.dScoreLog) >="'.$periodeawal.'"
						and date(a.dScoreLog) <="'.$periodeakhir.'"
						';
				//echo $sqldata;
				$sqlijo = '
					select count(*) as jumijo
					from hrd.scheduler_log a 
					join hrd.master_scheduler b on b.iMaster_Scheduler_id=a.iMaster_Scheduler_id
					where 
					a.lDeleted=0
					and b.lDeleted=0
					and a.iStatus=1
					and date(a.dScoreLog) >="'.$periodeawal.'"
					and date(a.dScoreLog) <="'.$periodeakhir.'"
							';
			

				$sqlred = '
					select b.iMaster_Scheduler_id,b.vNama_Scheduler,count(*) as jumred 
					from hrd.scheduler_log a 
					join hrd.master_scheduler b on b.iMaster_Scheduler_id=a.iMaster_Scheduler_id
					where 
					a.lDeleted=0
					and b.lDeleted=0
					and a.iStatus=0
					and date(a.dScoreLog) >="'.$periodeawal.'"
					and date(a.dScoreLog) <="'.$periodeakhir.'"
					group by b.iMaster_Scheduler_id
							';
				$datared = $this->db_schedulercheck->query($sqlred)->result_array();
				$data['red']= $datared;

				$dataijo = $this->db_schedulercheck->query($sqlijo)->row_array();
				
				$rowss = $this->db_schedulercheck->query($sqldata)->result_array();

				$data['ijo']= $dataijo['jumijo'];
				
				$data['rowss']= $rowss;
				
				//$view = $this->load->view('partial/history_scheduler_all_search',$data,TRUE);



				$data['periodeakhir']=$periodeakhir;
				$data['periodeawal']=$periodeawal;

				$data['rowssch']=$rowssch;
				$data['rowsRed']=$rowsRed;
				
			
				$view = $this->load->view('partial/dataalert',$data,true);
				return $view;

	}


	function getJadwal(){
		$allpic= $_POST['allpic'];
		if ($_POST['cboPic'] <> 'All') {
			$sqlpic = ' 
                    	select c.cNip from hrd.employee c where c.cNip = "'.$_POST['cboPic'].'"
                    ';	

		}else{
			$sqlpic = ' 
                    	select c.cNip from hrd.employee c where c.cNip in(  '.$allpic.' )
                    ';	


		}

		//echo $sqlpic;
		
        $datas = $this->db_schedulercheck->query($sqlpic)->result_array();
        $cNip = $_POST['cboPic'];
        $lastday  =$_POST['src_jadwal_end'];
        $firstday = $_POST['src_jadwal_start'];
        

        $data['allpic']=$allpic;
        $data['firstday']=$firstday;
        $data['lastday']=$lastday;
        $data['datas']=$datas;
		$data['post'] = $_POST;
		$data['meNip']=$cNip;
		$view = $this->load->view('partial/jadwalpic',$data,true);
		return $view;

	}

	function nonames(){
		$sqlnoname =	'select 
				if(a.vtype_scheduler=0, 
					(select count(*) from hrd.master_jadwal_pic b where b.lDeleted=0 and b.cPic=a.cPic and b.dDate = Curdate() )
					#else
					,
					( 
						(select count(*)
						from hrd.scheduler_group_pic b1 
						JOIN hrd.scheduler_group_pic_detail b2 on b2.iScheduler_grppic_id=b1.iScheduler_grppic_id
						JOIN hrd.master_jadwal_pic b3 on b3.cPic = b2.vnip
						where b1.lDeleted=0
						and b2.lDeleted=0
						and b3.lDeleted=0
						and b1.iScheduler_grppic_id=a.iScheduler_grppic_id
						and b3.dDate=Curdate()
					)
					
					)
				) as isAda,
				a.*
				 
				from hrd.master_scheduler a where a.lDeleted=0';
		$datanoname = $this->db_schedulercheck->query($sqlnoname)->result_array();
		$data['nonames']= $datanoname;
		$view = $this->load->view('partial/nonames',$data,true);
		return $view;

	}

	function who_am_i($nip){
		$sql_emp='select * from hrd.employee a where a.cNip ="'.$nip.'"';
		$data = $this->db_schedulercheck->query($sql_emp)->row_array();
		return $data['vName'];
	}

	

	
	
	public function output(){
		$this->index($this->input->get('action'));
	}

}


