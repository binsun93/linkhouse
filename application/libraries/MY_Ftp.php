<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * MY_FTP Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		Tuyen.bui@yestech.vn
 * @link		http://codeigniter.com/user_guide/libraries/ftp.html
 */
class MY_FTP extends CI_FTP {

function mkdir_recu($path,$basedir="/"){
   @ftp_chdir($this->conn_id, $basedir); // /var/www/uploads
   $parts = explode('/',$path); // 2013/06/11/username
   foreach($parts as $part){
      if(!@ftp_chdir($this->conn_id, $part)){
         ftp_mkdir($this->conn_id, $part);
         ftp_chdir($this->conn_id, $part);
         //ftp_chmod($ftpcon, 0777, $part);
      }
   }
}
function file_exist($filename){
    $listing = ftp_nlist($this->conn_id, $filename);
    if(empty($listing)) {
       return false;
    } else {
        return true;
    }
}
function _error($line)
	{
		$this->error_message=$line;
	}
}
// END FTP Class

/* End of file Ftp.php */
/* Location: ./system/libraries/Ftp.php */