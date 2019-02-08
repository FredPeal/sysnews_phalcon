<?php 

use Phalcon\Loader;

$loader = new Loader();

$loader->registerDirs(
    [
        __DIR__ . '/../controllers/',
        __DIR__ . '/../models/',
        __DIR__ . '/../library/',
    ]
);
$loader->registerNamespaces(
    [
       'Sysnews\Controllers' => __DIR__ . '/../controllers/',
       'Sysnews\Models' => __DIR__ . '/../models/',
       'Sysnews\Library' => __DIR__ . '/../library/',
     ]
);

$loader->register();
