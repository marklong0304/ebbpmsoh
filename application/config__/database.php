<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/


if($_SERVER["HTTP_HOST"] == 'www.npl-net.com' ||$_SERVER["HTTP_HOST"] == 'npl-net.com'||$_SERVER["HTTP_HOST"] == '10.1.49.16' ){
    //production
    $host = '10.1.49.6';

}else if ($_SERVER["HTTP_HOST"] == 'dev.npl-net.com' ||$_SERVER["HTTP_HOST"] == '10.1.49.8'){
	//development
	$host = 'localhost';

}else {

    //local
    $host = 'localhost';
    //$host = '10.1.49.8';

}

$active_group = 'default';
$active_record = TRUE;
/*
$db['default']['hostname'] = $host;
$db['default']['username'] = 'ipin';
$db['default']['password'] = 'ipin01';
$db['default']['database'] = 'erp_privi';
*/

$db['default']['hostname'] = $host;
$db['default']['username'] = 'nplnet';
$db['default']['password'] = 'nplnet01';
$db['default']['database'] = 'erp_privi';

$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;


/*nplinfra*/
$db['nplinfra']['hostname'] = '10.1.49.8';
$db['nplinfra']['username'] = 'nplnet';
$db['nplinfra']['password'] = 'nplnet01';
$db['nplinfra']['database'] = '';
$db['nplinfra']['dbdriver'] = 'mysql';
$db['nplinfra']['dbprefix'] = '';
$db['nplinfra']['pconnect'] = FALSE;
$db['nplinfra']['db_debug'] = FALSE;
$db['nplinfra']['cache_on'] = FALSE;
$db['nplinfra']['cachedir'] = '';
$db['nplinfra']['char_set'] = 'utf8';
$db['nplinfra']['dbcollat'] = 'utf8_general_ci';
$db['nplinfra']['swap_pre'] = '';
$db['nplinfra']['autoinit'] = TRUE;
$db['nplinfra']['stricton'] = FALSE;

/*hrd*/
/*
$db['hrd']['hostname'] = $host;
$db['hrd']['username'] = 'ipin';
$db['hrd']['password'] = 'ipin01';
$db['hrd']['database'] = 'hrd';
*/


$db['hrd']['hostname'] = $host;
$db['hrd']['username'] = 'nplnet';
$db['hrd']['password'] = 'nplnet01';
$db['hrd']['database'] = 'hrd';

$db['hrd']['dbdriver'] = 'mysql';
$db['hrd']['dbprefix'] = '';
$db['hrd']['pconnect'] = TRUE;
$db['hrd']['db_debug'] = TRUE;
$db['hrd']['cache_on'] = FALSE;
$db['hrd']['cachedir'] = '';
$db['hrd']['char_set'] = 'utf8';
$db['hrd']['dbcollat'] = 'utf8_general_ci';
$db['hrd']['swap_pre'] = '';
$db['hrd']['autoinit'] = TRUE;
$db['hrd']['stricton'] = FALSE;

/* DEVIASI */
$db['deviasi']['hostname'] = $host;
$db['deviasi']['username'] = 'nplnet';
$db['deviasi']['password'] = 'nplnet01';
$db['deviasi']['database'] = 'deviasi';
$db['deviasi']['dbdriver'] = 'mysql';
$db['deviasi']['dbprefix'] = '';
$db['deviasi']['pconnect'] = TRUE;
$db['deviasi']['db_debug'] = TRUE;
$db['deviasi']['cache_on'] = FALSE;
$db['deviasi']['cachedir'] = '';
$db['deviasi']['char_set'] = 'utf8';
$db['deviasi']['dbcollat'] = 'utf8_general_ci';
$db['deviasi']['swap_pre'] = '';
$db['deviasi']['autoinit'] = TRUE;
$db['deviasi']['stricton'] = FALSE;

