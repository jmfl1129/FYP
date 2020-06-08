<?php

# echo "hi";



## connecting to python script
# $data=  exec('python C:\xampp\htdocs\FYP\hi.py'); #change to corresponding link
#  echo $data;


function login($email, $password){

 include 'connect.php';
	
  // check if the email is wrong or not
  $q = 'SELECT * FROM users WHERE email = :email;';
  $query = $conn->prepare($q);
  $query->bindValue(':email', $email);
  $query->execute();
  if($query->rowCount() == 0){
	  $message = "This email is not validate. Please signup with it or check if the email is wrong";
	  echo "<script 
			type='text/javascript'>alert('$message'); 
			window.location= \"login.php\";
			 </script>";
  }
  
  else{
      $row = $query->fetch(\PDO::FETCH_ASSOC);
	  //decrypting the password
	  $len = strlen((string)$row['password']);
	  $copy_password = (string)$row['password'];
	  
	  for ($i = 0; $i < $len; ++$i)
		$password_verify .= $copy_password[$len - 1 - $i];
	  //done
	  
	  if(strcmp($password_verify, $password) != 0){
		  $message = "Login unsuccessfully";
		  echo "<script
				type='text/javascript'>alert('$message'); 
				window.location= \"login.php\";
				 </script>";
	  }
	  else{
			setcookie('logged', '', time() - 3600);
			setcookie('email', '', time() - 3600);
			setcookie('id', '', time() - 3600);
			setcookie('name', '', time() - 3600);
			setcookie('photographer', '', time() - 3600);
			setcookie('logged', 'true', time() + (86400 * 30), "/");
			setcookie('email', $email, time() + (86400 * 30) , "/");
			setcookie('id', $row['Id'], time() + (86400 * 30) , "/");
			setcookie('name', $row['name'], time() + (86400 * 30) , "/");
			setcookie('photographer', $row['photographer'], time() + (86400 * 30) , "/");
			echo "<script
			type='text/javascript'>
			window.location= \"index.php\";
			 </script>";
		  
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
  background: url('https://i.pinimg.com/originals/6d/75/b8/6d75b8e237134e8dca5ee4e412797bf6.gif') no-repeat center center fixed !important;
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
<h1></h1>
	

	<a href="index.php" class="text-info"> BACK </a>	
	
	<div class="container" align="center">
		

		<!-- form used to log in -->
	<form method="POST" action="login.php" class="form-signin">
	<br>
	  <div class=" col-sm-5">
	    <label for="inputEmail"></label>
	    <input type="email" class="form-control text-danger" name="email" placeholder="Email address" id="inputEmail">
	  </div>
	  <div class=" col-sm-5">
	    <label for="inputPassword"></label>
	    <input type="password" class="form-control text-danger" name="password" placeholder="Password" id="inputPassword">
	  </div>
	  <br>
	  <br>
	  <button type="submit" name= "login" class="btn btn-lg btn-block text-uppercase col-sm-5 text-muted" >Submit</button>
	  <br>
	  <a class="btn btn-lg btn-block text-uppercase col-sm-5 text-muted" href = "sscreateaccount.php">Sign up</a>
	  <br>
	  <a class="btn btn-lg btn-block text-uppercase col-sm-5 text-muted" href = "Forgetpassword.php">forget password</a>
	  <br>
	  <button class="btn btn-lg btn-google btn-block text-uppercase col-sm-5 text-muted" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button>
	  <br>
      <button class="btn btn-lg btn-facebook btn-block text-uppercase col-sm-5 text-muted" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button>
             
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