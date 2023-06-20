@extends('layouts.dashboard')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Program Hadiah</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/home/Gift') }}">Program Hadiah</a></li>
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
						<form action="{{ url('home/Gift/create') }}" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="form-group">
								<label>Nama Merchant</label>
								<select class="form-control" name="qrmerchant_id">
									@foreach($merchant as $mc)
									<option value="{{ $mc->id }}">{{ $mc->name }}</option>
									@endforeach
								</select>
								<span class="error invalid-feedback">{{ $errors->first('qrmerchant_id') }}</span>
							</div>
							<div class="form-group">
								<label>Nama Program Hadiah</label>
								<input type="text" name="name" class="form-control @if($errors->first('name')) is-invalid @endif" autofocus="" value="{{ old('name') }}" autocomplete="off" placeholder="Input Nama Program Hadiah">
								<span class="error invalid-feedback">{{ $errors->first('name') }}</span>
							</div>
							<div class="form-group">
								<label>Gambar</label>
								<input type="file" name="image" class="form-control @if($errors->first('image')) is-invalid @endif" autocomplete="off" placeholder="Input Logo">
								<span class="error invalid-feedback">{{ $errors->first('image') }}</span>
							</div>
							<div class="form-group">
								<label>Deskripsi</label>
								<textarea name="description" class="form-control summernote @if($errors->first('description')) is-invalid @endif" value="{{ old('description') }}" autocomplete="off" placeholder="Input Deskripsi"></textarea>
								<span class="error invalid-feedback">{{ $errors->first('description') }}</span>
							</div>
							<div class="form-group">
								<label>Stok</label>
								<input type="number" name="stock" class="form-control @if($errors->first('stock')) is-invalid @endif" value="{{ old('stock') }}" autocomplete="off" placeholder="Input Stok Hadiah">
								<span class="error invalid-feedback">{{ $errors->first('stock') }}</span>
							</div>
							<div class="form-group">
								<label>Expired</label>
								<select class="form-control" name="expired">
									@for($i = 1; $i<=30; $i++)
									<option value="{{ $i }}">{{ $i }}</option>
									@endfor
								</select>
								<span class="error invalid-feedback">{{ $errors->first('expired') }}</span>
							</div>
							<div class="form-group">
								<label>Digunakan</label>
								<input type="number" name="used" class="form-control @if($errors->first('used')) is-invalid @endif" value="{{ old('used') }}" autocomplete="off" placeholder="Input Hadiah Digunakan">
								<span class="error invalid-feedback">{{ $errors->first('used') }}</span>
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