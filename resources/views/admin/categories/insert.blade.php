
<!-- Modal -->
<div class="modal fade" id="addCategory" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form enctype="multipart/form-data" action="{{route('admin.categoryInsert')}}" method="post">
            @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Создать Категорию</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Наименование Категории</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="custom-file">
                        <input name="categoryImage" type="file" class="custom-file-input" id="customFile">
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
