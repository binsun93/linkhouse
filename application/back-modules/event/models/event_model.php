<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . "third_party/HT/ModelAdmin.php";

class Event_model extends HT_ModelAdmin {
   
    public $_dTbl = array(
                            'module_id' => 'event_id',
                            'module_table' => 'tbl_event',
                            'module_controler' => 'event',
                            'module_model' => 'Event_model' 
                        ); 
    public $_fieldArrSearch = array('title');  
    public function __construct() {
        parent::__construct(); 
    }

  
    
     
}

?>