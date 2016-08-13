<html>
	<head>
		<title>Cheese Theater</title>
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
	
	<form action="bookdate.php" method="GET">
	<p>Production</p>
		<!--creates a dropdown menu for user input-->
		<select name="production">
	
		
		<?php
		//Uses the connect function from connect.php 
		//Most of this code is based off the lecture slides and php terminal sessions
		
		require ("connect.php");
		$conn=connect();
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "select Title from Production";
		$handle = $conn->prepare($sql);
		$handle->execute();
		$conn = null;
		$res = $handle->fetchAll();
	
		foreach($res as $row) {
			//populates it with data from the database.
		 	//the sysntax was insipred by stackoverflow.
		 	echo '<option value="'.$row['Title'].'">'. $row['Title'] . '</option>';
			
			
		 
		}
	
		echo "</select>"
	    
		?>	
			<input type="submit" name="submit" value="Submit">
	</form>
	
	
		
		</div>
		
	
	</body>
</html>