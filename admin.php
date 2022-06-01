<?php
    require_once('./conf/sqlinfo.php');

    $conn = @mysqli_connect(
        $sql_host,
        $sql_user,
        $sql_pass,
        $sql_db
    );

    if(!$conn)
    {
        echo "<p>Failed to connect to database.</p>";
    }
    else{
        sleep (3);
        echo "<p>Database connection is successful</p>";

        $searchQuery = "";

        //Checks if the booking search input is null
        if(isset($_POST['bookingsearch']))  
        {

            //Checks if the booking reference bunmber is in the correct format
            if(validBRN($_POST['bookingsearch']))
            {
                //Converting the booking number to an integer
                $bookingSearch = $_POST['bookingsearch'];
                $subString = substr($bookingSearch,3);
                $bookingNumber = (int) $subString;

                echo "<p>The BRN is in the correct format</p>";
                //Finding the Reference Number
                $searchQuery = "SELECT * FROM $sql_tble WHERE ReferNumber = $bookingNumber";
                $gettingBRN = "SELECT * FROM $sql_tble WHERE ReferNumber = $bookingNumber";
    
                //Executing MySQL commands
                $searchResults = @mysqli_query($conn,$searchQuery);
                $BRNResults = @mysqli_query($conn,$gettingBRN);
    
                //Display the table
                displaySBRNTable($searchResults, $bookingNumber, $BRNResults);
            }
            //Checks if the booking reference is empty or a space
            else if(empty($_POST['bookingsearch'])  || $_POST['bookingsearch'] == " ")
            {
                echo "<p>Empty String</p>";
                $currentTime = date("H:i");
                // echo "<p>The current time is $currentTime </p>";
                $twoHours = date("H:i",strtotime("2 hours", strtotime($currentTime)));
                // echo "<p>The current time is $twoHours </p>";
                $currentDate = date("Y-m-d");
    
                //Select the pick up time between current and two hours after
                $searchQuery = "SELECT * FROM $sql_tble WHERE PickupTime BETWEEN '$currentTime' AND '$twoHours' AND PickupDate = '$currentDate'";
                $BRNQuery = "SELECT ReferNumber FROM $sql_tble WHERE PickupTime BETWEEN '$currentTime' AND '$twoHours' AND PickupDate = '$currentDate'";
                echo $searchQuery;
                // echo $searchQuery;
    
                //Executing MySQL Commands
                $searchResults = @mysqli_query($conn, $searchQuery);
                $BRNResults = @mysqli_query($conn, $BRNQuery);


                //Checking if the search results work //REmove later
                if(!$searchResults)
                {
                    echo "<p>The time period does not work</p>";

                }
                else{
                    echo "<p>The time period is working</p>";
                    displayTwoHTable($searchResults, $BRNResults);
                }
            }
        }
        else{
            echo "<p>Please input in the booking number in the format BRN00000 </br>
            or input an empty string to view all booking numbers within the 2 hours.</p>";
        }
    }

    //Displakys all the BRN within 2 hours
    function displayTwoHTable($searchResults, $BRNResults)
    {
        //Checking if the queries work
        if($searchResults && $BRNResults)
        {
            echo "<p>We run them streets</p>";
        }
    }

    //DIsplays the selected BRN
    function displaySBRNTable($searchResults, $bookingSearch, $BRNResults)
    {
        echo "<p>I am inside the display table</p>";
        if($searchResults && $BRNResults)
        {
            echo "<p>INside the if condition</p>";
            $BRNstring = "BRN00000";
            //retriving the length of the BRN value in ReferNumber columnn in database 
            while($lrow = mysqli_fetch_assoc($BRNResults))
            {
                $referString = strval($lrow['ReferNumber']);
                $BRN = substr($BRNstring, 0, strlen($BRNstring) - strlen($referString));
                echo "blach blah blah this shit doesnt work $BRN";
                //Generating a table
                echo "<table width='100%' border='1'>";
                echo "<tr>
                <th>Booking Reference Number</th><th>Customer Name</th><th>Phone Number</th>
                <th>Unit Number</th><th>Street Number</th> <th>Street Name</th>
                <th>Destination Suburb</th> <th>Pickup Date</th><th>Pickup Time</th>
                <th>Status</th><th>Assigned</th> 
                </tr>";
                //Displaying the table of content
                while($row = mysqli_fetch_assoc($searchResults))
                {
                    echo "<tr><td>",$BRN . $row['ReferNumber'],"</td>";
                    echo "<td>",$row["CustomerName"],"</td>";
                    echo "<td>",$row["PhoneNumber"],"</td>";
                    echo "<td>",$row["UnitNumber"],"</td>";
                    echo "<td>",$row["StreetNumber"],"</td>";
                    echo "<td>",$row["StreetName"],"</td>";
                    echo "<td>",$row["DestinationSuburb"],"</td>";
                    echo "<td>",date('d/m/Y', strtotime($row['PickupDate'])),"</td>";
                    echo "<td>",date("G:i", strtotime($row["PickupTime"])),"</td>";
                    echo "<td>",$row["Status"],"</td>";
                    echo "<td><input type='button' name ='changeAssigned' value='Assign'></td></tr>"; //Need to implement an onclick method to alter the data
                }
                echo "</table>";
            }
        }
        else if(!$searchResults)
        {
            echo "<p>THe search result does not work</p>";
        }
        else if(!$BRNResults)
        {
            echo "<p>THe BRN result does not work</p>";
        }
    }
    //Checking if the user inputs the bookking number reference in the correct format.
    function validBRN($bookingNumber)
    {
        $pattern = "/BRN+[0-9]{5}/";
        if(preg_match($pattern, $bookingNumber))
        {
            return true;
        }
        return false;
    }

?>