@extends('layouts.layout')
@section('content')
<style>
.info-box a:link,.info-box a {
  color:#000 !important;
}

</style>
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Beranda</h1>
          </div>
          
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
              <a href="{{ url('/report/pendaftaran') }}">
                <div class="info-box-content">
                <span class="info-box-text">Pendaftran</span>
                <span class="info-box-number">{{$countregistrationall}}</span>
              </div>
              </a>
              
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fa fa-user-plus"></i></span>
              <a href="{{ url('/report/mitra/pendaftaran-mitra') }}">
              <div class="info-box-content">
                <span class="info-box-text">Pendaftaran Mitra</span>
                <span class="info-box-number">{{$resellerAll}}</span>
              </div>
              </a>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fa fa-shopping-cart"></i></span>
              <a href="{{ url('/report/mitra/transaksi') }}">
              <div class="info-box-content">
                <span class="info-box-text">Transaksi Mitra</span>
                <span class="info-box-number">{{$resellerPaymentAll}}</span>
              </div>
              </a>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="far fa-calendar"></i></span>
              <a href="{{ url('/report/vote-ml') }}">
              <div class="info-box-content">
                <span class="info-box-text">Peserta ML S2</span>
                <span class="info-box-number">{{$timML}}</span>
              </div>
              </a>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

      </div><!-- /.container-fluid -->
    </section>
  </div>
@endsection