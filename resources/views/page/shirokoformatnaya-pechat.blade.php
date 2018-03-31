@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-12">
		    <h1>{{ $page->h1 }}</h1>
		</div>
	</div>
</div>

{{--
@if($relations)
<div class="container">
    <div class="row relations">
    @foreach($relations as $item)
        @includeIf('page.relations.shirokoformatnaya-pechat', ['item'=>$item])
    @endforeach
    </div>
</div>
{{ $relations->links('pagination.page') }}
@endif
--}}

    @foreach($content as $item)
        @includeIf('page.sub.'.$item['type'], ['data'=>$item])
    @endforeach

@endsection
