<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . "third_party/HT/ModelAdmin.php";

class Admins_model extends HT_ModelAdmin {
   
    public $_dTbl = array(
                            'module_id' => 'admin_id',
                            'module_table' => 'tbl_admin',
                            'module_controler' => 'admins',
                            'module_model' => 'Admins_model' 
                        ); 
    public $_fieldArrSearch = array('username');  
    public function __construct() {
        parent::__construct(); 
    }

    public function count_all_user($where , $searchWhere = false) {
        $this->db_master->select('*');
        $this->db_master->from($this->_dTbl['module_table']); 
        if($where)
            $this->db_master->where($where);
        if($searchWhere)
            $this->db_master->where($searchWhere); 
        $result_arr = $this->db_master->count_all_results(); 
        return $result_arr;
    }
    
     
}

?>