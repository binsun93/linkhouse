<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 require_once APPPATH."third_party/HT/ControllerAdmin.php";
class Contact extends HT_ControllerAdmin {
 
	public $_model;
    public $_data;
    public $_data_post;
    public $_data_get;
	function __construct()	{
		$this->_model=$this->load->model('contact_model');	
        $this->_data['title_module'] = 'Liên hệ'; 
        parent::__construct();	
	}
	// public function index(){
		
	// }

	public function addedit($id = 1){
		$id = 1;  
		parent::addedit($id);	 
	}

	 
}
 ?>