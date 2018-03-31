<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 col">
	
	<?php
		$template = 'medium';
		if(empty($item->anons)) {
			$template = 'vertical';
		}
	?>


	<div class="{{ $item['type']['system'] }}-item item-{{$key}}">
	@if(!empty($item->anons))
		<h2>{{ $item->name }}</h2>
	@endif

	@if($item->avatar)
	<a title="{{ $item->avatar->title }}" href="{{ route('page.show', ['page'=>$item->slug]) }}" class="thumbnail">
		<img alt="{{ $item->avatar->alt }}" src="{{ route('imagecache', ['template'=>$template, 'filename'=>$item->avatar->filename]) }}">
	</a>
	@endif
	
	@if(!empty($item->anons))
		<p class="hidden-xs">{{ $item->anons }}</p>
		<a class="more hidden-xs" href="{{ route('page.show', ['page'=>$item->slug]) }}">Подробнее</a>
	@endif

	</div>

</div>