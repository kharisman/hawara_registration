@extends('layouts.dashboard')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">User</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          <li class="breadcrumb-item active">User</li>
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
								<a href="{{ url('/home/users/add') }}" class="btn btn-primary">Add User</a>
							</div>
							<table class="table DT">
								<thead class="text-center">
									<tr>
										<th>No</th>
										<th>E-mail</th>
										<th>Name</th>
										<th>Roles</th>
										<th>Branch</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php
									$no = 1;
									@endphp
									@foreach($data as $user)
									<tr>
										<td>{{ $no++ }}</td>
										<td>{{ $user->email }}</td>
										<td>{{ $user->name }}</td>
										<td class="text-center"><label class="badge badge-success">{{ $user->roles }}</label></td>
										<td class="text-center">@if($user->branch_uid!='0') {{ $user->branches->branch_name }} @else - @endif</td>
										<td><a href="{{ url('/home/users/edit/'.$user->uid) }}" class="btn btn-sm btn-warning" title="Edit Data {{ $user->name }}"><i class="fa fa-pen"></i></a> <a href="{{ url('/home/users/edit-pass/'.$user->uid) }}" class="btn btn-sm btn-primary"><i class="fa fa-key"></i></a> @if($user->roles!='Super Admin')<a href="{{ url('home/users/delete/'.$user->uid) }}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>@endif</td>
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