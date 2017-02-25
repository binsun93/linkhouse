<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . "third_party/HT/ModelAdmin.php";

class Contact_model extends HT_ModelAdmin {
   
    public $_dTbl = array(
        'module_id'        => 'contact_id',
        'module_table'     => 'tbl_contact',
        'module_controler' => 'contact',
        'module_model'     => 'contact_model' 
    ); 
    public function __construct() {
        parent::__construct(); 
    }

    public function update($data , $where){   
        parent::update($data , $where);  
    }   
}

?>