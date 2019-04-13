<?php

namespace App\Http\Controllers;

class QuizController extends Controller {

    public function getAllQuiz() {
        return response()->json(app('db')->select('SELECT * FROM test'));
    }


}
