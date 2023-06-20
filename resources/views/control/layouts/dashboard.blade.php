<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PalComTech') }}</title>

    <link href="{{ asset('favicon.ico') }}" rel="shortcut-icon">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">

    <!-- Styles -->
    <link href="{{ asset('css/adminlte.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/OverlayScrollbars.min.css') }}">

      <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link href="{{ asset('css/summernote.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/select2-bootstrap4.min.css') }}">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i> {{ Auth::user()->name }}
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <a href="{{ url('/home/users/edit-pass/'.Auth::user()->uid) }}" class="dropdown-item">
            <i class="fas fa-key"></i> Change Password
          </a>
          <a href="{{ url('/logout') }}" class="dropdown-item">
            <i class="fas fa-sign-out-alt"></i> Logout
          </a>
        </div>
      </li>
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ url('/home') }}" class="brand-link">
      <span class="brand-text font-weight-light">PalComTech</span>
    </a>

    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ url('/home') }}" class="nav-link {{ Request::path() == 'home' ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @if(Auth::user()->roles=='Super Admin')
          <li class="nav-item">
            <a href="{{ url('/home/banner') }}" class="nav-link {{ Request::path() == 'home/banner' || Request::path() == 'home/banner/add' || Request::path() == 'home/banner/edit/{$id}' ? 'active' : '' }}">
              <i class="nav-icon fas fa-image"></i>
              <p>
                Banner
              </p>
            </a>
          </li>
          @endif
          @if(Auth::user()->roles=='AO')
          <li class="nav-item">
            <a href="{{ url('/home/option_products') }}" class="nav-link {{ Request::path() == 'home/option_products' || Request::path() == 'home/option_products/add' || Request::path() == 'home/option_products/edit/{$id}' ? 'active' : '' }}">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Option Products
              </p>
            </a>
          </li>
          @endif
          @if(Auth::user()->roles=='Super Admin' || Auth::user()->roles=='Admin')
          <li class="nav-item">
            <a href="{{ url('/home/blog-categories') }}" class="nav-link {{ Request::path() == 'home/blog-categories' || Request::path() == 'home/blog-categories/add' || Request::path() == 'home/blog-categories/edit/{$id}' ? 'active' : '' }}">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Blog Category
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/home/tags') }}" class="nav-link {{ Request::path() == 'home/tags' || Request::path() == 'home/tags/add' || Request::path() == 'home/blog-categories/edit/{$id}' ? 'active' : '' }}">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Tag
              </p>
            </a>
          </li>
          @endif
          @if(Auth::user()->roles=='Super Admin' || Auth::user()->roles=='Admin')
          <li class="nav-item">
            <a href="{{ url('/home/blogs') }}" class="nav-link {{ Request::path() == 'home/blogs' || Request::path() == 'home/blogs/add' || Request::path() == 'home/blogs/edit/{$id}' ? 'active' : '' }}">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Blog
              </p>
            </a>
          </li>
          @endif
          @if((Auth::user()->roles=='Keuangan'))
          <li class="nav-item">
            <a href="{{ url('/home/QR-Voucher') }}" class="nav-link {{ Request::path() == 'home/QR-Voucher' ? 'active' : '' }}">
              <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>
                Voucher
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/home/Claim-Voucher') }}" class="nav-link {{ Request::path() == 'home/Claim-Voucher' ? 'active' : '' }}">
              <i class="nav-icon fas fa-money-check"></i>
              <p>
                Klaim Voucher
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/home/Merchant') }}" class="nav-link {{ Request::path() == 'home/Merchant' || Request::path() == 'home/Merchant/add' || Request::path() == 'home/Merchant/edit/{$id}' ? 'active' : '' }}">
              <i class="nav-icon fas fa-handshake"></i>
              <p>
                Merchant
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/home/Gift') }}" class="nav-link {{ Request::path() == 'home/Gift' || Request::path() == 'home/Gift/add' || Request::path() == 'home/Gift/edit/{$id}' ? 'active' : '' }}">
              <i class="nav-icon fas fa-gift"></i>
              <p>
                Hadiah
              </p>
            </a>
          </li>
          @endif
          <!--<li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Charts
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/charts/chartjs.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ChartJS</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/flot.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Flot</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/inline.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inline</p>
                </a>
              </li>
            </ul>
          </li>-->
        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper">
    @yield('content')
  </div>

  <div class="modal pay fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table-striped">
            <tbody>
              <tr>
                <td class="font-weight-bold">No Pembayaran</td>
                <td id="no"></td>
              </tr>
              <tr>
                <td class="font-weight-bold">Produk</td>
                <td id="product"></td>
              </tr>
              <tr>
                <td class="font-weight-bold">Bank</td>
                <td id="code"></td>
              </tr>
              <tr>
                <td class="font-weight-bold">Status</td>
                <td id="status"></td>
              </tr>
              <tr>
                <td class="font-weight-bold">Pembayaran</td>
                <td id="pay"></td>
              </tr>
              <tr>
                <td class="font-weight-bold">Total</td>
                <td id="total"></td>
              </tr>
              <tr>
                <td class="font-weight-bold">Tanggal Bayar</td>
                <td id="date"></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <footer class="main-footer">
    <strong>Copyright &copy; 2020 PalComTech.com.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('js/adminlte.js') }}"></script>
