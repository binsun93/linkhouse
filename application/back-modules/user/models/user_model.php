

<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');	
class User_model extends MY_Model {
	public function __construct(){  
		parent::__construct();   
	}
	public $table_name = "tbl_users";
    
    public function get_one($tbl , $where , $row){
        $this->db_master->select($row);
        $this->db_master->from($tbl);
        $this->db_master->where($where);
        $result = $this->db_master->get()->result();
        return $result[0];
    }
    
    
	//=======================================================================
    //=======================================================================
    //=======================================================================
	public function get_list($limit = array('per_page' => 6, 'start' => 0) , $where = false , $orderBy = false , $searchWhere = false) {
        $this->db_master->select('tbl_users.* , tbl_user_groups.name as groups_name');
        $this->db_master->from($this->table_name);
        $this->db_master->join("tbl_user_groups" , "tbl_user_groups.id_user_group = tbl_users.user_group_id" , "LEFT");
        if($where)
            $this->db_master->where($where); 
            
        if($searchWhere)
            $this->db_master->where($searchWhere); 
        if($orderBy) {
            foreach($orderBy as $key=>$value){
                $this->db_master->order_by($this->table_name . '.'.$key, $value);
            }
        }else{
            $this->db_master->order_by($this->table_name . '.id', "desc");
        } 
        if($limit)
        $this->db_master->limit($limit['per_page']  , $limit['start'] ); 
        $rs = $this->db_master->get()->result();
       // echo $this->db_master->last_query(); exit;
        return $rs; 
    }

    public function count_all_user($where , $searchWhere = false) {
        $this->db_master->select('*');
        $this->db_master->from($this->table_name); 
        if($where)
            $this->db_master->where($where);
        if($searchWhere)
            $this->db_master->where($searchWhere); 
        $result_arr = $this->db_master->count_all_results(); 
        return $result_arr;
    }
    
    public function checkHistoryPage($id_group_user) {
        $this->db_master->select('*');
        $this->db_master->from("tbl_group_permission_except");
        $array = array('user_group_id ' => $id_group_user , "url_except" => base_url()."history");
        $this->db_master->where($array); 
        $arr = $this->db_master->get()->result();
        return empty($arr)?true:false;  
    }
    
    

    public function get_detail($id) {
        $this->db_master->select('*');
        $this->db_master->from($this->table_name);
        $array = array($this->table_name . '.id ' => $id);
        $this->db_master->where($array); 
        return $this->db_master->get()->result();  
    }
    
    public function update_user($data) { 
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        if ($data['id'] > 0) {  
            //Information basic	
            $data_basic = array(
                'fullname' => $data['fullname'],'user_group_id' => $data['user_group_id'],
                'username' => $data['username'],'email' => $data['email'], 'publish' => $data['publish']
            );
            if(!empty($data['password'])){
                $data_basic['password'] = md5(sha1(addslashes($data['password'])));
            }
            
            
            /*   ####################   CONTENT OLD  #################### */ 
            $history_obj_id = $data['id']; 
            $data_history['content_old'] = $this->get_detail($history_obj_id)[0];
            /*   ####################   END CONTENT OLD ####################*/ 
                    
                    $this->db_master->where('id', $data['id']);
                    $check = $this->db_master->update($this->table_name, $data_basic); 
                    
            /*   ####################  CONTENT NEW #################### */ 
            $this->load->module("history/History_model" , "HIS" , TRUE); 
            $data_history['content_new'] = $this->get_detail($history_obj_id)[0];
            $data_history['obj_id'] = $history_obj_id; 
            $this->HIS->history_update(__CLASS__ , $data_history);
            /*   ####################  END CONTENT NEW ####################*/ 
            
            
            
        }
        return ($check === true ) ? true : FALSE;
    }
    public function insert_user($data) { 
        $data_basic = array( 
            'fullname' => $data['fullname'],'user_group_id' => $data['user_group_id'],
            'username' => $data['username'],'email' => $data['email'],
            'password' => md5(sha1(addslashes($data['password']))),'publish' => $data['publish']
        ); 
        $kq = $this->db_master->insert($this->table_name, $data_basic); 
        
        /*   ####################  CONTENT NEW #################### */ 
        $this->load->module("history/History_model" , "HIS" , TRUE); 
        $history_obj_id = $this->db_master->insert_id(); 
        $data_history['content_new'] = $this->get_detail($history_obj_id)[0];
        $data_history['obj_id'] = $history_obj_id; 
        $this->HIS->history_insert(__CLASS__ , $data_history);
        /*   ####################  END CONTENT NEW ####################*/ 

        
        
        return $kq;
    }
 
    public function publish_user($data, $bs_id) { 
        if ($bs_id > 0) {
            /*   ####################   CONTENT OLD  #################### */  
            $history_obj_id = $bs_id;
            $data_history['content_old'] = $this->get_detail($history_obj_id)[0];
            /*   ####################   END CONTENT OLD ####################*/ 
             
                    $this->db_master->where('id', $bs_id);
                    $check = $this->db_master->update($this->table_name, $data);
            
            /*   ####################  CONTENT NEW #################### */ 
            $this->load->module("history/History_model" , "HIS" , TRUE); 
            $data_history['content_new'] = $this->get_detail($history_obj_id)[0];
            $data_history['obj_id'] = $history_obj_id; 
            $this->HIS->history_update(__CLASS__ , $data_history);
            /*   ####################  END CONTENT NEW ####################*/
        }  
        return $check;
    }
    
     
	//=======================================================================
    //=======================================================================
    //=======================================================================
	public function check_login($username,$password){
		$sql	= 'Select tbl_users.* , tbl_user_groups.page_default  From tbl_users JOIN tbl_user_groups ON tbl_user_groups.id_user_group  = tbl_users.user_group_id  Where username = "'.addslashes($username) .'" and user_group_id != 0 And publish = 1';
		$query 	= $this->db_master->query($sql);
		$row 	= $query->row_array();
		return $row;		
	}
    private function getIP() {
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                    $ip = $_SERVER['REMOTE_ADDR'];
            }
            return $ip;
    }
	public function add_loglogin($data = array()){ 
	   date_default_timezone_set('Asia/Ho_Chi_Minh');
		$ip_connection= $this->getIP();
         
        
		if(@$data['id']>0){
			$update		= array('ip_connection'=> $ip_connection , 'last_connection'=> date('Y-m-d H:i:s') );	
			$this->db_master->where('id', $data['id']);
			$this->db_master->update('tbl_users',$update);
		} 
		$insert	= array('user_name'=> "".$data['username']."",'user_id'=> "".$data['id']."");	
		$res 	= $this->db_master->insert('tbl_user_loglogin', $insert); 
		return $res ? true : false;
	}
	public function update_pass($data , $where){
	   
        /*   ####################   CONTENT OLD  ####################  */
        $history_obj_id = $where['id'];
        $data_history['content_old'] = $this->get_detail($history_obj_id)[0];
        /*   ####################   END CONTENT OLD ####################*/ 
         
                $this->db_master->where($where);
                $this->db_master->update('tbl_users',$data);
        
        /*   ####################  CONTENT NEW ####################  
        $this->load->module("history/History_model" , "HIS" , TRUE); 
        $data_history['content_new'] = $this->get_detail($history_obj_id)[0];
        $data_history['obj_id'] = $history_obj_id; 
        $this->HIS->history_update(__CLASS__ , $data_history);
        /*   ####################  END CONTENT NEW ####################*/
       
       
        
    }
    public function checkPermission($id){
        echo $id; exit;
    }
}
?>