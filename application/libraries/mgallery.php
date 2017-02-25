<?php
class Mgallery {
    protected $_gallery_path = "";
    protected $_gallery_url = "";
    protected $_gallery_url_thumb = "";
    public $upload_folder = "../upload/images/images/";
    public $upload_foldera = "upload/images/images/";
    public $_sub_folder="";
    
    
    public function __construct(){
        $this->_sub_folder = $this->checkFolderImg();
        //L?y du?ng d?n url c?a thu m?c ch?a hình ?nh du?c upload
        $this->_gallery_url_thumb = $this->upload_folder.$this->_sub_folder."/thumbnail/";
        $this->_gallery_url = $this->upload_folder.$this->_sub_folder."/";
        $this->_gallery_path = realpath( $this->upload_folder.$this->_sub_folder."/thumbnail/");
        
    }
    public function delete($nameImage)
    {
        
        $temp = explode("_", $nameImage);
        $folderImg=@date("Y/m/d",$temp[0]);        
            if(!@unlink($this->upload_folder.$folderImg.'/'.$nameImage))
                return false;
            @unlink($this->upload_folder.$folderImg.'/thumbnail/'.$nameImage);    
    }
	
	public function uploadLink($link, $uid, $folder = ''){
	
		$img = file_get_contents($link);
		$file_name = $uid . '.jpg';
		
		
		$time = (isset($time)&&$time!='')?$time:time();
		$folder = $this->checkFolderImg('', date("d/m/Y", $time));
		
		$file = $this->upload_foldera.$folder."/" . $file_name;
		
		file_put_contents($file, $img);
	
		$image_path = $this->upload_folder.$folder."/".$file_name;
		
		
		return $image_path;
	}
    
        public function upload()
        {
            $time = (isset($time)&&$time!='')?$time:time();
			$folder = $this->checkFolderImg('', date("d/m/Y", $time));
            //hien thi thoi gian hien tai dang Unix time Stamps 
            if (isset($_FILES['upload']['name'])) {
				
                // total files //
                $count = count($_FILES['upload']['name']);
                // all uploads //
				
                $uploads = $_FILES['upload'];
                
                $_arrNameImage=array();
                for ($i = 0; $i < $count; $i++) {
                    if ($uploads['error'][$i] == 0  && $this->checkImage($uploads['type'][$i])) {
                         
                            // Chuyen Hinh vao thu muc da dinh
                            $time = time();
                            $uploads['name'][$i]=$time.'_'.$uploads['name'][$i];
                            $_arrNameImage[$i]['name']=$uploads['name'][$i];
                            $_arrNameImage[$i]['location']= $this->upload_foldera.$folder."/" . $uploads['name'][$i];
							//print_r($uploads['tmp_name'][$i]);exit;
							
                            move_uploaded_file($uploads['tmp_name'][$i], $this->upload_folder.$folder."/" . $uploads['name'][$i]);
								// echo 1;exit;
							// }else{
								// echo 0;exit;
							// }
                            // Chuyen thumb vao thu muc da dinh /thumbnail
                          
    					   $image_path = $this->upload_folder.$folder."/".$uploads['name'][$i];
    					   $thumb_path = $this->upload_folder.$folder."/thumbnail/".$uploads['name'][$i];
    					   $this->fillCrop($image_path , $thumb_path, 280, 280);
                    }
                    else
                       return false;
                }
                
            }
            else{ return false;}
            return $_arrNameImage;
        }
        public function uploadOneImageAtt( $time = false )
        {
			$time = (isset($time)&&$time!='')?$time:time();
			$folder = $this->checkFolderImg('', date("d/m/Y", $time));
            $_arrNameImage = array();

            if (isset($_FILES['img']['name'])  &&  $this->checkImage($_FILES['img']['type'])) {
                // all uploads //
                
                    if ($_FILES['img']['error'] == 0) {
                        
                        
                        // Chuyen Hinh vao thu muc da dinh
                        $time = time();
                        $_FILES['img']['name']=$time.'_'.$_FILES['img']['name'];
                        $_arrNameImage['name']=$_FILES['img']['name'];
                        $_arrNameImage['location']= $this->upload_foldera.$this->_sub_folder."/" . $_FILES['img']['name'];

                        move_uploaded_file($_FILES['img']['tmp_name'], $this->upload_folder.$folder."/" . $_FILES['img']['name']);
                        // Chuyen thumb vao thu muc da dinh /thumbnail
						
                        $image_path = $this->upload_folder.$folder."/".$_FILES['img']['name'];
					    $thumb_path = $this->upload_folder.$folder."/thumbnail/".$_FILES['img']['name'];
					    $this->fillCrop($image_path , $thumb_path, 280, 280);
                        //$this->image_thumb( 'public/Admin/images/'.$this->_sub_folder."/"  . $_FILES['img']['name'], 50, 50,$_FILES['img']['name'] ); 
                    }
                    else
                        return false;
                    
                return $_arrNameImage;
            }
            else{ return false;}
            
        }
        
