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


        //COndition to check if the string is enpmty
        if(empty($_POST['bookingsearch']) || !isset($$_POST['bookingsearch']) || $$_POST['bookingsearch'] == " ")  
        {
            echo "<p>Empty String</p>";
          //Search for all within 2 hrs
            //Search based of unsigned
        }
        else if(validBRN($_POST['bookingsearch']))
        {
            $bookingSearch = $_POST['bookingsearch'];
            echo "The booking search is: ".$bookingSearch;
            //Find the exact booking number reference
                //Probably use a find the brn using the last numbers idk use a forloop
        }
        else{
            echo "<p>Please input in the booking number in the format BRN00000.</p>";
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