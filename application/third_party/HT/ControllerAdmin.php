<?php
require_once  APPPATH."third_party/YT/Controller.php";
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class HT_ControllerAdmin extends MX_Controller
{ 
	public $_model; 
    public $_data_post;
    public $_data_get;
    public $_data=array();
    public $_like = false;
	var $max_lengh=80;
	function __construct()	{ 
		parent::__construct();	  

        if($this->uri->segment(2)!='login' && $this->uri->segment(2)!='logout' && empty($_POST)) { 
            $this->checkPermission();
        }  
        $this->_data_post = $this->input->post();
        $this->_data_get = $this->input->get();
		$user_group_id		= $this->session->userdata('admin_group_id');  
		$this->load->library('form_validation');
		$this->module_name		= $this->uri->segment(1); 
        $this->_data['return_url']=$_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:base_url().$this->uri->segment(1); 
        $this->config->item('time_zone')?date_default_timezone_set($this->config->item('time_zone')):"";

        $this->load->library('main/main');
	}	
    function checkPermission(){ 
        if($this->session->userdata('isLoggedIn_htv') == false){
            redirect('admins/login', 'refresh');
        }

        // permission ADCP 
        $link = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        $arr = explode("/", $_SERVER['REQUEST_URI']);

        $so = 0;

        if ($arr[3] && $arr[3] != 'index') {

            $this->_model->db_master->select('except_id');

            $this->_model->db_master->from('tbl_admin_group_permission_except');

            $this->_model->db_master->where("url_except = '" . base_url() . $arr[2] . "'");

            $rs = $this->_model->db_master->get()->result();

            if (!empty($rs)) {

                $so = 1;
            }
        }

        if (strpos(base_url(), 'admincp') == TRUE && (strpos($link, 'admincp/user/logout') == FALSE && strpos($link, 'admincp/user/login') == FALSE)) {

            $this->_model->db_master->select('except_id');

            $this->_model->db_master->from('tbl_admin_group_permission_except');

            $this->_model->db_master->where("INSTR('http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "' , url_except ) > 0 AND admin_group_id = " . $this->session->userdata('admin_group_id'));

            $rs1 = $this->_model->db_master->count_all_results(); 
            if ($rs1 > $so) {
                redirect($this->session->userdata('page_default'));
            }
        }  
    }
    
    function fifter(){
        $this->_data['search'] = $this->_data_get['search']?$this->_data_get['search']:false; 
        if(trim($this->_data['search']['key']) != ''){
            $keySearch = trim($this->_data['search']['key']);
            $keySearch = str_replace(' ','%' , $keySearch); 
            $likeArr = array();
            foreach($this->_model->_fieldArrSearch as $k=>$v){
                $likeArr[] = $this->_model->_dTbl['module_table'].".$v LIKE '%$keySearch%'";
            } 
            $this->_like = '( ' . implode(' OR ' , $likeArr) . ' )';
        } 
        // Ngay Thang
        if(trim($this->_data['search']['fromDate']) != ''){
            $fromDateArr = explode('/' , trim($this->_data['search']['fromDate']));
            $fromDate = $fromDateArr[2].'-'.$fromDateArr[1].'-'.$fromDateArr[0];
            $this->_where[$this->_model->_dTbl['module_table'].'.create_date >='] = $fromDate;
        } 
        if(trim($this->_data['search']['toDate']) != ''){
            $toDateArr = explode('/' , trim($this->_data['search']['toDate']));
            $toDate = $toDateArr[2].'-'.$toDateArr[1].'-'.$toDateArr[0].' 23:59:59';
            $this->_where[$this->_model->_dTbl['module_table'].'.create_date <='] = $toDate;
        } 
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
            if($this->_data_post['type']!="all")   $this->_where[$this->_model->_dTbl['module_table'].'.status'] = $this->_data_post['type'];
            else                        $this->_where[$this->_model->_dTbl['module_table'].'.status !='] = 2;
            $this->_data['totalRow'] = $this->_model->count_row($this->_where,$this->_like);
            $this->_data['type'] = $this->_data_post['type'];
            $this->_data['content'] = $this->_model->getList($this->_where , $this->_like , $orderBy , false , false , false , $limit);
            $this->load->view("listTable" , $this->_data );
        }else{ 
            $this->_data['type'] = isset($this->_data_get['type'])?$this->_data_get['type']:'all'; 
            
            if($this->_data['type']!="all")     $this->_where[$this->_model->_dTbl['module_table'].'.status'] = $this->_data['type'];
            else                         $this->_where[$this->_model->_dTbl['module_table'].'.status !='] = 2;
            
            $this->_data['content'] = $this->_model->getList($this->_where , $this->_like , false , false , false , false , $limit);  
            $this->_data['totalRow'] = $this->_model->count_row($this->_where,$this->_like); 
            $this->_data['searchHTML'] = $this->load->view("search" , $this->_data , true); 
            $this->_data['listTable'] = $this->load->view("listTable" , $this->_data , true);
            $this->template->build('list', $this->_data);
        } 
    }
    
     
	public function addedit($id = false){     
        $this->_data['dTbl'] = $this->_model->_dTbl;
        if(intval($id)){  // Update
            $this->_data[$this->_model->_dTbl['module_id']] = $id;  
            if($this->_data_post['data_post']){    // Click Submit  
            	$whereUpdate = array();
                $whereUpdate[$this->_model->_dTbl['module_id']] = $id;
                // Ngay sua
                $this->_data_post['data_post']['modify_date'] = date('Y-m-d h:i:s');
                $this->_data_post['data_post']['modify_by'] = $_SESSION['admin_htv_id']?$_SESSION['admin_htv_id']:0;
                // Ngay public
                if($this->_data_post['data_post']['status'] == 1){
                    $this->_data_post['data_post']['publish_date'] = date('Y-m-d h:i:s');
                    $this->_data_post['data_post']['publish_by'] = $_SESSION['admin_htv_id']?$_SESSION['admin_htv_id']:0;
                } 
                $this->_model->update($this->_data_post['data_post'] , $whereUpdate);
				unset($_POST['data_post']);
                $this->_data['msg'] = '<div class="red" style="color: green; font-size: 16px;" >Chinh Sua Thanh Cong</div>';
            }  
            // Get detail id
        	$whereDetail = array();
	        $whereDetail[$this->_model->_dTbl['module_id']] = $id;
	        $this->_data['detail'] = $this->_model->getList($whereDetail); 
        }
        else{  // Insert
            if($this->_data_post['data_post']){    // Click Submit
                // Ngay tao
                $this->_data_post['data_post']['create_date'] = date('Y-m-d h:i:s');
                $this->_data_post['data_post']['create_by'] = $_SESSION['admin_htv_id']?$_SESSION['admin_htv_id']:0;
                $this->_model->insert($this->_data_post['data_post']);
				unset($_POST['data_post']);
				$id = $this->_model->insert_id();
                $this->_data['msg'] = '<div class="red" style="color: green; font-size: 16px;" >Insert Thanh Cong</div>';
            }
        }
		
		if($this->_data_post['tags']){
			$this->addedit_tag($id,$this->_data_post['tags']);
		}
		
        $this->template->build('addedit' , $this->_data); 
	}  
    public function saveInfo() {
        
        if ($this->_data_post['txt_popular'] >= 0) { 
            $data = array(
                'sort_order' => $this->_data_post['txt_popular'],
                'modify_date' => date('Y-m-d h:i:s'),
                'modify_by' => $_SESSION['admin_htv_id']?$_SESSION['admin_htv_id']:0
            );  
            $where = array(
                $this->_model->_dTbl['module_id'] => $this->_data_post['id']
            ); 
            $this->_model->update($data, $where); 
        } 
    }

    public function changeStatus() { 
        $data = array(
            'status' => $this->_data_post['status'],
            'modify_date' => date('Y-m-d h:i:s'),
            'modify_by' => $_SESSION['admin_htv_id']?$_SESSION['admin_htv_id']:0
        ); 
        if($this->_data_post['status'] == 1){
            $data['publish_date'] = date('Y-m-d h:i:s');
            $data['publish_by'] = $_SESSION['admin_htv_id']?$_SESSION['admin_htv_id']:0;
        } 
        $where = array(
            $this->_model->_dTbl['module_id'] => $this->_data_post['id']
        ); 
        $this->_model->update($data, $where);   
    }
	
	public function check_slug($slug){
		$whereTag['slug'] = $slug;
		return current($this->_model->getList($whereTag));
	}



    /*  bao   tag*/
    public function addedit_tag($idm = false,$obj){
        if($this->module_name != 'profile'){
            $this->_model->getDB()->delete('tbg_'.$this->module_name.'_profile_rel', array($this->module_name.'_id'=>$idm));
        }
        $this->_model->getDB()->delete('tbg_'.$this->module_name.'_tag', array($this->module_name.'_id'=>$idm));
        $separe=",";
        
        foreach($this->_data_post['tags'] as $k=>$v){
            foreach($this->_data_post['tags'][$k] as $tag){
                if($k == 'profile'){
                    $str = explode($separe, preg_replace("/\s+/"," ",$tag));
                    if($str != ''){
                        foreach ($str as $st){
                            if(strlen($st)<=$this->max_lengh){
                                $id=$this->insert_tag_profile($st);
                                if($id){
                                    $tags_profile = array(
                                        $this->module_name.'_id' => $idm,
                                        'profile_id' => $id
                                    );
                                    $this->_model->getDB()->insert('tbg_'.$this->module_name.'_profile_rel', $tags_profile);
                                    unset($tags_profile);
                                }
                            }
                        }
                    }
                }else{
                    $str = explode($separe, preg_replace("/\s+/"," ",$tag));
                    foreach ($str as $st){
                        if(strlen($st)<=$this->max_lengh){
                            $id=$this->insert_tag($st);
                            if($id){
                                $tags = array(
                                    $this->module_name.'_id' => $idm,
                                    'tag_id' => $id
                                );
                                $this->_model->getDB()->insert('tbg_'.$this->module_name.'_tag', $tags);
                                unset($tags);
                            }
                        }
                    }
                }
            }
        }
    }

    function insert_tag_profile($tagname){
        $st=trim($tagname);
        $item=array();
        $item['title']=$st;
        $this->_model->getDB()->from('tbg_profile');
        $this->_model->getDB()->where('title',$item['title']);
        $obj = current($this->_model->getDB()->get()->result());
        if($obj->id) {
            return $obj->id;
        }
    }
    
    function insert_tag($tagname){
        $st=trim($tagname);
        $item=array();
        $item['slug']=remove_accent($st);
        $item['title']=$st;
        $this->_model->getDB()->from('tbg_tag');
        $this->_model->getDB()->where('slug',$item['slug']);
        $obj = current($this->_model->getDB()->get()->result());
        if($obj->id) {
            $this->store_data_tag($item,$obj->id);
            return $obj->id;
        }
        $item['create_date']=date("Y-m-d H:i",time());
        $item['modify_date']=date("Y-m-d H:i",time());
        $item['status']=1;
        return $this->store_data_tag($item);
    }
    
    public function store_data_tag($array,$id = false){
        // print_r($array);exit;
        if(intval($id)){  // Update
            if($array){    // Click Submit  
                // Ngay sua
                $array['modify_date'] = date('Y-m-d h:i:s');
                $array['modify_by'] = $_SESSION['admin_htv_id']?$_SESSION['admin_htv_id']:0;
                
                // Ngay public
                if($array['status'] == 1){
                    $array['publish_date'] = date('Y-m-d h:i:s');
                    $array['publish_by'] = $_SESSION['admin_htv_id']?$_SESSION['admin_htv_id']:0;
                } 
                $this->_model->getDB()->where('id', $id);
                $this->_model->getDB()->update('tbg_tag',$array);  
            }
        }else{  // Insert
            if($array){    // Click Submit
                // Ngay tao
                $array['create_date'] = date('Y-m-d h:i:s');
                $array['create_by'] = $_SESSION['admin_htv_id']?$_SESSION['admin_htv_id']:0;
             
                $this->_model->getDB()->insert('tbg_tag',$array);
                $id = $this->_model->getDB()->insert_id();
            }
        }
        return $id;
    }
    /*  bao   tag*/
    
}
