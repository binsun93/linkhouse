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
 * Output Class
 *
 * Responsible for sending final output to browser
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Output
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/output.html
 */
class MY_Output extends CI_Output{

	

	// --------------------------------------------------------------------

	/**
	 * Display Output
	 *
	 * All "view" data is automatically put into this variable by the controller class:
	 *
	 * $this->final_output
	 *
	 * This function sends the finalized output data to the browser along
	 * with any server headers and profile data.  It also stops the
	 * benchmark timer so the page rendering speed and memory usage can be shown.
	 *
	 * @access	public
	 * @param 	string
	 * @return	mixed
	 */
	function _display($output = '',$zipped=false,$store_cache=true)
	{

            // Note:  We use globals because we can't use $CI =& get_instance()
		// since this function is sometimes called by the caching mechanism,
		// which happens before the CI super object is available.
		global $BM, $CFG;

		// Grab the super object if we can.
		if (class_exists('CI_Controller'))
		{
			$CI =& get_instance();
		}

		// --------------------------------------------------------------------

		// Set the output data
		if ($output == '')
		{
			$output =& $this->final_output;
		}

		// --------------------------------------------------------------------

		// Do we need to write a cache file?  Only if the controller does not have its
		// own _output() method and we are not dealing with a cache file, which we
		// can determine by the existence of the $CI object above
		if ($this->cache_expiration > 0 && isset($CI) && ! method_exists($CI, '_output'))
		{
			$this->_write_cache($output);
		}

		// --------------------------------------------------------------------

		// Parse out the elapsed time and memory usage,
		// then swap the pseudo-variables with the data

		$elapsed = $BM->elapsed_time('total_execution_time_start', 'total_execution_time_end');

		if ($this->parse_exec_vars === TRUE)
		{
			$memory	 = ( ! function_exists('memory_get_usage')) ? '0' : round(memory_get_usage()/1024/1024, 2).'MB';

			$output = str_replace('{elapsed_time}', $elapsed, $output);
			$output = str_replace('{memory_usage}', $memory, $output);
		}

		

		// Are there any server headers to send?
		if (count($this->headers) > 0)
		{
			foreach ($this->headers as $header)
			{
				@header($header[0], $header[1]);
			}
		}

		// --------------------------------------------------------------------

		// Does the $CI object exist?
		// If not we know we are dealing with a cache file so we'll
		// simply echo out the data and exit.
		if ( ! isset($CI))
		{if ($CFG->item('compress_output') === TRUE && $this->_zlib_oc == FALSE){if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) AND strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== FALSE){ob_start('ob_gzhandler');}}
			echo $output;
			log_message('debug', "Final output sent to browser");
			log_message('debug', "Total execution time: ".$elapsed);
			return TRUE;
		}

		// --------------------------------------------------------------------

		// Do we need to generate profile data?
		// If so, load the Profile class and run it.
		if ($this->enable_profiler == TRUE)
		{
			$CI->load->library('profiler');

			if ( ! empty($this->_profiler_sections))
			{
				$CI->profiler->set_sections($this->_profiler_sections);
			}

			// If the output data contains closing </body> and </html> tags
			// we will remove them and add them back after we insert the profile data
			if (preg_match("|</body>.*?</html>|is", $output))
			{
				$output  = preg_replace("|</body>.*?</html>|is", '', $output);
				$output .= $CI->profiler->run();
				$output .= '</body></html>';
			}
			else
			{
				$output .= $CI->profiler->run();
			}
		}
// --------------------------------------------------------------------
		// Is compression requested?
		if ($CFG->item('compress_output') === TRUE && $this->_zlib_oc == FALSE)
		{ 
//			if (extension_loaded('zlib'))
//			{
				if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) AND strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== FALSE)
				{
					ob_start('ob_gzhandler');
                                    //header("Content-Encoding:gzip"); 
                                    //$output=gzcompress($output, 9);
                                    //header("Content-Encoding: ".$encoding);
//                                    if(!$zipped&&0){
//                                        $size = strlen($output);
//                                        $output = gzcompress($output, 9);
//                                        $output = substr($output, 0, $size);
//                                        $output=  ("\x1f\x8b\x08\x00\x00\x00\x00\x00").$output;
//                                       // echo $output;
////                                       
//                                    }//echo "zipped:".$zipped;exit;
        
				}
