<html>
	<head>
		<title>Cheese Theater</title>
		<link rel="stylesheet" type="text/css" href="Style.css">
		
	</head>
	<body>
		<div id="heading">

			<h1>Cheese Theater</h1>
			<div id="menu">
				<a href="home.php">Home</a>
				<a href="Bookproduction.php">Booking</a>
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
		//shows the a previous user input.
		$showzone = $_SESSION['selectedzone'];
		
		echo "<p>".$showzone."</p>";
	?>
	<p style = "text-decoration: underline;"> Seat</p>
	<?php
		//shows the a previous user input.
		$showseat = $_SESSION['selectedseat'];
		
		echo "<p>".$showseat."</p>";
	?>
	<p style = "text-decoration: underline;"> Name</p>
		<?php
		//shows the a previous user input.
		$showname = $_SESSION['selectedname'];
		
		echo "<p>".$showname."</p>";
		?>
		<p style = "text-decoration: underline;"> Email</p>
		<?php
		//shows the a previous user input.
		$showemail = $_SESSION['selectedemail'];
		
		echo "<p>".$showemail."</p>";
		?>
		<p style = "text-decoration: underline;">Price</p>
		<?php
		//shows the a previous user input.
		$showprice = $_SESSION['selectedprice'];
		
		?>
		<p> &pound; <?php echo $showprice;?> </p><br>
		
		<p style = "text-decoration: underline;">Booking ID</p>
		
		<?php
		//Generates an Id and checks if its unique.
		//makes an array for all exisiting Ids
		$checkId = array();
		require ("connect.php");
		$conn=connect();
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "select BookingId from Booking";
		$handle = $conn->prepare($sql);
		$handle->execute();
		$conn = null;
		$res = $handle->fetchAll();
	
		foreach($res as $row) {
	
		 	//populates the array
		 	array_push($checkId,$row['BookingId']);
		}
		//creats an Id based on name and production and adds a id number to it
		$idNumber = 0;
		$attemptId = substr($showname,0,4).substr($showproduction,0,4).$idNumber;
		
		$checkIdlength = count($checkId);
		
		$clean = false;
		$match = false;
		
	
		//a loop is created to check if the Id is unique and alter it if needed.
		while($clean == false){
			//checks the array for matches
				for($x = 0; $x < $checkIdlength; $x++){
				$checking = $checkId[$x];
				if($checking == $attemptId){
				$match = true;
				}
				}
			//if a match is found the Id number is increased attempting to make the id unique.
			//the new id is then checked again and the Id number will be increased as many times as nessary.
			if ($match==true){
			$idNumber++;
			$attemptId = substr($showname,0,4).substr($showproduction,0,4).$idNumber;
			$match = false;
			}
			else{
				//if no matches are found the loop can close. 
				$clean = true;
				}
		}
		$bookingId = $attemptId;
		echo "<p>".$bookingId."</p>";
		try {
		//inserts the order to the database
		$conn=connect();
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "insert into Booking values('$bookingId', '$showdate', '$showtime', '$showname', '$showemail', '$showseat')";
		$handle = $conn->prepare($sql);
		$handle->execute();
		$conn = null;
	} catch (PDOException $e) {
		echo "PDOException: ".$e->getMessage();
	}

		?>
	<p> All Done!</P>
	<p> Your Seats have been Booked!</p>
	<p style = "text-decoration: underline;"> THANK YOU!!</p>
		
		</div>
		</body>
</html>