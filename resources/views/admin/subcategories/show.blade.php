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
                <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#updateSubcategory">
                    Обновить Подкатегорию
                </button>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    {{$subcategory->name}}
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="updateSubcategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('admin.subcategoryUpdate')}}" method="post">
                    @csrf
                    {{method_field('put')}}
                    <input type="hidden" name="id" value="{{$subcategory->id}}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Редактировать Подкатегорию</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <select class="form-control" name='category_id'>
                            <option value="0">Выбрать категорию</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{($category->id==$subcategory->category_id)?"selected='selected'":""}}>
                                    {{$category->name}}
                                </option>
                            @endforeach
                        </select>

                        <div class="form-group">
                            <label>Наименование</label>
                            <input type="text" class="form-control" name="name" value="{{$subcategory->name}}">
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
