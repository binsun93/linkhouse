<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . "third_party/HT/ModelAdmin.php";

class Provider_people_model extends HT_ModelAdmin {
   
    public $_dTbl = array(
                            'module_id' => 'pp_id',
                            'module_table' => 'tbl_provider_people',
                            'module_controler' => 'provider_people',
                            'module_model' => 'provider_people_model' 
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