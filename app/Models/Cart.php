<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Exception;

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

    /*
        Model 處理資料面的問題，資料的結構
    */
    public function checkout() {

        /*
            另外一個寫法
            DB::beginTransaction();
            try {
                // ...
                DB:commit();
                return $order;
            } catch (\Throwable $th) {
                //throw $th;
                DB::rollback();
                return 'some error msg';
            }
        */

        $result = DB::transaction(function () {

            foreach ($this->cartItems as $cartItem) {
                $product = $cartItem->product;
                if (!$product->checkQuantity($cartItem->quantity)) {
                    return response($product->title.'數量不足');
                    // 一發生錯誤就會 shut down 不會往下跑
                }
            }

            // throw new Exception("Error Processing Request", 1);

            /*
                $this->order() 就是用這個關聯，用 Order Model 創造了一個 order
                $this->user_id 這個 this 是 cart 的 this
                測試：
                    pa tinker
                    Cart::all()->first()->checkout()
                    // 會在 order table 下面產生一筆新的訂單。
            */
            $order = $this->order()->create([
                'user_id' => $this->user_id
            ]);

            $orderTotal = 0;
            foreach ($this->cartItems as $cartItem) {
                $order->orderItems()->create([
                    'product_id' => $cartItem->product_id,
                    'price' => $cartItem->product->price,
                    'quantity' => $cartItem->quantity,
                    'total' => $cartItem->product->price * $cartItem->quantity,
                ]);
                $cartItem->product->update(['quantity' => $product->quantity - $cartItem->quantity]);
                $orderTotal += $cartItem->product->price * $cartItem->quantity;
            }

            $this->order()->update([
                'total' => $orderTotal,
            ]);


            // 指這台購物車被結帳了
            $this->update(['checkouted' => true]);
            $order->orderItems; // 多這行，return 會多帶一個欄位 orderItems
            return $order;

            /*
                用人的角度來思考一下，從頭到位發生了什麼事情：

                商務邏輯：
                先找一個 user 有 checkout=0 的訂單，下單！

                資料邏輯
                1. 建立一筆 order
                2. 建立多筆 orderItems
                3. checkout=1

                反向思考：
                1. 手動改 checkout=0 就可以重新使用那台購物車了
            */
        });

        return $result;
    }
}
