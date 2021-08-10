@if (!empty($orders))
<div class="container">
    <div class="starter-template">         
    <div class="panel">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Имя</th>
                <th>Телефон</th>
                <th>Дата</th>
                <th>Сумма</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ isset($order->user->name) ? $order->user->name : $order->name }}
                    </td>
                    <td>
                        {{ $order->number }}
                    </td>
                    <td>
                        {{ $order->created_at->format('Y-m-d T H:i:s') }}
                    </td>
                    <td>
                        {{ $order->card->totalyPrice }}
                    </td>
                    <td>
                        <div class="btn-group form-inline">
                            {!! Form::open(['url'=>route('admin_destroy_orders', $order), 'method'=>'POST']) !!}
                            {!! Html::link(route('admin_show_orders', $order), 'Открыть', ['class'=>'btn btn-success', 'type'=>'button']) !!}
                                {!! Form::button('Удалить', ['class'=>'btn btn-danger', 'type'=>'submit']) !!}
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
@if ($orders->lastPage() >1)
    <nav>
        <ul class="pagination">
            @if ($orders->currentPage() > 1)
                <li class="page-item" aria-label="pagination.previous">
                    <a class="page-link" href="{{ $orders->previousPageUrl() }}" rel="previous" aria-label="pagination.previous">&lsaquo;</a>
                </li>
            @endif

            @for ($i = 1; $i <= $orders->lastPage(); $i++)
                <li class="page-item">
                    <a class="page-link" href="{{ $orders->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            @if ($orders->currentPage() < $orders->lastPage())
            <li class="page-item">
                <a class="page-link" href="{{ $orders->nextPageUrl() }}" rel="next" aria-label="pagination.next">&rsaquo;</a>
            </li>
            @endif
            
            
       </ul>
    </nav>
@endif

@else
<h3>Заказов нет</h3>
@endif




