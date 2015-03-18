<!DOCTYPE html>
<html>
	<head>
		<?php
			echo ("<h1> Address Book </h1>");
			echo ("<h2> Author: ogf926 </h2>");
		?>
	</head>

	<body>
		<?php
			
		?>
		<form action ="http://ogf926.azurewebsites.net/AddContact.php" method ="post">
			<input type = 'submit' name = 'Add Contact' value = 'Add Contact' />
			<br><br>
		</form>
		<form action ="http://ogf926.azurewebsites.net/DisplayContacts.php" method ="post">
			<input type = 'submit' name = 'DisplayContacts' value = 'Display Contacts' />
			<br><br>
		</form>
		<form action ="http://ogf926.azurewebsites.net/UpdateContact.php" method ="post">
			<input type = 'submit' name = 'UpdateContacts' value = 'Update Contact' />
			<br><br>
		</form>
		<form action ="http://ogf926.azurewebsites.net/DeleteContact.php" method ="post">
			<input type = 'submit' name = 'Delete Contact' value = 'Delete Contact' />
			<br><br>
		</form>
	</body>
	
</html>