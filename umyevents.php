<?php
session_start();
include 'connect.php';
	
	$qt = "SELECT * FROM groups where mid = :id;";
	$queryt = $conn->prepare($qt);
	$queryt->bindValue(':id', $_COOKIE['id']);
	$result7 = $queryt-> execute();
	
	if($result7){
		
		$rowt = $queryt->fetch(\PDO::FETCH_ASSOC);
		setcookie('memberlist', '', time() - 3600);
		setcookie('memberlist', $rowt['memberlist'], time() + (86400 * 30) , "/");
		
	}
	
	$q = "SELECT * FROM events;";
	$query = $conn->prepare($q);
	$query->bindValue(':name', $_COOKIE['memberlist']);
	$query->execute();
	
	

include 'getContent.php';
include 'pages.php';

		  
	
?>




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
<body>

	<!-- navigation bar on top -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
		<div class="container">
    <a class="navbar-brand" href="index.php">Marathon-fyp</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home
                <span class="sr-only">(current)</span>
              </a>
        </li>
		<li class="nav-item">
		  <a class="nav-link" href="umyevents.php"> <?php echo $_COOKIE['name']; ?> </a>
		</li>
		<li class="nav-item">
		  <a class="nav-link" href="uoptions.php"> Options</a>
		</li>
		<li class="nav-item">
		  <a class="nav-link" href="logout.php">Log out</a>
		</li>
		<form method="POST" action="umyevents.php">
		<li class="nav-item">
			<div class="active-pink-3 active-pink-4">
			  <input class="form-control" type="text" placeholder="Search" name="Search" aria-label="Search">
			</div>
		</li>
	    </form>
      </ul>
    </div>
  </div>
	</nav>
	<br>
	<br>
	<!-- END OF navigation bar on top -->
		
			<!-- Page Content -->
<div class="container">

  <!-- Page Heading -->
  <h1 class="my-4">Marathon-fyp: u logged in :)
  <br>
    <small>listed in pages( check it out now! )</small>
  </h1>

