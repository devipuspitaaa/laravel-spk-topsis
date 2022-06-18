<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\nilai;
use App\model\motor;
use DB;

class nilaiController extends Controller
{
    public function listNilai(Request $req){
        $jmlBobot  = DB::select("SELECT SUM(bobot) as jmlBobot from tblkriteria");
        if ($jmlBobot[0]->jmlBobot < 100){
            return redirect('admin/kriteria/list')->with('msg','Jumlah Bobot Tidak Boleh Kurang Dari 100 %');
        };

    	$listNilai = motor::orderByStatus();

    	if ($req->has('q')){
    		$cari 		= $req->input('q');
    		$listNilai 	= motor::pencarianNilai($cari);
    	};

    	return view('admin.penilaian.list',compact('listNilai'));
    }

    public function form(Request $req,$id){
    	$dataMotor = motor::findOrFail($id);
    	return view('admin.penilaian.form', compact('dataMotor'));
    }

    public function simpanForm(Request $req,$id){
    	$this->validate($req,[
    		'krKonMesin'	=> 'required',
    		'krKonBody'		=> 'required',
    		'krLamaPakai'	=> 'required|numeric',
    		'krHarga'		=> 'required|numeric'
    	]);

    	// kon kriteria kondisu mesin
		if ($req->krKonMesin=='Sangat Baik'){
    		$konMesin = 90;
    	}
    	elseif ($req->krKonMesin=='Baik'){
    		$konMesin = 80;
    	}
    	elseif ($req->krKonMesin=='Cukup Baik'){
    		$konMesin = 70;
    	};

    	// kon kriteria kondisi Body
    	if ($req->krKonBody=='Sangat Baik'){
    		$konBody = 90;
    	}
    	elseif ($req->krKonBody=='Baik'){
    		$konBody = 80;
    	}
    	elseif ($req->krKonBody=='Cukup Baik'){
    		$konBody = 70;
    	};

    	// kon kriteria Lama Pakai
    	if ($req->krLamaPakai <  12) {
    		$lamaPakai = 90;
    	}
    	elseif($req->krLamaPakai>=12 and $req->krLamaPakai<24){
    		$lamaPakai = 85;
    	}
    	elseif($req->krLamaPakai>=24 and $req->krLamaPakai<36){
    		$lamaPakai = 80;
    	}
    	elseif($req->krLamaPakai>=36 and $req->krLamaPakai<48){
    		$lamaPakai = 75;
    	}
    	elseif($req->krLamaPakai>=48 and $req->krLamaPakai<60){
    		$lamaPakai = 70;
    	}
    	elseif($req->krLamaPakai >= 60){
    		$lamaPakai = 65;
    	};

    	// Harga
    	$konHarga = str_replace('.', '', $req->krHarga);
    	if($konHarga < 14000000){
    		$harga = 90;
    	}
    	elseif ($konHarga >=14000000 and $konHarga < 18000000){
    		$harga = 85;
    	}
    	elseif ($konHarga >=18000000 and $konHarga < 22000000){
    		$harga = 80;
    	}
    	elseif ($konHarga >=22000000 and $konHarga < 26000000){
    		$harga = 75;
    	}
    	elseif ($konHarga >= 26000000){
    		$harga = 70;
    	};

    	// kode
    	$data = DB::select("Select max(right(kdPenilaian,5)) as maks from tblpenilaian");
		if (empty($data)){
			$kode = '00001';
		}
		else {
			foreach ($data as $kd){
				$tmp 	= ((int)$kd->maks) + 1;
				$kode 	= sprintf("%05s",$tmp); 
			}
		}
		$kodeAsli = 'PNL-'.$kode;
		
    	// simpan data
    	nilai::simpanPenilaian($req,$kodeAsli,$konHarga,$id);
    	$kode = nilai::cekData($id);

    	nilai::simpanPenilaianKon($kode->id,$konMesin,$konBody,$lamaPakai,$harga);
    	motor::ubahStatus($id);
    	return redirect('/admin/penilaian/list')->with('msg','Data Berhasil Disimpan');
    }

    public function formEdit(Request $req, $id){
		$dataMotor 		= motor::findOrFail($id);
		$penilaianMotor = nilai::getData($id);
    	return view('admin.penilaian.edit', compact('dataMotor','penilaianMotor'));
    }

    public function simpanFormEdit(Request $req,$id){
    	$this->validate($req,[
    		'krKonMesin'	=> 'required',
    		'krKonBody'		=> 'required',
    		'krLamaPakai'	=> 'required|numeric',
    		'krHarga'		=> 'required|numeric'
    	]);

    	if ($req->krKonMesin == $req->krKonMesinLama and $req->krKonBody == $req->krKonBodyLama and $req->krLamaPakai == $req->krLamaPakaiLama and $req->krHarga == $req->krHargaLama){
    		return redirect('/admin/penilaian/list');
    	}
    	else{
	    	// kon kriteria kondisu mesin
			if ($req->krKonMesin=='Sangat Baik'){
	    		$konMesin = 90;
	    	}
	    	elseif ($req->krKonMesin=='Baik'){
	    		$konMesin = 80;
	    	}
	    	elseif ($req->krKonMesin=='Cukup'){
	    		$konMesin = 70;
	    	};

	    	// kon kriteria kondisi Body
	    	if ($req->krKonBody=='Sangat Baik'){
	    		$konBody = 90;
	    	}
	    	elseif ($req->krKonBody=='Baik'){
	    		$konBody = 80;
	    	}
	    	elseif ($req->krKonBody=='Cukup'){
	    		$konBody = 70;
	    	};

	    	// kon kriteria Lama Pakai
            if ($req->krLamaPakai <  12) {
	    		$lamaPakai = 90;
	    	}
	    	elseif($req->krLamaPakai>=12 and $req->krLamaPakai<24){
	    		$lamaPakai = 85;
	    	}
	    	elseif($req->krLamaPakai>=24 and $req->krLamaPakai<36){
	    		$lamaPakai = 80;
	    	}
	    	elseif($req->krLamaPakai>=36 and $req->krLamaPakai<48){
	    		$lamaPakai = 75;
	    	}
	    	elseif($req->krLamaPakai>=48 and $req->krLamaPakai<60){
	    		$lamaPakai = 70;
	    	}
	    	elseif($req->krLamaPakai >= 60){
	    		$lamaPakai = 65;
	    	};

	    	// Harga
	    	$konHarga = str_replace('.', '', $req->krHarga);
	    	if($konHarga < 14000000){
	    		$harga = 90;
	    	}
	    	elseif ($konHarga >=14000000 and $konHarga < 18000000){
	    		$harga = 85;
	    	}
	    	elseif ($konHarga >=18000000 and $konHarga < 22000000){
	    		$harga = 80;
	    	}
	    	elseif ($konHarga >=22000000 and $konHarga < 26000000){
	    		$harga = 75;
	    	}
	    	elseif ($konHarga >= 26000000){
	    		$harga = 70;
	    	};
			
	    	// ubah data
	        nilai::ubahPenilaian($req,$id,$konHarga);
	    	$kode = nilai::cekData($id);
	    	
	    	nilai::ubahPenilaianKon($kode->id,$konMesin,$konBody,$lamaPakai,$harga);
	    	return redirect('/admin/penilaian/list')->with('msg','Data Berhasil Disimpan');
    	}
    }
}
