@if(isset($data['class']))<div class="{{ $data['class'] }}">@endif

<div class="container sub">
    <div class="row">
        <div class="col-sm-12">
	           @foreach($data['relations'] as $relations)
	           		@includeIf('page.item.'.$item['type'], ['item'=>$relations])
	           @endforeach
         </div>
    </div>
</div>

@if(isset($data['class']))</div>@endif