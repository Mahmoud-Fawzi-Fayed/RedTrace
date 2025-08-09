<?php
include 'db.php';
include 'log.php';
log_attempt("time_sqli Login", $_SERVER['QUERY_STRING']);

$id = $_GET['id'] ?? '1';
$sql = "SELECT * FROM products WHERE id = $id";
$result = $conn->query($sql);

echo "Query finished.";
?>

