<?php

namespace Sysnews\Tests;

use GuzzleHttp\Client;

class SignUpTest extends BaseTest
{
    public function __construct()
    {
        parent::__construct();
    }

    public function testCreate()
    {
        $data = $this->userData();

        $response = $this->client->request('POST', '/auth/user', [
            'form_params' => $data
        ]);
        $this->assertSame(200, $response->getStatusCode());
        $response = $response->getBody();
        $response = json_decode($response, true);
        $this->assertContains($data['name'], $response);
    }

    public function userData(): array
    {
        $client = new Client();
        $request = $client->request('GET', 'https://randomuser.me/api/');
        $body = $request->getBody();
        $data = json_decode($body, true);
        $data = $data['results'][0];
        $response = [
            'name' => $data['name']['first'],
            'email' => $data['email'],
            'pass' => $data['name']['first']
        ];
        return $response;
    }
}
