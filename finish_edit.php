<?php
if (!isset($_COOKIE['id'])){
	echo "<script
			type='text/javascript'>
				window.location= \"error.php\";
				 </script>";
	
}

session_start();

for ($x = 1; $x <= $_SESSION['rowcount']; $x++) {

	if(isset($_POST['edit' . $x])){
		
	 include 'connect.php';
		
		
	  $q = 'UPDATE photos SET photoname=:photoname, competition=:competition, photouploadingtime=:photouploadingtime, venue=:venue, number=:number, dateofthecompetition=:dateofthecompetition WHERE photolink = :photolink;';
	  $query = $conn->prepare($q);
	  $query->bindValue(':photoname', $_POST['photoname' . $x]);
	  $query->bindValue(':competition', $_POST['competition' . $x]);
	  $query->bindValue(':photouploadingtime', $_POST['photouploadingtime' . $x]);
	  $query->bindValue(':venue', $_POST['venue' . $x]);
	  $query->bindValue(':number', $_POST['number' . $x]);
	  $query->bindValue(':dateofthecompetition', $_POST['dateofthecompetition' . $x]);
	  $query->bindValue(':photolink', $_POST['edit' . $x]);
	  $query->execute();
	  
	  
		echo "<script
				type='text/javascript'>alert('finish_editing');
				window.location= \"edit.php\";
				
			  </script>";
	}
}
echo "<script
		type='text/javascript'>
		window.location= \"edit.php\";
		
	  </script>";
?>