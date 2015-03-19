<html>
	<head>
		<style>
			.error {color: #FF0000;}
			table, th, td {
				border: 1px solid black;
			}
		</style>
	</head>
	<body>
		<h2>Drop Table</h2>
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
			
			$stmt = $conn->prepare("DROP TABLE AddressBook");
			$stmt->execute();
			echo "Table Dropped";
				
		 ?> 
		  
	</body>
</html>