/*svc*/
$db['svc']['hostname'] = $host;
$db['svc']['username'] = 'nplnet';
$db['svc']['password'] = 'nplnet01';
$db['svc']['database'] = 'asset';
$db['svc']['dbdriver'] = 'mysql';
$db['svc']['dbprefix'] = '';
$db['svc']['pconnect'] = TRUE;
$db['svc']['db_debug'] = TRUE;
$db['svc']['cache_on'] = FALSE;
$db['svc']['cachedir'] = '';
$db['svc']['char_set'] = 'utf8';
$db['svc']['dbcollat'] = 'utf8_general_ci';
$db['svc']['swap_pre'] = '';
$db['svc']['autoinit'] = TRUE;
$db['svc']['stricton'] = FALSE;

/*plc2*/
$db['plc']['hostname'] = $host;
$db['plc']['username'] = 'nplnet';
$db['plc']['password'] = 'nplnet01';
$db['plc']['database'] = 'plc2';
/*
$db['plc']['hostname'] = '127.0.0.1';
$db['plc']['username'] = 'nplnet';
$db['plc']['password'] = 'nplnet01';
$db['plc']['database'] = 'plc2';*/
$db['plc']['dbdriver'] = 'mysql';
$db['plc']['dbprefix'] = '';
$db['plc']['pconnect'] = TRUE;
$db['plc']['db_debug'] = TRUE;
$db['plc']['cache_on'] = FALSE;
$db['plc']['cachedir'] = '';
$db['plc']['char_set'] = 'utf8';
$db['plc']['dbcollat'] = 'utf8_general_ci';
$db['plc']['swap_pre'] = '';
$db['plc']['autoinit'] = TRUE;
$db['plc']['stricton'] = FALSE;

/*plc2*/
$db['plc']['hostname'] = $host;
$db['plc']['username'] = 'nplnet';
$db['plc']['password'] = 'nplnet01';
$db['plc']['database'] = 'plc2';/*
$db['plc']['hostname'] = '127.0.0.1';
$db['plc']['username'] = 'nplnet';
$db['plc']['password'] = '';
$db['plc']['database'] = 'plc2';*/
$db['plc']['dbdriver'] = 'mysql';
$db['plc']['dbprefix'] = '';
$db['plc']['pconnect'] = TRUE;
$db['plc']['db_debug'] = TRUE;
$db['plc']['cache_on'] = FALSE;
$db['plc']['cachedir'] = '';
$db['plc']['char_set'] = 'utf8';
$db['plc']['dbcollat'] = 'utf8_general_ci';
$db['plc']['swap_pre'] = '';
$db['plc']['autoinit'] = TRUE;
$db['plc']['stricton'] = FALSE;


$db['dosier']['hostname'] = $host;
$db['dosier']['username'] = 'nplnet';
$db['dosier']['password'] = 'nplnet01';
$db['dosier']['database'] = 'dossier';
$db['dosier']['database'] = 'dossier';
$db['dosier']['dbdriver'] = 'mysql';
$db['dosier']['dbprefix'] = '';
$db['dosier']['pconnect'] = TRUE;
$db['dosier']['db_debug'] = TRUE;
$db['dosier']['cache_on'] = FALSE;
$db['dosier']['cachedir'] = '';
$db['dosier']['char_set'] = 'utf8';
$db['dosier']['dbcollat'] = 'utf8_general_ci';
$db['dosier']['swap_pre'] = '';
$db['dosier']['autoinit'] = TRUE;
$db['dosier']['stricton'] = FALSE;

/*PK Online */
$db['pk']['hostname'] = $host;
$db['pk']['username'] = 'nplnet';
$db['pk']['password'] = 'nplnet01';
$db['pk']['database'] = 'pk';
$db['pk']['dbdriver'] = 'mysql';
$db['pk']['dbprefix'] = '';
$db['pk']['pconnect'] = TRUE;
$db['pk']['db_debug'] = TRUE;
$db['pk']['cache_on'] = FALSE;
$db['pk']['cachedir'] = '';
$db['pk']['char_set'] = 'utf8';
$db['pk']['dbcollat'] = 'utf8_general_ci';
$db['pk']['swap_pre'] = '';
$db['pk']['autoinit'] = TRUE;
$db['pk']['stricton'] = FALSE;

