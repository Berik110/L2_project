@extends('layout.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 mt-4 mx-auto">

            <?php
            if(isset($_GET['succes']) && $_GET['succes']=='1'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Ваше объявление добавлено!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            }
            ?>

            <form action="{{route('toAddAdv')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{$user->id}}">
                    <div class="form-group">
                        <label>Категория</label>
                        <select class="form-control" name="category_id" id="category">
                            <option>Выбрать</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">
                                    {{$category->name}}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Подкатегория</label>
{{--                        <select class="form-control" name="subcategory_id" id="subcategory">--}}
{{--                            <option value="0">Выбрать</option>--}}
{{--                            @foreach($subcategories as $subcategory)--}}
{{--                                <option value="{{$subcategory->id}}">--}}
{{--                                    {{$subcategory->name}}--}}
{{--                                </option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
                        <select class="form-control" name="subcategory_id" id="subCategory">
                            <option value="0">Выбрать</option>
                        </select>
                        @error('subcategory_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Наименование Продукта</label>
                        <input type="text" class="form-control" name="name">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Описание Продукта</label>
                        <textarea class="form-control" name="description" rows="2"></textarea>
                        @error('description')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Цена (за 1кг, 1л, 1 шт.)</label>
                        <input type="text" class="form-control" name="price">
                        @error('price')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Количество (в кг, литрах, шт.)</label>
                        <input type="text" class="form-control" name="count">
                        @error('count')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="custom-file">
                        <input name="productImage" type="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Выбрать файл</label>
                    </div>
                    <div class="form-group text-right mt-3">
                        <button class="btn btn-success">Добавить</button>
                    </div>
            </form>
        </div>
    </div>
@endsection

{{--@section('custom.js')--}}
{{--    <script type="text/javascript">--}}
{{--        $.ajaxSetup({--}}
{{--            headers: {--}}
{{--                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--            }--}}
{{--        });--}}

{{--        $(document).ready(function () {--}}
{{--            $('#category').on('change',function(e) {--}}
{{--                var cat_id = e.target.value;--}}

{{--                $.ajax({--}}
{{--                    url:"{{ route('subcat') }}",--}}
{{--                    type:"POST",--}}
{{--                    data: {--}}
{{--                        cat_id: cat_id--}}
{{--                    },--}}

{{--                    success:function (data) {--}}
{{--                        $('#subcategory').empty();--}}
{{--                        $.each(data.subcategories[0].subcategories,function(index,subcategory){--}}

{{--                            $('#subcategory').append('<option value="'+subcategory.id+'">'+subcategory.name+'</option>');--}}
{{--                        })--}}

{{--                    },--}}
{{--                    error:--}}
{{--                })--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--@endsection--}}
@section('custom.js')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            $('#category').change(function () {
                var id = $(this).val();

                $('#subCategory').find('option').not(':first').remove();

                $.ajax({
                    url:'categories/'+id,
                    type:'get',
                    dataType:'json',
                    success:function (response) {
                        var len = 0;
                        if (response.data != null) {
                            len = response.data.length;
                        }

                        if (len>0) {
                            for (var i = 0; i<len; i++) {
                                var id = response.data[i].id;
                                var name = response.data[i].name;

                                var option = "<option value='"+id+"'>"+name+"</option>";

                                $("#subCategory").append(option);
                            }
                        }
                    }
                })
            });
        });
    </script>
@endsection
