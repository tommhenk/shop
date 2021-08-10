@if ($products)
<div class="col-md-12">
    <h1>Товары</h1>
    <table class="table">
        <tbody>
        <tr>
            <th>
                #
            </th>
            <th>
                Псевдоним
            </th>
            <th>
                Название
            </th>
            <th>
                Категория
            </th>
            <th>
                Кол-во товарных предложений
            </th>
            <th>
                Действия
            </th>
        </tr>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id}}</td>
                <td>{{ $product->alias }}</td>
                <td>{!! Html::link(route('admin_edit_products', $product), $product->title, ['alt'=>$product->title]) !!}</td>
                <td>{{ $product->category->title }}</td>
                <td></td>
                <td>
                    <div class="btn-group inline-group" role="group">
                        <form action="{{ route('admin_destroy_products', ['product'=>$product->id]) }}" method="POST">
                            {!! Html::link(route('admin_show_products', $product), 'Открыть', ['class'=>'btn btn-success', 'type'=>'button']) !!}
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-danger" type="submit" value="Удалить"></form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
    <a class="btn btn-success" type="button" href="{{ route('admin_create_products') }}">Добавить товар</a>
</div>
@endif