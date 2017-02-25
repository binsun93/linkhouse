<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('image.php');
class UploadFTP  extends MX_Controller {

    public static $instance;

    /* initialize the uploadFTP class */
	function __construct()	{
		parent::__construct();			
		
		$this->config->load('define',TRUE);
		$this->load->library('adminclass_model');
		
	}	
    public static function init() {
        if (self::$instance == NULL) {
            self::$instance = new self();
        }
		
        return self::$instance;
    }

    function api_file_info_config() {
        return array(
            'server' => 'img.hayhaytv.com.vn',
            'user' 	 => 'imghayhaytv',
            'pass' 	 => 'cx6II9q7MXbzcwIMYvgq',
            'path_unix' => 'upload/',
            'basic_url' => 'http://test.img.hayhaytv.vn'
        );       
    }

    /*
     * To change this template, choose Tools | Templates
     * and open the template in the editor.
     */

    public function api_ftp_connect() {
        $config 		= $this->api_file_info_config();
        //address of ftp server.
        $ftp_user_name  = $config['user']; // Username
        $ftp_user_pass  = $config['pass'];   // Password
        // connection settings
        $conn_id 		= ftp_connect($config['server']);

        $login_result 	= ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);   // login with username and password, or give invalid user message
        if ((!$conn_id) || (!$login_result)) {  // check connection
            return FALSE;
        } else {
            return $conn_id;
        }
    }  
	
	public function api_save_image_orgi($module, $file, $mode = FTP_BINARY) { 
					
        $file['name'] 		= $this->adminclass_model->Rewrite($file['name']);
        $image_name 		= str_replace(' ', '', $file['name']);
        $name 				= substr($image_name, 0, strrpos($image_name, '.'));
        $type 				= substr($image_name, strrpos($image_name, '.'), strlen($image_name));

        $image_tmp 			= $file['tmp_name'];
        $image_type 		= $file['type'];
				
        $size 				= getimagesize($image_tmp);
        $width 				= $size[0];		
        $height 				= $size[1];		
		
        $time = rand(1000, 10000) . time();
        $new_image_name = $name . '_' . $time . $type;
		$thumb_path = "../upload/" . $new_image_name;
				
		$im = new Image();
        $im->resize($image_tmp, $thumb_path, $width, $height);
		@mkdir($thumb_path);
		
		$file_normal = base_url() . "upload/" . $new_image_name;

        $config 			= $this->api_file_info_config();
        $conn_id 			= $this->api_ftp_connect();

        $file_original 		= base_url() . "upload/" . $new_image_name;
        $path_original 		= $config['path_unix'] . $module . date("dmY") . "/" . $new_image_name;

        @ftp_mkdir($conn_id, $config['path_unix'] . $module . date("dmY"));
        @ftp_chmod($conn_id, 0777, $config['path_unix'] . $module . date("dmY"));

		 if (ftp_put($conn_id, $path_original, $file_original, $mode)) {
            @ftp_chmod($conn_id, 0777, $path_original);
            ftp_close($conn_id);
			unlink("upload/" . $new_image_name);
            return date("dmY") . "/" . $new_image_name;
        } else {
            return NULL;
        }
     
    }
	
	
	 public function api_save_image_original($module, $file, $mode = FTP_BINARY) { 
					
        $file['name'] 		= $this->adminclass_model->Rewrite($file['name']);
        $image_name 		= str_replace(' ', '', $file['name']);
        $name 				= substr($image_name, 0, strrpos($image_name, '.'));
        $type 				= substr($image_name, strrpos($image_name, '.'), strlen($image_name));

        $image_tmp 			= $file['tmp_name'];
        $image_type 		= $file['type'];

        $size 				= getimagesize($image_tmp);
        $imgW 				= $size[0];

        $config 			= $this->api_file_info_config();
        $conn_id 			= $this->api_ftp_connect();

        $time 				= rand(1000, 10000) . time();
        $new_image_name 	= $name . '_' . $time . $type;

        move_uploaded_file($image_tmp, "../upload/".$new_image_name);
		
        $file_original 		= BASE_NAME_ADMIN . "../upload/" . $new_image_name;
        $path_original 		= $config['path_unix'] . $module . date("dmY") . "/" . $new_image_name;

        @ftp_mkdir($conn_id, $config['path_unix'] . $module . date("dmY"));
        @ftp_chmod($conn_id, 0777, $config['path_unix'] . $module . date("dmY"));

		 if (ftp_put($conn_id, $path_original, $file_original, $mode)) {
            @ftp_chmod($conn_id, 0777, $path_original);
            ftp_close($conn_id);
            unlink("../upload/" . $new_image_name);
            return date("dmY") . "/" . $new_image_name;
        } else {
            return NULL;
        }
     
    }
	
	

	 public function api_save_file_original($module, $file, $mode = FTP_BINARY) {
       
        $file['name'] 		= $this->adminclass_model->Rewrite($file['name']);
        $image_name 		= str_replace(' ', '', $file['name']);
        $name 				= substr($image_name, 0, strrpos($image_name, '.'));
        $type 				= substr($image_name, strrpos($image_name, '.'), strlen($image_name));

        $image_tmp 			= $file['tmp_name'];
       

        $config 			= $this->api_file_info_config();
        $conn_id 			= $this->api_ftp_connect();

        $time 				= rand(1000, 10000) . time();
        $new_image_name 	= $name . '_' . $time . $type;
		 move_uploaded_file($image_tmp, "../upload/".$new_image_name);

        $path_original 		= $config['path_unix'] . $module . date("dmY") . "/" . $new_image_name;
		

        @ftp_mkdir($conn_id, $config['path_unix'] . $module . date("dmY"));
        @ftp_chmod($conn_id, 0777, $config['path_unix'] . $module . date("dmY"));

        if (ftp_put($conn_id, $path_original, $image_tmp, $mode)) {
            @ftp_chmod($conn_id, 0777, $path_original);
            ftp_close($conn_id);
            return date("dmY") . "/" . $new_image_name;
        } else {
            return NULL;
        }
    }

  
	public function api_save_image_ftp($module, $name, $manage = TRUE, $mode = FTP_BINARY) {
		$config 		= $this->api_file_info_config();
        $conn_id 		= $this->api_ftp_connect();
      
        $dir_original 	= BASE_NAME_ADMIN . "../upload/" . $name;       
		$path_original  = $config['path_unix'] . $module . date("dmY") . "/" . $name;
       

        @ftp_mkdir($conn_id, $config['path_unix'] . $module . date("dmY"));
        @ftp_chmod($conn_id, 0777, $config['path_unix'] . $module . date("dmY")); 
		

        if (!ftp_put($conn_id, $path_original, $dir_original, $mode)) {
            var_dump('FAIL Original');
        }
		 return date("dmY") . "/"  . $name;      
    }
    
    public function api_save_file_sub($module, $file, $mode = FTP_BINARY) {
      
		
        $file['name'] 	= $this->adminclass_model->Rewrite($file['name']);
        $image_name 	= str_replace(' ', '', $file['name']);
        $name 			= substr($image_name, 0, strrpos($image_name, '.'));
        $type 			= substr($image_name, strrpos($image_name, '.'), strlen($image_name));

        $image_tmp 		= $file['tmp_name'];
        $dir_original 	= str_replace("_data.sub", ".sub", $file['tmp_name']);
        //$image_type = $file['type'];

        $config 		= $this->api_file_info_config();
        $conn_id 		= $this->api_ftp_connect();

        $time 					= rand(1000, 10000) . time();
        $new_image_name_data 	= $name . '_' . $time . $type;
        $new_image_name 		= str_replace("_data.sub", "", $file['name']) . '_' . $time . $type;

        $path_original 			= $config['path_unix'] . $module . date("dmY") . "/" . $new_image_name;
        $path_data 				= $config['path_unix'] . $module . date("dmY") . "/" . $new_image_name_data;

        @ftp_mkdir($conn_id, $config['path_unix'] . $module . date("dmY"));
        @ftp_chmod($conn_id, 0777, $config['path_unix'] . $module . date("dmY"));
        
        if (!ftp_put($conn_id, $path_original, $dir_original, $mode)) {
            var_dump('FAIL Original');
        }

        if (ftp_put($conn_id, $path_data, $image_tmp, $mode)) {
            @ftp_chmod($conn_id, 0777, $path_data);
            ftp_close($conn_id);
            return date("dmY") . "/" . $new_image_name_data;
        } else {
            return NULL;
        }
    }

   

    function api_image_delete($module, $image_name) {
        $r = 1;
        if ($image_name != BANNER_DEFAULT) {
            $config = $this->api_file_info_config();
            $conn_id = $this->api_ftp_connect();

            $r = @ftp_delete($conn_id, $module . $image_name);
        }
        //ftp_close($conn_id);
        return $r;
    }

    /**
     * Delete a file and its database record.
     *
     * @param type $file
     * object with $uri and $fid
     * 
     * @return type 
     */
    function api_image_delete_ftp($module, $image_name) {
        $r 				= 1;
        if ($image_name != BANNER_DEFAULT && $image_name != POSTER_DEFAULT) {
            $config 	= $this->api_file_info_config();
            $conn_id 	= $this->api_ftp_connect();

            $crop 		= $image_name;           
            $r 			= @ftp_delete($conn_id, $module . '/' . $crop);
           
        }
        //ftp_close($conn_id);
        return $r;
    }
	//****************************************************************************************************
	function encodeSub($file, $rs = array()) {      
       
        if (@$file['name']) {
            $file['name'] 	= $this->adminclass_model->Rewrite($file['name']);
            $image_name 	= str_replace(' ', '', $file['name']);
            $name 			= substr($image_name, 0, strrpos($image_name, '.'));

            $text 			= $this->adminclass_model->readSub($file['tmp_name']);
            //file_put_contents("upload/" . $name . "_data.sub" , $text);
            move_uploaded_file($file['tmp_name'], "../upload/" . $name . ".sub");
            //chmod("upload/" . $name . "_data.sub", 777);

            $len 			= count(str_split($text));
            $endCodeArr 	= array(1, 5, 3, 2, 7, 6, 9, 0, 8, 4);

            $fp 			= fopen("../upload/" . $name . "_data.sub", 'w');

            for ($i = 0; $i < $len; $i++) {
                $charCode 	= ord(substr($text, $i, 1));
                $charCode	= $charCode ^ $i;
                $charCode 	= $charCode ^ $endCodeArr[$i % 10];
                $charCode	= ~$charCode;
                fwrite($fp, pack('s', $charCode));
            }

            fclose($fp);
            $this->api_image_delete(UPLOAD_SUBTITLE, $rs['vn_subtitle']);
            $this->api_image_delete(UPLOAD_SUBTITLE, str_replace("_data_", "_", $rs['vn_subtitle']));

            $subtitle 		= array(
                "name" 		=> $name . "_data.sub",
                "tmp_name"  => "../upload/" . $name . "_data.sub"
            );

            $vn_subtitle 	= $this->api_save_file_sub(UPLOAD_SUBTITLE, $subtitle);
            unlink("../upload/" . $name . ".sub");
            unlink("../upload/" . $name . "_data.sub");
        } else {
            $vn_subtitle = "";
        }
		//var_dump( $vn_subtitle) ; exit;
        return $vn_subtitle;
    }

	//encodeSub

}