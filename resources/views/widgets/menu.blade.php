
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
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
        <?php


$traverse = function ($categories, $lvl = 1, $tmp = 1, $save_count = null) use (&$traverse) {


    foreach ($categories as $key => $category) {
        $key = $key + 1;

        echo "\n";

        



        if($lvl != $tmp) {
            echo ' drop ';
            echo "\n";
        }

        echo $key;

        if($category->page) {
            echo '<a href="'.$category->page->slug.'">'.$category->name.'</a>';
        } else {
            echo '<a href="#">'.$category->name.'</a>';
        }



        $save = count($category->children);
        if($save != 0) {
            $save_count = $save;
        }


      if($save_count == $key) {
            echo "\n";
            echo ' end ';
            $save_count = 0;
        }


        // echo count($category->children);

        // if($lvl != $tmp) {
        //     echo 'SUB END </li>';
        // }


/*$pref = '<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">';

$suf = '</ul></li>';*/

        $traverse($category->children, $lvl + 1, $tmp = $lvl, $save_count);
    }


};

$traverse($menu);
?>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


