<?php
require_once __DIR__ . '/_common.php';
$q = $_GET['q'] ?? '';
ob_start();
?>
<div class="section-card">
  <h3>1. Reflected XSS <span class="badge-danger">(Vulnerable)</span></h3>
  <form>
    <label>Query <input name="q" value="<?= $q ?>"></label>
    <button class="btn" type="submit">Search</button>
  </form>
  <?php if ($q !== ''): ?>
    <p style="margin-top:12px">Results for: <?= $q // deliberate vuln ?></p>
  <?php endif; ?>
</div>
<?php layout('Reflected XSS (vuln)', ob_get_clean());