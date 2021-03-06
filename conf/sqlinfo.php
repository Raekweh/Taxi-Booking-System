<!-- Student Name: Raymond Li -->
<!-- Student ID: 18028813 -->

<!-- The sqlinfo.php is used for the databse information and sql commands -->
<?php
    //Database information
    $sql_host = "cmslamp14.aut.ac.nz";
    $sql_user = "cyz8072";
    $sql_pass = "RakeshPatel009";
    $sql_db = "cyz8072";
    $sql_tble = "bookingInfo";

    //Existence of table
    $tableExistence = "SELECT 1 FROM $sql_tble";

    //Creating table. Need to add status and assign
    $creatingTable = "CREATE TABLE $sql_tble(
        ReferNumber INT AUTO_INCREMENT NOT NULL,
        CustomerName VARCHAR(30) NOT NULL,
        PhoneNumber VARCHAR(12) NOT NULL,
        UnitNumber VARCHAR(5),
        StreetNumber INT NOT NULL,
        StreetName VARCHAR(50) NOT NULL,
        Suburb VARCHAR(50),
        DestinationSuburb VARCHAR(50),
        PickupDate DATE NOT NULL,
        PickupTime TIME NOT NULL,
        Status VARCHAR(15) NOT NULL,
        PRIMARY KEY (ReferNumber)
        )";

    //Retreiving the latest query
    $latest_refNumber_query = "SELECT * FROM $sql_tble ORDER BY ReferNumber DESC LIMIT 1";
    
	//Getting the max reference number
	$refereNumber_query = "SELECT MAX(ReferNumber) AS latestRefer FROM $sql_tble";
?>