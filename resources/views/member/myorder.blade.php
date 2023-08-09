<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('會員中心 - 我的訂單') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="d-flex justify-content-between">

                    </div>
                    <hr>

                    <table>
                        <thead>
                            <tr class="text-nowrap">
                                <td class="pr-4 h3">訂單狀況</td>
                                <td class="pr-4 h3">上次更新</td>
                                <td class="pr-4 h3">訂單內容</td>
                                <td class="pr-4 h3">訂單金額</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $orders as $order )
                                <tr class="border-bottom border-light">
                                    <td class="pr-4">
                                        @if($order->is_shipped)
                                            <p class="text-success font-weight-bold">已出貨</p>
                                        @else
                                            <p class="text-danger">待出貨</p>
                                        @endif
                                    </td>
                                    <td class="pr-4">{{ $order->updated_at}}</td>
                                    <td class="pr-4">
                                        <div class="py-4">
                                            @foreach( $order->orderItems as $orderItem )
                                                {{ $orderItem->product->title }}( ${{$orderItem->product->price}} ) x {{$orderItem->quantity}}
                                                @if($loop->index < count($order->orderItems) - 1)
                                                    <br />
                                                @endif
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
                                        ${{ $order->total }}
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
