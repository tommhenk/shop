@if ($card)
<div class="container">
    <div class="starter-template">
    <h1>Подтвердите заказ:</h1>
    <div class="container">
        <div class="row justify-content-center">
            <p>Общая стоимость: <b>{{ $card->totalyPrice }} грн</b></p>
            {!! Form::open(['url'=>route('receive_orderBasket'), 'method'=>'POST']) !!}
                <div>
                    <p>Укажите свои имя и номер телефона, чтобы наш менеджер мог с вами связаться:</p>
                    <div class="container">
                        <div class="form-group">
                            {!! Form::label('name', 'Имя: ', ['class'=>'control-label col-lg-offset-3 col-lg-2']) !!}
                            <div class="col-lg-4">
                                {!! Form::text('name', old('name'), ['id'=>'name', 'class'=>'form-control']) !!}
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            {!! Form::label('number', 'Номер телефона: ', ['class'=>'control-label col-lg-offset-3 col-lg-2']) !!}
                            <div class="col-lg-4">
                                {!! Form::text('number', old('number'), ['id'=>'number', 'class'=>'form-control']) !!}
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            {!! Form::label('email', 'Email: ', ['class'=>'control-label col-lg-offset-3 col-lg-2']) !!}
                            <div class="col-lg-4">
                                {!! Form::text('email', old('email'), ['id'=>'email', 'class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <br>
                {!! Form::button('Подтвердите заказ', ['class'=>'btn btn-success', 'type'=>'submit']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    </div>
</div>
@endif


