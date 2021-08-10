@if ($menus)
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            {{-- @dd(Route::currentRouteName()) --}}
            <a class="navbar-brand {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="{{ route('home') }}">Интернет Магазин</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                @include(config('settings.theme').'.customMenuItems', ['items'=>$menus->roots()])
            </ul>

            @if (Auth::user())
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="" onclick="function(this){this.preventDefault()}">
                    {!! Form::open(['url'=>route('logout'), 'method'=>'POST']) !!}
                    {!! Form::button('Выйти: '.Auth::user()->login, ['type'=>'submit']) !!}
                    {!! Form::close() !!}
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li {{ Route::currentRouteName() == 'adminIndex' ? 'class=active' : '' }}><a href="{{ route('adminIndex') }}">Админка</a></li>
            </ul>
            @else
            <ul class="nav navbar-nav navbar-right">
                <li {{ Route::currentRouteName() == 'login' ? 'class=active' : '' }}><a href="{{ route('login') }}">Войти</a></li>
            </ul>
            @endif
            
        </div>
    </div>
</nav>
@endif