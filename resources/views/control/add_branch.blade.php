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
						<form action="{{ url('/home/branches/create') }}" method="post">
							{{ csrf_field() }}
							<div class="form-group">
								<label>Branch Name</label>
								<input type="text" name="branch_name" autocomplete="off" autofocus="" class="form-control @if($errors->first('branch_name')) is-invalid @endif" value="{{ old('branch_name') }}" placeholder="Input Branch">
								<span class="error invalid-feedback">{{ $errors->first('branch_name') }}</span>
							</div>
							<div class="form-group">
								<label>Phone Number</label>
								<input type="text" name="phone_number" value="{{ old('phone_number') }}" autocomplete="off" class="form-control @if($errors->first('phone_number')) is-invalid @endif" placeholder="Input Phone Number">
								<span class="error invalid-feedback">{{ $errors->first('phone_number') }}</span>
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