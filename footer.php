<hr />
<p>
    <a href="/">Home</a> &mdash;
<?php if (empty($_SESSION['username'])): ?>
    <a href="login.php">Login</a>
<?php else: ?>
    <?php if (!empty($_SESSION['is_admin'])): ?>
    <a href="cat_admin.php">Manage categories</a> &mdash;
    <a href="biz_admin.php">Add business</a> &mdash;
    <?php endif; ?>
    Logged in as <?= $_SESSION['username'] ?>
    (<a href="logout.php">Logout</a>)
<?php endif; ?>
</p>
