<style type="text/css">
	.title{
		font-size: 1.2rem;
		line-height: 25px;
		height: 80px;
		text-overflow: ellipsis;
		font-family: "MaisonNeue-Demi",sans-serif;
		word-break: break-word;
		display: -webkit-box;
		-webkit-box-orient: vertical;
    -webkit-line-clamp: 3;
    margin-bottom: 10px;
    overflow: hidden;
	}
	.author{
		font-size: 0.8rem;
	}
	.date{
		font-size: 0.8rem;
	}
	.search{
		font-size: 1rem;
		font-weight: 800;
	}
</style>

@extends('layouts.front_blog')

@if($count==0)

@section('title','Blog')

@section('content')

<div class="col-md-10 offset-md-1 col-12 mt-3 mb-3">
	<h1>Blog PalComTech</h1>
	<div class="row">
		<div class="col-md-6 col-12">
			<form action="{{ url('blogs/search') }}" method="get">
				<div class="input-group">
				  <input type="text" name="q" placeholder="Cari Artikel ?" autocomplete="off" class="form-control">
				  <div class="input-group-append">
				    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Cari</button>
				  </div>
				</div>
			</form>
		</div>
	</div>

	<div class="row mt-3 mb-3">
		<div class="col-12">
			<div class="search">
				"{{ $keyword }} " <span class="text-danger">{{ $count }}</span> result found
			</div>
		</div>
	</div>

	<div class="card mt-3">
	  <div class="card-body">
			<h3>Maaf, Kata kunci yang anda cari tidak ditemukan</h3>
		</div>
	</div>
</div>

@endsection

@else
@section('title', 'Blog PalComTech')
@section('description','Description')

@section('content')

<div class="col-md-10 offset-md-1 col-12 mt-3 mb-3">
	<h1>Blog PalComTech</h1>
	<div class="row">
		<div class="col-md-6 col-12">
			<form action="{{ url('blogs/search') }}" method="get">
				<div class="input-group">
				  <input type="text" name="q" placeholder="Cari Artikel ?" autocomplete="off" class="form-control">
				  <div class="input-group-append">
				    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Cari</button>
				  </div>
				</div>
			</form>
		</div>
	</div>

	<div class="row mt-3 mb-3">
		<div class="col-12">
			<div class="search">
				"{{ $keyword }} " {{ $count }} result found
			</div>
		</div>
	</div>

	<div class="row">
	@foreach($data as $blog)
	<div class="col-md-4 col-12">
		<a href="{{ url('blogs/preview/'.$blog->slug) }}" class="text-decoration-none text-dark">
			<div class="card mt-3 mb-3">
				<img src="{{ $blog->thumbnail }}" class="card-img-top" alt="{{ $blog->blog_title }}">
			  <div class="card-body">
			  	<div class="title">
						{{ $blog->blog_title }}
					</div>
					<div class="d-flex">
						<div class="author">
							{{ $blog->user->name }}
						</div>
						<div class="date ml-auto">
							{{ date("d M Y", strtotime($blog->created_at)) }}
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>
	@endforeach
	</div>
</div>

@endsection

@endif