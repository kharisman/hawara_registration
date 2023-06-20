@extends('layouts.dashboard')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Branch</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/home/branches') }}">Branch</a></li>
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
						<form action="{{ url('/home/branches/update') }}" method="post">
							{{ csrf_field() }}
							<div class="form-group">
								<input type="hidden" name="uid" value="{{ $data->uid }}">
							</div>
							<div class="form-group">
								<label>Branch Name</label>
								<input type="text" name="branch_name" autocomplete="off" autofocus="" class="form-control @if($errors->first('branch_name')) is-invalid @endif" value="{{ $data->branch_name }}" placeholder="Edit Branch Name">
								<span class="error invalid-feedback">{{ $errors->first('branch_name') }}</span>
							</div>
							<div class="form-group">
								<label>Phone Number</label>
								<input type="text" name="phone_number" autocomplete="off" class="form-control @if($errors->first('phone_number')) is-invalid @endif" value="{{ $data->phone_number }}" placeholder="Edit Phone Number">
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