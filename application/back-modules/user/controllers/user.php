<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends MX_Controller {

    function __construct() {
        parent::__construct();		
		$this->module_name		= $this->uri->segment(1);
		$this->table_name 		= "tbl_user_provider";	
		
		$this->config->load('define',TRUE);
        $this->load->library('form_validation');
		$this->load->library('adminclass_model');
		$this->load->model('user/user_model','ACT',TRUE);	
        $this->load->model('group/group_model','GROUP',TRUE);
    }
    //=======================================================================
    //=======================================================================
    //=======================================================================
    public function index() {
        if ($this->session->userdata("isLoggedIn") == false) {
            redirect(base_url() . 'user/login');
        }
        $data = array();
        $where = array();
        
        if($_POST){
            $data['mulSort'] = $_POST["arrSort"];
            $arrSort = explode("," , $_POST["arrSort"]);
            foreach($arrSort as $key=>$value){
                $arrValue = explode("/" , $value);
                if($arrValue[0] != "")
                    $orderBy[$arrValue[0]] = $arrValue[1];
            } 
            $data['orderBy'] = $orderBy; 
        }
         
        // ** Default
        $data['page'] = 1;
        $data['page'] = $_GET['txtpage']?$_GET['txtpage']:1;
        $data['search'] = $_GET['search']?$_GET['search']:false; 
        $data['filter'] = "all";
        $data['filter_type'] = (isset($_GET['filter_type'])&&$_GET['filter_type']!=-1)?$_GET['filter_type']:-1;
        
        // ** Page
        if($data['page'] > $_GET['totalPage']  && $_GET['totalPage'] )
            $data['page'] = $_GET['totalPage'];
        if($_POST['page'])
		      $data['page'] = $_POST['page']?$_POST['page']:1;
		$data['numRowForPage'] = $_GET['numPerPage']?$_GET['numPerPage']:20;
        $limit['per_page'] = $data['numRowForPage'];
        $limit['start'] = $data['numRowForPage'] * ($data['page'] - 1);
         
        // ** Search
        $vowels = array("đ" , "Đ");
        if(isset($_POST['search'])){
		      $data['search'] = $_POST['search'];
        } 
        if($data['search']){
            $data['search'] = str_replace( ' ', '%', $data['search'] );
            $data['search'] = str_replace($vowels, "d", $data['search']);
            $searchWhere = "( REPLACE(REPLACE(tbl_users.fullname, 'đ', 'd'), 'Đ', 'd') LIKE '%" . trim($data['search']) . "%'";
            $searchWhere .= " OR REPLACE(REPLACE(tbl_users.username, 'đ', 'd'), 'Đ', 'd') LIKE '%" . trim($data['search']) . "%'";
            $searchWhere .= " OR REPLACE(REPLACE(tbl_users.email, 'đ', 'd'), 'Đ', 'd') LIKE '%" . trim($data['search']) . "%')";
        } 
        
        if($data['filter_type'] != -1 ){ 
            $where['user_group_id'] = $data['filter_type'];
        }
            
        if(isset($_POST['user_group_id']) && $_POST['user_group_id'] != -1){ 
            $where['user_group_id'] = $_POST['user_group_id'];
        }
         
         
        // ** Load View
        if($_POST['view']){
            if($_POST['type']!="all")   $where['tbl_users.publish'] = $_POST['type'];
            else                        $where['tbl_users.publish !='] = 2;
            $data['type'] = $_POST['type'];
            $data['totalRow'] = $this->ACT->count_all_user($where , $searchWhere); 
            $data['content'] = $this->ACT->get_list($limit , $where , $orderBy , $searchWhere);
            $this->load->view("listTable" , $data );
        }else{ 
            $data['type'] = isset($_GET['type'])?$_GET['type']:'all'; 
            if($data['type']!="all")     $where['tbl_users.publish'] = $data['type'];
            else                         $where['tbl_users.publish !='] = 2;
            
            $data['group'] = $this->GROUP->get_list(FALSE , "");
            $data['totalRow'] = $this->ACT->count_all_user($where , $searchWhere);
            $data['content'] = $this->ACT->get_list($limit , $where, false , $searchWhere); 
            $data['listTable'] = $this->load->view("listTable" , $data , true);
            $this->template->build('list', $data);
        } 
    }
    public function publish() {
        $data_post = $this->input->post(); 
        $data = array(
            'publish' => $data_post['publish']
        );
        $this->ACT->publish_user($data, $data_post['id']); 
        $is_status = $data_post['publish'] == 1 ? '<a class="ico_activeOn tooltip" href="javascript:change(0 ,' . $data_post['id'] . ')"></a>' : ' <a class="ico_activeOff tooltip" href="javascript:change(1 ,' . $data_post['id'] . ')"></a>';
        echo $is_status; 
    } 
    public function delete() {
        $data_post = $this->input->post(NULL, TRUE);
        if ($data_post['id'] >= 0) {
            $data = array(
                'publish' => 2
            );
            $check = $this->ACT->publish_user($data, $data_post['id']);
            echo 'success';
        }
    }
    public function addedit($id = false) {
        if ($this->session->userdata("isLoggedIn") == false) {
            redirect(base_url() . 'user/login');
        }
        $data_post = $this->input->post(); 
        
        $this->load->model('group/group_model', 'GROUP', TRUE);
        $data['group'] = $this->GROUP->get_list(FALSE, 'status != 2');
        
        if(intval($id)){ 
            if ($data_post) {
                $data_post['id'] = $id;
                $this->form_validation->set_rules('fullname', 'Fullname', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required');
                $this->form_validation->set_rules('username', 'Username', 'required'); 
                if (($this->form_validation->run() === TRUE)) { 
                    $idobj = $this->ACT->update_user($data_post); 
                    $this->session->set_userdata("message_success", 'Thành công'); 
                }
                else
                    $this->session->set_userdata("message_success", 'Vui lòng kiểm tra lại các trường.');
            } 
            $data["obj"] = $this->ACT->get_detail($id);
            $data["id"] = $id;
            $data["title"] = "Edit User <b style='color: red;'>".$data["obj"][0]->fullname."</b>:"; 
        }else{
            if ($data_post) {
                $this->form_validation->set_rules('fullname', 'Fullname', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required');
                $this->form_validation->set_rules('username', 'Username', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required');
                if (($this->form_validation->run() === TRUE)) { 
                     
                    if(empty($this->ACT->get_one("tbl_users" , "username = '".$data_post['username']."'" , "*"))){
                            
                        $idobj = $this->ACT->insert_user($data_post); 
                        $this->session->set_userdata("message_success", 'Thành công');     
                    }else{
                        $this->session->set_userdata("message_error", 'Username đã tồn tại.');
                    }
                    
                }
                else
                    $this->session->set_userdata("message_error", 'Vui lòng kiểm tra lại các trường.');
            } 
            $data["title"] = "Add New Item"; 
        } 
        $this->template->build('add', $data);
    }

 
    //=======================================================================
    //=======================================================================
    //=======================================================================
    public function login()	{ 
			
		if($_SERVER['REQUEST_METHOD']	=='POST') {
			$row 				= $this->ACT->check_login($_POST['email'],$_POST['password']);
			
			if($row) {	
					if($row['user_group_id']	!=	0){	 
						if(md5(sha1(addslashes($_POST['user_password'])))	==	$row['password']){
						      
                            $dataUpdate['token_login'] = md5( $row['id'] . '-' . date('Y-m-d H:i:s') );
                            $dataUpdate['expire_token_login'] = date( 'Y-m-d H:i:s' , time()+3600 );
                            $this->ACT->update_pass($dataUpdate, 'id = '.$row['id']);
                          
							$userdata = array( 'user'  			=> $row['username'],
											   'admin_id'  		=> $row['id'],
											   'admin_user'     => $row['username'],
											   'admin_name' 	 => $row['fullname'],
											   'admin_email'  	=> $row['email'],
											   'admin_pass'     => $row['password'],
											   'admin_group_id' => $row['user_group_id'],
											   'last_ip'     	=> $_SERVER['REMOTE_ADDR'],
                                               
                                               'page_default'     	=> $row['page_default'],
                                               'token_login'     	=> $dataUpdate['token_login'],
                                              // 'expire_token_login'     	=> $dataUpdate['expire_token_login'], 
                                               'have_history_page'     	=> $this->ACT->checkHistoryPage($row['user_group_id']),
                                               
											   'isLoggedIn'		=> TRUE  );
							$this->session->set_userdata($userdata); 
                            
                           //  echo "<pre>"; print_r($this->session->all_userdata()); exit;
                             
							$this->add_login($row);
                             
							redirect($row['page_default'], 'refresh');
							
						}else{//password						
							$this->session->set_flashdata('error_admin',LANG_USER_INCORRECT.'xx');					
							redirect(base_url() . "user/login", 'refresh');
						}
					}else{//partners_id
						$this->session->set_flashdata('error_admin',LANG_USER_INCORRECT.'yy');			
							redirect(base_url() . "user/login", 'refresh');
					}
				}else{//row
							$this->session->set_flashdata('error_admin',LANG_USER_INCORRECT.'zz');		
							redirect(base_url() . "user/login", 'refresh');
			}
		}else{	  
			$data["title"] 			= "Administrator Login";
			 
			$this->template->build('user_login', $data);
		}
	}
	
	public	function logout() {	
	   
        if($this->session->userdata("admin_id")){
            $dataUpdate['token_login'] = '';
            $dataUpdate['expire_token_login'] = '0000-00-00 00:00:00';
            $this->ACT->update_pass($dataUpdate, 'id = ' . $this->session->userdata("admin_id"));
          
        }
       
		$userdata = array( 'user'  			=> "",
                              'admin_id'  		=> "",
                              'provider_id'    => "", 
							   'admin_user'     => "",
							   'admin_name' 	 => "",
							   'admin_email'  	=> "",
							   'admin_pass'     => "",
							   'admin_group_id' => 0,
							   'last_ip'     	=> "",
                               'token_login'     	=> $dataUpdate['token_login'],
                               'expire_token_login'     	=> $dataUpdate['expire_token_login'], 
							   'isLoggedIn'		=> false  );
                               
		$this->session->unset_userdata($userdata); 
            redirect( base_url()."user/login" , 'refresh');
	}
    public function add_login($data 	= array()){
		$res	= $this->ACT->add_loglogin($data);
		//$res 	= User_model::add_loglogin($data);
	}
	public function profile(){ 
        $data_post = $this->input->post();
        if($data_post){ 
            if ($this->session->userdata("admin_pass") != md5(sha1(addslashes($data_post['old_password']))) ) {
                $this->session->set_userdata("message_error", 'Old password is not correct !!');
            }else{
			
				$dataUpdate['password'] = md5(sha1(addslashes($data_post['new_password'])));
				$where['id'] = $this->session->userdata("admin_id");
				$this->ACT->update_pass($dataUpdate , $where);
				
				$userdata = array(   'admin_pass'     => md5(sha1(addslashes($data_post['new_password']))));
				$this->session->set_userdata($userdata); 
				$this->session->set_userdata("message_error", 'Success !!');
			} 			 
        } 
        $this->template->build('profile', $data); 
    }
	
	

}

?>