//			}
		}

		// --------------------------------------------------------------------
		// --------------------------------------------------------------------
                if($CI->config->item('html_minify')&&!$_GET['dev']&&!$zipped&&APP_TYPE!='admin'){
                ini_set("pcre.recursion_limit", "16777");
    $CI =& get_instance();
    $re = '%# Collapse whitespace everywhere but in blacklisted elements.
        (?>             # Match all whitespans other than single space.
          [^\S ]\s*     # Either one [\t\r\n\f\v] and zero or more ws,
        | \s{2,}        # or two or more consecutive-any-whitespace.
        ) # Note: The remaining regex consumes no text at all...
        (?=             # Ensure we are not in a blacklist tag.
          [^<]*+        # Either zero or more non-"<" {normal*}
          (?:           # Begin {(special normal*)*} construct
            <           # or a < starting a non-blacklist tag.
            (?!/?(?:textarea|pre|script)\b)
            [^<]*+      # more non-"<" {normal*}
          )*+           # Finish "unrolling-the-loop"
          (?:           # Begin alternation group.
            <           # Either a blacklist start tag.
            (?>textarea|pre|script)\b
          | \z          # or end of file.
          )             # End alternation group.
        )  # If we made it here, we are not in a blacklist tag.
        %Six';

    $new_buffer = preg_replace($re, " ", $output);
    // We are going to check if processing has working
    $new_buffer=preg_replace(array('/ {2,}/','/<!--.*?-->/s'),array(' ',''),$new_buffer);
    if ($new_buffer !== null)
    {
        $output = $new_buffer;
    }
    
                }
                
global $_SEO;
if(isset($_SEO->real_alias)&&APP_TYPE!='admin')
    $output=strtr($output,$_SEO->real_alias);
// Does the controller contain a function named _output()?
		// If so send the output there.  Otherwise, echo it.
                if($CI->config->item('html_cache')&&!$CI->config->item('nocache')&&!$_GET['dev']&&$store_cache&&!$_GET['ajax']&&APP_TYPE!='admin'){
                    
                    $lastmdf=gmdate( 'D, d M Y H:i:s' ) . ' GMT';
                    $hash=$_SERVER['REQUEST_URI'];
                    $redis=$CI->load->library("Redis","master");
                    if(!$redis->backup_mode){
                        $redis->create_connect("master");
                        $redis->hset('html_cache',$hash,$output);
                        $redis->hset('html_cache',$hash."_last",$lastmdf);
                        header('Last-Modified: '.$lastmdf );
                        header ('Cache-Control: max-age=9999, must-revalidate');
                        header ('Optimize-By: tuyenbui.com');
                    }
                    //header ('Expires: ' . $lastExptime);
                    //$redis->close();
                    
                }
                if(isset($_GET['debug']) && $_GET['debug']){
                    $mqueries=$CI->load->database('master', TRUE)->queries;
                    $squeries=$CI->load->database('slave', TRUE)->queries;
                    echo "<pre>";
                    print_r($mqueries);
                    echo "</pre>";
                    echo "<pre>";
                    print_r($squeries);
                    echo "</pre>";
                    exit;
                    
                }
		if (method_exists($CI, '_output'))
		{
			$CI->_output($output);
		}
		else
		{
			echo $output;exit;  // Send it to the browser!
		}

		log_message('debug', "Final output sent to browser");
		log_message('debug', "Total execution time: ".$elapsed);
	}

	// --------------------------------------------------------------------

	


}
// END Output Class

/* End of file Output.php */
/* Location: ./system/core/Output.php */