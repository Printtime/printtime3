@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $file->name }}</div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'admin.file.update']) !!}
                    {{ Form::textarea('content', $content, ['id'=>'code', 'rows' => '30', 'class' => 'form-control']) }}
                    {{ Form::hidden('id', $file->id) }}
                    <div class="text-center">{{ Form::submit('Сохранить изменение', ['class' => 'btn btn-success']) }}</div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
