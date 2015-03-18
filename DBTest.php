<!DOCTYPE html>

<html>
	<head>
	</head>
	<body>
		<?php
		    $servername="tnfq2gizwu.database.windows.net,1433";
			$username="cmpt350_ogf926";
			$password="E69ew1flri";
			$dbname="azuredb";
			
		    try{
                $conn = new PDO( "sqlsrv:Server= $servername ; Database = $dbname ", $username, $password);
                $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
                echo "Connection successfully</br>";
            }
            catch(Exception $e){
                die("Connection failed: ".print_r($e));
            }
			
			$sql = "CREATE TABLE AddressBook(
				id INT IDENTITY(1,1),
				firstname VARCHAR(30) NOT NULL,
				lastname VARCHAR(30) NOT NULL,
				company VARCHAR(30),
				phone LONG NOT NULL,
				email VARCHAR(255),
				address VARCHAR(255) NOT NULL,
				birthday DATE,
				note VARCHAR(255),
				PRIMARY KEY(id)
			)";
			
			try{
				$result = $conn->query($sql);
				echo "Table created";
			}
			
			catch(Exception $e){
				print_r($e);
			}
		 ?> 
	</body>
</html>