@extends('layouts.dashboard')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Blog</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/home/blogs') }}">Blog</a></li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<div class="content-body">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-md-12 col-12">
				<div class="card">
					<div class="card-body">
						<form action="{{ url('home/blogs/update') }}" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="form-group">
								<input type="hidden" name="uid" value="{{ $data->uid }}">
							</div>
							<div class="form-group">
								<input type="hidden" name="user_uid" value="{{ Auth::user()->uid }}">
							</div>
							<div class="form-group">
								<label>Category Blog</label>
								<select class="form-control select2 @if($errors->first('category_blog_uid')) is-invalid @endif" style="width: 100%;" name="category_blog_uid">
									@foreach($category as $cat)
									<option value="{{ $cat->uid }}" @if($data->category_blog_uid==$cat->uid) selected @endif>{{ $cat->category_name }}</option>
									@endforeach
								</select>
								<span class="error invalid-feedback">{{ $errors->first('category_blog_uid') }}</span>
							</div>
							<div class="form-group">
								<label>Title</label>
								<input type="text" name="blog_title" class="form-control @if($errors->first('blog_title')) is-invalid @endif" value="{{ $data->blog_title }}" autofocus="" autocomplete="off" placeholder="Input Title">
								<span class="error invalid-feedback">{{ $errors->first('blog_title') }}</span>
							</div>
							<div class="form-group">
								<label>Meta Description</label>
								<input type="text" name="meta_description" class="form-control @if($errors->first('meta_description')) is-invalid @endif" value="{{ $data->meta_description }}" autocomplete="off" placeholder="Input Meta">
								<span class="error invalid-feedback">{{ $errors->first('meta_description') }}</span>
							</div>
							<div class="form-group">
								<label>Post</label>
								<textarea name="description" class="form-control summernote @if($errors->first('description')) is-invalid @endif" autocomplete="off" placeholder="Input Title">{{ $data->description }}</textarea>
								<span class="error invalid-feedback">{{ $errors->first('description') }}</span>
							</div>
							<div class="form-group">
								<label>Tag</label>
								<select name="tags[]" class="form-control select2" multiple="multiple" style="width: 100%;">
									@foreach($tag as $t)
									<option value="{{ $t->uid }}" @foreach(json_decode($data->tags) as $row) @if($t->uid==$row) selected @endif @endforeach> {{ $t->tag_name }}</option>
									@endforeach
								</select>
								<span class="error invalid-feedback">{{ $errors->first('tags') }}</span>
							</div>
							<div class="form-group">
								<label>Thumbnail</label>
								<input type="file" name="thumbnail" class="form-control @if($errors->first('thumbnail')) is-invalid @endif" autocomplete="off" placeholder="Input Thumbnail">
								<span class="error invalid-feedback">{{ $errors->first('thumbnail') }}</span>
							</div>
							<div class="form-group">
								<button class="btn btn-primary">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection