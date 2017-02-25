<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . "third_party/HT/ModelAdmin.php";

class Admin_group_model extends HT_ModelAdmin {
   
    public $_dTbl = array(
                            'module_id' => 'admin_group_id',
                            'module_table' => 'tbl_admin_groups',
                            'module_controler' => 'admin_group',
                            'module_model' => 'admin_group_model' 
                        ); 
    public $_fieldArrSearch = array('name');  
    public function __construct() {
        parent::__construct(); 
    }

    public function update($data , $where){   
        parent::update($data , $where);  
    }   
}

?>