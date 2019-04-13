<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizManageController extends Controller {

    public function insertQuiz(Request $request) {
        $name = $request->input('name');

        $insertedId = app('db')->table('test')->insertGetId(['name' => $name]);
        return response()->json($insertedId);
    }

    public function insertQuestion(Request $request) {
        $question = $request->input('question');
        $test = $request->input('quiz');

        $insertedId = app('db')->table('question')->insertGetId(['question' => $question, 'test' => $test, 'type' => 1]);
        return response()->json($insertedId);
    }
}
