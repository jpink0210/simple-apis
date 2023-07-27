@extends('layouts.admin_app')
@section('content')
<h2 class="my-4">產品列表</h2>
<span>產品總數: {{ $productCount }} </span>
<!-- 這是搭配 withErrors Operator, 凡事進入頁面有錯誤佇列會顯示，一次性的 -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<table>
  <thead>
    <tr>
      <td class="text-nowrap">編號</td>
      <td>標題</td>
      <td>內容</td>
      <td class="text-nowrap">價格</td>
      <td class="text-nowrap">數量</td>
      <td>圖片</td>
      <td>功能</td>
    </tr>
  </thead>
  <tbody>
    @foreach( $products as $product )
      <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->title}}</td>
        <td>{{ $product->content}}</td>
        <td>{{ $product->price}}</td>
        <td>{{ $product->quantity}}</td>
        <td class="text-nowrap">
          @if($product->image_url)
            <a href="{{ $product->image_url}}">圖片連結</a>
          @endif
        </td>
        <td>
          <input class="upload_image" data-id="{{$product->id}}" type="button" value="上傳圖片">
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
<div>
  @for ($i = 1; $i <= $productPages; $i++)
      <a href="/admin/products?page={{ $i }}">第 {{ $i }} 頁</a> &nbsp;
  @endfor
</div>


<!-- Modal -->
<div class="modal fade" id="upload_image" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4>上傳圖片</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/admin/products/uploadImage" method="post" enctype=multipart/form-data>
          <input type="hidden" id="product_id" name="product_id">
          <input type="file" id="product_image" name="product_image">
          <input type="submit" value="送出">
        </form>
      </div>
    </div>
  </div>
</div>

<script>
/*
  enctype: 強迫 上傳的檔案類型，否則只是傳一堆無用的文字串
  type="hidden" ： 不想要暴露的資料，自己用 jq 灌
  form - action 的路徑是自己設計的
  modal：習慣 modal 視窗綁 id 操作的行為

  切版流程與反思
  1. 先建立頁面架構，準確就好，細節忽略
  2. 服務流程串，設計並且串立
  3. 關鍵功能 8成先完成，最好是後端都串到端口上
  以上純粹切版，理論上都是直接完成。
*/
  $('.upload_image').click(function(){
    $('#product_id').val($(this).data('id'))
    $('#upload_image').modal()
  })
</script>
@endsection