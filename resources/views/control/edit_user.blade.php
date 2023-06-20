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
						<form action="{{ url('home/users/update') }}" method="post">
							{{ csrf_field() }}
							<div class="form-group">
								<input type="hidden" name="uid" value="{{ $data->uid }}">
							</div>
							<div class="form-group">
								<label>E-Mail</label>
								<input type="text" readonly="" name="email" class="form-control @if($errors->first('email')) is-invalid @endif" value="{{ $data->email }}" autofocus="" autocomplete="off" placeholder="Input E-Mail">
								<span class="error invalid-feedback">{{ $errors->first('email') }}</span>
							</div>
							<div class="form-group">
								<label>Name</label>
								<input type="text" name="name" class="form-control @if($errors->first('name')) is-invalid @endif" value="{{ $data->name }}" autofocus="" autocomplete="off" placeholder="Input E-Mail">
								<span class="error invalid-feedback">{{ $errors->first('name') }}</span>
							</div>
							<div class="form-group">
								<label>Roles</label>
								<select class="form-control select2 @if($errors->first('roles')) is-invalid @endif" name="roles">
									<option value="Kepala" @if($data->roles=='Kepala') selected @endif>Kepala</option>
									<option value="Keuangan" @if($data->roles=='Keuangan') selected @endif>Keuangan</option>
									<option value="AO" @if($data->roles=='AO') selected @endif>AO</option>
									<option value="Admin" @if($data->roles=='Admin') selected @endif>Admin</option>
								</select>
								<span class="error invalid-feedback">{{ $errors->first('roles') }}</span>
							</div>
							<div class="form-group">
								<label>Branch</label>
								<select class="form-control select2 @if($errors->first('branch_uid')) is-invalid @endif" name="branch_uid">
									<option value="0">-</option>
									@foreach($branch as $br)
									<option value="{{ $br->uid }}" @if($data->branch_uid==$br->uid) selected @endif>{{ $br->branch_name }}</option>
									@endforeach
								</select>
								<span class="error invalid-feedback">{{ $errors->first('branch_uid') }}</span>
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