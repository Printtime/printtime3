@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $file->name }}</div>

                <div class="panel-body">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.32.0/codemirror.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.32.0/addon/hint/show-hint.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.32.0/codemirror.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.32.0/addon/hint/show-hint.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.32.0/addon/hint/xml-hint.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.32.0/addon/hint/html-hint.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.32.0/mode/xml/xml.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.32.0/mode/javascript/javascript.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.32.0/mode/css/css.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.32.0/mode/htmlmixed/htmlmixed.min.js"></script>
  <style type="text/css">
    .CodeMirror {
  		height: 70vh;
  		border: 1px solid #eee;
  	}
  </style>

{!! Form::open(['route' => 'admin.file.update']) !!}
{{ Form::textarea('content', $content, ['id'=>'code', 'rows' => '30', 'class' => 'form-control']) }}
{{ Form::hidden('id', $file->id) }}
<div class="text-center">{{ Form::submit('Сохранить изменение', ['class' => 'btn btn-success']) }}</div>
{!! Form::close() !!}

                <script type="text/javascript">
                var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
                  lineNumbers: true,
                  styleActiveLine: true,
                  matchBrackets: true,
                        mode: "text/html",
                        extraKeys: {"Ctrl-Space": "autocomplete"},
                });
                </script>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
