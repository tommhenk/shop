@if (!empty($categories))
<div class="container">
    <div class="starter-template">         
    <div class="panel">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Псевдоним</th>
                <th>Название</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $category->alias }}
                    </td>
                    <td>
                        {!! Html::link(route('admin_edit_categories', ['category'=>$category->id]), $category->title, ['alt'=>$category->title]) !!}
                    </td>
                    <td>
                        <div class="btn-group form-inline">
                            {!! Form::open(['url'=>route('admin_show_categories', ['category'=>$category->id]), 'method'=>'GET']) !!}
                                {!! Form::button('Открыть', ['class'=>'btn btn-success', 'type'=>'submit']) !!}
                            {!! Form::close() !!}
                            {!! Form::open(['url'=>route('admin_destroy_categories', ['category'=>$category->id]), 'method'=>'POST']) !!}
                                {!! Form::button('Удалить', ['class'=>'btn btn-danger', 'type'=>'submit']) !!}
                                {{ method_field('delete') }}
                            {!! Form::close() !!}
                        </div>
                    </td>
            </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    </div>
</div>
@if ($categories->lastPage() >1)
    <nav>
        <ul class="pagination">
            @if ($categories->currentPage() > 1)
                <li class="page-item" aria-label="pagination.previous">
                    <a class="page-link" href="{{ $categories->previousPageUrl() }}" rel="previous" aria-label="pagination.previous">&lsaquo;</a>
                </li>
            @endif

            @for ($i = 1; $i <= $categories->lastPage(); $i++)
                <li class="page-item">
                    <a class="page-link" href="{{ $categories->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            @if ($categories->currentPage() < $categories->lastPage())
            <li class="page-item">
                <a class="page-link" href="{{ $categories->nextPageUrl() }}" rel="next" aria-label="pagination.next">&rsaquo;</a>
            </li>
            @endif
            
            
       </ul>
    </nav>
@endif

@else
<h3>Категорий нет</h3>
@endif
<div class="container">
    {!! Html::link(route('admin_create_categories'), 'Создать новую категорию',['class'=> 'btn btn-success']) !!}
</div>




