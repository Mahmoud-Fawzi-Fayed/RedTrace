<?php
include 'db.php';
include 'log.php';
log_attempt("Classic Login", $_SERVER['QUERY_STRING']);


$username = $_GET['username'] ?? '';
$password = $_GET['password'] ?? '';

$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    echo "<h3>Login Successful</h3>";
} else {
    echo "<h3>Login Failed</h3>";
}
?>
