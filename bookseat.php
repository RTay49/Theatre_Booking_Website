<html>
	<head>
		<title>Cheese Theater</title>
		<script type =“text/javascript”>…</script>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div id="heading">

			<h1>Cheese Theater</h1>
			<div id="menu">
				<a href="home.php">Home</a>
				<a href="Bookproduction.php">Booking</a>
			</div>
		</div>
		<div id="booking">
		<p style = "text-decoration: underline;">Production</p>
		<?php
		//allows a session array to save inputs between pages.
		//inspired by stackoverflow.
		session_start();
		//shows the a previous user input.
		$showproduction = $_SESSION['selectedproduction'];
		
		echo "<p>".$showproduction."</p>";
		
		?>
	<p style = "text-decoration: underline;"> Date</p>
	<?php
		//shows the a previous user input.
		$showdate = $_SESSION['selecteddate'];
		
		echo "<p>".$showdate."</p>";
		?>
	<p style = "text-decoration: underline;"> Time</p>
	<?php
		//shows the a previous user input.
		$showtime = $_SESSION['selectedtime'];
		//changes the time into a better display format 
		$timedisplay = substr($showtime,0,5);
		echo "<p>".$timedisplay."</p>";
		?>
	<p style = "text-decoration: underline;"> Zone</p>
	<?php
		//checks and initalises the variable.
		//webpage returns an error if this is not used.
		//inspired by stackoverflow.
		if (isset($_GET['zone'])){
			
		$zone =	$_GET['zone'] ;
		
		echo "<p>".$zone."</p>";
		}
			//saves the variable to the session array.
		$_SESSION['selectedzone'] = $zone;
		?>
	
	<form action="nameandemail.php" method="GET">
	<p>Seat</p>
		<!--creates a dropdown menu for user input-->
		<select name="seat">
		
		<?php
		//creates an array for all the seats from the seats table
		$allSeats = array();
		
		require ("connect.php");
		$conn=connect();
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "select RowNumber from Seat where Zone = '$zone' ";
		$handle = $conn->prepare($sql);
		$handle->execute();
		$conn = null;
		$res = $handle->fetchAll();
	
		foreach($res as $row) {
	
		 //populates the array with all seats	
		 array_push($allSeats,$row['RowNumber']);
		 
		}
		//creates an array for all the taken seats from the booking table
		$takenSeats= array();
		
		$conn=connect();
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "select RowNumber from Booking where PerfDate = '$showdate' AND PerfTime = '$showtime' ";
		$handle = $conn->prepare($sql);
		$handle->execute();
		$conn = null;
		$res = $handle->fetchAll();
	
		foreach($res as $row) {
	
		 	//populates the array with all the taken seats
		 	array_push($takenSeats,$row['RowNumber']);
		 
		}
		//finds all availble seats by comparing the two arrays and outputting the diffrence.
		$freeSeats = array_diff($allSeats, $takenSeats);
		
		?>
	
		<?php	
		foreach($freeSeats as $seats){
			echo '<option value="'.$seats.'">' .$seats.  '</option>';
		
		
		}
	
   
		
			?>
			<input type="submit" name="submit" value="Submit">
	</form>
	</div>
			</body>
</html>
