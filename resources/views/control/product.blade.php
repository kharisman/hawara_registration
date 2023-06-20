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
          <li class="breadcrumb-item active">Product</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<div class="content-body">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-12">
				<div class="form-group">
				@if (session('status'))
					@if (session('status')=='Data Gagal Dihapus')
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  {{ session('status') }}
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
					@else
			    <div class="alert alert-success alert-dismissible fade show" role="alert">
					  {{ session('status') }}
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
					@endif
				@endif
				</div>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<div class="form-group">
								<a href="{{ url('/home/products/add') }}" class="btn btn-primary">Add Product</a>
							</div>
							<table class="table DT">
								<thead>
									<tr>
										<th>No</th>
										<th>Product Name</th>
										<th>Cover</th>
										<th>Description</th>
										<th>Facility</th>
										<th>Landing Price</th>
										<th>Discount</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php
									$no = 1;
									@endphp
									@foreach($data as $product)
									@php $facility = explode(';', $product->facility); @endphp
									<tr>
										<td>{{ $no++ }}</td>
										<td>{{ $product->product_name }}</td>
										<td><img src="{{ $product->image }}" class="w-100"></td>
										<td class="w-25">{!! $product->description !!}</td>
										<td>
											<ul>
											@foreach($facility as $fac)
										  	<li>{{ $fac }}</li>
										  @endforeach
											</ul>
										</td>
										<td>Rp {{ number_format($product->landing_price,0,',','.') }}</td>
										<td>Rp {{ number_format($product->discount,0,',','.') }}</td>
										<td><a href="{{ url('/home/products/edit/'.$product->uid) }}" class="btn btn-sm btn-warning"><i class="fa fa-pen"></i></a> <a href="{{ url('/home/products/delete/'.$product->uid) }}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a></td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection