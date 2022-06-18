@extends('layout')

@section('header')
	<div class="row">
	    <ol class="breadcrumb">
	        <li><a href="#">
	                <em class="fa fa-home"></em>
	            </a>
	        </li>
	        <li class="active">Transaksi</li>
	        <li>List Penilaian</li>
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
            <input type="text" class="form-control" placeholder="Cari Berdasarkan Nama / jenis Motor " name="q"/>
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
    	<th>Kode Motor</th>
    	<th>Jenis Motor</th>
    	<th>Nama Motor</th>
    	<th>Action</th>

    	@foreach($listNilai as $no=>$nilai)
        <form method="get" class="hapusData">
      		<tr>
      			<td>{{ ++$no }}</td>
      			<td>{{ $nilai->kdMotor }}</td>
      			<td>{{ $nilai->jnsMotor }}</td>
      			<td>{{ $nilai->merkMotor }}</td>
            <td>
                @if ($nilai->status==1)
                    <a href="/admin/penilaian/form/{{ $nilai->id }}/" class="btn btn-primary btn-sm">
                        <span class="glyphicon glyphicon-plus"></span>
                    </a>
                @else
                    <a href="/admin/penilaian/{{ $nilai->id }}/edit" class="btn btn-danger btn-sm">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                @endif

            </td>
      			
      		</tr>
        </form>
    	@endforeach
    </table>
@endsection