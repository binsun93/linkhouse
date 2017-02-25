<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 require_once APPPATH."third_party/HT/ControllerAdmin.php";
class Provider_people extends HT_ControllerAdmin {
 
	public $_model;
    public $_data;
    public $_data_post;
    public $_data_get;
	function __construct()	{
		$this->_model=$this->load->model('provider_people_model');	
        $this->_data['title_module'] = 'Đối tác & Người thật việc thật'; 
        parent::__construct();	
	}
	public function addedit($id = false){     
		parent::addedit($id);	 
	}

	 
}
 ?>