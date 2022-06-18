@extends('user.layoutUser')

@section('header')
	<div class="row">
	    <ol class="breadcrumb">
	        <li><a href="#">
	                <em class="fa fa-home"></em>
	            </a>
	        </li>
	        <li class="active">User</li>
	        <li>Pencarian Sepeda Motor</li>
	    </ol>
	</div>
@endsection

@section('content') 
	@if (!empty(session('msg')))
		<div class="alert alert-danger">
			{{ session('msg') }}
		</div>
	@endif

	<div class="modal fade" id="detailModal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div id="txtHint"></div>
                    <input type="hidden" name="modal_id" class="form-control" id="modal_id">
                </div>
                
                <div class="modal-footer">
                  <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
	
	<div class="panel panel-primary">
	  <div class="panel-heading">Data User</div>
	  <div class="panel-body">
  		<div class="form-group">
  			<div class="row">
	  			<div class="col-md-6">
	  				<label class="label-control" for='nmUser'>Nama User</label>
	  				<input type="text" class="form-control" name="nmUser" value="{{ $user->nmUser }}" readonly>
	  			</div>

  				<div class="col-md-6">
  					<label class="label-control" for='tgl'>Tanggal</label>
  					<input type="text" class="form-control" name="tgl" value="{{ date('d-m-Y',strtotime($user->tgl) ) }}" readonly>
	  			</div>
  			</div>
  		</div>

  		<div class="form-group">
  			<div class="row">
  				<div class="col-md-6">
  					<label class="label-control" for="pilUser">Kriteria Pilihan User</label>
  					<?php
  						$pil = explode('.', $user->pilUser);
  					?>
  					<table width="100%">
  						<tr>
	  						<td width="50%">Jenis Motor</td>
	  						<td>:</td>
	  						<td><?php echo $pil[0];?></td>
  						</tr>

  						<tr>
	  						<td>Kondisi Mesin</td>
	  						<td>:</td>
	  						<td><?php echo str_replace('\'', '', $pil[1]) ;?></td>
	  					</tr>

	  					<tr>
	  						<td>Kondisi Body</td>
	  						<td>:</td>
	  						<td><?php echo str_replace('\'', '', $pil[2]); ?></td>
  						</tr>
  						
  						<tr>
	  						<td>Lama Pemakaian (Bulan)</td>
	  						<td>:</td>
	  						<td><?php echo $pil[3];?></td>
	  					</tr>

	  					<tr>
	  						<td>Harga (Rp)</td>
	  						<td>:</td>
	  						<?php 
	  							// echo $pil[4];
	  							// $data 	= explode('-', $pil[4]);
	  						
	  							// $awal 	= number_format($data[0]);
	  							// $akhir 	= number_format($data[1]);
	  							// $hasil 	= $awal.' - '.$akhir;
	  							
	  							echo "<td>".number_format($pil[4])."</td>";
	  						?>
	  					</tr>
  					</table>
  				</div>
  			</div>  			
  		</div>
	  </div>
	</div>

	<div class="panel panel-primary">
		 <div class="panel-heading">Rekomendasi Sepeda Motor (Topsis)</div>
		 <div class="panel-body">
		 	<div class="form-group">
		 		<div class="row">
		 			<div class="col-md-6">
			 			<table width="100%">
			 				<tr>
			 					<td width="50%"><label class="label-control">Nama Motor</label></td>
			 					<td>:</td>
			 					<td>{{ $dataMotor->merkMotor }}</td>
			 				</tr>

