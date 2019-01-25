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

    $thisIP = "10.1.49.8";
    //error_reporting(E_ALL);
    //ini_set("display_errors", 1);

    $appList = array(
       /* 'default'   =>array('erp_core','Erp_core01','erp_privi'),
        'artwork'   =>array('erp_artwork','Erp_artwork01','purchasing'),
        //'brosur'    =>array('erp_brosur','Erp_brosur01','brosur'),
        'cost'      =>array('erp_cost','Erp_cost01','purchasing'),
        'formulasi' =>array('erp_formulasi','Erp_formulasi01','reformulasi'),
        'core'      =>array('erp_core','Erp_core01','gpsmsg'),
        'complain'  =>array('erp_complain','Erp_complain01','complain'),
        'custcare'  =>array('erp_custcare','Erp_custcare01','smsc'),
        'etcsvc'    =>array('erp_etcsvc','Erp_etcsvc01','asset'),*/
        /*baru*/
        'svc0'=> array('erp_svc0',"q,65y?@_!z#<P(qe",'asset'),
        'brosur'=> array('erp_brosur0',";Q/q~@x=Ou6s@+rC",'brosur'),
        'koperasi'=> array('erp_koperasi',"@|Sj2MI;Xpw<`?6o",'koperasi'),
        'warehouse'=> array('erp_warehouse',"T}],9_yAvshe_U*@",'plc2'),
        'hpp'=> array('erp_hpp',"jS+*2phW$/'`CWyU",'hpp'),
        'pk'=> array('erp_pk',";%.ghb-$^]'VBM2J",'hrd'),
        'gantt'=> array('erp_gantt',"Qf8ga}>0[dlF8<=m",'ganttchart'),
        'plc0'=> array('erp_plc0',"x[RGyD(VV]C++5?q",'plc2'),
        'plcotc'=> array('erp_plcotc',"0ks.%1H)&GCL=ohZ",'plc2'),
        'schedulercheck'=> array('erp_scheduler',"H?zdwDb[kU1z%}@)",'hrd'),
        'inventory'=> array('erp_inventory',"wybhjBlV3>u%%OX`",'inventory'),
        'pddetail'=> array('erp_pddetail',"e{+~pPs{v6pc7U.l",'pddetail'),
        'rework'=> array('erp_rework',"pD>V2>{!V4v!(Rp'",'kanban'),
        'kartucall'=> array('erp_kartucall',"27N16BwcBa0%J6UP",'kartu_call'),
        'formulasi'=> array('erp_reformulasi',"7|I,//1mAJ@M^.`e",'reformulasi'),
        'complaint'=> array('erp_complaint',"6eLKh!9#'IJdNyI^",'complain'),
        'deviasi'=> array('erp_deviasi',",^ru.Vi00+i)mz^2",'deviasi'),
        'plcexport'=> array('erp_plcexport',"bMUH{^`_JxE|*n5*",'dossier'),
        'kalibrasi'=> array('erp_kalibrasi',";=C'9S4A5O~M;2mP",'kalibrasi'), 
        'gpsm'=> array('mob_gpsm',"a[oU>l6~;9&n~^?>",'gps_msg'), 
        /*baru*/
        
        'kknote'    =>array('erp_kknote','Erp_kknote01','hrd'),
        /*'flexell'    =>array('erp_flexell','Erp_flexell01','manufacturing'),*/
        'gantt'    =>array('erp_gantt','Erp_gantt01','hrd'),
        'outlet'   =>array('erp_misell', 'Erp_misell01', 'general'),
    );

    foreach($appList as $k => $v){
        $db[$k]['hostname'] = $thisIP;
        $db[$k]['dbdriver'] = 'mysql';
        $db[$k]['username'] = $v[0];
        $db[$k]['password'] = $v[1];
        $db[$k]['database'] = $v[2];
    }

    /*$db['dbplc']['username'] = 'erp_brosur';
    $db['dbplc']['password'] = 'Erp_brosur01';
    $db['dbplc']['database'] = 'plc2';*/

    /*$db['artwork']['username'] = 'erp_artwork';
    $db['artwork']['password'] = 'Erp_artwork01';
    $db['artwork']['database'] = 'purchasing';

    $db['brosur']['username'] = 'erp_brosur';
    $db['brosur']['password'] = 'Erp_brosur01';
    $db['brosur']['database'] = 'brosur';

    $db['cost']['username'] = 'erp_cost';
    $db['cost']['password'] = 'Erp_cost01';
    $db['cost']['database'] = 'purchasing';

    $db['formulasi']['username'] = 'erp_formulasi';
    $db['formulasi']['password'] = 'Erp_formulasi01';
    $db['formulasi']['database'] = 'reformulasi';

    $db['core']['username'] = 'erp_core';
    $db['core']['password'] = 'Erp_core01';
    $db['core']['database'] = 'gpsmsg';

    $db['etcsvc']['username'] = 'erp_etcsvc';
    $db['etcsvc']['password'] = 'Erp_etcsvc01';
    $db['etcsvc']['database'] = 'asset';

    $db['complain']['username'] = 'erp_complain';
    $db['complain']['password'] = 'Erp_complain01';
    $db['complain']['database'] = 'complain';

    $db['custcare']['username'] = 'erp_custcare';
    $db['custcare']['password'] = 'Erp_custcare01';
    $db['custcare']['database'] = 'smsc';  */
