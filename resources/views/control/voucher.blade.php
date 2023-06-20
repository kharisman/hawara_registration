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
          <li class="breadcrumb-item active">Voucher</li>
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
								@if(Auth::user()->roles=='AO')
								<a href="{{ url('/home/vouchers/add') }}" class="btn btn-primary">Add Voucher</a>
								@endif
							</div>
							<table class="table DT">
								<thead>
									<tr>
										<th>No</th>
										<th>Product Name</th>
										<th>Voucher Code</th>
										<th>Nominal</th>
										<th>Tanggal Mulai</th>
										<th>Tanggal Expired</th>
										<th>Kuota</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php
									$no = 1;
									@endphp
									@foreach($data as $voucher)
										@if(Auth::user()->branch_uid == $voucher->product_branch[0]->branch->uid)
									<tr>
										<td>{{ $no++ }}</td>
										<td>{{ $voucher->product_branch[0]->product->product_name }} ({{ $voucher->product_branch[0]->branch->branch_name }})</td>
										<td>{{ $voucher->voucher_code }}</td>
										<td>Rp. {{ number_format($voucher->nominal,0,",",".") }}</td>
										<td>{{ date('d F Y',strtotime($voucher->useDate)) }}</td>
										<td>{{ date('d F Y',strtotime($voucher->expireDate)) }}</td>
										<td>{{ $voucher->quota }} Voucher</td>
										<td><a href="{{ url('/home/vouchers/edit/'.$voucher->uid) }}" class="btn btn-sm btn-warning"><i class="fa fa-pen"></i></a> <a href="{{ url('/home/vouchers/delete/'.$voucher->uid) }}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a></td>
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