{{-- 			 				<tr>
			 					<td><label class="label-control">No. Mesin</label></td>
			 					<td>:</td>
			 					<td>{{ $dataMotor->noMesin }}</td>
			 				</tr> --}}

			 				<tr>
			 					<td><label class="label-control">Jenis Motor</label></td>
			 					<td>:</td>
			 					<td>{{ $dataMotor->jnsMotor }}</td>
			 				</tr>
			 			</table>
			 			<hr>
			 			Spesifikasi / Kriteria Motor
			 			<table width="100%">
			 				<tr>
			 					<td width="50%"><label class="label-control">Kondisi Mesin </label></td>
			 					<td>:</td>
			 					<td>{{ $dataMotor->konMesin }}</td>				
			 				</tr>

			 				<tr>
			 					<td><label class="label-control">Kondisi Body </label></td>
			 					<td>:</td>
			 					<td>{{ $dataMotor->konBody }}</td>				
			 				</tr>

			 				<tr>
			 					<td><label class="label-control">Lama Pemakaian </label></td>
			 					<td>:</td>
			 					<?php 
			 						$tahun = intdiv($dataMotor->thnPakai, 12);
			 						$bulan = $dataMotor->thnPakai % 12;

			 						if ($tahun==0){
			 							$thnAsli = 0;
			 						}
			 						elseif ($bulan==0){
			 							$thnAsli = $tahun.' Tahun';
			 						}
			 						elseif ($tahun<>0 && $bulan<>0){
			 							$thnAsli = $tahun.' Tahun '.$bulan.' Bulan';
			 						};
			 					?>
			 					<td>{{ $dataMotor->thnPakai }} Bulan ( {{ $thnAsli  }} )</td>				
			 				</tr>

			 				<tr>
			 					<td><label class="label-control">Harga (Rp)</label></td>
			 					<td>:</td>
			 					<td>{{ number_format($dataMotor->harga) }}</td>				
			 				</tr>
			 			</table><hr>

			 			Detail Nilai Perhitungan Metode Topsis
			 			<table width="100%">
			 				<tr>
			 					<td width="50%"><label class="label-control">Kondisi Mesin </label></td>
			 					<td>:</td>
			 					<td>{{ number_format($dataMotor->bnMesin,4) }}</td>				
			 				</tr>

			 				<tr>
			 					<td><label class="label-control">Kondisi Body </label></td>
			 					<td>:</td>
			 					<td>{{ number_format($dataMotor->bnBody,4) }}</td>				
			 				</tr>

			 				<tr>
			 					<td><label class="label-control">Lama Pemakaian </label></td>
			 					<td>:</td>
			 					<td>{{ number_format($dataMotor->bnTahun,4) }}</td>				
			 				</tr>

			 				<tr>
			 					<td><label class="label-control">Harga (Rp)</label></td>
			 					<td>:</td>
			 					<td>{{ number_format($dataMotor->bnHarga,4) }}</td>				
			 				</tr>

			 				<tr>
			 					<td><label class="label-control">Nilai Topsis </label></td>
			 					<td>:</td>
			 					<!-- {{-- <td>{{ number_format($dataMotor->nilTopsis,5) }}</td>	 --}} -->
			 					<td>{{ number_format($dataMotor->hasilTopsis,5) }}</td>			
			 					<!-- <td>{{ number_format($dataMotor->nilTopsisUser,5) }}</td> -->
			 				</tr>
			 			</table>

			 			<img src="{{ asset('/storage/fotoMotor/'.$dataMotor->foto) }}" alt="Foto Tidak Ada" width="200" height="200">

		 			</div>
		 		</div>		 		
		 	</div>
		 </div>
	</div>

	<div class="panel panel-primary">
		 <div class="panel-heading">Rekomendasi Lain Urutan 10 Teratas</div>
		 <div class="panel-body">
		 	<div class="row">
		 		<div class="col-md-12">
		 			<table class="table table-striped table-hover">
				    	<th>No</th>
				    	<th>Kode Motor</th>
				    	<th>Jenis Motor</th>
				    	<th>Nama Motor</th>
				    	{{-- <th>No. Mesin</th> --}}
				    	<th>Nilai Topsis</th>
				    	<th>Action</th>

				    	@foreach($peringkat as $no => $list)
				    		<tr>
				    			<td>{{ ++$no }}</td>
				    			<td>{{ $list->kdMotor }}</td>
				    			<td>{{ $list->jnsMotor }}</td>
				    			<td>{{ $list->merkMotor }}</td>
				    			{{-- <td>{{ $list->noMesin }}</td> --}}
				    			{{-- <td>{{ number_format($list->nilTopsis,5) }}</td> --}}
				    			<td>{{ number_format($list->hasilTopsis,5) }}</td>

				    			<td>
                                    <button type="button" class="btn btn-info fa fa-info" 
                                        data-target="detailModal" data-id="{{ $list->penilaianId }}" 
                                        data-nama="{{ $list->penilaianId }}" data-original-title="Dispatch">
                                    </button>  
				    			</td>
				    		</tr>
				    	@endforeach
				    </table>
		 		</div>
		 	</div>
		 </div>
	</div>
@endsection

@section('footer')
  <script>
      $(document).ready(function () {
          $('.fa-info').click(function(event){
              $('#modal_id').val(event.target.dataset.id);
              
              var id = document.getElementById('modal_id').value;
              console.log(id);
              $.get("/pemilihan/"+id+"/detail", function(text) {
                  $("#txtHint").html(text);
              });
              
              $('#detailModal').modal('show');
          });
      });
  </script>
@endsection