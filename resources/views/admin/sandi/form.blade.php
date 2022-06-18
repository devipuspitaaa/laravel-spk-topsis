@extends('layout')

@section('header')
	<div class="row">
	    <ol class="breadcrumb">
	        <li><a href="#">
	                <em class="fa fa-home"></em>
	            </a>
	        </li>
	        <li class="active">Fasilitas</li>
	        <li>Ubah Sandi</li>
	    </ol>
	</div>
@endsection

@section('content')
	@if (!empty(session('msg')))
		<div class="alert alert-danger">
			{{ session('msg') }}
		</div>
	@endif
	
	<div class="panel panel-default">
		<div class="panel panel-body">
			<form method="post" action="/admin/ubahSandi/{{ $data->id }}" autocomplete >
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<div class="row">
						<div class="col-md-6 {{ $errors->has('nmLengkap') ? 'has-error' : '' }}">
							<label for="nmLengkap" class="label-control">Nama Lengkap</label>
							<input type="text" name="nmLengkap" class="form-control" value="{{ $data->nama }}">
							{!! $errors->first('nmLengkap','<p class=help-block>:message</p>')!!}
						</div>

						<div class="col-md-6 {{ $errors->has('pengguna') ? 'has-error' : '' }}">
							<label for="pengguna" class="label-control">Pengguna</label>
							<input type="text" name="pengguna" class="form-control" value="{{ $data->pengguna }}">
							{!! $errors->first('pengguna','<p class=help-block>:message</p>')!!}
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-6 {{ $errors->has('sandiLama') ? 'has-error' : '' }}">
							<label for="sandiLama" class="label-control">Sandi Lama</label>
							<input type="password" name="sandiLama" class="form-control" >
							{!! $errors->first('sandiLama','<p class=help-block>:message</p>')!!}
						</div>

						<div class="col-md-6 {{ $errors->has('sandiBaru') ? 'has-error' : '' }}">
							<label for="sandiBaru" class="label-control">Sandi Baru</label>
							<input type="password" name="sandiBaru" class="form-control" >
							{!! $errors->first('sandiBaru','<p class=help-block>:message</p>')!!}
						</div>
					</div>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary">Simpan </button>
					<a href="/admin/home" class="btn btn-default">Batal</a>
				</div>
			</form>
		</div>
	</div>
@endsection