<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 require_once APPPATH."third_party/HT/ControllerAdmin.php";
class User_email extends HT_ControllerAdmin {
 
	public $_model;
    public $_data;
    public $_data_post;
    public $_data_get;
	function __construct()	{
		
		$this->_model=$this->load->model('user_email_model');	
        $this->_data['title_module'] = 'Danh sách Email đăng ký'; 
        parent::__construct();	
	}
	public function addedit($id = false){     
		parent::addedit($id);	 
	}


	public function export($id = false){     
		$this->_data['dTbl'] = $this->_model->_dTbl; 
        $this->_where = array(); 
        if($this->_data_post){
            $this->_data['mulSort'] = $this->_data_post["arrSort"];
            $arrSort = explode("," , $this->_data_post["arrSort"]);
            foreach($arrSort as $key=>$value){
                $arrValue = explode("/" , $value);
                if($arrValue[0] != "")
                    $orderBy[$arrValue[0]] = $arrValue[1];
            } 
            $this->_data['orderBy'] = $orderBy; 
        } 
        // ** Default 
        $this->_data['filter'] = "all"; 
        // ** Page
  
        $limit['num'] = 10000;
        $limit['start'] = 0;
        
        
        $this->fifter();
        
        $this->_where[$this->_model->_dTbl['module_table'].'.'.$this->_model->_dTbl['module_id'].' !='] = 0;
        $this->_data['type'] = isset($this->_data_get['type'])?$this->_data_get['type']:'all';   
        if($this->_data['type']!="all")     $this->_where[$this->_model->_dTbl['module_table'].'.status'] = $this->_data['type'];
        else                         $this->_where[$this->_model->_dTbl['module_table'].'.status !='] = 2;
        $this->_data['content'] = $this->_model->getList($this->_where , $this->_like , $orderBy , false , false , false , $limit);

  
        $filename = "linkhouse_email.xls"; // File Name
		// Download file
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Type: application/ms-excel");
  

		echo "Email" ."\t" . "Date:" . "\r\n";
		foreach($this->_data['content'] as $k => $v){
			echo $v->email . "\t" . $v->create_date . "\r\n";
		}

	 




	}
	 
}
 ?>