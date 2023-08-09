<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
/*
    這是因為 user 有預設載入 Notifiable
    所以 user model 可以恣意使用 notify() 的 operator
*/
use Illuminate\Notifications\Notifiable;
use App\Models\Cart;
use App\Models\Order;

/*
[Auth]
https://laravel.com/docs/10.x/passport#installation

composer require laravel/passport
or
composer require laravel/passport -W

php artisan migrate 先為了這個套件，把資料庫裝一些Table
php artisan passport:install 

*/
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function favorite_products()
    {
        return $this->belongsToMany(Product::class, 'favorites');
    }
    /**
     * pa tinker
     * User::find(1)->favorite_products
     * User::find(1)->favorite_products->dd()
     */
}
