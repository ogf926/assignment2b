<!DOCTYPE html>

<html>
	<head>
	</head>
	<body>
		<?php
		    $servername="lovett.usask.ca";
			$username="cmpt350_ogf926";
			$password="e69ew1flri";
			$dbname="cmpt350_ogf926";
			
		    $conn = new mysqli($servername, $username, $password, $dbname);

		    if($conn->connect_error)
				die("Connection failed: ".$conn->connect_error);
		    else
				echo "Connection successfully</br>";
			
			$sql = "CREATE TABLE AddressBook(
				id INT AUTO_INCREMENT PRIMARY KEY,
				firstname VARCHAR(30) NOT NULL,
				lastname VARCHAR(30) NOT NULL,
				company VARCHAR(30),
				phone LONG NOT NULL,
				email VARCHAR(255),
				address VARCHAR(255) NOT NULL,
				birthday DATE,
				note VARCHAR(255)
			)";
			
			if($conn->query($sql) == TRUE)
				echo "Table AddressBook created succefully";
			else
				echo "Error creating table: ".$conn->error;
			
		 ?> 
	</body>
</html>