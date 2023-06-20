@extends('layouts.dashboard')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">User</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/home/users') }}">User</a></li>
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
						<form action="{{ url('home/users/update-pass') }}" method="post">
							{{ csrf_field() }}
							<div class="form-group">
								<input type="hidden" name="uid" value="{{ $data->uid }}">
							</div>
							<div class="form-group">
								<label>E-Mail</label>
								<input type="text" readonly="" name="email" class="form-control @if($errors->first('email')) is-invalid @endif" value="{{ $data->email }}" autocomplete="off" placeholder="Input E-Mail">
								<span class="error invalid-feedback">{{ $errors->first('email') }}</span>
							</div>
							<div class="form-group">
								<label>New Password</label>
								<input type="password" name="new_pass" class="form-control @if($errors->first('new_pass')) is-invalid @endif" autofocus="" autocomplete="off" placeholder="Input New Password">
								<span class="error invalid-feedback">{{ $errors->first('new_pass') }}</span>
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