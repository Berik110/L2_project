@extends('layout.app')
@section('content')

    <div class="row mt-4 justify-content-center" style="min-height: 400px">
        <div class="col-md-9 mx-auto">
            <h3 class="text-center">Личный кабинет {{$user->name}}</h3>
            <p class="font-weight-bold mt-3">ваши объявления: </p>
            <table class="table table-hover">
                <tr>
                    <th>НАИМЕНОВАНИЕ ТОВАРА</th>
                    <th>ОПИСАНИЕ</th>
                    <th>ЦЕНА</th>
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

    </div>
@endsection