$db['hpp']['hostname'] = $host;
$db['hpp']['username'] = 'nplnet';
$db['hpp']['password'] = 'nplnet01';
$db['hpp']['database'] = 'hpp';
$db['hpp']['dbdriver'] = 'mysql';
$db['hpp']['dbprefix'] = '';
$db['hpp']['pconnect'] = TRUE;
$db['hpp']['db_debug'] = TRUE;
$db['hpp']['cache_on'] = FALSE;
$db['hpp']['cachedir'] = '';
$db['hpp']['char_set'] = 'utf8';
$db['hpp']['dbcollat'] = 'utf8_general_ci';
$db['hpp']['swap_pre'] = '';
$db['hpp']['autoinit'] = TRUE;
$db['hpp']['stricton'] = FALSE;


/* pddetail */
$db['pddetail']['hostname'] = $host;
$db['pddetail']['username'] = 'nplnet';
$db['pddetail']['password'] = 'nplnet01';
$db['pddetail']['database'] = 'pddetail';
$db['pddetail']['dbdriver'] = 'mysql';
$db['pddetail']['dbprefix'] = '';
$db['pddetail']['pconnect'] = TRUE;
$db['pddetail']['db_debug'] = TRUE;
$db['pddetail']['cache_on'] = FALSE;
$db['pddetail']['cachedir'] = '';
$db['pddetail']['char_set'] = 'utf8';
$db['pddetail']['dbcollat'] = 'utf8_general_ci';
$db['pddetail']['swap_pre'] = '';
$db['pddetail']['autoinit'] = TRUE;
$db['pddetail']['stricton'] = FALSE;

/* kartucall */
$db['kartucall']['hostname'] = $host;
$db['kartucall']['username'] = 'nplnet';
$db['kartucall']['password'] = 'nplnet01';
$db['kartucall']['database'] = 'kartu_call';
$db['kartucall']['dbdriver'] = 'mysql';
$db['kartucall']['dbprefix'] = '';
$db['kartucall']['pconnect'] = TRUE;
$db['kartucall']['db_debug'] = TRUE;
$db['kartucall']['cache_on'] = FALSE;
$db['kartucall']['cachedir'] = '';
$db['kartucall']['char_set'] = 'utf8';
$db['kartucall']['dbcollat'] = 'utf8_general_ci';
$db['kartucall']['swap_pre'] = '';
$db['kartucall']['autoinit'] = TRUE;
$db['kartucall']['stricton'] = FALSE;



/*pm*/
/*$db['hrd']['hostname'] = '10.1.48.13';
$db['hrd']['username'] = 'ipin';
$db['hrd']['password'] = 'ipin01';
$db['hrd']['database'] = 'hrd';*/
$db['pm']['hostname'] = $host;
$db['pm']['username'] = 'nplnet';
$db['pm']['password'] = 'nplnet01';
$db['pm']['database'] = 'pm';
$db['pm']['dbdriver'] = 'mysql';
$db['pm']['dbprefix'] = '';
$db['pm']['pconnect'] = TRUE;
$db['pm']['db_debug'] = TRUE;
$db['pm']['cache_on'] = FALSE;
$db['pm']['cachedir'] = '';
$db['pm']['char_set'] = 'utf8';
$db['pm']['dbcollat'] = 'utf8_general_ci';
$db['pm']['swap_pre'] = '';
$db['pm']['autoinit'] = TRUE;
$db['pm']['stricton'] = FALSE;

//ga
$db['ga']['hostname'] = $host;
$db['ga']['username'] = 'nplnet';
$db['ga']['password'] = 'nplnet01';
$db['ga']['database'] = 'ga';
$db['ga']['dbdriver'] = 'mysql';
$db['ga']['dbprefix'] = '';
$db['ga']['pconnect'] = TRUE;
$db['ga']['db_debug'] = TRUE;
$db['ga']['cache_on'] = FALSE;
$db['ga']['cachedir'] = '';
$db['ga']['char_set'] = 'utf8';
$db['ga']['dbcollat'] = 'utf8_general_ci';
$db['ga']['swap_pre'] = '';
$db['ga']['autoinit'] = TRUE;
$db['ga']['stricton'] = FALSE;

