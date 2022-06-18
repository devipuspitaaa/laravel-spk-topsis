<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use DB;

class nilai extends Model
{
	public static function simpanPenilaian($req,$kode,$harga,$id){
		return DB::table('tblpenilaian')->insert([
			'kdPenilaian'	=> $kode,
			'motorId'		=> $id,
			'konMesin'		=> $req->krKonMesin,
			'konBody'		=> $req->krKonBody,
			'thnPakai'		=> $req->krLamaPakai,
			'harga'			=> $harga
		]);
	}

	public static function simpanPenilaianKon($kode,$konMesin,$konBody,$lamaPakai,$harga){
		return DB::table('tblnilaikon')->insert([
			'penilaianId' 	=> $kode,
			'konMesinKon'	=> $konMesin,
			'konBodyKon'	=> $konBody,
			'thnPakaiKon'	=> $lamaPakai,
			'hargaKon'		=> $harga
		]);
	}

	public static function cekData($id){
		return DB::table('tblpenilaian')->where('motorId','=',$id)->first();
	}

	public static function getData($id){
		return DB::table('tblpenilaian')
				->where('motorId','=',$id)
				->first();
	}

	public static function ubahPenilaian($req,$id,$harga){
		return DB::table('tblpenilaian')->where('motorId','=',$id)->update([
			'konMesin'		=> $req->krKonMesin,
			'konBody'		=> $req->krKonBody,
			'thnPakai'		=> $req->krLamaPakai,
			'harga'			=> $harga
		]);
	}

	public static function ubahPenilaianKon($kode,$konMesin,$konBody,$lamaPakai,$harga){
		return DB::table('tblnilaikon')->where('penilaianId','=',$kode)->update([
			'konMesinKon'	=> $konMesin,
			'konBodyKon'	=> $konBody,
			'thnPakaiKon'	=> $lamaPakai,
			'hargaKon'		=> $harga
		]);
	}

	public static function listMotor(){
		return DB::table('tblpenilaian')
    			->leftJoin('tblnilaikon','tblpenilaian.id','=','tblnilaikon.penilaianId')
    			->get();
	}

	public static function hapusBantu(){
		return DB::select("TRUNCATE Table tblbantu");
	}

	public static function simpanBantu($penilaianId, $bnMesin, $bnBody, $bnTahun, $bnHarga, $status){
		return DB::table('tblbantu')->insert([
	    			'penilaianId'	=> $penilaianId,
	    			'bnMesin'		=> $bnMesin,
	    			'bnBody'		=> $bnBody,
	    			'bnTahun'		=> $bnTahun,
	    			'bnHarga'		=> $bnHarga,
	    			'status'		=> $status
    			]);
	}

	public static function getByStatus($status){
		return DB::table('tblbantu')
    			->leftJoin('tblpenilaian','tblbantu.penilaianId','=','tblpenilaian.id')
    			->where('status','=',$status)
    			->get();
	}

	public static function getMax(){
		return DB::select("Select MAX(bnMesin) as maxBnMesin, MAX(bnBody) as maxBnBody, MAX(bnTahun) as maxBnTahun, MAX(bnHarga) as maxBnHarga from tblbantu where status=2");
	}

	public static function getMin(){
		return DB::select("Select MIN(bnMesin) as minBnMesin, MIN(bnBody) as minBnBody, MIN(bnTahun) as minBnTahun, MIN(bnHarga) as minBnHarga from tblbantu where status=2");
	}

	public static function listBantu(){
		return DB::table('tblbantu')
    			->leftJoin('tblpenilaian','tblbantu.penilaianId','=','tblpenilaian.id')
    			->where('status','=',2)
    			->get();  
	}

	public static function updatePosNeg($penilaianId,$nilPositif,$nilNegatif){
		return DB::table('tblbantu')
				->where('penilaianId','=',$penilaianId)
				->where('status','=',2)
				->update([
					'positif'	=> $nilPositif,
					'negatif'	=> $nilNegatif
				]);
	}

	public static function updateNilTop($penilaianId,$nilTopsis){
		return 	DB::table('tblpenilaian')->where('id','=',$penilaianId)->update([
    				'nilTopsis'		=> $nilTopsis
					// 'nilTopsisUser'		=> $nilTopsis
    			]);
	}

	public static function updateNilTopUser($penilaianId,$nilTopsis){
		return 	DB::table('tblpenilaian')->where('id','=',$penilaianId)->update([
    				// 'nilTopsis'		=> $nilTopsis
					'nilTopsisUser'		=> $nilTopsis
    			]);
	}

