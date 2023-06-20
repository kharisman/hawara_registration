@extends('layouts.dashboard')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Webinar</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/home/webinar') }}">Webinar</a></li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<div class="content-body">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-12">
				<div class="card">
					<div class="card-body">
						<form action="{{ url('/home/webinars/update') }}" method="post">
							{{ csrf_field() }}
							<div class="form-group">
								<input type="hidden" name="uid" value="{{ $data->uid }}">
							</div>
							<div class="form-group">
								<input type="hidden" name="branch_uid" value="{{ Auth::user()->branch_uid }}">
							</div>
							<div class="form-group">
								<label>Webinar Name</label>
								<input type="text" name="webinar_name" autocomplete="off" autofocus="" class="form-control @if($errors->first('webinar_name')) is-invalid @endif" value="{{ $data->webinar_name }}" placeholder="Edit Webinar Name">
								<span class="error invalid-feedback">{{ $errors->first('webinar_name') }}</span>
							</div>
							<div class="form-group">
								<label>Description</label>
								<textarea class="form-control summernote @if($errors->first('description')) is-invalid @endif" name="description" placeholder="Input Description">{{ $data->description }}</textarea>
								<span class="error invalid-feedback">{{ $errors->first('description') }}</span>
							</div>
							<div class="form-group">
								<label>Facility</label>
								<input type="text" name="facility" autocomplete="off" value="{{ $data->facility }}" class="form-control @if($errors->first('facility')) is-invalid @endif" placeholder="Input Facility">
								<span class="error invalid-feedback">{{ $errors->first('facility') }}</span>
							</div>
							<div class="form-group">
								<label>Price</label>
								<input type="number" name="price" autocomplete="off" value="{{ $data->price }}" class="form-control @if($errors->first('price')) is-invalid @endif" placeholder="Input Price">
								<span class="error invalid-feedback">{{ $errors->first('price') }}</span>
							</div>
							<div class="form-group">
								<label>Discount</label>
								<input type="number" name="discount" autocomplete="off" value="{{ $data->discount }}" class="form-control @if($errors->first('discount')) is-invalid @endif" placeholder="Input Discount">
								<span class="error invalid-feedback">{{ $errors->first('discount') }}</span>
							</div>
							<div class="form-group">
								<label>Date</label>
								<input type="date" name="date" autocomplete="off" value="{{ $data->date }}" class="form-control @if($errors->first('date')) is-invalid @endif" placeholder="Input Date">
								<span class="error invalid-feedback">{{ $errors->first('date') }}</span>
							</div>
							<div class="form-group">
								<label>Cover</label>
								<input type="file" name="image" autocomplete="off" class="form-control @if($errors->first('image')) is-invalid @endif" placeholder="Input Image">
								<span class="error invalid-feedback">{{ $errors->first('image') }}</span>
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