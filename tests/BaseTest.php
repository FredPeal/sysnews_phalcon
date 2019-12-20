<?php

namespace Sysnews\Tests;
use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;
use GuzzleHttp\Client;

class BaseTest extends TestCase {
    public $client;

    public function __construct(){
        parent::__construct();
        $dotenv = Dotenv::createImmutable('/app');
        $dotenv->load();
        $url = getenv('APP_URL');
        $this->client = new Client([
        'base_uri' => $url,
        'timeout' => 2.0,
        ]);
    }
}