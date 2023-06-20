@extends('layouts.dashboard')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
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
    			<div class="card-body text-center">
    				<h2>403</h2>
    				<h4>Maaf, Anda Tidak Bisa Mengakses Halaman Ini!</h4>
    			</div>
    		</div>
    	</div>
		</div>
	</div>
</div>

@endsection
