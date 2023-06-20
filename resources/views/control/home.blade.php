@extends('layouts.dashboard')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Dashboard</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          <li class="breadcrumb-item">Dashboard</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<div class="content-body">
	<div class="container-fluid">
		<div class="row mb-2">

			@if(Auth::user()->roles=='Super Admin')
		 	<div class="col-lg-3 col-6">
        <a class="text-decoration-none" href="{{ url('/home/categories') }}">
	        <div class="small-box bg-secondary">
      	  	<div class="inner">
	        	  <h3>{{ $cc }}</h3>
	            <p>Kategori</p>
	          </div>
	          <div class="icon">
	            <i class="fa fa-list"></i>
	          </div>
        	</div>
        </a>
      </div>

			<div class="col-lg-3 col-6">
        <a class="text-decoration-none" href="{{ url('/home/branches') }}">
	        <div class="small-box bg-warning">
      	  	<div class="inner">
	        	  <h3>{{ $cb }}</h3>
	            <p>Cabang</p>
	          </div>
	          <div class="icon">
	            <i class="fa fa-building"></i>
	          </div>
        	</div>
        </a>
      </div>

      <div class="col-lg-3 col-6">
				<a class="text-decoration-none" href="{{ url('/home/users') }}">
	        <div class="small-box bg-danger">
	          <div class="inner">
	            <h3>{{ $cu }}</h3>
	            <p>Pengguna</p>
	          </div>
	          <div class="icon">
	            <i class="fa fa-user"></i>
	          </div>
	        </div>
	      </a>
      </div>
      @endif

    </div>
    <div class="row mb-2">

    	@if(Auth::user()->roles=='Super Admin')
			<div class="col-lg-3 col-6">
        <a class="text-decoration-none" href="{{ url('/home/products') }}">
	        <div class="small-box bg-primary">
      	  	<div class="inner">
	        	  <h3>{{ $cp }}</h3>
	            <p>Produk</p>
	          </div>
	          <div class="icon">
	            <i class="fa fa-image"></i>
	          </div>
        	</div>
        </a>
      </div>
      @endif

      @if(Auth::user()->roles!='Admin' && Auth::user()->roles!='Keuangan')
    	<div class="col-lg-3 col-6">
        <a class="text-decoration-none" href="{{ url('/home/branch_products') }}">
	        <div class="small-box bg-success">
      	  	<div class="inner">
	        	  <h3>{{ $cpb }}</h3>
	            <p>Produk Cabang</p>
	          </div>
	          <div class="icon">
	            <i class="fa fa-images"></i>
	          </div>
        	</div>
        </a>
      </div>
      @endif

      @if(Auth::user()->roles=='Admin')
      <div class="col-lg-3 col-6">
        <a class="text-decoration-none" href="{{ url('/home/blogs') }}">
	        <div class="small-box bg-primary">
      	  	<div class="inner">
	        	  <h3>{{ $cwb }}</h3>
	            <p>Artikel</p>
	          </div>
	          <div class="icon">
	            <i class="fa fa-book"></i>
	          </div>
        	</div>
        </a>
      </div>
      @endif

      @if(Auth::user()->roles=='Super Admin')
    	<div class="col-lg-3 col-6">
        <a class="text-decoration-none" href="{{ url('/home/webinars') }}">
	        <div class="small-box bg-primary">
      	  	<div class="inner">
	        	  <h3>{{ $cwa }}</h3>
	            <p>Webinar</p>
	          </div>
	          <div class="icon">
	            <i class="fa fa-video"></i>
	          </div>
        	</div>
        </a>
      </div>
      @endif

      @if(Auth::user()->roles=='Kepala' || Auth::user()->roles=='AO')
      <div class="col-lg-3 col-6">
        <a class="text-decoration-none" href="{{ url('/home/webinars') }}">
	        <div class="small-box bg-primary">
      	  	<div class="inner">
	        	  <h3>{{ $cw }}</h3>
	            <p>Webinar</p>
	          </div>
	          <div class="icon">
	            <i class="fa fa-video"></i>
	          </div>
        	</div>
        </a>
      </div>
      <div class="col-lg-3 col-6">
        <a class="text-decoration-none" href="{{ url('/home/vouchers') }}">
	        <div class="small-box bg-primary">
      	  	<div class="inner">
	        	  <h3>{{ $cv }}</h3>
	            <p>Voucher</p>
	          </div>
	          <div class="icon">
	            <i class="fa fa-ticket-alt"></i>
	          </div>
        	</div>
        </a>
      </div>
      <div class="col-lg-3 col-6">
				<a class="text-decoration-none" href="{{ url('/home/promos') }}">
	        <div class="small-box bg-danger">
	          <div class="inner">
	            <h3>{{ $cpr }}</h3>
	            <p>Promo</p>
	          </div>
	          <div class="icon">
	            <i class="fa fa-bullhorn"></i>
	          </div>
	        </div>
	      </a>
      </div>
      @endif

		</div>
		<div class="row mb-2">
			@if(Auth::user()->roles=='Super Admin')
      <div class="col-lg-3 col-6">
				<a class="text-decoration-none" href="{{ url('/home/banners') }}">
	        <div class="small-box bg-info">
	          <div class="inner">
	            <h3>{{ $cg }}</h3>
	            <p>Ads Banner </p>
	          </div>
	          <div class="icon">
	            <i class="far fa-image"></i>
	          </div>
	        </div>
	      </a>
      </div>

      <div class="col-lg-3 col-6">
				<a class="text-decoration-none" href="{{ url('/home/promos') }}">
	        <div class="small-box bg-danger">
	          <div class="inner">
	            <h3>{{ $cpr }}</h3>
	            <p>Promo</p>
	          </div>
	          <div class="icon">
	            <i class="fa fa-bullhorn"></i>
	          </div>
	        </div>
	      </a>
      </div>
      @endif

      @if(Auth::user()->roles=='Kepala' || Auth::user()->roles=='AO')

      <div class="col-lg-3 col-6">
				<a class="text-decoration-none" href="{{ url('/home/registrations') }}">
	        <div class="small-box bg-warning">
	          <div class="inner">
	            <h3>{{ $cre }}</h3>
	            <p>Registration</p>
	          </div>
	          <div class="icon">
	            <i class="fa fa-users"></i>
	          </div>
	        </div>
	      </a>
      </div>

      <!--<div class="col-lg-3 col-6">
				<a class="text-decoration-none" href="{{ url('/home/payments') }}">
	        <div class="small-box bg-success">
	          <div class="inner">
	            <h3>{{ $cpay }}</h3>
	            <p>Payment</p>
	          </div>
	          <div class="icon">
	            <i class="fa fa-users"></i>
	          </div>
	        </div>
	      </a>
      </div>-->
      @endif
		</div>

		<div class="row mb-2">
			@if(Auth::user()->roles=='Super Admin' || Auth::user()->roles=='Keuangan')
      <div class="col-lg-3 col-6">
				<a class="text-decoration-none" href="{{ url('/home/registrations') }}">
	        <div class="small-box bg-warning">
	          <div class="inner">
	            <h3>{{ $crea }}</h3>
	            <p>Registration</p>
	          </div>
	          <div class="icon">
	            <i class="fa fa-users"></i>
	          </div>
	        </div>
	      </a>
      </div>
      <!--<div class="col-lg-3 col-6">
				<a class="text-decoration-none" href="{{ url('/home/payments') }}">
	        <div class="small-box bg-success">
	          <div class="inner">
	            <h3>{{ $cpaya }}</h3>
	            <p>Payment</p>
	          </div>
	          <div class="icon">
	            <i class="fa fa-users"></i>
	          </div>
	        </div>
	      </a>
      </div>-->
			@endif
		</div>

		<div class="row mb-2">
		@if((Auth::user()->roles=='Keuangan' && Auth::user()->branch_uid=='0'))
			<div class="col-lg-3 col-6">
				<a class="text-decoration-none" href="{{ url('/home/register') }}">
	        <div class="small-box bg-red">
	          <div class="inner">
	            <h3>{{ $creg }}</h3>
	            <p>Registrasi STMIK & Politeknik</p>
	          </div>
	          <div class="icon">
	            <i class="fa fa-users"></i>
	          </div>
	        </div>
	      </a>
      </div>

      <div class="col-lg-3 col-6">
				<a class="text-decoration-none" href="{{ url('/home/mgm') }}">
	        <div class="small-box bg-blue">
	          <div class="inner">
	            <h3>{{ $cmgm }}</h3>
	            <p>MGM STMIK & Politeknik</p>
	          </div>
	          <div class="icon">
	            <i class="fa fa-users"></i>
	          </div>
	        </div>
	      </a>
      </div>

			<div class="col-lg-3 col-6">
				<a class="text-decoration-none" href="{{ url('/home/flash-sale') }}">
	        <div class="small-box bg-success">
	          <div class="inner">
							<h3>.</h3>
	            <p>Flash Sale PalCosmTech</p>
	          </div>
	          <div class="icon">
	            <i class="fa fa-users"></i>
	          </div>
	        </div>
	      </a>
      </div>
    @endif
		</div>

		<div class="row mb-2">
			@if((Auth::user()->roles=='Keuangan' && Auth::user()->branch_uid=='0'))
			<div class="col-12 mb-2">
				<div class="form-group">
					Filter
				</div>
				<form>
					<div class="row">
						<div class="form-group col-md-3 col-12">
							<input type="date" id="filter" name="filter" class="form-control" min="<?=date("Y-m-d",strtotime("-3 Months"))?>" value="<?=date('Y-m-d')?>" max="<?=date('Y-m-d')?>">
						</div>
						<div class="form-group col-md-3 col-12">
							<input type="date" id="filter1" name="filter1" class="form-control" min="<?=date("Y-m-d",strtotime("-3 Months"))?>" value="<?=date('Y-m-d')?>" max="<?=date('Y-m-d')?>">
						</div>
						<div class="form-group col-md-3 col-12">
							<button class="btn btn-primary" id="filter-btn">Filter</button>
						</div>
					</div>
				</form>
			</div>

		<div class="col-12">
    	<h6>Respon Visitor Halaman Beasiswa</h6>
    	<div class="row">
				<div class="col-lg-3 col-4">
					<a class="text-decoration-none" href="#">
		        <div class="small-box bg-blue">
		          <div class="inner">
		            <h3 id="visitbea">{{ $visittodaybea ? $visittodaybea : 0 }}</h3>
		            <p>Visitor Halaman Beasiswa</p>
		          </div>
		        </div>
		      </a>
	      </div>
	      <div class="col-lg-3 col-4">
					<a class="text-decoration-none" href="#">
		        <div class="small-box bg-red">
		          <div class="inner">
		            <h3 id="registerbea">{{ $regtodaybea['views'] }}</h3>
		            <p>Klik Register Beasiswa</p>
		          </div>
		        </div>
		      </a>
	      </div>
	      <div class="col-lg-3 col-4">
					<a class="text-decoration-none" href="#">
		        <div class="small-box bg-success">
		          <div class="inner">
		            <h3 id="chatbea">{{ $chattodaybea['views'] }}</h3>
		            <p>Klik Chat Beasiswa</p>
		          </div>
		        </div>
		      </a>
	      </div>
	    </div>
	  </div>

    <div class="col-12">
    	<h6>Respon Visitor Halaman DKV</h6>
    	<div class="row">
	      <div class="col-lg-2 col-4">
					<a class="text-decoration-none" href="#">
		        <div class="small-box bg-success">
		          <div class="inner">
		            <h3 id="visitdkv">{{ $visittodaydkv ? $visittodaydkv : 0 }}</h3>
		            <p>Visitor Halaman DKV</p>
		          </div>
		        </div>
		      </a>
	      </div>
	      <div class="col-lg-2 col-4">
					<a class="text-decoration-none" href="#">
		        <div class="small-box bg-success">
		          <div class="inner">
		            <h3 id="registerdkv">{{ $regtodaydkv['views'] }}</h3>
		            <p>Klik Register DKV</p>
		          </div>
		        </div>
		      </a>
	      </div>
	      <div class="col-lg-2 col-4">
					<a class="text-decoration-none" href="#">
		        <div class="small-box bg-success">
		          <div class="inner">
		            <h3 id="chatdkv">{{ $chattodaydkv['views'] }}</h3>
		            <p>Klik Chat DKV</p>
		          </div>
		        </div>
		      </a>
	      </div>
	    </div>
    </div>

    <div class="col-12">
    	<h6>Respon Visitor Halaman SI</h6>
    	<div class="row">
	      <div class="col-lg-2 col-4">
	        <a class="text-decoration-none" href="#">
	          <div class="small-box bg-blue">
	            <div class="inner">
	              <h3 id="visitsi">{{ $visittodaysi ? $visittodaysi : 0 }}</h3>
	              <p>Visitor Halaman SI</p>
	            </div>
	          </div>
	        </a>
	      </div>
	      <div class="col-lg-2 col-4">
	        <a class="text-decoration-none" href="#">
	          <div class="small-box bg-blue">
	            <div class="inner">
	              <h3 id="registersi">{{ $regtodaysi['views'] }}</h3>
	              <p>Klik Register SI</p>
	            </div>
	          </div>
	        </a>
	      </div>
	      <div class="col-lg-2 col-4">
	        <a class="text-decoration-none" href="#">
	          <div class="small-box bg-blue">
	            <div class="inner">
	              <h3 id="chatsi">{{ $chattodaysi['views']  }}</h3>
	              <p>Klik Chat SI</p>
	            </div>
	          </div>
	        </a>
	      </div>
	    </div>
	  </div>

    <div class="col-12">
    	<h6>Respon Visitor Halaman IF</h6>
    	<div class="row">
	      <div class="col-lg-2 col-4">
	        <a class="text-decoration-none" href="#">
	          <div class="small-box bg-red">
	            <div class="inner">
	              <h3 id="visitif">{{ $visittodayif ? $visittodayif : 0 }}</h3>
	              <p>Visitor Halaman IF</p>
	            </div>
	          </div>
	        </a>
	      </div>
	      <div class="col-lg-2 col-4">
	        <a class="text-decoration-none" href="#">
	          <div class="small-box bg-red">
	            <div class="inner">
	              <h3 id="registerif">{{ $regtodayif['views']  }}</h3>
	              <p>Klik Register IF</p>
	            </div>
	          </div>
	        </a>
	      </div>
	      <div class="col-lg-2 col-4">
	        <a class="text-decoration-none" href="#">
	          <div class="small-box bg-red">
	            <div class="inner">
	              <h3 id="chatif">{{ $chattodayif['views']  }}</h3>
	              <p>Klik Chat IF</p>
	            </div>
	          </div>
	        </a>
	      </div>
	    </div>
    </div>

    <div class="col-12">
    	<h6>Respon Visitor Halaman AK</h6>
    	<div class="row">
	      <div class="col-lg-2 col-4">
	        <a class="text-decoration-none" href="#">
	          <div class="small-box bg-warning">
	            <div class="inner">
	              <h3 id="visitak">{{ $visittodayak ? $visittodayak : 0 }}</h3>
	              <p>Visitor Halaman AK</p>
	            </div>
	          </div>
	        </a>
	      </div>
	      <div class="col-lg-2 col-4">
	        <a class="text-decoration-none" href="#">
	          <div class="small-box bg-warning">
	            <div class="inner">
	              <h3 id="registerak">{{ $regtodayak['views'] }}</h3>
	              <p>Klik Register AK</p>
	            </div>
	          </div>
	        </a>
	      </div>
	      <div class="col-lg-2 col-4">
	        <a class="text-decoration-none" href="#">
	          <div class="small-box bg-warning">
	            <div class="inner">
	              <h3 id="chatak">{{ $chattodayak['views'] }}</h3>
	              <p>Klik Chat AK</p>
	            </div>
	          </div>
	        </a>
	      </div>
	    </div>
    </div>

    <div class="col-12">
    	<h6>Respon Visitor Halaman D3 SI</h6>
    	<div class="row">
	      <div class="col-lg-2 col-4">
	        <a class="text-decoration-none" href="#">
	          <div class="small-box bg-info">
	            <div class="inner">
	              <h3 id="visitmi">{{ $visittodaymi ? $visittodaymi : 0 }}</h3>
	              <p>Visitor Halaman D3 SI</p>
	            </div>
	          </div>
	        </a>
	      </div>
	      <div class="col-lg-2 col-4">
	        <a class="text-decoration-none" href="#">
	          <div class="small-box bg-info">
	            <div class="inner">
	              <h3 id="registermi">{{ $regtodaymi['views'] }}</h3>
	              <p>Klik Register D3 SI</p>
	            </div>
	          </div>
	        </a>
	      </div>
	      <div class="col-lg-2 col-4">
	        <a class="text-decoration-none" href="#">
	          <div class="small-box bg-info">
	            <div class="inner">
	              <h3 id="chatmi">{{ $chattodaymi['views'] }}</h3>
	              <p>Klik Chat D3 SI</p>
	            </div>
	          </div>
	        </a>
	      </div>
	    </div>
	  </div>

    	<div class="col-lg-6 col-6">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Traffic Halaman Beasiswa</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="lineChartBea" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6 col-6">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Traffic Halaman PalComTech</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="lineChartPCT" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6 col-6">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Traffic Halaman DKV</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="lineChartDKV" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6 col-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Traffic Halaman SI</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="lineChartSI" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6 col-6">
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Traffic Halaman IF</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="lineChartIF" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6 col-6">
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">Traffic Halaman AK</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="lineChartAK" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6 col-6">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Traffic Halaman D3 SI</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="lineChartMI" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
        </div>
      </div>
	    @endif
		</div>

	</div>
</div>
@endsection
