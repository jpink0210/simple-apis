<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/*
    Validators 進階使用 [一]
        先繼承 FormRequest 這個工具，針對 API 做一個 class
*/

class APIRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response(['errors'=>$validator->errors(), 400]));
    }
    
}