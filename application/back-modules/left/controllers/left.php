<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Left extends MX_Controller {
 
   public function index(  )
   {
        $this->load->model('group/Permission_model','PERMIS',TRUE);
     	$data['contentLeft'] = $this->PERMIS->get_list(FALSE , 'admin_group_id = '.$this->session->userdata('admin_group_id'));  
      	$this->load->view('left' , $data);
   }
}
 ?>