<script src="{{ asset('js/summernote.min.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/typeahead.min.js') }}"></script>
<script src="{{ asset('js/select2.full.min.js') }}"></script>
<script src="{{ asset('js/summernote-video-attributes.js')}}"></script>
<script src="{{ asset('js/echart.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.summernote').summernote({
      height: 200,
      toolbar:[
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert',['videoAttributes','media','link','hr','picture']],
            ['table', ['table']],
            ['view', ['fullscreen', 'codeview', 'help']]
            ]
    });
  });

  $('.select2').select2({
      theme: 'bootstrap4'
  });

  $(function () {
    $(".DT").DataTable();
  });

  $('.pay').on('show.bs.modal', function(e) {
    var modal = $(this);
    var bank;
    var st;
    var id = $(e.relatedTarget).data('id');
    var no = $(e.relatedTarget).data('no');
    var total = $(e.relatedTarget).data('total');
    var tot = total.toLocaleString();
    var status = $(e.relatedTarget).data('status');
    var code = $(e.relatedTarget).data('code');
    var pay = $(e.relatedTarget).data('pay');
    var time1 = $(e.relatedTarget).data('time');
    var pro = $(e.relatedTarget).data('product');
    var branch = $(e.relatedTarget).data('branch');
    var tb = $(e.relatedTarget).data('date');
    var product = pro+' ('+branch+')';
    var time2 = new Date().getTime();
    var expired = new Date(time1).getTime();
    var time = expired-time2;

    if(tb==''){
      tgl_bayar = '-';
    }else{
    var date = new Date(tb);
    var tgl = date.getDate();
    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var bln = months[date.getMonth()];
    var thn = date.getFullYear();
    var jam = date.getHours();
    var menit = date.getMinutes();
    var detik = date.getSeconds();
    var tgl_bayar = tgl+' '+bln+' '+thn+' '+jam+':'+menit+':'+detik;
    }

    if(status=='waiting' && time>=0){
      st = '<label class="badge badge-warning">Waiting</label>';
    }else if(status=='waiting' && time<0){
      st = '<label class="badge badge-danger">Cancel</label>';
    }else if(status=='paid' && pay=='Offline'){
      st = '<label class="badge badge-success">Paid Offline</label>';
    }else if(status=='paid' && pay=='Online'){
      st = '<label class="badge badge-success">Paid Online</label>';
    }

    if(code=="02-BNIN"){
      bank = "Bank Negara Indonesia";
    }else if(code=="02-BMRI"){
      bank = "Bank Mandiri";
    }else if(code=="02-BBBA"){
      bank = "Bank Permata";
    }else if(code=="02-BRIN"){
      bank = "Bank Rakyat Indonesia";
    }else if(code=="02-IBBK"){
      bank = "BII Maybank";
    }else if(code=="02-BNIA"){
      bank = "CIMB Niaga";
    }

    $('#title').text('Pembayaran '+no);
    $('#product').text(product);
    $('#no').text(no);
    $('#total').text('Rp '+tot);
    $('#code').text(bank);
    $('#status').html(st);
    $('#pay').text(pay);
    $('#date').text(tgl_bayar);
  });
