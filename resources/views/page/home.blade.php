@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Home</div>

                <div class="panel-body">

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
