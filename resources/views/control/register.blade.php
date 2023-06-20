@extends('layouts.dashboard')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Registrasi</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          <li class="breadcrumb-item active">Registrasi</li>
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
							<h3>Program Tanpa Opsi Pembayaran</h3>
							<table class="table DT">
								<thead>
									<tr>
										<th>No</th>
										<th>Email</th>
										<th>Name</th>
										<th>Phone</th>
										<th>Program</th>
										<th>Waktu Daftar</th>
										<th>Total Pembayaran</th>
										<th>Status Pembayaran</th>
										<th>Tanggal Pembayaran</th>
									</tr>
								</thead>
								<tbody>
									@php
									$no = 1;
									@endphp
									@foreach($data3 as $register)
										@if(Auth::user()->branch_uid==$register->branch_uid || Auth::user()->roles=='Super Admin' || Auth::user()->roles=='Keuangan')
									<tr>
										<td>{{ $no++ }}</td>
										<td>{{ $register->email }}</td>
										<td>{{ $register->name }}</td>
										<td>{{ $register->phone }}</td>
										<td>{{ $register->product_name.' ('.$register->branch_name.')' }}</td>
										<td>{{ date('d M Y H:i:s', strtotime($register->created_at)) }}</td>
										<td>Rp {{ number_format($register->totalPay,0,".",",") }}</td>
										<td>{{ $register->status }}</td>
										<td>{{ $register->datePay ? $register->datePay : '-' }}</td>
									</tr>
										@endif
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<h3>Program Dengan Opsi Pembayaran</h3>
							<table class="table DT">
								<thead>
									<tr>
										<th>No</th>
										<th>Email</th>
										<th>Name</th>
										<th>Phone</th>
										<th>Program</th>
										<th>Waktu Daftar</th>
										<th>Total Pembayaran</th>
										<th>Status Pembayaran</th>
										<th>Tanggal Pembayaran</th>
									</tr>
								</thead>
								<tbody>
									@php
									$no = 1;
									@endphp
									@foreach($data1 as $register)
										@if(Auth::user()->branch_uid==$register->branch_uid || Auth::user()->roles=='Super Admin' || Auth::user()->roles=='Keuangan')
									<tr>
										<td>{{ $no++ }}</td>
										<td>{{ $register->email }}</td>
										<td>{{ $register->name }}</td>
										<td>{{ $register->phone }}</td>
										<td>{{ $register->product_name.' ('.$register->branch_name.')' }}</td>
										<td>{{ date('d M Y H:i:s', strtotime($register->created_at)) }}</td>
										<td>Rp {{ number_format($register->totalPay,0,".",",") }}</td>
										<td>{{ $register->status }}</td>
										<td>{{ $register->datePay ? $register->datePay : '-' }}</td>
									</tr>
										@endif
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<h3>Webinar</h3>
							<table class="table DT">
								<thead>
									<tr>
										<th>No</th>
										<th>Email</th>
										<th>Name</th>
										<th>Phone</th>
										<th>Program</th>
										<th>Waktu Daftar</th>
										<th>Total Pembayaran</th>
										<th>Status Pembayaran</th>
										<th>Tanggal Pembayaran</th>
									</tr>
								</thead>
								<tbody>
									@php
									$no = 1;
									@endphp
									@foreach($data2 as $register)
										@if(Auth::user()->branch_uid==$register->branch_uid || Auth::user()->roles=='Super Admin' || Auth::user()->roles=='Keuangan')
									<tr>
										<td>{{ $no++ }}</td>
										<td>{{ $register->email }}</td>
										<td>{{ $register->name }}</td>
										<td>{{ $register->phone }}</td>
										<td>{{ $register->webinar_name.' ('.$register->branch_name.')' }}</td>
										<td>{{ date('d M Y H:i:s', strtotime($register->created_at)) }}</td>
										<td>Rp {{ number_format($register->totalPay,0,".",",") }}</td>
										<td>{{ $register->status }}</td>
										<td>{{ $register->datePay ? $register->datePay : '-' }}</td>
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