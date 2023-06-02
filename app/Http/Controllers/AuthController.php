<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\CreateUser;

use Illuminate\Support\Facades\Auth;


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

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if (!Auth::attempt($validatedData)) {
            return response('Unauthorized', 401);
        }
        // auth 套件的功能，如果 login 成功，自動把資料帶入 $request 裡面
        $user = $request->user();

        // createToken 是 HasApiTokens 我們自己當初加的功能(官網)
        // composer require lcobucci/jwt:3.3.3
        $tokenResult = $user->createToken('Token');
        // token->save(); 當初安裝，就有幫 token 裝一個 table 來儲存 token
        $tokenResult->token->save();

        return response(['token' => $tokenResult->accessToken]);
        // jwt.io 可以解譯
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        // revoke 也是這個 套件api 的功能，直接使其失效，讓 table 的 revoke = 1
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
