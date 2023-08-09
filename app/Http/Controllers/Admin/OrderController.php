<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Order;

use App\Http\Controllers\Controller;
use App\Notifications\OrderDeliver;

use App\Exports\OrdersExport;
use App\Exports\OrdersMultipleExport;
use Maatwebsite\Excel\Facades\Excel;
use App\DataTables\OrdersDataTable;


class OrderController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $dataPerPage = 5;
        /*
            whereHas: 確認你 order 下面的關聯有綁好的，才放行

            各種對 sql 直接的操作 operators
            $orderCount = Order::count();
            $orderCount = Order::sum('orderItems');
        */
        $orderCount = Order::whereHas('orderItems')->count();
        $orderPages = ceil($orderCount / $dataPerPage); // 無條件進位 vs round vs floor
        $currentPage = isset($request->all()['page']) ? $request->all()['page'] : 1;
        $orders = Order::with(['user', 'orderItems', 'orderItems.product'])
                       ->orderBy('created_at', 'desc')
                       ->offset($dataPerPage * ($currentPage - 1))
                       ->limit($dataPerPage)
                       ->whereHas('orderItems')
                       ->get();
        /*
            offset 資料起始點
            with
                1. 一般來說，畫面上會反覆操作 sql 指令，因為 orders 下面的關聯的 Model 會重拉
                    你可以用 index.blade 實測
                2. 在拉取 order sql 的時候，with 下面的參數，會先拉好
                    不會在操作的再拉，耗費 sql 效能
        */

        return view('admin.orders.index', ['orders' => $orders,
                                           'orderCount' => $orderCount,
                                           'orderPages' => $orderPages]);
    }

    public function datatables(OrdersDataTable $ordersDataTable)
    {
        return $ordersDataTable->render('admin.orders.datatables');
    }

    public function delivery($id)
    {
        $order = Order::find($id);
        if ($order->is_shipped) {
            return response(['result' => false]);
        } else {
            // 把舊的購物車 結單做註記
            $order->update(['is_shipped' => true]);
            // 順便通知
            $order->user->notify(new OrderDeliver());
            return response(['result' => true]);
            ;
        }
    }

    public function export()
    {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }

    public function exportByShipped()
    {
        return Excel::download(new OrdersMultipleExport, 'orders.xlsx');
    }
}
