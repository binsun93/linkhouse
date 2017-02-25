<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



/*

  |--------------------------------------------------------------------------

  | File and Directory Modes

  |--------------------------------------------------------------------------

  |

  | These prefs are used when checking and setting modes when working

  | with the file system.  The defaults are fine on servers with proper

  | security, but you may wish (or even need) to change the values in

  | certain environments (Apache running a separate process for each

  | user, PHP under CGI with Apache suEXEC, etc.).  Octal values should

  | always be used to set the mode correctly.

  |

 */

 





define('FB_ID', '846327672104446'); 

define('FB_ID_ADMIN', '123123'); 

define('NAME_SITE', 'Hot Teen Việt'); 











define('PER_PAGE_MAIN', 30); 

define('FILE_READ_MODE', 0644);

define('FILE_WRITE_MODE', 0666);

define('DIR_READ_MODE', 0755);

define('DIR_WRITE_MODE', 0777);



/*

  |--------------------------------------------------------------------------

  | File Stream Modes

  |--------------------------------------------------------------------------

  |

  | These modes are used when working with fopen()/popen()

  |

 */

define("BASE_URL", 'http' . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . str_replace('//', '/', dirname($_SERVER['SCRIPT_NAME']) . '/'));

define("BACKEND", "admincp");
 


define("SDT", "0902 414 565 - 0934 143 565");


 

define('BANNER_DEFAULT','default/banner_default.jpg');

define('POSTER_DEFAULT','default/poster_default.jpg');



define('FOPEN_READ', 'rb');

define('FOPEN_READ_WRITE', 'r+b');

define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care

define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care

define('FOPEN_WRITE_CREATE', 'ab');

define('FOPEN_READ_WRITE_CREATE', 'a+b');

define('FOPEN_WRITE_CREATE_STRICT', 'xb');

define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

 

define('THEME_FRONT' , 'http://linkhouse.dev/themes/frontnew/'); 

define('THEME_ADMIN' , 'http://linkhouse.dev/themes/admincp/'); 

 







define('DEFAULT_BANNER' , 'images/333983-ca_si_dau_mat.jpg'); 

define('DEFAULT_PROFILE_POSTER' , 'images/img-2_07.jpg'); 

define('DEFAULT_PROFILE_BANNER' , 'images/img-2_07.jpg'); 



define('DEFAULT_VIDEO_POSTER' , 'images/img-1_14.png'); 

define('DEFAULT_VIDEO_BANNER' , 'images/img-1_14.png'); 







define('CACHE1', 3600); // 1 hour

define('CACHE2', 5 * 3600);

define('CACHE3', 10 * 3600);

define('CACHE4', 24 * 3600);

define('CACHE5', 5 * 24 * 3600);

define('CACHE6', 30 * 24 * 3600);



// redis

define('CACHELOCK', 'CACHELOCK');

define('TTL_CACHELOCK', 3); //3s

define('NUM_CONN_I1', 300); // so ket noi toi da trong instance1/process khi khong co cache

define('TTL_NUM_CONN_I1', 1800); // expire time cua key num_conn_i1 (30 phut)





// Mongodb test

//define('USERNAME_MONGO','hayhaytv_mgo');

//define('PASSWORD_MONGO','dfpqnchfksfe$');

//define('DATABASE_MONGO','hayhaytv');

//define('HOST_MONGO','127.0.0.1:27017');



/* End of file constants.php */

/* Location: ./application/config/constants.php */