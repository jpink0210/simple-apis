<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\CreateUser;

/*
    pa make:controller AuthController

*/
class AuthController extends Controller
{
    /*
        1. CreateUser: 老招，validator
        2. 先 new 是一個 User Model物件而已，你要 save 才會儲存
    */
    public function signup(CreateUser $request)
    {
        $validatedData = $request->validated();
        $user = new User([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password'])
        ]);
        $user->save();
        return response('success', 201);
    }
}
