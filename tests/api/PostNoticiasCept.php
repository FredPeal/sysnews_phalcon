<?php 
include 'Test.php';

$client = new \GuzzleHttp\Client;
$response = $client->request('GET', 'http://jsonplaceholder.typicode.com/posts/1');
$body = $response->getBody();
$body = json_decode((string) $body);

$I->sendPost('/noticias', ['titulo' => $body->title, 'contenido' => $body->body]);
$I->seeResponseMatchesJsonType(['titulo' => 'string']);
$I->seeResponseContainsJson(['titulo' => $body->title]);
