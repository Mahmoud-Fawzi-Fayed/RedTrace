<?php require 'config.php'; require 'helpers.php'; require_login(); topnav('IDOR: View Profile'); ?>
<div class="card">
  <div class="h">IDOR: View Any Profile</div>
  <p class="p">Description: The page uses <code>?user_id=</code> directly with no ownership or role checks.
    Students can change the <code>user_id</code> to view other users’ private data.
  </p>
  <div class="notice">Try: <code>?user_id=1</code>, <code>?user_id=2</code>, <code>?user_id=3</code> (admin)</div>
</div>
<?php
$user_id = $_GET['user_id'] ?? current_user()['id'];
$stmt = $pdo->prepare('SELECT id, username, email, role FROM users WHERE id = ?');
$stmt->execute([$user_id]);
$victim = $stmt->fetch();
?>
<div class="card">
  <?php if($victim): ?>
    <div class="h">Profile of #<?= htmlspecialchars($victim['id']) ?></div>
    <div class="p">Username: <strong><?= htmlspecialchars($victim['username']) ?></strong></div>
    <div class="p">Email: <strong><?= htmlspecialchars($victim['email']) ?></strong></div>
    <div class="p">Role: <strong><?= htmlspecialchars($victim['role']) ?></strong></div>
  <?php else: ?>
    <div class="notice">User not found</div>
  <?php endif; ?>
</div>
<?php foot(); ?>