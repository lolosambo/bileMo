<?php

use App\Kernel;
use App\CacheKernel;
use Blackfire\Client;
use Symfony\Component\Debug\Debug;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;

require __DIR__.'/../vendor/autoload.php';

// If the header is set
if (isset($_SERVER['HTTP_BLACKFIRETRIGGER'])) {
    // let's create a client
    $blackfire = new Client();
    // then start the probe
    $probe = $blackfire->createProbe();

    // When runtime shuts down, let's finish the profiling session
    register_shutdown_function(function () use ($blackfire, $probe) {
        // See the PHP SDK documentation for using the $profile object
        $profile = $blackfire->endProbe($probe);
    });
}

// The check is to ensure we don't use .env in production
if (!isset($_SERVER['APP_ENV'])) {
    if (!class_exists(Dotenv::class)) {
        throw new \RuntimeException('APP_ENV environment variable is not defined. You need to define environment variables for configuration or add "symfony/dotenv" as a Composer dependency to load variables from a .env file.');
    }
    (new Dotenv())->load(__DIR__.'/../.env');
}

$env = $_SERVER['APP_ENV'] ?? 'dev';
$debug = (bool) ($_SERVER['APP_DEBUG'] ?? ('prod' !== $env));

if ($debug) {
    umask(0000);

    Debug::enable();
}

if ($trustedProxies = $_SERVER['TRUSTED_PROXIES'] ?? false) {
    Request::setTrustedProxies(explode(',', $trustedProxies), Request::HEADER_X_FORWARDED_ALL ^ Request::HEADER_X_FORWARDED_HOST);
}

if ($trustedHosts = $_SERVER['TRUSTED_HOSTS'] ?? false) {
    Request::setTrustedHosts(explode(',', $trustedHosts));
}

$kernel = new Kernel($env, $debug);


if ('prod' === $env) {
$kernel = new CacheKernel($kernel);
}
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);


