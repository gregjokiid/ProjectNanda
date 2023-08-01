<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "nan";

// Create connection
$conn = new mysqli($servername, $username, $password,$database);
session_start();

// Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";
?> 