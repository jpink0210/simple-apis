<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// php artisan make:model CartItem

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['quantity'];
    protected $appends = ['current_price'];

    public function getCurrentPriceAttribute()
    {
        return $this->quantity * 10;
    }

}
/*
    eloquent 好處一： update 會自動幫你 update 時間, timestamp

    1.
    php artisan make:model CartItem
    2.
    composer dump-autoload  : 用於重新讀取全部檔案，確保
    3.
    php artisan tinker (>>>>  代表在 tinker 下面)
    可以直接執行 ORM 的相關操作測試
    「Model 如果有被修改，tinker要重新開啟，才會有用！！」
    ex:
    >>>> CartItem::all()
    >>>> CartItem::where('id','>',3)->get()
    >>>> CartItem::find(7)

    Mass Assignment (他稱呼這是 attribute 的概念)
    $fillable 白名單功能 
    $guarded 黑名單功能 
    protected $guarded = ['']; 這是個招，所有欄位開啟的意思
    $hidden 是不想要展露出去給人家看的欄位

    getCurrentPriceAttribute 是 php 專用函式
    >>>> CartItem::find(7)->current_price
*/