        public function checkImage($imgType)
        {
            $array = array("image/jpeg" , "image/jpg" , "image/png" , "image/gif" , "image/swf");
            return in_array($imgType , $array )?true:false;
        }
        
        public function get_location_image($imageName)
        {
            if($imageName != '')
            {
                $temp = explode("_", $imageName);
                $attachName=explode("_",date("Y_m_d_H_i_s",$temp[0]));
                $images[] = array("url"             => $this->upload_foldera.$attachName[0]."/".$attachName[1]."/".$attachName[2]."/" . $imageName,
                                  "thumb_url"       => $this->upload_foldera.$attachName[0]."/".$attachName[1]."/".$attachName[2]."/thumbnail/" .  $imageName,
                                  "image_Name"      =>  $imageName,
                                  "image_Name_file" => $temp[1],
                                  "date"            => $attachName[0]."/".$attachName[1]."/".$attachName[2],
                                  "time"            => $attachName[3].":".$attachName[4].":".$attachName[5]
                );

                return $images; 
            }
            return false; 
        }
        //hàm l?y hình ?nh t? thu m?c luu file dã upload
        public function get_images_arr($arrAttach){
             
            $images = array(); 
            foreach($arrAttach as $key=>$val){
                
                $temp = explode("_", $val->name);
                $attachName=explode("_",date("Y_m_d_H_i_s",$temp[0]));
                $images[] = array("url"             => $this->upload_folder.$attachName[0]."/".$attachName[1]."/".$attachName[2]."/" . $val->name,
                              "thumb_url"       => $this->upload_folder.$attachName[0]."/".$attachName[1]."/".$attachName[2]."/thumbnail/" .  $val->name,
                              "image_Name"      =>  $val->name,
                              "image_Name_file" => $temp[1],
                              "date"            => $attachName[0]."/".$attachName[1]."/".$attachName[2],
                              "time"            => $attachName[3].":".$attachName[4].":".$attachName[5]
                              );
                
            }
            
            return $images;    
           
        }

