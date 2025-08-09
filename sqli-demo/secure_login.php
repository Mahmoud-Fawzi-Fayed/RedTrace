<?php
include 'db.php';
include 'log.php';
log_attempt("secure Login", $_SERVER['QUERY_STRING']);

$username = $_GET['username'] ?? '';
$password = $_GET['password'] ?? '';

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows > 0) {
    echo "Login Success";
} else {
    echo "Login Failed";
}
?>
