@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

<div class="panel-heading">Цены</div>

<div class="panel-body">
<table class="table table-hover ajax">
  <thead>
  	<tr>
  		<td>#</td>
  		<td>type</td>
  		<td>width</td>
  		<td>height</td>
  		<td>variable label</td>
  		<td>variable title</td>
  		<td>price</td>
  	</tr>
  </thead>
  <tbody>
@foreach($typevars as $typevar)
  	<tr>
  		<td>{{ $typevar->id }}</td>
  		<td>{{ $typevar->type->title }}</td>
  		<td>{{ $typevar->type->width }}</td>
  		<td>{{ $typevar->type->height }}</td>
  		<td>{{ $typevar->variable->label }}</td>
  		<td>{{ $typevar->variable->title }}</td>
  		<td><input size="5" class="form-control input-sm" type="text" id="{{ $typevar->id }}" fieldType="decimal" route="{{ route('admin.typevar.update') }}" name="price" value="{{ $typevar->price }}"></td>
  	</tr>
@endforeach
  </tbody>
</table>

</div>

<div class="panel-footer text-center">{{ $typevars->links() }}</div>

            </div>
        </div>
    </div>
</div>
@endsection

