<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dataPerPage = 10;
        $productCount = Product::count();
        $productPages = ceil($productCount / $dataPerPage);
        $currentPage = isset($request->all()['page']) ? $request->all()['page'] : 1;
        $products = Product::orderBy('id')
                       ->offset($dataPerPage * ($currentPage - 1))
                       ->limit($dataPerPage)
                       ->get();

        return view('admin.products.index', ['products' => $products,
                                           'productCount' => $productCount,
                                           'productPages' => $productPages]);
    }

    public function uploadImage(Request $request)
    {
        // file('product_image') 這是 file 格式下，放圖片的地方，你可以 dd($request)
        $file = $request->file('product_image');
        $productId = $request->input('product_id', null);
        if (is_null($productId)) {
            return redirect()->back()->withErrors(['msg' => '參數錯誤']);
        }
        $product = Product::find($productId);

        // 這裡的 store 是儲存在專案的 public 路徑之下
        $path = $file->store('public/images');
        $product->images()->create([
            'filename'        => $file->getClientOriginalName(),
            'path'            => $path,
        ]);

        return redirect()->back();
    }
}
