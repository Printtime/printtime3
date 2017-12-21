<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 col">
	
	<div class="{{ $item['type']['system'] }}-item item-{{$key}}">
	<h2>{{ $item->name }}</h2>

	@if($item->avatar)
	<a title="{{ $item->avatar->title }}" href="{{ route('page.show', ['page'=>$item->slug]) }}" class="thumbnail">
		<img alt="{{ $item->avatar->alt }}" src="{{ route('imagecache', ['template'=>'medium', 'filename'=>$item->avatar->filename]) }}">
	</a>
	@endif
	<p>{{ $item->anons }}</p>

	<a class="more" href="{{ route('page.show', ['page'=>$item->slug]) }}">Подробнее</a>

	</div>

</div>