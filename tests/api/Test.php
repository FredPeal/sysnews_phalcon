<?php


    $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE1NDgyNTExODUsImlzcyI6InN5c25ld3MubG9jYWwiLCJzdWIiOiIxIiwiZW1haWwiOiJmcmVkZXJpY2twZWFsQGdtYWlsLmNvbSIsInVzZXJuYW1lIjoiZnJlZGVyaWNrcGVhbCIsImlhdCI6MTU0ODE2NDc4NX0.Kdxo4nQD2dvy3N9AcV-rP0jAmYF_zvoxY8Bb4-xBEKE';
    $I = new ApiTester($scenario);
    $I->amBearerAuthenticated($token);
