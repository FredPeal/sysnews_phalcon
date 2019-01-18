<?php 

use Phalcon\Config;

$settings = [
    'database' => [
        'host' => env('DB_HOST'),
        'username' => env('DB_USER'),
        'password' => env('DB_PASS'),
        'dbname' => env('DB_DATABASE'),
    ],
     'app' => [
        'controllersDir' => '../app/controllers/',
        'modelsDir' => '../app/models/',
        'viewsDir' => '../app/views/',
        'production' => 1,
    ],
    'jwt' => [
        'secretKey' => env('JWT_SECRET_KEY'),
        'payload' => [
                'exp' => env('JWT_EXP'),
                'iss' => env('JWT_ISS')
            ],
         'ignoreUri' => [
                '/',
                'regex:/application/',
                'regex:/users/:POST,PUT',
                '/auth/user:POST,PUT',
                '/auth/application',
                '/auth/',
                '/noticias/',
            ]
         ],
    'mysetting' => 'the-value',
];

$config = new Config($settings);

return $config;
