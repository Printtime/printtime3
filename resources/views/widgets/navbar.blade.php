        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="/images/theme/logo.png" alt="{{ config('app.name', 'Laravel') }}">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">

<!-- Left Side Of Navbar -->
<ul class="nav navbar-nav">
    @foreach($menu as $item)
    @if($item->children->count())
        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">{{ $item->name }} <span class="caret"></span></a>
        <ul class="dropdown-menu">
            @foreach($item->children as $item)
            <li><a href="{{ $item->page->slug or '#' }}">{{ $item->name }}</a></li>
            @endforeach
        </ul>
        </li>
            @else
        <li><a href="{{ $item->page->slug or '#' }}">{{ $item->name }}</a></li>
    @endif
    @endforeach
</ul>

                </div>
            </div>
        </nav>