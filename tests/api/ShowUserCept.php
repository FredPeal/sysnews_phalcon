<?php 
include_once 'Test.php';

$I = new ApiTester($scenario);
$I->amBearerAuthenticated(generarToken());
$I->sendGet('/users/1');
$I->seeResponseMatchesJsonType(['name' => 'string']);
$I->seeResponseContainsJson(['id' => '1']);
