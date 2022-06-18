@extends('user.layoutUser')

@section('header')
	<div class="row">
	    <ol class="breadcrumb">
	        <li><a href="#">
	                <em class="fa fa-home"></em>
	            </a>
	        </li>
	        <li class="active">User</li>
	        <li>Pencarian Sepeda Motor</li>
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
			<form method="post" action="/pemilihan" autocomplete >
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				
	 			<div class="form-group">
					<div class="row">
						<div class="col-md-12 {{ $errors->has('nmUser') ? 'has-error' : ' ' }}">
							<label for="nmUser" class="label-control">Nama </label>
							<input type="text" name="nmUser" class="form-control" placeholder="Masukkan Nama Anda" value="{{ old('nmUser')}}">
							{!! $errors->first('nmUser','<p class=help-block>:message</p>') !!}
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-12 {{ $errors->has('jnsMotor') ? 'has-error' : '' }}">
							<label for="jnsMotor" class="label-control">Jenis Motor</label>
							<select name="jnsMotor" class="form-control">
								<option value=""></option>
								<option value="Manual" {{ old('jnsMotor')==='Manual' ? 'selected' : '' }}>Manual</option>
								<option value="Matic" {{ old('jnsMotor')==='Matic' ? 'selected' : '' }}>Matic</option>
							</select>
							{!! $errors->first('jnsMotor','<p class=help-block>:message</p>') !!}
						</div>
					</div>
				</div>

				<hr>

				<div class="form-group">
					<div class="row">
						<div class="col-md-6 {{ $errors->has('krKonMesin') ? 'has-error' : ' ' }}">
							<label for="krKonMesin" class="label-control">Kondisi Mesin</label>
							<select name="krKonMesin[]" class="form-control js-krKonMesin" multiple="multiple">
								<option value="Sangat Baik">Sangat Baik</option>
								<option value="Baik">Baik</option>
								<option value="Cukup Baik">Cukup Baik</option>
							</select>
							{!! $errors->first('krKonMesin','<p class=help-block>:message</p>') !!}
						</div>

						<div class="col-md-6 {{ $errors->has('krKonBody') ? 'has-error' : ' ' }}">
							<label for="krKonBody" class="label-control">Kondisi Body</label>
							<select name="krKonBody[]" class="form-control js-krKonBody" multiple="multiple">
								<option value="Sangat Baik">Sangat Baik</option>
								<option value="Baik">Baik</option>
								<option value="Cukup Baik">Cukup Baik</option>
							</select>
							{!! $errors->first('krKonBody','<p class=help-block>:message</p>') !!}
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-12">
							<label for="krLamaPakai" class="label-control">Lama Pemakaian (Bulan)</label>
							<div class="row">
								<div class="col-md-12 {{ $errors->has('tahunAwal') ? 'has-error' : ' ' }}">
									<input type="text" class="form-control" placeholder="Bulan" name="tahunAwal" value="{{ old('tahunAwal')}}"> 
									{!! $errors->first('tahunAwal','<p class=help-block>:message</p>') !!}	
								</div>

								{{-- <div class="col-md-6 {{ $errors->has('tahunAkhir') ? 'has-error' : ' ' }}">
									<input type="text" class="form-control" placeholder="Bulan Akhir" name="tahunAkhir" value="0"> 
									{!! $errors->first('tahunAkhir','<p class=help-block>:message</p>') !!}
								</div> --}}				
							</div>

						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-12">
							<label for="harga" class="label-control">Harga (Rp)</label>
							<div class="row">
								<div class="col-md-12 {{ $errors->has('hargaAwal') ? 'has-error' : ' ' }}">
									<input type="text" class="form-control" placeholder="Harga" name="hargaAwal" value="{{ old('hargaAwal')}}">
									{!! $errors->first('hargaAwal','<p class=help-block>:message</p>') !!} 
								</div>

{{-- 								<div class="col-md-6 {{ $errors->has('hargaAkhir') ? 'has-error' : ' ' }}">
									<input type="text" class="form-control" placeholder="Harga Akhir" name="hargaAkhir" value="0"> 
									{!! $errors->first('hargaAkhir','<p class=help-block>:message</p>') !!}
								</div> --}}
									
							</div>

						</div>
					</div>
				</div>

			{{-- 	<div class="form-group">
					<div class="row">
						<div class="col-md-12">						
							<label for="harga" class="label-control">Harga (Rp)</label>
								<select class="form-control" name="harga">
									<option value=""></option>
									<option value="0-14000000"> < Rp. 14.000.000 </option>
									<option value="14000000-18000000"> Rp. 14.000.000 - Rp. 18.000.000 </option>
									<option value="18000000-22000000"> Rp. 18.000.000 - Rp. 22.000.000 </option>
									<option value="22000000-26000000"> Rp. 22.000.000 - Rp. 26.000.000 </option>
									<option value="26000000"> > Rp. 26.000.000 </option>
								</select>
					
							<div class="col-md-6 {{ $errors->has('hargaAwal') ? 'has-error' : ' ' }}">
									<input type="text" class="form-control" placeholder="Harga Awal" name="hargaAwal" value="{{ old('hargaAwal')}}">
									{!! $errors->first('hargaAwal','<p class=help-block>:message</p>') !!} 
							</div>

							<div class="col-md-6 {{ $errors->has('hargaAkhir') ? 'has-error' : ' ' }}">
									<input type="text" class="form-control" placeholder="Harga Akhir" name="hargaAkhir" value="0"> 
									{!! $errors->first('hargaAkhir','<p class=help-block>:message</p>') !!}
							</div>
						</div>							
					</div>					
				</div> --}}

				{{-- <p align="justify">*Ket : Contoh Untuk Pengisian Penilaian Lama Pemakaian. Misal ingin mencari sepeda motor dengan lama pemakaian antara 5 bulan sampai 10 bulan (artinya lama pemakaian motor sudah 5 bulan, 6 bulan.. sampai 10 bulan). Maka Masukkan angka 5 diinputan bulan awal dan 10 diinputan bulan akhir.</p>

				<p align="justify">Jika yang dicari adalah sepeda motor dengan lama pemakaian hanya 10 bulan maka masukkan angka 10 diinputan awal dan diinputan bulan akhir kosongkan saja
				</p> --}}

				<div class="form-group">
					<button type="submit" class="btn btn-primary">Proses</button>
					<a href="/" class="btn btn-default">Batal</a>
				</div>
			</form>
		</div>
	</div>
@endsection

@section('footer')
	<script type="text/javascript">
		$(document).ready(function(){
			$('.js-krKonMesin').select2();
			$('.js-krKonBody').select2();
		})
	</script>
@endsection