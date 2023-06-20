@extends('layouts.front')

@if($count==0)

@section('title','Blog')

@section('content1')

<div class="card mt-3">
  <div class="card-body">
		<h3>Maaf, Postingan Tidak Ditemukan</h3>
	</div>
</div>

@endsection

@else
@php $title =  $dt->blog_title @endphp
@section('title', $title)
@php $description =  $dt->meta_description @endphp
@section('description',$description)

@section('content1')
<div class="card mt-3 mb-3">
  <div class="card-body">
	@foreach($data as $blog)
		<h1>{{ $blog->blog_title }}</h1>
		<div class="text-muted" style="font-size: 12px; !important">
			<i class="fa fa-calendar"></i> {{ $blog->created_at }} <br>
	    <span style="font-size: 10px;">Ditulis Oleh:</span>
	     <p>{{$blog->user->name}}</p>
	  </div>
		{!! $blog->description !!}
	@endforeach
	</div>
</div>

@endsection

@section('content2')

<div class="card mt-3">
  <div class="card-body">
  	<h5>News update</h5>
  	@foreach($bl as $b)
  	<a href="{{ url('blogs/preview/'.$b->slug) }}" class="text-dark text-decoration-none">
			<div class="d-flex mb-2">
				<div class="my-auto mr-2">
					<img src="{{ $b->thumbnail }}" style="width: 100px;">
				</div>
				<div class="ml-auto">
					{{ $b->blog_title }}
				</div>
			</div>
		</a>
		@endforeach
	</div>
</div>

<div class="card mt-3">
  <div class="card-body">
  	<h5>Popular News</h5>
  	@foreach($blv as $b)
  	<a href="{{ url('blogs/preview/'.$b->slug) }}" class="text-dark text-decoration-none">
			<div class="d-flex mb-2">
				<div class="my-auto mr-2">
					<img src="{{ $b->thumbnail }}" style="width: 100px;">
				</div>
				<div class="ml-auto">
					{{ $b->blog_title }}
				</div>
			</div>
		</a>
		@endforeach
	</div>
</div>

<div class="card mt-3">
  <div class="card-body">
  	<h5>Categories</h5>
		@foreach($cat as $c)
			<div>
				<i class="fas fa-angle-right"></i> <a class="text-muted text-decoration-none" href="{{ url('blogs/categories/'.$c->category_name) }}"> {{ $c->category_name }}</a>
			</div>
		@endforeach
	</div>
</div>

<div class="card mt-3">
  <div class="card-body">
  	<h5>Tags</h5>
		@foreach($tag as $t)
			<div>
				<i class="fas fa-angle-right"></i> <a class="text-muted text-decoration-none" href="{{ url('blogs/tags/'.$t->tag_name) }}"> {{ $t->tag_name }}</a>
			</div>
		@endforeach
	</div>
</div>

@endsection
@endif