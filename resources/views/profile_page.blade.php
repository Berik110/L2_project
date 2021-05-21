@extends('layout.app')
@section('content')
    <div class="row mt-2">
        <div class="col-sm-12">
            <h3 class="text-center">Личный кабинет {{$user->name}}</h3>
        </div>
    </div>
    <div class="row mt-4 justify-content-center" style="min-height: 400px">
        <div class="col-sm-4 mx-auto">
            <p class="font-weight-bold text-center">Мои объявления:</p>
            @foreach($products as $product)
                <div class="">
                    @if($product->user_id==$user->id)
                        <h5><a href="{{route('details', ['product_id'=>$product->id])}}">Наименование: {{ $product->name }}</a></h5>
                        <span>Описание: {{ $product->description }}</span>
                        <span>Цена: {{ $product->price }} тг.</span>
                        <hr/>
                    @endif
                </div>
            @endforeach

{{--            <table class="table">--}}
{{--                <tr>--}}
{{--                    <th>Наменование товара</th>--}}
{{--                    <th>Описание</th>--}}
{{--                    <th>Цена</th>--}}
{{--                </tr>--}}
{{--                <tbody>--}}
{{--                    @foreach($products as $product)--}}
{{--                        @if($product->user_id==$user->id)--}}
{{--                        <tr>--}}
{{--                            <td><a href="{{route('details', ['product_id'=>$product->id])}}">{{ $product->name }}</a></td>--}}
{{--                            <td>{{ $product->description }}</td>--}}
{{--                            <td>{{ $product->price }}</td>--}}
{{--                        </tr>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
{{--                </tbody>--}}
{{--            </table>--}}
        </div>
        <div class="col-sm-6 mx-auto">
            <p class="font-weight-bold text-center">Мои заказы:</p>
{{--            <table class="table">--}}
{{--                <tr>--}}
{{--                    <th>Наименование товара</th>--}}
{{--                    <th>Описание</th>--}}
{{--                    <th>Статус Доставки</th>--}}
{{--                    <th>Адрес</th>--}}
{{--                    <th>Цена</th>--}}
{{--                    <th>Способ оплаты</th>--}}
{{--                </tr>--}}
{{--                <tbody>--}}
{{--                @foreach($orders as $order)--}}
{{--                    <tr>--}}
{{--                        <td><a href="{{route('details', ['product_id'=>$order->id])}}">{{ $order->name }}</a></td>--}}
{{--                        <td>{{ $order->description }}</td>--}}
{{--                        <td>{{ $order->status }}</td>--}}
{{--                        <td>{{ $order->address }}</td>--}}
{{--                        <td>{{ $order->price }} тг.</td>--}}
{{--                        <td>{{ $order->payment_method }}</td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--                </tbody>--}}
{{--            </table>--}}
            @foreach($orders as $order)
                <div class="">
                    <h5>Наименование: <a href="{{route('details', ['product_id'=>$order->id])}}">{{ $order->name }}</a></h5>
                    <span>Описание: {{ $order->description }}</span><br/>
                    <span>Статус доставки: {{ $order->status }}</span><br/>
                    <span>Адрес: {{ $order->address }}</span><br/>
                    <span>Статус оплаты: {{ $order->payment_status }}</span><br/>
                    <span>Способ оплаты: {{ $order->payment_method }}</span><br/>
                    <hr/>
                </div>
            @endforeach
        </div>
    </div>
@endsection

