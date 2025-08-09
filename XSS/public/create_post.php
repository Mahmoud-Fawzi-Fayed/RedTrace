<?php
require_once __DIR__ . '/../db.php';
$title = $_POST['title'] ?? '';
$content = $_POST['content'] ?? '';
$stmt = db()->prepare('INSERT INTO posts (title, content) VALUES (?, ?)');
$stmt->execute([$title, $content]);
header('Location: index.php');