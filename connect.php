<?php
//a connect function to be used for database operations.
//taken from the lecture slides and php/mysql terminal classes.
function connect()
		{
			
			$host = 'dragon.ukc.ac.uk';
			$dbname = 'rt360';
			$user = 'rt360';
			$pwd = 'vangoe&';
				try {
					$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pwd);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					if ($conn) {
						return $conn;
					} else {
					echo 'Failed to connect';
					}	
				} catch (PDOException $e) {
				echo "PDOException: ".$e->getMessage();
		        }
		}
?>