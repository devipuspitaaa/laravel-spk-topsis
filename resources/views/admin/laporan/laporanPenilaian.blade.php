@extends('layout')

@section('header')
	<div class="row">
	    <ol class="breadcrumb">
	        <li><a href="#">
	                <em class="fa fa-home"></em>
	            </a>
	        </li>
	        <li class="active">Laporan</li>
	        <li>Laporan Penilaian</li>
	    </ol>
	</div>
@endsection

@section('content')    
    @if(!empty(session('msg')))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif

    <form class="row" style="margin-bottom: 20px" method="GET">
      <div class="col-md-12">
    	<div class="panel panel-default">
    		<div class="panel panel-body">
	          	<input type="radio" name="q" value="semua"> Semua Data <br>  
	          	<input type="radio" name="q" value="manual"> Manual <br>
	          	<input type="radio" name="q" value="matic"> Matic <br><br>
	      
	            <button class="btn btn-primary" type="submit"> Tampilkan Data </button>
    		</div>
    	</div>

      </div>
    </form>

    @if(count($listPenilaian)<>0)
	    <p>
	    	<a href="/admin/laporan/penilaian/preview/{{ $cari }}" class="btn btn-primary" target="_blank">
				<span class="glyphicon glyphicon-zoom-in"> </span>
			</a>
								
			<a href="/admin/laporan/penilaian/excel/{{ $cari }}" class="btn btn-primary">
				<span class="glyphicon glyphicon-print"> </span> 
			</a>
	    </p>

	    <table class="table table-striped table-hover">
			<th>No</th>
			<th>Kode Motor</th>
			<th>Nama Motor</th>
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
	@endif
@endsection