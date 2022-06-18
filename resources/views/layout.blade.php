<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SPK Sepeda Motor Metode Topsis</title>
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/datepicker3.css') }}" rel="stylesheet">
	<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
	<link href="{{ asset('select2/css/select2.min.css')}}" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#"><span>Topsis</span>Admin</a>
				
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				{{-- <img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt=""> --}}
				<img src={{ asset('foto/admin.png') }} class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">{{ session('auth')->pengguna }}</div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>

		<ul class="nav menu">
			<li ><a href="/admin/home"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-desktop">&nbsp;</em> Master <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="/admin/motor/list">
						<span class="fa fa-arrow-right">&nbsp;</span> Sepeda Motor
					</a></li>
					<li><a class="" href="/admin/kriteria/list">
						<span class="fa fa-arrow-right">&nbsp;</span> Kriteria
					</a></li>
				</ul>
			</li>

			{{-- <li class="parent "><a data-toggle="collapse" href="#sub-item-2">
				<em class="fa fa-edit">&nbsp;</em> Transaksi <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-2">
					<li><a class="" href="/admin/penilaian/list">
						<span class="fa fa-arrow-right">&nbsp;</span> Penilaian
					</a></li>
				</ul>
			</li> --}}

			<li class="parent "><a data-toggle="collapse" href="#sub-item-3">
				<em class="fa fa-navicon">&nbsp;</em> Laporan <span data-toggle="collapse" href="#sub-item-3" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-3">
					<li><a class="" href="/admin/laporan/motor">
						<span class="fa fa-arrow-right">&nbsp;</span> Sepeda Motor
					</a></li>
					<li><a class="" href="/admin/laporan/kriteria">
						<span class="fa fa-arrow-right">&nbsp;</span> Kriteria
					</a></li>
					<li><a class="" href="/admin/laporan/penilaian">
						<span class="fa fa-arrow-right">&nbsp;</span> Penilaian
					</a></li>
					<li><a class="" href="/admin/laporan/piluser">
						<span class="fa fa-arrow-right">&nbsp;</span> Pilihan User
					</a></li>
					<li><a class="" href="/admin/topsisadmin">
						<span class="fa fa-arrow-right">&nbsp;</span> Topsis
					</a></li>
				</ul>
			</li>

			<li class="parent "><a data-toggle="collapse" href="#sub-item-4">
				<em class="fa fa-wrench">&nbsp;</em> Fasilitas <span data-toggle="collapse" href="#sub-item-4" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-4">
					<li><a class="" href="/admin/ubahSandi/{{ session('auth')->id }}">
						<span class="fa fa-arrow-right">&nbsp;</span> Ubah Kata Sandi
					</a></li>
				</ul>
			</li>


			<li><a href="/logout"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		@yield('header')<br>
		@yield('content')
	
		{{-- @if (!empty(session('msg')))
			<div class="alert alert-danger">
				{{ session('msg') }}
			</div>
		@endif --}}
	</div>	<!--/.main-->
	
	<script src="{{ asset('js/jquery-1.11.1.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/chart.min.js') }}"></script>
	<script src="{{ asset('js/chart-data.js') }}"></script>
	<script src="{{ asset('js/easypiechart.js') }}"></script>
	<script src="{{ asset('js/easypiechart-data.js') }}"></script>
	<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('js/custom.js') }}"></script>
	<script src="{{ asset('select2/js/select2.min.js') }}"></script>
	
	@yield('footer')
</body>
</html>