<?php require 'config.php'; require 'helpers.php'; topnav('BAC Lab — Home'); ?>
<div class="card">
  <h1 class="h">Broken Access Control (BAC) Lab</h1>
  <p class="p">Hands-on PHP exercises. Each page explains a BAC subtype and provides a vulnerable example your students can try.
  Use <strong>alice/password123</strong> or <strong>bob/password123</strong> (users) and <strong>admin/admin123</strong> (admin).</p>
  <a class="btn" href="login.php">Login to start</a>
</div>
<div class="grid">
  <div class="card"><div class="h">1) IDOR: View Profile</div><p class="p">Direct object reference via <code>?user_id=</code> leaks profiles.</p><a class="btn" href="1_idor_profile.php">Open</a></div>
  <div class="card"><div class="h">2) IDOR: Update Email</div><p class="p">Update someone else’s email by guessing their user_id.</p><a class="btn" href="2_idor_update_email.php">Open</a></div>
  <div class="card"><div class="h">3) Missing Function-Level</div><p class="p">Admin-only function with no server-side check.</p><a class="btn" href="3_missing_function_level_admin.php">Open</a></div>
  <div class="card"><div class="h">4) Forced Browse Delete</div><p class="p">Unauthenticated delete action via predictable URL.</p><a class="btn" href="4_force_browse_delete.php">Open</a></div>
  <div class="card"><div class="h">5) Mass Assignment</div><p class="p">Overposting lets users promote themselves to admin.</p><a class="btn" href="5_mass_assignment_role_change.php">Open</a></div>
  <div class="card"><div class="h">6) Referer-Based Access</div><p class="p">Trusting the <code>Referer</code> header only.</p><a class="btn" href="6_referer_based_access.php">Open</a></div>
  <div class="card"><div class="h">7) Unprotected Admin Export</div><p class="p">Predictable admin export endpoint with no auth.</p><a class="btn" href="7_unprotected_admin_export.php">Open</a></div>
  <div class="card"><div class="h">8) Insecure File Download</div><p class="p">Download any user’s file via <code>?file_id=</code>.</p><a class="btn" href="8_insecure_file_download.php">Open</a></div>
</div>
<?php foot(); ?>
