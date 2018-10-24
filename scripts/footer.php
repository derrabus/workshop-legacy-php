<?php

global $container;

$authorizationChecker = $container->get('security.authorization_checker');
$router = $container->get('router');

?>
<hr />
<p>
    <a href="<?= $router->generate('legacy.home') ?>">Home</a> &mdash;
<?php if (!$authorizationChecker->isGranted('IS_AUTHENTICATED_REMEMBERED')): ?>
    <a href="<?= $router->generate('login') ?>">Login</a>
<?php else: ?>
    <?php if ($authorizationChecker->isGranted('ROLE_ADMIN')): ?>
    <a href="<?= $router->generate('legacy.cat_admin.php') ?>">Manage categories</a> &mdash;
    <a href="<?= $router->generate('legacy.biz_admin.php') ?>">Add business</a> &mdash;
    <?php endif; ?>
    Logged in as <?= $container->get('security.token_storage')->getToken()->getUsername() ?>
    (<a href="<?= $router->generate('logout') ?>">Logout</a>)
<?php endif; ?>
</p>
