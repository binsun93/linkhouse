<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 require_once APPPATH."third_party/HT/ControllerFront.php";
class Header extends HT_ControllerFront {
 
	public $_model;
    public $_data;
    public $_data_post;
    public $_data_get;
	function __construct()	{
		parent::__construct();	
		$this->_model=$this->load->model('header_model');	 
	}

	function index(){
		$data['SEO'] = $this->load->library('SEO'); 
		$this->load->view('index', $data);
	}
 
   
 
}
 ?>