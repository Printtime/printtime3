@extends('layouts.app')

@section('content')
{{-- https://mbraak.github.io/jqTree/#demo --}}

{{--
https://mbraak.github.io/jqTree/
https://github.com/lazychaser/laravel-nestedset
--}}


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Menu</div>

                <div class="panel-body">


<div id="menuTree" data-url="/api/getMenu"></div>

<hr>

<?php
			$traverse = function ($menu, $prefix = '-') use (&$traverse) {
			    foreach ($menu as $item) {


			        echo PHP_EOL.$prefix.' '.$item->name;

			    	
			        echo "<br>";

			        $traverse($item->children, $prefix.'-');
			    }
			};

			$traverse($menu);
?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
