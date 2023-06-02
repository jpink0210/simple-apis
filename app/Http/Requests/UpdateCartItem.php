<?php

namespace App\Http\Requests;

// 下這行指令  php artisan make:request UpdateCartItem

// PUT http://127.0.0.1:8000/cart-items/2?quantity=14
/*
    resp:
    {
        "errors": {
            "quantity": [
                "數量請輸入 1-10"
            ]
        },
        "0": 400
    }
*/

/*
    Validators 進階使用 [二]
        這個類繼承 APIRequest, 就是為了製作 客製化的 $request
        這個客製化就是為 $request 灌上 validator 的 attribute
        authorize 要開開
*/

class UpdateCartItem extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // 這跟授權驗證有關，原本是 false 先打開
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quantity' => 'required|integer|between:1,10'

        ];
    }

    public function messages()
    {
        return [
            'quantity.between' => '數量請輸入 1-10'

        ];
    }
}
