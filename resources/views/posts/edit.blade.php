@extends('layouts.app')

@section('content')
<h1>Edit Post</h1>
{!! Form::open(['action' => ['PostsController@update', $posts->id], 'method' => 'POST','enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
    {{Form::label('title', 'Title')}}
    {{Form::text('title', $posts->title,['class' => 'form-control','placeholder' => 'Title'])}}
    </div>
    <div class="form-group">
    {{Form::label('body', 'Body')}}
    {{Form::textarea('body', '',['class' => 'ckeditor form-control','placeholder' => 'Body'])}}
    </div>
    <div class="form-group">
        {{ Form::file('cover_image') }}
    </div>
    {{ Form::hidden('_method','PUT') }}
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
{!! Form::close() !!}

<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit New User</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
        </div>
    </div>
</div>
@endsection