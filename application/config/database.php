<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
$active_group = 'slave';
$active_record = TRUE;

 
// db write
$db['master']['hostname'] = 'localhost';
$db['master']['username'] = 'root';
$db['master']['password'] = '';
$db['master']['database'] = 'linkhouse';
$db['master']['dbdriver'] = 'mysql';
$db['master']['dbprefix'] = '';
$db['master']['pconnect'] = FALSE;
$db['master']['db_debug'] = TRUE;
$db['master']['cache_on'] = FALSE;
$db['master']['cachedir'] = '';
$db['master']['char_set'] = 'utf8';
$db['master']['dbcollat'] = 'utf8_general_ci';
$db['master']['swap_pre'] = '';
$db['master']['autoinit'] = TRUE;
$db['master']['stricton'] = FALSE;

//db read
$db['slave']['hostname'] = "localhost";
$db['slave']['username'] = "root";
$db['slave']['password'] = "";
$db['slave']['database'] = "linkhouse";
$db['slave']['dbdriver'] = "mysql";
$db['slave']['dbprefix'] = "";
$db['slave']['pconnect'] = FALSE;
$db['slave']['db_debug'] = true;
$db['slave']['cache_on'] = FALSE;
$db['slave']['cachedir'] = "";
$db['slave']['char_set'] = "utf8";
$db['slave']['dbcollat'] = "utf8_general_ci";
$db['slave']['swap_pre'] = "";
$db['slave']['autoinit'] = TRUE;
$db['slave']['stricton'] = FALSE;
/* End of file database.php */
/* Location: ./application/config/database.php */