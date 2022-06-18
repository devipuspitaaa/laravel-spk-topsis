<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\kriteria;
use App\model\nilai;
use DB;

class topsisController extends Controller
{
    public function topsis(Request $req){
        $this->validate($req,[
            'nmUser'        => 'required',
            'jnsMotor'      => 'required',
            'tahunAwal'     => 'required|numeric',
            'tahunAkhir'    => 'numeric',
            'hargaAwal'     => 'required|numeric',
        ]);

        // filter pencarian dari user
        if ($req->tahunAwal < 1 ){
            return back()->with('msg','Lama Pemakaian Tidak Boleh Kurang dari 1 Bulan ');
        };

        if ($req->tahunAkhir < 1){
            $tahunAwal = 0;
        };

        if ($req->hargaAkhir < 1){
            $hargaAkhir = 0;
        };

        // ubah jangkauan range bulan dan harga
        $hrgAkhir = $req->hargaAwal + 10000000;
        $hrgAwal  = $req->hargaAwal - 10000000;
        if ($hrgAwal < 1000000){
            $hrgAwal = 1000000;
        };

        $kondisiHarga = 'p.harga between '.$hrgAwal.' and '.$hrgAkhir;
        
        $thnAkhir = $req->tahunAwal + 5;
        $thnAwal  = $req->tahunAwal - 5;
        if ($thnAwal<1){
            $thnAwal = 1;
        };

        $kondisiTahun = 'p.thnPakai between '.$thnAwal.' and '.$thnAkhir;

        // cek kondisi mesin dan body
        if (count($req->krKonMesin)==0){
            $konMesin = '';
        }
        else{
            $konMesin = '';
            foreach ($req->krKonMesin as $mesin){
                $konMesin .= "'$mesin'".',';
            };
            $konMesin = substr($konMesin, 0, -1);
        };
        
        if (count($req->krKonBody)==0){
            $konBody = '';
        }
        else{
            $konBody = '';
            foreach ($req->krKonBody as $body){
                $konBody .= "'$body'".',';
            };
        
            $konBody = substr($konBody, 0, -1);    
        }

        $sql = "SELECT * FROM tblpenilaian p left join tblnilaikon n on n.penilaianId = p.id left join tblmotor m on p.motorId = m.id where m.jnsMotor = '".$req->jnsMotor."' and p.konMesin in (".$konMesin.") and p.konBody in (".$konBody.") and ".$kondisiTahun." and ".$kondisiHarga;

        $dataMotor = DB::select($sql);

        if (count($dataMotor)<2){
            return back()->with('msg','Motor Dengan Spesifikasi Penilaian Tidak Ada');
        };

        if (!empty($dataMotor)){
            // set 0 topsisUserdan hasilTopsis jadi 0
            nilai::ubahNilTopsiUserKosongUser();

            // bobot
            $dataKriteria = kriteria::listData(); 
            foreach($dataKriteria as $kriteria){
                $bobot[] = $kriteria->bobot / 100; 
            };
        
            // mendapatkan nilai pembagi 
            $pembagikonMesin    = 0;
            $pembagikonbody     = 0;
            $pembagithnPakai    = 0;
            $pembagiharga       = 0;

            foreach($dataMotor as $motor){
                $pembagikonMesin += pow($motor->konMesinKon,2);
                $pembagikonbody  += pow($motor->konBodyKon,2);
                $pembagithnPakai += pow($motor->thnPakaiKon,2);
                $pembagiharga    += pow($motor->hargaKon,2);
            };

            $bagiKonMesin = sqrt($pembagikonMesin); $bagiKonBody = sqrt($pembagikonbody);
            $bagiThnPakai = sqrt($pembagithnPakai); $bagiHarga   = sqrt($pembagiharga);

            // membagi setiap nilai dengan pembagi
            nilai::hapusBantu();
            foreach ($dataMotor as $motor){
                $krMesin    = $motor->konMesinKon / $bagiKonMesin;
                $krBody     = $motor->konBodyKon / $bagiKonBody;
                $krThnPakai = $motor->thnPakaiKon / $bagiThnPakai;
                $krHarga    = $motor->hargaKon / $bagiHarga;

                nilai::simpanBantu($motor->penilaianId, $krMesin, $krBody, $krThnPakai, $krHarga, '1');
            };

            // mencari nilai terbobot
            $dataBantu = nilai::getByStatus('1');

            foreach($dataBantu as $bantu){
                $mesinBobot = $bantu->bnMesin * $bobot[0];
                $bodyBobot  = $bantu->bnBody * $bobot[1];
                $tahunBobot = $bantu->bnTahun * $bobot[3];
                $hargaBobot = $bantu->bnHarga * $bobot[2];

                nilai::simpanBantu($bantu->penilaianId, $mesinBobot, $bodyBobot, $tahunBobot, $hargaBobot, '2');
            };

            $max = nilai::getMax();
            $min = nilai::getMin();
            
            $dataBantu = nilai::listBantu();    

            foreach($dataBantu as $bantu){
                $nilPositif = sqrt(pow($max[0]->maxBnMesin - $bantu->bnMesin,2) + 
                                   pow($max[0]->maxBnBody - $bantu->bnBody,2) +
                                   pow($max[0]->maxBnTahun - $bantu->bnTahun,2) +
                                   pow($max[0]->maxBnHarga - $bantu->bnHarga,2));

                $nilNegatif = sqrt(pow($min[0]->minBnMesin - $bantu->bnMesin,2) + 
                                   pow($min[0]->minBnBody - $bantu->bnBody,2) +
                                   pow($min[0]->minBnTahun - $bantu->bnTahun,2) +
                                   pow($min[0]->minBnHarga - $bantu->bnHarga,2));
        
                nilai::updatePosNeg($bantu->penilaianId, $nilPositif, $nilNegatif);
            };

            $dataBantu = nilai::listBantu(); 
            foreach($dataBantu as $bantu){
                if ($bantu->negatif==0){
                    $hasil = $bantu->negatif / (1 - $bantu->positif);
                }
                else{
                     $hasil = $bantu->negatif / ($bantu->negatif + $bantu->positif);
                };

                nilai::updateNilTopUser($bantu->penilaianId,$hasil);
                nilai::updateNilTopBantu($bantu->penilaianId,$hasil);
            };    

            $nilTinggi = nilai::nilTinggi();
            if ($req->tahunAkhir == 0){
                $thn = $req->tahunAwal.' Bulan';
            }
            else{
               $thn = $req->tahunAwal.'-'.$req->tahunAkhir.' Bulan'; 
            };

            if ($req->hargaAkhir == 0){
                $hrg = $req->hargaAwal;
            }
            else{
               $hrg = $req->hargaAwal.'-'.$req->hargaAkhir; 
            };

            $pilUser  = $req->jnsMotor.'. '.$konMesin.'. '.$konBody.'. '.$thn.'. '.$hrg;
            nilai::simpanUser($req,$pilUser,$nilTinggi->penilaianId);
        
            $user       = nilai::getUserAkhir();
            $dataMotor  = DB::table('tblpenilaian')
                            ->leftJoin('tblmotor','tblpenilaian.motorId','=','tblmotor.id')
                            ->leftJoin('tblbantu','tblpenilaian.id','=','tblbantu.penilaianId')
                            ->where('tblpenilaian.id','=',$user->penilaianId)
                            ->where('tblbantu.status','=','2')
                            ->first();
            $datas = nilai::listMotor();
            foreach($datas as $data){
                $hasilTopsis = $dataMotor->nilTopsisUser - $data->nilTopsis;
                nilai::updateHasilTopsis($data->kdPenilaian,abs($hasilTopsis));
            }

            $dataMotor  = DB::table('tblpenilaian')
                            ->leftJoin('tblmotor','tblpenilaian.motorId','=','tblmotor.id')
                            ->leftJoin('tblbantu','tblpenilaian.id','=','tblbantu.penilaianId')
                            ->where('tblbantu.status','=','2')  
                            ->orderBy('tblpenilaian.hasilTopsis','ASC')
                            ->first();

            $peringkat  = nilai::listPeringkat(); 

            return view('user.hasil',compact('user', 'peringkat', 'dataMotor'));
        }
        else{
            return back()->with('msg','Motor Dengan Spesifikasi Penilaian Tidak Ada');
        };
    }

