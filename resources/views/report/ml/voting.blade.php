@extends('layouts.layout')
@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Voting Mobile Legend</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Turnamen Mobile Lagend</li>
              <li class="breadcrumb-item active">Voting Mobile Legend</li>
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
                <h3 class="card-title">Data Voting Mobile Legend</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th> Tamggal </th> 
                    <th> Session </th> 
                    <th> Nama </th> 
                    <th> Asal Sekolah </th> 
                    <th> Nomor Telepon </th> 
                    <th> Sosmed </th> 
                    <th> Kampus Pilihan </th> 
                    <th> program studi </th> 
                    <th> Tahun Kuliah </th> 
                    <th> Karir Pilihan </th> 
                    <th> Hadiah </th> 
                   </tr> 
                  </thead>
                  <tbody>
                  @foreach($datas as $key => $value)
                    <tr>
                        <td> {{ $value->tanggal }}  </td> 
                        <td> {{$value->tim->session}}  </td> 
                        <td> {{ $value->nama }} ({{$value->tim->nama}})  </td> 
                        <td> {{ $value->sekolah }}  </td> 
                        <td> {{ $value->tlp }} </td> 
                        <td> {{ $value->sosmed }}  </td> 
                        <td> {{ $value->kampus }} </td> 
                        <td> {{ $value->program_studi }}  </td> 
                        <td> {{ $value->tahun_kuliah }}  </td> 
                        <td> {{ $value->karir }}  </td> 
                        <td> {{ $value->hadiah }}  </td> 
                    </tr> 
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th> Tamggal </th> 
                    <th> Session </th> 
                    <th> Nama </th> 
                    <th> Asal Sekolah </th> 
                    <th> Nomor Telepon </th> 
                    <th> Sosmed </th> 
                    <th> Kampus Pilihan </th> 
                    <th> program studi </th> 
                    <th> Tahun Kuliah </th> 
                    <th> Karir Pilihan </th> 
                    <th> Hadiah </th> 
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
     $('#example1 tfoot th').each(function () {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Search ' + title + '" />');
    });
    $("#example1").DataTable({
    initComplete: function () {
            // Apply the search
            this.api()
                .columns()
                .every(function () {
                    var that = this;
 
                    $('input', this.footer()).on('keyup change clear', function () {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });
                });
        },
    order: [[0, 'desc']],
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)') 
  });
</script>
@endsection