</script>
@if (\Request::is('home'))
<script type="text/javascript">
$(function () {
  /* ChartJS
   * -------
   * Here we will create a few charts using ChartJS
   */

  //--------------
  //- AREA CHART -
  //--------------

  // Get context with jQuery - using jQuery's .get() method.
  var areaChartData1 = {
    labels  : [
        @foreach($pagesbea as $value)
          {!! '"'. DateTime::createFromFormat('Ymd', $value[0])->format('d')." ".DateTime::createFromFormat('Ymd', $value[0])->format('M') .'"' !!} ,
        @endforeach
    ],
    datasets: [
      {
        label               : 'Pengunjung',
        backgroundColor     : 'rgba(60,141,188,0.9)',
        borderColor         : 'rgba(60,141,188,0.8)',
        pointRadius         : true,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : [
          @foreach($pagesbea as $value)
            {{ $value[1] }},
          @endforeach
        ]
      },
      {
        label               : 'Klik Register',
        borderColor         : 'rgba(255,0,0,0.8)',
        pointRadius         : true,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(255,0,0,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(255,0,0,1)',
        data                : [
          @foreach($clregbea as $vl)
            {{ $vl->views }},
          @endforeach
        ]
      },
      {
        label               : 'Klik Chat',
        backgroundColor     : 'rgba(0,255,0,0.3)',
        borderColor         : 'rgba(0,255,0,0.8)',
        pointRadius         : true,
        pointColor          : '#00FF00',
        pointStrokeColor    : 'rgba(0,255,0,1)',
        pointHighlightFill  : '#00FF00',
        pointHighlightStroke: 'rgba(0,255,0,1)',
        data                : [
          @foreach($chatbea as $v)
            {{ $v->views }},
          @endforeach
        ]
      },
    ]
  }

  var areaChartOptions1 = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines : {
          display : false,
        }
      }],
      yAxes: [{
        gridLines : {
          display : false,
        },
      }]
    }
  }

  <?php
  if(Auth::user()->roles=='Keuangan'){
	?>
  var lineChartCanvas1 = $('#lineChartBea').get(0).getContext('2d')
  var lineChartOptions1 = $.extend(true, {}, areaChartOptions1)
  var lineChartData1 = $.extend(true, {}, areaChartData1)
  lineChartData1.datasets[0].fill = false;
  lineChartOptions1.datasetFill = false

  var lineChart1 = new Chart(lineChartCanvas1, {
    type: 'line',
    data: lineChartData1,
    options: lineChartOptions1
  })

  var areaChartData2 = {
  labels  : [
      @foreach($pagesdkv as $value)
        {!! '"'. DateTime::createFromFormat('Ymd', $value[0])->format('d')." ".DateTime::createFromFormat('Ymd', $value[0])->format('M') .'"' !!} ,
      @endforeach
  ],
    datasets: [
      {
        label               : 'Pengunjung',
        backgroundColor     : 'rgba(60,141,188,0.9)',
        borderColor         : 'rgba(60,141,188,0.8)',
        pointRadius         : true,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : [
          @foreach($pagesdkv as $value)
            {{ $value[1] }},
          @endforeach
        ]
      },
      {
        label               : 'Klik Register',
        borderColor         : 'rgba(255,0,0,0.8)',
        pointRadius         : true,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(255,0,0,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(255,0,0,1)',
        data                : [
          @foreach($clregdkv as $vl)
            {{ $vl->views }},
          @endforeach
        ]
      },
      {
        label               : 'Klik Chat',
        backgroundColor     : 'rgba(0,255,0,0.3)',
        borderColor         : 'rgba(0,255,0,0.8)',
        pointRadius         : true,
        pointColor          : '#00FF00',
        pointStrokeColor    : 'rgba(0,255,0,1)',
        pointHighlightFill  : '#00FF00',
        pointHighlightStroke: 'rgba(0,255,0,1)',
        data                : [
          @foreach($chatdkv as $v)
            {{ $v->views }},
          @endforeach
        ]
      },
    ]
  }

  var areaChartOptions2 = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines : {
          display : false,
        }
      }],
      yAxes: [{
        gridLines : {
          display : false,
        },
      }]
    }
  }

  var lineChartCanvas2 = $('#lineChartDKV').get(0).getContext('2d')
  var lineChartOptions2 = $.extend(true, {}, areaChartOptions2)
  var lineChartData2 = $.extend(true, {}, areaChartData2)
  lineChartData2.datasets[0].fill = false;
  lineChartOptions2.datasetFill = false

  var lineChart2 = new Chart(lineChartCanvas2, {
    type: 'line',
    data: lineChartData2,
    options: lineChartOptions2
  })

  var areaChartData3 = {
  labels  : [
      @foreach($pagespalcom as $value)
        {!! '"'. DateTime::createFromFormat('Ymd', $value[0])->format('d')." ".DateTime::createFromFormat('Ymd', $value[0])->format('M') .'"' !!} ,
      @endforeach
  ],
    datasets: [
      {
        label               : 'Pengunjung',
        backgroundColor     : 'rgba(60,141,188,0.9)',
        borderColor         : 'rgba(60,141,188,0.8)',
        pointRadius         : true,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : [
          @foreach($pagespalcom as $value)
            {{ $value[1] }},
          @endforeach
        ]
      }
    ]
  }

  var areaChartOptions3 = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines : {
          display : false,
        }
      }],
      yAxes: [{
        gridLines : {
          display : false,
        },
      }]
    }
  }

  var lineChartCanvas3 = $('#lineChartPCT').get(0).getContext('2d')
  var lineChartOptions3 = $.extend(true, {}, areaChartOptions3)
  var lineChartData3 = $.extend(true, {}, areaChartData3)
  lineChartData3.datasets[0].fill = false;
  lineChartOptions3.datasetFill = false

  var lineChart3 = new Chart(lineChartCanvas3, {
    type: 'line',
    data: lineChartData3,
    options: lineChartOptions3
  })

  var areaChartData4 = {
  labels  : [
      @foreach($pagessi as $value)
        {!! '"'. DateTime::createFromFormat('Ymd', $value[0])->format('d')." ".DateTime::createFromFormat('Ymd', $value[0])->format('M') .'"' !!} ,
      @endforeach
  ],
    datasets: [
      {
        label               : 'Pengunjung',
        backgroundColor     : 'rgba(60,141,188,0.9)',
        borderColor         : 'rgba(60,141,188,0.8)',
        pointRadius         : true,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : [
          @foreach($pagessi as $value)
            {{ $value[1] }},
          @endforeach
        ]
      },
      {
        label               : 'Klik Register',
        borderColor         : 'rgba(255,0,0,0.8)',
        pointRadius         : true,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(255,0,0,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(255,0,0,1)',
        data                : [
          @foreach($clregsi as $vl)
            {{ $vl->views }},
          @endforeach
        ]
      },
      {
        label               : 'Klik Chat',
        backgroundColor     : 'rgba(0,255,0,0.3)',
        borderColor         : 'rgba(0,255,0,0.8)',
        pointRadius         : true,
        pointColor          : '#00FF00',
        pointStrokeColor    : 'rgba(0,255,0,1)',
        pointHighlightFill  : '#00FF00',
        pointHighlightStroke: 'rgba(0,255,0,1)',
        data                : [
          @foreach($chatsi as $v)
            {{ $v->views }},
          @endforeach
        ]
      },
    ]
  }

  var areaChartOptions4 = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines : {
          display : false,
        }
      }],
      yAxes: [{
        gridLines : {
          display : false,
        },
      }]
    }
  }

  var lineChartCanvas4 = $('#lineChartSI').get(0).getContext('2d')
  var lineChartOptions4 = $.extend(true, {}, areaChartOptions4)
  var lineChartData4 = $.extend(true, {}, areaChartData4)
  lineChartData4.datasets[0].fill = false;
  lineChartOptions4.datasetFill = false

  var lineChart4 = new Chart(lineChartCanvas4, {
    type: 'line',
    data: lineChartData4,
    options: lineChartOptions4
  })

  var areaChartData5 = {
  labels  : [
      @foreach($pagesif as $value)
        {!! '"'. DateTime::createFromFormat('Ymd', $value[0])->format('d')." ".DateTime::createFromFormat('Ymd', $value[0])->format('M') .'"' !!} ,
      @endforeach
  ],
    datasets: [
      {
        label               : 'Pengunjung',
        backgroundColor     : 'rgba(60,141,188,0.9)',
        borderColor         : 'rgba(60,141,188,0.8)',
        pointRadius         : true,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : [
          @foreach($pagesif as $value)
            {{ $value[1] }},
          @endforeach
        ]
      },
      {
        label               : 'Klik Register',
        borderColor         : 'rgba(255,0,0,0.8)',
        pointRadius         : true,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(255,0,0,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(255,0,0,1)',
        data                : [
          @foreach($clregif as $vl)
            {{ $vl->views }},
          @endforeach
        ]
      },
      {
        label               : 'Klik Chat',
        backgroundColor     : 'rgba(0,255,0,0.3)',
        borderColor         : 'rgba(0,255,0,0.8)',
        pointRadius         : true,
        pointColor          : '#00FF00',
        pointStrokeColor    : 'rgba(0,255,0,1)',
        pointHighlightFill  : '#00FF00',
        pointHighlightStroke: 'rgba(0,255,0,1)',
        data                : [
          @foreach($chatif as $v)
            {{ $v->views }},
          @endforeach
        ]
      },
    ]
  }

  var areaChartOptions5 = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines : {
          display : false,
        }
      }],
      yAxes: [{
        gridLines : {
          display : false,
        },
      }]
    }
  }

  var lineChartCanvas5 = $('#lineChartIF').get(0).getContext('2d')
  var lineChartOptions5 = $.extend(true, {}, areaChartOptions5)
  var lineChartData5 = $.extend(true, {}, areaChartData5)
  lineChartData5.datasets[0].fill = false;
  lineChartOptions5.datasetFill = false

  var lineChart5 = new Chart(lineChartCanvas5, {
    type: 'line',
    data: lineChartData5,
    options: lineChartOptions5
  })

