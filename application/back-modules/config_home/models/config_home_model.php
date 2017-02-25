<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . "third_party/HT/ModelAdmin.php";

class Config_home_model extends HT_ModelAdmin {
   
    public $_dTbl = array(
                            'module_id' => 'cof_home_id',
                            'module_table' => 'tbl_config_home',
                            'module_controler' => 'config_home',
                            'module_model' => 'config_home_model' 
                        ); 
    public $_fieldArrSearch = array('title' ,'type');  
    public function __construct() {
        parent::__construct(); 
    }

    public function update($data , $where){   
        parent::update($data , $where);  
    }   
}

?>