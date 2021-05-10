@extends('layout.app')
@section('content')

    <div class="row" style="background-image: url('img/0.jpg'); min-height: 550px">

        <div class="col-7 mx-auto">
            <form action="{{url('/product/search')}}" method="get">
                @csrf
            <div class="input-group" style="margin-top: 240px">
                <input type="search" name="key" class="form-control" placeholder="Наименование продукта" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-success naiti" data-order="name-tov">Найти</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <h4 class="text-center mt-5">Категории</h4>

    <div class="row justify-content-center" style="margin: 50px">
        @foreach($categories as $category)
        <div class="card mr-4 mb-4" style="width: 19rem;">
            <a href="{{route('subcategories', ['category_id'=>$category->id])}}" style="text-decoration-color: #2d995b; color: black">
            <img src="/{{$category->category_url}}" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text text-center">{{$category->name}}</p>
            </div>
            </a>
        </div>
        @endforeach
    </div>
@endsection

@section('custom.js')
{{--    <script>--}}
{{--        $(document).ready(function (){--}}
{{--            $('.naiti').click(function (){--}}
{{--                let orderBy = $(this).data('order')--}}

{{--                $.ajax({--}}
{{--                    url: "route('productsBySubcategory', $subcategories->name)",--}}
{{--                    type:"GET",--}}
{{--                    data: {--}}
{{--                        orderBy: orderBy--}}
{{--                    },--}}
{{--                    headers: {--}}
{{--                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                    },--}}
{{--                    success: function (data){--}}
{{--                        $('.class').html(data)--}}
{{--                    }--}}
{{--                });--}}
{{--            })--}}
{{--        })--}}
{{--    </script>--}}
@endsection
