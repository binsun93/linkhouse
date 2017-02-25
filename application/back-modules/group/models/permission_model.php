

<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');	
class Permission_model extends MY_Model {
	public function __construct(){  
		parent::__construct();  
	}
	public $table_name = "tbl_admin_group_permission_except";
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
            $this->db_master->order_by($this->table_name . '.except_id', "desc");
        } 
        if($limit)
            $this->db_master->limit($limit['per_page']  , $limit['start'] ); 
        return $this->db_master->get()->result(); 
    }

    public function count_all_per($where) {
        $this->db_master->select('*');
        $this->db_master->from($this->table_name); 
        if($where)
            $this->db_master->where($where);
        $result_arr = $this->db_master->count_all_results(); 
        return $result_arr;
    }

     
    public function insert_per($data) { 
        $data_basic = array( 
            'admin_group_id' => $data['admin_group_id'],
            'url_except' => $data['url_except'] 
        ); 
        $kq = $this->db_master->insert($this->table_name, $data_basic);    
        return $kq;
    }
  
    public function delete_per($bs_id) { 
        if ($bs_id > 0) { 
            $this->db_master->where('except_id', $bs_id); 
            $check = $this->db_master->delete($this->table_name);  
        }  
        return $check;
    }
    
    public function get_detail($id) {
        $this->db_master->select('*');
        $this->db_master->from($this->table_name);
        $array = array($this->table_name . '.except_id ' => $id);
        $this->db_master->where($array); 
        return $this->db_master->get()->result();  
    }
     
}
?>