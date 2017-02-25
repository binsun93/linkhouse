<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . "third_party/HT/ModelAdmin.php";

class Urlalias_model extends HT_ModelAdmin {
   
    public $_dTbl = array(
                            'module_id' => 'id',
                            'module_table' => 'tbl_urlalias',
                            'module_controler' => 'urlalias',
                            'module_model' => 'Urlalias_model' 
                        ); 
    public $_fieldArrSearch = array('realurl', 'aliasurl', 'mtitle');  
    public function __construct() {
        parent::__construct(); 
    }
     
}

?>