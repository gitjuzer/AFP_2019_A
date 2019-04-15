<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller {

    public function register(Request $request) {
        $user = $request->input('user');
        header("Access-Control-Allow-Origin: *");

        if (!$this->checkIfUserExists($user)) {
            $password = $request->input('password');
            $email = $request->input('email');
            $token = uniqid('');

            //$result = app('db')->insert('INSERT INTO `user`(`username`, `password`, `email`, `token`) VALUES (?,?,?,?)', [$user, $password, $email, $token]);
            $insertedId = app('db')->table('user')->insertGetId(['username' => $user, 'password' => $password, 'email' => $email, 'token' => $token]);
            app('db')->insert('INSERT INTO user_role VALUES (?,?)', [$insertedId, 1]);

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

    public function login(Request $request) {
        $user = $request->input('user');
        $password = $request->input('password');

        $result = app('db')->select('SELECT token, name AS role FROM user INNER JOIN user_role ON user.id = user_role.user_id INNER JOIN role ON role.id = user_role.role_id WHERE username=? AND password=?', [$user, $password]);


        header("Access-Control-Allow-Origin: *");
        if ($result != null && !empty($result)) {
            return response()->json(['status' => 1, 'status_message' => $result[0]]);
        } else {
            return response()->json(['status' => 0, 'status_message' => 'Login failed.']);
        }
    }

}
