<?php

namespace App\Services;
use App\User;


class UserService
{
    public static function register($registerData): User
    {
        $registerData->validate([
            'username' => 'required',
            'fullName' => 'required',
            'password' => 'required'
        ]);

        // Return error if username already exists

        if (sizeof(User::where('username', $registerData->username)->get()) > 0) {
            return response("Username already exists", 409);
        }

        $user = new User;
        $user->username = $registerData->username;
        $user->fullName = $registerData->fullName;
        $user->password = $registerData->password;
        $user->phoneNumber = $registerData->phoneNumber;

        if ($user->save()) {
            return $user;
        }

        return null;
    }

    public static function login($loginData)
    {
        $loginData->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $fetchedUsers = User::where('username', $loginData->username)->get();
        if (sizeof($fetchedUsers) === 0) {
            return response('Username doesn\'t exist', 404);
        }

        if ($fetchedUsers[0]->password !== $loginData->password) {
            return response('Incorrect password', 401);
        }

        return response($fetchedUsers, 200);
    }
}