@extends(config('settings.theme').'.layouts.site')

@section('navigation')
	{!! $navigation !!}
@endsection

@if (Route::currentRouteName() == 'categories.show')
	@section('filters_form')
		@include(config('settings.theme').'.filters_form')
	@endsection
@endif


@section('content')
	{!! $content !!}
@endsection