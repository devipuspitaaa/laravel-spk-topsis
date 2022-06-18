@extends('layout')

@section('header')
	<div class="row">
	    <ol class="breadcrumb">
	        <li><a href="#">
	                <em class="fa fa-home"></em>
	            </a>
	        </li>
	        <li class="active">Laporan</li>
	        <li>Laporan Pilihan User</li>
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
    			<div class="form-group">
					<div class="row">
		    			<div class="col-md-6">
		    				<label for="bulan" class="control-label">Bulan</label>
		    				<select name="bulan" class="form-control" id="bulan">
		    					<option value=""></option>
			    				<?php
			    					$bulan = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
			    					
			    					$no = 0;
			    					foreach ($bulan as $bln){
			    						$no+=1;
			    						echo "<option value=".$no.">$bln</option>";
			    					}
			    				 ?>
		    				</select>
		    			</div>

		    			<div class="col-md-6">
		    				<label for="tahun" class="control-label">Tahun</label>
		    				<select name="tahun" class="form-control" id="tahun">
		    					<option value=""></option>
			    				<?php
			    					for ($a=1990; $a <= date('Y'); $a++){
			    						echo "<option value=".$a.">".$a."</option>";
			    					}
			    				 ?>
			    			</select>
		    			</div>
					</div>
    			</div>

    			<div class="form-group">
    				<div class="row">
	    				<div class="col-md-6">
		         		   <p><button class="btn btn-primary" type="submit"> Tampilkan Data </button></p>	 
	    				</div>    				
    					
    				</div>
    			</div>

    		</div>
    	</div>

      </div>
    </form>

    @if(count($listPilUser)<>0)
	    <p>
	    	<a href="/admin/laporan/piluser/{{ $reqBulan }}/{{ $reqTahun }}" class="btn btn-primary" target="_blank">
				<span class="glyphicon glyphicon-zoom-in"> </span>
			</a>
								
			<a href="/admin/laporan/piluser/excel/{{ $reqBulan }}/{{ $reqTahun }}" class="btn btn-primary">
				<span class="glyphicon glyphicon-print"> </span> 
			</a>
	    </p>

	    <table class="table table-striped table-hover">
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
	@endif
@endsection

@section('footer')
	<script type="text/javascript">
		$(document).ready(function(){
			$('#bulan').select2();
			$('#tahun').select2();
		})
	</script>
@endsection