</div>

	<div class="container">
	  <div class="card border-0 shadow my-5">
		<div class="card-body p-5">
		  <h1 class="font-weight-light">Choose what you want</h1>
		  
		  
		<div class="card-deck">
            <div class="row justify-content-md-center">
                <div> <h1>row 1</h1>  </div>
		  
		<?php 
			for ($i = 0; $i < ($_SESSION['page'] - 1) * 6; $i++){
				$row = $query->fetch(\PDO::FETCH_ASSOC);
			}
			
			$j = 0;
			
			while(($row = $query->fetch(\PDO::FETCH_ASSOC)) && $j < 3){
				if(isset($_POST['Search'])){
					if($row['ename'] == $_POST['Search']) {
				
			
		?>
		
                
                <div class="col-3 d-flex align-items-stretch">
                  <div class="card h-200">
                    <img class='card-img-top' src= <?php echo "'". $row['photolink'] . "'"; ?> alt="Image not found ">
                    <div class="card-body">
                        <div class="col text-center">
                            <h5 class="card-title"><?php echo $row['ename']; ?>
							<?php if($row['type'] != 'public') { ?>
							<a class="badge badge-info"><?php echo $row['type']; ?></a> <?php } ?> </h5>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $row['id']; ?>">
							  Details
							</button>

						</div>
                    </div>
				  </div>
                </div>
				
				<!-- Modal -->
				<div class="modal" id="exampleModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Event details</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">×</span>
						</button>
					  </div>
					  <div class="modal-body">
						
								<?php echo '<h4>'.$row['ename'].'</h4>';
									  echo '<p> abstract: '.$row['abstract'].'</p>';
									  echo '<img src= \''. $row['photolink'].'\'>';
									  echo '<p> type: '.$row['type'].'</p>';
									  echo '<p> venue: '.$row['venue'].'</p>';
									  echo '<p> time: '.$row['time'].'</p>';
									  echo '<p> vacancies: '.$row['vacancies'].'</p>';
									  echo '<p> duration: '.$row['duration'].'</p>';
									  echo '<p> date: '.$row['date'].'</p>';
								?>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Go back</button>
						<a type="button" class="btn btn-primary" href="takeaphoto_dude.php">Join</a>
					  </div>
					</div>
				  </div>
				</div>
				
					<?php 	
					
					break;
					}
				}
				
				else { ?>
					
                
                <div class="col-3 d-flex align-items-stretch">
                  <div class="card h-200">
                    <img class='card-img-top' src= <?php echo "'". $row['photolink'] . "'"; ?> alt="Image not found ">
                    <div class="card-body">
                        <div class="col text-center">
                            <h5 class="card-title"><?php echo $row['ename']; ?>
							<?php if($row['type'] != 'public') { ?>
							<a class="badge badge-info"><?php echo $row['type']; ?></a> <?php } ?> </h5>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $row['id']; ?>">
							  Details
							</button>

						</div>
                    </div>
				  </div>
                </div>
				
				<!-- Modal -->
				<div class="modal" id="exampleModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Event details</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">×</span>
						</button>
					  </div>
					  <div class="modal-body">
						
								<?php echo '<h4>'.$row['ename'].'</h4>';
									  echo '<p> abstract: '.$row['abstract'].'</p>';
									  echo '<img src= \''. $row['photolink'].'\'>';
									  echo '<p> type: '.$row['type'].'</p>';
									  echo '<p> venue: '.$row['venue'].'</p>';
									  echo '<p> time: '.$row['time'].'</p>';
									  echo '<p> vacancies: '.$row['vacancies'].'</p>';
									  echo '<p> duration: '.$row['duration'].'</p>';
									  echo '<p> date: '.$row['date'].'</p>';
								?>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Go back</button>
						<a type="button" class="btn btn-primary" href="takeaphoto_dude.php">Join</a>
					  </div>
					</div>
				  </div>
				</div>
			<?php
				
				
			
			$j++;
			
				}
			}
			
			?>
			
            </div>
            <br>    
            
            <!-- second row of events at a different t ime -->
            <div class="row justify-content-md-center">
                <div> <h1>row 2</h1>  </div>
				
				<?php if($row && !(isset($_POST['Search']))) { ?>
				<div class="col-3 d-flex align-items-stretch">
                  <div class="card h-200">
                    <img class="card-img-top" src= <?php echo  "'". $row['photolink'] . "'"; ?> alt="Image not found ">
                    <div class="card-body">
                        <div class="col text-center">
                            <h5 class="card-title"><?php echo $row['ename']; ?>
							<?php if($row['type'] != 'public') { ?>
							<a class="badge badge-info"><?php echo $row['type']; ?></a> <?php } ?></h5>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $row['id']; ?>">
							  Details
							</button>

						</div>
                    </div>
				  </div>
                </div>
				
				<!-- Modal -->
				<div class="modal" id="exampleModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Event details</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">×</span>
						</button>
					  </div>
					  <div class="modal-body">
						
								<?php echo '<h4>'.$row['ename'].'</h4>';
									  echo '<p> abstract: '.$row['abstract'].'</p>';
									  echo '<img src= \''. $row['photolink'].'\'>';
									  echo '<p> type: '.$row['type'].'</p>';
									  echo '<p> venue: '.$row['venue'].'</p>';
									  echo '<p> time: '.$row['time'].'</p>';
									  echo '<p> vacancies: '.$row['vacancies'].'</p>';
									  echo '<p> duration: '.$row['duration'].'</p>';
									  echo '<p> date: '.$row['date'].'</p>';
								?>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Go back</button>
						<a type="button" class="btn btn-primary" href="takeaphoto_dude.php">Join</a>
					  </div>
					</div>
				  </div>
				</div>
                
				<?php } ?>
				
				<?php 
			
			while(($row = $query->fetch(\PDO::FETCH_ASSOC)) && $j < 5){
				if(isset($_POST['Search'])){
					if($row['ename'] == $_POST['Search']) {
				
			
		?>
		
                
                <div class="col-3 d-flex align-items-stretch">
                  <div class="card h-200">
                    <img class='card-img-top' src= <?php echo "'". $row['photolink'] . "'"; ?> alt="Image not found ">
                    <div class="card-body">
                        <div class="col text-center">
                            <h5 class="card-title"><?php echo $row['ename']; ?>
							<?php if($row['type'] != 'public') { ?>
							<a class="badge badge-info"><?php echo $row['type']; ?></a> <?php } ?> </h5>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $row['id']; ?>">
							  Details
							</button>

						</div>
                    </div>
				  </div>
                </div>
				
				<!-- Modal -->
				<div class="modal" id="exampleModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Event details</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">×</span>
						</button>
					  </div>
					  <div class="modal-body">
						
								<?php echo '<h4>'.$row['ename'].'</h4>';
									  echo '<p> abstract: '.$row['abstract'].'</p>';
									  echo '<img src= \''. $row['photolink'].'\'>';
									  echo '<p> type: '.$row['type'].'</p>';
									  echo '<p> venue: '.$row['venue'].'</p>';
									  echo '<p> time: '.$row['time'].'</p>';
									  echo '<p> vacancies: '.$row['vacancies'].'</p>';
									  echo '<p> duration: '.$row['duration'].'</p>';
									  echo '<p> date: '.$row['date'].'</p>';
								?>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Go back</button>
						<a type="button" class="btn btn-primary" href="takeaphoto_dude.php">Join</a>
					  </div>
					</div>
				  </div>
				</div>
				
					<?php 	
					
					break;
					}
				}
				
				else { ?>
					
                
                <div class="col-3 d-flex align-items-stretch">
                  <div class="card h-200">
                    <img class='card-img-top' src= <?php echo "'". $row['photolink'] . "'"; ?> alt="Image not found ">
                    <div class="card-body">
                        <div class="col text-center">
                            <h5 class="card-title"><?php echo $row['ename']; ?>
							<?php if($row['type'] != 'public') { ?>
							<a class="badge badge-info"><?php echo $row['type']; ?></a> <?php } ?> </h5>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $row['id']; ?>">
							  Details
							</button>

						</div>
                    </div>
				  </div>
                </div>
				
				<!-- Modal -->
				<div class="modal" id="exampleModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Event details</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">×</span>
						</button>
					  </div>
					  <div class="modal-body">
						
								<?php echo '<h4>'.$row['ename'].'</h4>';
									  echo '<p> abstract: '.$row['abstract'].'</p>';
									  echo '<img src= \''. $row['photolink'].'\'>';
									  echo '<p> type: '.$row['type'].'</p>';
									  echo '<p> venue: '.$row['venue'].'</p>';
									  echo '<p> time: '.$row['time'].'</p>';
									  echo '<p> vacancies: '.$row['vacancies'].'</p>';
									  echo '<p> duration: '.$row['duration'].'</p>';
									  echo '<p> date: '.$row['date'].'</p>';
								?>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Go back</button>
						<a type="button" class="btn btn-primary" href="takeaphoto_dude.php">Join</a>
					  </div>
					</div>
				  </div>
				</div>
			<?php
				
				
			
			$j++;
			
				}
			}

			?>
			
            </div>
            
        </div>

		

	</div>

  <!-- Pagination -->
  <form method="POST" action="umyevents.php">
  
	  <ul class="pagination justify-content-center">
		<li class="page-item">
		  <button class="page-link" aria-label="Previous" name="Previous">
				<span aria-hidden="true">&laquo;</span>
				<span class="sr-only">Previous</span>
			  </button>
		</li>
		<li class="page-item">
		  <button class="page-link" name="1">1</button>
		</li>
		<li class="page-item">
		  <button class="page-link" name="2">2</button>
		</li>
		<li class="page-item">
		  <button class="page-link" name="3">3</button>
		</li>
		<li class="page-item">
		  <button class="page-link" name="Next" aria-label="Next">
				<span aria-hidden="true">&raquo;</span>
				<span class="sr-only">Next</span>
			  </button>
		</li>
	  </ul>
  
  </form>
		

<!-- /.container -->
  <footer id="sticky-footer" class="py-4 bg-light text-dark-50">
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