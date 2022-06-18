@extends('layout')

@section('content')    
	<center><h3>Toko Ahmad Motor</h3>
			<h4>Laporan List Sepeda Motor</h4>
	</center>

    <table class="table table-bordered">
		<th>No</th>
		<th>Kode Motor</th>
		<th>Nama Motor</th>
		<th>Jenis Motor</th>
		{{-- <th>No. Mesin</th> --}}
		<th>Tahun Motor</th>

		@foreach($listMotor as $no=>$motor)
	  		<tr>
	  			<td>{{ ++$no }}</td>
	  			<td>{{ $motor->kdMotor }}</td>
	  			<td>{{ $motor->merkMotor }}</td>
	  			<td>{{ $motor->jnsMotor }}</td>
	            {{-- <td>{{ $motor->noMesin }}</td> --}}
	  			<td>{{ $motor->thnMotor }}</td>
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