<?php
require_once __DIR__ . '/_common.php';
ob_start();
?>
<div class="section-card">
  <h3>4. New Post</h3>
  <form method="post" action="create_post.php">
    <label>Title <input name="title" required></label>
    <label>Content <textarea name="content" required></textarea></label>
    <button class="btn" type="submit">Create</button>
  </form>
</div>
<?php layout('New Post', ob_get_clean());