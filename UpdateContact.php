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
		<h2>Update Contact</h2>
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
			$stmt = $conn->prepare("UPDATE AddressBook SET firstname=?, lastname=?, company=?, phone=?, email=?, address=?, birthday=?, note=? WHERE id = ?");
			$stmt->bind_param("sssissssi", $fname, $lname, $cname, $phnum, $email, $address, $bday, $notes, $idnum);
			
			$idnumErr = $idnum ="";
			$formcomplete = TRUE;
			$fnameErr = $lnameErr = $emailErr = $bdayErr = $phnumErr = "";
			$fname = $lname = $email = $cname = $notes = $phnum = $address = $bday = "";
			
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
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
			   if (empty($_POST["idnum"])) {
				 $idnumErr = "* ID number is required";
				 $formcomplete = FALSE;
			   } else {
				 $idnum = test_input($_POST["idnum"]);
				 // check if name only contains letters and whitespace
				 
			   }
			   
			   if (empty($_POST["fname"])) {
				 $fnameErr = "* Name is required";
				 $formcomplete = FALSE;
			   } else {
				 $fname = test_input($_POST["fname"]);
				 // check if name only contains letters and whitespace
				 if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
				   $fnameErr = "* Only letters and white space allowed"; 
				   $formcomplete = FALSE;
				 }
			   }
			   
			   if (empty($_POST["lname"])) {
				 $lnameErr = "* Name is required";
				 $formcomplete = FALSE;
			   } else {
				 $lname = test_input($_POST["lname"]);
				 // check if name only contains letters and whitespace
				 if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
				   $lnameErr = "* Only letters and white space allowed"; 
				   $formcomplete = FALSE;
				 }
			   }
			   
			   if (empty($_POST["email"])) {
				 $email = "";
			   } else {
				 $email = test_input($_POST["email"]);
				 // check if e-mail address is well-formed
				 if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				   $emailErr = "* Invalid email format"; 
				   $formcomplete = FALSE;
				 }
			   }
				 
			   if (empty($_POST["phnum"])) {
				 $phnumErr = "* A phone number is required";
				 $formcomplete = FALSE;
			   } else {
				 $phnum = test_input($_POST["phnum"]);
				 // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
				 
			   }

			   if (empty($_POST["notes"])) {
				 $notes = "";
			   } else {
				 $notes = test_input($_POST["notes"]);
			   }
			   
			   if (empty($_POST["cname"])) {
				 $cname = "";
			   } else {
				 $cname = test_input($_POST["cname"]);
			   }
			   
			   if (empty($_POST["address"])) {
				 $address = "";
			   } else {
				 $address = test_input($_POST["address"]);
			   }

			   
			   if (empty($_POST["bday"])) {
				 $bday = "";
			   } else {
				 $bday = test_input($_POST["bday"]);
				 if (!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/",$bday)) {
				   $bdayErr = "* Please enter the birthday in this format: XXXX-XX-XX"; 
				   $formcomplete = FALSE;
				 }
				 
			   }
			   
			   if ($formcomplete == TRUE ){
				   $stmt->execute();
				   if($stmt === false){
					   echo ("Contact Update Failed, Invalid ID");
				   }
				   else {
					echo ("<p><span class='error'>Contact Updated</span></p>");
				   }
			   }
			}
			$conn->close();
			
			function test_input($data) {
			   $data = trim($data);
			   $data = stripslashes($data);
			   $data = htmlspecialchars($data);
			   return $data;
			}	
		 ?> 
		 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
					  Enter the id of the contact you would like to update: <input type="number"  name="idnum" id="idnum" />
					  <span class="error"><?php echo $idnumErr;?></span>
					  <br><br>
					  First Name: <input type="text" name="fname" id="fname">
					  <span class="error"><?php echo $fnameErr;?></span>
					  <br><br>
					  Last Name: <input type="text"  name="lname" id="lname" />
					  <span class="error"><?php echo $lnameErr;?></span>
					  <br><br>
					  Company: <input type="text"  name="cname" id="cname" />
					  <br><br>
					  Phone Number: <input type="number"  name="phnum" id="phnum" />
					  <span class="error"><?php echo $phnumErr;?></span>
					  <br><br>
					  Email: <input type="text"  name="email" id="email" />
					  <br><br>
					  Address: <input type="text"  name="addy" id="addy" />
					  <br><br>
					  Birthday: <input type="text"  name="bday" id="bday" />
					  <span class="error"><?php echo $bdayErr;?></span>
					  <br><br>
					  Notes: <input type="text"  name="notes" id="notes" /></br>
					  <input type="submit" id="submit" />
					  <br><br>
	 </form>
	 
	 <form action ="homefin.php" method ="post">
			<input type = 'submit' name = 'Return Home' value = 'Return Home' />
			<br><br>
	 </form>
	</body>
</html>