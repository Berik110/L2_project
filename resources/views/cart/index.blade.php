@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-md-12 mt-3 pl-5">
            <nav aria-label="breadcrumb" >
                <ol class="breadcrumb" style="background-color: white">
                    <li class="breadcrumb-item"><a href="{{'/'}}">Главная страница</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Корзина</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="row justify-content-center mt-2" style="min-height: 600px">
        <div class="col-md-3 pl-5" style="border-radius: 5px; max-height: 500px">
            <div class="list-group">
                {{--<a href="#" style="background-color: orange; color: white" class="list-group-item list-group-item-action" aria-current="true">--}}
                {{--Категории--}}
                {{--</a>--}}
                @foreach($categories as $category)
                    <a href="{{route('subcategories', ['category_id'=>$category->id])}}" style="background-color: rgba(45,180,64,0.65);color: white" class="list-group-item list-group-item-action">{{$category->name}}</a>
                @endforeach
            </div>
        </div>

        {{--основной контент--}}
        <div class="col-md-9">
            <div class="row justify-content-center">


            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <div class="mx-auto">
{{--                {{$products->appends(['product_id'=>request()->product_id])->links()}}--}}
                {{--{{$items->links()}}--}}
            </div>
        </div>
    </div>
@endsection

