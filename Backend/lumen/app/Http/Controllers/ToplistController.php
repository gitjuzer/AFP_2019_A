<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToplistController extends Controller {

    public function insertScore(Request $request) {
        $score = $request->input('score');
        $quiz = $request->input('quiz_id');
        $user = $request->input('user_id');

        
    }

}
