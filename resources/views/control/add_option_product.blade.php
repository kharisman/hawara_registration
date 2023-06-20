@extends('layouts.dashboard')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Option Product</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/home/option_products') }}">Option Product</a></li>
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
						<form action="{{ url('/home/option_products/create') }}" method="post">
							{{ csrf_field() }}
							<div class="form-group">
								<label>Product</label>
								<select class="form-control select2 @if($errors->first('branch_product_uid')) is-invalid @endif" name="branch_product_uid" style="width: 100%">
									@foreach($product as $pr)
										@if($pr->branch_uid == Auth::user()->branch_uid)
										<option value="{{ $pr->uid }}">{{ $pr->product->product_name }}</option>
										@endif
									@endforeach
								</select>
								<span class="error invalid-feedback">{{ $errors->first('branch_product_uid') }}</span>
							</div>
							<div class="form-group">
								<label>Option Name</label>
								<input type="text" class="form-control" name="option_name" placeholder="Option Name">
							</div>
							<div class="form-group">
								<label>Option Price</label>
								<input type="number" class="form-control" name="option_price" placeholder="Option Price">
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