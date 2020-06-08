<?php
if (!isset($_COOKIE['id'])){
	echo "<script
			type='text/javascript'>
				window.location= \"error.php\";
				 </script>";
	
}
session_start();


 // reference from https://www.php.net/manual/en/function.rmdir.php#117354
 function rrmdir($src) {
     $dir = opendir($src);
     while(false !== ( $file = readdir($dir)) ) {
         if (( $file != '.' ) && ( $file != '..' )) {
             $full = $src . '/' . $file;
             if ( is_dir($full) ) {
                 rrmdir($full);
             }
             else {
                 unlink($full);
             }
         }
     }
     closedir($dir);
     rmdir($src);
 }
 if (is_dir('/home/www/htdocs/img_tmp/' . $_COOKIE['name'])){
	 
	rrmdir('/home/www/htdocs/img_tmp/' . $_COOKIE['name']);
	
 }


setcookie('shuffle', '', time() - 3600);
setcookie('logged', '', time() - 3600);
setcookie('email', '', time() - 3600);
setcookie('id', '', time() - 3600);
setcookie('name', '', time() - 3600);
setcookie('photographer', '', time() - 3600);




echo "<script
			type='text/javascript'>
			window.location= \"index.php\";
			 </script>";
?>