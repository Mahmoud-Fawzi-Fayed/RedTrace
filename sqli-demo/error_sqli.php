<?php
include 'db.php';
include 'log.php';
log_attempt("error_sqli Login", $_SERVER['QUERY_STRING']);

$id = $_GET['id'] ?? '';

$query = "SELECT * FROM products WHERE id = '$id'";
$result = $conn->query($query);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo "Product: {$row['name']} - {$row['price']}<br>";
    }
} else {
    echo "SQL Error: " . $conn->error; // Display raw error
}
?>
