@if(isset($data['class']))<div class="{{ $data['class'] }}">@endif

<div class="container sub {{ $item['type'] }}">
	<div class="row head">
    			<div class="col-sm-6"><h2>Последние статьи в блоге</h2></div>
    			<div class="col-sm-6 text-right"><a href="{{ route('page.show', ['page'=>'news']) }}">Читать блог ></a></div>
	</div>
    <div class="row">
	           @foreach($data['relations'] as $relations)
	           		<div class="{{ $item['type'] }}">@includeIf('page.item.'.$item['type'], ['item'=>$relations])</div>
	           @endforeach        
    </div>
</div>

@if(isset($data['class']))</div>@endif