@extends('layout')

@section('header')
	<div class="row">
	    <ol class="breadcrumb">
	        <li><a href="#">
	                <em class="fa fa-home"></em>
	            </a>
	        </li>
	        <li class="active">Master</li>
	        <li>List Kriteria</li>
	    </ol>
	</div>
@endsection

@section('content') 
    @if(!empty(session('msg')))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif

    <form class="row" style="margin-bottom: 20px">
      <div class="col-md-12">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari Berdasarkan Kode / kriteria" name="q"/>
              <span class="input-group-btn">
                <button class="btn btn-primary" type="submit">
                  <span class="glyphicon glyphicon-search"></span>
                </button>
              </span>
          </div>
      </div>
    </form>

    <table class="table table-striped table-hover">
    	<th>No</th>
    	<th>Kode Kriteria</th>
    	<th>Kriteria</th>
    	<th>Bobot (%)</th>
    	<th>Action</th>

    	@foreach($listKriteria as $no=>$kriteria)
        <form method="get" action="/admin/motor/{{ $kriteria->id }}/hapus" class="hapusData">
      		<tr>
      			<td>{{ ++$no }}</td>
      			<td>{{ $kriteria->kdKriteria }}</td>
      			<td>{{ $kriteria->nmKriteria }}</td>
      			<td>{{ $kriteria->bobot }}</td>
      			<td>
                      <a href="/admin/kriteria/form/{{ $kriteria->id }}" class="btn btn-primary btn-sm">
                          <span class="glyphicon glyphicon-pencil"></span>
                      </a>
            </td>
      		</tr>
        </form>
    	@endforeach
    </table>
@endsection