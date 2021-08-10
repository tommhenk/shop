@if ($items)
	@foreach ($items as $item)
		<li {{ URL::current() == $item->url() ? 'class=active' : '' }}><a href="{{ $item->url() }}">{{ $item->title }}</a></li>
	@endforeach

	@if ($item->hasChildren())
		<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">₽<span class="caret"></span></a>
        <ul class="dropdown-menu">
                @include(config('settings.theme').'.customMenuItems', ['items'=>$item->children()])
        </ul>
    </li>
	@endif
@endif