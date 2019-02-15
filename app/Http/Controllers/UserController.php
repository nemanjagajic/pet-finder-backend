<?php

namespace App\Http\Controllers;

use App\Services\UserService;
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


    public function getById($id)
    {
        return User::where('id', $id)->get();
    }

    /**
     * Registers given user
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $user = UserService::register($request);

        if ($user !== null) {
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
        return UserService::login($request);
    }

}
