<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use DB;

class kriteria extends Model
{
	protected $table = 'tblkriteria';

    public static function listData(){
    	return DB::table('tblkriteria')->get();
    }

    public static function pencarian($cari){
    	return DB::table('tblkriteria')
    			-> where('kdKriteria','like','%'.$cari.'%')
    			-> orwhere('nmKriteria','like','%'.$cari.'%')
    			-> get();
    }

    public static function ubahData($req,$id){
    	return DB::table('tblkriteria')
    			->where('id','=',$id)
    			->update([
    				'nmKriteria'	=> $req->nmKriteria,
    				'ket'			=> $req->ket,
    				'bobot'			=> $req->bobot
    			]);	
    } 

    public static function dataSama($nmKriteria,$ket,$bobot){
    	return DB::table('tblkriteria')
    			->where('nmKriteria','=',$nmKriteria)
    			->where('ket','=',$ket)
    			->where('bobot','=',$bobot)
    			->first();
    }

    public static function cekData($field,$isian){
    	return DB::table('tblkriteria')
    			->where($field,'=',$isian)
    			->first();
    }

    public static function jmlBobot(){
    	return DB::select("SELECT SUM(bobot) as jmlBobot from tblkriteria");
    }

}
