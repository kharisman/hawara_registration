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
						<form action="{{ url('/home/users/create') }}" method="post">
							{{ csrf_field() }}
							<div class="form-group">
								<label>Email</label>
								<input type="email" name="email" autocomplete="off" autofocus="" class="form-control @if($errors->first('email')) is-invalid @endif" value="{{ old('email') }}" placeholder="Input E-Mail">
								<span class="error invalid-feedback">{{ $errors->first('email') }}</span>
							</div>
							<div class="form-group">
								<label>Name</label>
								<input type="text" name="name" value="{{ old('name') }}" autocomplete="off" class="form-control @if($errors->first('name')) is-invalid @endif" placeholder="Input Name">
								<span class="error invalid-feedback">{{ $errors->first('name') }}</span>
							</div>
							<div class="form-group">
								<label>Roles</label>
								<select class="form-control select2 @if($errors->first('roles')) is-invalid @endif" name="roles">
									<option value="Kepala">Kepala</option>
									<option value="Keuangan">Keuangan</option>
									<option value="AO">AO</option>
									<option value="Admin">Admin</option>
								</select>
								<span class="error invalid-feedback">{{ $errors->first('roles') }}</span>
							</div>
							<div class="form-group">
								<label>Branch</label>
								<select class="form-control select2 @if($errors->first('branch_uid')) is-invalid @endif" name="branch_uid">
									<option value="0">-</option>
									@foreach($data as $branch)
									<option value="{{ $branch->uid }}">{{ $branch->branch_name }}</option>
									@endforeach
								</select>
								<span class="error invalid-feedback">{{ $errors->first('branch_uid') }}</span>
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" name="password" class="form-control @if($errors->first('password')) is-invalid @endif" placeholder="Input Password">
								<span class="error invalid-feedback">{{ $errors->first('password') }}</span>
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