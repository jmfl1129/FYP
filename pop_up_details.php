 <?php
 
 include 'connect.php';
	
  // check if the email is wrong or not
  $q = 'SELECT * FROM photos WHERE number = :number;';
  $query = $conn->prepare($q);
  $query->bindValue(':number', $text);
  $query->execute();
  
  
  
?>


	  <div class="modal">
		  <p class="message">Look at this fancy pop-up</p>
		  <div class="options">
			<button class="btn">Yes</button>
			<button class="btn">No</button>
		  </div>
	  </div>