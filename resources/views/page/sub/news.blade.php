@if(isset($data['class']))<div class="{{ $data['class'] }}">@endif

<div class="container sub {{ $item['type'] }}">
	<div class="row head">
    			<div class="col-sm-6"><h2>Последние новости</h2></div>
    			<div class="col-sm-6 text-right hidden-xs"><a href="{{ route('page.show', ['page'=>'news']) }}">Читать все новости <i class="glyphicon glyphicon-share-alt" aria-hidden="true"></i></a></div>
	</div>
    <div class="row">
	           @foreach($data['relations'] as $relations)
	           		<div class="{{ $item['type'] }}">@includeIf('page.item.'.$item['type'], ['item'=>$relations])</div>
	           @endforeach        
    </div>
</div>

@if(isset($data['class']))</div>@endif