<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 require_once APPPATH."third_party/HT/ControllerFront.php";
class Head extends HT_ControllerFront {
 
	public $_model;
    public $_data;
    public $_data_post;
    public $_data_get;
	public function __construct()	{
		parent::__construct();	
		$this->_model=$this->load->model('head_model');	 
	}

	public function index(){ 
		$this->load->view('index');
	}	  

}
 ?>