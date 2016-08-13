
	<?php
	//a function used to display the current productions.
	function getProductions(){
	try {
		require ("connect.php");
		$conn=connect();
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "select Title from Production";
		$handle = $conn->prepare($sql);
		$handle->execute();
		$conn = null;
		$res = $handle->fetchAll();
	
		foreach($res as $row) {
			echo  "<p>".$row['Title'] ."</p>" . "\n" ."" ."\n";
		}
	
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
	}
	?>
