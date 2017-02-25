

<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');	
class Group_model extends MY_Model {
	public function __construct(){  
		parent::__construct();  
	}
	public $table_name = "tbl_admin_groups";
	//=======================================================================
    //=======================================================================
    //=======================================================================
	public function get_list($limit = array('per_page' => 6, 'start' => 0) , $where = false , $orderBy = false) {
        $this->db_master->select('*');
        $this->db_master->from($this->table_name);
        if($where)
            $this->db_master->where($where); 
        if($orderBy) {
            foreach($orderBy as $key=>$value){
                $this->db_master->order_by($this->table_name . '.'.$key, $value);
            }
        }else{
            $this->db_master->order_by($this->table_name . '.admin_group_id', "desc");
        } 
        if($limit)
            $this->db_master->limit($limit['per_page']  , $limit['start'] ); 
        return $this->db_master->get()->result(); 
    }

    public function count_all_group($where) {
        $this->db_master->select('*');
        $this->db_master->from($this->table_name); 
        if($where)
            $this->db_master->where($where);
        $result_arr = $this->db_master->count_all_results(); 
        return $result_arr;
    }

    public function get_detail($id) {
        $this->db_master->select('*');
        $this->db_master->from($this->table_name);
        $array = array($this->table_name . '.admin_group_id ' => $id);
        $this->db_master->where($array); 
        return $this->db_master->get()->result();  
    }
    
    public function update_group($data) { 
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        if ($data['id'] > 0) {  
            //Information basic	
            $data_basic = array(
                'name' => $data['name'],
                'status' => $data['status'] 
            ); 
                    
                    $this->db_master->where('admin_group_id', $data['id']);
                    $check = $this->db_master->update($this->table_name, $data_basic); 
                     
        }
        return ($check === true ) ? true : FALSE;
    }
    public function update_page_default($data , $where , $id) {   
        $this->db_master->where($where);
        $check = $this->db_master->update($this->table_name, $data);  
    }
    public function insert_group($data) { 
        $data_basic = array( 
            'name' => $data['name'],
            'status' => $data['status']
        ); 
        $kq = $this->db_master->insert($this->table_name, $data_basic);    
        return $kq;
    }
 
    public function publish_group($data, $bs_id) { 
        if ($bs_id > 0) {  
            $this->db_master->where('admin_group_id', $bs_id);
            $check = $this->db_master->update($this->table_name, $data); 
        }  
        return $check;
    }
    
    
    
    
	//=======================================================================
    //=======================================================================
    //=======================================================================
	public function check_login($username,$password){
		$sql	= 'Select * From tbl_users Where username = "'.addslashes($username) .'" And publish = 1';
		$query 	= $this->db_master->query($sql);
		$row 	= $query->row_array();
		return $row;		
	}
	public function add_loglogin($data = array()){ 
	   date_default_timezone_set('Asia/Ho_Chi_Minh');
		$ip_connection= $_SERVER['REMOTE_ADDR'];
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
        $this->db_master->where($where);
        $this->db_master->update('tbl_users',$data);
    }


    public function get_admin_group_permission_except($where){
        $this->_model_group->db_master->select('except_id'); 
        $this->_model_group->db_master->from('tbl_admin_group_permission_except'); 
        $this->_model_group->db_master->where($where); 
        return $this->_model_group->db_master->get()->result();
    }

    public function count_admin_group_permission_except($where){
        $this->_model_group->db_master->select('except_id');

        $this->_model_group->db_master->from('tbl_admin_group_permission_except');

        $this->_model_group->db_master->where($where);

        return $this->_model_group->db_master->count_all_results();
    }

}
?>