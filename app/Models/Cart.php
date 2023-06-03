<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
    /*
        因為有新建新的檔案，tinker 之前，要跑一下 composer dump-autoload

        >>> Cart::all() // 看一下有什麼可以用
        >>> Cart::find(1)->cartItems

    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function order()
    {
        // 一個使用者的一台購物車，同時只能創造一筆訂單
        return $this->hasOne(Order::class);
    }
}
