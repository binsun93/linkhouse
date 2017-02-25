<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 require_once APPPATH."third_party/HT/ControllerAdmin.php";
class Recruitment extends HT_ControllerAdmin {
 
	public $_model;
    public $_data;
    public $_data_post;
    public $_data_get;
	function __construct()	{
		$this->_model=$this->load->model('recruitment_model');	
        $this->_data['title_module'] = 'Tuyển dụng'; 
        parent::__construct();	
	}
	public function index(){
		redirect('/recruitment/addedit/1', 'refresh');
		exit;
	}

	public function addedit($id = 1){
		$id = 1;  
		parent::addedit($id);	 
	}

	 
}
 ?>