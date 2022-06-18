<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\nilai;
use DB;

class userController extends Controller
{
    public function tampilAwal(){
    	return view('user.home');
    }

    public function pemilihan(){
  		return view('user.pemilihan');
    }

    public function detail($id){
    	 $dataMotor  = DB::table('tblpenilaian')
                            ->leftJoin('tblmotor','tblpenilaian.motorId','=','tblmotor.id')
                            ->leftJoin('tblbantu','tblpenilaian.id','=','tblbantu.penilaianId')
                            ->where('tblpenilaian.id','=',$id)
                            ->where('tblbantu.status','=','2')
                            ->first();
                            
		return view('user.detail',compact('dataMotor'));    	 
    }

    public function kontak(Request $req)
    {
        if($req->nama<>'' || $req->email<>'' || $req->subject<>''){
            DB::table('tblsaran')->insert([
                'nama'      => $req->nama,
                'email'     => $req->email,
                'subject'   => $req->subject
            ]);
            return redirect('/')->with('msg','Berhasil Dikirim');
        }
        return redirect('/');
    }
}
