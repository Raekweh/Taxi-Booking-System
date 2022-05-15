<?php
    $sql_host = "cmslamp14.aut.ac.nz";
    $sql_user = "cyz8072";
    $sql_pass = "RakeshPatel009";
    $sql_db = "cyz8072";
    $sql_tble = "bookingInfo";




    //Retreiving the latest query
    $latest_refNumber_query = "SELECT * FROM $sql_tble ORDER BY ReferNumber DESC LIMIT 1";
	//Getting the max reference number
	$refereNumber_query = "SELECT MAX(ReferNumber) AS latestRefer FROM $sql_tble";
?>