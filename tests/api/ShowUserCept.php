<?php 
include 'Test.php';
$I->sendGet('/users/1');
$I->seeResponseMatchesJsonType(['name'=>'string']);