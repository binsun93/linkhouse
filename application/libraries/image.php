<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Image {
    /*
     * Create Photo Thumbnail
     * Admin: createThumbnail($name,380,550,_product_orginal_path,_product_thumb_path,'');
     * Admin :: createThumbnail($idmod,380,550,$file,"upload/thumb/",'');
     */

    public function __construct() {
        require_once('ImageWorkshop.php');
    }
	
	function createThumbnails($img, $thumb_width,$thumb_height)
	{
		if (!extension_loaded('gd') && !extension_loaded('gd2'))
		{			
			return false;
		}
		$arrExt = explode("/",$img);				
		$sub_cache_photo = 'vyuha_resize';
		
		list($width_orig, $height_orig, $image_type) = getimagesize($img);
	   
		switch ($image_type)
		{
			case 1: $im = imagecreatefromgif($img); break;
			case 2: $im = imagecreatefromjpeg($img);  break;
			case 3: $im = imagecreatefrompng($img); break;
			default:  trigger_error('Unsupported filetype!', E_USER_WARNING);  break;
		}	   
		
		$newImg = imagecreatetruecolor($thumb_width, $thumb_height);
	   
		if(($image_type == 1) OR ($image_type==3))
		{
			imagealphablending($newImg, false);
			imagesavealpha($newImg,true);
			$transparent = imagecolorallocatealpha($newImg, 155, 155, 155, 27);
			imagefilledrectangle($newImg, 0, 0, $thumb_width, $thumb_height, $transparent);
		}
		
		imagecopyresampled($newImg, $im, 0, 0, 0, 0, $thumb_width, $thumb_height, $width_orig, $height_orig);	    
		
		
		$path_thumbs =  BASE_PATH_IMG.'/'.PATH_UPLOAD_VYUHA;
		
		$cut_img = explode(".",$arrExt[count($arrExt)-1]);
		$cut_img_new = $cut_img[0].'-'.$thumb_width.'x'.$thumb_height.'.'.$cut_img[1]; 
		
		$path_img_news = $path_thumbs.$sub_cache_photo.'/'. $cut_img_new;
		
		if(!file_exists($path_img_news)){
			$oldumask = umask(0);
			mkdir($path_thumbs.$sub_cache_photo, 0777);
			umask($oldumask) ;
		}
		
		switch ($image_type)
		{
			case 1: imagegif($newImg,$path_img_news); break;
			case 2: imagejpeg($newImg,$path_img_news);  break;
			case 3: imagepng($newImg,$path_img_news); break;
			default:  trigger_error('Failed resize image!', E_USER_WARNING);  break;
		}
		
		$path_img_result = substr(BASE_NAME,0,-1).'/'.PATH_UPLOAD_VYUHA.$sub_cache_photo.'/'.$cut_img_new;
		
		return $path_img_result;
	}
	
        
    /* put the custom functions in the autoload register when the class is initialized */

    public function crop($source, $destination, $image_name,$x1,$y1,$x2,$y2) {

        $layer = new ImageWorkshop(array(
                    "imageFromPath" => $source,
                ));
        $position = "LT";

        $layer->cropInPixel($x2, $y2, $x1, $y1, $position);
        $createFolders = true;
        $backgroundColor = null; // transparent, only for PNG (otherwise it will be white if set null)
        $imageQuality = 100; // useless for GIF, usefull for PNG and JPEG (0 to 100%)

        $layer->save($destination, $image_name, $createFolders, $backgroundColor, $imageQuality);
    }

    /* put the custom functions in the autoload register when the class is initialized */

    public function thumb($source, $destination, $image_name, $width) {

        $layer = new ImageWorkshop(array(
                    "imageFromPath" => $source,
                ));
        $layer->resizeInPixel($width, NULL, true);
        $createFolders = true;
        $backgroundColor = null; // transparent, only for PNG (otherwise it will be white if set null)
        $imageQuality = 85; // useless for GIF, usefull for PNG and JPEG (0 to 100%)

        $layer->save($destination, $image_name, $createFolders, $backgroundColor, $imageQuality);
    }    
	
    /* put the custom functions in the autoload register when the class is initialized */

    public function resize($source, $image_name, $width, $height) {
        
        $layer = new ImageWorkshop(array(
                    "imageFromPath" => $source,
                ));
        $layer->resizeInPixel($width, $height, false);
        chmod(getcwd() . "/upload", 0777);
        $dirPath = getcwd() . "/upload";
        $createFolders = true;
        $backgroundColor = null; // transparent, only for PNG (otherwise it will be white if set null)
        $imageQuality = 85; // useless for GIF, usefull for PNG and JPEG (0 to 100%)

        $layer->save($dirPath, $image_name, $createFolders, $backgroundColor, $imageQuality);
        
    }

    public function move($tmp_name, $path) {
        move_uploaded_file($tmp_name, $path);
    }

    public function check_wh($file) {

        $size = getimagesize($file['uploadfile']['tmp_name']);

        $imgW = $size[0];
        $imgH = $size[1];

        $width = 800;
        $height = 600;

        if ($imgW == $width && $imgH == $height) {
            $w = $width;
            $h = $height;
            $test = '1';
        }
        if ($imgW > $width && $imgH > $height && $imgW < 1200 && $imgH < 1300) {
            $w = $width;
            $h = $height;
            $test = '2';
        }
        if ($imgW <= $width && $imgH <= $height) {
            $w = $imgW;
            $h = $imgH;
            $test = '4';
        } else if ($imgH > $imgW) { // height > width
            if (($imgH / $imgW) >= 1.4) {
                if ($imgH > 1500) {
                    $w = $imgW / 2;
                    $h = $imgH / 2;
                    $test = '5.1';
                } else {
                    $w = $imgW - ($imgW * 20 / 100);
                    $h = $imgH - ($imgH * 20 / 100);
                    $test = '5.2';
                }
            } else if (($imgH / $imgW) < 1.4) {
                if ($imgH > $height * 2 && $imgW > $width * 2) {
                    $w = $imgW / 3;
                    $h = $imgH / 3;
                    $test = '6.1';
                } else {
                    $w = $imgW;
                    $h = $imgH;
                    $test = '6.2';
                }
            }
        } else if ($imgW > $imgH) { // width > height
            if (($imgW / $imgH) >= 3.5) {
                if ($imgW >= 1800) {
                    $w = $imgW - ($imgW * 40 / 100);
                    $h = $imgH - ($imgH * 40 / 100);
                    $test = '7.1';
                } else {
                    $w = $width;
                    $h = $imgH - ($imgH * 20 / 100);
                    $test = '7.2';
                }
            } else if (($imgW / $imgH) <= 2 && ($imgW / $imgH) >= 1.8) {
                $w = $width;
                $h = $imgH - ($imgH * 20 / 100);
                $test = '8';
            } else if (($imgW / $imgH) < 1.8) {
                if ($imgW >= 1600 && $imgH >= 1200) {
                    $w = $imgW / 2;
                    $h = $imgH / 2;
                    $test = '9.1';
                } else {
                    $w = $imgW - ($imgW * 20 / 100);
                    $h = $imgH - ($imgH * 20 / 100);
                    $test = '9.2';
                }
            }
        }

        if ($imgW == $imgH) { // height == width
            if ($imgW >= 1200 && $imgH >= 1200) {
                $w = $imgW / 2;
                $h = $imgH / 2;
                $test = '10.1';
            } else {
                $w = $imgW;
                $h = $imgH;
                $test = '10.2';
            }
        }
        $image = array('width' => $w, 'height' => $h);
        return $image;
    }

    /*
     * Create Photo Thumbnail
     * Admin: createThumbnail($name,380,550,_product_orginal_path,_product_thumb_path,'');
     * Admin :: createThumbnail($idmod,380,550,$file,"upload/thumb/",'');
     */

    function createThumbnail($image, $largeur_max, $hauteur_max, $source, $destination, $prefixe) {

        if (!file_exists($source . $image)) {
            echo "Error: no directory";
            exit;
        }
        $ext = strtolower(strrchr($image, '.'));
        if (!file_exists($source . $image)) {
            echo "Error: no directory";
            exit;
        }
        $ext = strtolower(strrchr($image, '.'));
        if ($ext == ".jpg" || $ext == ".jpeg" || $ext == ".gif" || $ext == ".png" || $ext == ".JPG" || $ext == ".JPEG") {
            $size = getimagesize($source . $image);
            $largeur_src = $size[0];
            $hauteur_src = $size[1];
            if ($size[2] == 1 || $size[2] != 2 || $size[2] != 3 || $size[2] != 6) {
                if ($size[2] == 1) {
                    // format gif
                    $image_src = imagecreatefromgif($source . $image);
                }
                if ($size[2] == 2) {
                    // format jpg ou jpeg
                    $image_src = imagecreatefromjpeg($source . $image);
                }
                if ($size[2] == 3) {
                    // format png
                    $image_src = imagecreatefrompng($source . $image);
                }
                if ($size[2] == 6) {
                    // format bmp
                    $image_src = imagecreatefromwbmp($source . $image);
                }
                if ($largeur_src > $largeur_max OR $hauteur_src > $hauteur_max) {
                    if ($hauteur_src <= $largeur_src) {
                        $ratio = $largeur_max / $largeur_src;
                    } else {
                        $ratio = $hauteur_max / $hauteur_src;
                    }
                } else {
                    $ratio = 1;
                }
                if ($largeur_src / $hauteur_src >= 1 && $largeur_src / $hauteur_src <= 1.5) {
                    $newHeight = $hauteur_max;
                    $newWidth = ($largeur_src / $hauteur_src) * $hauteur_max;
                    $image_dest = imagecreatetruecolor($newWidth, $newHeight);
                    imagecopyresampled($image_dest, $image_src, 0, 0, 0, 0, $newWidth, $newHeight, $largeur_src, $hauteur_src);
                } else {
                    $image_dest = imagecreatetruecolor(round($largeur_src * $ratio), round($hauteur_src * $ratio));
                    imagecopyresampled($image_dest, $image_src, 0, 0, 0, 0, round($largeur_src * $ratio), round($hauteur_src * $ratio), $largeur_src, $hauteur_src);
                }

                if (!imagejpeg($image_dest, $destination . $prefixe . $image)) {
                    exit;
                }
            }
        }
    }

}

