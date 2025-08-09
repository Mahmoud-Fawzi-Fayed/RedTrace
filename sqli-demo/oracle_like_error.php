<?php
include 'db.php';
include 'log.php';
log_attempt("oracle_like_error Login", $_SERVER['QUERY_STRING']);

$id = $_GET['id'] ?? '';

$query = "SELECT * FROM products WHERE id = $id AND (SELECT 1/(SELECT CASE WHEN (1=1) THEN 0 ELSE 1 END))";
$result = $conn->query($query);

if ($result) {
    echo "Query passed.";
} else {
    echo "Error: " . $conn->error;
}
?>
