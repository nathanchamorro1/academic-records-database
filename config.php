<?php

$servername = "localhost";
//Username
$username   = "username";
//Password
$password   = "password";
$dbname     = "academic_records";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
