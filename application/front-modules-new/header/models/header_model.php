
<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . "third_party/HT/ModelFront.php";

class Header_model extends HT_ModelFront { 
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