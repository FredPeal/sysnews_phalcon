<?php 
include 'Test.php';

$I->sendGET('/noticias?count=10&page=1');
$I->seeResponseMatchesJsonType(['titulo' => 'string'], '$.items[0]');

