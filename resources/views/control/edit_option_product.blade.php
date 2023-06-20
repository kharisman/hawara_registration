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
						<form action="{{ url('home/option_products/update') }}" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="form-group">
								<input type="hidden" name="uid" value="{{ $data->uid }}">
							</div>
							<div class="form-group">
								<input type="hidden" name="user_uid" value="{{ Auth::user()->uid }}">
							</div>
							<div class="form-group">
								<label>Product</label>
								<input type="hidden" name="branch_product_uid" class="form-control" value="{{ $data->product_branch_uid }}">
								<input type="text" readonly="" class="form-control" value="{{ $product->product_name }}">
								<span class="error invalid-feedback">{{ $errors->first('branch_product_uid') }}</span>
							</div>
							<div class="form-group">
								<label>Option Name</label>
								<input type="text" class="form-control" value="{{ $data->option_name }}" name="option_name" placeholder="Option Name">
							</div>
							<div class="form-group">
								<label>Option Price</label>
								<input type="number" class="form-control" value="{{ $data->option_price }}" name="option_price" placeholder="Option Price">
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