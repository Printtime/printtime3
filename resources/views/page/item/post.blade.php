<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col">
	
	<a class="{{ $item['type']['system'] }}-item item" href="{{ route('page.show', ['page'=>$item->slug]) }}">

	@if($item->avatar)
	<div class="thumbnail">
		<img alt="{{ $item->avatar->alt }}" src="{{ route('imagecache', ['template'=>'medium', 'filename'=>$item->avatar->filename]) }}">
	</div>
	@endif

	<h3>{{ $item->name }}</h3>
	<p class="hidden-xs">{{ $item->anons }}</p>
	<span class="date">{{ $item->created_at->format('d.m.Y') }}</span>

	</a>

</div>