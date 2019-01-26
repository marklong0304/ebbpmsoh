<?php
    //echo $_SERVER['PATH_INFO']." : OLA Signore"; exit();
    /*$thisHost = gethostname();
    if($thisHost == 'WEBDEV.NOVELLPHARM.NPL'){
        $thisIP = "10.1.49.8";
    }else if($thisHost == "WEBAPP.NOVELLPHARM.NPL"){
        $thisIP = "10.1.49.6";
    }else{
        $thisIP = "localhost";
    }*/

    //$thisIP = "10.1.49.8";
    $thisIP = "localhost";

    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    $appList = array(
        
        /*'schedulercheck'=> array('erp_scheduler',"H?zdwDb[kU1z%}@)",'hrd'),
        'erp_ga'        =>array('erp_ga','6Mgc(n!7RDJf}','ga'),*/
        'hrd'           =>array('root','','hrd')
    );

    foreach($appList as $k => $v){
        $db[$k]['hostname'] = $thisIP;
        $db[$k]['dbdriver'] = 'mysql';
        $db[$k]['username'] = $v[0];
        $db[$k]['password'] = $v[1];
        $db[$k]['database'] = $v[2];
        $db[$k]['db_debug'] = TRUE;
    }
