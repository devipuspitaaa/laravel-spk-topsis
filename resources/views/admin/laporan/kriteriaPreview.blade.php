@extends('layout')

@section('content')    
	<center><h3>Toko Ahmad Motor</h3>
			<h4>Laporan Kriteria</h4>
	</center>

    <table class="table table-bordered">
		<th>No</th>
		<th>Kode Kriteria</th>
		<th>Kriteria</th>
		<th>Deskripsi</th>
		<th>Bobot (%)</th>

		@foreach($listKriteria as $no=>$kriteria)
	  		<tr>
	  			<td>{{ ++$no }}</td>
	  			<td>{{ $kriteria->kdKriteria }}</td>
	  			<td>{{ $kriteria->nmKriteria }}</td>
	  			<td>{{ $kriteria->ket }}</td>
	            <td>{{ $kriteria->bobot }}</td>
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