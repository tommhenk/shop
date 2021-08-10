@if ($categories)
<div class="container">
    <div class="starter-template">
        @foreach ($categories as $cat)
            <div class="panel">
            <a href="{{ route('categories.show', ['category'=>$cat->alias]) }}">
                {!! Html::image(Storage::url($cat->img)) !!}
                <h2>{{ $cat->title }} {{ $cat->products->count() }}</h2>
            </a>
            <p>
                {{ $cat->desc }}
            </p>
        </div>
        @endforeach
    </div>
</div>
@endif


