<?php
// helpers.php  — same function names, upgraded navbar structure

function is_logged_in() { return isset($_SESSION['user']); }
function current_user() { return $_SESSION['user'] ?? null; }
function require_login() { if (!is_logged_in()) { header('Location: login.php'); exit; } }

function fetch_user_by_username($pdo, $username) {
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    return $stmt->fetch();
}
function fetch_user_by_id($pdo, $id) {
    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->execute([$id]);
    return $stmt->fetch();
}

$__u = current_user();
if ($__u && ($__u['role'] ?? '') === 'admin') {
    echo '<div class="alert alert-ok flag-banner" role="status" aria-live="polite">
            <i class="fa-solid fa-flag"></i>
            <strong>Admin Flag:</strong> ' . htmlspecialchars(CTF_FLAG) . '
          </div>';
}

function nav_items() {
    // label, href, icon
    return [
        ['Dashboard', 'dashboard.php', 'fa-solid fa-gauge'],
        ['IDOR: View Profile', '1_idor_profile.php', 'fa-regular fa-id-card'],
        ['IDOR: Update Email', '2_idor_update_email.php', 'fa-solid fa-envelope'],
        ['Missing Function-Level', '3_missing_function_level_admin.php', 'fa-solid fa-lock-open'],
        ['Forced Browse Delete', '4_force_browse_delete.php', 'fa-solid fa-trash'],
        ['Mass Assignment', '5_mass_assignment_role_change.php', 'fa-solid fa-user-gear'],
        ['Referer-Based Access', '6_referer_based_access.php', 'fa-solid fa-share-nodes'],
        ['Admin Export', '7_unprotected_admin_export.php', 'fa-solid fa-file-export'],
        ['Insecure Download', '8_insecure_file_download.php', 'fa-solid fa-download'],
    ];
}

function active_class($file) {
    return basename($_SERVER['PHP_SELF']) === $file ? 'active' : '';
}

/**
 * OLD NAME kept: topnav($title)
 * Renders <head>, header/nav (with icons + active highlight), and opens <main>.
 */
function topnav($title = 'BAC Lab') {
    $u = current_user();
    echo '<!DOCTYPE html><html><head><meta charset="utf-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1" />';
    echo '<title>'.htmlspecialchars($title).'</title>';
    echo '<link rel="stylesheet" href="styles.css" />';
    // Icons
    echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />';
    echo '</head><body>';

    // Header / Navbar (responsive with burger)
    echo '<header class="site-header">
            <div class="brand">
              <a class="brand-link" href="dashboard.php">
                <i class="fa-solid fa-shield-halved"></i><span>BAC Lab</span>
              </a>
            </div>

            <input type="checkbox" id="nav-toggle" class="nav-toggle" aria-label="Toggle navigation">
            <label for="nav-toggle" class="nav-burger" aria-hidden="true">
              <span></span><span></span><span></span>
            </label>

            <nav class="nav">
              <ul class="nav-list">';
    foreach (nav_items() as [$label,$href,$icon]) {
        echo '<li><a class="'.active_class($href).'" href="'.$href.'"><i class="'.$icon.'"></i><span>'.$label.'</span></a></li>';
    }
    echo        '</ul>
            </nav>';

    echo   '<div class="nav-actions">';
    if ($u) {
        echo   '<div class="user-chip"><i class="fa-solid fa-user-circle"></i><span>'.htmlspecialchars($u['username']).' ('.htmlspecialchars($u['role']).')</span></div>
                <a class="btn btn-outline" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i><span>Logout</span></a>';
    } else {
        echo   '<a class="btn btn-accent" href="login.php"><i class="fa-solid fa-right-to-bracket"></i><span>Login</span></a>';
    }
    echo   '</div>
          </header>
          <main class="container">';
    $__u = current_user();
    if ($__u && ($__u['role'] ?? '') === 'admin') {
    echo '<div class="alert alert-ok flag-banner">
            <i class="fa-solid fa-flag"></i>
            <strong>Admin Flag:</strong> ' . htmlspecialchars(CTF_FLAG) . '
          </div>';
}
}

/**
 * OLD NAME kept: foot()
 * Closes <main> and outputs footer + closing tags.
 */
function foot() {
    echo '</main>
          <footer class="site-footer">
            <div class="container-sm">
              <p><i class="fa-solid fa-graduation-cap"></i> Built for teaching Broken Access Control</p>
            </div>
          </footer>
          </body></html>';
}

// OPTIONAL: simple flash helpers (safe to use or ignore)
function set_flash($msg, $type = 'error') { $_SESSION['flash'] = ['msg'=>$msg,'type'=>$type]; }
function show_flash() {
    if (empty($_SESSION['flash'])) return;
    $f = $_SESSION['flash']; unset($_SESSION['flash']);
    $cls = $f['type']==='ok' ? 'alert-ok' : 'alert-error';
    $icon = $f['type']==='ok' ? 'fa-circle-check' : 'fa-triangle-exclamation';
    echo '<div class="alert '.$cls.'"><i class="fa-solid '.$icon.'"></i> '.htmlspecialchars($f['msg']).'</div>';
}
