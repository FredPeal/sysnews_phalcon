<?php

class Test
{
    public $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE1NDc5MTE1NTcsImlzcyI6InBoYWxjb24tand0LWF1dGgiLCJzdWIiOiIxIiwiZW1haWwiOiJmcmVkZXJpY2twZWFsQGdtYWlsLmNvbSIsInVzZXJuYW1lIjoiZnJlZGVyaWNrcGVhbCIsImlhdCI6MTU0NzgyNTE1N30.zWZ64jWE2K0oVVz9wEI9FEsH00h4ssK4rwWboTyTOGM';
    public $i = null;

    public function __construct()
    {
        $I = new ApiTester($scenario);
        $I->amBearerAuthenticated($token);
    }
}
