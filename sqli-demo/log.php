<?php
function log_attempt($type, $payload) {
    $logFile = 'logs/sqli.log';
    $time = date("Y-m-d H:i:s");
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';

    $entry = "[$time] [$ip] [$type] Payload: $payload" . PHP_EOL;
    file_put_contents($logFile, $entry, FILE_APPEND);
}
?>
