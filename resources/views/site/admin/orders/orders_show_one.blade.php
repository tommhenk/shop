<div class="py-4">
    <div class="container">
        <div class="justify-content-center">
            <div class="panel">
                <h1>Заказ №{{ $order->id }}</h1>
                <p>Заказчик: <b>{{ $order->name ? $order->name : $order->user->name }}</b></p>
                <p>Номер телефона: <b>{{ $order->number }}</b></p>
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
                        {{-- @dd($order->card->items) --}}
                        @foreach ($order->card->items as $item)
                        <tr>
                            <td>
                                <a href="{{ route('indexProduct', ['cat_name'=>$item['item']->category->alias, $item['item']]) }}">
                                    <img height="56px"
                                         src="{{ Storage::url($item['item']->img) }}">
                                    {{ $item['item']->title }}
                                </a>
                            </td>
                            <td><span class="badge">{{ $item['qty'] }}</span></td>
                            <td>{{ $item['item']->price }}</td>
                            <td>{{$item['price']}}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" >Сумма</td>
                            <td>{{ $order->card->totalyPrice }}</td>
                        </tr>
{{--                     @foreach ($skus as $sku)
                        <tr>
                            <td>
                                <a href="{{ route('sku', [$sku->product->category->code, $sku->product->code, $sku]) }}">
                                    <img height="56px"
                                         src="{{ Storage::url($sku->product->image) }}">
                                    {{ $sku->product->name }}
                                </a>
                            </td>
                            <td><span class="badge"> {{ $sku->pivot->count }}</span></td>
                            <td>{{ $sku->pivot->price }} {{ $order->currency->symbol }}</td>
                            <td>{{ $sku->pivot->price * $sku->pivot->count }} {{ $order->currency->symbol }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3">Общая стоимость:</td>
                        <td>{{ $order->sum }} {{ $order->currency->symbol }}</td>
                    </tr>
                    @if($order->hasCoupon())
                        <tr>
                            <td colspan="3">Был использован купон:</td>
                            <td><a href="{{ route('coupons.show', $order->coupon) }}">{{ $order->coupon->code }}</a></td>
                        </tr>
                    @endif --}}
                    </tbody>
                </table>
                <br>
            </div>
        </div>
    </div>
</div>