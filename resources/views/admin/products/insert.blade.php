
<!-- Modal -->
<div class="modal fade" id="addProduct" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('admin.productInsert')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{$user->id}}">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Создать Продукт</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <select class="form-control" name="category_id" id="category">
                            <option>Выбрать категорию</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">
                                    {{$category->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="subcategory_id" id="subCategory">
                            <option value="0">Выбрать подкатегорию</option>
{{--                            @foreach($subcategories as $subcategory)--}}
{{--                                <option value="{{$subcategory->id}}">--}}
{{--                                    {{$subcategory->name}}--}}
{{--                                </option>--}}
{{--                            @endforeach--}}
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
                        <label>Цена (за 1кг, 1л)</label>
                        <input type="text" class="form-control" name="price">
                        @error('price')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Количество (в кг, литрах)</label>
                        <input type="text" class="form-control" name="count">
                        @error('count')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="custom-file">
                        <input name="productImage" type="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Выбрать файл</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button class="btn btn-primary">Добавить</button>
                </div>
            </form>
        </div>
    </div>
</div>

