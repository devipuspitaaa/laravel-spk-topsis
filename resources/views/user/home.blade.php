@extends('user.layoutUser')

@section('header')
	<div class="row">
	    <ol class="breadcrumb">
	        <li><a href="#">
	                <em class="fa fa-home"></em>
	            </a>
	        </li>
	        <li class="active">User</li>
	        <li>Home</li>
	    </ol>
	</div>
@endsection

@section('content')
	  @if(!empty(session('msg')))
	        <div class="alert alert-success">
	            {{ session('msg') }}
	        </div>
	  @endif

	  <p><h2> Selamat Datang </h2></p>
	  <p><h2> SPK Pemilihan Sepeda Motor Menggunakan Metode TOPSIS</h2></p>

	<!-- Content START -->
	{{-- <div class="col-md-8 col-md-offset-2"> --}}
	  	<div id="slideshow-mudah" class="carousel slide" data-ride="carousel">
	  	<!-- Indicators, Ini adalah Tombol BULET BULET dibawah. item ini dapat dihapus jika tidak diperlukan -->
		  <ol class="carousel-indicators">
			    <li data-target="#slideshow-mudah" data-slide-to="0" class="active"></li>
			    <li data-target="#slideshow-mudah" data-slide-to="1"></li>
			    <li data-target="#slideshow-mudah" data-slide-to="2"></li>
		  </ol>
	 
		  <!-- Wrapper for slides, Ini adalah Tempat Gambar-->
		  <div class="carousel-inner">
			    <div class="item active">
			     	 <center>
			     	 	<img src="{{ asset('foto/1.jpg') }}" alt="slideshow-mudah" width="460" height="345">
			     	 </center> 
			    </div>
			    <div class="item">
			    	<center>
			     	 	<img class="" src="{{ asset('foto/2.png') }}" alt="slideshow-mudah" width="460" height="345"> 
			    	</center>
			    </div>
			    <div class="item">
			    	<center>
			      		<img src="{{ asset('foto/3.jpg') }}" alt="slideshow-mudah" width="460" height="345"> 
			    	</center>
			    </div>
		  </div>

		  <!-- Controls, Ini adalah Panah Kanan dan Kiri. item ini dapat dihapus jika tidak diperlukan-->
		  <a class="left carousel-control" href="#slideshow-mudah" data-slide="prev">
		    	<span class="glyphicon glyphicon-chevron-left"></span>
		  </a>

		  <a class="right carousel-control" href="#slideshow-mudah" data-slide="next">
		    	<span class="glyphicon glyphicon-chevron-right"></span>
		  </a>

		</div>
		<!-- Content END -->
@endsection