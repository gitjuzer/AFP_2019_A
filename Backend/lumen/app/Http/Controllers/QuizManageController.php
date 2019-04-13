<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizManageController extends Controller {

    public function insertQuiz(Request $request) {
        $name = $request->input('name');

        $insertedId = app('db')->table('test')->insertGetId(['name' => $name]);
        return response()->json($insertedId);
    }

}
