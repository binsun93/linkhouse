
<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . "third_party/HT/ModelAdmin.php";

class Loglogin_model extends HT_ModelAdmin {
   
    public $_dTbl = array(
                            'module_id' => 'id',
                            'module_table' => 'tbg_admin_loglogin',
                            'module_controler' => 'Log Login',
                            'module_model' => 'Loglogin_model' 
                        ); 
    public $_fieldArrSearch = array('username', 'last_login');  
    public function __construct() {
        parent::__construct(); 
    }
     
}

?>