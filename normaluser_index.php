<?php
if (!isset($_COOKIE['id'])){
	echo "<script
			type='text/javascript'>
				window.location= \"error.php\";
				 </script>";
	
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


</head>

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

</body>

</div>

	<footer id="sticky-footer" class="py-4 text-white-50 fixed-bottom">
		<div class="container text-center">
		  <small>Marathon-fyp</small>
		</div>
	  </footer>
  
</html>


