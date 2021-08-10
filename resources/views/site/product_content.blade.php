@if ($product)
    <div class="container">
        <div class="starter-template">
            <div class="labels">
                @if($product->isNew())
                    <span class="badge badge-success">Новинка</span>
                @endif

                @if($product->isRecomend())
                    <span class="badge badge-warning">Рекомендуем</span>
                @endif

                @if($product->isHit())
                    <span class="badge badge-danger">Хит продаж!</span>
                @endif
            </div>
            <h1>{{ $product->title }}</h1>
            <h2>{{ $product->category->title }}</h2>
            <p>Цена: <b>{{ $product->price }} грн</b></p>
            <img src="{{ asset(config('settings.theme')) }}/img/products/{{ $product->img }}">
            <p>{{ $product->text }}</p>
                {!! Form::open(['url'=>route('addBasket', ['product'=>$product->id]), 'method'=>'POST']) !!}
                {!! Form::button('Добавить в корзину', ['type'=>'submit', 'class'=>'btn btn-success', 'role'=>'button']) !!}
                {!! Form::close() !!}
        </div>
    </div>
@endif


