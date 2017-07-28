<?php
require_once("Class/Site_Config.php");
############ Configuration ##############
$thumb_square_size 		= 200; //Thumbnails will be cropped to 200x200 pixels
$max_image_size 		= 500; //Maximum image size (height and width)
$thumb_prefix			= "thumb_"; //Normal thumb Prefix
$destination_folder		= 'uploads/'; //upload directory ends with / (slash)
$jpeg_quality 			= 90; //jpeg quality
##########################################

//continue only if $_POST is set and it is a Ajax request
if(isset($_POST)&& isset($_POST['table'])&& isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

	// check $_FILES['ImageFile'] not empty
	if(!isset($_FILES['image_file']) || !is_uploaded_file($_FILES['image_file']['tmp_name'])){
			die('Image file is Missing!'); // output error when above checks fail.
	}
	
	//uploaded file info we need to proceed
	$image_name = $_FILES['image_file']['name']; //file name
	$image_size = $_FILES['image_file']['size']; //file size
	$image_temp = $_FILES['image_file']['tmp_name']; //file temp

	$image_size_info 	= getimagesize($image_temp); //get image size
	
	if($image_size_info){
		$image_width 		= $image_size_info[0]; //image width
		$image_height 		= $image_size_info[1]; //image height
		$image_type 		= $image_size_info['mime']; //image type
	}else{
		die("Make sure image file is valid!");
	}

	//switch statement below checks allowed image type 
	//as well as creates new image from given file 
	switch($image_type){
		case 'image/png':
			$image_res =  imagecreatefrompng($image_temp); break;
		case 'image/gif':
			$image_res =  imagecreatefromgif($image_temp); break;			
		case 'image/jpeg': case 'image/pjpeg':
			$image_res = imagecreatefromjpeg($image_temp); break;
		default:
			$image_res = false;
	}

	if($image_res){
		//Get file extension and name to construct new file name 
		$image_info = pathinfo($image_name);
		$image_extension = strtolower($image_info["extension"]); //image extension
		$image_name_only = strtolower($image_info["filename"]);//file name only, no extension
		
		//create a random name for new image (Eg: fileName_293749.jpg) ;
		$new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;
		
		//folder path to save resized images and thumbnails
		$thumb_save_folder 	= $destination_folder . $thumb_prefix . $new_file_name; 
		
		//call normal_resize_image() function to proportionally resize image
		
			//call crop_image_square() function to create square thumbnails
			if(!crop_image_square($image_res, $thumb_save_folder, $image_type, $thumb_square_size, $image_width, $image_height, $jpeg_quality))
			{
				die('Error Creating thumbnail');
			}
		else{	
			/* We have succesfully resized and created thumbnail image
			We can now output image to user's browser or store information in the database*/
			echo '<div align="center">';
			echo '<img src="uploads/'.$thumb_prefix . $new_file_name.'" alt="Thumbnail">';
			echo '<br />';
			echo '</div>';
		}
		if(!isset($_SESSION)){ session_start(); }
		$id=$_SESSION['userid'];
		$newone="uploads/".$thumb_prefix . $new_file_name."";
		$oldimage=$_SESSION['imageLink'];
		$db=DB::getinstance();
		$check = explode("\\", $oldimage);
		$prams= array('PhLink'=>$newone);
		$db->insert('image',$prams);
		$imageid=$db->last_id();
		
		$prams1= array('Image_id'=>$imageid);
		$db->update('users',$prams1,$id);
		$_SESSION['imageLink']=$newone;
		if( $check[0]!='images'){
			if(unlink($oldimage));
			$query1="DELETE FROM `image` WHERE PhLink='".$oldimage."'";
			$db->query($query1);
		}
		imagedestroy($image_res); //freeup memory
	}
}

#####  This function will proportionally resize image ##### 

##### This function corps image to create exact square, no matter what its original size! ######
function crop_image_square($source, $destination, $image_type, $square_size, $image_width, $image_height, $quality){
	if($image_width <= 0 || $image_height <= 0){return false;} //return false if nothing to resize
	
	if( $image_width > $image_height )
	{
		$y_offset = 0;
		$x_offset = ($image_width - $image_height) / 2;
		$s_size 	= $image_width - ($x_offset * 2);
	}else{
		$x_offset = 0;
		$y_offset = ($image_height - $image_width) / 2;
		$s_size = $image_height - ($y_offset * 2);
	}
	$new_canvas	= imagecreatetruecolor( $square_size, $square_size); //Create a new true color image
	
	//Copy and resize part of an image with resampling
	if(imagecopyresampled($new_canvas, $source, 0, 0, $x_offset, $y_offset, $square_size, $square_size, $s_size, $s_size)){
		save_image($new_canvas, $destination, $image_type, $quality);
	}

	return true;
}

##### Saves image resource to file ##### 
function save_image($source, $destination, $image_type, $quality){
	switch(strtolower($image_type)){//determine mime type
		case 'image/png': 
			imagepng($source, $destination); return true; //save png file
			break;
		case 'image/gif': 
			imagegif($source, $destination); return true; //save gif file
			break;          
		case 'image/jpeg': case 'image/pjpeg': 
			imagejpeg($source, $destination, $quality); return true; //save jpeg file
			break;
		default: return false;
	}
}