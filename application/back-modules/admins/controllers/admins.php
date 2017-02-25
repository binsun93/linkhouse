<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 require_once APPPATH."third_party/HT/ControllerAdmin.php";
class Admins extends HT_ControllerAdmin {
 
	public $_model;
    public $_data;
    public $_data_post;
    public $_data_get;
	function __construct()	{
		
		$this->_model=$this->load->model('Admins_model');	
		$this->_Admingroup_model=$this->load->model('admin_group/Admin_group_model');	
        $this->_Loglogin_model=$this->load->model('loglogin/Loglogin_model'); 
		$_SESSION[$_SESSION['admin_htv_user']]['name_module'] = 'admins';
		$_SESSION[$_SESSION['admin_htv_user']]['code'] = '';
        $this->_data['title_module'] = 'Admins'; 
        parent::__construct();  
	}
	public function addedit($id = false){   
		$where = array();
		$where['status'] = 1;
	  	$this->_data['group_admin'] = $this->_Admingroup_model->getList($where); 

	  	if(!empty($this->_data_post)){
	  		if($id){  // update
		  		if(trim($this->_data_post['data_post']['password']) != ''){  // Co thay doi password
	 
	 				$arrPass = $this->create_pass(); 
		  			$this->_data_post['data_post']['salt'] = $arrPass['salt'];
		  			$this->_data_post['data_post']['password'] = $arrPass['password'];
		  		}else{
		  			unset($this->_data_post['data_post']['password']);
		  		}
		  	}else{   // insert
		  		$arrPass = $this->create_pass(); 
	  			$this->_data_post['data_post']['salt'] = $arrPass['salt'];
	  			$this->_data_post['data_post']['password'] = $arrPass['password'];
		  	}
		}
		parent::addedit($id);	 
	}

	function create_pass($salt = false){
		$arr = array();
        $arr['salt'] = substr( md5(rand()), 0, 7); 
        if($salt){
            $arr['salt'] = $salt;
        }  
		$arr['password'] = $this->_data_post['data_post']['password']; 
		$arr['password'] = md5(md5($arr['salt'].$arr['password'].$arr['salt'])); 

 

		return $arr;
	}


	function changepassword() {
        // Chua xong
		$where = array();
		$where['admin_id'] = $this->session->userdata('admin_htv_id');
        $this->_data['detail'] = $this->_model->getList($where); 
        $this->template->build("changepassword", $this->_data);
    }

	public function login() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        	$where = array();
        	$where['username'] = $this->_data_post['email'];
        	$where['status'] = 1;  
            $rowRs = $this->_model->getList($where);
            $row = $rowRs[0];
            $this->_data_post['data_post']['password'] = trim($_POST['password']);
            //echo   $this->create_pass($row->salt)['password'] .'____'. $row->password; exit;
            if ($row) {  
                // echo $this->create_pass($row->salt)['password'] .'___'. $row->password; exit;
                if ($this->create_pass($row->salt)['password'] == $row->password) { 
                    $userdata = array(
                        'admin_htv_id' => $row->id,
                        'admin_htv_user' => $row->username,    
                        'admin_group_id' => $row->admin_group_id,   
                        'last_ip' => $_SERVER['REMOTE_ADDR'], 
                        'isLoggedIn_htv' => TRUE);
                    $this->session->set_userdata($userdata); 
                     
                    redirect('admins', 'refresh');
                } else {//password	 
                    redirect('admins/login', 'refresh');
                } 
            } else {//row 
                redirect('admins/login', 'refresh');
            }
        } else { //REQUEST_METHOD
            if ($this->session->userdata('PAGE_DEFAULT_ADMIN')) {
                redirect($this->session->userdata('PAGE_DEFAULT_ADMIN'), 'refresh');
            } 
            $data["title"] = "Administrator Login";
            $this->load->view('login', $data);
        }
    }
    public function logout() { 
        $userdata = array( 
            'admin_htv_id' => '',
            'admin_htv_user' => '', 
            'admin_htv_email' => '',
            'admin_group_id' => '', 
            'PAGE_DEFAULT_ADMIN' => '', 
            'last_ip' => '',
            'permision_htv' => '',
            'isLoggedIn_htv' => FALSE);
        $this->session->unset_userdata($userdata); 
        redirect('admins/login', 'refresh');
    }


}
 ?>