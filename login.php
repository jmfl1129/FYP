<?php
function login($email, $password){
	
include 'connect.php';
	
  // check if the email is wrong or not
  $q = 'SELECT FROM users WHERE email = :name;';
  $query = $conn->prepare($q);
  $query->bindValue(':name', $email);
  $query->execute();
  if($query->rowCount() == 0){
	  $message = "This email is not validate. Please signup with it or check if the email is wrong";
	  echo "<script window.location.reload();\n
			type='text/javascript'>alert('$message'); 
			 </script>";
  }
  
  else{
  
	  // check for login successful or not
	  $q = 'SELECT * FROM users WHERE email = :name AND password = :password;';
	  $query = $conn->prepare($q);
	  $query->bindValue(':name', $email);
	  $query->bindValue(':password', $password);
	  $query->execute();
	  if($query->rowCount() == 0){
		  $message = "Login unsuccessfully";
		  echo "<script window.location.reload();\n
				type='text/javascript'>alert('$message'); 
				 </script>";
	  }
	  else{
		if($row = $query->fetch(\PDO::FETCH_ASSOC)){
			setcookie('logged', '', time() - 3600);
			setcookie('email', '', time() - 3600);
			setcookie('id', '', time() - 3600);
			setcookie('name', '', time() - 3600);
			setcookie('organizer', '', time() - 3600);
			setcookie('logged', 'true', time() + (86400 * 30), "/");
			setcookie('email', $email, time() + (86400 * 30) , "/");
			setcookie('id', $row['id'], time() + (86400 * 30) , "/");
			setcookie('name', $row['name'], time() + (86400 * 30) , "/");
			setcookie('organizer', $row['organizer'], time() + (86400 * 30) , "/");
			header('Location: index.php'); 
		}
		  
	  }
  
  }
}

session_start();
if (isset($_POST['login'])){
    login(htmlspecialchars($_POST['email']), htmlspecialchars($_POST['password']));
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

	<link rel="stylesheet" href="css/css_in_most_pages.css">
	<link rel="stylesheet" href="css/css_login.css">

	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</head>
<meta charset="utf-8"/>
<body>
	

	<div class="container" align="center">
		

		<!-- form used to log in -->
	<form method="POST" action="login.php" class="form-signin">
	<br>
	  <div class=" col-sm-5">
	    <label for="inputEmail"></label>
	    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Email address">
	  </div>
	  <div class=" col-sm-5">
	    <label for="inputPassword"></label>
	    <input type="password" class="form-control" name="password" placeholder="Password">
	  </div>
	  <br>
	  <br>
	  <button type="submit" name= "login" class="btn btn-lg btn-block text-uppercase col-sm-5" >Submit</button>
	  <br>
	  <a class="btn btn-lg btn-block text-uppercase col-sm-5" href = "sscreateaccount.php">Sign up</a>
	  <br>
	  <button class="btn btn-lg btn-google btn-block text-uppercase col-sm-5" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button>
	  <br>
      <button class="btn btn-lg btn-facebook btn-block text-uppercase col-sm-5" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button>
             
	</form>
	<!-- END of form used to log in -->
	
</div>
	
	<footer id="sticky-footer" class="py-4 text-white-50 fixed-bottom">
    <div class="container text-center">
      <small>Marathon-fyp</small>
    </div>
  </footer>
  
    

    	



	

</body>
</html>