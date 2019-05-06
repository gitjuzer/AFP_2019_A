<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{

    public function testGetAllQuiz() {
        $response = $this->call('GET', '/quiz');

        $this->assertEquals(200, $response->status());
    }

    public function testGetQuizById() {
        $response = $this->call('GET', '/quiz', ['id' => 1]);

        $this->assertEquals(200, $response->status());
    }
}
