<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 col">

<a href="{{ route('page.show', ['page'=>$item->slug]) }}">

	@if($item->avatar)
	<div class="thumbnail">
		<img alt="{{ $item->avatar->alt }}" src="{{ route('imagecache', ['template'=>'medium', 'filename'=>$item->avatar->filename]) }}">
	</div>
	@endif

	<h3>{{ $item->name }}</h3>

	@if($item->anons)<p class="hidden-xs">{{ $item->anons }}</p>@endif

</a>

</div>