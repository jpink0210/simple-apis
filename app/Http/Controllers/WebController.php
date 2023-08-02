<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\User;

use App\Http\Controllers\CartController;

/*
    這也是 Laravel 預設準備的
    就是針對 notifications 這張邊的 Model
*/
use Illuminate\Notifications\DatabaseNotification;

class WebController extends Controller
{
    public $notifications = [];
    /*
        同個 route 之間有要公用的變數
        可以用 __construct 初始化存入 class 裡面
    */
    public function __construct()
    {
        // $user = auth()->user();
        // $this->notifications = $user ? $user->notifications : [];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $this->notifications = $user ? $user->notifications : [];

        $products = Product::all();

        $cart_id = 0;
        // 確認 未登入/登入 狀態
        if ($user) {
            $cart = (new CartController)->index();
            $cart_id = $cart ? json_decode($cart->content())->id : 0;
        }

        return view('webs.index', ['products' => $products, 'notifications' => $this->notifications, 'cart_id' => $cart_id ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contactUs()
    {
        $user = auth()->user();
        $this->notifications = $user ? $user->notifications : [];
        return view('webs.contact_us', ['notifications' => $this->notifications]);
    }


    /*
        Notification 有個 read_at 的變數，所謂已讀，就是將它填值(timestamp)
    */
    public function readNotification(Request $request)
    {
        $id = $request->all()['id'];
        DatabaseNotification::find($id)->markAsRead();

        return response(['result' => true]);
    }
}
