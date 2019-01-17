<?php 

include 'Test.php';

//'https://uinames.com/api/'
$client = new \GuzzleHttp\Client;
$response = $client->request('GET', 'https://uinames.com/api/');
$body = $response->getBody();
$body = json_decode((string) $body);
 
 
$I->sendPost('/users/', ['name'=>$body->name, 'pass'=>$body->surname,"email"=>$body->name . '@contoso.com']);
$I->seeResponseMatchesJsonType(['name'=>'string']);
