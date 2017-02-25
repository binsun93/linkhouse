<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Session extends CI_Session {

    function __construct() {
        session_start();
    }

    public function userdata($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : '';
    }
    public function check($permision_name){
        $roles=$this->userdata('roles');
        if(in_array(get_instance()->config->item('root_role_id'),$roles)) return 1;
        $permisions=$this->userdata('permision');
        return $permisions[$permision_name];
    }
    public function set_userdata($newdata = array(), $newval = '') {
        if (is_string($newdata)) {
            $newdata = array($newdata => $newval);
        }

        if (count($newdata) > 0) {
            foreach ($newdata as $key => $val) {
                $_SESSION[$key] = $val;
            }
        }
    }

    public function unset_userdata($newdata = array()) {
        if (is_string($newdata)) {
            $newdata = array($newdata => '');
        }

        if (count($newdata) > 0) {
            foreach ($newdata as $key => $val) {
                unset($_SESSION[$key]);
            }
        }
    }

    function all_userdata() {
        return $_SESSION;
    }

    public function sess_destroy() {
        session_destroy();
    }

}