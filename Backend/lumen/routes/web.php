<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->put('register', 'AuthController@register');

$router->post('login', 'AuthController@login');

$router->post('score', ['middleware' => 'auth', 'uses' => 'ToplistController@insertScore']);

$router->get('score/{quiz}', 'ToplistController@getToplistByTest');

$router->get('quiz', 'QuizController@getAllQuiz');

$router->get('quiz/{quiz}', 'QuizController@getQuizById');

$router->post('quiz', ['middleware' => 'auth', 'uses' => 'QuizManageController@insertQuiz']);

$router->post('question', ['middleware' => 'auth', 'uses' => 'QuizManageController@insertQuestion']);

$router->post('answer', ['middleware' => 'auth', 'uses' => 'QuizManageController@insertAnswer']);
