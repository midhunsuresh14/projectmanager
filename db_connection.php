<?php
$servername = "localhost";
$username = "your_actual_username";    // Replace with your MySQL username
$password = "your_actual_password";    // Replace with your MySQL password
$dbname = "phpproject";           // Replace with your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>
