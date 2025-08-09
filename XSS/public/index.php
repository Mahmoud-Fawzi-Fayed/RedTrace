<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/_common.php';
$posts = db()->query('SELECT id, title, created_at FROM posts ORDER BY id DESC')->fetchAll();
ob_start();
?>
<div class="section-card">
  <h3>Home</h3>
  <h4>Posts</h4>
  <ul>
    <?php foreach ($posts as $p): ?>
      <li>
        <a href="view_post_vuln.php?id=<?= (int)$p['id'] ?>">VULN view</a> |
        <a href="view_post_safe.php?id=<?= (int)$p['id'] ?>">SAFE view</a> —
        <?= h($p['title']) ?> <small class="muted">(<?= h($p['created_at']) ?>)</small>
      </li>
    <?php endforeach; ?>
  </ul>
</div>
<?php layout('Home', ob_get_clean());