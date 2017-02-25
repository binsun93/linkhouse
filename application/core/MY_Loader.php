<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Loader class */
require APPPATH."third_party/MX/Loader.php";

class MY_Loader extends MX_Loader {
	public function __construct(){
        parent::__construct();
    }
    public function controller($file_name){
        $CI = & get_instance();
		
        $file_path = APPPATH.'front-modules/'. $file_name .'/controllers/'.$file_name.'.php';
		
        $object_name = $file_name;
        $class_name = ucfirst($file_name);
		
        if(file_exists($file_path)){
            require $file_path;
         
            $CI->$object_name = new $class_name();
        }
        else{
            show_error("Unable to load the requested controller class: ".$class_name);
        }
    }
}