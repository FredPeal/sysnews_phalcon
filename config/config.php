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
    'jwt' => [
        'secretKey' => '923753F2317FC1EE5B52DF23951B1',
        'payload' => [
                'exp' => 1440,
                'iss' => 'phalcon-jwt-auth'
            ],
         'ignoreUri' => [
                '/',
                'regex:/application/',
                'regex:/users/:POST,PUT',
                '/auth/user:POST,PUT',
                '/auth/application',
                '/auth/',
            ]
         ],
    'mysetting' => 'the-value',
];

$config = new Config($settings);

return $config;
