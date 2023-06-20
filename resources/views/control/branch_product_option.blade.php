@extends('layouts.dashboard')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Option Product</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          <li class="breadcrumb-item active">Option Product</li>
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
								@if(Auth::user()->roles == 'Super Admin' || Auth::user()->roles == 'AO')
								<a href="{{ url('/home/option_products/add') }}" class="btn btn-primary">Add Option Product</a>
								@endif
							</div>
							<table class="table DT">
								<thead>
									<tr>
										<th>No</th>
										<th>Product Name</th>
										<th>Option Name</th>
										<th>Option Price</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php
									$no = 1;
									$i=0;
									@endphp
									@foreach($data as $option_product => $value)
                                        @foreach ($value as $option => $key )
                                        <tr>
											<td>{{ $no++ }}</td>

											<td>
                                                @if($key != NULL)
                                                {{ $key }}
                                                @endif
											</td>
                                            <td></td>
										</tr>
                                        @endforeach
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
