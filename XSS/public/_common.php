<?php
// Safe HTML escaper with guard to avoid redeclare errors
if (!function_exists('h')) {
  function h($str) { return htmlspecialchars($str, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
}

function headWithTheme(string $pageTitle = 'XSS Lab'): void {
  echo '<!doctype html><html lang="en"><head>';
  echo '<meta charset="utf-8">';
  echo '<meta name="viewport" content="width=device-width,initial-scale=1">';
  echo '<title>' . h($pageTitle) . '</title>';
  echo '<link rel="stylesheet" href="/XSS/public/assets/styles.css">';
  // Persisted dark mode (runs before paint)
  echo '<script>(function(){try{var s=localStorage.getItem("theme");if(s==="dark"){document.documentElement.classList.add("dark");}}catch(e){}})();</script>';
  echo '</head>';
}


function layout(string $title, string $bodyHtml): void {
  headWithTheme($title);
  echo '<body>';
  // Hero banner like the SQLi lab
  echo '<div class="hero">'
     . '  <div class="lab-title"><span class="burst">💥</span><span class="accent">XSS</span> Demo Lab</div>'
     . '  <div class="lab-subnav">'
     . '    <a href="index.php">Home</a>'
     . '    <a href="search_vuln.php">Reflected (vuln)</a>'
     . '    <a href="search_safe.php">Reflected (safe)</a>'
     . '    <a href="dom_vuln.html">DOM (vuln)</a>'
     . '    <a href="dom_safe.html">DOM (safe)</a>'
     . '    <a href="new_post.php">New Post</a>'
     . '  </div>'
     . '</div>';

  echo '<div class="container">';
  echo $bodyHtml;
  echo '<footer><small>For local testing only.</small></footer></div>';
  echo '</body></html>';
}