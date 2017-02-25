<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------------
  | Hooks
  | -------------------------------------------------------------------------
  | This file lets you define "hooks" to extend CI without hacking the core
  | files.  Please see the user guide for info:
  |
  |	http://codeigniter.com/user_guide/general/hooks.html
  |
 */

$hook['pre_system'][] = array(
	'class' => '',
	'function' => 'dev_authencation',
	'filename' => 'dev_authencation.php',
	'filepath' => 'hooks'
	); 
if(APP_TYPE!='admin'){ 
    $hook['post_controller_constructor'] = array(
        'class' => 'Preload',
        'function' => 'index',
        'filename' => 'preload.php',
        'filepath' => 'hooks', 
    );
	// $hook['cache_override'][] = array(
		// 'class' => '',
		// 'function' => 'html_cache',
		// 'filename' => 'html_cache.php',
		// 'filepath' => 'hooks'
	// );
	// $hook['pre_system'][] = array(
	// 	'class' => '',
	// 	'function' => 'urlalias',
	// 	'filename' => 'urlalias.php',
	// 	'filepath' => 'hooks'
	// );

}

 
/* End of file hooks.php */
/* Location: ./application/config/hooks.php */