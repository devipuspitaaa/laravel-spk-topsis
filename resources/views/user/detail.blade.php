<div class="panel panel-primary">
	 <div class="panel-heading">Detail Motor</div>
	 <div class="panel-body">
	 	<div class="form-group">
	 		<div class="row">
	 			<div class="col-md-12">
		 			<table width="100%">
		 				<tr>
		 					<td width="50%"><label class="label-control">Nama Motor</label></td>
		 					<td>:</td>
		 					<td>{{ $dataMotor->merkMotor }}</td>
		 				</tr>

{{-- 		 				<tr>
		 					<td><label class="label-control">No. Mesin</label></td>
		 					<td>:</td>
		 					<td>{{ $dataMotor->noMesin }}</td>
		 				</tr> --}}

		 				<tr>
		 					<td><label class="label-control">Jenis Motor</label></td>
		 					<td>:</td>
		 					<td>{{ $dataMotor->jnsMotor }}</td>
		 				</tr>
		 			</table>
		 			<hr>
		 			Spesifikasi / Kriteria Motor
		 			<table width="100%">
		 				<tr>
		 					<td width="50%"><label class="label-control">Kondisi Mesin </label></td>
		 					<td>:</td>
		 					<td>{{ $dataMotor->konMesin }}</td>				
		 				</tr>

		 				<tr>
		 					<td><label class="label-control">Kondisi Body </label></td>
		 					<td>:</td>
		 					<td>{{ $dataMotor->konBody }}</td>				
		 				</tr>

		 				<tr>
		 					<td><label class="label-control">Lama Pemakaian </label></td>
		 					<td>:</td>
		 					<?php 
		 						$tahun = intdiv($dataMotor->thnPakai, 12);
		 						$bulan = $dataMotor->thnPakai % 12;

		 						if ($tahun==0){
		 							$thnAsli = 0;
		 						}
		 						elseif ($bulan==0){
		 							$thnAsli = $tahun.' Tahun';
		 						}
		 						elseif ($tahun<>0 && $bulan<>0){
		 							$thnAsli = $tahun.' Tahun '.$bulan.' Bulan';
		 						};
		 					?>
		 					<td>{{ $dataMotor->thnPakai }} Bulan ( {{ $thnAsli  }} )</td>				
		 				</tr>

		 				<tr>
		 					<td><label class="label-control">Harga (Rp)</label></td>
		 					<td>:</td>
		 					<td>{{ number_format($dataMotor->harga) }}</td>				
		 				</tr>
		 			</table><hr>

		 			Detail Nilai Perhitungan Metode Topsis
			 			<table width="100%">
			 				<tr>
			 					<td width="50%"><label class="label-control">Kondisi Mesin </label></td>
			 					<td>:</td>
			 					<td>{{ number_format($dataMotor->bnMesin,4) }}</td>				
			 				</tr>

			 				<tr>
			 					<td><label class="label-control">Kondisi Body </label></td>
			 					<td>:</td>
			 					<td>{{ number_format($dataMotor->bnBody,4) }}</td>				
			 				</tr>

			 				<tr>
			 					<td><label class="label-control">Lama Pemakaian </label></td>
			 					<td>:</td>
			 					<td>{{ number_format($dataMotor->bnTahun,4) }}</td>				
			 				</tr>

			 				<tr>
			 					<td><label class="label-control">Harga (Rp)</label></td>
			 					<td>:</td>
			 					<td>{{ number_format($dataMotor->bnHarga,4) }}</td>				
			 				</tr>

			 				<tr>
			 					<td><label class="label-control">Nilai Topsis </label></td>
			 					<td>:</td>
			 					{{-- <td>{{ number_format($dataMotor->nilTopsis,5) }}</td>				 --}}
			 					<td>{{ number_format($dataMotor->hasilTopsis,5) }}</td>				

			 				</tr>
			 			</table>


	 				<img src="{{ asset('/storage/fotoMotor/'.$dataMotor->foto) }}" alt="Foto Tidak Ada" width="200" height="200">
	 			</div>
	 		</div>		 		
	 	</div>
	 </div>
</div>