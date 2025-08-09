<?php require 'config.php'; require 'helpers.php'; require_login(); topnav('IDOR: Update Email'); ?>
<div class="card">
  <div class="h">IDOR: Update Someone Else’s Email</div>
  <p class="p">Description: The form includes a hidden <code>user_id</code>. The server trusts it and updates that user’s email.
     Change the hidden field (e.g., via DevTools) to update other accounts.</p>
</div>
<?php
$me = current_user();
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $target_id = $_POST['user_id'] ?? $me['id'];
  $new_email = $_POST['email'] ?? '';
  $stmt = $pdo->prepare('UPDATE users SET email = ? WHERE id = ?');
  $stmt->execute([$new_email, $target_id]);
  echo '<div class="card notice">Updated user #'.htmlspecialchars($target_id).' email to '.htmlspecialchars($new_email).'</div>';
}
?>
<div class="card">
  <form method="post">
    <input type="hidden" name="user_id" value="<?= htmlspecialchars($me['id']) ?>" />
    <label class="label">New Email (for you… or anyone 👀)</label>
    <input class="input" name="email" placeholder="you@example.com" />
    <div style="margin-top:12px"><button class="btn" type="submit">Update</button></div>
  </form>
</div>
<?php foot(); ?>