<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SPK TOPSIS</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			@if (!empty(session('msg')))
				<div class="alert alert-danger">
					{{ session('msg') }}
				</div>
			@endif

			<div class="login-panel panel panel-default">
				<div class="panel-heading">Masuk Aplikasi</div>
				<div class="panel-body">
					<form method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<fieldset>
							<div class="form-group">
								<label>Pengguna</label>
								<input class="form-control" placeholder="Pengguna" name="pengguna" type="pengguna" autofocus="">
							</div>
							<div class="form-group">
								<label>Pengguna</label>
								<input class="form-control" placeholder="Kata Sandi" name="sandi" type="password" value="">
							</div>
							<button class="btn btn-primary">Masuk</button>
							<a href="">Kembali</a>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
