@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Pages</div>

                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>name</th>
                                <th>priority</th>
                                <th>slug</th>
                                <th>created | updated</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($pages as $page)
                            <tr>
                                <td>{!! $page->published == 1 ? '<span class="glyphicon glyphicon-eye-open"></span>' :  '<span class="glyphicon glyphicon glyphicon-eye-close"></span>' !!}</td>
                                <td><a href="{{ route('admin.page.edit', ['page'=>$page->id]) }}">{{ $page->name }}</a></td>
                                <td>{{ $page->priority }}</td>
                                <td>{{ $page->slug }}</td>
                                <td>{{ $page->created_at }}<br>{{ $page->updated_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                        
                    <center>{{ $pages->links() }}</center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
