<?php require 'config.php'; require 'helpers.php'; topnav('Forced Browse Delete'); ?>
<div class="card">
  <div class="h">Forced Browse: Delete Post by ID</div>
  <p class="p">Description: A sensitive action <code>/4_force_browse_delete.php?post_id=ID</code> is exposed without
    any authentication or ownership check. Anyone can hit it directly to delete content.</p>
  <div class="notice">Try: <code>?post_id=1</code>, <code>?post_id=2</code>, <code>?post_id=3</code></div>
</div>
<?php
if (isset($_GET['post_id'])) {
  $pid = $_GET['post_id'];
  // 🔴 Vulnerable: no auth, no ownership check
  $stmt = $pdo->prepare('DELETE FROM posts WHERE id = ?');
  $stmt->execute([$pid]);
  echo '<div class="card notice">Post #'.htmlspecialchars($pid).' deleted (by anyone).</div>';
}
$posts = $pdo->query('SELECT p.id, u.username, p.content, p.is_private FROM posts p JOIN users u ON p.user_id=u.id ORDER BY p.id')->fetchAll();
?>
<div class="card">
  <div class="h">All Posts</div>
  <div class="code"><pre><?php foreach($posts as $p){ echo sprintf("#%d by %s | private=%d | %s\n",
    $p['id'], $p['username'], $p['is_private'], $p['content']); } ?></pre></div>
</div>
<?php foot(); ?>