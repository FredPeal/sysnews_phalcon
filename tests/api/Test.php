<?php
    function generarToken()
    {
        $client = new \GuzzleHttp\Client(['base_uri' => 'http://sysnews_nginx', ]);
        $response = $client->post(
            '/auth/',
            [
                                                                'form_params' => [
                                                                    'email' => 'Cantemir@contoso.com',
                                                                    'password' => 'Pop'
                                                                ]
                                                             ]
    );

        $body = $response->getBody();
        $body = json_decode((string) $body);
        return $body;
    }
