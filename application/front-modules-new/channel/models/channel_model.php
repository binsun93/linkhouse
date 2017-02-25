
<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . "third_party/HT/ModelAdmin.php";

class Channel_model extends HT_ModelAdmin { 
    public $_dTbl = array(
                            'module_id' => 'chan_id',
                            'module_table' => 'tbl_channel',
                            'module_controler' => 'channel',
                            'module_model' => 'channel_model' 
                        ); 
    public $_fieldArrSearch = array();  
    public function __construct() {
        parent::__construct(); 
    } 
}

?>