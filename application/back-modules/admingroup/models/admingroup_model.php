<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . "third_party/HT/ModelAdmin.php";

class Admingroup_model extends HT_ModelAdmin {
   
    public $_dTbl = array(
                            'module_id' => 'id',
                            'module_table' => 'tbg_admin_group',
                            'module_controler' => 'admingroup',
                            'module_model' => 'Admingroup_model' 
                        ); 
    public $_fieldArrSearch = array('name');  
    public function __construct() {
        parent::__construct(); 
    }
     
}

?>