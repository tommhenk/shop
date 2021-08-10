<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ? $title : '' }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    @if (Route::currentRouteName() == 'register' || Route::currentRouteName() == 'login')
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
        <script src="{{ asset('/js/app.js') }}"></script>
    @endif


    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <script src="{{asset(config('settings.theme'))}}/js/jquery.min.js"></script>
    <script src="{{asset(config('settings.theme'))}}/js/bootstrap.min.js"></script>
    <link href="{{asset(config('settings.theme'))}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset(config('settings.theme'))}}/css/starter-template.css" rel="stylesheet">
    <link href="{{asset(config('settings.theme'))}}/css/admin.css" rel="stylesheet">
</head>
<body>
        @yield('navigation')

        
<div class="container">
            
    <div class="starter-template">
        @if (session('status'))
        <div class="container">
            <p class="alert alert-success" style="text-align: center">{{ session('status') }}</p>
        </div>
        @endif

        @if (session('info'))
        <div class="container">
            <p class="alert alert-warning" style="text-align: center">{{ session('info') }}</p>
        </div>
        @endif

        @if ($errors->count() > 0)
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif 
            {!! $title ? "<h1>".$title."</h1>" : '' !!}



    @yield('content')

    </div>
</div>
</body>
</html>
