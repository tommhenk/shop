@if ($products)
<div class="row">
    @foreach ($products as $product)
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
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
            {!! Html::image(Storage::url($product->img), '',['height'=>'240px']) !!}
            <div class="caption">
                <h3>{{ $product->title }}</h3>
                <p>{{ $product->price }} грн</p>
                <p>
                {!! Form::open(['url'=>route('addBasket', ['product'=>$product->id]), 'method'=>'POST']) !!}
                {!! Form::button('В корзину', ['class'=>'btn btn-primary', 'type'=>'submit', 'role'=>'button']) !!}
                {!! Html::link(route('indexProduct', ['cat_name'=>$product->category->alias, 'product'=>$product->id]), 'Подробнее', ['class'=>'btn btn-default', 'role'=>'button']) !!}
                {!! Form::close() !!}
                </p>
            </div>
        </div>
    </div>
    @endforeach
</div>
@if ($products->lastPage() >1)
    <nav>
        <ul class="pagination">
            @if ($products->currentPage() > 1)
                <li class="page-item" aria-label="pagination.previous">
                    <a class="page-link" href="{{ $products->previousPageUrl() }}" rel="previous" aria-label="pagination.previous">&lsaquo;</a>
                </li>
            @endif

            @for ($i = 1; $i <= $products->lastPage(); $i++)
                <li class="page-item">
                    <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            @if ($products->currentPage() < $products->lastPage())
            <li class="page-item">
                <a class="page-link" href="{{ $products->nextPageUrl() }}" rel="next" aria-label="pagination.next">&rsaquo;</a>
            </li>
            @endif
            
            
       </ul>
    </nav>
@endif
 
@endif
