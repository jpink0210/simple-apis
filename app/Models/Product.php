<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
    /*
        Product::find(1)->cartItems
        這時候會拿到 collection, 因為 一對多
    */
    public function checkQuantity($quantity)
    {
        if ($this->quantity < $quantity) {
            return false;
        }

        return true;
    }
}
