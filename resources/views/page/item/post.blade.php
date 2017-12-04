<div class="col-xs-6 col-sm-3 col">
	
	<div class="{{ $item['type']['system'] }}-item">

	<a href="{{ route('page.show', ['page'=>$item->slug]) }}" class="thumbnail">
		<img src="{{ route('imagecache', ['template'=>'medium', 'filename'=>$item->GetImageType('avatar')]) }}">
	</a>
	
	<h3>{{ $item->name }}</h3>
	
	<p>{{ $item->anons }}</p>

	<a class="more" href="{{ route('page.show', ['page'=>$item->slug]) }}">Подробнее</a>

	</div>

</div>