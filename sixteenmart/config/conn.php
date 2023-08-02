<?php
$servername = "sgx19";
$username = "sixteen1_admin";
$password = "Mynameisbhaskara,.1";
$database = "sixteen1_nan";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
$base_url = "https://sixteenmart.my.id/";
session_start();

// Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";
