<?php
ini_set('display_errors', 1);
session_start();
	$db = parse_url(getenv("DATABASE_URL"));
  $conn = new PDO("pgsql:". sprintf(
    "host=%s;port=%s;user=%s;password=%s;dbname=%s",
    $db["host"],
    $db["port"],
    $db["user"],
    $db["pass"],
    ltrim($db["path"], "/")
    ));
	

if(isset($_COOKIE['id'])){
	
	$qt = 'SELECT * FROM users WHERE id = :name;';
	$queryt = $conn->prepare($qt);
	$queryt->bindValue(':name', $_COOKIE['id']);
	$queryt->execute();
		  
	if($rowt = $queryt->fetch(\PDO::FETCH_ASSOC)){
		setcookie('name', '', time() - 3600);
		setcookie('organizer', '', time() - 3600);
		setcookie('name', $rowt['name'], time() + (86400 * 30) , "/");
		setcookie('organizer', $rowt['organizer'], time() + (86400 * 30) , "/");
	}
}


	
	$q = "SELECT * FROM events WHERE type = 'public';";
	$query = $conn->prepare($q);
	$query->execute();
	
	

include 'pages.php';
?>


<style>

.hovereffect:hover {
  background: url('https://cdn.wallpapersafari.com/34/78/1fnjO5.png') no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  background-size: cover;
  -o-background-size: cover;
}

.hovereffect a.info {
  display: inline-block;
  text-decoration: none;
  padding: 70px 140px;
  text-transform: uppercase;
  color: #fff;
  border: 2px solid #fff;
  background-color: transparent;
  opacity: 0;
  filter: alpha(opacity=0);
  -webkit-transform: scale(0);
  -ms-transform: scale(0);
  transform: scale(0);
  -webkit-transition: all 0.4s cubic-bezier(0.88,-0.99, 0, 1.81);
  transition: all 0.4s cubic-bezier(0.88,-0.99, 0, 1.81);
  font-weight: normal;
  position: fixed;
  top: 50%;
  left: 39%;
}

.hovereffect:hover a.info {
  opacity: 1;
  -webkit-transform: scale(1);
  -ms-transform: scale(1);
  transform: scale(1);
}

.hovereffect a.info:hover {
  box-shadow: 0 0 5px #fff;
}
/* reference: https://miketricking.github.io/bootstrap-image-hover/ hover effect 4v2*/
</style>

<!DOCTYPE html>
<html lang="en">
<head> 

	<title>Marathon-fyp</title> 
	
	<link rel="stylesheet" href="css/css_in_most_pages.css">

	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>



</head>
<meta charset="utf-8"/>
<body class="hovereffect">

			<!-- Page Content -->
			
	<div>
	<?php if(isset($_COOKIE['name'])) {
		echo '<h4> Welcome '.$_COOKIE['name'].'.</h4>';
	} ?>
        <div class="overlay">
           
		   <?php if(isset($_COOKIE['organizer'])){
			    ?> <a class="info" href="upload.php"> UPLOAD</a>
		   <?php }elseif(isset($_COOKIE['name'])){
			    ?> <a class="info" href="search.php"> SEARCH</a>
		   <?php } else {
				?> <a class="info" href="login.php"> LOG IN</a>
		   <?php } ?>
        </div>
    </div>
			
			
<!-- /.container -->
  <footer id="sticky-footer" class="py-4 text-white-50 fixed-bottom">
    <div class="container text-center">
      <small>Marathon-fyp</small>
    </div>
  </footer>


</div>
</div>

<!-- reference startbootstrap.com/snippets/full-image-background/
	 startbootstrap.com/snippets/portfolio-four-column/https://www.codexworld.com/bootstrap-modal-dynamic-content-jquery-ajax-php-mysql/
	 https://mdbootstrap.com/docs/jquery/forms/search/
-->



</body>

<script type="text/javascript">

</script>

</html>