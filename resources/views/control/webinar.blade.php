@extends('layouts.dashboard')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Webinar</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          <li class="breadcrumb-item active">Webinar</li>
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
								<a href="{{ url('/home/webinars/add') }}" class="btn btn-primary">Add Webinar</a>
								@endif
							</div>
							<table class="table DT">
								<thead>
									<tr>
										<th>No</th>
										<th>Thumbnail</th>
										<th>Webinar Name</th>
										<th>Description</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php
									$no = 1;
									@endphp
									@foreach($data as $webinar)
										@if($webinar->branch->uid == Auth::user()->branch_uid)
									<tr>
										<td>{{ $no++ }}</td>
										<td><img src="{{ $webinar->image }}" style="width: 100px;height: auto;"></td>
										<td>{{ $webinar->webinar_name }}</td>
										<td>{!! $webinar->description !!}</td>
										<td>@if(Auth::user()->branch_uid==$webinar->branch_uid)<a href="{{ url('/home/webinars/edit/'.$webinar->uid) }}" class="btn btn-sm btn-warning"><i class="fa fa-pen"></i></a> <a href="{{ url('/home/webinars/delete/'.$webinar->uid) }}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>@endif</td>
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