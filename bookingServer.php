<?php
	// get name and password passed from client
	$customerName = $_POST['name'];
	$phoneNumber = $_POST['pwd'];
	// sleep for 10 seconds to slow server response down
	sleep(3);
	// write back the password concatenated to end of the name
	echo ($customerName." : ".$phoneNumber);
?>
