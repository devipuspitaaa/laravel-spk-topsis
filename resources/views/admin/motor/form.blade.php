@extends('layout')

@section('header')
	<div class="row">
	    <ol class="breadcrumb">
	        <li><a href="#">
	                <em class="fa fa-home"></em>
	            </a>
	        </li>
	        <li class="active">Master</li>
	        <li>Form Sepeda Motor</li>
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
		<div class="panel-body">
			<form method="post" action="/admin/motor/form" autocomplete enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="row">
					<div class="col-md-8">
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<label for="kdMotor" class="label-control">Kode Sepeda Motor</label>
									<input type="text" name="kdMotor" value="{{ $kode }}" class="form-control" readonly>
								</div>

								<div class="col-md-12 {{ $errors->has('jnsMotor') ? 'has-error' : '' }}">
									<label for="jnsMotor" class="label-control">Jenis Sepeda Motor</label>
									<select name="jnsMotor" class="form-control">
										<option value=""></option>
										<option value="Manual" {{ old('jnsMotor')==='Manual' ? 'selected' : '' }}>Manual</option>
										<option value="Matic" {{ old('jnsMotor')==='Matic' ? 'selected' : '' }}>Matic</option>
									</select>
									{!! $errors->first('jnsMotor','<p class=help-block>:message</p>') !!}
								</div>

								<div class="col-md-12 {{ $errors->has('merkMotor') ? 'has-error' : '' }}">
									<label for="merkMotor" class="label-control">Nama Sepeda Motor</label>
									<input type="text" name="merkMotor" value="{{ old('merkMotor') }}" class="form-control">
									{!! $errors->first('merkMotor','<p class=help-block>:message</p>') !!}	
								</div>

								{{-- <div class="col-md-12 {{ $errors->has('noMesin') ? 'has-error' : '' }}">
									<label for="noMesin" class="label-control">No. Mesin</label>
									<input type="text" name="noMesin" value="{{ old('noMesin') }}" class="form-control">
									{!! $errors->first('noMesin','<p class=help-block>:message</p>') !!}
								</div> --}}

								<div class="col-md-4 {{ $errors->has('thnMotor') ? 'has-error' : ''}}">
									<label for="thnMotor" class="label-control">Tahun Sepeda Motor</label>
									<input type="text" name="thnMotor" value="{{ old('thnMotor') }}" class="form-control" maxlength="4" id="thnMotor">
									{!! $errors->first('thnMotor','<p class=help-block>:message</p>') !!}
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group {{ $errors->has('fotoMotor') ? 'has-error' : '' }}">
							<label for="fotoMotor" class="label-control">Foto Mobil</label><br>					
							<img src="{{ asset('foto/sample.gif') }}" width="250" height="200" alt="Foto Tidak Ada" id="foto"><br><br>
						
							<label class="btn btn-sm btn-info glyphicon glyphicon-camera">
								<input type="file" name="fotoMotor" accept="image/jpeg" style="display:none;" onchange="previewGambar(this)" />
							</label>
							{!! $errors->first('fotoMotor','<p class=help-block>:message</p>') !!}				
						</div>
					</div>
				</div><hr>

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
					<a href="/admin/motor/list" class="btn btn-default">Batal</a>
				</div>
			</form>
		</div>
	</div>
@endsection

@section('footer')
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>		
	<script>
		function previewGambar(input){
			if (input.files && input.files[0]){
				var reader = new FileReader();
				reader.onload = function(e){
					$(foto).attr('src',e.target.result);
				}
					reader.readAsDataURL(input.files[0]);
			};
		};
	
		// $(document).ready(function(){
  //           $("#thnMotor").keypress(function(data){
  //               //if((data.which<48 || data.which>57) && (data.which<44 || data.which>46) && (data.which!=97 ))
  //               if((data.which<48 || data.which>57) && (data.which<44 || data.which>46)) {
  //                   return false;
  //               }
  //       })

	</script>
@endsection