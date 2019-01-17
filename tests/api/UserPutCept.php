<?php 

include 'Test.php';

$client = new \GuzzleHttp\Client;
$response = $client->request('GET', 'https://uinames.com/api/');
$body = $response->getBody();
$body = json_decode((string) $body);

$I->haveHttpHeader('Content-Type', 'application/json');
$I->sendPUT('/users/3', ['name'=>$body->name, 'pass'=>$body->surname,"email"=>$body->name . '@contoso.com']);
$I->seeResponseMatchesJsonType(['name'=>'string']);

