
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Report PalComTech </title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{url('')}}/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="{{url('')}}/dist/css/adminlte.min.css">

  
  <!-- DataTables -->
  <link rel="stylesheet" href="{{url('')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">


<script src="{{url('')}}/plugins/jquery/jquery.min.js"></script>
<script src="{{url('')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- DataTables  & Plugins -->
<script src="{{url('')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{url('')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{url('')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{url('')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{url('')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{url('')}}/plugins/jszip/jszip.min.js"></script>
<script src="{{url('')}}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{url('')}}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{url('')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{url('')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{url('')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


  <script src="{{url('')}}/dist/js/adminlte.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
          <i class="fa fa-cog"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
          <span class="dropdown-item dropdown-header">  Menu Pengaturan </span>
          <div class="dropdown-divider"></div>
          
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-key"></i>  Password
          </a>
          <div class="dropdown-divider"></div>
          <a  href="{{ route('logout') }}" class="dropdown-item dropdown-footer"> Keluar </a>
        </div>
      </li>
    </ul>
  </nav>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{url('')}}/index3.html" class="brand-link">
      {{-- <img src="{{url('')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
      <span class="brand-text font-weight-light"> &nbsp; Report PalComTech</span>
    </a>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{url('')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{url('')}}\home" class="nav-link @if(Request::segment(1)=="home") active @endif " >
              <i class="nav-icon fas fa-home"></i>
              <p>
                Beranda
              </p>
            </a>
          </li>
          <li class="nav-item  @if(Request::segment(1)=="report") menu-is-opening menu-open @endif ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Report
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" >
              
              <li class="nav-item @if(Request::segment(2)=="mitra") menu-is-opening menu-open @endif">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Mitra
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" >
                  <li class="nav-item">
                    <a href="{{url('')}}/report/mitra/pendaftaran-mitra" class="nav-link  @if(Request::segment(3)=="pendaftaran-mitra") active @endif ">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Pendaftran Mitra</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('')}}/report/mitra/transaksi" class="nav-link @if(Request::segment(3)=="transaksi") active @endif">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Transaksi</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item">
                <a href="{{url('')}}/report/vote-ml" class="nav-link @if(Request::segment(2)=="vote-ml") active @endif ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vote Mobile lagend</p>
                </a>
              </li> 

              <li class="nav-item">
                <a href="{{url('')}}/report/pendaftaran" class="nav-link @if(Request::segment(2)=="pendaftaran") active @endif ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pendaftaran</p>
                </a>
              </li> 

            </ul>
          </li>

          <li class="nav-item @if(Request::segment(1)=="pengaturan") menu-is-opening menu-open @endif">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Pengaturan 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" >
              
              <li class="nav-item @if(Request::segment(2)=="akes-user") menu-is-opening menu-open @endif">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Akses User
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" >
                  <li class="nav-item">
                    <a href="{{url('')}}/pengaturan/akes-user/tipe-user" class="nav-link @if(Request::segment(3)=="tipe-user") active @endif">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Tipe User</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('')}}/pengaturan/akes-user/hak-akses" class="nav-link @if(Request::segment(3)=="hak-akses") active @endif">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Hak Akses</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('')}}/pengaturan/akes-user/data-user" class="nav-link @if(Request::segment(3)=="data-user") active @endif">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Data User</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item @if(Request::segment(2)=="mitra") menu-is-opening menu-open @endif">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Mitra
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" >
                  <li class="nav-item">
                    <a href="{{url('')}}/pengaturan/mitra/produk-mitra" class="nav-link  @if(Request::segment(3)=="produk-mitra") active @endif ">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Pendaftran Mitra</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('')}}/pengaturan/mitra/transaksi" class="nav-link @if(Request::segment(3)=="transaksi") active @endif">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Transaksi</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="{{url('')}}/pengaturan/tim-ml" class="nav-link @if(Request::segment(2)=="tim-ml") active @endif ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tim Mobile lagend</p>
                </a>
              </li> 
            </ul>
          </li>

        </ul>
      </nav>
    </div>
  </aside>
  @if(Session::has('success'))
      <script>
      $(document).ready( function () {
          Swal.fire({
              title: 'Berhasil !',
              text: '{{ Session::get('success') }}',
              icon: 'success',
              confirmButtonText: 'Tutup'
          })
      } );
      </script>
      @php
      Session::forget('success');
      @endphp
  @endif


  @if(Session::has('error'))
      <script>
      $(document).ready( function () {
          Swal.fire({
              title: 'Gagal !',
              text: '{{ Session::get('error') }}',
              icon: 'error',
              confirmButtonText: 'Tutup'
          })
      } );
      </script>
      @php
      Session::forget('error');
      @endphp
  @endif
  @yield('content')
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b>
    </div>
    <strong>Copyright &copy; 2023 <a href="#">Institut PalComTech</a>.</strong> All rights reserved.
  </footer>
  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>
</body>
</html>
