<?php 

include_once 'Test.php';
$I = new ApiTester($scenario);
$I->amBearerAuthenticated(generarToken());
$I->sendGet('/noticias?count=1&page=1');
$I->seeResponseMatchesJsonType(['titulo' => 'string']);
