@extends('layouts.dashboard')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Ads Banner</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          <li class="breadcrumb-item active">Ads Banner</li>
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
								<a href="{{ url('/home/banners/add') }}" class="btn btn-primary">Add Ads Banner</a>
							</div>
							<table class="table DT">
								<thead>
									<tr>
										<th>No</th>
										<th>Thumbnail</th>
										<th>Title</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php
									$no = 1;
									@endphp
									@foreach($data as $gimmick)
									<tr>
										<td>{{ $no++ }}</td>
										<td><img src="{{ $gimmick->thumbnail }}" style="width: 100px; height: auto;"></td>
										<td>{{ $gimmick->gimmick_title }}</td>
										<td>@if($gimmick->status=='Aktif') <label class="badge badge-success">{{ $gimmick->status }}</label> @else <label class="badge badge-danger">{{ $gimmick->status }}</label> @endif</td>
										<td><a target="_blank" href="{{ url('/banners/preview/'.$gimmick->slug) }}" class="btn btn-sm btn-light" title="Preview"><i class="fa fa-search"></i></a> @if($gimmick->status=='Aktif') <a href="{{ url('home/banners/non-active/'.$gimmick->uid) }}" class="btn btn-sm btn-danger" title="Non Aktifkan {{ $gimmick->gimmick_title }}"><i class="fa fa-times"></i></a> @else <a href="{{ url('home/banners/active/'.$gimmick->uid) }}" class="btn btn-sm btn-success" title="Aktifkan {{ $gimmick->gimmick_title }}"><i class="fa fa-check"></i></a> @endif<a href="{{ url('home/banners/edit/'.$gimmick->uid) }}" class="btn btn-sm btn-warning" title="Edit Data {{ $gimmick->gimmick_title }}"><i class="fa fa-pen"></i></a> <a href="{{ url('home/banners/delete/'.$gimmick->uid) }}" class="btn btn-sm btn-danger" title="Hapus Data {{ $gimmick->gimmick_title }}"><i class="fa fa-trash"></i></a></td>
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