<?php
require_once __DIR__ . '/../db.php';
$post_id = (int)($_POST['post_id'] ?? 0);
$author  = $_POST['author'] ?? '';
$body    = $_POST['body'] ?? '';
$stmt = db()->prepare('INSERT INTO comments (post_id, author, body) VALUES (?, ?, ?)');
$stmt->execute([$post_id, $author, $body]);
$toVuln = isset($_POST['vuln']) ? 'view_post_vuln.php' : 'view_post_safe.php';
header('Location: ' . $toVuln . '?id=' . $post_id);