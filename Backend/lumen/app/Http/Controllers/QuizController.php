<?php

namespace App\Http\Controllers;

class QuizController extends Controller {

    public function getAllQuiz() {
        return response()->json(app('db')->select('SELECT * FROM test'));
    }

    public function getQuizById($quiz) {
        $questions = app('db')->select('SELECT * FROM question WHERE test=?', [$quiz]);
        $length = count($questions);

        for ($i = 0; $i < $length; $i++) {
            $answers = app('db')->select('SELECT * FROM answer WHERE question=?', [$questions[$i]->id]);
            $questions[$i]->answers = $answers;
        }

        return response()->json($questions);
    }
}
