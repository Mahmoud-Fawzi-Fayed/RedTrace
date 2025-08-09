<?php
include 'db.php';
include 'log.php';
log_attempt("cast_error Login", $_SERVER['QUERY_STRING']);

$id = $_GET['id'] ?? '';

$query = "SELECT * FROM products WHERE id = '$id' AND 1=CAST((SELECT password FROM users LIMIT 1) AS UNSIGNED)";
$result = $conn->query($query);

if ($result) {
    echo "Success.";
} else {
    echo "Error: " . $conn->error;
}
?>
