@extends('layout')

@section('content')    
	<center><h3>Toko Ahmad Motor</h3>
			<h4>Laporan Pilihan User Bulan {{ $blnIndo }} Tahun {{ $tahun }}</h4>
	</center>

    <table class="table table-bordered">
		<th>No</th>
		<th>Tanggal</th>
		<th>Nama User</th>
		<th>Pilihan User</th>
		<th>Rekomendasi SPK</th>

		@foreach($listPilUser as $no=>$pilUser)
	  		<tr>
	  			<td>{{ ++$no }}</td>
	  			<td>{{ date('d - m - Y', strtotime($pilUser->tgl))  }}</td>
	  			<td>{{ $pilUser->nmUser }}</td>
	  			<td>{{ $pilUser->pilUser }}</td>
	            <td>
	            	{{ $pilUser->noMesin }} <br>
	            	{{ $pilUser->merkMotor }} <br>
	            	{{ $pilUser->jnsMotor }} <br>
	            	{{ $pilUser->nilTopsis }}

	            </td>
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