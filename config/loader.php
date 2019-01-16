<?php 

use Phalcon\Loader;

$loader = new Loader();

$loader->registerDirs(
    [
        __DIR__ . '/../controllers/',
        __DIR__ . '/../models/'
    ]
);
$loader->registerNamespaces(
    [
       'Sysnews\Controllers'    => __DIR__ . '/../controllers/',
       'Sysnews\Models' => __DIR__ . '/../models/',
     ]
);

$loader->register();