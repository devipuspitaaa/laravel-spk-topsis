@extends('layout')

@section('header')
	<div class="row">
	    <ol class="breadcrumb">
	        <li><a href="#">
	                <em class="fa fa-home"></em>
	            </a>
	        </li>
	        <li class="active">Master</li>
	        <li>List Sepeda Motor</li>
	    </ol>
	</div>
@endsection

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    
    @if(!empty(session('msg')))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif

    <form class="row" style="margin-bottom: 20px">
      <div class="col-md-12">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari Berdasarkan Kode / Nama Motor" name="q"/>
              <span class="input-group-btn">
                <button class="btn btn-primary" type="submit">
                  <span class="glyphicon glyphicon-search"></span>
                </button>
              </span>
          </div>
      </div>
    </form>

    <p><a href="/admin/motor/form" class="btn btn-primary"> Tambah Data </a></p>
    
    <table class="table table-striped table-hover">
    	<th>No</th>
    	<th>Kode Motor</th>
    	<th>Nama Motor</th>
    	<th>Jenis Motor</th>
      {{-- <th>No. Mesin</th> --}}
    	<th>Tahun Motor</th>
    	<th>Action</th>

    	@foreach($listMotor as $no=>$motor)
        <form method="get" action="/admin/motor/{{ $motor->id }}/hapus" class="hapusData">
      		<tr>
      			<td>{{ ++$no + $listMotor->FirstItem() - 1}}</td>
      			<td>{{ $motor->kdMotor }}</td>
      			<td>{{ $motor->merkMotor }}</td>
      			<td>{{ $motor->jnsMotor }}</td>
            {{-- <td>{{ $motor->noMesin }}</td> --}}
      			<td>{{ $motor->thnMotor }}</td>
      			<td>
                      <a href="/admin/motor/{{ $motor->id }}/edit" class="btn btn-primary btn-sm">
                          <span class="glyphicon glyphicon-pencil"></span>
                      </a>
                      
                      <button class="btn btn-danger" type="submit">
                        <span class="glyphicon glyphicon-trash"></span>
                      </button>

                  </td>
      		</tr>
        </form>
    	@endforeach
    </table>

    <div class="pull-right">
        {!! $listMotor->render() !!}
    </div>
@endsection

@section('footer')
  <script>
    $(document).ready(function(){
      $('.hapusData').on('submit',function(){
        return confirm("Apakah Data Akan Dihapus ?");
      })
    })
  </script>
@endsection