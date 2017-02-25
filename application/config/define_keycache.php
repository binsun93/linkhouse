<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$config['define_keycache'] = array();

define('HASH_STATE', 'HS');
define('SITE_ON_OFF', 'HS_SITE_ON_OFF'); // 1: on; 0 : off (site dang bao tri). Luu vao hash STATE.
define('LIST_SERVICES', 'LIST_SERVICES');
define('HASH_SERVICES', 'HASH_SERVICES');
define('SESSION_LOAD_LIMIT', 100);
define('PREFIX_HASH_SO','H_');