/*general*/
$db['general']['hostname'] = $host;
$db['general']['username'] = 'nplnet';
$db['general']['password'] = 'nplnet01';
$db['general']['database'] = 'general';
$db['general']['dbdriver'] = 'mysql';
$db['general']['dbprefix'] = '';
$db['general']['pconnect'] = TRUE;
$db['general']['db_debug'] = TRUE;
$db['general']['cache_on'] = FALSE;
$db['general']['cachedir'] = '';
$db['general']['char_set'] = 'utf8';
$db['general']['dbcollat'] = 'utf8_general_ci';
$db['general']['swap_pre'] = '';
$db['general']['autoinit'] = TRUE;
$db['general']['stricton'] = FALSE;

/*purchasing*/
$db['purchase']['hostname'] = $host;
$db['purchase']['username'] = 'nplnet';
$db['purchase']['password'] = 'nplnet01';
$db['purchase']['database'] = 'purchasing';
$db['purchase']['dbdriver'] = 'mysql';
$db['purchase']['dbprefix'] = '';
$db['purchase']['pconnect'] = TRUE;
$db['purchase']['db_debug'] = TRUE;
$db['purchase']['cache_on'] = FALSE;
$db['purchase']['cachedir'] = '';
$db['purchase']['char_set'] = 'utf8';
$db['purchase']['dbcollat'] = 'utf8_general_ci';
$db['purchase']['swap_pre'] = '';
$db['purchase']['autoinit'] = TRUE;
$db['purchase']['stricton'] = FALSE;

/*icproject*/
$db['icproject']['hostname'] = '127.0.0.1';
$db['icproject']['username'] = 'nplnet';
$db['icproject']['password'] = 'nplnet01';
$db['icproject']['database'] = 'icproject';
$db['icproject']['dbdriver'] = 'mysql';
$db['icproject']['dbprefix'] = '';
$db['icproject']['pconnect'] = TRUE;
$db['icproject']['db_debug'] = TRUE;
$db['icproject']['cache_on'] = FALSE;
$db['icproject']['cachedir'] = '';
$db['icproject']['char_set'] = 'utf8';
$db['icproject']['dbcollat'] = 'utf8_general_ci';
$db['icproject']['swap_pre'] = '';
$db['icproject']['autoinit'] = TRUE;
$db['icproject']['stricton'] = FALSE;

/*sms2*/
$db['sms2']['hostname'] = $host;
$db['sms2']['username'] = 'nplnet';
$db['sms2']['password'] = 'nplnet01';
$db['sms2']['database'] = 'smsc';
$db['sms2']['dbdriver'] = 'mysql';
$db['sms2']['dbprefix'] = '';
$db['sms2']['pconnect'] = FALSE;
$db['sms2']['db_debug'] = FALSE;
$db['sms2']['cache_on'] = FALSE;
$db['sms2']['cachedir'] = '';
$db['sms2']['char_set'] = 'utf8';
$db['sms2']['dbcollat'] = 'utf8_general_ci';
$db['sms2']['swap_pre'] = '';
$db['sms2']['autoinit'] = TRUE;
$db['sms2']['stricton'] = FALSE;

/*ss*/
$db['ss']['hostname'] = $host;
$db['ss']['username'] = 'nplnet';
$db['ss']['password'] = 'nplnet01';
$db['ss']['database'] = 'ss';
$db['ss']['dbdriver'] = 'mysql';
$db['ss']['dbprefix'] = '';
$db['ss']['pconnect'] = FALSE;
$db['ss']['db_debug'] = FALSE;
$db['ss']['cache_on'] = FALSE;
$db['ss']['cachedir'] = '';
$db['ss']['char_set'] = 'utf8';
$db['ss']['dbcollat'] = 'utf8_general_ci';
$db['ss']['swap_pre'] = '';
$db['ss']['autoinit'] = TRUE;
$db['ss']['stricton'] = FALSE;

