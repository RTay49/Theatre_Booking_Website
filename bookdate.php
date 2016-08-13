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
		//checks and initalises the variable.
		//recived and error unless used.
		//inspired by stackoverflow.
		if (isset($_GET['production'])){
			
		$production =	$_GET['production'] ;
		
		
		
		}
		
		echo "<p>".$production."</p>";
		//saves the variable to the session array.
		$_SESSION['selectedproduction'] = $production;

		?>
		
	
	<form action="booktime.php" method="GET">
	<p>Date</p>
			<!--creates a dropdown menu for user input-->
		<select name="date">
		
		
		<?php
		//Uses the connect function from connect.php 
		//Most of this code is based off the lecture slides and php terminal sessions
		require ("connect.php");
		$conn=connect();
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "select PerfDate from Performance where Title = '$production'";
		$handle = $conn->prepare($sql);
		$handle->execute();
		$conn = null;
		$res = $handle->fetchAll();
		
		foreach($res as $row) {
		//populates it with data from the database.
		 	//the sysntax was insipred by stackoverflow.
			echo '<option value="'.$row['PerfDate'].'">'. $row['PerfDate'] . '</option>';
		 	
		}
	
		
		
		
	echo "</select>"
   
		
			?>
			<input type="submit" name="submit" value="Submit">
	</form>
	</div>
			</body>
</html>

	