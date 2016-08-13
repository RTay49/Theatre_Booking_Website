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
		
		//checks and initalises the variable.
		//recived and error unless used.
		//inspired by stackoverflow.
		if (isset($_GET['date'])){
			
		$date =	$_GET['date'] ;
		
		echo "<p>".$date."</p>";
		}
		//saves the variable to the session array.
		$_SESSION['selecteddate'] = $date;
		?>

	
	<form action="bookzone.php" method="GET">
	<p>Time</p>
		<!--creates a dropdown menu for user input-->
		<select name="time">
		
		
		<?php
		//Uses the connect function from connect.php 
		//Most of this code is based off the lecture slides and php terminal sessions
		require ("connect.php");
		$conn=connect();
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "select PerfTime from Performance where PerfDate = '$date' AND Title = '$showproduction'";
		$handle = $conn->prepare($sql);
		$handle->execute();
		$conn = null;
		$res = $handle->fetchAll();
	
		foreach($res as $row) {
	//populates it with data from the database.
		 	//the sysntax was insipred by stackoverflow.
			echo '<option value="'.$row['PerfTime'].'">'. $row['PerfTime'] . '</option>';
		 
		}
	
		
		
		
	echo "</select>"
   
		
			?>
			<input type="submit" name="submit" value="Submit">
	</form>
	</div>
			</body>
</html>