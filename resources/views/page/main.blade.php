@extends('layouts.app')

@section('content')
<div class="container">

    <h1>{{ $page->h1 }}</h1>

<hr>
{{--
@foreach($page->GetImages('gallery') as $gallery)
	{{ $gallery }}
@endforeach
--}}

    <div class="row">
        <div class="col-sm-12">
            {!! $page->content !!}
        </div>
    </div>
</div>
@endsection
