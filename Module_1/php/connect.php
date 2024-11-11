<?php

//main connection file for both admin & front end
$servername = "localhost"; //server
$username = "root"; //username
$password = ""; //password
$dbname = "kiosk";  //database

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname, "3306"); // connecting 

// Check connection
if (!$conn) 
{       //checking connection to DB	
    echo "Connection failed!";
}

?>
