@extends('layouts.admin')

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
                <div class="panel-heading">Управление меню</div>

                <div class="panel-body">


<div id="menuTree" data-url="{{ route('admin.menu.json') }}"></div>
<div class="text-right" style="color: #ccc; float:right"><small><span class="glyphicon glyphicon-trash"></span> Удаление пункта меню - двойной клик</small></div>
<hr>
<form id="newMenu" class="form-inline text-center">
<div class="form-group ui-widget">
	<input class="form-control" type="hidden" name="id">
	<input class="form-control" type="text" name="name" required="required" placeholder="Название меню...">
	<input class="form-control" type="text" name="page" size="32" placeholder="Название страницы...">
	<input class="form-control" type="hidden" name="page_id" size="3" placeholder="id">
	<input class="form-control" type="hidden" name="slug" size="3" placeholder="slug">
</div>
	<button class="btn btn-warning" title="Удалить связь к странице" type="button" name="unpage"><span class="glyphicon glyphicon-link"></span></button>
	<input class="btn btn-success" type="submit" value="Создать/Обновить">
</form>


 



<hr>

<?php
/*
			$traverse = function ($menu, $prefix = '-') use (&$traverse) {
			    foreach ($menu as $item) {


			        echo PHP_EOL.$prefix.' '.$item->name;

			    	
			        echo "<br>";

			        $traverse($item->children, $prefix.'-');
			    }
			};

			$traverse($menu);
			*/
?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
