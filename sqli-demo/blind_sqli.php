<?php
include 'db.php';
include 'log.php';
log_attempt("blind_sqli Login", $_SERVER['QUERY_STRING']);

$id = $_GET['id'] ?? '1';
$sql = "SELECT * FROM products WHERE id = $id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    echo "Product exists.";
} else {
    echo "No product found.";
}
?>
