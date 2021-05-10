@extends('layout.app')
@section('content')
    @if($product!=null)
        <div class="row">
            <div class="col-md-12 mt-3 pl-5">
                <nav aria-label="breadcrumb" >
                    <ol class="breadcrumb" style="background-color: white">
                        <li class="breadcrumb-item"><a href="{{'/'}}">Главная страница</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/subcategories?category_id='.$product->subcategory->category->id)}}">{{(($product)?$product->subcategory->category->name:'')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/products?subcategory_id='.$product->subcategory->id)}}">{{$product->subcategory->name}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page" style="color:orangered">
                            Детали - {{$product->subcategory->name}} {{$product->name}}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div style="min-height: 350px">
            <div class="row mt-3 justify-content-center">

                <div class="card mb-3" style="width: 80%;">
                    <div class="row no-gutters">
                        <div class="col-md-5 my-auto">
                            <img src="{{$product->images->first()['url']}}" width="100%" style="margin-left: 10px">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h5 class="card-title">{{$product->subcategory->name}} - {{$product->name}}</h5>
{{--                                <p class="card-text font-weight-bold">Цена: {{number_format($product->price,0,'.','.')}} тг.</p>--}}
                                <p class="card-text font-weight-bold">Цена: {{$product->price}} тг.</p>
                                <p class="card-text">{{$product->description}}</p>
                                <p class="card-text"><small class="text-muted">От: {{$product->user->name}} / Тел.: {{$product->user->tel}}</small></p>
                                <p class="card-text"><small class="text-muted">Дата публикации: {{$product->created_at}}</small></p>
                                @auth
                                    @if($user->id==$product->user_id)
                                        <a href="{{url('/details/change/'.$product->id)}}" class="btn btn-outline-info">Редактировать</a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <h3 class="display-4 text-center" style="margin-top: 100px">404 page not found</h3>
    @endif
@endsection


