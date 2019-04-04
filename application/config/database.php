<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| .-------------------------------------------------------------------
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


// if($_SERVER["HTTP_HOST"] == 'www.npl-net.com' ||$_SERVER["HTTP_HOST"] == 'npl-net.com'||$_SERVER["HTTP_HOST"] == '10.1.49.16' ){
    //production
    //$host = '10.1.49.8';
	$host = 'localhost';

// }else if ($_SERVER["HTTP_HOST"] == 'dev.npl-net.com'){
// 	//development
// 	$host = 'localhost';

// }else {

//     //local
//     $host = 'localhost';

// }

$active_group = 'default';
$active_record = TRUE;


$db['default']['hostname'] = $host;
$db['default']['username'] = 'root';
$db['default']['password'] = '';
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


$db['hrd']['hostname'] = $host;
$db['hrd']['username'] = 'root';
$db['hrd']['password'] = '';
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



/*gpsm*/
$db['gps_msg']['hostname'] = $host;
$db['gps_msg']['username'] = 'root';
$db['gps_msg']['password'] = '';
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


/*balai*/
$db['balai']['hostname'] = $host;
$db['balai']['username'] = 'root';
$db['balai']['password'] = '';
$db['balai']['database'] = 'bbpmsoh';
$db['balai']['dbdriver'] = 'mysql';
$db['balai']['dbprefix'] = '';
$db['balai']['pconnect'] = TRUE;
$db['balai']['db_debug'] = TRUE;
$db['balai']['cache_on'] = FALSE;
$db['balai']['cachedir'] = '';
$db['balai']['char_set'] = 'utf8';
$db['balai']['dbcollat'] = 'utf8_general_ci';
$db['balai']['swap_pre'] = '';
$db['balai']['autoinit'] = TRUE;
$db['balai']['stricton'] = FALSE;



//include("sub_database.php");
/* End of file database.php */
/* Location: ./application/config/database.php */
