@isset ($category)
<div class="col-md-12">
    <h1>Категория {{ $category->title }}</h1>
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
            <td>{{ $category->id }}</td>
        </tr>
        <tr>
            <td>Псевдоним</td>
            <td>{{ $category->alias }}</td>
        </tr>
        <tr>
            <td>Название</td>
            <td>{{ $category->title }}</td>
        </tr>
        <tr>
            <td>Описание</td>
            <td>{{ $category->desc }}</td>
        </tr>
        <tr>
            <td>Картинка</td>
            <td>{{-- <img src="{{ asset(config('settings.theme')) }}/img/categories/{{$category->img}}"
                     height="240px"> --}}
                 <img src="{{ Storage::url($category->img)}}"
                     height="240px">
            </td>
        </tr>
        <tr>
            <td>Кол-во товаров</td>
            <td>{{ $category->products->count() }}</td>
        </tr>
        </tbody>
    </table>
</div>
@endisset