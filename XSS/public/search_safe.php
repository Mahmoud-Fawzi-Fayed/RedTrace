<?php
require_once __DIR__ . '/_common.php';
$q = $_GET['q'] ?? '';
ob_start();
?>
<div class="section-card">
  <h3>1. Reflected XSS <span class="badge-ok">(Safe)</span></h3>
  <form>
    <label>Query <input name="q" value="<?= h($q) ?>"></label>
    <button class="btn" type="submit">Search</button>
  </form>
  <?php if ($q !== ''): ?>
    <p style="margin-top:12px">Results for: <?= h($q) ?></p>
  <?php endif; ?>
</div>
<?php layout('Reflected XSS (safe)', ob_get_clean());