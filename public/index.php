<?php

use App\Kernel;
use Symfony\Component\Debug\Debug;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require __DIR__.'/../vendor/autoload.php';

define('SCRIPTS_DIR', dirname(__DIR__).'/scripts');
session_start();

// The check is to ensure we don't use .env in production
if (!isset($_SERVER['APP_ENV']) && !isset($_ENV['APP_ENV'])) {
    if (!class_exists(Dotenv::class)) {
        throw new \RuntimeException('APP_ENV environment variable is not defined. You need to define environment variables for configuration or add "symfony/dotenv" as a Composer dependency to load variables from a .env file.');
    }
    (new Dotenv())->load(__DIR__.'/../.env');
}

$env = $_SERVER['APP_ENV'] ?? $_ENV['APP_ENV'] ?? 'dev';
$debug = (bool) ($_SERVER['APP_DEBUG'] ?? $_ENV['APP_DEBUG'] ?? ('prod' !== $env));

if ($debug) {
    umask(0000);

    Debug::enable();
}

if ($trustedProxies = $_SERVER['TRUSTED_PROXIES'] ?? $_ENV['TRUSTED_PROXIES'] ?? false) {
    Request::setTrustedProxies(explode(',', $trustedProxies), Request::HEADER_X_FORWARDED_ALL ^ Request::HEADER_X_FORWARDED_HOST);
}

if ($trustedHosts = $_SERVER['TRUSTED_HOSTS'] ?? $_ENV['TRUSTED_HOSTS'] ?? false) {
    Request::setTrustedHosts(explode(',', $trustedHosts));
}

$kernel = new Kernel($env, $debug);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);

if (Response::HTTP_NOT_FOUND === $response->getStatusCode() && $request->attributes->has('script')) {
    extract($_REQUEST);
    extract($_SERVER);

    $HTTP_GET_VARS = $_GET;
    $HTTP_POST_VARS = $_POST;
    $HTTP_COOKIE_VARS = $_COOKIE;

    chdir(SCRIPTS_DIR);

    ini_set('error_reporting', E_ALL & ~E_STRICT & ~E_WARNING & ~E_NOTICE & ~E_DEPRECATED);
    header('Content-Type: text/html; charset=utf-8');

    global $container;

    $container = $kernel->getContainer();

    require SCRIPTS_DIR.'/'.$request->attributes->get('script');

    exit;
}

$response->send();
$kernel->terminate($request, $response);
