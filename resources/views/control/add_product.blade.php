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
          <li class="breadcrumb-item active">Add</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<div class="content-body">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 col-12">
				<div class="card">
					<div class="card-body">
						<form action="{{ url('/home/products/create') }}" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="form-group">
								<label>Category</label>
								<select class="form-control select2 @if($errors->first('category_uid')) is-invalid @endif" name="category_uid" style="width: 100%">
									@foreach($data as $category)
									<option value="{{ $category->uid }}">{{ $category->category_name }}</option>
									@endforeach
								</select>
								<span class="error invalid-feedback">{{ $errors->first('category_uid') }}</span>
							</div>
							<div class="form-group">
								<label>Product Name</label>
								<input type="text" name="product_name" autocomplete="off" autofocus="" class="form-control @if($errors->first('product_name')) is-invalid @endif" value="{{ old('product_name') }}" placeholder="Input Product Name">
								<span class="error invalid-feedback">{{ $errors->first('product_name') }}</span>
							</div>
							<div class="form-group">
								<label>Description</label>
								<textarea name="description" class="form-control summernote  @if($errors->first('description')) is-invalid @endif" placeholder="Input Description">{{ old('description') }}</textarea>
								<span class="error invalid-feedback">{{ $errors->first('description') }}</span>
							</div>
							<div class="form-group">
								<label>Facility</label>
								<input type="text" name="facility" value="{{ old('facility') }}" autocomplete="off" class="form-control @if($errors->first('facility')) is-invalid @endif" placeholder="Input Facility (eg: Wi-Fi, Booklet)">
								<span class="error invalid-feedback">{{ $errors->first('facility') }}</span>
							</div>
							<div class="form-group">
								<label>Landing Price</label>
								<input type="number" name="landing_price" value="{{ old('landing_price') }}" autocomplete="off" class="form-control @if($errors->first('landing_price')) is-invalid @endif" placeholder="Input Landing Price">
								<span class="error invalid-feedback">{{ $errors->first('landing_price') }}</span>
							</div>
							<div class="form-group">
								<label>Discount</label>
								<input type="number" name="discount" value="{{ old('discount') }}" autocomplete="off" class="form-control @if($errors->first('discount')) is-invalid @endif" placeholder="Input Discount">
								<span class="error invalid-feedback">{{ $errors->first('discount') }}</span>
							</div>
							<div class="form-group">
								<label>Cover</label>
								<input type="file" name="image" autocomplete="off" class="form-control @if($errors->first('image')) is-invalid @endif">
								<span class="error invalid-feedback">{{ $errors->first('image') }}</span>
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