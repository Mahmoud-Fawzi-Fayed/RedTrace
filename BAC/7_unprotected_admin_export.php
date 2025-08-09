<?php require 'config.php'; require 'helpers.php'; topnav('Unprotected Admin Export'); ?>
<div class="card">
  <div class="h">Unprotected Admin Export</div>
  <p class="p">Description: A predictable <code>/7_unprotected_admin_export.php</code> endpoint serves a full user export
    with <strong>no authentication</strong>. Anyone who knows or discovers the path can download it.</p>
  <div class="notice">Open this page while logged out. It still works.</div>
</div>
<?php
// 🔴 Vulnerable: no checks at all
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="users_export.csv"');
$rows = $pdo->query('SELECT id, username, email, role FROM users ORDER BY id')->fetchAll();
echo "id,username,email,role\n";
foreach($rows as $r){ echo implode(',', [$r['id'],$r['username'],$r['email'],$r['role']]) . "\n"; }
exit;
?>