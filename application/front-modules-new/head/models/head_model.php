
<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . "third_party/HT/ModelAdmin.php";

class Head_model extends HT_ModelAdmin { 
    public $_dTbl = array(
                            'module_id' => 'sch_id',
                            'module_table' => 'tbl_schedule',
                            'module_controler' => 'schedule',
                            'module_model' => 'Schedule_model' 
                        ); 
    public $_fieldArrSearch = array();  
    public function __construct() {
        parent::__construct(); 
    } 
}

?>