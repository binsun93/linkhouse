<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model
 *
 * @author Administrator
 */
require_once APPPATH."third_party/YT/AModel.php";
class YT_Model extends YT_AModel{
        public $where="";
        public $order="";
        public $field_string="*";
        public $limit=array();
        public $dbmode="slave";
        function __construct() {
            parent::__construct();
        }
        public function dbmode($mode='slave'){
            $this->dbmode=$mode;
        }
        public function get_list($condition=array(),$limit=100,$order=array()){
            $this->getDB()->from($this->table_name);
            $this->getDB()->where($condition);
            $this->getDB()->limit($limit);
            if($order)
            $this->getDB()->order_by($order[0],$order[1]);
            return $this->getDB()->get()->result();
        }
}
