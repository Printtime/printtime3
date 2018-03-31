<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $page->title or config('app.name', 'Laravel') }} - {{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="{{ $page->description or '' }}"> 
    <meta name="keywords" content="{{ $page->keywords or '' }}"> 
    <meta property="og:title" content="{{ $page->ogtitle or '' }}" />
    <meta property="og:description" content="{{ $page->ogdescription or '' }}" />
    <meta property="og:type" content="{{ $page->ogtype or '' }}" />
    <meta property="og:url" content="{{ $page->slug or '' }}" />
    @if($page->ogimage)
    <meta property="og:image" content="{{ route('imagecache', ['template'=>'full', 'filename'=>$page->ogimage->filename]) }}" />
    @endif

    <?php

    $robots = [];
    foreach ($page->robots as $robot) {
        if(!empty($robot)) { $robots[] = $robot; }
    }


        $robots = implode(",", $robots); 
        if(empty($robots)) { $robots = 'NOINDEX,NOFOLLOW'; }
    ?>
    <meta name="robots" content="{{ $robots }}"/> 

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>

<div id="app">

@include('widgets.top')
@include('widgets.navbar')
@include('widgets.slider')

<div class="page">@yield('content')</div>


@include('widgets.footer')
</div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
