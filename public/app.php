<?php

define('SCRIPTS_DIR', dirname(__DIR__).'/scripts');

$targetFile = empty($_SERVER['REDIRECT_URL']) ? '/index.php' : $_SERVER['REDIRECT_URL'];
if ($targetFile === '/') {
    $targetFile = '/index.php';
}
if (!file_exists(SCRIPTS_DIR.$targetFile)) {
    header('HTTP/1.1 404 Not Found');
    echo 'Not Found';
    exit;
}

$_SERVER['PHP_SELF'] = $targetFile;

extract($_REQUEST);
extract($_SERVER);

$HTTP_GET_VARS = $_GET;
$HTTP_POST_VARS = $_POST;
$HTTP_COOKIE_VARS = $_COOKIE;

chdir(SCRIPTS_DIR);

ini_set('error_reporting', E_ALL & ~E_STRICT & ~E_WARNING & ~E_NOTICE & ~E_DEPRECATED);

require SCRIPTS_DIR.$targetFile;
