<?php 

include_once 'Test.php';

$client = new \GuzzleHttp\Client;
$response = $client->request('GET', 'https://uinames.com/api/');
$body = $response->getBody();
$body = json_decode((string) $body);

$I = new ApiTester($scenario);
$I->amBearerAuthenticated(generarToken());
$I->haveHttpHeader('Content-Type', 'application/json');
$I->sendPUT('/users/3', ['name' => $body->name, 'pass' => $body->surname, 'email' => $body->name . '@contoso.com']);
$I->seeResponseMatchesJsonType(['name' => 'string']);
$I->seeResponseContainsJson(['name' => $body->name]);
