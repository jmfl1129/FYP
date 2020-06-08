<?php
if (!isset($_COOKIE['id'])){
	echo "<script
			type='text/javascript'>
				window.location= \"error.php\";
				 </script>";
	
}


$_SESSION['rowcount'] = "";

function search($text){
	
 include 'connect.php';
	
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
	
	
  $q = 'SELECT * FROM photos WHERE number = :number;';
  $query = $conn->prepare($q);
  $query->bindValue(':number', $text);
  $query->execute();
  
  //set session variable
  $_SESSION['rowcount'] = $query->rowCount();
  $_SESSION['query'] = $query;
}

session_start();
if (isset($_POST['search'])){
    search(htmlspecialchars($_POST['text']));
}
?>


<!DOCTYPE html>
<html lang="en">
<head> 

	<title>Marathon-fyp</title> 

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
	
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
	
	<link rel="stylesheet" href="css/search_box.css">
	<link rel="stylesheet" href="css/select_button.css">
	<link rel="stylesheet" href="css/pop_up.css">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/css_button_general.css">

	
	<script>
	// When the user clicks on img, open the popup
	function popup(id) {
	  var x = document.getElementById(id);
	  if (x.style.display === "inline-flex") {
		x.style.display = "none";
	  } else {
		x.style.display = "inline-flex";
	  }
	}
	
	// When the user clicks on select_button, color the button
	function color(cid) {
	  var y = document.getElementById(cid);
	  var name = "nohover";
	  var arr = y.className.split(" ");
	  if (arr.indexOf(name) == -1) {
		y.className += " " + name;
		//y.style.color = "#255784 !important";
		//y.style.background = "#2196f3 !important";
		//y.style.box-shadow = "0 0 10px #2196f3, 0 0 40px #2196f3, 0 0 80px #2196f3";
		//y.style.transition-delay = "0s";
		//y.style.cursor = "pointer";
	  } else {
		y.className = y.className.replace(new RegExp('(?:^|\\s)'+ 'nohover' + '(?:\\s|$)'), ' ');
		//y.style.color = "#2196f3";
		//y.style.background = "";
		//y.style.box-shadow = "";
		//y.style.transition-delay = "";
		//y.style.cursor = "";
	  }
	}
	
	
	</script>

</head>
<meta charset="utf-8"/>
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

.header {
  text-align: center;
  padding: 32px;
}

.row {
  display: flex;
  flex-wrap: wrap;
  padding-left: 25px;
  padding-right: 0px;
  width:100%;
}

/* Create four equal columns that sits next to each other */
.column {
  flex: 12.5%;
  max-width: 12.5%;
  padding: 0 4px;
  height: 100%;
}

.column img {
  margin-top: 8px;
  vertical-align: middle;
  max-width: 100%;
  padding-bottom: 12px;
}

.column input {
  margin-top: 8px;
  vertical-align: middle;
  max-width: 100%;
  padding-bottom: 12px;
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


#content {
	padding-bottom: 100px;
}

@media only screen and (max-width: 1000px) {
  .column {
    flex: 25%;
    max-width: 25%;
  }
  =
}

/* Responsive layout - makes a two column-layout instead of four columns */
@media only screen and (max-width: 800px) {
  .column {
    flex: 50%;
    max-width: 50%;
  }
 
}

/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
@media only screen and (max-width: 600px) {
  .column {
    flex: 100%;
    max-width: 100%;
  }
}
</style>
<body>




