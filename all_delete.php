<?php
if (!isset($_COOKIE['id'])){
	echo "<script
			type='text/javascript'>
				window.location= \"error.php\";
				 </script>";
	
}


include 'connect.php';

$dir = opendir('img_tmp/' . $_COOKIE['name'] . '/'); 
$count = 0;
       
while($file = readdir($dir)) { 

    if(is_file('img_tmp/' . $_COOKIE['name'] . '/' . $file)) { 
		
        //delete from table
		$q = 'DELETE FROM photos WHERE photolink = :photolink;';
		$query = $conn->prepare($q);
		$query->bindValue(':photolink', $file);
		$query->execute();
					
		//delete from oss
		include 'uploads/php_sdk_delete.php';
		
		//check deleted item number
		$count++;
    } 
	
}	


echo "<script
		type='text/javascript'>alert('ALL deleted');
		window.location= \"edit.php\";
		
		</script>";


?>