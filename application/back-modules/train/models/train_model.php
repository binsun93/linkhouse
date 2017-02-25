<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . "third_party/HT/ModelAdmin.php";

class Train_model extends HT_ModelAdmin {
   
    public $_dTbl = array(
        'module_id'        => 'train_id',
        'module_table'     => 'tbl_train',
        'module_controler' => 'train',
        'module_model'     => 'train_model' 
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