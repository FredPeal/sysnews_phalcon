<?php 

/**
* The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
*/

use Phalcon\Logger\Factory;
use Phalcon\Db\Adapter\Pdo\Mysql;

$di = new \Phalcon\DI\FactoryDefault();

$di->set('db', new Mysql($config->database->toArray()));

$di->set(
    'url',
    function () {
        $url = new UrlProvider();
        $url->setBaseUri('/');
        return $url;
    }
);

$di->set(
    'view',
    function () {
        $view = new Phalcon\Mvc\View();
        $view->setViewsDir(__DIR__. '/../views/');
        return $view;
    }
);

$di->set(
    'log',
    function () {
        $options = [
            'name'    => __DIR__. '/../logs/debug.log',
            'adapter' => 'file',
        ];
        
        return Factory::load($options);
    }
);

