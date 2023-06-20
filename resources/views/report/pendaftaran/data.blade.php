@extends('layouts.layout')
@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pendaftaran</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Report</li>
              <li class="breadcrumb-item active">Pendaftaran</li>
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
              <div class="card-body">
                <div class="table-responsive">
                  <h3>Program Tanpa Opsi Pembayaran</h3>
                  <table class="table DT" id="example1">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Program</th>
                        <th>Waktu Daftar</th>
                        <th>Total Pembayaran</th>
                        <th>Status Pembayaran</th>
                        <th>Tanggal Pembayaran</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                      $no = 1;
                      @endphp
                      @foreach($data3 as $register)
                        @if(Auth::user()->branch_uid==$register->branch_uid || Auth::user()->roles=='Super Admin' || Auth::user()->roles=='Keuangan')
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $register->email }}</td>
                        <td>{{ $register->name }}</td>
                        <td>{{ $register->phone }}</td>
                        <td>{{ $register->product_name.' ('.$register->branch_name.')' }}</td>
                        <td>{{ date('d M Y H:i:s', strtotime($register->created_at)) }}</td>
                        <td>Rp {{ number_format($register->totalPay,0,".",",") }}</td>
                        <td>{{ $register->status }}</td>
                        <td>{{ $register->datePay ? $register->datePay : '-' }}</td>
                      </tr>
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <h3>Program Dengan Opsi Pembayaran</h3>
                  <table class="table DT" id="example2">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Program</th>
                        <th>Waktu Daftar</th>
                        <th>Total Pembayaran</th>
                        <th>Status Pembayaran</th>
                        <th>Tanggal Pembayaran</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                      $no = 1;
                      @endphp
                      @foreach($data1 as $register)
                        @if(Auth::user()->branch_uid==$register->branch_uid || Auth::user()->roles=='Super Admin' || Auth::user()->roles=='Keuangan')
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $register->email }}</td>
                        <td>{{ $register->name }}</td>
                        <td>{{ $register->phone }}</td>
                        <td>{{ $register->product_name.' ('.$register->branch_name.')' }}</td>
                        <td>{{ date('d M Y H:i:s', strtotime($register->created_at)) }}</td>
                        <td>Rp {{ number_format($register->totalPay,0,".",",") }}</td>
                        <td>{{ $register->status }}</td>
                        <td>{{ $register->datePay ? $register->datePay : '-' }}</td>
                      </tr>
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <h3>Webinar</h3>
                  <table class="table DT" id="example3">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Program</th>
                        <th>Waktu Daftar</th>
                        <th>Total Pembayaran</th>
                        <th>Status Pembayaran</th>
                        <th>Tanggal Pembayaran</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                      $no = 1;
                      @endphp
                      @foreach($data2 as $register)
                        @if(Auth::user()->branch_uid==$register->branch_uid || Auth::user()->roles=='Super Admin' || Auth::user()->roles=='Keuangan')
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $register->email }}</td>
                        <td>{{ $register->name }}</td>
                        <td>{{ $register->phone }}</td>
                        <td>{{ $register->webinar_name.' ('.$register->branch_name.')' }}</td>
                        <td>{{ date('d M Y H:i:s', strtotime($register->created_at)) }}</td>
                        <td>Rp {{ number_format($register->totalPay,0,".",",") }}</td>
                        <td>{{ $register->status }}</td>
                        <td>{{ $register->datePay ? $register->datePay : '-' }}</td>
                      </tr>
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            
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

    $("#example2").DataTable({
    order: [[0, 'desc']],
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');   

    $("#example3").DataTable({
    order: [[0, 'desc']],
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');  

  });
</script>
@endsection