<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 require_once APPPATH."third_party/HT/ControllerFront.php";
class Crawler extends HT_ControllerFront {
 
	public $_model;
    public $_data;
    public $_data_post;
    public $_data_get;
	function __construct()	{
		parent::__construct();	
		$this->_model=$this->load->model('crawler_model');	 
		$this->_model_channel = $this->load->model('channel/channel_model');	 
		$this->_model_program = $this->load->model('program/program_model');	 
		$this->_model_schedule = $this->load->model('schedule/schedule_model');	 
	}

	function index(){

		// Find all images 
		// foreach($html->find('div.entry-inner p') as $element) 
		//        echo $element->innertext . '<br>';

		// echo $html->find('div.entry-inner p')[0]->innertext; 
		

		for($i = 0 ; $i < 5 ; $i++){
			$dateStr = date("d/m/Y" , time() + ($i * 3600 * 24));
			$this->ScheduleVTV($dateStr);
		}


		
	}	 	
		





	function ScheduleVTV($date = "11/12/2016"){ 

		$dateArr = explode("/" , $date);

		// Create DOM from URL or file
		// http://vtv.vn/lich-phat-song-ngay-13-thang-12-nam-2016.htm
		$html = file_get_html('http://vtv.vn/lich-phat-song-ngay-'.$dateArr[0].'-thang-'.$dateArr[1].'-nam-'.$dateArr[2].'.htm');
  
		// Get Chanel List By Link
		$chanelList = array();
		foreach($html->find('div.window ul.list-channel') as $keyGroup => $eleGroup) {  
			foreach($eleGroup->find('li') as $keyChanel => $eleChanel) {  
				$chanelList[] = trim(@$eleChanel->find('a', 0)->title , 'Xem truyền hình trực tiếp kênh ');
			} 
		}
  
		// Get Chanel Content
		$resultChanelContent = array(); 
		foreach($html->find('div.window ul.programs') as $keyGroup => $eleGroup) {  
			$indexChanelContent = remove_accent($chanelList[$keyGroup]);
			$resultChanelContent[$indexChanelContent] = array();
			$arrResultChanel = array(); 
			foreach($eleGroup->find('li') as $keyChanel => $eleChanel) {  
				$arrResultChanel[$keyChanel]['time'] = @$eleChanel->find('span.time', 0)->innertext;
				$arrResultChanel[$keyChanel]['title'] = @$eleChanel->find('span.title', 0)->innertext;
				$arrResultChanel[$keyChanel]['genre'] = @$eleChanel->find('a.genre', 0)->innertext; 
			} 
			$resultChanelContent[$indexChanelContent]['schedule'] = $arrResultChanel; 
			$resultChanelContent[$indexChanelContent]['name'] =  $chanelList[$keyGroup];
		} 
 
		foreach($resultChanelContent as $key => $val){

			// Insert Channel
			$where = array();
			$where['slug'] = $key;
			$channel = $this->_model_channel->getOne($where);
			if(empty($channel)){
				// Insert Channel To DB
				$dataInsert = array();
				$dataInsert['name'] = $val['name'];
				$dataInsert['slug'] = $key; 
				$dataInsert['status'] = 1; 
				$this->_model_channel->insert($dataInsert);
				$channel = $this->_model_channel->getOne($where);
			}


			$arrSchedule = array();
			foreach($val['schedule']   as $keyS => $valS ){
				// Insert Program 
				$slugS = remove_accent($valS['title']);
				$valS['genre'] = trim($valS['genre']);
				$where = array();
				$where['slug'] = $slugS;
				$program = $this->_model_program->getOne($where);
				if(empty($program)){
					// Insert Program To DB
					$dataInsert = array();
					$dataInsert['name'] = $valS['title'];
					$dataInsert['slug'] = $slugS; 
					$dataInsert['name_sub'] = $valS['genre']; 
					$dataInsert['status'] = 1; 
					$this->_model_program->insert($dataInsert);
				}  
				if(empty($valS['genre']))
					$arrSchedule[$valS['time']] = $valS['title']; 
				else
					$arrSchedule[$valS['time']] = $valS['title'] . "||" . $valS['genre']; 
			} 
			// Insert Schedule   
			$schId = $channel[0]->chan_id. "-" . $dateArr[2] . "-" . $dateArr[1] . "-" . $dateArr[0]; 
			$dataS = json_encode($arrSchedule); 
			$where = array();
			$where['sch_id'] = $schId;
			$schedule = $this->_model_schedule->getOne($where);
			if(empty($schedule)){
				// Insert Program To DB
				$dataInsert = array();
				$dataInsert['sch_id'] = $schId;
				$dataInsert['data_schedule'] = $dataS; 
				$dataInsert['status'] = 1; 
				$this->_model_schedule->insert($dataInsert);
			} 
		}
 
	 


		echo "DONE: $date <br />";
		return;
	}
 
   
 
}
 ?>