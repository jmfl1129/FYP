<?php

function Signup($name, $email, $password, $photographer){
	
include 'connect.php';
	
  //check if username, email, password, photographer boxes were blanked
  if($name == NULL || $email == NULL || $password == NULL || $photographer == NULL)
  {
	  $result4 = "Ooshes";
	  $message = "Cannot leave any box blanked";
	  echo "<script
	         type='text/javascript'>alert('$message');
			 window.location= \"sscreateaccount.php\";
			 </script>";
  }
  
  // check if the username has been used
  $q = 'SELECT * FROM users WHERE name = :name;';
  $query = $conn->prepare($q);
  $query->bindValue(':name', $name);
  $query->execute();
  if(($result1 = $query->rowCount()) > 0){
	  $message = "The username has been chosen, please select a new one";
	  echo "<script
	         type='text/javascript'>alert('$message');
			 window.location= \"sscreateaccount.php\";
			 </script>";
  }
  
  // check if the email has been used for registration
  $q = 'SELECT * FROM users WHERE email = :email;';
  $query = $conn->prepare($q);
  $query->bindValue(':email', $email);
  $query->execute();
  if(($result2 = $query->rowCount()) > 0){
	  $message = "The email has already been used";
	  echo "<script
			type='text/javascript'>alert('$message'); 
			window.location= \"sscreateaccount.php\";
			 </script>";
  }
	
  // check if the photographer attribute is only Yes or No
  if(strcasecmp($photographer, "Yes") == 0 || strcasecmp($photographer, "No") == 0)
  {
	  
  }
  else
  {
	  $result3 = "Ooshes";
	  $message = "The photographer box can only accept answer \"Yes\" or \"No\"";
	  echo "<script
			type='text/javascript'>alert('$message'); 
			window.location= \"sscreateaccount.php\";
			 </script>";
  }
  
  if(!$result1 && !$result2 && !$result3 && !$result4){
	  if(strcasecmp($photographer, "No") == 0)
	  {
		  $q = "INSERT INTO users (name, password, email) VALUES (:name, :password, :email);";
		  
		  // encrypting the password
		  $len = strlen($password);
		  $copy_password = $password;
		  
		  for ($i = 0; $i < $len; $i++)
			$password[$i] = $copy_password[$len - 1 - $i];
		  //done
		  
		  $sql = $conn->prepare($q);
		  $sql->bindValue(':name', $name);
		  $sql->bindValue(':password', $password);
		  $sql->bindValue(':email', $email);
	  }
	  else 
	  {
		  $q = "INSERT INTO users (name, password, photographer, email) VALUES (:name, :password, :photographer, :email);";
		  
		  // encrypting the password
		  $len = strlen($password);
		  $copy_password = $password;
		  
		  for ($i = 0; $i < $len; $i++)
			$password[$i] = $copy_password[$len - 1 - $i];
		  //done
		  
		  $sql = $conn->prepare($q);
		  $sql->bindValue(':name', $name);
		  $sql->bindValue(':password', $password);
		  $sql->bindValue(':photographer', $photographer);
		  $sql->bindValue(':email', $email);
	  }
	  $result = $sql->execute();
	  if(!$result){
		$message = "Internal error";
		echo "<script
			type='text/javascript'>alert('$message'); 
			window.location= \"sscreateaccount.php\";
			 </script>";
	  }
	  if($result){
		setcookie('logged', '', time() - 3600);
		setcookie('email', '', time() - 3600);
		setcookie('id', '', time() - 3600);
		setcookie('logged', 'true', time() + (86400 * 30), "/");
		setcookie('email', $email, time() + (86400 * 30) , "/");
		setcookie('id', $conn->lastInsertId(), time() + (86400 * 30) , "/");
		echo "<script
			type='text/javascript'>
			window.location= \"index.php\";
			 </script>";
	  }
  
  }
}

session_start();
if (isset($_POST['Signup'])){
    Signup(htmlspecialchars($_POST['Name']), htmlspecialchars($_POST['Email']),htmlspecialchars($_POST['Password']), htmlspecialchars($_POST['Photographer']));
}

?>

<style>

body {
  background: url('https://cdna.artstation.com/p/assets/images/images/014/004/696/original/ira-geneve-darksouls-animated-wallpaper.gif?1542049339') no-repeat center center fixed !important;
  -webkit-background-size: cover !important;
  -moz-background-size: cover!important;
  background-size: cover !important;
  -o-background-size: cover !important;
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

	<link rel="stylesheet" href="css/css_in_most_pages.css">
	<link rel="stylesheet" href="css/css_login.css">

</head>
<meta charset="utf-8"/>
<body>
	
	
  <!-- Page Heading -->
	<div class="container" align="center">
		

		<!-- form used to log in -->
	<form method="POST" action="sscreateaccount.php" class="form-signin">
	<h5 class="text-dark"> Please enter the following info to Create your account </h5>
	<br>
	  <div class="form-group">
	    <input type="text" class="form-control" id="inputName" name="Name" placeholder="Username">
		<label for="inputName"></label>
	  </div>
	  <div class="form-group">
	    <input type="email" class="form-control" id="inputEmail" name="Email"    placeholder="Email address">
		<label for="inputEmail"></label>
	  </div>
	  <div class="form-group">
	    <input type="password" class="form-control" id="inputPassword" name="Password" placeholder="Password">
	    <label for="inputPassword"></label>
	  </div>
	  <div class="form-group">
	    <input type="text" class="form-control" id="inputPhotographer" name="Photographer" placeholder="Photographer? Please input &quot;Yes&quot; or &quot;No&quot;">
	    <label for="inputPhotographer"></label>
	  </div>
	  <br>
	  <a href="index.php" type="submit" name="Back to index" class="text-dark btn btn-lg btn-block text-uppercase">Back to index</a>
	  <br>
	  <button type="submit" name="Signup" class="text-dark btn btn-lg btn-block text-uppercase">Sign up</button>
	  <br>
	  <button class="text-dark btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign up with Google</button>
	  <br>
      <button class="text-dark btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign up with Facebook</button>
             
	</form>
	<!-- END of form used to log in --></p>
</div>
    
<footer id="sticky-footer" class="py-4 text-white-50 fixed-bottom">
    <div class="container text-center">
      <small>Marathon-fyp</small>
    </div>
  </footer>


	

</body>
</html>