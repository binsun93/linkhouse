<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class My_Caches{
    public function __construct() {
    }
    function on_post_update(){
        $hkey=array("html_cache","posts","topcount");
        $this->flush_cache($hkey);
    }
    function on_livescore_update(){
        $hkey=array("livescore");
        $this->flush_cache($hkey);
    }
    function on_categories_update(){
        $this->on_post_update();
    }
    function flush_cache($hkey=array()){
        $CI=&get_instance();
            /* @var $redis MY_REdis */
        $redis=$CI->load->library('Redis','master');
        foreach ($hkey as $key) {
            $redis->soft_flush($key);
        }
    }
    function on_data_change(){
        $hkey=array("html_cache","posts","livescore");
        $this->flush_cache($hkey);
        
    }
    
}