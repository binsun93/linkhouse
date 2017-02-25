<?php


require_once  APPPATH."third_party/MX/Controller.php";

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class HT_ControllerFront extends MX_Controller
{ 
	public $_model;
    public $_data_post;
    public $_data_get;
    public $_data=array();
    public $_like = false;
	function __construct()	{  
		parent::__construct();	  
        
        $this->_data_post = $this->input->post(NULL , TRUE);
        $this->_data_get = $this->input->get(NULL , TRUE);
		 
		$this->load->library('form_validation');
		$this->module_name		= $this->uri->segment(1);  
		
		$class = str_replace(CI::$APP->config->item('controller_suffix'), '', get_class($this));
		log_message('debug', $class." MX_Controller Initialized");
		Modules::$registry[strtolower($class)] = $this;	
		
		/* copy a loader instance and initialize */
		$this->load = clone load_class('Loader');
		$this->load->initialize($this);	
		
		/* autoload module items */
		$this->load->_autoloader($this->autoload);
		$this->SEO=$this->load->library("SEO");
	}	

	
	public function __get($class) {
		return CI::$APP->$class;
	}
       
	 
}
