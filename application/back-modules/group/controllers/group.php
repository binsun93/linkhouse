<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Group extends MX_Controller {

    function __construct() {
        parent::__construct();		
		$this->module_name		= $this->uri->segment(1);
		$this->table_name 		= "tbl_user_provider";	
		// if ($this->session->userdata("isLoggedIn") == false) {
  //           redirect(base_url() . 'user/login');
  //       }
		$this->config->load('define',TRUE);
        $this->load->library('form_validation');
		$this->load->library('adminclass_model');
		$this->load->model('group_model','ACT',TRUE);
        $this->load->model('Permission_model','PERMIS',TRUE);  
        	
    }
    //=======================================================================
    //=======================================================================
    //=======================================================================
    public function index() {
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
        
        // ** Page
        if($data['page'] > $_GET['totalPage']  && $_GET['totalPage'] )
            $data['page'] = $_GET['totalPage'];
        if($_POST['page'])
		      $data['page'] = $_POST['page']?$_POST['page']:1;
		$data['numRowForPage'] = $_GET['numPerPage']?$_GET['numPerPage']:20;
        
        $limit['per_page'] = $data['numRowForPage'];
        $limit['start'] = $data['numRowForPage'] * ($data['page'] - 1);
         
        // ** Load View
        if($_POST['view']){
            if($_POST['type']!="all")   $where['tbl_admin_groups.status'] = $_POST['type'];
            else                        $where['tbl_admin_groups.status !='] = 2;
            $data['type'] = $_POST['type'];
            $data['totalRow'] = $this->ACT->count_all_group($where); 
            $data['content'] = $this->ACT->get_list($limit , $where , $orderBy);
            $this->load->view("listTable" , $data );
        }else{ 
            $data['type'] = isset($_GET['type'])?$_GET['type']:'all'; 
            if($data['type']!="all")     $where['tbl_admin_groups.status'] = $data['type'];
            else                         $where['tbl_admin_groups.status !='] = 2;
            $data['totalRow'] = $this->ACT->count_all_group($where);
            $data['content'] = $this->ACT->get_list($limit , $where); 
            $data['listTable'] = $this->load->view("listTable" , $data , true);
            $this->template->build('list', $data);
        } 
    }
    public function publish() {
        $data_post = $this->input->post(); 
        $data = array(
            'status' => $data_post['publish']
        );
        $this->ACT->publish_group($data, $data_post['id']); 
        $is_status = $data_post['publish'] == 1 ? '<a class="ico_activeOn tooltip" href="javascript:change(0 ,' . $data_post['id'] . ')"></a>' : ' <a class="ico_activeOff tooltip" href="javascript:change(1 ,' . $data_post['id'] . ')"></a>';
        echo $is_status; 
    } 
    public function delete() {
        $data_post = $this->input->post(NULL, TRUE);
        if ($data_post['id'] >= 0) {
            $data = array(
                'status' => 2
            );
            $check = $this->ACT->publish_group($data, $data_post['id']);
            echo 'success';
        }
    }
    public function addedit($id = false) {
        $data_post = $this->input->post(); 
        
        if(intval($id)){ 
            if ($data_post) {
                $data_post['id'] = $id;
                $this->form_validation->set_rules('name', 'Name', 'required'); 
                if (($this->form_validation->run() === TRUE)) { 
                    $idobj = $this->ACT->update_group($data_post); 
                    $this->session->set_userdata("message_success", 'Thành công'); 
                }
                else
                    $this->session->set_userdata("message_success", 'Vui lòng kiểm tra lại các trường.');
            } 
            $data["obj"] = $this->ACT->get_detail($id);
            $data["id"] = $id;
            $data["title"] = "Edit Group <b style='color: red;'>".$data["obj"][0]->name."</b>:"; 
        }else{
            if ($data_post) {
                $this->form_validation->set_rules('name', 'Name', 'required'); 
                if (($this->form_validation->run() === TRUE)) { 
                    $idobj = $this->ACT->insert_group($data_post); 
                    $this->session->set_userdata("message_success", 'Thành công'); 
                }
                else
                    $this->session->set_userdata("message_success", 'Vui lòng kiểm tra lại các trường.');
            } 
            $data["title"] = "Add New Item"; 
        } 
        $this->template->build('add', $data);
    }
      
    public function permission($id = false) {
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
        
        // ** Page
        if($data['page'] > $_GET['totalPage']  && $_GET['totalPage'] )
            $data['page'] = $_GET['totalPage'];
        if($_POST['page'])
		      $data['page'] = $_POST['page']?$_POST['page']:1;
		$data['numRowForPage'] = $_GET['numPerPage']?$_GET['numPerPage']:20;
        $limit['per_page'] = $data['numRowForPage'];
        $limit['start'] = $data['numRowForPage'] * ($data['page'] - 1);
         
         if($_GET['admin_group_id']){ 
            $where['admin_group_id'] = $_GET['admin_group_id'];
         }
         
         $data['group'] = $this->ACT->get_list(false , "status != 2");
         
        // ** Load View
        if($_POST['view']){ 
            $where['admin_group_id'] = $_POST['admin_group_id'];
            $data['type'] = $_POST['type'];
            $data['totalRow'] = $this->PERMIS->count_all_per($where); 
            $data['content'] = $this->PERMIS->get_list(FALSE , $where , $orderBy);
            $data["page_default"] = $this->ACT->get_detail($_POST['admin_group_id'])[0]->page_default;
            $this->load->view("review2" , $data );
        }else{ 
            $data['type'] = isset($_GET['type'])?$_GET['type']:'all';  
            $data['totalRow'] = $this->PERMIS->count_all_per($where);
            $data['content'] = $this->PERMIS->get_list(FALSE , $where); 
             
            $this->template->build('permission', $data);
        } 
    }
    public function add_permission($id = false) {
        $data_post = $this->input->post();  
        if ($data_post) {   
            foreach($data_post['arr_url_except'] as $k=>$v){
                $data = array('admin_group_id' => $data_post['admin_group_id'] , 'url_except' => $v);
                $idobj = $this->PERMIS->insert_per($data);
            }
                  
        }   
    } 
    public function deletePer() {
        $data_post = $this->input->post(NULL, TRUE);
        if ($data_post['id'] >= 0) { 
            $this->PERMIS->delete_per( $data_post['id']);
            $is_status = '<input style="float: right;" type="checkbox" name="url_except" value="'.base_url().$data_post['module'].'">' ;
            echo $is_status;
        }
    }
    public function reviewHTML() { 
        // ** Load View
        if($_POST['view']){   
            $where['admin_group_id'] = $_POST['admin_group_id'];
            $data['contentReview'] = $this->PERMIS->get_list(false , $where );
            $this->load->view("review2" , $data );
        }
    } 
    
    
    public function page_default(){
        $data_post = $this->input->post( );
        if($data_post){ 
            if($data_post['view']=="changePageDefault"){
                $dataUpdate['page_default'] = $data_post['page_default'];
                $this->ACT->update_page_default($dataUpdate , 'id_user_group = '.$data_post['admin_group_id'] , $data_post['admin_group_id']); 
                $this->session->set_userdata("message_success", 'Success !!'); 
            }
            
            
            $where['admin_group_id'] = $data_post['admin_group_id'];
            $data["page_default"] = $this->ACT->get_detail($data_post['admin_group_id'])[0]->page_default;
            $data['listAllowMenu'] = $this->PERMIS->get_list(false , $where );
            $this->load->view("page_default" , $data );
        }
    }

}

?>