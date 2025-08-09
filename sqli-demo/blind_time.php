<?php
include 'db.php';
include 'log.php';
log_attempt("blind_time Login", $_SERVER['QUERY_STRING']);

$id = $_GET['id'] ?? '';

$query = "SELECT * FROM products WHERE id = $id AND IF(1=1, SLEEP(5), 0)";
$result = $conn->query($query);

echo "Done.";
?>
