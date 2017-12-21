@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Редактор файлов</div>

                <div class="panel-body">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Название</th>
                        <th>Директория</th>
                        <th>Путь файла</th>
                        <th></th>
                      </tr>
                    </thead>
                    @foreach($files as $file)
                        <tr>
                        <td>{{ $file->id }}</td>
                        <td>{{ $file->name }}</td>
                        <td>{{ $file->dir }}</td>
                        <td>{{ $file->path }}</td>
                        <td><a class="btn btn-default btn-sm" href="{{ route('admin.file.edit', ['id'=>$file->id]) }}">Изменить</a></td>
                      </tr>
                    @endforeach
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
