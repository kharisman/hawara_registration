@extends('layouts.dashboard')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">MGM STMIK & Politeknik PalComTech</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          <li class="breadcrumb-item active">MGM</li>
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
					<div class="card-body">
						<div class="table-responsive">
							<table class="table DT">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama</th>
										<th>Semester</th>
										<th>Program Studi</th>
										<th>No WA</th>
										<th>Instagram</th>
										<th>Rekomendasi 1</th>
										<th>Rekomendasi 2</th>
										<th>Rekomendasi 3</th>
									</tr>
								</thead>
								<tbody>
									@php
									$no=1;
									@endphp
									@foreach($mgm as $reg)
									<tr>
										<td>{{$no++}}</td>
										<td>{{$reg->nama}}</td>
										<td>{{$reg->semester}}</td>
										<td>{{$reg->prodi}}</td>
										<td>{{$reg->no_hp}}</td>
										<td>{{$reg->instagram}}</td>
										<td>{{$reg->rek1}}</td>
										<td>{{$reg->rek2}}</td>
										<td>{{$reg->rek3}}</td>
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