/*brosur*/
/*$db['brosur']['hostname'] = $host;
$db['brosur']['username'] = 'erp_brosur0';
$db['brosur']['password'] = 'satu';
$db['brosur']['database'] = 'brosur';
$db['brosur']['dbdriver'] = 'mysql';
$db['brosur']['dbprefix'] = '';
$db['brosur']['pconnect'] = FALSE;
$db['brosur']['db_debug'] = FALSE;
$db['brosur']['cache_on'] = FALSE;
$db['brosur']['cachedir'] = '';
$db['brosur']['char_set'] = 'utf8';
$db['brosur']['dbcollat'] = 'utf8_general_ci';
$db['brosur']['swap_pre'] = '';
$db['brosur']['autoinit'] = TRUE;
$db['brosur']['stricton'] = FALSE;*/

/*kanban*/
$db['kanban']['hostname'] = $host;
$db['kanban']['username'] = 'kanban';
$db['kanban']['password'] = 'kanban01';
$db['kanban']['database'] = 'kanban';
$db['kanban']['dbdriver'] = 'mysql';
$db['kanban']['dbprefix'] = '';
$db['kanban']['pconnect'] = TRUE;
$db['kanban']['db_debug'] = TRUE;
$db['kanban']['cache_on'] = FALSE;
$db['kanban']['cachedir'] = '';
$db['kanban']['char_set'] = 'utf8';
$db['kanban']['dbcollat'] = 'utf8_general_ci';
$db['kanban']['swap_pre'] = '';
$db['kanban']['autoinit'] = TRUE;
$db['kanban']['stricton'] = FALSE;


$db['koperasi']['hostname'] = $host;
$db['koperasi']['username'] = 'nplnet';
$db['koperasi']['password'] = 'nplnet01';
$db['koperasi']['database'] = 'koperasi';
$db['koperasi']['dbdriver'] = 'mysql';
$db['koperasi']['dbprefix'] = '';
$db['koperasi']['pconnect'] = TRUE;
$db['koperasi']['db_debug'] = TRUE;
$db['koperasi']['cache_on'] = FALSE;
$db['koperasi']['cachedir'] = '';
$db['koperasi']['char_set'] = 'utf8';
$db['koperasi']['dbcollat'] = 'utf8_general_ci';
$db['koperasi']['swap_pre'] = '';
$db['koperasi']['autoinit'] = TRUE;
$db['koperasi']['stricton'] = FALSE;


/*manufacturing */
$db['manufacture']['hostname'] = $host;
$db['manufacture']['username'] = 'nplnet';
$db['manufacture']['password'] = 'nplnet01';
$db['manufacture']['database'] = 'manufacturing';
$db['manufacture']['dbdriver'] = 'mysql';
$db['manufacture']['dbprefix'] = '';
$db['manufacture']['pconnect'] = TRUE;
$db['manufacture']['db_debug'] = TRUE;
$db['manufacture']['cache_on'] = FALSE;
$db['manufacture']['cachedir'] = '';
$db['manufacture']['char_set'] = 'utf8';
$db['manufacture']['dbcollat'] = 'utf8_general_ci';
$db['manufacture']['swap_pre'] = '';
$db['manufacture']['autoinit'] = TRUE;
$db['manufacture']['stricton'] = FALSE;


/*movell - ERP*/
$db['movell']['hostname'] = $host;
$db['movell']['username'] = 'nplnet';
$db['movell']['password'] = 'nplnet01';
$db['movell']['database'] = 'purchasing';
$db['movell']['dbdriver'] = 'mysql';
$db['movell']['dbprefix'] = '';
$db['movell']['pconnect'] = TRUE;
$db['movell']['db_debug'] = TRUE;
$db['movell']['cache_on'] = FALSE;
$db['movell']['cachedir'] = '';
$db['movell']['char_set'] = 'utf8';
$db['movell']['dbcollat'] = 'utf8_general_ci';
$db['movell']['swap_pre'] = '';
$db['movell']['autoinit'] = TRUE;
$db['movell']['stricton'] = FALSE;

