@extends('layout.app')
@section('custom.js')
    <script>
        $(document).ready(function(){
            $('.cart_button').click(function(event){
                event.preventDefault()
                addToCart();
            })
        })

        function addToCart(){
            let id = $('.details_name').data('id');
            let qty = parseInt($('#quantity_input').val())

            let total_qty = parseInt($('.cart-qty').text())
            total_qty += qty
            $('.cart-qty').text(total_qty)

            $.ajax({
                url: "{{route('addToCart')}}",
                type:"POST",
                data: {
                    id: id,
                    qty: qty
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data){
                    console.log(data)
                },
                error: function (data){
                    console.log(data)
                }
            });
        }
    </script>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 mt-3 pl-5">
            <nav aria-label="breadcrumb" >
                <ol class="breadcrumb" style="background-color: white">
                    <li class="breadcrumb-item"><a href="{{'/'}}">Главная страница</a></li>
                    <li class="breadcrumb-item"><a href="{{url('/subcategories?category_id='.$subcategory->category->id)}}">{{(($subcategory)?$subcategory->category->name:'')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$subcategory->name}}</li>
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
            <!-- отражает кол-во продуктов-->
            <span>{{($products)?"Всего: ".$products->count()." продукт(а/ов)":""}}</span>

            <div class="row justify-content-center">
                @if(count($products)==0)
                    <h3 class="mt-5 text-center">Пока данных нет</h3>
                @else
                    @foreach($products as $product)
                        <div class="card bg-light mt-3 mr-3 mb-3" style="width: 18rem;">
                            <a href="{{route('details', ['product_id'=>$product->id])}}" style="text-decoration: none; color: black; font-size: 1rem;">
                                <img src="{{$product->images->first()['url']}}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text text-center font-weight-bold details_name" data-id="{{$product->id}}">{{$product->name}}
                                        @auth
                                            @if($product->user_id==$user->id)
                                                <span class="text-danger"><i class="fas fa-flag"></i></span>
                                            @endif
                                        @endauth
                                    </p>
{{--                                    <p class="card-text text-center">От {{$product->user->name}}, тел.:{{$product->user->tel}}</p>--}}
{{--                                    <p class="card-text text-center">цена {{number_format($product->price,0,'.','.')}} тг.</p>--}}
                                    <p class="card-text text-center">цена {{$product->price}} тг.</p>
                                </div>
                            </a>
                            <hr>
                            <div class="form-group text-center">
{{--                                <select id="quantity_input">--}}
{{--                                    <option value="1">1</option>--}}
{{--                                    <option value="2">2</option>--}}
{{--                                    <option value="3">3</option>--}}
{{--                                    <option value="4">4</option>--}}
{{--                                    <option value="5">5</option>--}}
{{--                                </select>--}}
                                Количество <input id="quantity_input" type="number" min="1" value="1" style="max-width: 20%">
                                @auth
                                    <button class="btn btn-outline-success cart_button mt-2">Добавить в корзину</button>
                                @else
                                    <button class="btn btn-outline-success cart_button mt-2" data-toggle="modal" data-target="#loginModal">Добавить в корзину</button>
{{--                                    <a href="#" class="nav-link" data-toggle="modal" data-target="#loginModal">{{ __('Войти') }}</a>--}}
                                @endauth
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <div class="mx-auto">
                {{$products->appends(['product_id'=>request()->product_id])->links()}}
                {{--{{$items->links()}}--}}
            </div>
        </div>
    </div>
@endsection
