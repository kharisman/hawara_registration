@extends('layouts.dashboard')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Blog Category</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          <li class="breadcrumb-item active">Blog Category</li>
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
								<a href="{{ url('/home/blog-categories/add') }}" class="btn btn-primary">Add Blog Category</a>
							</div>
							<table class="table DT">
								<thead>
									<tr>
										<th>No</th>
										<th>Blog Category</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php
									$no = 1;
									@endphp
									@foreach($data as $blog_category)
									<tr>
										<td>{{ $no++ }}</td>
										<td>{{ $blog_category->category_name }}</td>
										<td><a href="{{ url('/home/blog-categories/edit/'.$blog_category->uid) }}" class="btn btn-sm btn-warning"><i class="fa fa-pen"></i></a> <a href="{{ url('/home/blog-categories/delete/'.$blog_category->uid) }}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a></td>
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