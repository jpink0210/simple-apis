<?php

namespace App\Http\Requests;

/*
    pa make:request CreateUser
*/

class CreateUser extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    /*
        available-validation-rules
        https://laravel.com/docs/10.x/validation#available-validation-rules

        #rule-email: 
        email: 針對 user 的唯一性
        https://laravel.com/docs/10.x/validation#rule-email

        confirmed:
        https://laravel.com/docs/10.x/validation#rule-confirmed
        要兩次, 會確認 $request 裡面有沒有多一個key: password_confirmation
    */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ];
    }
}
