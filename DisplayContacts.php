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
		$servername="lovett.usask.ca";
			$username="cmpt350_ogf926";
			$password="e69ew1flri";
			$dbname="cmpt350_ogf926";
			
			$conn = new mysqli($servername, $username, $password, $dbname);

			if($conn->connect_error)
				die("Connection failed: ".$conn->connect_error);
			else
				echo "Connection successfully</br>";
			
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