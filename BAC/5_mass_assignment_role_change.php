<?php require 'config.php'; require 'helpers.php'; require_login(); topnav('Mass Assignment: Role Change'); ?>
<div class="card">
  <div class="h">Mass Assignment: Promote Yourself</div>
  <p class="p">Description: The update endpoint blindly accepts all posted fields. A user can submit <code>role=admin</code>
    to escalate privileges. Try editing the hidden field via DevTools.</p>
</div>
<?php
$me = current_user();
if ($_SERVER['REQUEST_METHOD']==='POST') {
  // 🔴 Vulnerable: blindly trust POST keys
  $updates = [];
  $params = [];
  foreach(['email','role'] as $field){
    if(isset($_POST[$field])){ $updates[] = "$field = ?"; $params[] = $_POST[$field]; }
  }
  if($updates){ $params[] = $me['id']; $pdo->prepare('UPDATE users SET ' . implode(',', $updates) . ' WHERE id = ?')->execute($params);
    // Refresh session copy
    $_SESSION['user'] = fetch_user_by_id($pdo, $me['id']);
    echo '<div class="card notice">Updated: '.htmlspecialchars(implode(', ', array_keys($_POST))).'</div>';
  }
}
$me = current_user();
?>
<div class="card">
  <form method="post">
    <label class="label">Email</label>
    <input class="input" name="email" value="<?= htmlspecialchars($me['email']) ?>" />
    <!-- 🔴 Hidden role field: change to admin in DevTools -->
    <input type="hidden" name="role" value="user" />
    <div style="margin-top:12px"><button class="btn" type="submit">Save</button></div>
  </form>
  <div class="notice">Current role: <strong><?= htmlspecialchars($me['role']) ?></strong></div>
</div>
<?php foot(); ?>