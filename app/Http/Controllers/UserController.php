<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Returns all users
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::get();
    }

    /**
     * Registers given user
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'fullName' => 'required',
            'password' => 'required'
        ]);

        // Return error if username already exists

        if (sizeof(User::where('username', $request->username)->get()) > 0) {
            return response("Username already exists", 409);
        }

        $user = new User;
        $user->username = $request->username;
        $user->fullName = $request->fullName;
        $user->password = $request->password;
        $user->phoneNumber = $request->phoneNumber;

        if ($user->save()) {
            return response($user, 200);
        }
    }

    /**
     * Checks request parameters and tries to log in
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $fetchedUsers = User::where('username', $request->username)->get();
        if (sizeof($fetchedUsers) === 0) {
            return response('Username doesn\'t exist', 404);
        }

        if ($fetchedUsers[0]->password !== $request->password) {
            return response('Incorrect password', 401);
        }

        return response('Successfully logged in', 200);
    }

}
