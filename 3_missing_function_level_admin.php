<?php require 'config.php'; require 'helpers.php'; require_login(); topnav('Missing Function-Level Access Control'); ?>
<div class="card">
  <div class="h">Missing Function-Level Access Control</div>
  <p class="p">Description: This page exposes an <strong>admin-only</strong> function (list all users) but performs
    <em>no server-side role check</em>. Any logged-in user can access it via direct URL.</p>
  <div class="notice">Try visiting as Alice/Bob and see all users.</div>
</div>
<?php
// 🔴 Vulnerable: no role check
$rows = $pdo->query('SELECT id, username, email, role FROM users ORDER BY id')->fetchAll();
?>
<div class="card">
  <div class="h">All Users (should be admin-only)</div>
  <div class="code"><pre><?php foreach($rows as $r){ echo sprintf("#%d %s | %s | %s\n",
    $r['id'], $r['username'], $r['email'], $r['role']); } ?></pre></div>
</div>
<?php foot(); ?>