var areaChartData6 = {
  labels  : [
      @foreach($pagesak as $value)
        {!! '"'. DateTime::createFromFormat('Ymd', $value[0])->format('d')." ".DateTime::createFromFormat('Ymd', $value[0])->format('M') .'"' !!} ,
      @endforeach
  ],
    datasets: [
      {
        label               : 'Pengunjung',
        backgroundColor     : 'rgba(60,141,188,0.9)',
        borderColor         : 'rgba(60,141,188,0.8)',
        pointRadius         : true,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : [
          @foreach($pagesak as $value)
            {{ $value[1] }},
          @endforeach
        ]
      },
      {
        label               : 'Klik Register',
        borderColor         : 'rgba(255,0,0,0.8)',
        pointRadius         : true,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(255,0,0,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(255,0,0,1)',
        data                : [
          @foreach($clregak as $vl)
            {{ $vl->views }},
          @endforeach
        ]
      },
      {
        label               : 'Klik Chat',
        backgroundColor     : 'rgba(0,255,0,0.3)',
        borderColor         : 'rgba(0,255,0,0.8)',
        pointRadius         : true,
        pointColor          : '#00FF00',
        pointStrokeColor    : 'rgba(0,255,0,1)',
        pointHighlightFill  : '#00FF00',
        pointHighlightStroke: 'rgba(0,255,0,1)',
        data                : [
          @foreach($chatak as $v)
            {{ $v->views }},
          @endforeach
        ]
      },
    ]
  }

  var areaChartOptions6 = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines : {
          display : false,
        }
      }],
      yAxes: [{
        gridLines : {
          display : false,
        },
      }]
    }
  }

  var lineChartCanvas6 = $('#lineChartAK').get(0).getContext('2d')
  var lineChartOptions6 = $.extend(true, {}, areaChartOptions6)
  var lineChartData6 = $.extend(true, {}, areaChartData6)
  lineChartData6.datasets[0].fill = false;
  lineChartOptions6.datasetFill = false

  var lineChart6 = new Chart(lineChartCanvas6, {
    type: 'line',
    data: lineChartData6,
    options: lineChartOptions6
  })

  var areaChartData7 = {
  labels  : [
      @foreach($pagesmi as $value)
        {!! '"'. DateTime::createFromFormat('Ymd', $value[0])->format('d')." ".DateTime::createFromFormat('Ymd', $value[0])->format('M') .'"' !!} ,
      @endforeach
  ],
    datasets: [
      {
        label               : 'Pengunjung',
        backgroundColor     : 'rgba(60,141,188,0.9)',
        borderColor         : 'rgba(60,141,188,0.8)',
        pointRadius         : true,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : [
          @foreach($pagesmi as $value)
            {{ $value[1] }},
          @endforeach
        ]
      },
      {
        label               : 'Klik Register',
        borderColor         : 'rgba(255,0,0,0.8)',
        pointRadius         : true,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(255,0,0,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(255,0,0,1)',
        data                : [
          @foreach($clregmi as $vl)
            {{ $vl->views }},
          @endforeach
        ]
      },
      {
        label               : 'Klik Chat',
        backgroundColor     : 'rgba(0,255,0,0.3)',
        borderColor         : 'rgba(0,255,0,0.8)',
        pointRadius         : true,
        pointColor          : '#00FF00',
        pointStrokeColor    : 'rgba(0,255,0,1)',
        pointHighlightFill  : '#00FF00',
        pointHighlightStroke: 'rgba(0,255,0,1)',
        data                : [
          @foreach($chatmi as $v)
            {{ $v->views }},
          @endforeach
        ]
      },
    ]
  }

  var areaChartOptions7 = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines : {
          display : false,
        }
      }],
      yAxes: [{
        gridLines : {
          display : false,
        },
      }]
    }
  }

  var lineChartCanvas7 = $('#lineChartMI').get(0).getContext('2d')
  var lineChartOptions7 = $.extend(true, {}, areaChartOptions7)
  var lineChartData7 = $.extend(true, {}, areaChartData7)
  lineChartData7.datasets[0].fill = false;
  lineChartOptions7.datasetFill = false

  var lineChart7 = new Chart(lineChartCanvas7, {
    type: 'line',
    data: lineChartData7,
    options: lineChartOptions7
  })
  <?php
	}
	?>
});
</script>
<script type="text/javascript">
  $(document).on('click', '#filter-btn', function (e) {
          e.preventDefault();
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          $.ajax({
              type: 'GET',
              dataType: "json",
              url : '/home/filter',
              data : {
                value1 : $('#filter').val(),
                value2 : $('#filter1').val()
              },
              success:function(data){
                $('#chatbea').html(data['data1']['views']);
                $('#registerbea').html(data['data2']['views']);
                $('#visitbea').html(data['data3']);
                $('#chatdkv').html(data['data4']['views']);
                $('#registerdkv').html(data['data5']['views']);
                $('#visitdkv').html(data['data6']);
                $('#chatsi').html(data['data7']['views']);
                $('#registersi').html(data['data8']['views']);
                $('#visitsi').html(data['data9']);
                $('#chatif').html(data['data10']['views']);
                $('#registerif').html(data['data11']['views']);
                $('#visitif').html(data['data12']);
                $('#chatak').html(data['data13']['views']);
                $('#registerak').html(data['data14']['views']);
                $('#visitak').html(data['data15']);
                $('#chatmi').html(data['data16']['views']);
                $('#registermi').html(data['data17']['views']);
                $('#visitmi').html(data['data18']);
              },
              error:function(data){
                  console.log("error");
              },
              timeout:10000
          });
  });

</script>
@endif
</body>
</html>
