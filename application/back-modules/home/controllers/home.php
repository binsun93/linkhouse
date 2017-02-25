<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MX_Controller {

    public function __construct() {
        parent::__construct();
    }
	public function index()
	{			
        echo 123; die;
//		if($this->session->userdata("admin_group_id") ==""){
//			redirect('user/login');
//		}
//		$this->template->build('home');
	}	  
}