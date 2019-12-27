<?php
use Phalcon\Mvc\Micro\Collection as MicroCollection;

/**
 * Route not found
 */

//Users

$app->get('/', function () { echo 'Hello'; });

$users = new MicroCollection();
$users->setHandler(new \Sysnews\Controllers\UserController());
$users->setPrefix('/users');
$users->get('/', 'index');
$users->get('/{id}', 'show');
$users->post('/', 'store');
$users->put('/{id}', 'update');
$users->delete('/{id}', 'delete');
$app->mount($users);
$users->setPrefix('/auth');
$users->setHandler(new \Sysnews\Controllers\UserController());
$users->post('/user', 'store');
$app->mount($users);

//Auth
$auth = new MicroCollection();
$auth->setHandler(new \Sysnews\Controllers\AuthController());
$auth->setPrefix('/auth');
$auth->post('/', 'auth');
$app->mount($auth);

//Noticias
$noticias = new MicroCollection();
$noticias->setHandler(new \Sysnews\Controllers\NoticiasController());
$noticias->setPrefix('/noticias');
$noticias->get('/', 'index');
$noticias->get('/{id}', 'show');
$noticias->post('/', 'store');
$noticias->put('/{id}', 'update');
$noticias->delete('/{id}', 'delete');
$app->mount($noticias);

$app->notFound(function () use ($app) {
    $response = new Phalcon\Http\Response();
    $response->setStatusCode(404, 'Not Found');
    $response->setContentType('application/json', 'UTF-8');
    $response->setJsonContent([
        'status' => [
            'type' => 'FAILED',
            'message' => 'route was not found',
        ],
    ]);

    $response->send();
});
