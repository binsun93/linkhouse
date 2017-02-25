<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . "third_party/HT/ModelFront.php";

class MainModule_model extends HT_ModelFront {
   
    public $_dTbl = array(
                            'module_id' => 'id',
                            'module_table' => 'tbg_urlalias',
                            'module_controler' => 'MainModule',
                            'module_model' => 'MainModule_model' 
                        ); 
    public $_fieldArrSearch = array('realurl', 'aliasurl', 'mtitle');  
    public function __construct() {
        parent::__construct(); 
    }
     
}

?>