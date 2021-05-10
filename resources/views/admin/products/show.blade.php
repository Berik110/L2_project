@extends('layout.app')
@section('content')

    {{--    @include('admin.subcategories.update')--}}

    <div class="row mt-4">
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
                <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#updateProduct">
                    Обновить Продукт
                </button>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    {{$product->name}}
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="updateProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('admin.productUpdate')}}" method="post">
                    @csrf
                    {{method_field('put')}}
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Редактировать данные продукта</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <button class="btn btn-success">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

