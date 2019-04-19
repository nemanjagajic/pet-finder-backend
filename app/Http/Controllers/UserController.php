<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return response(User::get());
    }


    public function getById($id)
    {
        return response(User::where('id', $id)->get());
    }


    public function register(Request $request)
    {
        return $this->userService->register($request);
    }


    public function login(Request $request)
    {
        return $this->userService->login($request);
    }

}
