<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 require_once APPPATH."third_party/HT/ControllerAdmin.php";
class Config_home extends HT_ControllerAdmin {
 
	public $_model;
    public $_data;
    public $_data_post;
    public $_data_get;
	function __construct()	{
		
		$this->_model=$this->load->model('config_home_model');	
        $this->_data['title_module'] = 'Cấu hình Trang Chủ'; 
        parent::__construct();	
	}
	public function addedit($id = false){     
		parent::addedit($id);	 
	}

	 
}
 ?>