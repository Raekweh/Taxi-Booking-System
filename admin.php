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
        echo "<p>Failed to connect to database</p>";
    }
    else{
        sleep (3);
        echo "<p>Database connection is successful</p>";
        $bookingSearch = $_POST['bookingsearch'];
        echo "The booking search is: ".$bookingSearch;
    }
?>