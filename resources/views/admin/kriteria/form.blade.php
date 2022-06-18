@extends('layout')

@section('header')
	<div class="row">
	    <ol class="breadcrumb">
	        <li><a href="#">
	                <em class="fa fa-home"></em>
	            </a>
	        </li>
	        <li class="active">Master</li>
	        <li>Form Ubah Kriteria</li>
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
			<form method="post" action="/admin/kriteria/form/{{ $data->id }}" autocomplete >
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<div class="row">
						<div class="col-md-3">
							<label for="kdMotor" class="label-control">Kode Kriteria</label>
							<input type="text" name="kdMotor" value="{{ $data->kdKriteria }}" class="form-control" readonly>
						</div>
					</div>
				</div>

				<div class="form-group {{ $errors->has('nmKriteria') ? 'has-error' : '' }}">
					<div class="row">
						<div class="col-md-12">
							<label for="nmKriteria" class="label-control">Kriteria</label>
							<input type="text" class="form-control" name="nmKriteria" value="{{ $data->nmKriteria }}">
							{!! $errors->first('nmKriteria','<p class=help-block>:message</p>') !!}
						</div>
					</div>
				</div>

				<div class="form-group {{ $errors->has('ket') ? 'has-error' : '' }}">
					<div class="row">
						<div class="col-md-12">
							<label for="ket" class="label-control">Keterangan</label>
							<textarea name="ket" class="form-control" rows="3">{{ $data->ket }}</textarea>
							{!! $errors->first('ket','<p class=help-block>:message</p>') !!}
						</div>
					</div>
				</div>

				<div class="form-group {{ $errors->has('bobot') ? 'has-error' : '' }}">
					<div class="row">
						<div class="col-md-3">
							<label for="bobot" class="label-control">Bobot (%)</label>
							<input type="text" name="bobot" class="form-control" value="{{ $data->bobot }}" maxlength="3">
							{!! $errors->first('bobot','<p class=help-block>:message</p>') !!}
						</div>
					</div>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary">Simpan </button>
					<a href="/admin/kriteria/list" class="btn btn-default">Batal</a>
				</div>

				<input type="hidden" name="nmKriteriaLama" value="{{ $data->nmKriteria }}">
				<input type="hidden" name="bobotLama" value="{{ $data->bobot }}">
			</form>
		</div>
	</div>
@endsection