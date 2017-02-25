<?php
require_once APPPATH."third_party/YT/Controller.php";
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class YT_ControllerPublic extends YT_Controller
{
    public $data=array();
    function __construct() {
        parent::__construct();

        $this->data['SEO']=$this->load->library("SEO");
        $this->load->helper('language');
        $this->lang->load('global');
      
    }
        
	 function get_id_url($url,$sep="-"){
             	$url=str_replace(".html", "", $url);
		$url=explode($sep, $url);
		return intval($url[count($url)-1]);
         }
}
