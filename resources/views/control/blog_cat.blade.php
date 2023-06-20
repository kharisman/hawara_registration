@extends('layouts.front_blog')

@if($count==0)

@section('title','Blog')

@section('content')

<div class="col-12">
	<div class="card mt-3">
	  <div class="card-body">
			<h3>Maaf, Postingan Tidak Ditemukan</h3>
		</div>
	</div>
</div>

@endsection

@else

@section('title','Blog Category')

@section('description', 'PalComTech')

@section('content')
<div class="col-12">
	<div class="card mt-3">
	  <div class="card-body">
	  	@foreach($data as $blog)
			<h4><a href="{{ url('blogs/preview/'.$blog->slug) }}" class="text-dark text-decoration-none">{{ $blog->blog_title }}</a></h4>
			<hr>
			@endforeach
		</div>
	</div>
</div>

@endsection
@endif