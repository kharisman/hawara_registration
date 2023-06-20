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
          <li class="breadcrumb-item active">Branch Product</li>
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
								@if(Auth::user()->roles=='Super Admin')
								<a href="{{ url('/home/branch_products/add') }}" class="btn btn-primary">Add Branch Product</a>
								@endif
							</div>
							<table class="table DT">
								<thead>
									<tr>
										<th>No</th>
										<th>Branch Product Name</th>
										<th>Initial Price</th>
										<th>Registration Price</th>
										<th>Product Price</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php
									$no = 1;
									@endphp
									@foreach($data as $branch_product)
										@if(Auth::user()->branch_uid==$branch_product->branch->uid)
										<tr>
											<td>{{ $no++ }}</td>
											<td>{{ $branch_product->product->product_name.' ('.$branch_product->branch->branch_name.')' }}</td>
											<td>Rp {{ number_format($branch_product->initial_price,0,',','.') }}</td>
											<td>Rp {{ number_format($branch_product->registration_price,0,',','.') }}</td>
											<td>Rp {{ number_format($branch_product->product_price,0,',','.') }}</td>
											<td>
												@if(Auth::user()->branch_uid==$branch_product->branch->uid)
												<a href="{{ url('/home/branch_products/edit/'.$branch_product->uid) }}" class="btn btn-sm btn-warning"><i class="fa fa-pen"></i></a>
												@endif
											</td>
										</tr>
										@endif
										@if(Auth::user()->roles=='Super Admin')
										<tr>
											<td>{{ $no++ }}</td>
											<td>{{ $branch_product->product->product_name.' ('.$branch_product->branch->branch_name.')' }}</td>
											<td>Rp {{ number_format($branch_product->initial_price,0,',','.') }}</td>
											<td>Rp {{ number_format($branch_product->registration_price,0,',','.') }}</td>
											<td>Rp {{ number_format($branch_product->product_price,0,',','.') }}</td>
											<td>
												<a href="{{ url('/home/branch_products/edit/'.$branch_product->uid) }}" class="btn btn-sm btn-warning"><i class="fa fa-pen"></i></a>
												<a href="{{ url('/home/branch_products/delete/'.$branch_product->uid) }}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
											</td>
										</tr>
										@endif
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