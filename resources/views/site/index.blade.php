@extends(config('settings.theme').'.layouts.site')

@section('navigation')
	{!! $navigation !!}
@endsection

@section('filters_form')
	{!! $filters_form !!}
@endsection

@section('content')
	{!! $content !!}
@endsection