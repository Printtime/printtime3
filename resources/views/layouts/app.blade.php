<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $page->title or config('app.name', 'Laravel') }} - {{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="{{ $page->description or '' }}">
    <meta name="keywords" content="{{ $page->keywords or '' }}">
    <meta property="og:title" content="{{ $page->ogtitle or '' }}" />
    <meta property="og:description" content="{{ $page->ogdescription or '' }}" />
    <meta property="og:type" content="{{ $page->ogtype or '' }}" />
    <meta property="og:url" content="{{ $page->slug or '' }}" />
    @if(isset($page->ogimage))
    <meta property="og:image" content="{{ route('imagecache', ['template'=>'full', 'filename'=>$page->ogimage->filename]) }}" />
    @endif

    <meta name="google-site-verification" content="xv-FLiU_oPmbIJ0eYLsEbShgTGmjVaKoxRW3XTEHYK8" />

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NPT2Q9');</script>
<!-- End Google Tag Manager -->


    <?php
if (isset($page->robots)) {
	$robots = [];
	foreach ($page->robots as $robot) {
		if (!empty($robot)) {$robots[] = $robot;}
	}
	$robots = implode(",", $robots);
}
if (empty($robots)) {$robots = 'NOINDEX,NOFOLLOW';}
?>
    <meta name="robots" content="{{ $robots }}"/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NPT2Q9"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

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
