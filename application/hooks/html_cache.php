<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 function html_cache()
{ global $CFG,$OUT;
     //ini_set("pcre.recursion_limit", "16777");
//    $CI =& get_instance();
    //$CFG->config['html_cache']
     if(!$CFG->config['html_cache']||$_GET['dev']||$_GET['ajax']) return;

    /* @var $redis MY_Redis */
    $redis=& load_class('Redis', 'libraries',"MY_");//$CI->load->library("Redis","slave");
    $redis->create_connect("slave");
    $hash=$_SERVER['REQUEST_URI'];
    $lastmdf=$redis->h_soft_get('html_cache',$hash."_last");
    if (isset($_SERVER["HTTP_IF_MODIFIED_SINCE"])) {
        $if_modified_since = preg_replace ("/;.*$/", "", $_SERVER["HTTP_IF_MODIFIED_SINCE"]);
        if($lastmdf==$if_modified_since) {
            header("HTTP/1.1 304 optimized tuyen.bui@yestech.vn");
            header ('Cache-Control: max-age=9999, must-revalidate');
            header ('Optimized-By: tuyenbui.com');
            die();
        }
    }
    if($value=$redis->h_soft_get('html_cache',$hash)){
            //header("HTTP/1.1 304 optimize tuyen.bui@yestech.vn");
            header('Last-Modified: '.$lastmdf );
            header ('Cache-Control: max-age=9999, must-revalidate');
            header ('Optimized-By: tuyenbui.com');
         $OUT->_display( $value,true,false); die();
        //header("Content-Encoding:gzip"); 
        //$output=gzcompress($output, 9);
        //header("Content-Encoding: ".$encoding);
        //print("\x1f\x8b\x08\x00\x00\x00\x00\x00");
        //echo $value;exit;
    }
    
}
/* End of file compress.php */
/* Location: ./system/application/hooks/compress.php */