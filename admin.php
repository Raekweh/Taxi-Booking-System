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

        if(validBRN($_POST['bookingsearch']))
        {
            $bookingSearch = $_POST['bookingsearch'];
            echo "The booking search is: ".$bookingSearch;
        }
    }

    //Checking if the user inputs the bookking number reference in the correct format.
    function validBRN($bookingNumber)
    {
        if(empty($bookingNumber) || !isset($bookingNumber))
        {
            echo "<p>No Records of Booking Number.</p>";
            return false;
        }
        else{
            $pattern = "/BRN+[0-9]{5}/";

            if(preg_match($pattern, $bookingNumber))
            {
                return true;
            }
            else
            {
                echo "<p>Please input in the booking number in the format BRN00000.</p>";
                return false;
            }
        }
    }
?>