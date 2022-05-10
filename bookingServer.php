<?php

	require_once('./conf/sqlinfo.php');

	//Checks if the sqli_connection is a true or false
	$conn = @mysqli_connect(
		$sql_host,
		$sql_user,
		$sql_pass,
		$sql_db
	);

	//Checks the databae connection.
	if(!$conn)
	{
		echo "<p>Failed to connect to database</p>";
	}
	else{
		echo "<p>Connect to database successful</p>";

		if(validcname($_POST['name']))
		{
			echo "<h1> Thank you for your booking!</h1>";
			// get name and password passed from client
			$customerName = $_POST['name'];
			$phoneNumber = $_POST['phone'];
			// sleep for 10 seconds to slow server response down
			sleep(3);
			// write back the password concatenated to end of the name
			echo "<p> $customerName : $phoneNumber.</p>";
		}
	}

	//Customer name validation.
	function validcname($name)
	{
	    //Checks if the date is null or empty.
	    if (empty($name) || !isset($name)) 
	    {
	        echo "<p>Please enter a name.</p>";
	        return false;
	    }
		else
		{
			$pattern = "/^[a-zA-Z\s]*$/";
			//Name should only contain characters and space.
			if(preg_match($pattern, $name))
			{
				return true;
			}
			else
			{
				echo "<p>The Customer Name box is incorrect </br>
				Your name must not include any special character nor numbers</p>";
			}
		}
	}
?>
