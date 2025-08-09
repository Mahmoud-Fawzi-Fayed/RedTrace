<?php
// config.php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
if (!defined('CTF_FLAG')) {
    define('CTF_FLAG', 'FLAG{BAC_ADMIN_PWNED}');
}

$DB_HOST = '127.0.0.1';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'bac_lab';

try {
    $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (Exception $e) {
    die('DB connection failed: ' . htmlspecialchars($e->getMessage()));
}
?>