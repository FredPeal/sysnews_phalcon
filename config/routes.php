<?php
use Phalcon\Mvc\Micro\Collection as MicroCollection;

/**
 * Route not found
 */

$users = new MicroCollection();
$users->setHandler(new \Sysnews\Controllers\UserController());
$users->setPrefix('/users');
$users->get('/','index');
$users->get('/{id}','show');
$users->post('/','store');
$users->put('/{id}','update');
$users->delete('/{id}','delete');

$app->mount($users);


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