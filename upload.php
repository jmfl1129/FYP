<?php
if (!isset($_COOKIE['id'])){
	echo "<script
			type='text/javascript'>
				window.location= \"error.php\";
				 </script>";
	
}



### upload image files or zip files and unzip

if(isset($_POST["upload"]) && !empty($_FILES["file"]["name"])){
		
	session_start();

	include 'connect.php';
		
	$statusMsg = '';

	// File upload path
	$targetDir = "uploads/";
	$fileName = basename($_FILES["file"]["name"]);
	$targetFilePath = $targetDir . $fileName;
	$fileType = strtolower(pathinfo($targetFilePath,PATHINFO_EXTENSION));

		// Allow certain file formats
		$allowTypes = array('jpg','png','jpeg','gif','pdf');
		if(in_array($fileType, $allowTypes)){
			// Upload file to server
			if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
				//generate random object name in OSS
				$randname = rand();
				$randname = md5($randname) . '.jpg';
				
				// Upload to OSS bucket and delete it locally
				include 'uploads/php_sdk_upload.php';
				
				// Insert image file name into database
				$query = $conn->prepare("INSERT into photos (photouploadingtime, photolink, phid) VALUES ( NOW(), :filename,  :phid) ;");
				$query->bindValue(':filename', $randname);
				$query->bindValue(':phid', $_COOKIE['id']);
				$insert = $query->execute();
				if($insert){
					$statusMsg = "The file ".$fileName. " has been uploaded successfully.";
				}else{
					$statusMsg = "File upload failed, please try again.";
				} 
			}else{
				$statusMsg = "Sorry, there was an error uploading your file.";
			}
		}
		
		else if($fileType == 'zip'){
			
			$zip = new ZipArchive;
			if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
				
				if ($zip->open($targetFilePath)){
					$allowTypes = array('jpg','png','jpeg','gif','pdf');
					for($i = 0; $i < $zip->numFiles; $i++) {
						
						$current = $zip->statIndex($i);
						$fileType = strtolower(pathinfo($current["name"],PATHINFO_EXTENSION));
						if(in_array($fileType, $allowTypes) && !(is_dir($current["name"])))
						{
							
							//generate random object name in OSS
							$randname = rand();
							$randname = md5($randname) . '.jpg';
							
							$fileName = $current["name"];
							$targetFilePath = $targetDir . $fileName;
							$query = $conn->prepare("INSERT into photos (photouploadingtime, photolink, phid) VALUES ( NOW(), :filename,  :phid) ;");
							$query->bindValue(':filename', $randname);
							$query->bindValue(':phid', $_COOKIE['id']);
							$insert = $query->execute();
							$zip->extractTo($targetDir, array($zip->getNameIndex($i)));
							
							// Upload to OSS bucket and delete it locally
							include 'uploads/php_sdk_upload.php';
							
						}
						
					}
					$zip->close();
					
					$statusMsg = "The file ".basename($_FILES["file"]["name"]). " has been uploaded successfully.";
					
				}
			
			}
		
		}
		
		else{
			$statusMsg = 'Sorry, only ZIP, JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
		}

	// Display status message
	echo "<script type='text/javascript'>
	
			alert('$statusMsg');
			
		  </script>";


	/* reference: https://www.codexworld.com/upload-store-image-file-in-database-using-php-mysql/ */

}
?>

<style>

* {

  box-sizing: border-box;
}

html {
  height: 100%;
}

body {
  margin: 0;
  padding: 0;
  font-family: Arial;
  background: url('https://i.gifer.com/76YS.gif');
  background-repeat: repeat;
  background-size: 50px 50px;
  animation: slide 20s infinite linear;
  width: 100%;
  height: 100%;
}


@keyframes slide {
  from {
    background-position: 0 0;
  }

  to {
    background-position: -120px 60px;
  }
}

#sticky-footer {
  background: #000000;
  width: 100%;
  height: 100px;
  position: absolute;
  top: 100%;
  left: 0;
}

#wrap {
  min-height: 100%;
  position: relative;
}

</style>

<!DOCTYPE html>
<html lang="en">
<head> 

	<title>Marathon-fyp</title> 

	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
	
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="css/css_login.css">

</head>
<meta charset="utf-8"/>

<div id="wrap">


<body>
	
	<!--reference from  https://getbootstrap.com/docs/4.0/components/navbar/-->
	<nav class="navbar navbar-dark bg-dark" style="background-color: #000000 !important;">
    <a class="navbar-brand" href="#">Welcome <?php echo $_COOKIE['name'] ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="upload.php">Upload</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="edit.php">Edit</a>
        </li>
        <li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" data-target="#navbarColor01" aria-controls="navbarColor01" aria-haspopup="true" aria-expanded="false">
			  Dropdown link
			</a>
			<div class="dropdown-menu bg-dark" style="background-color: #000000 !important;" aria-labelledby="navbarDropdownMenuLink">
			  <a class="dropdown-item text-secondary" href="logout.php">Logout</a>
			  <a class="dropdown-item text-secondary" href="#">About</a>
			</div>
		</li>
      </ul>
    </div>
  </nav>
	<!-- reference end -->

	<div class="container" align="center">
		

		<!-- form used to log in -->
		
	  <?php include 'button/button.php'; ?>

	<!-- END of form used to log in -->
	
</div>
	

</body>

</div>

	<footer id="sticky-footer" class="py-4 text-white-50 fixed-bottom">
		<div class="container text-center">
		  <small>Marathon-fyp</small>
		</div>
	  </footer>
</html>


