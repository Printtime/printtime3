@extends('layouts.app')

@section('content')

    @foreach($content as $item)
        @includeIf('page.sub.'.$item['type'], ['data'=>$item])
    @endforeach

@endsection
