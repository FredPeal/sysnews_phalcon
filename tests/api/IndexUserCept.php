<?php 
// $I = require_once('Test.php');
include 'Test.php';
$I->sendGet('/users/');
$I->seeResponseMatchesJsonType(['name'=> 'string'],'$.items[0]');