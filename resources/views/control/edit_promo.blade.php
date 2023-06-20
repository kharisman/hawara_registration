@extends('layouts.dashboard')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Promo</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/home/promos') }}">Promo</a></li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<div class="content-body">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-md-6 col-12">
				<div class="card">
					<div class="card-body">
						<form action="{{ url('home/promos/update') }}" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="form-group">
								<input type="hidden" name="uid" value="{{ $data->uid }}">
							</div>
							<div class="form-group">
								<label>Title</label>
								<input type="text" name="promo_title" class="form-control @if($errors->first('promo_title')) is-invalid @endif" value="{{ $data->promo_title }}" autofocus="" autocomplete="off" placeholder="Input Title">
								<span class="error invalid-feedback">{{ $errors->first('promo_title') }}</span>
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