<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . "third_party/HT/ControllerAdmin.php";

class Managerfile extends HT_ControllerAdmin {

    /**
     *
     * @var Test_model 
     */
    public $_model;
    public $_data;

    function __construct() {
        parent::__construct();
		$_SESSION[$_SESSION['admin_htv_user']]['name_module'] = 'managerfile';
		$_SESSION[$_SESSION['admin_htv_user']]['code'] = '';
        $this->_data['title_module'] = 'managerfile';
    }

    function index(){
		$this->template->build('index');
	}

}

?>