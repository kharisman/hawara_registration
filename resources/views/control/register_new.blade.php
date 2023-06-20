@extends('layouts.dashboard')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Registrasi STMIK & Politeknik PalComTech</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          <li class="breadcrumb-item active">Registrasi</li>
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
										<th>Email</th>
										<th>Nama</th>
										<th>Program Studi Pilihan</th>
										<th>No HP/WA</th>
										<th>Asal Sekolah</th>
										<th>Domisili</th>
										<th>Tahun Lulus</th>
										<th>Instagram</th>
										<th>Tanggal Daftar</th>
									</tr>
								</thead>
								<tbody>
									@php
									$no=1;
									@endphp
									@foreach($regis as $reg)
									<tr>
										<td>{{$no++}}</td>
										<td>{{$reg->email}}</td>
										<td>{{$reg->nama}}</td>
										<td>{{$reg->prodi}}</td>
										<td>{{$reg->no_hp}}</td>
										<td>{{$reg->asal_sekolah}}</td>
										<td>{{$reg->domisili}}</td>
										<td>{{$reg->tahun_lulus}}</td>
										<td>{{$reg->instagram}}</td>
										<td>{{date('d F Y',strtotime($reg->created_at))}}</td>
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