<?php
include 'db.php';
include 'log.php';
log_attempt("union_sqli Login", $_SERVER['QUERY_STRING']);

$id = $_GET['id'] ?? '';

$query = "SELECT name, price FROM products WHERE id = $id";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    echo "Product: {$row['name']} - {$row['price']}<br>";
}
?>
