@extends('layouts.dashboard')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Hadiah</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          <li class="breadcrumb-item active">Hadiah</li>
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
								<a href="{{ url('/home/Gift/add') }}" class="btn btn-primary">Add Hadiah</a>
							</div>
							<table class="table DT">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama Merchant</th>
										<th>Nama Hadiah</th>
										<th>Gambar Hadiah</th>
										<th>Deskripsi</th>
										<th>Stok</th>
										<th>Expired</th>
										<th>Digunakan</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php
									$no = 1;
									@endphp
									@foreach($qr as $data)
									<tr>
										<td>{{ $no++ }}</td>
										<td>{{ $data->merchant->name }}</td>
										<td>{{ $data->name }}</td>
										<td><img src="{{ $data->image }}" style="width: 70px;"></td>
										<td>{!! $data->description !!}</td>
										<td>{{ $data->stock }}</td>
										<td>{{ $data->expired }} Hari</td>
										<td>{{ $data->used }}</td>
										<td>@if($data->status == 1) <span class="badge badge-success">Aktif</span> @elseif($data->status == 2) <span class="badge badge-danger">Tidak Aktif</span> @endif</td>
										<td><a href="{{ url('/home/Gift/edit/'.$data->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a> <a href="{{ url('/home/Gift/delete/'.$data->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Hapus</a></td>
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