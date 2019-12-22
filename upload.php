<?php

session_start();
header('Content-type: image/jpeg');

if(isset($_POST['upload']))
{
	
	if($_COOKIE['v1'] == "Alice")
	{

		$imageurl = $_POST['imageurl'];
		$file_path = pathinfo($imageurl);

		if($file_path['extension'] == "jpg" || $file_path['extension'] == "gif" || $file_path['extension'] == "png")
		{
			$image_in = new \Imagick($imageurl);
			$imagearray = $image_in->identifyImage();
	
			if($imagearray['compression'] == $file_path['extension'])
			{
				$_SESSION['imageurl'] = $imageurl;
				$imagefile = fopen($imageurl, "r");
				$image = fread($imagefile, filesize($imageurl));
				$_SESSION['image'] = $image;
		
				if($_POST['action'] == "private")
				{
	
					copy($imageurl, 'private'.$imageurl);
	
				}

				if($_POST['action'] == "public")
				{
	
					copy($imageurl, 'public'.$imageurl);
	
				}
		
				header("location: editor.php");
				
			}
		}
		else
		{
			
			$_SESSION['wrong'] = 'wrong image file';
			header("location: index.php");
	
		}
	}
	else
	{
		$_SESSION['require'] = 'require login first';
		header("location: index.php");
	
	}
}

	
?>