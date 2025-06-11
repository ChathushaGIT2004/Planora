<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Replace with your actual database credentials
$host = "localhost"; // Get this from your InfinityFree control panel
$user = "root";
$pass = "";
$db = "planora_db";

// Create connection
$conn = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

 
?>
