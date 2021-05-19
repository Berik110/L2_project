@extends('layout.app')
@section('content')
    <div class="row mt-2">
        <div class="col-sm-12">
            <h3 class="text-center">Личный кабинет {{$user->name}}</h3>
        </div>
    </div>
    <div class="row mt-4 justify-content-center" style="min-height: 400px">
        <div class="col-sm-6 mx-auto">
            <p class="font-weight-bold text-center">Мои объявления:</p>
            <table class="table">
                <tr>
                    <th>Наменование товара</th>
                    <th>Описание</th>
                    <th>Цена</th>
                </tr>
                <tbody>
                    @foreach($products as $product)
                        @if($product->user_id==$user->id)
                        <tr>
                            <td><a href="{{route('details', ['product_id'=>$product->id])}}">{{ $product->name }}</a></td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->price }}</td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
{{--        <div class="col-sm-6 mx-auto">--}}
{{--            <p class="font-weight-bold text-center">Мои заказы:</p>--}}
{{--            <table class="table">--}}
{{--                <tr>--}}
{{--                    <th>НАИМЕНОВАНИЕ ТОВАРА</th>--}}
{{--                    <th>ОПИСАНИЕ</th>--}}
{{--                    <th>ЦЕНА</th>--}}
{{--                </tr>--}}
{{--                <tbody>--}}
{{--                @foreach($orders as $order)--}}
{{--                        <tr>--}}
{{--                            <td><a href="{{route('details', ['product_id'=>$order->id])}}">{{ $order->name }}</a></td>--}}
{{--                            <td>{{ $order->name }}</td>--}}
{{--                            <td>{{ $order->price }} тг.</td>--}}
{{--                        </tr>--}}
{{--                @endforeach--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--        </div>--}}

    </div>
@endsection

