@extends('layouts.dashboard')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Banner</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/home/banner') }}">Banner</a></li>
          <li class="breadcrumb-item active">Add</li>
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
						<form action="{{ url('home/banner/create') }}" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="form-group">
								<label>Title</label>
								<input type="text" name="title" class="form-control @if($errors->first('title')) is-invalid @endif" autofocus="" value="{{ old('title') }}" autocomplete="off" placeholder="Input Title">
								<span class="error invalid-feedback">{{ $errors->first('title') }}</span>
							</div>
							<div class="form-group">
								<label>Link</label>
								<input type="text" name="link" class="form-control @if($errors->first('link')) is-invalid @endif" autofocus="" value="{{ old('link') }}" autocomplete="off" placeholder="Input Link">
								<span class="error invalid-feedback">{{ $errors->first('link') }}</span>
							</div>
							<div class="form-group">
								<label>Banner Desktop</label>
								<input type="file" name="banner_desktop" class="form-control @if($errors->first('banner_desktop')) is-invalid @endif" autocomplete="off" placeholder="Input Banner Desktop">
								<span class="error invalid-feedback">{{ $errors->first('banner_desktop') }}</span>
							</div>
							<div class="form-group">
								<label>Banner Mobile</label>
								<input type="file" name="banner_mobile" class="form-control @if($errors->first('banner_mobile')) is-invalid @endif" autocomplete="off" placeholder="Input Banner Mobile">
								<span class="error invalid-feedback">{{ $errors->first('banner_mobile') }}</span>
							</div>
							<div class="form-group">
								<label>Order</label>
								<input type="number" name="order" class="form-control @if($errors->first('order')) is-invalid @endif" autofocus="" value="{{ old('order') }}" autocomplete="off" placeholder="Input Order">
								<span class="error invalid-feedback">{{ $errors->first('order') }}</span>
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