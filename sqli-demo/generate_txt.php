<?php
$logFile = 'logs/sqli.log';
$filename = 'sqli_report.txt';

header('Content-Type: text/plain');
header('Content-Disposition: attachment; filename="' . $filename . '"');

if (file_exists($logFile)) {
    readfile($logFile);
} else {
    echo "SQL Injection Report\n\nNo logs found.";
}
?>
