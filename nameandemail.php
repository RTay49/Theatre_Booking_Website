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
		//shows the a previous user input.
		$showzone = $_SESSION['selectedzone'];
		
		echo "<p>".$showzone."</p>";
	?>
	<p style = "text-decoration: underline;"> Seat</p>
	<?php
		//checks and initalises the variable.
		//webpage returns an error if this is not used.
		//inspired by stackoverflow.
		if (isset($_GET['seat'])){
			
		$seat =	$_GET['seat'] ;
		
		echo "<p>".$seat."</p>";
		}
		//saves the variable to the session array.
		$_SESSION['selectedseat'] = $seat;
		//Php validations, This was taken from www.w3schools.com php validation tutorial
		//initialization of variables
		$name = "";
		$email = "";
		$nameErr = "";
		$emailErr = "";
		$validName = false;
		$validEmail = false;
		
		//runs input though test to ensure valid characters and that the fields aren't empty.
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			 if (empty($_POST["name"])) {
				$nameErr = "Please enter your Name!";
				} else {
				$name = test_input($_POST["name"]);
			if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
				$nameErr = "You can only use letters and spaces for your name!";
			}
			else{ $_SESSION['selectedname']=$name;
				$validName = true;
				}
		}
			if (empty($_POST["email"])) {
				$emailErr = "Please enter a valid email address!";
					} 			
				else {
				$email = test_input($_POST["email"]);
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$emailErr = "Invalid email!"; 
					}
				else{ 
				
				$_SESSION['selectedemail']=$email;
				$validEmail = true;
				}
		}
		}
		
		//allows the the next page if validation was successful
		if($validName == true and $validEmail == true){
			 header("Location: http://raptor.kent.ac.uk.chain.kent.ac.uk/~rt360/finalcheck.php");
			
		}
		//a function to remove illegal cahracters and inputs
			function test_input($data) {
					$data = trim($data);
					$data = stripslashes($data);
					$data = htmlspecialchars($data);
					return $data;
				}
		?>
	
	
		<!--The input field themsevles with code that initializes the php validation and javascript  validation.-->
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']);?> >
		<p><span class="error">* required field.</span></p>
		<p>Name</p> 
		<input type="text" name="name" Onchange= '
		var nameenter = this.value;
		if(nameenter.length<1) {
		alert("Please enter your Name!");
		}'value="<?php echo $name;?>"> 
		<span class="error">* <?php echo $nameErr;?></span>
		<p>Email Address<p>
		<input type="text" name="email" Onchange= '
		var emailenter = this.value;
		if(emailenter.length<1) {
		alert(" Please enter a valid email address!");
		}'value="<?php echo $email;?>"> 
		<span class="error">* <?php echo $emailErr;?></span>
						<p></p>
		<input type="submit" name="submit" value="Submit">
	</form>
	</div>
	</body>
</html>