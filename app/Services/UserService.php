<?php

namespace App\Services;
use App\User;


class UserService
{
    public function register($registerData)
    {
        $registerData->validate([
            'username' => 'required',
            'fullName' => 'required',
            'password' => 'required'
        ]);

        if (sizeof(User::where('username', $registerData->username)->get()) > 0) {
            return response("Username already exists", 409);
        }

        $user = new User;
        $user->username = $registerData->username;
        $user->fullName = $registerData->fullName;
        $user->password = $registerData->password;
        $user->phoneNumber = $registerData->phoneNumber;

        if ($user->save()) {
            return response($user, 200);
        }

        return null;
    }

    public function login($loginData)
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

    public function update($userData, $id)
    {
        $userData->validate([
            'username' => 'required',
            'fullName' => 'required',
            'password' => 'required'
        ]);

        User::where('id', $id)->update([
            'username' => $userData->username,
            'fullName' => $userData->fullName,
            'password' => $userData->password,
            'phoneNumber' => $userData->phoneNumber
        ]);

        return User::where('id', $id)->get();
    }
}