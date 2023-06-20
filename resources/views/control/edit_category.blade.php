@extends('layouts.dashboard')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Category</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/home/categories') }}">Category</a></li>
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
						<form action="{{ url('/home/categories/update') }}" method="post">
							{{ csrf_field() }}
							<div class="form-group">
								<input type="hidden" name="uid" value="{{ $data->uid }}">
							</div>
							<div class="form-group">
								<label>Category Name</label>
								<input type="text" name="category_name" autocomplete="off" autofocus="" class="form-control @if($errors->first('category_name')) is-invalid @endif" value="{{ $data->category_name }}" placeholder="Edit Category Name">
								<span class="error invalid-feedback">{{ $errors->first('category_name') }}</span>
							</div>
							<div class="form-group">
								<label>Description</label>
								<textarea name="description" autocomplete="off" class="form-control @if($errors->first('description')) is-invalid @endif" placeholder="Edit Description">{{ $data->description }}</textarea>
								<span class="error invalid-feedback">{{ $errors->first('phone_number') }}</span>
							</div>
							<div class="form-group">
								<button class="btn btn-primary">Update</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection