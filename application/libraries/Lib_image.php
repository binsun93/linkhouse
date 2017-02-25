<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CI_Lib_image {
	
	/**
	 * Resize image
	 * @Param
	 * $input_image - the original image
	 * $output_image - thumbnail image created
	 * $thumb_width - new thumbnail width. Default 300px
	 * $thumb_height - new thumbnail height. Default 300px
	 */
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
				if(($file_ext == 'gif') OR ($file_ext=='png') AND ($image[0]<$thumb_width OR $image[1]<$thumb_height))
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
	
	/**
	 * @Param
	 * $root_folder - folder to uploads example 'product'
	 * $root_date - d/m/Y
	 */
	public function checkFolderImg( $root_folder = '', $root_date = "" )
	{
		
		if(!$root_date) {
			$root_date = time();
		}
		
		$root_date = @date( "d/m/Y", $root_date);
		
		$today = explode("/", $root_date);
		
		//Check root folder
		//echo $root_folder."lll";
		if( ! is_dir ( $root_folder ) )
		{
			mkdir( $root_folder, 0777 );
			chmod( $root_folder, 0777 );
		}
	
		//Check year
		$root_year = $root_folder."/".$today[2]."/";
		if( ! is_dir ( $root_year ) )
		{
			mkdir( $root_year, 0777 );
			chmod( $root_year, 0777 );
		}
	
		//check month
		$root_month = $root_folder."/".$today[2]."/".$today[1]."/";
		if( ! is_dir ( $root_month ) )
		{
			mkdir( $root_month, 0777 );
			chmod( $root_month, 0777 );
		}
	
		//check day
		$root_day = $root_folder."/".$today[2]."/".$today[1]."/".$today[0]."/";
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
		return $root_day;
	}
}