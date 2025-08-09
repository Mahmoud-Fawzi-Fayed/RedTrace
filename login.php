<?php require 'config.php'; require 'helpers.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';
  $u = fetch_user_by_username($pdo, $username);
  if ($u && $u['password'] === $password) {
    $_SESSION['user'] = $u; // store entire row (simple for lab)
    header('Location: dashboard.php'); exit;
  } else { $error = 'Invalid credentials'; }
}
 topnav('Login'); ?>
<div class="card login-card">
  <div class="h">Login</div>
  <?php if(isset($error)): ?><div class="notice"><?= htmlspecialchars($error) ?></div><?php endif; ?>
  <form method="post">
    <label class="label">Username</label>
    <input class="input" name="username" />
    <label class="label">Password</label>
    <input class="input" type="password" name="password" />
    <div style="margin-top:12px"><button class="btn" type="submit">Sign in</button></div>
  </form>
</div>
<?php foot(); ?>