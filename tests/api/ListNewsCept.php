<?php 
$token ='eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE1NDc4MjI1NDgsImlzcyI6InBoYWxjb24tand0LWF1dGgiLCJzdWIiOiIxIiwiZW1haWwiOiJmcmVkZXJpY2twZWFsQGdtYWlsLmNvbSIsInVzZXJuYW1lIjoiZnJlZGVyaWNrcGVhbCIsImlhdCI6MTU0NzczNjE0OH0.IWtNZE3ZMK6AzS-a_W5kLrlGXduMlQb_65nwmjR-i3A';
$I = new ApiTester($scenario);
$I->wantTo('Mirar la lista de noticias');
$I->amBearerAuthenticated($token);
$I->sendGET('/noticias?count=10&page=1');
$I->seeResponseIsJson();
