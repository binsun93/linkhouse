<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 require_once APPPATH."third_party/HT/ControllerAdmin.php";
class Project extends HT_ControllerAdmin {
 
	public $_model;
    public $_data;
    public $_data_post;
    public $_data_get;
	function __construct()	{
		$this->_model=$this->load->model('project_model');	
        $this->_data['title_module'] = 'Dự án'; 
        parent::__construct();	
	}
	public function addedit($id = false){   
		// Count # of uploaded files in array
		$total = count($_FILES['upload']['name']);

		// Loop through each file
		$files = '';
		for($i=0; $i<$total; $i++) {
		  	//Get the temp file path
		  	$tmpFilePath = $_FILES['upload']['tmp_name'][$i];
		  	$namefile    = date('dmY') . '_' . $_FILES['upload']['name'][$i] ;
		  	if($_FILES['upload']['size'][$key] <= 2097152){
			  	//Make sure we have a filepath
			  	if ($tmpFilePath != ""){
			    	//Setup our new file path
			    	$newFilePath = "../themes/uploadFiles/" . $namefile;

			    	//Upload the file into the temp dir
			    	if(move_uploaded_file($tmpFilePath, $newFilePath)) {

			      	//Handle other code here
			    		$files .= $namefile.' ';
			    	}
			  	}
		  	}
		}
		
		$textfiles = str_replace( ' ', ',', trim($files));
		if(isset($this->_data_post['files']) && !empty($this->_data_post['files'])){
			foreach($this->_data_post['files'] as $file){
				$textfilesisset .= $file . ' ';
			}
			$this->_data_post['data_post']['file'] = str_replace( ' ', ',', trim($textfilesisset));
			if($textfiles != ''){
				$this->_data_post['data_post']['file'] .= ',' . $textfiles;
			}
		}else{
			$this->_data_post['data_post']['file'] = $textfiles;
		}  
		parent::addedit($id);	 
	}

	 
}
 ?>