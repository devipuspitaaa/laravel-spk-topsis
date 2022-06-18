@extends('layout')

@section('header')
	<div class="row">
	    <ol class="breadcrumb">
	        <li><a href="#">
	                <em class="fa fa-home"></em>
	            </a>
	        </li>
	        <li class="active">Laporan</li>
	        <li>Laporan Sepeda Motor</li>
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

    @if(count($listMotor)<>0)
	    <p>
	    	<a href="/admin/laporan/motor/preview/{{ $cari }}" class="btn btn-primary" target="_blank">
				<span class="glyphicon glyphicon-zoom-in"> </span>
			</a>
								
			<a href="/admin/laporan/motor/excel/{{ $cari }}" class="btn btn-primary">
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
	@endif
@endsection