@extends('layout')

@section('header')
	<div class="row">
	    <ol class="breadcrumb">
	        <li><a href="#">
	                <em class="fa fa-home"></em>
	            </a>
	        </li>
	        <li class="active">Transaksi</li>
	        <li>Form Penilaian</li>
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
			<form method="post" action="/admin/penilaian/form/{{ $dataMotor->id }}" autocomplete >
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				
				<div class="form-group">
					<div class="row">
						<div class="col-md-3">
							<label for="kdMotor" class="label-control">Kode Motor</label>
							<input type="text" name="kdMotor" class="form-control" value="{{ $dataMotor->kdMotor }}" readonly>
						</div>

						<div class="col-md-9">
							<label for="jnsMotor" class="label-control">Jenis Motor</label>
							<input type="text" name="jnsMotor" class="form-control" value="{{ $dataMotor->jnsMotor }}" readonly>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-12">
							<label for="merkMotor" class="label-control">Nama Motor</label>
							<input type="text" name="merkMotor" class="form-control" value="{{ $dataMotor->merkMotor }}" readonly>
						</div>

{{-- 						<div class="col-md-6">
							<label for="noMesin" class="label-control">No Mesin</label>
							<input type="text" name="noMesin" class="form-control" value="{{ $dataMotor->noMesin }}" readonly>
						</div> --}}
					</div>
				</div>
				<input type="hidden" name="kdMotor" value="{{ $dataMotor->kdMotor }}">
				<hr>

				<div class="form-group">
					<div class="row">
						<div class="col-md-6 {{ $errors->has('krKonMesin') ? 'has-error' : ' ' }}">
							<label for="krKonMesin" class="label-control">Kondisi Mesin</label>
							<select name="krKonMesin" class="form-control">
								<option value=""></option>
								<option value="Sangat Baik" {{ old('krKonMesin')==='Sangat Baik' ? 'selected' : '' }}>Sangat Baik</option>
								<option value="Baik" {{ old('krKonMesin')==='Baik' ? 'selected' : '' }}>Baik</option>
								<option value="Cukup Baik" {{ old('krKonMesin')==='Cukup Baik' ? 'selected' : '' }}>Cukup Baik</option>
							</select>
							{!! $errors->first('krKonMesin','<p class=help-block>:message</p>') !!}
						</div>

						<div class="col-md-6 {{ $errors->has('krKonBody') ? 'has-error' : ' ' }}">
							<label for="krKonBody" class="label-control">Kondisi Body</label>
							<select name="krKonBody" class="form-control">
								<option value=""></option>
								<option value="Sangat Baik" {{ old('krKonBody')==='Sangat Baik' ? 'selected' : '' }}>Sangat Baik</option>
								<option value="Baik" {{ old('krKonBody')==='Baik' ? 'selected' : '' }}>Baik</option>
								<option value="Cukup Baik" {{ old('krKonBody')==='Cukup Baik' ? 'selected' : '' }}>Cukup Baik</option>
							</select>
							{!! $errors->first('krKonBody','<p class=help-block>:message</p>') !!}
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-6 {{ $errors->has('krLamaPakai') ? 'has-error' : ' ' }}">
							<label for="krLamaPakai" class="label-control">Lama Pemakaian (Bulan)</label>
							<input type="text" name="krLamaPakai" class="form-control" value="{{ old('krLamaPakai') }}" maxlength="3">
							{!! $errors->first('krLamaPakai','<p class=help-block>:message</p>') !!}
						</div>

						<div class="col-md-6 {{ $errors->has('krHarga') ? 'has-error' : ' ' }}">
							<label for="krHarga" class="label-control">Harga (Rp)</label>
							<input type="text" name="krHarga" class="form-control" value="{{ old('krHarga') }}">
							{!! $errors->first('krHarga','<p class=help-block>:message</p>') !!}
						</div>
					</div>
				</div>			

				<div class="form-group">
					<button type="submit" class="btn btn-primary">Simpan </button>
					<a href="/admin/penilaian/list" class="btn btn-default">Batal</a>
				</div>
			</form>
		</div>
	</div>
@endsection