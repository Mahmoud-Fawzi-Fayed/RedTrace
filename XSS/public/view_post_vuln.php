<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/_common.php';
$id = (int)($_GET['id'] ?? 0);
$p = db()->prepare('SELECT * FROM posts WHERE id=?'); $p->execute([$id]); $post = $p->fetch();
$c = db()->prepare('SELECT * FROM comments WHERE post_id=? ORDER BY id DESC'); $c->execute([$id]); $comments = $c->fetchAll();
ob_start();
?>
<div class="section-card">
  <h3>2. Stored XSS <span class="badge-danger">(Vulnerable)</span></h3>
  <p><b>Title:</b> <?= $post ? h($post['title']) : 'Not found' ?></p>
  <div class="field">
    <label>Post content (raw)</label>
    <div style="border:1px solid var(--border);padding:10px;border-radius:8px;">
      <?= $post ? $post['content'] : '' ?>
    </div>
  </div>
  <h4>Comments (raw)</h4>
  <ul>
    <?php foreach ($comments as $cm): ?>
      <li><b><?= h($cm['author']) ?>:</b> <?= $cm['body'] ?></li>
    <?php endforeach; ?>
  </ul>
  <h4>Add Comment</h4>
  <form method="post" action="add_comment.php">
    <input type="hidden" name="post_id" value="<?= (int)$id ?>">
    <label>Name <input name="author" required></label>
    <label>Comment <textarea name="body" required></textarea></label>
    <label><input type="checkbox" name="vuln" value="1" checked> Return to VULN view</label>
    <div style="margin-top:10px"><button class="btn" type="submit">Add</button></div>
  </form>
</div>
<?php layout('Stored XSS (vuln)', ob_get_clean());