<div id="wrap">

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
          <a class="nav-link" href="search_box.php">Search</a>
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


	<!-- Header -->
	<div class="header">

	<!-- reference from https://codepen.io/huange/pen/rbqsD by Emily Huang-->
	<div class="wrap">
		<form method="POST" action="search_box.php" >
		   <div class="search">
			  <input type="text" class="searchTerm" placeholder="Type your number sheet number (eg: 000001)" name="text" >
			  <button name="search" type="submit" class="searchButton">
				<i class="fa fa-search"></i>
			 </button>
		   </div>
		</form>
	</div>

	</div>

	<div id="content">

		<form method="POST" action="download.php" class="form-signin" target="_blank">


		<button type="submit" name="download" id="sel_download" style="opacity: 0; position: absolute; left: -100vw;" ></button>
		<label for="sel_download" class="button" style="left: 90% !important; top: 98% !important; width: 150px !important; height: 50px !important;">
				  <h1 class="onoff" style="font-size: 1.5em !important; margin: 7px 0 0 !important;">
					<span class="first">D</span><span>o</span><span class="first">wn</span><span>load</span>
				  </h1>
		</label>
		
		
		<a href="all_download.php" class="button" style="left: 20% !important; top: 98% !important; width: 200px !important; height: 50px !important;" target="_blank">
				  <h1 class="onoff" style="font-size: 1.5em !important; margin: 7px 0 0 !important;">
					<span class="first">D</span><span>o</span><span class="first">wn</span><span>load</span><span class="first"> ALL</span>
				  </h1>
		</a>
		
		<!-- Photo Grid -->

		<div class="row"> 
		<?php 
		if(isset($_SESSION['query'])){
			$_SESSION['i'] = 0;
			while ($_SESSION['i'] < $_SESSION['rowcount']) {
					
		?>

		  <div class="column">
			  <?php 
				$row = $_SESSION['query']->fetch(\PDO::FETCH_ASSOC);
				$_SESSION['i']++;
				$object_name = $row['photolink'];
				include 'uploads/php_sdk_download.php';
				$_SESSION['localfile'] = 'img_tmp/' . $_COOKIE['name'] . '/' . $object_name;
				$_SESSION['photolink'] = $row['photolink'];
				$_SESSION['photoname'] = $row['photoname'];
				$_SESSION['competition'] = $row['competition'];
				$_SESSION['photouploadingtime'] = $row['photouploadingtime'];
				$_SESSION['venue'] = $row['venue'];
				$_SESSION['number'] = $row['number'];
				$_SESSION['dateofthecompetition'] = $row['dateofthecompetition'];
			  ?>
			  <img src=<?php echo $_SESSION['localfile']; ?> onclick="popup('<?php echo 'a' . $_SESSION['i']; ?>');">
			  
			  <div class="modal" display="none !important" id="<?php echo 'a' . $_SESSION['i']; ?>">
				  <div class="options">
					  <img src=<?php echo $_SESSION['localfile']; ?>></img>
					  <div class="flex">
						  <p class="message">Photoname: <?php echo $_SESSION['photoname']; ?></p>
						  <p class="message">Competition: <?php echo $_SESSION['competition']; ?></p>
						  <p class="message">Photo uploading time: <?php echo $_SESSION['photouploadingtime']; ?></p>
						  <p class="message">Venue: <?php echo $_SESSION['venue']; ?></p>
						  <p class="message">Number: <?php echo $_SESSION['number']; ?></p>
						  <p class="message">Date of the competition: <?php echo $_SESSION['dateofthecompetition']; ?></p>
						  <div class="options">
							<a class="btn">Great</a>
							<p class="btn" onclick="popup('<?php echo 'a' . $_SESSION['i']; ?>');">Close</p>
						  </div>
					  </div>
				  </div>
			  </div>
			  <?php 
				  # select button
				  echo "
						<input type=\"checkbox\" id=\"cb{$_SESSION['i']}\" name=\"check_list[]\" value=\"{$_SESSION['photolink']}\" style=\"opacity: 0; position: absolute; left: -100vw;\">
						
						<label class=\"nbtn\" for=\"cb{$_SESSION['i']}\" id=\"b{$_SESSION['i']}\" onclick=\"color('b{$_SESSION['i']}');\">
						<span></span>
						<span></span>
						<span></span>
						<span></span>
						</label>";
				  if ($_SESSION['i'] == $_SESSION['rowcount'])
				  {
					  break;
				  }
			  ?>
		  </div>
		  
		  <div class="column">
			  <?php 
			  
				$row = $_SESSION['query']->fetch(\PDO::FETCH_ASSOC);
				$_SESSION['i']++;
				$object_name = $row['photolink'];
				include 'uploads/php_sdk_download.php';
				$_SESSION['localfile'] = 'img_tmp/' . $_COOKIE['name'] . '/' . $object_name;
				$_SESSION['photolink'] = $row['photolink'];
				$_SESSION['photoname'] = $row['photoname'];
				$_SESSION['competition'] = $row['competition'];
				$_SESSION['photouploadingtime'] = $row['photouploadingtime'];
				$_SESSION['venue'] = $row['venue'];
				$_SESSION['number'] = $row['number'];
				$_SESSION['dateofthecompetition'] = $row['dateofthecompetition'];
			  ?>
			  <img type="image" src=<?php echo $_SESSION['localfile']; ?> onclick="popup('<?php echo 'a' . $_SESSION['i']; ?>');">
			  
			  <div class="modal" display="none !important" id="<?php echo 'a' . $_SESSION['i']; ?>">
				  <div class="options">
					  <img src=<?php echo $_SESSION['localfile']; ?>></img>
					  <div class="flex">
						  <p class="message">Photoname: <?php echo $_SESSION['photoname']; ?></p>
						  <p class="message">Competition: <?php echo $_SESSION['competition']; ?></p>
						  <p class="message">Photo uploading time: <?php echo $_SESSION['photouploadingtime']; ?></p>
						  <p class="message">Venue: <?php echo $_SESSION['venue']; ?></p>
						  <p class="message">Number: <?php echo $_SESSION['number']; ?></p>
						  <p class="message">Date of the competition: <?php echo $_SESSION['dateofthecompetition']; ?></p>
						  <div class="options">
							<a class="btn">Great</a>
							<p class="btn" onclick="popup('<?php echo 'a' . $_SESSION['i']; ?>');">Close</p>
						  </div>
					  </div>
				  </div>
			  </div>
			  <?php 
				  # select button
				  echo "
						<input type=\"checkbox\" id=\"cb{$_SESSION['i']}\" name=\"check_list[]\" value=\"{$_SESSION['photolink']}\" style=\"opacity: 0; position: absolute; left: -100vw;\">
						
						<label class=\"nbtn\" for=\"cb{$_SESSION['i']}\" id=\"b{$_SESSION['i']}\" onclick=\"color('b{$_SESSION['i']}');\">
						<span></span>
						<span></span>
						<span></span>
						<span></span>
						</label>";
				  if ($_SESSION['i'] == $_SESSION['rowcount'])
				  {
					  break;
				  }
			  ?>
		  </div> 
		   
		  <div class="column">
			  <?php 
			  
				$row = $_SESSION['query']->fetch(\PDO::FETCH_ASSOC);
				$_SESSION['i']++;
				$object_name = $row['photolink'];
				include 'uploads/php_sdk_download.php';
				$_SESSION['localfile'] = 'img_tmp/' . $_COOKIE['name'] . '/' . $object_name;
				$_SESSION['photolink'] = $row['photolink'];
				$_SESSION['photoname'] = $row['photoname'];
				$_SESSION['competition'] = $row['competition'];
				$_SESSION['photouploadingtime'] = $row['photouploadingtime'];
				$_SESSION['venue'] = $row['venue'];
				$_SESSION['number'] = $row['number'];
				$_SESSION['dateofthecompetition'] = $row['dateofthecompetition'];
			  ?>
			  <img type="image" src=<?php echo $_SESSION['localfile']; ?> onclick="popup('<?php echo 'a' . $_SESSION['i']; ?>');">
			  
			  <div class="modal" display="none !important" id="<?php echo 'a' . $_SESSION['i']; ?>">
				  <div class="options">
					  <img src=<?php echo $_SESSION['localfile']; ?>></img>
					  <div class="flex">
						  <p class="message">Photoname: <?php echo $_SESSION['photoname']; ?></p>
						  <p class="message">Competition: <?php echo $_SESSION['competition']; ?></p>
						  <p class="message">Photo uploading time: <?php echo $_SESSION['photouploadingtime']; ?></p>
						  <p class="message">Venue: <?php echo $_SESSION['venue']; ?></p>
						  <p class="message">Number: <?php echo $_SESSION['number']; ?></p>
						  <p class="message">Date of the competition: <?php echo $_SESSION['dateofthecompetition']; ?></p>
						  <div class="options">
							<a class="btn">Great</a>
							<p class="btn" onclick="popup('<?php echo 'a' . $_SESSION['i']; ?>');">Close</p>
						  </div>
					  </div>
				  </div>
			  </div>
			  <?php 
				  # select button
				  echo "
						<input type=\"checkbox\" id=\"cb{$_SESSION['i']}\" name=\"check_list[]\" value=\"{$_SESSION['photolink']}\" style=\"opacity: 0; position: absolute; left: -100vw;\">
						
						<label class=\"nbtn\" for=\"cb{$_SESSION['i']}\" id=\"b{$_SESSION['i']}\" onclick=\"color('b{$_SESSION['i']}');\">
						<span></span>
						<span></span>
						<span></span>
						<span></span>
						</label>";
				  if ($_SESSION['i'] == $_SESSION['rowcount'])
				  {
					  break;
				  }
			  ?>
		  </div>
		  
		  <div class="column">
			  <?php 
			  
				$row = $_SESSION['query']->fetch(\PDO::FETCH_ASSOC);
				$_SESSION['i']++;
				$object_name = $row['photolink'];
				include 'uploads/php_sdk_download.php';
				$_SESSION['localfile'] = 'img_tmp/' . $_COOKIE['name'] . '/' . $object_name;
				$_SESSION['photolink'] = $row['photolink'];
				$_SESSION['photoname'] = $row['photoname'];
				$_SESSION['competition'] = $row['competition'];
				$_SESSION['photouploadingtime'] = $row['photouploadingtime'];
				$_SESSION['venue'] = $row['venue'];
				$_SESSION['number'] = $row['number'];
				$_SESSION['dateofthecompetition'] = $row['dateofthecompetition'];
			  ?>
			  <img type="image" src=<?php echo $_SESSION['localfile']; ?> onclick="popup('<?php echo 'a' . $_SESSION['i']; ?>');">
			  
			  <div class="modal" display="none !important" id="<?php echo 'a' . $_SESSION['i']; ?>">
				  <div class="options">
					  <img src=<?php echo $_SESSION['localfile']; ?>></img>
					  <div class="flex">
						  <p class="message">Photoname: <?php echo $_SESSION['photoname']; ?></p>
						  <p class="message">Competition: <?php echo $_SESSION['competition']; ?></p>
						  <p class="message">Photo uploading time: <?php echo $_SESSION['photouploadingtime']; ?></p>
						  <p class="message">Venue: <?php echo $_SESSION['venue']; ?></p>
						  <p class="message">Number: <?php echo $_SESSION['number']; ?></p>
						  <p class="message">Date of the competition: <?php echo $_SESSION['dateofthecompetition']; ?></p>
						  <div class="options">
							<a class="btn">Great</a>
							<p class="btn" onclick="popup('<?php echo 'a' . $_SESSION['i']; ?>');">Close</p>
						  </div>
					  </div>
				  </div>
			  </div>
			  <?php 
				  # select button
				  echo "
						<input type=\"checkbox\" id=\"cb{$_SESSION['i']}\" name=\"check_list[]\" value=\"{$_SESSION['photolink']}\" style=\"opacity: 0; position: absolute; left: -100vw;\">
						
						<label class=\"nbtn\" for=\"cb{$_SESSION['i']}\" id=\"b{$_SESSION['i']}\" onclick=\"color('b{$_SESSION['i']}');\">
						<span></span>
						<span></span>
						<span></span>
						<span></span>
						</label>";
				  if ($_SESSION['i'] == $_SESSION['rowcount'])
				  {
					  break;
				  }
			  ?>
			  
		  </div>
		  
		  <div class="column">
			  <?php 
			  
				$row = $_SESSION['query']->fetch(\PDO::FETCH_ASSOC);
				$_SESSION['i']++;
				$object_name = $row['photolink'];
				include 'uploads/php_sdk_download.php';
				$_SESSION['localfile'] = 'img_tmp/' . $_COOKIE['name'] . '/' . $object_name;
				$_SESSION['photolink'] = $row['photolink'];
				$_SESSION['photoname'] = $row['photoname'];
				$_SESSION['competition'] = $row['competition'];
				$_SESSION['photouploadingtime'] = $row['photouploadingtime'];
				$_SESSION['venue'] = $row['venue'];
				$_SESSION['number'] = $row['number'];
				$_SESSION['dateofthecompetition'] = $row['dateofthecompetition'];
			  ?>
			  <img type="image" src=<?php echo $_SESSION['localfile']; ?> onclick="popup('<?php echo 'a' . $_SESSION['i']; ?>');">
			  
			  <div class="modal" display="none !important" id="<?php echo 'a' . $_SESSION['i']; ?>">
				  <div class="options">
					  <img src=<?php echo $_SESSION['localfile']; ?>></img>
					  <div class="flex">
						  <p class="message">Photoname: <?php echo $_SESSION['photoname']; ?></p>
						  <p class="message">Competition: <?php echo $_SESSION['competition']; ?></p>
						  <p class="message">Photo uploading time: <?php echo $_SESSION['photouploadingtime']; ?></p>
						  <p class="message">Venue: <?php echo $_SESSION['venue']; ?></p>
						  <p class="message">Number: <?php echo $_SESSION['number']; ?></p>
						  <p class="message">Date of the competition: <?php echo $_SESSION['dateofthecompetition']; ?></p>
						  <div class="options">
							<a class="btn">Great</a>
							<p class="btn" onclick="popup('<?php echo 'a' . $_SESSION['i']; ?>');">Close</p>
						  </div>
					  </div>
				  </div>
			  </div>
			  <?php 
				  # select button
				  echo "
						<input type=\"checkbox\" id=\"cb{$_SESSION['i']}\" name=\"check_list[]\" value=\"{$_SESSION['photolink']}\" style=\"opacity: 0; position: absolute; left: -100vw;\">
						
						<label class=\"nbtn\" for=\"cb{$_SESSION['i']}\" id=\"b{$_SESSION['i']}\" onclick=\"color('b{$_SESSION['i']}');\">
						<span></span>
						<span></span>
						<span></span>
						<span></span>
						</label>";
				  if ($_SESSION['i'] == $_SESSION['rowcount'])
				  {
					  break;
				  }
			  ?>
			  
		  </div>
		  
		  <div class="column">
			  <?php 
			  
				$row = $_SESSION['query']->fetch(\PDO::FETCH_ASSOC);
				$_SESSION['i']++;
				$object_name = $row['photolink'];
				include 'uploads/php_sdk_download.php';
				$_SESSION['localfile'] = 'img_tmp/' . $_COOKIE['name'] . '/' . $object_name;
				$_SESSION['photolink'] = $row['photolink'];
				$_SESSION['photoname'] = $row['photoname'];
				$_SESSION['competition'] = $row['competition'];
				$_SESSION['photouploadingtime'] = $row['photouploadingtime'];
				$_SESSION['venue'] = $row['venue'];
				$_SESSION['number'] = $row['number'];
				$_SESSION['dateofthecompetition'] = $row['dateofthecompetition'];
			  ?>
			  <img type="image" src=<?php echo $_SESSION['localfile']; ?> onclick="popup('<?php echo 'a' . $_SESSION['i']; ?>');">
			  
			  <div class="modal" display="none !important" id="<?php echo 'a' . $_SESSION['i']; ?>">
				  <div class="options">
					  <img src=<?php echo $_SESSION['localfile']; ?>></img>
					  <div class="flex">
						  <p class="message">Photoname: <?php echo $_SESSION['photoname']; ?></p>
						  <p class="message">Competition: <?php echo $_SESSION['competition']; ?></p>
						  <p class="message">Photo uploading time: <?php echo $_SESSION['photouploadingtime']; ?></p>
						  <p class="message">Venue: <?php echo $_SESSION['venue']; ?></p>
						  <p class="message">Number: <?php echo $_SESSION['number']; ?></p>
						  <p class="message">Date of the competition: <?php echo $_SESSION['dateofthecompetition']; ?></p>
						  <div class="options">
							<a class="btn">Great</a>
							<p class="btn" onclick="popup('<?php echo 'a' . $_SESSION['i']; ?>');">Close</p>
						  </div>
					  </div>
				  </div>
			  </div>
			  <?php 
				  # select button
				  echo "
						<input type=\"checkbox\" id=\"cb{$_SESSION['i']}\" name=\"check_list[]\" value=\"{$_SESSION['photolink']}\" style=\"opacity: 0; position: absolute; left: -100vw;\">
						
						<label class=\"nbtn\" for=\"cb{$_SESSION['i']}\" id=\"b{$_SESSION['i']}\" onclick=\"color('b{$_SESSION['i']}');\">
						<span></span>
						<span></span>
						<span></span>
						<span></span>
						</label>";
				  if ($_SESSION['i'] == $_SESSION['rowcount'])
				  {
					  break;
				  }
			  ?>
			  
		  </div>
		  
		  <div class="column">
			  <?php 
			  
				$row = $_SESSION['query']->fetch(\PDO::FETCH_ASSOC);
				$_SESSION['i']++;
				$object_name = $row['photolink'];
				include 'uploads/php_sdk_download.php';
				$_SESSION['localfile'] = 'img_tmp/' . $_COOKIE['name'] . '/' . $object_name;
				$_SESSION['photolink'] = $row['photolink'];
				$_SESSION['photoname'] = $row['photoname'];
				$_SESSION['competition'] = $row['competition'];
				$_SESSION['photouploadingtime'] = $row['photouploadingtime'];
				$_SESSION['venue'] = $row['venue'];
				$_SESSION['number'] = $row['number'];
				$_SESSION['dateofthecompetition'] = $row['dateofthecompetition'];
			  ?>
			  <img type="image" src=<?php echo $_SESSION['localfile']; ?> onclick="popup('<?php echo 'a' . $_SESSION['i']; ?>');">
			  
			  <div class="modal" display="none !important" id="<?php echo 'a' . $_SESSION['i']; ?>">
				  <div class="options">
					  <img src=<?php echo $_SESSION['localfile']; ?>></img>
					  <div class="flex">
						  <p class="message">Photoname: <?php echo $_SESSION['photoname']; ?></p>
						  <p class="message">Competition: <?php echo $_SESSION['competition']; ?></p>
						  <p class="message">Photo uploading time: <?php echo $_SESSION['photouploadingtime']; ?></p>
						  <p class="message">Venue: <?php echo $_SESSION['venue']; ?></p>
						  <p class="message">Number: <?php echo $_SESSION['number']; ?></p>
						  <p class="message">Date of the competition: <?php echo $_SESSION['dateofthecompetition']; ?></p>
						  <div class="options">
							<a class="btn">Great</a>
							<p class="btn" onclick="popup('<?php echo 'a' . $_SESSION['i']; ?>');">Close</p>
						  </div>
					  </div>
				  </div>
			  </div>
			  <?php 
				  # select button
				  echo "
						<input type=\"checkbox\" id=\"cb{$_SESSION['i']}\" name=\"check_list[]\" value=\"{$_SESSION['photolink']}\" style=\"opacity: 0; position: absolute; left: -100vw;\">
						
						<label class=\"nbtn\" for=\"cb{$_SESSION['i']}\" id=\"b{$_SESSION['i']}\" onclick=\"color('b{$_SESSION['i']}');\">
						<span></span>
						<span></span>
						<span></span>
						<span></span>
						</label>";
				  if ($_SESSION['i'] == $_SESSION['rowcount'])
				  {
					  break;
				  }
			  ?>
			  
		  </div>
		  
		  <div class="column">
			  <?php 
			  
				$row = $_SESSION['query']->fetch(\PDO::FETCH_ASSOC);
				$_SESSION['i']++;
				$object_name = $row['photolink'];
				include 'uploads/php_sdk_download.php';
				$_SESSION['localfile'] = 'img_tmp/' . $_COOKIE['name'] . '/' . $object_name;
				$_SESSION['photolink'] = $row['photolink'];
				$_SESSION['photoname'] = $row['photoname'];
				$_SESSION['competition'] = $row['competition'];
				$_SESSION['photouploadingtime'] = $row['photouploadingtime'];
				$_SESSION['venue'] = $row['venue'];
				$_SESSION['number'] = $row['number'];
				$_SESSION['dateofthecompetition'] = $row['dateofthecompetition'];
			  ?>
			  <img type="image" src=<?php echo $_SESSION['localfile']; ?> onclick="popup('<?php echo 'a' . $_SESSION['i']; ?>');">
			  
			  <div class="modal" display="none !important" id="<?php echo 'a' . $_SESSION['i']; ?>">
				  <div class="options">
					  <img src=<?php echo $_SESSION['localfile']; ?>></img>
					  <div class="flex">
						  <p class="message">Photoname: <?php echo $_SESSION['photoname']; ?></p>
						  <p class="message">Competition: <?php echo $_SESSION['competition']; ?></p>
						  <p class="message">Photo uploading time: <?php echo $_SESSION['photouploadingtime']; ?></p>
						  <p class="message">Venue: <?php echo $_SESSION['venue']; ?></p>
						  <p class="message">Number: <?php echo $_SESSION['number']; ?></p>
						  <p class="message">Date of the competition: <?php echo $_SESSION['dateofthecompetition']; ?></p>
						  <div class="options">
							<a class="btn">Great</a>
							<p class="btn" onclick="popup('<?php echo 'a' . $_SESSION['i']; ?>');">Close</p>
						  </div>
					  </div>
				  </div>
			  </div>
			  <?php 
				  # select button
				  echo "
						<input type=\"checkbox\" id=\"cb{$_SESSION['i']}\" name=\"check_list[]\" value=\"{$_SESSION['photolink']}\" style=\"opacity: 0; position: absolute; left: -100vw;\">
						
						<label class=\"nbtn\" for=\"cb{$_SESSION['i']}\" id=\"b{$_SESSION['i']}\" onclick=\"color('b{$_SESSION['i']}');\">
						<span></span>
						<span></span>
						<span></span>
						<span></span>
						</label>";
				  if ($_SESSION['i'] == $_SESSION['rowcount'])
				  {
					  break;
				  }
			  ?>
			  
		  </div>
		<?php
			}
			unset($_SESSION['i']);
			unset($_SESSION['rowcount']);
			unset($_SESSION['query']);
			unset($_SESSION['localfile']);
			unset($_SESSION['photolink']);
			unset($_SESSION['photoname']);
			unset($_SESSION['competition']);
			unset($_SESSION['photouploadingtime']);
			unset($_SESSION['venue']);
			unset($_SESSION['number']);
			unset($_SESSION['dateofthecompetition']);
		}
		?>
		</div>

		</form>

		</body>

	</div>

	<footer id="sticky-footer" class="py-4 text-white-50 fixed-bottom">
		<div class="container text-center">
		  <small>Marathon-fyp</small>
		</div>
	  </footer>
	  
</div> 
  
</html>


