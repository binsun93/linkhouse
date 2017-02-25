<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class My_Redis {
    /*
     * support 2 server redis
     * doccument at: https://github.com/nicolasff/phpredis
     */

    public $server1; // server read (server2 copy cache to server1 + session )
    public $server2; // server read and write (server2 create cache)
    public $server3; // server link picasa
    public $_userHaveKey = false;
    private $curServer;
    public $prefix;
	public $connectSuccess = false;

    public function __construct() { 
        $CI = & get_instance();
        $CI->config->load('redis');
        $this->prefix = $CI->config->config['redis_prefix'];
		 
	 
        if (is_array($CI->config->config['redis_server_list'])) {
            
			$CI->redis = $this;
            $configRedis = $CI->config->config['redis_server_list'];
            $configServer1 = array_shift($configRedis);
            $configServer2 = array_shift($configRedis);
            $configServer3 = array_shift($configRedis);
			
            $this->server1 = connectRedis::GetInstance('server1'); 
            $this->server2 = connectRedis::GetInstance('server2');
			
			return;
            $this->server1->connect_redis($configServer1['ip'], $configServer1['port']);
			//echo 12113; print_r($CI->config->config['redis_server_list']); exit;
            $this->server2->connect_redis($configServer2['ip'], $configServer2['port']);
            
            if (!empty($configServer3)) {
                $this->server3 = connectRedis::GetInstance('server3');
                $this->server3->connect_redis($configServer3['ip'], $configServer3['port']);
            }
			  
			// Khi Redis DIE
			
			try {
				
				$this->setCurrentServer();
			} catch (Exception $e) {
				return;
			} 
			 
			$this->connectSuccess == true;  
            if ($this->curServer === $this->server2) {
                $CI->session->set_userdata(CACHELOCK, 1);
            }
        }
	 
		
		
    }

    private function setCurrentServer() {
        $this->curServer = $this->server1; 
        if (defined('APP_TYPE') && APP_TYPE === 'front') { 
            $url = $this->getCurrentUrlWithQueryRedis(); 
            $lock = $this->curServer->get($this->prefix . 'redis_key:' . $url);  
            if ($lock !== '1') { 
                $this->curServer->set($this->prefix . 'redis_key:' . $url, 1, 60); 
                $this->_userHaveKey = true;
            }  
        }  
    }

    public function get($instances = "server1" ,  $key) { 
		if ($this->connectSuccess == false){ return false; }  
		$this->curServer = $this->$instances; 
		 
        $key = $this->prefix . $key;
        $result = $this->curServer->get($key); 
        return $result;
    }

    public function keys($instances = "server1" , $key) {
		if ($this->connectSuccess == false){ return false; }
		$this->curServer = $this->$instances; 
        $result = $this->curServer->keys($key);
        // Xu ly them
        return $result;
    }

    public function hKeys($instances = "server1" , $hash) {
		if ($this->connectSuccess == false){ return false; }
		$this->curServer = $this->$instances; 
        $hash = $this->prefix . $hash;
        $result = $this->curServer->hKeys($hash); 
        return $result;
    }

   

    public function set($instances = "server1" , $key, $value, $expire = false) {
		if ($this->connectSuccess == false){ return false; }
		$this->curServer = $this->$instances; 
        if($this->_userHaveKey == false) return false;


        $key = $this->prefix . $key;
        if ($expire === false) {
            $this->curServer->set($key, $value); 
        } else {
            $this->curServer->set($key, $value, $expire);  
        }
    }
 

    /*
     * Return value:
     * LONG 1 if value didn't exist and was added successfully, 
     * 0 if the value was already present and was replaced, 
     * FALSE if there was an error.
     */

    public function hSet($instances = "server1" , $hash, $key, $value) {
		if ($this->connectSuccess == false){ return false; }
		$this->curServer = $this->$instances; 
        // User khong dc phep set
        if($this->_userHaveKey == false) return false;

        $hash = $this->prefix . $hash;
        $this->curServer->hSet($hash, $key, $value); 
    }

    public function rename($instances = "server1" , $key , $keyrn) {
		if ($this->connectSuccess == false){ return false; }
		$this->curServer = $this->$instances; 
        $key = $this->prefix . $key;
        $keyrn = $this->prefix . $keyrn;
        $this->curServer->rename($key, $keyrn); 
    }
    

    /*
     * Return value:
     * STRING The value, if the command executed successfully BOOL FALSE in case of failure
     */

    public function hGet($instances = "server1" , $hash, $key) {
		if ($this->connectSuccess == false){ return false; }
		$this->curServer = $this->$instances; 
        $hash = $this->prefix . $hash;
        $result = $this->curServer->hGet($hash, $key); 
        return $result;
    }

    public function setTimeout($instances = "server1" , $key, $time = 10) {
		if ($this->connectSuccess == false){ return false; }
		$this->curServer = $this->$instances; 
        $this->curServer->setTimeout($key, $time); 
    }

  

    public function hGetAll($instances = "server1" , $hash) {
		if ($this->connectSuccess == false){ return false; }
		$this->curServer = $this->$instances; 
        $hash = $this->prefix . $hash;
        $result = $this->curServer->hGetAll($hash); 
        return $result;
    }

    public function hDel($instances = "server1" , $hash, $key, $all = FALSE) {
		if ($this->connectSuccess == false){ return false; }
		$this->curServer = $this->$instances; 
        $hash = $this->prefix . $hash;
        $result = $this->curServer->hDel($hash, $key); 
        return $result;
    }

    /*
     * delete key or hash
     */

    public function delete($instances = "server1" , $key, $all = false) {
		if ($this->connectSuccess == false){ return false; }
		$this->curServer = $this->$instances; 
        $key = $this->prefix . $key;
        $this->curServer->delete($key); 
    }

    public function flushDB($instances = "server1" , $all = false) {
		if ($this->connectSuccess == false){ return false; }
		$this->curServer = $this->$instances; 
        $result = $this->curServer->flushDB(); 
        return $result;
    }

    public function closeRedis($instances = "server1") {
		if ($this->connectSuccess == false){ return false; }
		$this->curServer = $this->$instances; 
        $this->curServer->close(); 
    }

    public function getCurrentUrlWithQueryRedis($md5 = 1, $query = 1) {
//        $currentUrl = current_url();
        $currentUrl = 'http' . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . str_replace('\\', '/', $_SERVER['REQUEST_URI']);
        $queryUrl = http_build_query($_GET, '', "&");
        if ($query === 1 && $queryUrl !== '') {
            $currentUrl .= '?' . $queryUrl;
        }
        $currentUrl = rtrim(trim($currentUrl), '/');
        if ($md5) {
            $currentUrl = md5($currentUrl);
        }
        return $currentUrl;
    }

    public function hExists($instances = "server1" , $hash, $key) {
		if ($this->connectSuccess == false){ return false; }
		$this->curServer = $this->$instances; 
        return $this->curServer->hExists($hash, $key);
    }

    public function hIncrBy($instances = "server1" , $hash, $key, $numInt) {
		if ($this->connectSuccess == false){ return false; }
		$this->curServer = $this->$instances; 
        $this->curServer->hIncrBy($hash, $key, $numInt); 
    }

}

class connectRedis extends Redis {

    private static $instances = array();

//    private function __construct() {
//        
//    }

    public static function GetInstance($id) {
        if (!empty($id)) {
            if (!isset(self::$instances[$id]) || !self::$instances[$id] instanceof self)
                self::$instances[$id] = new self();

            return self::$instances[$id];
        }
    }

    public function UnsetInstance($id) {
        if (!empty($id)) {
            if (isset(self::$instances[$id]) && self::$instances[$id] instanceof self)
                unset(self::$instances[$id]);
            return true;
        }
    }

    public function connect_redis($ip, $port) {
        $this->pconnect($ip, $port);
    }

}
