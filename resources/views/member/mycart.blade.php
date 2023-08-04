<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('會員中心 - 我的購物車') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- {{$cartItems}} -->
                    <!-- {{count($cartItems)}} -->
                    <div class="d-flex justify-content-between">

                        <div class="h2">購物車總金額: ${{$total}}</div>
                        <button class="btn btn-lg btn-success">結帳</button>
                    </div>
                    <hr>
                    <table>
                        <thead>
                            <tr class="text-nowrap">
                                <td class="pr-4 h3">商品名稱</td>
                                <td class="pr-4 h3">購置數量</td>
                                <td class="pr-4 h3">商品單價</td>
                                <td class="pr-4 h3">Count</td>
                                <td class="pr-4 h3"></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $cartItems as $cartItem )
                            <tr>
                                <td class="pr-4">{{ $cartItem->product->title}}</td>
                                <td class="pr-4">{{ $cartItem->quantity}}</td>
                                <td class="pr-4">{{ $cartItem->product->price}}</td>
                                <td class="pr-4">{{ $cartItem->quantity * $cartItem->product->price}}</td>
                        
                                <td class="pr-4">
                                    <button class="btn btn-warning" onclick="removeCartItem({{ $cartItem->id }})">移除商品</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function removeCartItem( cartItemId ) {
        var check = confirm("確定刪除？");

        if (check) {
            const jwtToken = $.cookie("jwt");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    "Content-Type": "application/json",
                    Authorization: `Bearer ${jwtToken}`
                },
                method: "delete",
                url: `/cart_items/${cartItemId}`
            })
            .done(function( resp ) {
                console.log(resp);
                window.location.reload();
            });
        }
    }

</script>