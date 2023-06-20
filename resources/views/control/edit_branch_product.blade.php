@extends('layouts.dashboard')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Branch Product</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/home/branches') }}">Branch Product</a></li>
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
						<form action="{{ url('/home/branch_products/update') }}" method="post">
							{{ csrf_field() }}
							<div class="form-group">
								<input type="hidden" name="uid" value="{{ $data->uid }}">
							</div>
							<div class="form-group">
								<label>Branch</label>
								<select class="form-control select2 @if($errors->first('branch_uid')) is-invalid @endif" name="branch_uid" style="width: 100%">
									@foreach($branch as $br)
									<option value="{{ $br->uid }}" @if($data->branch_uid==$br->uid)  selected  @else @if(Auth::user()->roles!='Super Admin') disabled @endif @endif>{{ $br->branch_name }}</option>
									@endforeach
								</select>
								<span class="error invalid-feedback">{{ $errors->first('branch_uid') }}</span>
							</div>
							<div class="form-group">
								<label>Product</label>
								<select class="form-control select2 @if($errors->first('product_uid')) is-invalid @endif" name="product_uid" style="width: 100%" >
									@foreach($product as $pr)
									<option value="{{ $pr->uid }}" @if($data->product_uid==$pr->uid)  selected  @else @if(Auth::user()->roles!='Super Admin') disabled @endif @endif>{{ $pr->product_name }}</option>
									@endforeach
								</select>
								<span class="error invalid-feedback">{{ $errors->first('product_uid') }}</span>
							</div>
							<div class="form-group">
								<label>Initial Price</label>
								<input type="number" name="initial_price" autocomplete="off" class="form-control @if($errors->first('initial_price')) is-invalid @endif" value="{{ $data->initial_price }}" placeholder="Edit Initial Price">
								<span class="error invalid-feedback">{{ $errors->first('initial_price') }}</span>
							</div>
							<div class="form-group">
								<label>Registration Fee</label>
								<input type="number" name="registration_price" autocomplete="off" class="form-control @if($errors->first('registration_price')) is-invalid @endif" value="{{ $data->registration_price }}" placeholder="Edit Registration Fee">
								<span class="error invalid-feedback">{{ $errors->first('registration_price') }}</span>
							</div>
							<div class="form-group">
								<label>Product Price</label>
								<input type="number" name="product_price" autocomplete="off" class="form-control @if($errors->first('product_price')) is-invalid @endif" value="{{ $data->product_price }}" placeholder="Edit Product Price">
								<span class="error invalid-feedback">{{ $errors->first('product_price') }}</span>
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