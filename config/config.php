<?php 

use Phalcon\Config;

$settings = [
    'database' => [
        'host'     => '172.21.0.18',
        'username' => 'root',
        'password' => 'xiECcbe2Fe',
        'dbname'   => 'sysnews',
    ],
     'app' => [
        'controllersDir' => '../app/controllers/',
        'modelsDir'      => '../app/models/',
        'viewsDir'       => '../app/views/',
        'production' => 1,
    ],
    'mysetting' => 'the-value',
];

$config = new Config($settings);

return $config;
