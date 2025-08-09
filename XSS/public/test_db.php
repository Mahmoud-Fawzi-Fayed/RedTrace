<?php
require_once __DIR__ . '/../db.php';

try {
    $pdo = db();
    echo "✅ Connected to DB successfully!<br>";
    $stmt = $pdo->query("SHOW TABLES");
    echo "Tables:<br>";
    while ($row = $stmt->fetch()) {
        echo htmlspecialchars($row[0]) . "<br>";
    }
} catch (Exception $e) {
    echo "❌ Connection failed: " . $e->getMessage();
}