    public function fillCrop($input_image, $output_image, $thumb_width='', $thumb_height='', $jpg_quality = 100) 
	{
		
		//return false if file is empty
		$image = getimagesize($input_image);
		if($image[0] <= 0||$image[1]<=0) 
		{
			return false;
		}
		//
		
		//set default value for thumb's size
		if($thumb_width==''&&$thumb_height=='')
		{
			$thumb_width=300;
			$thumb_height=300;
		}
		if(!$thumb_height&&$thumb_width)
		{
			$real_rate=$image[0]/$image[1];
			$thumb_height=$thumb_width/$real_rate;
		}
		//
		
		//create image from source file
		$image['format'] = strtolower(preg_replace('/^.*?\//', '', $image['mime']));
		switch( $image['format'] ) {
			case 'jpg':
			case 'jpeg':
				$image_data = imagecreatefromjpeg($input_image);
			break;
			case 'png':
				$image_data = imagecreatefrompng($input_image);
			break;
			case 'gif':
				$image_data = imagecreatefromgif($input_image);
			break;
			default:
				return false;
			break;
		}
		//
		
		//set thumb's size and thumb's position
		$rate=$thumb_width/$thumb_height;
		$real_rate=$image[0]/$image[1];
		
		if($image[0]<$thumb_width)
		{
			$square_size_x=$thumb_width;
			$square_size_y=$square_size_x/$rate;
			$x=($image[0]-$square_size_x)/2;
			$y=($image[1]-$thumb_height)/2;
		}
		elseif($image[1]<$thumb_height)
		{
			$square_size_y=$thumb_height;
			$square_size_x=$square_size_y*$rate;
			$y=($image[1]-$square_size_y)/2;
			$x=($image[0]-$thumb_width)/2;
		}
		else
		{
			if($real_rate>=$rate)
			{
				$square_size_y=$image[1];
				$square_size_x=$square_size_y*$rate;
				$x=($image[0]-$square_size_x)/2;
				$y=0;
			}
			else
			{
				$square_size_x=$image[0];
				$square_size_y=$square_size_x/$rate;
				$y=($image[1]-$square_size_y)/2;
				$x=0;
			}
		}
		
		//create canvas
		$canvas = imagecreatetruecolor($thumb_width, $thumb_height);
		//imagefill($canvas, 0, 0, $white);
		//
		
		// Transparent for GIF or PNG
		$file_ext=strtolower(preg_replace('/^.*\./', '', $output_image));

		if(($file_ext == 'gif') OR ($file_ext=='png'))
		{
			imagealphablending($canvas, false);
			imagesavealpha($canvas,true);
			$transparent = imagecolorallocatealpha($canvas, 255, 255, 255, 127);
			imagefilledrectangle($canvas, 0, 0, $thumb_width, $thumb_height, $transparent);
		}
		//
		// create thumb
		if(imagecopyresampled($canvas, $image_data, 0, 0, $x, $y, $thumb_width, $thumb_height, $square_size_x, $square_size_y))
		{
			/*//Fill background
			if(($file_ext == 'gif') OR ($file_ext=='png'))
			{
				$transparent = imagecolorallocatealpha($canvas, 255, 255, 255, 127);
				$x_image_fill=0;
				$y_image_fill=0;
				$max_fill=300;
				imagefill($canvas, $x_image_fill, $y_image_fill, $transparent);
				if($thumb_width>$max_fill)
				{
					while($x_image_fill<$thumb_width)
					{
						imagefill($canvas, $x_image_fill, $y_image_fill, $transparent);
						$x_image_fill+=$max_fill;
						if($thumb_height>$max_fill)
						{
							$y_image_fill=0;
							while($y_image_fill<$thumb_height)
							{
								imagefill($canvas, $x_image_fill, $y_image_fill, $transparent);
								$y_image_fill+=$max_fill;
							}
						}
					}
				}
			}*/
			//
			
			switch($file_ext) 
			{
				case 'jpg':
				case 'jpeg':
					return imagejpeg($canvas, $output_image, 100);
				break;
				case 'png':
					return imagepng($canvas, $output_image);
				break;
				case 'gif':
					return imagegif($canvas, $output_image);
				break;
				default:
					return false;
				break;
			}
			imagedestroy($canvas);
		} 
		else 
		{
			return false;
		}
	}
        //Check Folder
        public function checkFolderImg( $root_folder = '', $root_date = "" )
    	{
    		//Get date
    		if ( !$root_date )
    		{
    			$today = date("d/m/Y");
    			$today = explode("/", $today);
    		}
    		else
    		{
    			$today = explode("/", $root_date);
    		}
    	
    		$root_folder = $this->upload_folder;
            
    		//Check root folder
    		if( ! is_dir ( $root_folder ) )
    		{
  
    			mkdir( $root_folder, 0777 );
    			chmod( $root_folder, 0777 );
    		}
    	   
    		//Check year
    		$root_year = $root_folder.$today[2]."/";
    		if( ! is_dir ( $root_year ) )
    		{
    			mkdir( $root_year, 0777 );
    			chmod( $root_year, 0777 );
    		}
    	
    		//check month
    		$root_month = $root_folder.$today[2]."/".$today[1]."/";
    		if( ! is_dir ( $root_month ) )
    		{
    			mkdir( $root_month, 0777 );
    			chmod( $root_month, 0777 );
    		}
    	
    		//check day
    		$root_day = $root_folder.$today[2]."/".$today[1]."/".$today[0]."/";
    		if( ! is_dir ( $root_day ) )
    		{
    			mkdir( $root_day, 0777 );
    			chmod( $root_day, 0777 );
    		}
            
    	 
    		$thumb_folder = $root_day."/thumbnail/";
    	
    		if( ! is_dir( $thumb_folder ) )
    		{
    			mkdir( $thumb_folder, 0777 );
    			chmod( $thumb_folder, 0777 );
    		}
    		return $today[2]."/".$today[1]."/".$today[0];
    	}
}