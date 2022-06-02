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
		// sleep for 3 seconds to slow server response down
		sleep(3);

		// Check for validation
		if(validPhone($_POST['phone']) && validsNumber($_POST['streetnumber']) && validstName($_POST['streetname']) && validpickupDate($_POST['pickupdate']) && validpickupTime($_POST['pickuptime']))
		{
			//Posts the variables
			$customerName = $_POST['name'];
			$phoneNumber = $_POST['phone']; //Need to change the database to varchar
			$unitNumber = $_POST['unitnumber']; //Need to change the database to varchar
			$streetNumber = $_POST['streetnumber'];
			$streetName = $_POST['streetname'];
			$suburbName = $_POST['suburb'];
			$desintationSuburb = $_POST['destinationsuburb'];
			$pickupDate = $_POST['pickupdate'];
			$pickupTime = $_POST['pickuptime'];

			echo "The pick up time is : $pickupTime";
			//Inserting Command
			$insert_sql = "INSERT INTO $sql_tble (CustomerName, PhoneNumber, UnitNumber, StreetNumber, StreetName, Suburb, DestinationSuburb, PickupDate, PickupTime, Status)
			VALUES ('$customerName' ,'$phoneNumber', '$unitNumber', '$streetNumber', '$streetName', '$suburbName', '$desintationSuburb', '$pickupDate', '$pickupTime', 'Unassigned')";

			$existenceResults = @mysqli_query($conn, $tableExistence);

			//Validation results
			if ($existenceResults !== FALSE) 
			{
    			//Executing the insert query
				$insertingResult = @mysqli_query($conn, $insert_sql);

				displayingBRN($conn, $latest_refNumber_query, $refereNumber_query);
			} 
			else
			{
				$creatingTableResult = @mysqli_query($conn,$creatingTable);
				if($creatingTableResult !== FALSE)
				{
					$insertingResult = @mysqli_query($conn, $insert_sql);
					displayingBRN($conn, $latest_refNumber_query, $refereNumber_query);
				}
			}
		}
	}

	//Displaying the booking reference number & information
	function displayingBRN($conn, $latest_refNumber_query, $refereNumber_query)
	{
		$BRNString = "BRN00000";

		//Get the latest insert values
		$latestResults = @mysqli_query($conn, $latest_refNumber_query);
		$referenceNumber = @mysqli_query($conn, $refereNumber_query);
		
		echo "<table>";
		//Getting information of the latest insert
		if($latestResults != FALSE && $referenceNumber != FALSE)
		{
			echo "<h1> Thank you for your booking!</h1>";
			//Interating through the max value of reference number
			while($referRow =  mysqli_fetch_assoc($referenceNumber))
			{
				$BRN = substr($BRNString , 0, strlen($BRNString) - strlen($referRow['latestRefer']));
				//Interating through the latest row
				while($lrow = mysqli_fetch_assoc($latestResults))
				{
					echo "<tr><th>Booking Reference Number: </th> <td>",$BRNString . $lrow["ReferNumber"],"</td></tr>";
					echo "<tr><th>Pickup Time: </th><td>",date("G:i", strtotime($lrow["PickupTime"])),"</td></tr>";
					echo "<tr><th>Pickup Date: </th><td>",date('d/m/Y', strtotime($lrow["PickupDate"])),"</td></tr>";
				}
			}
		}
		echo "</table>";
	}

	//Street name Validation
	function validstName($stname)
	{
	    //Checks if the date is null or empty.
		if (empty($stname) || !isset($stname)) 
		{
			echo "<p>Please enter a street name.</p>";
			return false;
		}
		else
		{
			$pattern = "/^[a-zA-Z\s]*$/";
			//Street name should only contain characters and space.
			if(preg_match($pattern, $stname))
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

    //Pick up date validation. //Need a condition to check if the date is after the current date
    function validpickupDate($date)
    {
		//Getting the current date
		$currentDate = date("Y-m-d");
        //Checks if the date is null or empty.
        if (empty($date) || !isset($date)) 
        {
            echo "<p>Please insert a pick up date</p>";
            return false;
        }
		else
		{
			//Checks if the date is the current or future date
			if(strtotime($date) >= strtotime($currentDate))
			{
				return true;
			}
			else
			{
				echo "<p>Please select a date from $currentDate onwards</p>";
				return false;
			}		
		}
    }

    //Pick up time validation. //Need to add acondition to check if the time is after the current time
    function validpickupTime($time)
    {
    	$currentTime = date("H:i");
        //Checks if the date is null or empty.
        if (empty($time) || !isset($time)) 
        {
            echo "<p>Please insert a pick up date</p>";
            return false;
        }
        else
        {
			//Checks if the time inserted is after the current time
                if(strtotime($time) >= strtotime($currentTime))
                {
					echo "<p>This is working somehow </p>";
                	return true;
                }
                else
                {
                	echo "<p>Please select a time before the current time $currentTime</p>";
                	return false;
                }
        }
    }
?>