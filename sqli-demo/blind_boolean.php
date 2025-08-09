<?php
include 'db.php';
include 'log.php';
log_attempt("blind_boolean Login", $_SERVER['QUERY_STRING']);
$id = $_GET['id'] ?? '';

$query = "SELECT * FROM products WHERE id = $id";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    echo "✅ True Condition";
} else {
    echo "❌ False Condition";
}
?>
