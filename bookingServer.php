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

		if(validcname($_POST['name']) && validPhone($_POST['phone']) && validsNumber($_POST['streetnumber']))
		{
			echo "<h1> Thank you for your booking!</h1>";

			//Posts the variables
			$customerName = $_POST['name'];
			$phoneNumber = $_POST['phone'];
			$unitNumber = $_POST['unitnumber'];
			$streetNumber = $_POST['streetnumber'];
			$suburbName = $_POST['suburb'];

			// sleep for 3 seconds to slow server response down
			sleep(3);
			// write back the password concatenated to end of the name
			echo "<p> Customer Name: $customerName. </br> 
			Phone Number: $phoneNumber.</br>
			Unit Number $unitNumber.</br>
			Street Number $streetNumber.</br>
			Subrub $suburbName.</br>
			
			 </p>";
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
			return false;
		}
		else
		{
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
					return false;
				}
			}
			else 
			{
				echo "<p> The phone number must be 10 to 12 digits long</p>";
				return false;
			}
		}
		return false;
	}

	//Street number validation
	function validsNumber($snumber)
	{
		if(empty($snumber) || !isset($snumber))
		{
			echo "<p>Please enter a street number</p>";
			return false;
		}
		return true;
	}

	//Street name Validation
	function validsName($sname)
	{
	    //Checks if the date is null or empty.
		if (empty($sname) || !isset($sname) || $sname = " ") 
		{
			echo "<p>Please enter a name.</p>";
			return false;
		}
		else
		{
			$pattern = "/^[a-zA-Z\s]*$/";
			//Street name should only contain characters and space.
			if(preg_match($pattern, $sname))
			{
				return true;
			}
			else
			{
				echo "<p>The street name box is incorrect </br>
				Your street name must not include any special character nor numbers</p>";
			}
		}
	}
?>
