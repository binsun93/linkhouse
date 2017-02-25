<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 require_once APPPATH."third_party/HT/ControllerFront.php";
class Schedule extends HT_ControllerFront {
 
	public $_model;
    public $_data;
    public $_data_post;
    public $_data_get;
	function __construct()	{
		parent::__construct();	
		$this->_model=$this->load->model('schedule_model');	 
		$this->_model_channel = $this->load->model('channel/channel_model');	 
		$this->_model_program = $this->load->model('program/program_model');	 
		$this->_model_schedule = $this->load->model('schedule/schedule_model');	  

	}

	function index(){
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$rs = array(); 
		$rs['current_time'] = '00:00';
		/// Get List 
		$select = 'chan_id , name , slug , image , slogan';
		$where = array('status' => 1);  
		$order = array('sort' => 'DESC');
		$rs['channels'] = $this->_model_channel->getList($where , false , $order , false ,false ,$select);

		// Get Schedule
		foreach ($rs['channels'] as $key => &$value) { 
			$sch_id = $value->chan_id . '-' . date("Y-m-d", time()); // 9-2016-12-18 
			$select = 'data_schedule';
			$where = array('sch_id' => $sch_id , 'status' => 1);   
			$value->schedule = $this->_model_schedule->getOne($where , false , false , false , false , $select); 
			if(empty($value->schedule)){
				unset($rs['channels'][$key]);
			}
		}  

		// POST
		$dataPost = $this->input->post();
		if(isset($dataPost['ajax']) && $dataPost['ajax'] == 1){
			$rs['current_time'] = date('H:m' , time()); 
			$this->load->view('index', $rs);
			return;
		}

		// GET  TEST
		$rs['current_time'] = date('H:m' , time());     
		$rs['current_url'] = base_url('lich-phat-song');  

		
		$this->template->build('index', $rs);  
		return;
	}	  

}
 ?>