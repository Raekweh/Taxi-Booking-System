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
	else
	{
		echo "<p>Connect to database successful</p>";

		if(validcname($_POST['name']) && validPhone($_POST['phone']))
		{
			echo "<h1> Thank you for your booking!</h1>";

			//Posts the variables
			$customerName = $_POST['name'];
			$phoneNumber = $_POST['phone'];
			$unitNumber = $_POST['unitnumber'];

			// sleep for 3 seconds to slow server response down
			sleep(3);
			// write back the password concatenated to end of the name
			echo "<p> $customerName : $phoneNumber : $unitNumber.</p>";
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
	
	//Phone number validation
	function validPhone($phone)
	{
		//Checks if the phone number is null or empty.
		if(empty($phone) || !isset($phone))
		{
			echo "<p>Please enter a phone number</p>";
		}
		else
		{
			echo strlen($phone);

			//Checks if the length of the phone number is between 10 to 12 digits.
			if(strlen($phone)>=10 && strlen($phone)<=12)
			{
				$pattern = "/^[0-9]*$/";
				if(preg_match($pattern,$phone))
				{
					return true;
				}
				else
				{
					echo "<p>The phone box is incorrect </br>
					The phone must only contain numbers and 10 to 12 digits long</p>";
				}
			}
			else 
			{
				echo "<p> The phone number must be 10 to 12 digits long</p>";
			}
		}
	}
?>
