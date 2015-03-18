<!DOCTYPE HTML> 
<html>
	<head>
		<style>
		.error {color: #FF0000;}
		</style>
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
			
	
			// define variables and set to empty values
			echo "above variables";
			$fnameErr = $lnameErr = $emailErr = $bdayErr = $phnumErr = "";
			$fname = $lname = $email = $cname = $notes = $phnum = $address = $bday = "";
			echo "above connection";
			$sql = $conn->prepare("INSERT INTO AddressBook (firstname, lastname, company, phone, email, address, birthday, note) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
			$sql->bind_param("sssissss", $fname, $lname, $cname, $phnum, $email, $address, $bday, $notes);
			
			$formcomplete = TRUE;
			
			echo "above server";
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
			   echo "above lname";
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
			   echo "above email";
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
				echo "above ph"; 
			   if (empty($_POST["phnum"])) {
				 $phnumErr = "* A phone number is required";
				 $formcomplete = FALSE;
			   } else {
				 $phnum = test_input($_POST["phnum"]);
				 // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
				 
			   }
				echo "above notes";
			   if (empty($_POST["notes"])) {
				 $notes = "";
			   } else {
				 $notes = test_input($_POST["notes"]);
			   }
			   echo "above cname";
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
			   echo "above execute";
			   if ($formcomplete == TRUE ){
				   $sql->execute();
				   echo ("contact added");
			   }
			}
			function test_input($data) {
			   $data = trim($data);
			   $data = stripslashes($data);
			   $data = htmlspecialchars($data);
			   return $data;
			}	
		?>
		<h2>Add Contact</h2>
		<p><span class="error">* required field.</span></p>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
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