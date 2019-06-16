<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class LoginFailedTest extends TestCase
{
    public function testLoginFailed() 
    {
        $this->json('POST', '/login', [
            'user' => 'teszt',
            'password' => 'teszt'
        ])->seeJson([
            'status' => 0
        ]);
    }
}