@if(isset($data['class']))<div class="{{ $data['class'] }}">@endif

<div class="container sub {{ $item['type'] }}">
    <div class="row">
	           @foreach($data['relations'] as $key => $relations)
	           		<div>@includeIf('page.item.'.$item['type'], ['item'=>$relations])</div>
	           @endforeach
    </div>
</div>

@if(isset($data['class']))</div>@endif