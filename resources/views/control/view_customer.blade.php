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
						<div class="form-group">
							<a href="{{ url('home/Claim-Voucher/export') }}" class="btn btn-primary">Export Excel</a>
						</div>
						<div class="table-responsive">
							<table class="table DT">
								<thead>
									<tr>
										<th>No</th>
										<th>Kode Voucher</th>
										<th>Nama Voucher</th>
										<th>Kode Klaim</th>
										<th>Nama</th>
										<th>No HP</th>
										<th>Tanggal Penggunaan Voucher</th>
										<th>Tanggal Klaim</th>
									</tr>
								</thead>
								<tbody>
									@php
									$no = 1;
									@endphp
									@foreach($qr as $voucher)
									<tr>
										<td>{{ $no++ }}</td>
										<td>{{ $voucher->code->code }}</td>
										<td>{{ $voucher->gift->name }}</td>
										<td>{{ $voucher->claim_code }}</td>
										<td>{{ $voucher->name }}</td>
										<td>{{ $voucher->phone }}</td>
										<td> {{ date('d F Y H:i:s',strtotime($voucher->created_at)) }}</td>
										<td>@if($voucher->claim_at==NULL) Belum diklaim @else {{ date('d F Y H:i:s',strtotime($voucher->claim_at)) }} @endif</td>
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