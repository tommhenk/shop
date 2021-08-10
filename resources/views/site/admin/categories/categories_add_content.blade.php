{!! Form::open(['url'=>(isset($category) ? route('admin_update_categories', ['category'=>$category->id]) : route('admin_store_categories')), 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
        <div>
            @isset($category)
                @method('PUT')
            @endisset
            @csrf
            <div class="form-group row">
                <label for="code" class="col-sm-2 col-form-label">Псевдоним: </label>
                <div class="col-sm-6">
                    @error('alias')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input type="text" class="form-control" name="alias" id="alias"
                           value="{{ isset($category) ? $category->alias : old('alias') }}">
                </div>
            </div>
            <br>
            <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label">Название: </label>
                <div class="col-sm-6">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input type="text" class="form-control" name="title" id="title"
                           value="{{ isset($category) ? $category->title : old('title') }}">
                </div>
            </div>

                <br>
            <div class="form-group row">
                <label for="desc" class="col-sm-2 col-form-label">Описание: </label>
                <div class="col-sm-6">
                    @error('desc')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                <textarea name="desc" id="desc" class="form-control" rows="7">
                    {{ isset($category) ? $category->desc : old('desc') }}
                </textarea>
                </div>
            </div>

            <br>

            <div class="form-group row">
                <label for="image" class="col-sm-2 col-form-label">Картинка: </label>
                <div class="col-sm-10">
                    <label class="btn btn-default btn-file">
                        Загрузить 
                        <input type="file" style="display: none;" name="img" id="img" class="form-control">
                    </label>
                </div>
            </div>
            @isset ($category)
            <div class="form-group row">
                <label for="image" class="col-sm-2 col-form-label">Картинка: </label>
                <div class="col-sm-10">

                    {!! Html::image(Storage::url($category->img)) !!}
                    {!! Form::hidden('old_img', $category->img) !!}
                </div>
            </div>
            @endisset
            <div class="form-group row">
                <div class="col-sm-2 col-form-label"></div>
                {!! Form::button('Сохранить',['class'=>'btn btn-success col-sm-6', 'type'=>'submit']) !!}
            </div>
        </div>
    {!! Form::close() !!}
</div>