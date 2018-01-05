<center>
<ul class="list-inline">
	@foreach($data['relations'] as $item)
	    <li><a class="btn btn-default btn-lg" href="{{ $item->page->slug or '#' }}">{{ $item->name }}</a></li>
	@endforeach
</ul>
</center>