	public static function updateNilTopBantu($penilaianId,$nilTopsis){
		return DB::table('tblbantu')
				->where('penilaianId','=',$penilaianId)
				->where('status','=',2)
				->update([
					'topsis'	=> $nilTopsis
				]);
	}

	public static function nilTinggi(){
		return DB::table('tblbantu')
				->where('status','=',2)
				->orderBy('topsis','DESC')
				->first();
	}

	public static function simpanUser($req,$pilUser,$penilaianId){
		return DB::table('tblpiluser')->insert([
			'nmUser'		=> $req->nmUser,
			'tgl'			=> DB::raw('now()'),
			'pilUser'		=> $pilUser,
			'penilaianId'	=> $penilaianId
		]);
	}

	public static function getUserAkhir(){
		return DB::table('tblpiluser')->orderBy('id','Desc')->first();
	}

	public static function listPeringkat(){
		return DB::table('tblpenilaian')
    			->leftJoin('tblbantu','tblpenilaian.id','=','tblbantu.penilaianId')
    			->leftJoin('tblmotor','tblpenilaian.motorId','=','tblmotor.id')
    			->where('tblbantu.status','=',2)
    			->where('tblpenilaian.hasilTopsis','<>',0)
    			// ->orderBy('tblpenilaian.nilTopsis','DESC')
    			// ->orderBy('tblpenilaian.hasilTopsis','DESC')
    			->orderBy('tblpenilaian.hasilTopsis','ASC')
    			->offset(1)
    			->take(10)
    			->get();
	}

	public static function getAll($status,$jenis){
		if ($jenis=='semua'){
			return DB::table('tblmotor')
				->leftJoin('tblpenilaian','tblmotor.id','=','tblpenilaian.motorId')
				->where('status','=',$status)
				->get();	
		}
		else{
			return DB::table('tblmotor')
					->leftJoin('tblpenilaian','tblmotor.id','=','tblpenilaian.motorId')
					->where('status','=',$status)
					->where('jnsMotor','=',$jenis)
					->get();
		}
	}

	public static function laporanUser($bulan, $tahun){
		return DB::table('tblpiluser')
				->leftJoin('tblpenilaian','tblpiluser.penilaianId','=','tblpenilaian.id')
				->leftJoin('tblmotor','tblpenilaian.motorId','=','tblmotor.id')
				->whereMonth('tgl','=',$bulan)
				->whereYear('tgl','=',$tahun)
				->get();
	}

	public static function laporanUserByBulan($bulan){
		return DB::table('tblpiluser')
				->leftJoin('tblpenilaian','tblpiluser.penilaianId','=','tblpenilaian.id')
				->leftJoin('tblmotor','tblpenilaian.motorId','=','tblmotor.id')
				->whereMonth('tgl','=',$bulan)
				->get();
	}

	public static function laporanUserByTahun($tahun){
		return DB::table('tblpiluser')
				->leftJoin('tblpenilaian','tblpiluser.penilaianId','=','tblpenilaian.id')
				->leftJoin('tblmotor','tblpenilaian.motorId','=','tblmotor.id')
				->whereYear('tgl','=',$tahun)
				->get();
	}

	public static function listTopsis(){
		return DB::table('tblbantu')
    			->leftJoin('tblpenilaian','tblbantu.penilaianId','=','tblpenilaian.id')
    			->leftJoin('tblmotor','tblpenilaian.motorId','=','tblmotor.id')
    			->where('tblbantu.status','=',2)
    			->where('tblpenilaian.nilTopsis','<>',0)
    			->orderBy('tblpenilaian.nilTopsis','DESC')
    			->get();
	}

	public static function ubahNilTopsiUserKosong()
	{
		return DB::table('tblpenilaian')->update([
			'nilTopsis'		=> 0,
			// 'nilTopsisUser'	=> 0,
			'hasilTopsis'	=> 0
		]);
	}

	public static function ubahNilTopsiUserKosongUser()
	{
		return DB::table('tblpenilaian')->update([
			// 'nilTopsis'		=> 0,
			'nilTopsisUser'	=> 0,
			'hasilTopsis'	=> 0
		]);
	}

	public static function updateHasilTopsis($penilaianId,$nilTopsis){
		return 	DB::table('tblpenilaian')->where('kdPenilaian','=',$penilaianId)->update([
    				'hasilTopsis'		=> $nilTopsis
					// 'nilTopsisUser'		=> $nilTopsis
    			]);
	}

	public static function hapusNilaiByIdMotor($idMotor)
	{
		return DB::table('tblpenilaian')->where('motorId',$idMotor)->delete();
	}
}