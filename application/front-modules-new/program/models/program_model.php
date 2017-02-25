
<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . "third_party/HT/ModelAdmin.php";

class Program_model extends HT_ModelAdmin { 
    public $_dTbl = array(
                            'module_id' => 'prog_id',
                            'module_table' => 'tbl_program',
                            'module_controler' => 'program',
                            'module_model' => 'program_model' 
                        ); 
    public $_fieldArrSearch = array();  
    public function __construct() {
        parent::__construct(); 
    } 
}

?>