/*sms*/
$db['sms']['hostname'] = '10.1.48.7';
$db['sms']['username'] = 'root';
$db['sms']['password'] = '';
$db['sms']['database'] = 'smsd';
$db['sms']['dbdriver'] = 'mysql';
$db['sms']['dbprefix'] = '';
$db['sms']['pconnect'] = FALSE;
$db['sms']['db_debug'] = FALSE;
$db['sms']['cache_on'] = FALSE;
$db['sms']['cachedir'] = '';
$db['sms']['char_set'] = 'utf8';
$db['sms']['dbcollat'] = 'utf8_general_ci';
$db['sms']['swap_pre'] = '';
$db['sms']['autoinit'] = TRUE;
$db['sms']['stricton'] = FALSE;

/*abslog*/
$db['abslog']['hostname'] = $host;
$db['abslog']['username'] = 'abslog';
$db['abslog']['password'] = 'abslog';
$db['abslog']['database'] = 'abslog';
$db['abslog']['dbdriver'] = 'mysql';
$db['abslog']['dbprefix'] = '';
$db['abslog']['pconnect'] = FALSE;
$db['abslog']['db_debug'] = TRUE;
$db['abslog']['cache_on'] = FALSE;
$db['abslog']['cachedir'] = '';
$db['abslog']['char_set'] = 'utf8';
$db['abslog']['dbcollat'] = 'utf8_general_ci';
$db['abslog']['swap_pre'] = '';
$db['abslog']['autoinit'] = TRUE;
$db['abslog']['stricton'] = FALSE;

$db['pk']['hostname'] = $host;
$db['pk']['username'] = 'nplnet';
$db['pk']['password'] = 'nplnet01';
$db['pk']['database'] = 'pk';
$db['pk']['dbdriver'] = 'mysql';
$db['pk']['dbprefix'] = '';
$db['pk']['pconnect'] = TRUE;
$db['pk']['db_debug'] = TRUE;
$db['pk']['cache_on'] = FALSE;
$db['pk']['cachedir'] = '';
$db['pk']['char_set'] = 'utf8';
$db['pk']['dbcollat'] = 'utf8_general_ci';
$db['pk']['swap_pre'] = '';
$db['pk']['autoinit'] = TRUE;
$db['pk']['stricton'] = FALSE;

/*gpsm*/
$db['gps_msg']['hostname'] = $host;
$db['gps_msg']['username'] = 'nplnet';
$db['gps_msg']['password'] = 'nplnet01';
$db['gps_msg']['database'] = 'gps_msg';
$db['gps_msg']['dbdriver'] = 'mysql';
$db['gps_msg']['dbprefix'] = '';
$db['gps_msg']['pconnect'] = TRUE;
$db['gps_msg']['db_debug'] = TRUE;
$db['gps_msg']['cache_on'] = FALSE;
$db['gps_msg']['cachedir'] = '';
$db['gps_msg']['char_set'] = 'utf8';
$db['gps_msg']['dbcollat'] = 'utf8_general_ci';
$db['gps_msg']['swap_pre'] = '';
$db['gps_msg']['autoinit'] = TRUE;
$db['gps_msg']['stricton'] = FALSE;

/*inventory*/
$db['inventory']['hostname'] = $host;
$db['inventory']['username'] = 'nplnet';
$db['inventory']['password'] = 'nplnet01';

$db['inventory']['database'] = 'inventory';
$db['inventory']['dbdriver'] = 'mysql';
$db['inventory']['dbprefix'] = '';
$db['inventory']['pconnect'] = TRUE;
$db['inventory']['db_debug'] = TRUE;
$db['inventory']['cache_on'] = FALSE;
$db['inventory']['cachedir'] = '';
$db['inventory']['char_set'] = 'utf8';
$db['inventory']['dbcollat'] = 'utf8_general_ci';
$db['inventory']['swap_pre'] = '';
$db['inventory']['autoinit'] = TRUE;
$db['inventory']['stricton'] = FALSE;

