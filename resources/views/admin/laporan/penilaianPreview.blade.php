@extends('layout')

@section('content')    
	<center><h3>Toko Ahmad Motor</h3>
			<h4>Laporan Penilaian Sepeda Motor</h4>
	</center>

    <table class="table table-bordered">
		<th>No</th>
		<th>Kode Motor</th>
		<th>Jenis Motor</th>
		<th>Jenis Motor</th>
		{{-- <th>No. Mesin</th> --}}
		<th>Tahun Motor</th>
		<th>Kondisi Mesin</th>
		<th>kondisi Body</th>
		<th>Lama Pemakaian</th>
		<th>Harga (Rp)</th>

		@foreach($listPenilaian as $no=>$penilaian)
	  		<tr>
	  			<td>{{ ++$no }}</td>
	  			<td>{{ $penilaian->kdMotor }}</td>
	  			<td>{{ $penilaian->merkMotor }}</td>
	  			<td>{{ $penilaian->jnsMotor }}</td>
	            {{-- <td>{{ $penilaian->noMesin }}</td> --}}
	  			<td>{{ $penilaian->thnMotor }}</td>
	  			<td>{{ $penilaian->konMesin }}</td>
	  			<td>{{ $penilaian->konBody }}</td>

				<?php 
		 			$tahun = intdiv($penilaian->thnPakai, 12);
						$bulan = $penilaian->thnPakai % 12;

						if ($bulan==0){
							$thnAsli = $tahun.' Tahun';
						}
						elseif ($tahun<>0 && $bulan<>0){
							$thnAsli = $tahun.' Tahun '.$bulan.' Bulan';
						}
						elseif ($tahun==0 && $bulan<>0){
							$thnAsli = $bulan.' Bulan';
						};
					?>

					<td> {{ $thnAsli  }} </td>		
	  			<td>{{ number_format($penilaian->harga) }}</td>
	  		</tr>
		@endforeach
    </table>

    <div class="pull-right">
    	<p>Banjarbaru, {{ tglIndo(date("d-m-Y"),'2') }}</p>
    	<p>Mengetahui,</p>
    </div>
@endsection

@section('footer')
	<script>
	window.onload = window.print();
	window.close();
	</script>
@endsection