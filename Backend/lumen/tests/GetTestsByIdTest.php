<?php

use Laravel\Lumen\Testing\DatabaseMigrations;

use Laravel\Lumen\Testing\DatabaseTransactions;


class GetTestsByIdTests extends TestCase
{
    public function testTestAllQuiz() {
        $response = $this->call('GET', '/tests');
        $this->assertEquals(200, $response->status());
    }
    public function testTestQuizById() {
        $response = $this->call('GET', '/tests', ['id' => 1]);
        $this->assertEquals(200, $response->status());
    }
}