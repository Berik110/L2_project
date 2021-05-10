@extends('layout.app')
@section('content')
    @if($product!=null)
        <div class="row">
            <div class="col-md-12 mt-3">
                <nav aria-label="breadcrumb" >
                    <ol class="breadcrumb" style="background-color: white">
                        <li class="breadcrumb-item"><a href="{{'/'}}">Главная страница</a></li>
                        <li class="breadcrumb-item"><a href="{{route('subcategories', ['category_id'=>$product->category_id])}}">Техника-оборудования</a></li>
                        <li class="breadcrumb-item"><a href="{{route('details', ['product_id'=>$product->id])}}">
                                Детали - {{$product->subcategory->name}} {{$product->name}}
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Редактирование данных
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row mt-3 justify-content-center">
            <div class="col-md-6 mx-auto">

                <div class="card form-group">
                    <img src="/{{$product->images->first()['url']}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <form action="{{url('/details/change/img')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{method_field('put')}}
                            <input type="hidden" name="id" value="{{$product->id}}">
                            <div class="custom-file">
                                <input name="image" type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Выбрать файл</label>
                            </div>
                            <button class="btn btn-primary mt-3">Загрузить</button>
                        </form>
                    </div>
                </div>

                <form action="{{route('updateProduct')}}" method="post">
                    @csrf
                    {{method_field('PUT')}}
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    <div class="form-group">
                        <select class="form-control" name="category_id" id="category_id" onchange="loadSubcat();">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{($category->id==$product->subcategory->category->id)?"selected='selected'":""}}>
                                    {{$category->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="subcategory_id">
                            @foreach($subcategories  as $subcategory)
                                <option value="{{$subcategory->id}}" {{($subcategory->id==$product->subcategory_id)?"selected='selected'":""}}>
                                    {{$subcategory->name}}
                                </option>
                            @endforeach
                        </select>
                        @error('subcategory_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Наименование Продукта</label>
                        <input type="text" class="form-control" name="name" value="{{$product->name}}">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Описание Продукта</label>
                        <textarea class="form-control" name="description" rows="2">{{$product->description}}</textarea>
                        @error('description')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Цена (за 1кг, 1л)</label>
                        <input type="text" class="form-control" name="price" value="{{$product->price}}">
                        @error('price')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Количество (в кг, литрах)</label>
                        <input type="text" class="form-control" name="count" value="{{$product->count}}">
                        @error('count')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group text-right mt-3">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                            Удалить
                        </button>
                        <button type="submit" class="btn btn-success">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="deleteModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{route('todeleteProduct')}}" method="post">
                    @csrf
                    {{method_field('delete')}}
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Удаление объявления</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Вы действительно хотите удалить?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                            <button class="btn btn-primary">Удалить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @else
        <h3 class="display-4 text-center" style="margin-top: 100px">404 page not found</h3>
    @endif
@endsection
