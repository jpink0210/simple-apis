@extends('layouts.admin_app')
@section('content')
<h2 class="my-4">訂單管理</h2>
<span>訂單總數: {{ $orderCount }} </span>
<div>
  <a href="/admin/orders/export">匯出訂單Excel</a>
  <a href="/admin/orders/exportByShipped">匯出分類訂單Excel</a>
</div>
<table>
  <thead>
    <tr>
      <td>購買時間</td>
      <td>購買者</td>
      <td>商品清單</td>`
      <td>訂單總額</td>
      <td>是否運送</td>
    </tr>
  </thead>
  <tbody>
    @foreach( $orders as $order )
      <tr>
        <td>{{ $order->created_at }}</td>
        <td>{{ $order->user->name }}</td>
        <td>
          @foreach( $order->orderItems as $orderItem )
            {{ $orderItem->product->title }} &nbsp;
          @endforeach
        </td>
        <td>{{ isset($order->orderItems) ? $order->orderItems->sum('price') : 0 }}</td>
        <td>
          @if( $order->is_shipped )
            <p class="text-success">結單</p>
          @else
            <button class="btn btn-warning" onclick="passOrder({{ $order->id }})">核送訂單</button>
          @endif
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
<div>
  @for ($i = 1; $i <= $orderPages; $i++)
      <a href="/admin/orders?page={{ $i }}">第 {{ $i }} 頁</a> &nbsp;
  @endfor
</div>

<script>
  function passOrder (orderId) {
    var check = confirm("確認訂單？");

    if (check) {
      
      const jwtToken = $.cookie("jwt");
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          "Content-Type": "application/json",
          Authorization: `Bearer ${jwtToken}`
        },
        method: "Post",
        url: `/admin/orders/${orderId}/delivery`,
      })
      .done(function( resp ) {
        console.log(resp);
        toastr.success( "訂單結送完成");
        setTimeout(() => {
            window.location.reload();
        }, 2000);

      });
    }
  } 

</script>
@endsection

