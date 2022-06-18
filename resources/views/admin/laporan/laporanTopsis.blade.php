@extends('layout')

@section('header')
	<div class="row">
	    <ol class="breadcrumb">
	        <li><a href="#">
	                <em class="fa fa-home"></em>
	            </a>
	        </li>
	        <li class="active">Laporan</li>
	        <li>Laporan Kriteria</li>
	    </ol>
	</div>
@endsection

@section('content')    
    @if(!empty(session('msg')))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif

    @if(count($listTopsis)<>0)
	    <p>
	    	<a href="/admin/laporan/topsis/preview" class="btn btn-primary" target="_blank">
				<span class="glyphicon glyphicon-zoom-in"> </span>
			</a>
								
			<a href="/admin/laporan/topsis/excel" class="btn btn-primary">
				<span class="glyphicon glyphicon-print"> </span> 
			</a>
	    </p>

	    <table class="table table-striped table-hover">
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
	@endif
@endsection