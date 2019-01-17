<?php 

include 'Test.php';
$I->sendGet('/noticias?count=1&page=1');
$I->seeResponseMatchesJsonType(['titulo'=> 'string'],'$.items[0]');
