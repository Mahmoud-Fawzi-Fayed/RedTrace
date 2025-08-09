<?php
$host = "localhost";
$dbname = "sqli_demo";
$user = "root";
$pass = ""; // Default password in XAMPP is empty

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
