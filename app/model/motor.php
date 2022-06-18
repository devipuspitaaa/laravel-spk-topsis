<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use DB;

class motor extends Model
{
 protected $table = 'tblMotor';

    public static function getAllWithPage(){
    	return DB::table('tblMotor')->paginate(10);
    }

    public static function pencarian($cari){
    	return DB::table('tblMotor')
    			->where('kdMotor','like','%'.$cari.'%')
    			->orwhere('merkMotor','like','%'.$cari.'%')
    			->paginate(10);
    }

    public static function getAll(){
        return DB::table('tblmotor')->get();
    }

    public static function getByJenis($jenis){
        return DB::table('tblmotor')
                ->where('jnsMotor','=',$jenis)
                ->get();
    }

    public static function kosong(){
        return DB::table('tblmotor')
                ->where('jnsMotor','=','kososng')
                ->get();
    }

    public static function hapusMotor($id){
    	DB::table('tblMotor')->where('id','=',$id)->delete();
    }

    public static function kode($kodeMotor){
        $data = DB::select('select max(right(kdMotor,4)) as kdMax from tblmotor');
        if (empty($data)){
            $kode = '0001';
        }
        else {
            foreach($data as $kd){
                $tmp  = ((int)$kd->kdMax) + 1;
                $kode = sprintf("%04s",$tmp); 
            }
        }
        $kodeAsli = $kodeMotor.'-'.$kode;
        return $kodeAsli;
    }

    public static function dataSama($jnsMotor, $merkMotor, $thnMotor){
        return DB::table('tblMotor')
                ->where('jnsMotor','=',$jnsMotor)
                ->where('merkMotor','=',$merkMotor)
                ->where('thnMotor','=',$thnMotor)
                ->first();
    }

    public static function ubahData($req, $id){
        return DB::table('tblMotor')
                ->where('id','=',$id)
                ->update([
                    'jnsMotor'  => $req->jnsMotor,
                    'merkMotor' => $req->merkMotor,
                    'thnMotor'  => $req->thnMotor
                    // 'noMesin'   => $req->noMesin
                ]);
    }

    public static function simpanData($req, $foto){
        return DB::table('tblMotor')->insert([
                'kdMotor'   => $req->kdMotor,
                'jnsMotor'  => $req->jnsMotor,
                'MerkMotor' => $req->merkMotor,
                'thnMotor'  => $req->thnMotor,
                // 'noMesin'   => $req->noMesin,
                'foto'      => $foto,
                'status'    => '1'
            ]);
    }

    public static function ubahFoto($id, $foto){
        return DB::table('tblMotor')->where('id','=',$id)->update(['foto' => $foto]);
    }

    public static function cekNoMesin($noMesin){
    	return DB::table('tblMotor')->where('noMesin','=',$noMesin)->first();
    }

    public static function orderByStatus(){
        return DB::table('tblmotor')->orderBy('status','asc')->paginate(10);
    }

    public static function pencarianNilai($cari){
       return DB::table('tblMotor')
            ->where('merkMotor','like','%'.$cari.'%')
            ->orwhere('jnsMotor','like','%'.$cari.'%')
            ->paginate(10);
    }

    public static function ubahStatus($id){
        return DB::table('tblmotor')->where('id','=',$id)->update(['status' => '2']);
    }

    public static function getMotorByKode($kodeMotor)
    {
        return DB::table('tblmotor')->where('kdMotor',$kodeMotor)->first();
    }
}
