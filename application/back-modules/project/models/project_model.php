<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . "third_party/HT/ModelAdmin.php";

class Project_model extends HT_ModelAdmin {
   
    public $_dTbl = array(
        'module_id'        => 'project_id',
        'module_table'     => 'tbl_project',
        'module_controler' => 'project',
        'module_model'     => 'project_model' 
    ); 
    public $_fieldArrSearch = array('title' ,'description');  
    public function __construct() {
        parent::__construct(); 
    }

    public function update($data , $where){   
        parent::update($data , $where);  
    }   
}

?>