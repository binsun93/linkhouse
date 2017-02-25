<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class model_SO extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getSO($tbl, $queryLimit = '') {
        unset($this->db);
        $this->db = $this;
        $query = $this->db->query("select * from $tbl $queryLimit");
        return($query->result_array());
    }

}

?>
