<?php if (!defined('BASEPATH')) exit('No direct access is allowed');
class dashboard extends MX_Controller {
	
	private $dbset;
	private $url;
	private $sess_auth;
	
	public function __construct() {
		parent::__construct();
$this->db_schedulercheck = $this->load->database('schedulercheck',false, true);
		$this->sess_auth = new Zend_Session_Namespace('auth');
		$this->url = 'dashboard';
		//$this->dbset = $this->load->database('koperasi', true);
	}
	
	function index($action = '') {		
    	//Bikin Object Baru Nama nya $grid

    	$action = $this->input->get('action') ? $this->input->get('action') : 'piew';	
	
		$grid = new Grid;		
		$grid->setTitle('Dashboard');		
		$grid->setTable('hrd.masster_scheduler');		
		$grid->setUrl('dashboard');		
		$grid->addFields('company','cPeriode','format');//
		$grid->setLabel('company','Company');
		$grid->setLabel('cPeriode','Periode');
		

			
		switch ($action) {		
			case 'piew':
				$time_start = $this->microtime_float();
				/*
				$sch ='
					SELECT b.iMaster_Scheduler_id, b.vNama_Scheduler,m1.dScoreLog,m1.iStatus,c.SSID, if(m1.iStatus=1,"Running","Pending") as setatus
					FROM hrd.scheduler_log m1 
					
					join hrd.master_scheduler b on b.iMaster_Scheduler_id=m1.iMaster_Scheduler_id 
					left join hrd.scheduler_alert c on c.ischeduler_log_id=m1.iScheduler_log_id
					left join hrd.ss_raw_problems d on d.id=c.SSID
					WHERE 
					
					 m1.lDeleted=0
					and b.lDeleted=0
					and date(m1.dScoreLog)="2016-11-15" 
				';
				*/
				$sch ='select 

						(select sl.iStatus
						from hrd.scheduler_log sl 
						where sl.iMaster_Scheduler_id=ms.iMaster_Scheduler_id
						order by sl.iScheduler_log_id 
						DESC limit 1) as iStatus,

						if((select sl.iStatus
						from hrd.scheduler_log sl 
						where sl.iMaster_Scheduler_id=ms.iMaster_Scheduler_id
						order by sl.iScheduler_log_id 
						DESC limit 1)=1,"Running","Pending") as setatus, 


						(select sl.vErrorLogs
						from hrd.scheduler_log sl 
						where sl.iMaster_Scheduler_id=ms.iMaster_Scheduler_id
						order by sl.iScheduler_log_id 
						DESC limit 1) as vErrorLogs,

						(select sl.iScheduler_log_id
						from hrd.scheduler_log sl 
						where sl.iMaster_Scheduler_id=ms.iMaster_Scheduler_id
						order by sl.iScheduler_log_id 
						DESC limit 1) as iScheduler_log_id,

						(select sl.dScoreLog
						from hrd.scheduler_log sl 
						where sl.iMaster_Scheduler_id=ms.iMaster_Scheduler_id
						order by sl.iScheduler_log_id 
						DESC limit 1) as dScoreLog,

						ms.* 
						from hrd.master_scheduler ms
						where ms.lDeleted=0;
						';
				/*$sch ='
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
					LIMIT 100
				#	and m1.iStatus=1
				#	and date(m1.dScoreLog)="2016-11-15"
				';*/
				$this->db_schedulercheck->cache_on();
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
				$this->db_schedulercheck->cache_on();
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
						limit 100
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
				$this->db_schedulercheck->cache_on();
				$datared = $this->db_schedulercheck->query($sqlred)->result_array();
				$data['red']= $datared;


				$sqltot = 'select count(*) as logtotal
							from hrd.scheduler_log	aa where aa.lDeleted=0';
				$datatot = $this->db_schedulercheck->query($sqltot)->row_array();
				$data['totallog']= $datatot['logtotal'];


/*
				$sqlnoname = 'select c.vNama_Scheduler 
							from hrd.scheduler_alert a 
							join hrd.scheduler_log b on b.iScheduler_log_id=a.ischeduler_log_id
							join hrd.master_scheduler c on c.iMaster_Scheduler_id=b.iMaster_Scheduler_id
							where a.SSID is null 
							and a.lDeleted=0
							and a.istatus_alert=0';
*/
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
				 
				from hrd.master_scheduler a where a.lDeleted=0 LIMIT 50';
				$this->db_schedulercheck->cache_on();
				$datanoname = $this->db_schedulercheck->query($sqlnoname)->result_array();
				$data['nonames']= $datanoname;


				$this->db_schedulercheck->cache_on();
				$dataijo = $this->db_schedulercheck->query($sqlijo)->row_array();
				
				$this->db_schedulercheck->cache_on();
				$rowss = $this->db_schedulercheck->query($sqldata)->result_array();

				$data['ijo']= $dataijo['jumijo'];
				
				$data['rowss']= $rowss;
				
				//$view = $this->load->view('partial/history_scheduler_all_search',$data,TRUE);



				$data['periodeakhir']=$periodeakhir;
				$data['periodeawal']=$periodeawal;

				$data['rowssch']=$rowssch;
				$data['rowsRed']=$rowsRed;
				$this->load->view('dashboardNew3',$data);

				$time_end = $this->microtime_float();
				$time = $time_end - $time_start;
				print_r('This Time Rendered '.$time.' n/s');
				break;
			default:
				$grid->render_grid();
				break;
		}
	}

	function microtime_float()
	{
	    list($usec, $sec) = explode(" ", microtime());
	    return ((float)$usec + (float)$sec);
	}

	public function output(){
		$this->index('piew');
	}
}

?>
