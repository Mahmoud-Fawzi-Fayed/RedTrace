<?php require 'config.php'; require 'helpers.php'; require_login(); topnav('Dashboard'); ?>
<div class="card">
  <div class="h">Welcome, <?= htmlspecialchars(current_user()['username']) ?></div>
  <p class="p">Try each scenario from the nav bar or the home page.</p>
</div>
<?php foot(); ?>
