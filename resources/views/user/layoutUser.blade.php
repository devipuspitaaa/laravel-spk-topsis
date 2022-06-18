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
		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h4 class="modal-title" id="exampleModalLabel">Kontak</h4>
		      </div>

		      <form method="post" action="/kontak" autocomplete>
			      <input type="hidden" name="_token" value="{{ csrf_token() }}">
			      <div class="modal-body">
						<div class="row">
							<div class="col-md-4">
								 Telpon : 
								 <p><label class="label-contro">0819 3652 4890</label></p>

								 Email : 
								 <p><label class="label-contro">Vazryanwar@gmail.com</label></p>
							</div>

							<div class="col-md-8">
								<div class="col-md-12 {{ $errors->has('nama') ? 'has-error' : '' }}">
									Nama
									<input type="text" name="nama" class="form-control">
									{!! $errors->first('nama','<p class=help-block>:message</p>') !!}
								</div>

								<div class="col-md-12 {{ $errors->has('email') ? 'has-error' : '' }}">
									Email
									<input type="email" name="email" class="form-control">
									{!! $errors->first('email','<p class=help-block>:message</p>') !!}
								</div>

								<div class="col-md-12 {{ $errors->has('subject') ? 'has-error' : '' }}">
									Subject
									<input type="text" name="subject" class="form-control">
									{!! $errors->first('subject','<p class=help-block>:message</p>') !!}
								</div>
							
							</div>
						</div>
			      </div>
			      <div class="modal-footer">
			        <button type="submit" class="btn btn-primary">Kirim</button>
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			      </div>
		      </form>

		    </div>
		  </div>
		</div>

		<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span></button>
					<a class="navbar-brand" href="#"><span>SPK Motor Metode Topsis</span></a>
					
				</div>
			</div><!-- /.container-fluid -->
		</nav>
		<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
			<div class="profile-sidebar">
				<div class="profile-userpic">
					{{-- <img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt=""> --}}
					<img src={{ asset('foto/user.jpg') }} class="img-responsive" alt="">
				</div>
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">User</div>
					<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="divider"></div>

			<ul class="nav menu">
				<li ><a href="/"><em class="fa fa-dashboard">&nbsp;</em> Home </a></li>
				<li ><a href="/pemilihan"><em class="fa fa-motorcycle">&nbsp;</em> Pemilihan Motor </a></li>
				<li ><a data-toggle="modal" data-target="#exampleModal"><em class="fa fa-address-card-o">&nbsp;</em> Kontak </a></li>
				<li><a href="/login"><em class="fa fa-sign-in">&nbsp;</em> Login</a></li>
			</ul>
		</div><!--/.sidebar-->
			
		<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
			@yield('header')<br>
			@yield('content')
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