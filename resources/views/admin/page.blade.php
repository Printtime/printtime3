@extends('layouts.admin')

@section('content')

@if($page)
	{!! Form::model($page, ['route' => ['admin.page.update', $page->id]]) !!}
@else
	{!! Form::model($page, ['route' => ['admin.page.store']]) !!}
@endif

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading">
	                <h3 class="panel-title">Page</h3>
	                <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                </div>				
                <div class="panel-body">

								<div class="form-group">
									{{ Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Название', 'required']) }}
								</div>

								<div class="form-group">
									{{ Form::textarea('anons', null, ['rows'=>'3', 'class' => 'form-control', 'placeholder'=>'Анонс - краткое содержание']) }}
								</div>

						{{ Form::textarea('content', null, ['id'=>'tinymce', 'class' => 'form-control', 'placeholder'=>'Полное содержание']) }}
								
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">


		<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading panel-collapsed">
						<h3 class="panel-title">Meta</h3>
						<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
					</div>
					<div class="panel-body" style="display: none;">
								<div class="form-group">
									<div id="title">{{ Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'<title>']) }}</div>
								</div>
								<div class="form-group">
									<div id="h1">{{ Form::text('h1', null, ['class'=>'form-control', 'placeholder'=>'<h1>']) }}</div>
								</div>
								<div class="form-group">
									<div id="description">{{ Form::textarea('description', null, ['rows'=>'5', 'class' => 'form-control', 'placeholder'=>'<description>']) }}</div>
								</div>
								<div class="form-group">
									<div id="keywords">{{ Form::textarea('keywords', null, ['rows'=>'3', 'class' => 'form-control', 'placeholder'=>'<keywords>']) }}</div>
								</div>
					</div>
			</div>
		</div>


		<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading panel-collapsed">
						<h3 class="panel-title">Open Graph</h3>
						<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
					</div>
					<div class="panel-body" style="display: none;">
								<div class="form-group">
									<div id="ogtitle">{{ Form::text('ogtitle', null, ['class'=>'form-control', 'placeholder'=>'og:title']) }}</div>
								</div>
								<div class="form-group">
									<div id="ogdescription">{{ Form::textarea('ogdescription', null, ['class' => 'form-control', 'placeholder'=>'og:description']) }}</div>
								</div>
								<div class="form-group">
									<div id="ogtype">{{ Form::text('ogtype', null, ['class'=>'form-control', 'placeholder'=>'og:type']) }}</div>
								</div>
					</div>
			</div>
		</div>

	
	</div>
</div>



<div class="container">
    <div class="row">


		<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading panel-collapsed">
						<h3 class="panel-title">Config</h3>
						<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
					</div>
					<div class="panel-body" style="display: none;">
							<div class="form-horizontal">
								<div class="form-group">
									<label class="col-sm-4 control-label" for="changefreq">Changefreq</label> <div id="changefreq" class="col-sm-8">
									{{ Form::select('changefreq', $changefreq_array, null, ['class'=>'form-control']) }}
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label" for="changefreq">Priority</label> <div id="changefreq" class="col-sm-8">{{ Form::text('priority', null, ['class'=>'form-control', 'placeholder'=>'0.5']) }}</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label" for="created_at">Создано</label> <div id="created_at" class="col-sm-8">{{ Form::text('created_at', null, ['class'=>'form-control']) }}</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label" for="updated_at">Обновлено</label> <div id="updated_at" class="col-sm-8">{{ Form::text('updated_at', null, ['class'=>'form-control']) }}</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label" for="template">Шаблон</label> <div id="template" class="col-sm-8">{{ Form::text('template', null, ['class'=>'form-control', 'placeholder'=>'название view blade']) }}</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-4 col-sm-8"><div class="checkbox"><label>{{ Form::checkbox('published', null) }} Опубликовано</label></div></div>
								</div>
							</div>
					</div>
			</div>
		</div>



		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading panel-collapsed">
					<h3 class="panel-title">Robots</h3>
					<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
				</div>
				<div class="panel-body" style="display: none;">
						
						<div class="form-group">
							<div class="checkbox"><label>{{ Form::checkbox('robots[0]', 'INDEX', null) }} INDEX</label></div>
							<div class="checkbox"><label>{{ Form::checkbox('robots[1]', 'NOINDEX', null) }} NOINDEX</label></div>
							<div class="checkbox"><label>{{ Form::checkbox('robots[2]', 'FOLLOW', null) }} FOLLOW</label></div>
							<div class="checkbox"><label>{{ Form::checkbox('robots[3]', 'NOFOLLOW', null) }} NOFOLLOW</label></div>
						</div>
						<div class="form-group">{{ Form::text('robots[4]', null, ['class'=>'form-control', 'placeholder'=>'Произвольный robots']) }}</div>
				</div>
			</div>
		</div>


	</div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
        	{!! Form::submit('Сохранить | Обновить', ['class'=>'btn btn-success']) !!}
        </div>
    </div>
</div>

{!! Form::close() !!}

@endsection
