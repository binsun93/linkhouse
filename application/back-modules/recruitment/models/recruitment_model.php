<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . "third_party/HT/ModelAdmin.php";

class Recruitment_model extends HT_ModelAdmin {
   
    public $_dTbl = array(
        'module_id'        => 'id',
        'module_table'     => 'tbl_recruitment',
        'module_controler' => 'recruitment',
        'module_model'     => 'recruitment_model' 
    ); 
    public function __construct() {
        parent::__construct(); 
    }

    public function update($data , $where){   
        parent::update($data , $where);  
    }   
}

?>