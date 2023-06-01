<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// php artisan make:model CartItem

class CartItem extends Model
{
    use HasFactory;
    /*
        去設定 黑白名單，這個行為稱作
        Eloquent ORM 的 Mass Assignment
    */
    protected $guarded = ['']; // 黑名單不擋 全開
    // protected $hidden = ['updated_at', 'xxxx']; // 不想要被露出的欄位

    // protected $fillable = ['quantity']; // 也不限制僅能改變的欄位，或是你去加 *


    protected $appends = ['current_price']; // 這是設定自製屬性
    // 這個函式名稱是 專用的 命名法 get Xxxxx Attribute
    public function getCurrentPriceAttribute()
    {
        return $this->quantity * 10;
    }

    /*
        Eloquent 建立關聯
    */
    // 當你執行 CartItem 下 product 的函式，他會去找 Product 類別下對應的 product
    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function cart() {
        return $this->belongsTo(Cart::class);
    }
    /*
        測試
        php artisan tinker
        >>>> CartItem::find(3)

        >>>> CartItem::find(3)->product()
                                這就是執行 product 這個 public function
                                但寫到這裏，他只會跟你說，這是一個 function
        >>>> CartItem::find(3)->product()->get()
                                get()之後，就會拿到「含有」對應的 product_id 之 product
                                的 「collection」
                                e.g. [ {id: 2, ...} ]
        >>>> CartItem::find(3)->product()->get()->first()
            這個才是該 product_id 的 product，所有的 attribute
        然後
        >>>> CartItem::find(3)->product
        執行這行，跟上面這個是一模一樣的。
        沒有括號就是「屬性」所以只有一筆，上面是集合，所以要取 first

        主要也是 belongs 是 Ｘ對一

        */
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