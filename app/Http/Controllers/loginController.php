<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class loginController extends Controller
{
    public function loginForm(){
    	return view('login');
    }

    public function cekLogin(Request $req){
    	if (empty($req->pengguna) OR empty($req->sandi)){
    		return back()->with('msg','Pengguna dan Kata Sandi Belum Diisi');
    	};

    	$data = DB::table('tbllogin')
    			->where('pengguna','=',$req->pengguna)
    			->where('sandi','=',md5($req->sandi))
    			->first();

    	if (!empty($data)){
    		$session = $req->session();
    		$session->put('auth', $data);
    		
    		return view('/admin/home');
    	}
    	else{
    		return back()->with('msg','Pengguna dan Kata Sandi Salah');
    	}
    }

    public function home(){
    	return view('admin.home');
    }

    public function logout(request $req){
    	$req->session()->forget('auth');
      	return redirect('/');
    }

    public function formSandi($id){
        $data = session('auth');
        return view('admin.sandi.form',compact('data'));
    }

    public function simpanSandi(Request $req, $id){
        $this->validate($req,[
            'nmLengkap'     => 'required',
            'pengguna'      => 'required',
            'sandiLama'     => 'required',
            'sandiBaru'     => 'required'
        ]);

        $cekSandi = DB::table('tbllogin')->where('sandi','=',md5($req->sandiLama))->first();
        
        if (!empty($cekSandi)){
            DB::table('tbllogin')->where('id','=',$id)->update([
                'nama'      => $req->nmLengkap,
                'pengguna'  => $req->pengguna,
                'sandi'     => md5($req->sandiBaru)
            ]);

            return redirect('/admin/home')->with('msg','Data Berhasil Diubah');
        }
        else{
            return back()->with('msg','Kata Sandi Lama Salah');
        };
    }
}
