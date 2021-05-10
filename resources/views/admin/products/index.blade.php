@extends('layout.app')
@section('content')

    @include('admin.products.insert', ['subcategories'=>$subcategories])

    <div class="row mt-4" style="min-height: 500px">
        <div class="col-md-3">
            <ul class="list-group">
                <li class="list-group-item list-group-item-info" aria-disabled="true">
                    <a href="{{route('admin.index')}}" style="text-decoration: none; color: black">
                        Главная
                    </a>
                </li>
                <li class="list-group-item list-group-item-info mt-1" aria-disabled="true">
                    <a href="{{route('admin.categories')}}" style="text-decoration: none; color: black">
                        Категории
                    </a>
                </li>
                <li class="list-group-item list-group-item-info mt-1">
                    <a href="{{route('admin.subcategories')}}" style="text-decoration: none; color: black">
                        Подкатегории
                    </a>
                </li>
                <li class="list-group-item list-group-item-info mt-1">
                    <a href="{{route('admin.products')}}" style="text-decoration: none; color: black">
                        Продукты
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-md-9">

            <!-- Button trigger modal -->
            <div class="text-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProduct">
                    Добавить продукты
                </button>
            </div>

            <table class="table table-hover mt-3">
                <thead>
                <tr>
                    <th>#</th>
                    <th>name</th>
                    <th>description</th>
                    <th>price</th>
                    <th>count</th>
                    <th>Subcategory</th>
                    <th>orders</th>
                    <th>image</th>
                    <th>created at</th>
                    <th style="width: 10%">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->count}}</td>
                        <td>{{$product->subcategory->name}}</td>
                        <td>{{count($product->orders)}}</td>
                        <td><img src="/{{$product->images->first()->url}}" width="100%"></td>
                        <td>{{$product->created_at}}</td>
                        <td>
                            <a href="{{route('admin.productShow', ['id'=>$product->id])}}" class="btn btn-success mb-1">Обновить</a>
                            <form action="{{url('/admin/product/'.$product->id)}}" method="post">
                                {{method_field('delete')}}
                                @csrf
                            <input type="hidden" name="subcategory_id" value="{{$product->subcategory->id}}">
                                <button class="btn btn-danger">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
