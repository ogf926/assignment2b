<!DOCTYPE html>

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
		<h2>Contact List</h2>
		<?php
			$servername="tnfq2gizwu.database.windows.net,1433";
			$username="cmpt350_ogf926";
			$password="E69ew1flri";
			$dbname="azuredb";
			
			try{
                $conn = new PDO( "sqlsrv:Server= $server ; Database = $db ", $username, $password);
                $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
                //echo "Connection successfully</br>";
            }
            catch(Exception $e){
                die("Connection failed: ".print_r($e));
            }
			
			$sql = "SELECT id, firstname, lastname, company, phone, email, address, note FROM AddressBook";
			$result = $conn->query($sql);
			
			
			if ($result->num_rows > 0) {
				// output data of each row
				echo '<table style="width:50%">';
				echo "<tr> <td><b>ID:</b></td> <td><b>First Name:</b></td> <td><b>Last Name:</b></td> <td><b>Company:</b></td> <td><b>Phone:</b></td> <td><b>Email:</b></td> <td><b>Address:</b></td> <td><b>Notes:</b></td></tr>";
				while($row = $result->fetch_assoc()) {
					echo "<tr>"."<td>".$row["id"]."</td>"."<td>".$row["firstname"]."</td>"."<td>".$row["lastname"]."</td>"."<td>".$row["company"]."</td>"."<td>".$row["phone"]."</td>"."<td>".$row["email"]."</td>"."<td>".$row["address"]."</td>"."<td>".$row["note"]."</td>"."</tr>";
				}
				echo "</table><br><br>";
				
			} else {
				echo "No Contacts in the address book.";
			}
		 ?> 
		 <form action ="homefin.php" method ="post">
			<input type = 'submit' name = 'Return Home' value = 'Return Home' />
			<br><br>
		 </form>
	</body>
</html>