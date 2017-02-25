<?php

class loadData extends MX_Controller {

    public function load() {
//        $this = & get_instance();
        $this->config->load('config_so');
        $configSO = array();
        if (is_array($this->config->config['so'])) {
            $configSO = $this->config->config['so'];
            $configSO = array_unique($configSO);
            $this->redis->delete(LIST_SERVICES);
            $this->redis->rPush(LIST_SERVICES, 'C');
            $this->redis->rPushx(LIST_SERVICES, 'A');
            $this->redis->rPush(LIST_SERVICES, 'A');
            $this->redis->rPush(LIST_SERVICES, 'B');
            $this->redis->lRem(LIST_SERVICES, 'A', 0);
            $a = $this->redis->lRange(LIST_SERVICES, 0, -1);
            var_dump($a);
        } else {
            echo 'Loi load file config';
        }
    }

    /**
     * Start load database to redis
     * @access public
     * @param none
     * @return none 
     */
    public function start($new) {
        $configSO = $this->loadConfig('config_so', 'so');
        $configSO = array_unique($configSO);
        $this->redis->delete(HASH_STATE);
        $this->redis->hSet(HASH_STATE, SITE_ON_OFF, 0);
//        print_r($this->redis->hGet(HASH_STATE, SITE_ON_OFF));
        if ($new) {
            $this->redis->delete(LIST_SERVICES);
        }
        $listConfigSO = $this->redis->lRange(LIST_SERVICES, 0, -1);
        if (empty($listConfigSO)) {
            foreach ($configSO as $value) {
                $this->redis->rPush(LIST_SERVICES, $value);
            }
        }
        $a = $this->redis->lRange(LIST_SERVICES, 0, -1);
        while ($this->redis->lSize(LIST_SERVICES) > 0) {
            $first = $this->redis->lRange(LIST_SERVICES, 0, 0);
            $this->loadSOtoRedis($first[0], $new);
            $this->redis->lPop(LIST_SERVICES);
        }

        $a = $this->redis->lRange(LIST_SERVICES, 0, -1);
        var_dump($a);
    }

    /**
     * Load config file
     * @access public
     * @param string
     * @return array or false
     */
    public function loadConfig($configFile, $configName) {
        $this->config->load($configFile);
        return (is_array($this->config->config[$configName])) ? $this->config->config[$configName] : FALSE;
    }

    public function loadSOtoRedis($tbl, $new = 0) {
        include_once 'sync/model_SO.php';
        $modelSO = new model_SO();
        if ($new) {
            $this->session->unset_userdata('limit_start_' . $tbl);
        }
        $limit_start = $this->session->userdata('limit_start_' . $tbl);
        $check = 1;
        while ($check) {
            if ($limit_start == FALSE) {
                $queryLimit = (SESSION_LOAD_LIMIT != 0) ? "limit 0, " . SESSION_LOAD_LIMIT : '';
                $limit_start = 0;
            } else {
                $queryLimit = (SESSION_LOAD_LIMIT != 0) ? "limit $limit_start," . SESSION_LOAD_LIMIT : '';
            }

            $result = $modelSO->getSO($tbl, $queryLimit);
            $check = (empty($result) || count($result) < (int) SESSION_LOAD_LIMIT) ? 0 : 1;
            if (!empty($result)) {
                foreach ($result as $v) {
                    $id = $v['id'];
                    unset($v['id']);
                    $data = json_encode($v, JSON_UNESCAPED_UNICODE);
                    $this->redis->hSet(PREFIX_HASH_SO . $tbl, $id, $data);
                }
            }
            $limit_start += SESSION_LOAD_LIMIT;
            $this->session->set_userdata('limit_start_' . $tbl, $limit_start);
        }
    }

}
?>
