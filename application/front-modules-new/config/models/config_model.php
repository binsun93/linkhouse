
<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . "third_party/HT/ModelFront.php";

class Config_model extends HT_ModelFront { 
    public $_dTbl = array(
                            'module_id' => 'id',
                            'module_table' => 'tbg_config',
                            'module_controler' => 'config',
                            'module_model' => 'config_model' 
                        ); 
    public $_fieldArrSearch = array();  
    public function __construct() {
        parent::__construct(); 
    } 
}

?>