<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\kriteria;

class kriteriaController extends Controller
{
    public function listKriteria(Request $req){
    	$listKriteria = kriteria::listData();

    	if ($req->has('q')){
    		$cari = $req->input('q');
    		$listKriteria = kriteria::pencarian($cari);
    	}

    	return view('admin.kriteria.list',compact('listKriteria'));
    }

    public function form($id){
    	$data = kriteria::findOrFail($id);
    	return view('admin.kriteria.form',compact('data'));
    }

    public function simpanForm(Request $req,$id){
    	$this->validate($req,[
    		'nmKriteria'	=> 'required',
    		'ket'			=> 'required',
    		'bobot'			=> 'required|numeric'
    	]);

    	$dataSama = kriteria::dataSama($req->nmKriteria,$req->ket,$req->bobot);
    	if (!empty($dataSama)){
    		return redirect('/admin/kriteria/list');
    	}

    	if ((int)$req->bobot > 100){
    		return back()->with('msg','bobot tidak boleh Lebih dari 100');
    	};

    	$jmlBobot = kriteria::jmlBobot();
    	$jumlah   =	(int)$jmlBobot[0]->jmlBobot - $req->bobotLama;
    	$total    = $jumlah + $req->bobot;
    	if ($total > 100 ){
    		return back()->with('msg','Total Bobot Tidak Boleh Lebih Dari 100 %');
    	};

    	if ($req->nmKriteria <> $req->nmKriteriaLama){
    		$cekKriteria = kriteria::cekData('nmKriteria',$req->nmKriteria);
    		if (!empty($cekKriteria)){
    			return back()->with('msg','Kriteria Sudah Ada');
    		};
    	};

    	if ($req->bobot <> $req->bobotLama){
    		$cekBobot = kriteria::cekData('bobot',$req->bobot);
    		if (!empty($cekBobot)){
    			return back()->with('msg','Bobot Tidak Boleh Sama');
    		};
    	};

    	// simpan;
    	kriteria::ubahData($req,$id);
    	return redirect('/admin/kriteria/list')->with('msg','Data Sudah Disimpan');
    }
}
