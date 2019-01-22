<?php
    function generarToken()
    {
        $client = new \GuzzleHttp\Client(['base_uri' => 'http://localhost:8080', ]);
        $response = $client->post(
            '/auth/',
            [
                                                                'form_params' => [
                                                                    'email' => 'Cantemir@contoso.com',
                                                                    'pass' => 'Pop'
                                                                ]
                                                             ]
    );

        $body = $response->getBody();
        $body = json_decode((string) $body);
        return $body;
    }
