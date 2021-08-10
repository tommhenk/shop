@if ($menus)
<nav class="navbar navbar-inverse navbar-fixed-top navbar-light bg-light">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('home') }}">В магазин</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                @include(config('settings.theme').'.admin.customMenuItems', ['items'=>$menus->roots()])
            </ul>


            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="" onclick="function(this){this.preventDefault()}">
                    {!! Form::open(['url'=>route('logout'), 'method'=>'POST', 'class'=>'']) !!}
                    {!! Form::button('Выйти: '.Auth::user()->login, ['type'=>'submit']) !!}
                    {!! Form::close() !!}
                    </a>
                </li>
            </ul>
            
        </div>
    </div>
</nav>
@endif