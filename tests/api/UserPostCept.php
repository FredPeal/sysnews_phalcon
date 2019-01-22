<?php 

include_once 'Test.php';

//'https://uinames.com/api/'
$client = new \GuzzleHttp\Client;
$response = $client->request('GET', 'https://uinames.com/api/');
$body = $response->getBody();
$body = json_decode((string) $body);

$I = new ApiTester($scenario);
$I->amBearerAuthenticated(generarToken());
$I->sendPost('/users/', ['name' => $body->name, 'pass' => $body->surname, 'email' => $body->name . '@contoso.com']);
$I->seeResponseMatchesJsonType(['name' => 'string']);
$I->seeResponseContainsJson(['name' => $body->name]);
