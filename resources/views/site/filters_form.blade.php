{!! Form::open(['url'=>route('home'), 'method'=>'GET']) !!}
    <div class="filters row">
        <div class="col-sm-6 col-md-3">
            <label for="price_from">Цена от                    
                <input type="text" name="price_from" id="price_from" size="6" value="{{ request()->has('price_from') ? request()->input('price_from') : null }}">
            </label>
            <label for="price_to">до                    
                <input type="text" name="price_to" id="price_to" size="6"  value="{{ old('price_to') }}">
            </label>
        </div>
        <div class="col-sm-2 col-md-2">
            <label for="hit">
                {!! Form::checkbox('hit', 'on', request()->has('hit') ? true : false) !!} Хит                
            </label>
        </div>
        <div class="col-sm-2 col-md-2">
            <label for="new">
                {!! Form::checkbox('new', 'on', request()->has('new') ? true : false) !!} Новинка                
            </label>
        </div>
        <div class="col-sm-2 col-md-2">
            <label for="recommend">
                {!! Form::checkbox('recommend', 'on', request()->has('recommend') ? true : false) !!}Рекомендуем                
            </label>
        </div>
        <div class="col-sm-6 col-md-3">
            {!! Form::button('Фильтр', ['type'=>'submit', 'class'=>'btn btn-primary']) !!}
            <a href="{{ route('home') }}" class="btn btn-warning">Сброс</a>
        </div>
    </div>  
{!! Form::close() !!}