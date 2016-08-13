<html>
	<head>
		<title>Cheese Theater</title>
		<link rel="stylesheet" type="text/css" href="Style.css">
			
	<body>
		<div id="heading">

			<h1>Cheese Theater</h1>
			<div id="menu">
				<a href="home.php">Home</a>
				<a href="Bookproduction.php">Booking</a>
			</div>
		<div id="booking">
		
		
		<p>Is everything Correct?</p>
		
		
		
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
		
		<?php
	//calculates the price.
	
		require ("connect.php");
		$conn=connect();
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "select BasicTicketPrice from Production where Title = '$showproduction'";
		$handle = $conn->prepare($sql);
		$handle->execute();
		$conn = null;
		$res = $handle->fetchAll();
	
		foreach($res as $row) {
			$priceBase = $row['BasicTicketPrice'];
		}
		
		$conn=connect();
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "select PriceMultiplier from Zone where Name = '$showzone'";
		$handle = $conn->prepare($sql);
		$handle->execute();
		$conn = null;
		$res = $handle->fetchAll();
	
		foreach($res as $row) {
			$priceMulti = $row['PriceMultiplier'];
		}
		$price =   $priceBase * $priceMulti;
		$finalPrice = number_format($price, 2);
		$_SESSION['selectedprice']=$finalPrice;
		?>
		
		<p style = "text-decoration: underline;"> Price</p>
		<!--shows the price-->
		<p> &pound; <?php echo $finalPrice;?> </p>
		
		
		
		
		<a class="button" href="receipt.php">Yes! Proceed</a>
		</div>
		</body>
		</html>