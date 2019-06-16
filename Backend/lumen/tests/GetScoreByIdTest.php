<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class GetScoreByIdTest extends TestCase
{
    
    public function testGetScoresById() {
        $response = $this->call('GET', '/score/1');
        
        $this->assertEquals(200, $response->status());
    }
}