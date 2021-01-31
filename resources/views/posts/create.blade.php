@extends('layouts.app')

@section('content')
<h1>Create Post</h1>
{!! Form::open(['action' => 'PostsController@store' , 'method' => 'POST','enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
    {{Form::label('title', 'Title')}}
    {{Form::text('title', '',['class' => 'form-control','placeholder' => 'Title'])}}
    </div>
    <div class="form-group">
    @csrf
    {{Form::label('body', 'Body')}}
    {{Form::textarea('body', '',['class' => 'ckeditor form-control','placeholder' => 'Body'])}}
    </div>
    <div class="form-group">
        {{ Form::file('cover_image') }}
    </div>
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
{!! Form::close() !!}

<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
@endsection