/*reformulasi*/
$db['reformulasi']['hostname'] = $host;
$db['reformulasi']['username'] = 'nplnet';
$db['reformulasi']['password'] = 'nplnet01';

$db['reformulasi']['database'] = 'reformulasi';
$db['reformulasi']['dbdriver'] = 'mysql';
$db['reformulasi']['dbprefix'] = '';
$db['reformulasi']['pconnect'] = TRUE;
$db['reformulasi']['db_debug'] = TRUE;
$db['reformulasi']['cache_on'] = FALSE;
$db['reformulasi']['cachedir'] = '';
$db['reformulasi']['char_set'] = 'utf8';
$db['reformulasi']['dbcollat'] = 'utf8_general_ci';
$db['reformulasi']['swap_pre'] = '';
$db['reformulasi']['autoinit'] = TRUE;
$db['reformulasi']['stricton'] = FALSE;

/*c2pw*
$db['c2pw']['hostname'] = $host;
$db['c2pw']['username'] = 'nplnet';
$db['c2pw']['password'] = 'nplnet01';
$db['c2pw']['database'] = 'c2pw';
$db['c2pw']['dbdriver'] = 'mysql';
$db['c2pw']['dbprefix'] = '';
$db['c2pw']['pconnect'] = TRUE;
$db['c2pw']['db_debug'] = TRUE;
$db['c2pw']['cache_on'] = FALSE;
$db['c2pw']['cachedir'] = '';
$db['c2pw']['char_set'] = 'utf8';
$db['c2pw']['dbcollat'] = 'utf8_general_ci';
$db['c2pw']['swap_pre'] = '';
$db['c2pw']['autoinit'] = TRUE;
$db['c2pw']['stricton'] = FALSE;
 * /

/*c2pw*/
/*
$db['c2pw']['hostname'] = '10.1.48.206';
$db['c2pw']['username'] = 'cpp_husnul';
$db['c2pw']['password'] = 'Cpp_husnul_01';
 * */
$db['c2pw']['hostname'] = $host;
$db['c2pw']['username'] = 'nplnet';
$db['c2pw']['password'] = 'nplnet01';

$db['c2pw']['database'] = 'smsc';
$db['c2pw']['dbdriver'] = 'mysql';
$db['c2pw']['dbprefix'] = '';
$db['c2pw']['pconnect'] = TRUE;
$db['c2pw']['db_debug'] = TRUE;
$db['c2pw']['cache_on'] = FALSE;
$db['c2pw']['cachedir'] = '';
$db['c2pw']['char_set'] = 'utf8';
$db['c2pw']['dbcollat'] = 'utf8_general_ci';
$db['c2pw']['swap_pre'] = '';
$db['c2pw']['autoinit'] = TRUE;
$db['c2pw']['stricton'] = FALSE;



/*flexell*/
$db['flexell']['hostname'] =  $host;
$db['flexell']['username'] = 'nplnet';
$db['flexell']['password'] = 'nplnet01';
$db['flexell']['database'] = 'flexell';
$db['flexell']['dbdriver'] = 'mysql';
$db['flexell']['dbprefix'] = '';
$db['flexell']['pconnect'] = TRUE;
$db['flexell']['db_debug'] = TRUE;
$db['flexell']['cache_on'] = FALSE;
$db['flexell']['cachedir'] = '';
$db['flexell']['char_set'] = 'utf8';
$db['flexell']['dbcollat'] = 'utf8_general_ci';
$db['flexell']['swap_pre'] = '';
$db['flexell']['autoinit'] = TRUE;
$db['flexell']['stricton'] = FALSE;

include("sub_database.php");
/* End of file database.php */
/* Location: ./application/config/database.php */
