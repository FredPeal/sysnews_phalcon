<?php 
include 'Test.php';
$I->sendGet('/noticias/1');
$I->seeResponseMatchesJsonType(['titulo' => 'string']);
$I->seeResponseContainsJson(['id' => '1']);
