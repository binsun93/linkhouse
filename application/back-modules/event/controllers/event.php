<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 require_once APPPATH."third_party/HT/ControllerAdmin.php";
class Event extends HT_ControllerAdmin {
 
    public $_model;
    public $_data;
    public $_data_post;
    public $_data_get;
    function __construct()  {
        
        $this->_model=$this->load->model('event_model');  
        $this->_data['title_module'] = 'Sự kiện'; 
        parent::__construct();  
    }
    public function addedit($id = false){
    	$this->_data_post['data_post']['start_date'] = date('Y-m-d h:i', strtotime($this->_data_post['data_post']['start_date']));
    	$this->_data_post['data_post']['end_date']   = date('Y-m-d h:i', strtotime($this->_data_post['data_post']['end_date']));

		parent::addedit($id);	 
	}
 

     
}
 ?>