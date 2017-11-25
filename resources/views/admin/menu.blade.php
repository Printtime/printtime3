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


<div id="menuTree" data-url="{{ route('admin.menu.json') }}"></div>

<hr>

<form id="newMenu" class="form-inline text-center">
<div class="form-group ui-widget">
	<input class="form-control" type="text" name="name" required="required" placeholder="Название меню...">
	<input class="form-control" type="text" name="page" required="required" size="42" placeholder="Название страницы...">
	<input class="form-control" type="text" name="page_id" required="required" size="4" placeholder="id">
	<input class="form-control" type="text" name="slug" required="required" size="4" placeholder="slug">
</div>
	<input class="btn btn-default" type="submit" value="Создать">
</form>


 



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
