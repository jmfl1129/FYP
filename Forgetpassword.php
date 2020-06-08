<?php
function SendForgetPasswordEmail($email){
	
include 'connect.php';
	
  // check if the email have been used to register an account
  $q = 'SELECT * FROM users WHERE email = :email;';
  $query = $conn->prepare($q);
  $query->bindValue(':email', $email);
  $query->execute();
  if($query->rowCount() != 0){
	  $row = $query->fetch(\PDO::FETCH_ASSOC);
	  
	  //decrypting the password
	  $len = strlen((string)$row['password']);
	  $copy_password = (string)$row['password'];
	  
	  for ($i = 0; $i < $len; ++$i)
		$password .= $copy_password[$len - 1 - $i];
	  //done
	  
	  //sending the email
	  include 'mail/mail.php';
	  
	  $message = "email is sent, then, first back to index";
	  echo "<script
				type='text/javascript'>alert('$message'); 
				window.location= \"index.php\";
				 </script>";
  }
  else{
	  
	  $message = "Wrong email";
	  echo "<script
				type='text/javascript'>alert('$message'); 
				window.location= \"Forgetpassword.php\";
				 </script>";
	  
  }
  
}
  
session_start();
if (isset($_POST['Submitemail'])){
    SendForgetPasswordEmail(htmlspecialchars($_POST['email']));
}
?>

<style>

body {
  background: url('https://66.media.tumblr.com/9d763744c2ad6c37ada7ea969f5e0f2b/tumblr_mznzkzwnwe1sicas5o1_1280.gifv') no-repeat center center fixed !important;
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
	

	<a href="index.php" class="text-info"> BACK </a>	
	
	<div class="container" align="center">
		

		<!-- form used to log in -->
	<form method="POST" action="Forgetpassword.php" class="form-signin">
	<br>
	  <div class=" col-sm-5">
	    <label for="inputEmail"></label>
	    <input type="email" class="form-control text-danger" name="email" aria-describedby="emailHelp" placeholder="Email address">
	  </div>
	  <br>
	  <br>
	  <button type="submit" name= "Submitemail" class="btn btn-lg btn-block text-uppercase col-sm-5 text-muted" >Submit</button>
             
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