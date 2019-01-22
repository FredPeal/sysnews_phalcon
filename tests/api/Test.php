<?php


    $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE1NDgyNTczMjAsImlzcyI6InN5c25ld3MubG9jYWwiLCJzdWIiOiI0NyIsImVtYWlsIjoiQ2FudGVtaXJAY29udG9zby5jb20iLCJ1c2VybmFtZSI6IkNhbnRlbWlyIiwiaWF0IjoxNTQ4MTcwOTIwfQ.hn7mJujbXCjWzpShxaa0mfRi7U-52hwBqbEAluQFHW4';
    $I = new ApiTester($scenario);
    $I->amBearerAuthenticated($token);
