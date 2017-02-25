<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . "third_party/HT/ModelAdmin.php";

class Post_model extends HT_ModelAdmin {
   
    public $_dTbl = array(
        'module_id'        => 'post_id',
        'module_table'     => 'tbl_post',
        'module_controler' => 'post',
        'module_model'     => 'post_model' 
    ); 
    public $_fieldArrSearch = array('title' ,'summary');  
    public function __construct() {
        parent::__construct(); 
    }

    public function update($data , $where){   
        parent::update($data , $where);  
    }   
}

?>