//warter mark logo
function waterMarkLogo($orginal, $newImage, $logo) {

    $i1 = asido::image($orginal, $newImage);
    Asido::watermark($i1, $logo, ASIDO_WATERMARK_BOTTOM_RIGHT);
    $i1->save(ASIDO_OVERWRITE_ENABLED);
}

//crop image
function cropPhoto($orginal, $newImage, $w, $h, $x, $y) {
    $i11 = asido::image($orginal, $newImage);
    Asido::Crop($i11, $x, $y, $w, $h);

    $i11->save(ASIDO_OVERWRITE_ENABLED);
}

//crop image
function framePhoto($orginal, $newImage, $w, $h) {
    $i111 = asido::image($orginal, $newImage);
    Asido::Frame($i111, $w, $h, Asido::Color(252, 106, 151));
    $i111->save(ASIDO_OVERWRITE_ENABLED);
}

//watermarkImage
function watermarkImage($SourceFile, $WaterMarkText, $DestinationFile) {
    list($width, $height) = getimagesize($SourceFile);
    $image_p = imagecreatetruecolor($width, $height);
    $image = imagecreatefromjpeg($SourceFile);
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width, $height);
    $black = imagecolorallocate($image_p, 252, 79, 133);
    $font = 'fonts/lib/juggernaut.ttf';
    $font_size = 20;
    imagettftext($image_p, $font_size, 0, 10, 30, $black, $font, $WaterMarkText);
    if ($DestinationFile <> '') {
        imagejpeg($image_p, $DestinationFile, 100);
    } else {
        header('Content-Type: image/jpeg');
        imagejpeg($image_p, null, 100);
    };
    imagedestroy($image);
    imagedestroy($image_p);
}

?>