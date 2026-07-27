<?php

$servername = "localhost";   // or "localhost"
$username = "root";
$password = "0145";
$dbname = "school";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected Successfully";
?>