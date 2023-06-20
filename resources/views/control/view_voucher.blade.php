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
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table class="table DT">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama Merchant</th>
										<th>Voucher Code</th>
										<th>Digunakan</th>
										<th>Tanggal Digunakan</th>
										<th>Tanggal Pembuatan</th>
										<th>Tanggal Update</th>
										<th>Tanggal Expired</th>
									</tr>
								</thead>
								<tbody>
									@php
									$no = 1;
									@endphp
									@foreach($qr as $voucher)
									<tr>
										<td>{{ $no++ }}</td>
										<td>{{ $voucher->merchant->name }}</td>
										<td>{{ $voucher->code }}</td>
										<td>{{ $voucher->use }}</td>
										<td>{{ date('d F Y',strtotime($voucher->used_at)) }}</td>
										<td>{{ date('d F Y',strtotime($voucher->created_at)) }}</td>
										<td>{{ date('d F Y',strtotime($voucher->updated_at)) }}</td>
										<td>{{ date('d F Y',strtotime($voucher->deleted_at)) }}</td>
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