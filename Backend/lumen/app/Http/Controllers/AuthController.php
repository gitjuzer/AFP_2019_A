<?php

namespace App\Http\Controllers;

class AuthController extends Controller {

    public function register() {
        $data = json_decode(file_get_contents("php://input"), true);
        $user = $data['user'];

        if (!$this->checkIfUserExists($user)) {
            $password = $data['password'];
            $email = $data['email'];
            $token = uniqid('');

            $result = app('db')->insert('INSERT INTO `user`(`username`, `password`, `email`, `token`) VALUES (?,?,?,?)', [$user, $password, $email, $token]);

            return response()->json(['status' => 1, 'status_message' => 'User registered.']);
        } else {
            return response()->json(['status' => 0, 'status_message' => 'User failed to register.']);
        }
    }

    private function checkIfUserExists($user) {
        $result = app('db')->select('SELECT username FROM user WHERE username=?', [$user]);
        if ($result != null && !empty($result)) {
            return true;
        } else {
            return false;
        }
    }

}
