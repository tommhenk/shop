<div class="col-md-12">
    {!! Form::open(['url'=>(isset($product) ? route('admin_update_products', $product) : route('admin_store_products')), 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
        <div>
            @isset($product)
                @method('PUT')
            @endisset
            <div class="form-group row">
                <label for="code" class="col-sm-2 col-form-label">Псевдоним: </label>
                <div class="col-sm-6">
                    @include(config('settings.theme').'.layouts.error', ['fieldName' => 'alias'])
                    {!! Form::text('alias', (isset($product) ? $product->alias : old('alias')), ['id'=>'alias', 'class'=>'form-control']) !!}
                </div>
            </div>
            <br>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Название: </label>
                <div class="col-sm-6">
                    @include(config('settings.theme').'.layouts.error', ['fieldName' => 'title'])
                    {!! Form::text('title', (isset($product) ? $product->title : old('title')), ['id'=>'title', 'class'=>'form-control']) !!}
                </div>
            </div>
            <br>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Цена: </label>
                <div class="col-sm-6">
                    @include(config('settings.theme').'.layouts.error', ['fieldName' => 'price'])
                    {!! Form::text('price', (isset($product) ? $product->price : old('price')), ['id'=>'price', 'class'=>'form-control']) !!}
                </div>
            </div>
                <br>
            <div class="form-group row">
                <label for="category_id" class="col-sm-2 col-form-label">Категория: </label>
                <div class="col-sm-6">
                    @include(config('settings.theme').'.layouts.error', ['fieldName' => 'category_id'])
                    @if ($categories)
                    {!! Form::select('category_id', $categories, isset($product) ? $product->category_id : old('category_id'), ['id'=>'category_id', 'class'=>'form-control']) !!}
                    @endif
                </div>
            </div>
            <br>
            <div class="form-group row">
                <label for="text" class="col-sm-2 col-form-label">Описание: </label>
                <div class="col-sm-6">
                    @include(config('settings.theme').'.layouts.error', ['fieldName' => 'text'])
                    {!! Form::textarea('text', isset($product) ? $product->text : old('text'), ['id'=>'text', 'cols'=>'72', 'cols'=>'7', 'class'=>'form-control']) !!}
                </div>
            </div>
                <br>
            <div class="form-group row">
                <label for="img" class="col-sm-2 col-form-label">Картинка: </label>
                <div class="col-sm-10">
                    <label class="btn btn-default btn-file">
                        Загрузить 
                        {!! Form::file('img', ['id'=>'img', 'style'=>'display: none;']) !!}
                    </label>
                </div>
            </div>
            @isset ($product->img)
            <br>
            <div class="form-group row">
                <label for="img" class="col-sm-2 col-form-label">Картинка: </label>
                <div class="col-sm-10">
                    <label class="btn btn-default btn-file">
                        {!! Html::image(Storage::url($product->img), '',['height'=>'240px']) !!}
                        {!! Form::hidden('old_img', $product->img) !!}
                    </label>
                </div>
            </div>
            @endisset
            <br>

{{--             <div class="form-group row">
                <label for="category_id" class="col-sm-2 col-form-label">Свойства товара: </label>
                <div class="col-sm-6">
                    @include(config('settings.theme').'.layouts.error', ['fieldName' => 'property_id[]'])
                    <select name="property_id[]" multiple>
                        @foreach($properties as $property)
                            <option value="{{ $property->id }}"
                                @isset($product)
                                    @if($product->properties->contains($property->id))
                                    selected
                                @endif
                                @endisset
                            >{{ $property->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <br>
 --}}
            @foreach ($properties as $field => $title)
                <div class="form-group row">
                    <label for="code" class="col-sm-2 col-form-label">{{ $title }}: </label>
                    <div class="col-sm-10">
                        {!! Form::checkbox($field, $title, (isset($product) && $product->hasProperty($title)) ? true : false ) !!}
                    </div>
                </div>
                <br>
            @endforeach
            <div class="form-group row">
            {!! Form::button('Сохранить', ['class'=>'btn btn-success form-control col-sm-10', 'type'=>'submit']) !!}
            </div>
        </div>
    {!! Form::close() !!}
</div>