<?php

namespace App\Observers;

use App\Models\Product;

/**
 * 針對某個 model 做觀察者，crud 都會監聽
 * pa make:observer ProductObserver --model=Product
 */

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        //
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        //
        /**
         * pa tinker
         * Product::first()->update(['quantity'=>40])
         * 
         * dd 出來之後的 # 的項目都可以 get
         * changes -> getChanges();
         * original -> getOriginal();
         */
        // dd($product);
        $changes = $product->getChanges();
        if (isset($changes['quantity']) && $product->quantity > 0) {
            // pa make:notification ProductReplenish
            foreach ($product->favorited_users as $user) {
                $user->notify(new ProductReplenish($product));
            }
        }
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}
