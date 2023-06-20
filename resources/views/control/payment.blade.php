@extends('layouts.dashboard')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Payment</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          <li class="breadcrumb-item active">Payment</li>
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
							<h3>All Program</h3>
							<table class="table table-striped DT">
								<thead>
									<tr>
										<th>No</th>
										<th>Email</th>
										<th>Name</th>
										<th>Phone</th>
										<th>Program</th>
										<th>Waktu Daftar</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php
									$no = 1;
									$now = date('Y-m-d H:i:s');
									@endphp
									@foreach($data1 as $payment)
										@if(Auth::user()->branch_uid==$payment->branch_uid || Auth::user()->roles=='Super Admin')
									<tr>
										<td>{{ $no++ }}</td>
										<td>{{ $payment->email }}</td>
										<td>{{ $payment->name }}</td>
										<td>{{ $payment->phone }}</td>
										<td>{{ $payment->product_name.' ('.$payment->branch_name.')' }}</td>
										<td>{{ date('d M Y H:i:s', strtotime($payment->created_at)) }}</td>
										<td>
											@if($payment->status=='waiting' && (strtotime($payment->dateExpired)-strtotime($now)) >= 0 )
											<label class="badge badge-warning">Waiting</label>
											@elseif($payment->status=='waiting' && (strtotime($payment->dateExpired)-strtotime($now)) < 0 )
											<label class="badge badge-danger">Cancel</label>
											@elseif($payment->status=='paid' && $payment->statusPay=='Online')
											<label class="badge badge-success">Paid Online</label>
											@elseif($payment->status=='paid' && $payment->statusPay=='Offline')
											<label class="badge badge-success">Paid Offline</label>
											@endif
										</td>
										<td>
											@if($payment->branch_uid==Auth::user()->branch_uid && Auth::user()->roles=='AO')
												@if($payment->status=='waiting' && (strtotime($payment->dateExpired)-strtotime($now)) >= 0 )
													<a onclick="return confirm('Apakah anda yakin <?=$payment->name?> telah membayar di Outlet ?')" href="{{ url('/home/payments/paid/'.$payment->uid) }}" title="Pembayaran Offline" class="btn btn-sm btn-success"><i class="fa fa-check"></i></a>
												@endif
											<a data-toggle="modal" data-target=".pay" data-no="{{ $payment->noPay }}" data-id="{{ $payment->uid }}" data-code="{{ $payment->codePay }}" data-total="{{ $payment->totalPay }}" data-product="{{ $payment->product_name }}" data-branch="{{ $payment->branch_name }}" data-time="{{ $payment->dateExpired }}" data-date="{{ $payment->datePay }}" data-status="{{ $payment->status }}" data-pay="{{ $payment->statusPay }}"  class="btn btn-sm btn-outline-light"><i class="fa fa-list"></i></a>
											@elseif($payment->branch_uid==Auth::user()->branch_uid && Auth::user()->roles=='Kepala')
											<a data-toggle="modal" data-target=".pay" data-no="{{ $payment->noPay }}" data-id="{{ $payment->uid }}" data-code="{{ $payment->codePay }}" data-total="{{ $payment->totalPay }}" data-product="{{ $payment->product_name }}" data-branch="{{ $payment->branch_name }}" data-time="{{ $payment->dateExpired }}" data-date="{{ $payment->datePay }}" data-status="{{ $payment->status }}" data-pay="{{ $payment->statusPay }}"  class="btn btn-sm btn-outline-light"><i class="fa fa-list"></i></a>
											@elseif(Auth::user()->roles=='Super Admin')
											<a data-toggle="modal" data-target=".pay" data-no="{{ $payment->noPay }}" data-id="{{ $payment->uid }}" data-code="{{ $payment->codePay }}" data-total="{{ $payment->totalPay }}" data-product="{{ $payment->product_name }}" data-branch="{{ $payment->branch_name }}" data-time="{{ $payment->dateExpired }}" data-date="{{ $payment->datePay }}" data-status="{{ $payment->status }}" data-pay="{{ $payment->statusPay }}"  class="btn btn-sm btn-outline-light"><i class="fa fa-list"></i></a>
												@if($payment->statusPay=='Offline' && (strtotime($payment->dateExpired)-strtotime($now)) >= 0 )
												<a onclick="return confirm('Apakah anda yakin anda ingin mereset pembayaran <?=$payment->name?> ?')" href="{{ url('/home/payments/reset/'.$payment->uid) }}" title="Reset Pembayaran" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
												@endif
											@endif
										</td>
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
							<table class="table table-striped DT">
								<thead>
									<tr>
										<th>No</th>
										<th>Email</th>
										<th>Name</th>
										<th>Phone</th>
										<th>Program</th>
										<th>Waktu Daftar</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php
									$no = 1;
									$now = date('Y-m-d H:i:s');
									@endphp
									@foreach($data2 as $payment)
										@if(Auth::user()->branch_uid==$payment->branch_uid || Auth::user()->roles=='Super Admin')
									<tr>
										<td>{{ $no++ }}</td>
										<td>{{ $payment->email }}</td>
										<td>{{ $payment->name }}</td>
										<td>{{ $payment->phone }}</td>
										<td>{{ $payment->webinar_name.' ('.$payment->branch_name.')' }}</td>
										<td>{{ date('d M Y H:i:s', strtotime($payment->created_at)) }}</td>
										<td>
											@if($payment->status=='waiting' && (strtotime($payment->dateExpired)-strtotime($now)) >= 0 )
											<label class="badge badge-warning">Waiting</label>
											@elseif($payment->status=='waiting' && (strtotime($payment->dateExpired)-strtotime($now)) < 0 )
											<label class="badge badge-danger">Cancel</label>
											@elseif($payment->status=='paid' && $payment->statusPay=='Online')
											<label class="badge badge-success">Paid Online</label>
											@elseif($payment->status=='paid' && $payment->statusPay=='Offline')
											<label class="badge badge-success">Paid Offline</label>
											@endif
										</td>
										<td>
											@if($payment->branch_uid==Auth::user()->branch_uid && Auth::user()->roles=='AO')
												@if($payment->status=='waiting' && (strtotime($payment->dateExpired)-strtotime($now)) >= 0 )
													<a onclick="return confirm('Apakah anda yakin <?=$payment->name?> telah membayar di Outlet ?')" href="{{ url('/home/payments/paid/'.$payment->uid) }}" title="Pembayaran Offline" class="btn btn-sm btn-success"><i class="fa fa-check"></i></a>
												@endif
											<a data-toggle="modal" data-target=".pay" data-no="{{ $payment->noPay }}" data-id="{{ $payment->uid }}" data-code="{{ $payment->codePay }}" data-total="{{ $payment->totalPay }}" data-product="{{ $payment->webinar_name }}" data-branch="{{ $payment->branch_name }}" data-time="{{ $payment->dateExpired }}" data-date="{{ $payment->datePay }}" data-status="{{ $payment->status }}" data-pay="{{ $payment->statusPay }}"  class="btn btn-sm btn-outline-light"><i class="fa fa-list"></i></a>
											@elseif($payment->branch_uid==Auth::user()->branch_uid && Auth::user()->roles=='Kepala')
											<a data-toggle="modal" data-target=".pay" data-no="{{ $payment->noPay }}" data-id="{{ $payment->uid }}" data-code="{{ $payment->codePay }}" data-total="{{ $payment->totalPay }}" data-product="{{ $payment->webinar_name }}" data-branch="{{ $payment->branch_name }}" data-time="{{ $payment->dateExpired }}" data-date="{{ $payment->datePay }}" data-status="{{ $payment->status }}" data-pay="{{ $payment->statusPay }}"  class="btn btn-sm btn-outline-light"><i class="fa fa-list"></i></a>
											@elseif(Auth::user()->roles=='Super Admin')
											<a data-toggle="modal" data-target=".pay" data-no="{{ $payment->noPay }}" data-id="{{ $payment->uid }}" data-code="{{ $payment->codePay }}" data-total="{{ $payment->totalPay }}" data-product="{{ $payment->webinar_name }}" data-branch="{{ $payment->branch_name }}" data-time="{{ $payment->dateExpired }}" data-date="{{ $payment->datePay }}" data-status="{{ $payment->status }}" data-pay="{{ $payment->statusPay }}"  class="btn btn-sm btn-outline-light"><i class="fa fa-list"></i></a>
												@if($payment->statusPay=='Offline' && (strtotime($payment->dateExpired)-strtotime($now)) >= 0 )
												<a onclick="return confirm('Apakah anda yakin anda ingin mereset pembayaran <?=$payment->name?> ?')" href="{{ url('/home/payments/reset/'.$payment->uid) }}" title="Reset Pembayaran" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
												@endif
											@endif
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