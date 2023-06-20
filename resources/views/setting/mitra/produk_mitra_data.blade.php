@extends('layouts.layout')
@section('content')
 <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Produk Mitra</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Mitra</a></li>
              <li class="breadcrumb-item active">Produk Mitra</li>
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
                <h3 class="card-title">Data Produk Mitra</h3>

                <div class="card-tools">
                  <a href="{{url('')}}/pengaturan/mitra/produk-mitra/tambah" class="btn btn-tool" ><i class="fas fa-plus"></i>
                  </a>
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Nama </th>
                    <th>Cover</th>
                    <th>Deskripsi</th>
                    <th>Deskripsi Pendek</th>
                    <th>Harga</th>
                    <th>Harga Bayar</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($product as $key => $value)
                  <tr>
                    <td>{{$value->name}}</td>
                    <td>{{$value->cover}}</td>
                    <td>@php echo $value->descriptions @endphp</td>
                    <td>{{$value->short_desc}}</td>
                    <td>{{$value->price}}</td>
                    <td>{{$value->price_pay}}</td>
                    <td>
                    <a href="{{url('')}}/pengaturan/mitra/produk-mitra/edit?id={{$value->id}}" type="button" class="btn btn-outline-primary btn-block"><i class="fa fa-edit"></i></a>
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