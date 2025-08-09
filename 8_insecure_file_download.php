<?php require 'config.php'; require 'helpers.php'; require_login(); topnav('Insecure File Download'); ?>
<div class="card">
  <div class="h">Insecure File Download (IDOR)</div>
  <p class="p">Description: Download any user’s file via <code>?file_id=</code>. Server does not verify ownership.
    Students should try file IDs they don’t own.</p>
  <div class="notice">Try: <code>?file_id=1</code>, <code>?file_id=2</code>. Create files in <code>uploads/</code> to test.</div>
</div>
<?php
if (isset($_GET['file_id'])) {
  $fid = (int)$_GET['file_id'];
  $stmt = $pdo->prepare('SELECT * FROM files WHERE id = ?');
  $stmt->execute([$fid]);
  $f = $stmt->fetch();
  if ($f && file_exists($f['path'])) {
    // 🔴 Vulnerable: no ownership check (e.g., $f['user_id'] === current_user()['id'])
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($f['filename']).'"');
    readfile($f['path']);
    exit;
  } else {
    echo '<div class="card notice">File not found on disk or DB.</div>';
  }
}

// List files for convenience
$files = $pdo->query('SELECT f.id, f.filename, u.username FROM files f JOIN users u ON f.user_id=u.id ORDER BY f.id')->fetchAll();
?>
<div class="card">
  <div class="h">All Files (for demo)</div>
  <div class="code"><pre><?php foreach($files as $r){ echo sprintf("#%d %s (owner=%s)\n",
    $r['id'],$r['filename'],$r['username']); } ?></pre></div>
</div>
<?php foot(); ?>
