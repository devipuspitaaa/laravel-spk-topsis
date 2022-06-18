@extends('layout')

@section('content')    
	<center><h3>Toko Ahmad Motor</h3>
			<h4>Laporan Kriteria</h4>
	</center>

    <table class="table table-bordered">
		<th>No</th>
		<th>Kode Motor</th>
		<th>Merk Motor</th>
		<th>Jenis Motor</th>
		<th>Nilai Topsis</th>

		@foreach($listTopsis as $no=>$topsis)
	  		<tr>
	  			<td>{{ ++$no }}</td>
	  			<td>{{ $topsis->kdMotor }}</td>
	  			<td>{{ $topsis->merkMotor }}</td>
	  			<td>{{ $topsis->jnsMotor }}</td>
	            <td>{{ number_format($topsis->topsis,5) }}</td>
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