
<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . "third_party/HT/ModelAdmin.php";

class Header_model extends HT_ModelAdmin { 
    public $_dTbl = array(
                            'module_id' => 'id',
                            'module_table' => 'tbg_banner',
                            'module_controler' => 'header',
                            'module_model' => 'header_model' 
                        ); 
    public $_fieldArrSearch = array();  
    public function __construct() {
        parent::__construct(); 
    } 
}

?>