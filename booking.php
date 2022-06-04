<!-- Student Name: Raymond Li -->
<!-- Student ID: 18028813  -->

<!-- Booking.php is used for users to register a booking while generating a unique booking reference number for the user -->
<!-- displayingBRN function is used to display relavent information in regards of the user's booking -->
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
					echo "<tr><th>Booking Reference Number: </th> <td>",$BRN . $lrow["ReferNumber"],"</td></tr>";
					echo "<tr><th>Pickup Time: </th><td>",date("H:i", strtotime($lrow["PickupTime"])),"</td></tr>";
					echo "<tr><th>Pickup Date: </th><td>",date('d/m/Y', strtotime($lrow["PickupDate"])),"</td></tr>";
				}
			}
		}
		echo "</table>";
	}
?>