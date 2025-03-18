<?php
$host = "localhost"; // Your server name (usually "localhost")
$username = 'root'; // Your MySQL username
$password = ''; // Your MySQL password (if any, or leave it empty)
$dbname = 'food_ordering'; // Your database name

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Exit if connection fails
}
?>




