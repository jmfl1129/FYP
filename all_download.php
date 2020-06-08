<?php
if (!isset($_COOKIE['id'])){
	echo "<script
			type='text/javascript'>
				window.location= \"error.php\";
				 </script>";
	
}


$download_link = 'img_tmp/' . $_COOKIE['name'] . '/' . 'download.zip';


@unlink($download_link);
		
		
$zip = new ZipArchive;
$res = $zip->open($download_link, ZipArchive::CREATE);

if ($res === TRUE) {
	
	// Store the path into the variable 
    $dir = opendir('img_tmp/' . $_COOKIE['name'] . '/'); 
       
    while($file = readdir($dir)) { 
        if(is_file('img_tmp/' . $_COOKIE['name'] . '/' . $file)) { 
            $zip -> addFile('img_tmp/' . $_COOKIE['name'] . '/' . $file); 
        } 
    } 
	$zip->close();
	
	echo "<script
			type='text/javascript'>alert('download...');
			window.location= \"$download_link\";
			
		  </script>";
} else {
			
}

?>