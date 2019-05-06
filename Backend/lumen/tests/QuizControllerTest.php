<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{

    public function testGetAllQuiz() {
        $response = $this->call('GET', 'quiz');

        $this->assertEquals(200, $response->status());
    }

}
