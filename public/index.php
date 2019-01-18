<?php

require_once __DIR__ . '/../vendor/autoload.php';
use Dmkit\Phalcon\Auth\Middleware\Micro as AuthMicro;

$dotenv = Dotenv\Dotenv::create(__DIR__ . '/../');
$dotenv->load();

//try {
    $config = require __DIR__ . '/../config/config.php';

    require __DIR__ . '/../config/loader.php';

    require __DIR__ . '/../config/services.php';

    // $uri = $di->getRouter()->getRewriteUri();

    $app = new \Phalcon\Mvc\Micro($di);

    require __DIR__ . '/../config/routes.php';

    $auth = new AuthMicro($app, $config->jwt->toArray());

    $app->handle();
// } catch (Throwable $e) {
//     $response = new Phalcon\Http\Response();
//     if ($e->getMessage() == 'No records were found.') {
//         $response->setStatusCode(404, 'OK');
//     } else {
//         $response->setStatusCode(404, 'Not Found');
//     }
//     $response->setContentType('application/json');
//     $response->setJsonContent([
//         'status' => [
//             'type' => 'FAILED',
//             'message' => $e->getMessage(),
//             'trace' => !$config->app->production ? $e->getTraceAsString() : null,
//         ],
//     ]);

//     if ($config->app->production) {
//         // Log the exception
//         $di->getLog()->error($e->getMessage(), $e->getTrace());
//     }

//     $response->send();
// }

// $app->get(
//     '/',
//     function () {
//         echo "Hola";
//     }
// );
// $app->handle();
// echo $application->handle($uri)->getContent();

/*
use Phalcon\Mvc\Micro;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Micro\Collection as MicroCollection;
use Phalcon\Di;


include_once __DIR__ . '/../config/loader.php';
include_once __DIR__ . '/../config/database.php';

$router = new Router();

$di = new Di;
$di->set('db',$config->database);
$di->set('router',$router);

$app = new Micro($di);


//Rutas de usuarios
$users = new MicroCollection();
$users->setHandler(new \Controllers\UserController());
$users->setPrefix('/users');
$users->get('/','index');
$users->post('/','store');


$app->mount($users);
$app->handle();
 */
