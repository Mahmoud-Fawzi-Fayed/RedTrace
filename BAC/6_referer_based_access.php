<?php require 'config.php'; require 'helpers.php'; require_login(); topnav('Referer-Based Access'); ?>
<div class="card">
  <div class="h">Referer-Based Access Control</div>
  <p class="p">Description: Server checks only the <code>Referer</code> header to allow exporting private posts.
     Attackers can forge or omit the header to bypass.</p>
</div>
<?php
// 🔴 Vulnerable: only check Referer contains our dashboard
$ok = isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], 'dashboard.php');
if ($ok) {
  $rows = $pdo->query('SELECT p.id, u.username, p.content, p.is_private FROM posts p JOIN users u ON p.user_id=u.id WHERE p.is_private=1')->fetchAll();
  header('Content-Type: text/plain');
  echo "# Private posts export (should require admin & CSRF)\n";
  foreach($rows as $r){ echo "#{$r['id']} by {$r['username']}: {$r['content']}\n"; }
  exit;
} else {
  echo '<div class="card notice">Blocked: invalid Referer (but this check is easily bypassed).</div>';
}
?>
<?php foot(); ?>