@extends('layout')

@section('header')
	<div class="row">
	    <ol class="breadcrumb">
	        <li><a href="#">
	                <em class="fa fa-home"></em>
	            </a>
	        </li>
	        <li class="active">Home</li>
	    </ol>
	</div>
@endsection

@section('content') 
  @if (!empty(session('msg')))
	<div class="alert alert-danger">
		{{ session('msg') }}
	</div>
  @endif

  <p><h2> Selamat Datang {{ Session('auth')->nama }} </h2></p>
  <p><h2>Anda Login Sebagai Admin</h2></p>
  <img src="{{ asset('foto/1.jpg') }}" alt="slideshow-mudah" width="1100px" height="400px">
@endsection