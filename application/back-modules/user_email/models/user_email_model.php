<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . "third_party/HT/ModelAdmin.php";

class User_email_model extends HT_ModelAdmin {
   
    public $_dTbl = array(
                            'module_id' => 'uemail_id',
                            'module_table' => 'tbl_user_email',
                            'module_controler' => 'user_email',
                            'module_model' => 'user_email_model' 
                        ); 
    public $_fieldArrSearch = array('email' );  
    public function __construct() {
        parent::__construct(); 
    }

    public function update($data , $where){   
        parent::update($data , $where);  
    }   
}

?>