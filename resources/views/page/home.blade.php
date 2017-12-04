@extends('layouts.app')

@section('content')

@verbatim
    <div class="container">
        Hello, {!! page !!}.
    </div>
@endverbatim

123

@verbatim
    <div class="container">
        Hello, {{ name }}.
    </div>
@endverbatim

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            {!! $page->content !!}
         </div>
    </div>
</div>


<div class="container-fluid">
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            {!! $page->content !!}
        </div>
    </div>
</div>
</div>


<div class="container">
    <div class="row">
        <div class="col-sm-12">
            {!! $page->content !!}
         </div>
    </div>
</div>
@endsection
