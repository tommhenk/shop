@extends(config('settings.theme').'.layouts.site')

@section('navigation')
    {!! $navigation !!}
@endsection

@section('content')
    @include(config('settings.theme').'.auth.login_content')
@endsection