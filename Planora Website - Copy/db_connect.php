<?php

$servername = "bgpl76jzaktllcrzuk9h-mysql.services.clever-cloud.com";
$username = "udquwa2ugfo1nobs";
$password = "cNfG2DIe0rCK8rXOY5Fu";
$dbname = "bgpl76jzaktllcrzuk9h";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?>