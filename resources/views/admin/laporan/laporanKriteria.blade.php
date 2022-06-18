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

    @if(count($listKriteria)<>0)
	    <p>
	    	<a href="/admin/laporan/kriteria/preview" class="btn btn-primary" target="_blank">
				<span class="glyphicon glyphicon-zoom-in"> </span>
			</a>
								
			<a href="/admin/laporan/kriteria/excel" class="btn btn-primary">
				<span class="glyphicon glyphicon-print"> </span> 
			</a>
	    </p>

	    <table class="table table-striped table-hover">
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
	@endif
@endsection