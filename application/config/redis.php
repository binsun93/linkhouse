<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
$config['redis_server_list'] = array(
    'server1' => array(
        'ip' => '112.78.4.49',
        'port' => 6379
    ),
    'server2' => array(
        'ip' => '112.78.4.49',
        'port' => 6380
    ) 
);
$config['redis_prefix'] = ''; 