<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\motor;
use App\model\nilai;
use DB;

class controllerMotor extends Controller
{
    public function listMotor(Request $req){
        $listMotor = Motor::getAllWithPage();

    	if ($req->has('q')){
    		$cari      = $req->q; 
    		$listMotor = motor::pencarian($cari);
    	}

    	return view('admin.motor.list',compact('listMotor'));
    }

    public function formMotor(){
    	$kode = motor::kode('MTR');
        return view('admin.motor.form',compact('kode'));
    }

    public function hapusMotor($id){
        $motor = motor::findOrFail($id);
        \File::delete(storage_path('/app/public/fotoMotor/'.$motor->foto));
        motor::hapusMotor($id);
    	return redirect('/admin/motor/list')->with('msg','Data Berhasil Dihapus');
    }

    public function simpanMotor(Request $req){
        $this->validate($req,[
            'jnsMotor'  => 'required',
            'merkMotor' => 'required',
            'thnMotor'  => 'required|numeric',
            'fotoMotor' => 'required',
            'krKonMesin'    => 'required',
            'krKonBody'     => 'required',
            'krLamaPakai'   => 'required|numeric',
            'krHarga'       => 'required|numeric'
            // 'noMesin'   => 'required'
        ]);

        // $dataSama = motor::cekNoMesin($req->noMesin);
        // if (empty($dataSama)){
            $file     = $req->file('fotoMotor');
            $namaFoto = $file->getClientOriginalName();
            $namaAsli = $req->kdMotor.$namaFoto;

            $file->storeAs('/public/fotoMotor',$namaAsli);
            motor::simpanData($req,$namaAsli);

            // simpan nilai
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
                    $tmp    = ((int)$kd->maks) + 1;
                    $kode   = sprintf("%05s",$tmp); 
                }
            }
            $kodeAsli = 'PNL-'.$kode;
            
            // simpan data
            $motor = motor::getMotorByKode($req->kdMotor);
            nilai::simpanPenilaian($req,$kodeAsli,$konHarga,$motor->id);
            $kode = nilai::cekData($motor->id);

            nilai::simpanPenilaianKon($kode->id,$konMesin,$konBody,$lamaPakai,$harga);
            motor::ubahStatus($motor->id);

            return redirect('/admin/motor/list')->with('msg','Data Berhasil Disimpan');
        // }
        // else{
        //     return back()->with('msg','Data Sudah Ada');
        // };
    }

    public function editForm($id){
        $dataMotor = motor::findOrFail($id);
        $dataNilai = nilai::getData($id);
    
        return view('admin.motor.edit',compact('dataMotor', 'dataNilai'));
    }

    private function foto($req,$id){
        $file     = $req->file('fotoMotor');
        $namaFile = $file->getClientOriginalName();
        $namaAsli = $req->kdMotor.$namaFile;

        $file->storeAs('/public/fotoMotor',$namaAsli);
        $motor = motor::findOrFail($id);
        \File::delete(storage_path('/app/public/fotoMotor/'.$motor->foto));
        motor::ubahFoto($id,$namaAsli);
    }

    public function simpanEdit(Request $req, $id){
        $this->validate($req,[
            'jnsMotor'  => 'required',
            'merkMotor' => 'required',
            'thnMotor'  => 'required|numeric',
            'krKonMesin'    => 'required',
            'krKonBody'     => 'required',
            'krLamaPakai'   => 'required|numeric',
            'krHarga'       => 'required|numeric'
            // 'noMesin'   => 'required'    
        ]); 

        // if(($req->jnsMotor==$req->jnsMotorLama) and ($req->merkMotor==$req->merkMotorLama) and ($req->thnMotor==$req->thnMotorLama) and ($req->fotoMotor==NULL)){
        //     return redirect('/admin/motor/list');
        // };

        // if ($req->noMesin==$req->noMesinLama){
        //     motor::ubahData($req, $id);
        //     if (!empty($req->file('fotoMotor'))){
        //         $this->foto($req,$id);
        //     }
        //     return redirect('/admin/motor/list')->with('msg','Data Berhasil Disimpan');
        // }
        // else {
            // $dataSama = motor::cekNoMesin($req->noMesin);
            // if(!empty($dataSama)) {
            //     return back()->with('msg','Data Sudah Ada');
            // }
            // else {
                motor::ubahData($req, $id);
                if (!empty($req->file('fotoMotor'))){
                    $this->foto($req,$id);
                }

                nilai::hapusNilaiByIdMotor($id);

                // simpan nilai
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
                        $tmp    = ((int)$kd->maks) + 1;
                        $kode   = sprintf("%05s",$tmp); 
                    }
                }
                $kodeAsli = 'PNL-'.$kode;
                
                // simpan data
                $motor = motor::getMotorByKode($req->kdMotor);
                nilai::simpanPenilaian($req,$kodeAsli,$konHarga,$motor->id);
                $kode = nilai::cekData($motor->id);

                nilai::simpanPenilaianKon($kode->id,$konMesin,$konBody,$lamaPakai,$harga);

                return redirect('/admin/motor/list')->with('msg','Data Berhasil Disimpan');
            // }
        // }

        // if(($req->jnsMotor==$req->jnsMotorLama) and ($req->merkMotor==$req->merkMotorLama) and ($req->thnMotor==$req->thnMotorLama) and ($req->fotoMotor==NULL)){
        //     return redirect('/admin/motor/list');
        // };

        // if ($req->fotoMotor<>NULL){
        //     $this->foto($req,$id);
        // }
    }
}