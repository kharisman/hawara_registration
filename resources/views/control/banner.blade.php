@extends('layouts.dashboard')

@section('content')

<div class="content-header">
  <div class="container-flid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Banner</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          <li class="breadcrumb-item active">Banner</li>
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
								<a href="{{ url('/home/banner/add') }}" class="btn btn-primary">Add Banner</a>
							</div>
							<table class="table DT">
								<thead>
									<tr>
										<th>No</th>
										<th>Title</th>
										<th>Link</th>
										<th>Banner Desktop</th>
										<th>Banner Mobile</th>
										<th>Order</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php
									$no = 1;
									@endphp
									@foreach($data as $banner)
									<tr>
										<td>{{ $no++ }}</td>
										<td>{{ $banner->title }}</td>
										<td>{{ $banner->link }}</td>
										<td><img src="{{ $banner->banner_desktop }}" style="width: 100px; height: auto;"></td>
										<td><img src="{{ $banner->banner_mobile }}" style="width: 100px; height: auto;"></td>
										<td>{{ $banner->order }}</td>
										<td>@if($banner->status=='1') <label class="badge badge-success">Aktif</label> @else <label class="badge badge-danger">Tidak Aktif</label> @endif</td>
										<td>@if($banner->status=='1') <a href="{{ url('home/banner/non-active/'.$banner->id) }}" class="btn btn-sm btn-danger" title="Non Aktifkan {{ $banner->title }}"><i class="fa fa-times"></i></a> @else <a href="{{ url('home/banner/active/'.$banner->id) }}" class="btn btn-sm btn-success" title="Aktifkan {{ $banner->title }}"><i class="fa fa-check"></i></a> @endif <a href="{{ url('home/banner/delete/'.$banner->id) }}" class="btn btn-sm btn-danger" title="Hapus Data {{ $banner->title }}"><i class="fa fa-trash"></i></a></td>
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