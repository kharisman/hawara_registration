@extends('layouts.layout')
@section('content')
 <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Tim Mobile Legend</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Mobile Legend</a></li>
              <li class="breadcrumb-item active">Tim Mobile Legend</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Tim Mobile Legend</h3>

                <div class="card-tools">
                  <a href="{{url('')}}/pengaturan/tim-ml/tambah" class="btn btn-tool" ><i class="fas fa-plus"></i>
                  </a>
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Session </th>
                    <th>Nama </th>
                    <th>Asal</th>
                    <th>Gambar</th>
                    <th>Deskripsi</th>
                    <th>Urutan</th>
                    <th>Session</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($datas as $key => $value)
                  <tr>
                    <td>{{$value->session}}</td>
                    <td>{{$value->nama}}</td>
                    <td>{{$value->asal}}</td>
                    <td>{{$value->gambar}}</td>
                    <td>{{$value->deskripsi}}</td>
                    <td>{{$value->urutan}}</td>
                    <td>{{$value->session}}</td>
                    <td>{{$value->status}}</td>
                    <td>
                    <a href="{{url('')}}/pengaturan/tim-ml/edit?id={{$value->id}}" type="button" class="btn btn-outline-primary btn-block"><i class="fa fa-edit"></i></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                 
                </table>
              </div>
            </div>            
          </div>
        </div>
      </div>
    </section>
  </div>
<script>
  $(function () {
    $("#example1").DataTable({
      
    order: [[0, 'desc']],
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');   
  });
</script>
@endsection