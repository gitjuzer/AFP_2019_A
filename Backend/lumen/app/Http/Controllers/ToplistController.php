<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToplistController extends Controller {

    public function insertScore(Request $request) {
        $score = $request->input('score');
        $quiz = $request->input('quiz_id');
        $user = $request->input('user_id');

        $result = app('db')->insert('INSERT INTO score (score, test_id, user_id) VALUES (?, ?, ?)', [$score, $quiz, $user]);

        if ($result) {
            return response()->json(['status' => 1, 'status_message' => 'Score submitted.']);
        } else {
            return response()->json(['status' => 0, 'status_message' => 'Score submit failed.']);
        }
    }

    public function getToplistByTest($quiz) {
        $result = app('db')->select('SELECT username, score FROM score INNER JOIN user ON score.user_id = user.id WHERE test_id=? ORDER BY 2 DESC', [$quiz]);
        return response()->json($result);
    }
}
