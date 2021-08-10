@if ($card)
<div class="container">
    <div class="starter-template">         
    <h1>Корзина</h1>
    <p>Оформление заказа</p>
    <div class="panel">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Название</th>
                <th>Кол-во</th>
                <th>Цена</th>
                <th>Стоимость</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($card->items as $item)
                            <tr>
                <td>
                    <a href="{{ route('indexProduct', ['cat_name'=>$item['item']->category->alias, 'product'=>$item['item']->id]) }}">
                        {!! Html::image(Storage::url($item['item']->img ), '',['height'=>'56px']) !!}
                        {{ $item['item']->title }}
                    </a>
                </td>
                <td><span class="badge">{{ $item['qty']}}</span>
                    <div class="btn-group form-inline">
                        {!! Form::open(['url'=>route('substractBasket', ['product'=>$item['item']->id]), 'method'=>'POST']) !!}
                            <button type="submit" class="btn btn-danger" href="">
                                <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                            </button>
                        {!! Form::close() !!}
                        {!! Form::open(['url'=>route('addBasket', ['product'=>$item['item']->id]), 'method'=>'POST']) !!}
                            <button type="submit" class="btn btn-success"
                                    href="">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            </button>
                        {!! Form::close() !!}
                    </div>
                </td>
                <td>{{ $item['item']->price }}</td>
                <td>{{ $item['price'] }}</td>
            </tr>
                @endforeach

            <tr>
                <td colspan="3">Общая стоимость:</td>
                <td>{{ $card->totalyPrice }}</td>
            </tr>
            </tbody>
        </table>
        <br>
        <div class="btn-group pull-right" role="group">
            <a type="button" class="btn btn-danger" href="{{ route('removeBasket') }} ">Очистить корзину</a>
        </div>
        <div class="btn-group pull-right" role="group">
            <a type="button" class="btn btn-success" href="{{ route('orderBasket') }}">Оформить заказ</a>
        </div>
    </div>
    </div>
</div>
@endif


