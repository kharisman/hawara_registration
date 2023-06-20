@extends('layouts.dashboard')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Voucher</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/home/vouchers') }}">Voucher</a></li>
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
						<form action="{{ url('/home/vouchers/create') }}" method="post">
							{{ csrf_field() }}
							<div class="form-group">
								<label>Product Name</label>
								<select class="form-control @if($errors->first('product_branch_id')) is-invalid @endif" style="width: 100%" name="product_branch_id">
									@foreach($data as $voucher)
									<option value="{{$voucher->uid}}">{{$voucher->product->product_name}}</option>
									@endforeach
								</select>
								<span class="error invalid-feedback">{{ $errors->first('product_branch_id') }}</span>
							</div>
							<div class="form-group">
								<label>Voucher Code</label>
								<input type="text" name="voucher_code" class="form-control @if($errors->first('voucher_code')) is-invalid @endif">
								<span class="error invalid-feedback">{{ $errors->first('voucher_code') }}</span>
							</div>
							<div class="form-group">
								<label>Nominal</label>
								<input type="number" min="0" name="nominal" class="form-control @if($errors->first('nominal')) is-invalid @endif">
								<span class="error invalid-feedback">{{ $errors->first('nominal') }}</span>
							</div>
							<div class="form-group">
								<label>Tanggal mulai berlaku</label>
								<input type="date" min="0" name="useDate" class="form-control @if($errors->first('useDate')) is-invalid @endif">
								<span class="error invalid-feedback">{{ $errors->first('useDate') }}</span>
							</div>
							<div class="form-group">
								<label>Tanggal expired</label>
								<input type="date" min="0" name="expDate" class="form-control @if($errors->first('expireDate')) is-invalid @endif">
								<span class="error invalid-feedback">{{ $errors->first('expireDate') }}</span>
							</div>
							<div class="form-group">
								<label>Kuota</label>
								<input type="number" min="0" name="quota" class="form-control @if($errors->first('quota')) is-invalid @endif">
								<span class="error invalid-feedback">{{ $errors->first('quota') }}</span>
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