<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
    /*
        因為有新建新的檔案，tinker 之前，要跑一下 composer dump-autoload

        >>> Cart::all() // 看一下有什麼可以用
        >>> Cart::find(1)->cartItems

    */
}
