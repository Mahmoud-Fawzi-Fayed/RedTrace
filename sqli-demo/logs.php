<?php
$logFile = 'logs/sqli.log';
echo "<h1>📜 SQL Injection Attempt Logs</h1><pre style='background:#eee;padding:10px;border-radius:6px;'>";
if (file_exists($logFile)) {
    echo htmlspecialchars(file_get_contents($logFile));
} else {
    echo "No logs found.";
}
echo "</pre>";
?>
