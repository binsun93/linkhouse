<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 require_once APPPATH."third_party/HT/ControllerAdmin.php";
class Loglogin extends HT_ControllerAdmin {
 
	public $_model;
    public $_data;
    public $_data_post;
    public $_data_get;
	function __construct()	{
		parent::__construct();	
		$this->_model=$this->load->model('Loglogin_model');	
        $this->_data['title_module'] = 'Log Login'; 
	}
	
	public function index() { 
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
        $this->_data['page'] = $this->_data_post['page']?$this->_data_post['page']:($this->_data_get['txtpage']?$this->_data_get['txtpage']:1); 

        // ** Page
        if($this->_data['page'] > $this->_data_get['totalPage']  && $this->_data_get['totalPage'] )
            $this->_data['page'] = $this->_data_get['totalPage'];
  
        $this->_data['numRowForPage'] = $this->_data_post['numPerPage']?$this->_data_post['numPerPage']:($this->_data_get['numPerPage']?$this->_data_get['numPerPage']:20);


        $limit['num'] = $this->_data['numRowForPage'];
        $limit['start'] = $this->_data['numRowForPage'] * ($this->_data['page'] - 1);
        
        
        $this->fifter();
        
        $this->_where[$this->_model->_dTbl['module_table'].'.'.$this->_model->_dTbl['module_id'].' !='] = 0;
        // ** Load View
        if($this->_data_post['view']){ 
            $this->_data['totalRow'] = $this->_model->count_row($this->_where,$this->_like);
            $this->_data['type'] = $this->_data_post['type'];
            $this->_data['content'] = $this->_model->getList($this->_where , $this->_like , $orderBy , false , false , false , $limit);
            $this->load->view("listTable" , $this->_data );
        }else{ 
            $this->_data['type'] = isset($this->_data_get['type'])?$this->_data_get['type']:'all';  
            $this->_data['content'] = $this->_model->getList($this->_where , $this->_like , false , false , false , false , $limit);  
            $this->_data['totalRow'] = $this->_model->count_row($this->_where,$this->_like); 
            $this->_data['searchHTML'] = $this->load->view("search" , $this->_data , true); 
            $this->_data['listTable'] = $this->load->view("listTable" , $this->_data , true);
            $this->template->build('list', $this->_data);
        } 
    }
    
     
	public function addedit($id = false){     
        redirect(base_url(__CLASS__));
   } 

}
 ?>