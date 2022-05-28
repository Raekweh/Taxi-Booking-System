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
                while($row = mysqli_fetch_assoc($searchResults))
                {
                    echo "<tr><th>Code: </th> <td>",$row["ReferNumber"],"</td></tr>";
                }
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