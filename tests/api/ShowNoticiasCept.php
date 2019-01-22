<?php 
include_once 'Test.php';

$I = new ApiTester($scenario);
$I->amBearerAuthenticated(generarToken());
$I->sendGet('/noticias/1');
$I->seeResponseMatchesJsonType(['titulo' => 'string']);
$I->seeResponseContainsJson(['id' => '1']);