    public function topsisAdmin()
    {
        $sql = "SELECT * FROM tblpenilaian p left join tblnilaikon n on n.penilaianId = p.id left join tblmotor m on p.motorId = m.id";
        $dataMotor = DB::select($sql);

        if(count($dataMotor)==0){
            return redirect('/admin/home')->with('msg','Data Tidak Ada');
        };
        
        if (!empty($dataMotor)){
            // bobot
            $dataKriteria = kriteria::listData(); 
            foreach($dataKriteria as $kriteria){
                $bobot[] = $kriteria->bobot / 100; 
            };
            
            // mendapatkan nilai pembagi 
            $pembagikonMesin    = 0;
            $pembagikonbody     = 0;
            $pembagithnPakai    = 0;
            $pembagiharga       = 0;

            foreach($dataMotor as $motor){
                $pembagikonMesin += pow($motor->konMesinKon,2);
                $pembagikonbody  += pow($motor->konBodyKon,2);
                $pembagithnPakai += pow($motor->thnPakaiKon,2);
                $pembagiharga    += pow($motor->hargaKon,2);
            };

            $bagiKonMesin = sqrt($pembagikonMesin); $bagiKonBody = sqrt($pembagikonbody);
            $bagiThnPakai = sqrt($pembagithnPakai); $bagiHarga   = sqrt($pembagiharga);

            // membagi setiap nilai dengan pembagi
            nilai::hapusBantu();
            foreach ($dataMotor as $motor){
                $krMesin    = $motor->konMesinKon / $bagiKonMesin;
                $krBody     = $motor->konBodyKon / $bagiKonBody;
                $krThnPakai = $motor->thnPakaiKon / $bagiThnPakai;
                $krHarga    = $motor->hargaKon / $bagiHarga;

                nilai::simpanBantu($motor->penilaianId, $krMesin, $krBody, $krThnPakai, $krHarga, '1');
            };

            // mencari nilai terbobot
            $dataBantu = nilai::getByStatus('1');

            foreach($dataBantu as $bantu){
                $mesinBobot = $bantu->bnMesin * $bobot[0];
                $bodyBobot  = $bantu->bnBody * $bobot[1];
                $tahunBobot = $bantu->bnTahun * $bobot[3];
                $hargaBobot = $bantu->bnHarga * $bobot[2];

                nilai::simpanBantu($bantu->penilaianId, $mesinBobot, $bodyBobot, $tahunBobot, $hargaBobot, '2');
            };

            $max = nilai::getMax();
            $min = nilai::getMin();
            
            $dataBantu = nilai::listBantu();    

            foreach($dataBantu as $bantu){
                $nilPositif = sqrt(pow($max[0]->maxBnMesin - $bantu->bnMesin,2) + 
                                   pow($max[0]->maxBnBody - $bantu->bnBody,2) +
                                   pow($max[0]->maxBnTahun - $bantu->bnTahun,2) +
                                   pow($max[0]->maxBnHarga - $bantu->bnHarga,2));

                $nilNegatif = sqrt(pow($min[0]->minBnMesin - $bantu->bnMesin,2) + 
                                   pow($min[0]->minBnBody - $bantu->bnBody,2) +
                                   pow($min[0]->minBnTahun - $bantu->bnTahun,2) +
                                   pow($min[0]->minBnHarga - $bantu->bnHarga,2));
        
                nilai::updatePosNeg($bantu->penilaianId, $nilPositif, $nilNegatif);
            };

            $dataBantu = nilai::listBantu(); 
            foreach($dataBantu as $bantu){
                if ($bantu->negatif==0){
                    $hasil = $bantu->negatif / (1 - $bantu->positif);
                }
                else{
                     $hasil = $bantu->negatif / ($bantu->negatif + $bantu->positif);
                };

                nilai::updateNilTop($bantu->penilaianId,$hasil);
                nilai::updateNilTopBantu($bantu->penilaianId,$hasil);
            };    
            
            $listTopsis = nilai::listTopsis(); 
            return view('admin.laporan.laporanTopsis',compact('listTopsis'));
        };
    }
}