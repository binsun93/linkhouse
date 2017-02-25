<?php

/* !
 * @file RedisSentinelClient.php
 * @author Ryota Namiki <ryo180@gmail.com>
 */

class RedisSentinelClientNoConnectionExecption extends Exception {
    
}

/* !
 * @class RedisSentinelClient
 *
 * Redis Sentinel
 */

class RedisSentinelClient {

    protected $_socket;
    protected $_host;
    protected $_port;

    public function setServer(array $param) {
        $this->_host = $param['IP'];
        $this->_port = $param['PortSentinel'];
        $this->_socket = $param['socket'];
        return $this;
    }

    public function __destruct() {
        if ($this->_socket) {
            $this->_close();
        }
    }

    /* !
     * PING
     *
     * @retval boolean true
     * @retval boolean false
     */

    public function ping() {
        if ($this->_connect()) {
            $this->_write('PING');
            $this->_write('QUIT');
            $data = $this->_get();
            $this->_close();
            return ($data === '+PONG');
        } else {
            return false;
        }
    }

    /* !
     * SENTINEL masters
     *
     * @retval array
     * @code
     * array (
     *   [0]  => // master の index
     *     array(
     *       'name' => 'mymaster',
     *       'host' => 'localhost',
     *       'port' => 6379,
     *       ...
     *     ),
     *   ...
     * )
     * @endcode
     */

    public function masters() {
        if ($this->_connect()) {
            $this->_write('SENTINEL masters');
            $this->_write('QUIT');
            $data = $this->_extract($this->_get());
            $this->_close();
            return $data;
        } else {
            //throw new RedisSentinelClientNoConnectionExecption;
            return FALSE;
        }
    }

    /* !
     * SENTINEL slaves
     *
     * @param [in] $master string
     * @retval array
     * @code
     * array (
     *   [0]  =>
     *     array(
     *       'name' => 'mymaster',
     *       'host' => 'localhost',
     *       'port' => 6379,
     *       ...
     *     ),
     *   ...
     * )
     * @endcode
     */

    public function slaves($master) {
        if ($this->_connect()) {
            $this->_write('SENTINEL slaves ' . $master);
            $this->_write('QUIT');
            $data = $this->_extract($this->_get());
            $this->_close();
            return $data;
        } else {
            throw new RedisSentinelClientNoConnectionExecption;
        }
    }

    /* !
     * SENTINEL is-master-down-by-addr
     *
     * @param [in] $ip   string
     * @param [in] $port integer
     * @retval array
     * @code
     * array (
     *   [0]  => 1
     *   [1]  => leader
     * )
     * @endcode
     */

    public function is_master_down_by_addr($ip, $port) {
        if ($this->_connect()) {
            $this->_write('SENTINEL is-master-down-by-addr ' . $ip . ' ' . $port);
            $this->_write('QUIT');
            $data = $this->_get();
            $lines = explode("\r\n", $data, 4);
            list (/* elem num */, $state, /* length */, $leader) = $lines;
            $this->_close();
            return array(ltrim($state, ':'), $leader);
        } else {
            throw new RedisSentinelClientNoConnectionExecption;
        }
    }

    /* !
     * SENTINEL get-master-addr-by-name
     *
     * @param [in] $master string
     * @retval array
     * @code
     * array (
     *   [0]  =>
     *     array(
     *       '<IP ADDR>' => '<PORT>',
     *     )
     * )
     * @endcode
     */

    public function get_master_addr_by_name($master) {
        if ($this->_connect()) {
            $this->_write('SENTINEL get-master-addr-by-name ' . $master);
            $this->_write('QUIT');
            $data = $this->_extract($this->_get());
            $this->_close();
            return $data;
        } else {
            throw new RedisSentinelClientNoConnectionExecption;
        }
    }

    /* !
     * SENTINEL reset
     *
     * @param [in] $pattern string(glob)
     * @retval integer pattern
     */

    public function reset($pattern) {
        if ($this->_connect()) {
            $this->_write('SENTINEL reset ' . $pattern);
            $this->_write('QUIT');
            $data = $this->_get();
            $this->_close();
            return ltrim($data, ':');
        } else {
            throw new RedisSentinelClientNoConnectionExecption;
        }
    }

    /* !
     * Sentinel
     *
     * @retval boolean true
     * @retval boolean false
     */

    protected function _connect() {
        $this->_socket = @fsockopen($this->_host, $this->_port, $en, $es);

        return !!($this->_socket);
    }

    /* !
     * Sentinel
     *
     * @retval boolean true
     * @retval boolean false
     */

    protected function _close() {
        $ret = @fclose($this->_socket);
        $this->_socket = null;
        return $ret;
    }

    /* !
     * Sentinel
     *
     * @retval boolean true
     * @retval boolean false
     */

    protected function _receiving() {
        return !feof($this->_socket);
    }

    /* !
     * Sentinel
     *
     * @param [in] $c string
     * @retval mixed integer
     * @retval mixed boolean false
     */

    protected function _write($c) {
        return fwrite($this->_socket, $c . "\r\n");
    }

    /* !
     * Sentinel
     *
     * @retval string
     */

    protected function _get() {
        $buf = '';
        while ($this->_receiving()) {
            $buf .= fgets($this->_socket);
        }
        return rtrim($buf, "\r\n+OK\n");
    }

    /* !
     * Redis
     *
     * @param [in] $data string
     * @retval array 配列1
     */

    protected function _extract($data) {
        if (!$data)
            return array();
        $lines = explode("\r\n", $data);
        $is_root = $is_child = false;
        $c = count($lines);
        $results = $current = array();
        for ($i = 0; $i < $c; $i++) {
            $str = $lines[$i];
            $prefix = substr($str, 0, 1);
            if ($prefix === '*') {
                if (!$is_root) {
                    $is_root = true;
                    $current = array();
                    continue;
                } else if (!$is_child) {
                    $is_child = true;
                    continue;
                } else {
                    $is_root = $is_child = false;
                    $results[] = $current;
                    continue;
                }
            }
            $keylen = $lines[$i++];
            $key = $lines[$i++];
            $vallen = $lines[$i++];
            $val = $lines[$i++];
            $current[$key] = $val;

            --$i;
        }
        $results[] = $current;
        return $results;
    }

}
