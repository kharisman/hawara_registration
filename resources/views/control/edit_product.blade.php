@extends('layouts.dashboard')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Product</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/home/products') }}">Product</a></li>
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
						<form action="{{ url('/home/products/update') }}" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="form-group">
								<input type="hidden" name="uid" value="{{ $data->uid }}">
							</div>
							<div class="form-group">
								<label>Category</label>
								<select class="form-control select2 @if($errors->first('category_uid')) is-invalid @endif" name="category_uid" style="width: 100%">
									@foreach($category as $cat)
									<option value="{{ $cat->uid }}" @if($data->category_uid==$cat->uid)  selected  @endif>{{ $cat->category_name }}</option>
									@endforeach
								</select>
								<span class="error invalid-feedback">{{ $errors->first('category_uid') }}</span>
							</div>
							<div class="form-group">
								<label>Product Name</label>
								<input type="text" name="product_name" autocomplete="off" autofocus="" class="form-control @if($errors->first('product_name')) is-invalid @endif" value="{{ $data->product_name }}" placeholder="Edit Product Name">
								<span class="error invalid-feedback">{{ $errors->first('product_name') }}</span>
							</div>
							<div class="form-group">
								<label>Description</label>
								<textarea name="description" class="form-control summernote  @if($errors->first('description')) is-invalid @endif" placeholder="Input Description">{{ $data->description }}</textarea>
								<span class="error invalid-feedback">{{ $errors->first('description') }}</span>
							</div>
							<div class="form-group">
								<label>Facility</label>
								<input type="text" name="facility" value="{{ $data->facility }}" autocomplete="off" class="form-control @if($errors->first('facility')) is-invalid @endif" placeholder="Input Facility (eg: Wi-Fi, Booklet)">
								<span class="error invalid-feedback">{{ $errors->first('facility') }}</span>
							</div>
							<div class="form-group">
								<label>Landing Price</label>
								<input type="number" name="landing_price" value="{{ $data->landing_price }}" autocomplete="off" class="form-control @if($errors->first('landing_price')) is-invalid @endif" placeholder="Input Landing Price">
								<span class="error invalid-feedback">{{ $errors->first('landing_price') }}</span>
							</div>
							<div class="form-group">
								<label>Discount</label>
								<input type="number" name="discount" value="{{ $data->discount }}" autocomplete="off" class="form-control @if($errors->first('discount')) is-invalid @endif" placeholder="Input Discount">
								<span class="error invalid-feedback">{{ $errors->first('discount') }}</span>
							</div>
							<div class="form-group">
								<img src="{{ $data->image }}" class="w-25">
							</div>
							<div class="form-group">
								<label>Cover</label>
								<input type="file" name="image" autocomplete="off" class="form-control @if($errors->first('image')) is-invalid @endif">
								<span class="error invalid-feedback">{{ $errors->first('image') }}</span>
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