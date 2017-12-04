@extends('layouts.app')

@section('content')
    @foreach($content as $item)
        @includeIf('page.sub.'.$item['type'], ['data'=>$item])
    @endforeach

	{{--
	@foreach($page->relations as $relation)
		{{ dd($relation->types->where('system', 'post')) }}
	@endforeach

	{{ dd($page->relations->types()->where('system', 'post')) }}

	--}}

{{--
    @foreach($content as $item)
        @includeIf('page.sub.'.$item['type'], ['data'=>$item])
    @endforeach
--}}
@endsection
