@isset ($product)
<div class="col-md-12">
    <h1>{{ $product->name }}</h1>
    <table class="table">
        <tbody>
        <tr>
            <th>
                Поле
            </th>
            <th>
                Значение
            </th>
        </tr>
        <tr>
            <td>ID</td>
            <td>{{ $product->id}}</td>
        </tr>
        <tr>
            <td>Код</td>
            <td>{{ $product->alias }}</td>
        </tr>
        <tr>
            <td>Название</td>
            <td>{{ $product->title }}</td>
        </tr>
        <tr>
            <td>Описание</td>
            <td>{{ $product->text }}</td>
        </tr>
        <tr>
            <td>Картинка</td>
            <td>
                {!! Html::image(Storage::url($product->img), '',['height'=>'240px']) !!}
            </td>
        </tr>
        <tr>
            <td>Категория</td>
            <td>{{ $product->category->title }}</td>
        </tr>
        <tr>
            <td>Лейблы</td>
            <td>
                @if($product->isNew())
                    <span class="badge badge-success">Новинка</span>
                @endif

                @if($product->isRecomend())
                    <span class="badge badge-warning">Рекомендуем</span>
                @endif

                @if($product->isHit())
                    <span class="badge badge-danger">Хит продаж!</span>
                @endif
            </td>
        </tr>
        </tbody>
    </table>
</div>
@endisset