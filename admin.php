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

        //COndition to check if the string is enpmty
        if(empty($_POST['bookingsearch']) || !isset($_POST['bookingsearch']) || $_POST['bookingsearch'] == " ")  
        {
            echo "<p>Empty String</p>";
            $searchQuery = mysqli_query("");
            //Search for all within 2 hrs
                //Search based of unsigned
        }
        else if(validBRN($_POST['bookingsearch']))
        {
            $bookingSearch = $_POST['bookingsearch'];
            echo "The booking search is: ".$bookingSearch;

            //COnverting the booking number to an integer
            $subString = substr($bookingSearch,3);
            $bookingNumber = (int) $subString;
            echo "THe booking Number is $bookingNumber";

            //Finding the Reference Number
            $searchQuery = "SELECT * FROM $sql_tble WHERE ReferNumber = $bookingNumber";

            $searchResults = @mysqli_query($conn,$searchQuery);
            //Checking if results work
            if($searchResults)
            {
                echo "<p> This is working fine I just need to dfisplay the results</p>";
                echo "<table width='100%' border='1'>";
                echo "<tr>
                <th>Booking Reference Number</th><th>Customer Name</th>
                <th>Phone Number</th> <th>Unit Number</th>
                <th>Street Number</th> <th>Street Name</th>
                <th>Destination Suburb</th> <th>Pickup Date</th> 
                <th>Pickup Time</th> <th>Status</th> 
                <th>Assigned</th> 
                </tr>";
                while($row = mysqli_fetch_assoc($searchResults))
                {
                    echo "<tr><td>",$bookingSearch,"</td>";
                    echo "<td>",$row["CustomerName"],"</td>";
                    echo "<td>",$row["PhoneNumber"],"</td>";
                    echo "<td>",$row["UnitNumber"],"</td>";
                    echo "<td>",$row["StreetNumber"],"</td>";
                    echo "<td>",$row["StreetName"],"</td>";
                    echo "<td>",$row["DestinationSuburb"],"</td>";
                    echo "<td>",date('d/m/Y', strtotime($row['PickupDate'])),"</td>";
                    echo "<td>",date("G:i", strtotime($row["PickupTime"])),"</td>";
                    echo "<td>",$row["Status"],"</td>";
                    echo "<td><input type='button' name ='changeAssigned' value='Assign'></td></tr>";
                }
                echo "</table>";
            }
            else{
                echo "<p>THis is not working I hate my life</p>";
            }

            //Find the exact booking number reference
                //Probably use a find the brn using the last numbers idk use a forloop
        }
        else{
            echo "<p>Please input in the booking number in the format BRN00000 </br>
            or input an empty string to view all booking numbers within the 2 hours.</p>";
        }
    }

    //Create a function which display

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