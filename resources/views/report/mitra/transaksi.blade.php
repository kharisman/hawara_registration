@extends('layouts.layout')
@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Transaksi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Mitra</li>
              <li class="breadcrumb-item active">Transaksi</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Pendaftaran Mitra</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Tanggal </th>
                    <th>Kode Referral</th>
                    <th>Produk</th>
                    <th>Nama</th>
                    <th>Nomor Telepon</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($trxs as $key => $value)
                  <tr>
                    <td>{{$value->created_at}}</td>
                    <td>{{$value->reff}}</td>
                    <td>{{$value->product->name}}</td>
                    <td>{{$value->billingNm}}</td>
                    <td>{{$value->phone}}</td>
                    <td>{{$value->status}}</td>
                  </tr>
                  @endforeach
                </tbody>
                  <tfoot>
                  <tr>
                    <th>Tanggal </th>
                    <th>Kode Referral</th>
                    <th>Produk</th>
                    <th>Nama</th>
                    <th>Nomor Telepon</th>
                    <th>Status</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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