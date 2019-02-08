<?php

require_once __DIR__ . '/../vendor/autoload.php';
use Dmkit\Phalcon\Auth\Middleware\Micro as AuthMicro;

$dotenv = Dotenv\Dotenv::create(__DIR__ . '/../');
$dotenv->load();

try {
    $config = require __DIR__ . '/../config/config.php';

    require __DIR__ . '/../config/loader.php';
    require __DIR__ . '/../config/services.php';

    // $uri = $di->getRouter()->getRewriteUri();

    $app = new \Phalcon\Mvc\Micro($di);

    require __DIR__ . '/../config/routes.php';

    $auth = new AuthMicro($app, $config->jwt->toArray());

    $app->handle();
} catch (Throwable $e) {
    $response = new Phalcon\Http\Response();
    if ($e->getMessage() == 'No records were found.') {
        $response->setStatusCode(404, 'OK');
    } else {
        $response->setStatusCode(404, 'Not Found');
    }
    $response->setContentType('application/json');
    $response->setJsonContent([
        'status' => [
            'type' => 'FAILED',
            'message' => $e->getMessage(),
            'trace' => !$config->app->production ? $e->getTraceAsString() : null,
        ],
    ]);
    die($e->getMessage());

    $logger = $di->get('log');
    $logger->log('Error', $e->getMessage());
    $response->send();
}
