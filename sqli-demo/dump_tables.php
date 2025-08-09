<?php
include 'db.php';
include 'log.php';
log_attempt("dump_tables Login", $_SERVER['QUERY_STRING']);

$table = $_GET['table'] ?? 'users';

$query = "SELECT column_name FROM information_schema.columns WHERE table_name='$table'";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    echo $row['column_name'] . "<br>";
}
?>
