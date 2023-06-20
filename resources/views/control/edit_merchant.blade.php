@extends('layouts.dashboard')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Merchant</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/home/Merchant') }}">Merchant</a></li>
          <li class="breadcrumb-item active">Add</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<div class="content-body">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-6">
				<div class="card">
					<div class="card-body">
						<form action="{{ url('home/Merchant/update') }}" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="form-group">
								<input type="hidden" name="id" value="{{ $data->id }}">
							</div>
							<div class="form-group">
								<label>Nama Merchant</label>
								<input type="text" name="name" class="form-control @if($errors->first('name')) is-invalid @endif" autofocus="" value="{{ $data->name }}" autocomplete="off" placeholder="Input Nama Merchant">
								<span class="error invalid-feedback">{{ $errors->first('name') }}</span>
							</div>
							<div class="form-group">
								<label>Logo</label>
								<input type="file" name="logo" class="form-control @if($errors->first('logo')) is-invalid @endif" autocomplete="off" placeholder="Input Logo">
								<span class="error invalid-feedback">{{ $errors->first('logo') }}</span>
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