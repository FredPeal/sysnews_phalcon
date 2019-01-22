<?php 
include_once 'Test.php';
$I = new ApiTester($scenario);
$I->amBearerAuthenticated(generarToken());
$I->sendGet('/users/');
$I->seeResponseMatchesJsonType(['name' => 'string'], '$.items[0]');
