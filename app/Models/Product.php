<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
    /*
        Product::find(1)->cartItems
        這時候會拿到 collection, 因為 一對多
    */
    /*
        資料邏輯
    */
    public function checkQuantity($quantity)
    {
        if ($this->quantity < $quantity) {
            return false;
        }

        return true;
    }

    public function orderItems()
    {
        // 代表有非常多 訂單 下面的 訂貨，貨源是這個產品
        return $this->hasMany(OrderItem::class);
    }

    public function favorited_users()
    {
        // 第二個參數：針對哪個標去查詢
        return $this->belongsToMany(User::class, 'favorites');
    }
}
