<html>
	<head>
		<title>Cheese Theater</title>
		<link rel="stylesheet" type="text/css" href="Style.css">
	
	</head>
	<body>
	
		
		<div id="heading">

			<h1>Cheese Theater </h1>
			<div id="menu">
				<a href="home.php"> Home</a> |
				<a href="bookproduction.php">Booking</a>
			</div>
		</div>
		<div id="content">
			<div id="Productions">
		<p style = "text-decoration: underline;">Now Showing</p>
		<?php
		//A method to show the current Productions using  the getProductions() function from getProductions.php 
		require ("getProductions.php");
		getProductions();
		?>
	
	
		</div>
		<div id="picture">
		<!--a stand in Image and some text to make the home page look more interesting-->
		<!--image found at https://www.google.co.uk/url?sa=i&rct=j&q=&esrc=s&source=images&cd=&cad=rja&uact=8&ved=0ahUKEwj86vu5uMnJAhUDeg8KHYJmAzoQjRwIBw&url=http%3A%2F%2Fwww.seattlemag.com%2Farticle%2Ftheater-festivals&psig=AFQjCNFZQVml4vmVAL9LazSPy2X9W6TK7Q&ust=1449567074631510 -->
		<p> Welcome to the Cheese theater please click <a href="bookproduction.php">booking</a> to book your seats.</p>
		<img class="image" src=theater.jpg>
		</div>
		</div>
	</body>
</html>