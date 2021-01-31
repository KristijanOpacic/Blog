@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="css/admin.css">

<div class="sidenav">
		<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
			Create New
		</a>
		<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
			<a class="dropdown-item" href="{{ route('users.create') }}">New User</a>
			<a class="dropdown-item" href="{{ route('roles.create') }}"> New Roles</a>
			<a class="dropdown-item" href="{{ route('products.create') }}">New Products</a>
			<a class="dropdown-item" href="{{ route('posts.create') }}">New Blog</a>
		</div>
		<li>
			<a id="Dropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
				See All
			</a>
			<div class="dropdown-menu" aria-labelledby="Dropdown">
				<a class="dropdown-item" href="{{ route('users.index') }}">Users</a>
				<a class="dropdown-item" href="{{ route('roles.index') }}"> Roles</a>
				<a class="dropdown-item" href="{{ route('products.index') }}">Products</a>
				<a class="dropdown-item" href="{{ route('posts.index') }}">Blogs</a>
			</div>
		</li>			
  </div>
  <!-- Page content -->
  <div class="main">
    @if(count($posts) >= 4)
            <div class="card">
               <ul class="list-group list-group-flush">
               @foreach($posts as $post)

                <div class="row">
                    <div class="col-md-1">
                        <img style ="width: 100%" src="/storage/cover_images/{{ $post->cover_image }}" alt="">
                    </div>
                    
                    <div class="col-md-8">
                        
                        <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                        <small>Written on {{$post->created_at}}</small>
                    
                    </div>
                </div>
                
				@endforeach
               </ul>
            </div>
       @else

       @endif 
  </div>


@endsection