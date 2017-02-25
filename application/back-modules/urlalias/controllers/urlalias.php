<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 require_once APPPATH."third_party/HT/ControllerAdmin.php";
class Urlalias extends HT_ControllerAdmin {
 
	public $_model;
    public $_data;
    public $_data_post;
    public $_data_get;
	function __construct()	{
		parent::__construct();	
		$this->_model=$this->load->model('urlalias_model');	
        $this->_data['title_module'] = 'Url Alias'; 
	}
	public function addedit($id = false){   
		 
		/* Upload Hinh Anh */
        if (!empty($this->_data_post['data_post'])) { 
            move_uploaded_file($_FILES['img']['tmp_name'], '../upload/images/images/' . time() . "_" . $_FILES['img']['name']);
            $this->_data_post['data_post']['mimage'] = time() . "_" . $_FILES['img']['name'];  
        } 
        /* END Upload Hinh Anh */ 
		parent::addedit($id);	 
	}
}
 ?>