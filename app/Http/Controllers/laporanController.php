<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\motor;
use App\model\kriteria;
use App\model\nilai;
use Excel;

class laporanController extends Controller
{
    public function lapMotor(Request $req){
    	$listMotor = motor::kosong();
    	$cari 	   = '';

    	if ($req->has('q')){
			$cari = $req->q;

			if ($cari == 'semua'){
				$listMotor = motor::getAll();
			}
			else{
				$listMotor = motor::getByJenis($cari);
			}    		
    	};

    	return view('admin.laporan.laporanMotor',compact('listMotor', 'cari'));
    }

    public function previewMotor($cari){
		if ($cari == 'semua'){
			$listMotor = motor::getAll();
		}
		else{
			$listMotor = motor::getByJenis($cari);
		};    		

    	return view('admin.laporan.motorPreview',compact('listMotor'));	
    }

    public function excelMotor($cari){
    	if ($cari == 'semua'){
			$listMotor = motor::getAll();
		}
		else{
			$listMotor = motor::getByJenis($cari);
		};    		

    	Excel::create("Laporan Motor ", function($excel) use ($listMotor) {
            //  set property
            $excel->setTitle("Laporan List Sepeda Motor");

            $excel->sheet('Toko Ahmad Motor', function($sheet) use ($listMotor){
                $sheet->mergeCells('A1:F1');
                $sheet->cells('A1', function ($cells) use ($listMotor){
                    $cells->setAlignment('center');
                    $cells->setFontWeight('bold');
                    $cells->setValue('Toko Ahmad Motor');
                });

                $sheet->mergeCells('A2:F2');
                $sheet->cells('A2', function ($cells) use ($listMotor){
                    $cells->setAlignment('center');
                    $cells->setFontWeight('bold');
                    $cells->setValue('Laporan List Sepeda Motor');
                });

                $sheet->mergeCells('A3:F3');

                $row = 4;
                $sheet->row($row, [
                    'No',
                    'Kode Motor',
                    'Merk Motor',
                    'Jenis Motor',
                    'noMesin',
                    'Tahun Motor'
                  ]);

                $no  = 0;
                $hal = 0;
                foreach($listMotor as $no=>$data){
                  $sheet->row(++$row,[
                      ++$no,
                      $data->kdMotor,
                      $data->merkMotor,
                      $data->jnsMotor,
                      $data->noMesin,
                      $data->thnMotor
                    ]);
                  $no +=$no;
                }

                if ($no==2){
                	$no += 5;
                }
            	else{
            		$no += 1;
            	};

                $hal = $no+1;

                $sheet->cells('F'.$no, function($cells){
                	$cells->setValue('Banjarbaru, '. tglIndo(date("d-m-Y"),'2'));
                });

                $sheet->cells('F'.$hal, function($cells){
                	$cells->setValue('Mengetahui,');
                });
            });
        })->export('xlsx');
    }

    public function lapKriteria(){
        $listKriteria = kriteria::listData();
        return view('admin.laporan.laporanKriteria',compact('listKriteria'));
    }

    public function previewKriteria(){
        $listKriteria = kriteria::listData();
        return view('admin.laporan.kriteriaPreview',compact('listKriteria')); 
    }

    public function excelKriteria(){
        $listKriteria = kriteria::listData();
        Excel::create("Laporan Kriteria ", function($excel) use ($listKriteria) {
            //  set property
            $excel->setTitle("Laporan Kriteria");

            $excel->sheet('Toko Ahmad Motor', function($sheet) use ($listKriteria){
                $sheet->mergeCells('A1:E1');
                $sheet->cells('A1', function ($cells) use ($listKriteria){
                    $cells->setAlignment('center');
                    $cells->setFontWeight('bold');
                    $cells->setValue('Toko Ahmad Motor');
                });

                $sheet->mergeCells('A2:E2');
                $sheet->cells('A2', function ($cells) use ($listKriteria){
                    $cells->setAlignment('center');
                    $cells->setFontWeight('bold');
                    $cells->setValue('Laporan Kriteria');
                });

                $sheet->mergeCells('A3:E3');

                $row = 4;
                $sheet->row($row, [
                    'No',
                    'Kode Kriteria',
                    'Nama Kriteria',
                    'Desikripsi',
                    'Bobot (%)'
                  ]);

                $no  = 0;
                $hal = 0;
                foreach($listKriteria as $no=>$data){
                  $sheet->row(++$row,[
                      ++$no,
                      $data->kdKriteria,
                      $data->nmKriteria,
                      $data->ket,
                      $data->bobot
                    ]);
                  $no +=$no;
                }

                if ($no==2){
                    $no += 5;
                }
                else{
                    $no += 2;
                };

                $hal = $no+1;

                $sheet->cells('E'.$no, function($cells){
                    $cells->setValue('Banjarbaru, '. tglIndo(date("d-m-Y"),'2'));
                });

                $sheet->cells('E'.$hal, function($cells){
                    $cells->setValue('Mengetahui,');
                });
            });
        })->export('xlsx');
    }

    public function lapPenilaian(Request $req){
        $listPenilaian = nilai::getAll('3','');
        $cari          = '';

        if ($req->has('q')){
            $cari = $req->q;

            if ($cari == 'semua'){
                $listPenilaian = nilai::getAll('2','semua');
            }
            else{
                $listPenilaian = nilai::getAll('2',$cari);
            }           
        };

        return view('admin.laporan.laporanPenilaian',compact('listPenilaian', 'cari'));   
    }

    public function previewPenilaian($cari){
        if ($cari == 'semua'){
            $listPenilaian = nilai::getAll('2','semua');
        }
        else{
            $listPenilaian = nilai::getAll('2',$cari);
        };          

        return view('admin.laporan.penilaianPreview',compact('listPenilaian')); 
    }

    public function excelPenilaian($cari){
        if ($cari == 'semua'){
            $listPenilaian = nilai::getAll('2','semua');
        }
        else{
            $listPenilaian = nilai::getAll('2',$cari);
        };          

        Excel::create("Laporan Penilaian ", function($excel) use ($listPenilaian) {
            //  set property
            $excel->setTitle("Laporan Penilaian Sepeda Motor");

            $excel->sheet('Toko Ahmad Motor', function($sheet) use ($listPenilaian){
                $sheet->mergeCells('A1:J1');
                $sheet->cells('A1', function ($cells) use ($listPenilaian){
                    $cells->setAlignment('center');
                    $cells->setFontWeight('bold');
                    $cells->setValue('Toko Ahmad Motor');
                });

                $sheet->mergeCells('A2:J2');
                $sheet->cells('A2', function ($cells) use ($listPenilaian){
                    $cells->setAlignment('center');
                    $cells->setFontWeight('bold');
                    $cells->setValue('Laporan List Sepeda Motor');
                });

                $sheet->mergeCells('A3:J3');

                $row = 4;
                $sheet->row($row, [
                    'No',
                    'Kode Motor',
                    'Merk Motor',
                    'Jenis Motor',
                    'No. Mesin',
                    'Tahun Motor',
                    'Kondisi Mesin',
                    'kondisi Body',
                    'Lama Pemakaian',
                    'Harga (Rp)'
                  ]);

                $no  = 0;
                $hal = 0;
                foreach($listPenilaian as $no=>$data){
                  $tahun = intdiv($data->thnPakai, 12);
                  $bulan = $data->thnPakai % 12;

                  if ($bulan==0){
                       $thnAsli = $tahun.' Tahun';
                  }
                  elseif ($tahun<>0 && $bulan<>0){
                      $thnAsli = $tahun.' Tahun '.$bulan.' Bulan';
                  }
                  elseif ($tahun==0 && $bulan<>0){
                      $thnAsli = $bulan.' Bulan';
                  };

                  $sheet->row(++$row,[
                      ++$no,
                      $data->kdMotor,
                      $data->merkMotor,
                      $data->jnsMotor,
                      $data->noMesin,
                      $data->thnMotor,
                      $data->konMesin,
                      $data->konBody,
                      $thnAsli,
                      number_format($data->harga)
                    ]);
                  $no +=$no;
                }

                $no  = count($listPenilaian) + 6;
                $hal = $no+1;

                $sheet->cells('J'.$no, function($cells){
                    $cells->setValue('Banjarbaru, '. tglIndo(date("d-m-Y"),'2'));
                });

                $sheet->cells('J'.$hal, function($cells){
                    $cells->setValue('Mengetahui,');
                });
            });
        })->export('xlsx');
    }

    public function lapUser(Request $req){
        $reqBulan = $req->bulan;
        $reqTahun = $req->tahun;
        $listPilUser = nilai::laporanUser($reqBulan, $reqTahun);    

        if ($reqBulan=='' && $reqTahun<>''){
            $listPilUser = nilai::laporanUserByTahun($reqTahun);
        }
        elseif ($reqBulan<>'' && $reqTahun==''){
            $listPilUser = nilai::laporanUserByBulan($reqBulan);   
        }
        elseif ($reqBulan<>'' && $reqTahun<>''){
            $listPilUser = nilai::laporanUser($reqBulan, $reqTahun);    
        };
        
        return view('admin.laporan.laporanUser',compact('listPilUser','reqBulan','reqTahun'));
    }

    public function previewUser($bulan,$tahun){
        $listPilUser = nilai::laporanUser($bulan, $tahun);    

        if ($bulan=='' && $tahun<>''){
            $listPilUser = nilai::laporanUserByTahun($tahun);
        }
        elseif ($bulan<>'' && $tahun==''){
            $listPilUser = nilai::laporanUserByBulan($bulan);   
        }
        elseif ($bulan<>'' && $tahun<>''){
            $listPilUser = nilai::laporanUser($bulan, $tahun);    
        };

        if ($bulan==1){
            $blnIndo = 'Januari';
        }
        elseif ($bulan==2){
            $blnIndo = 'Februari';
        }
        elseif ($bulan==3){
            $blnIndo = 'Maret';
        }
        elseif ($bulan==4){
            $blnIndo = 'April';
        }
        elseif ($bulan==5){
            $blnIndo = 'Mei';
        }
        elseif ($bulan==6){
            $blnIndo = 'Juni';
        }
        elseif ($bulan==7){
            $blnIndo = 'Juli';
        }
        elseif ($bulan==8){
            $blnIndo = 'Agustus';
        }
        elseif ($bulan==9){
            $blnIndo = 'September';
        }
        elseif ($bulan==10){
            $blnIndo = 'Oktober';
        }
        elseif ($bulan==11){
            $blnIndo = 'November';
        }
        elseif ($bulan==12){
            $blnIndo = 'Desember';
        };

        return view('admin.laporan.userPreview',compact('listPilUser','bulan','tahun','blnIndo'));   
    }

    public function excelUser($bulan, $tahun){
        $listPilUser = nilai::laporanUser($bulan, $tahun);    

        if ($bulan=='' && $tahun<>''){
            $listPilUser = nilai::laporanUserByTahun($tahun);
        }
        elseif ($bulan<>'' && $tahun==''){
            $listPilUser = nilai::laporanUserByBulan($bulan);   
        }
        elseif ($bulan<>'' && $tahun<>''){
            $listPilUser = nilai::laporanUser($bulan, $tahun);    
        };

        if ($bulan==1){
            $blnIndo = 'Januari';
        }
        elseif ($bulan==2){
            $blnIndo = 'Februari';
        }
        elseif ($bulan==3){
            $blnIndo = 'Maret';
        }
        elseif ($bulan==4){
            $blnIndo = 'April';
        }
        elseif ($bulan==5){
            $blnIndo = 'Mei';
        }
        elseif ($bulan==6){
            $blnIndo = 'Juni';
        }
        elseif ($bulan==7){
            $blnIndo = 'Juli';
        }
        elseif ($bulan==8){
            $blnIndo = 'Agustus';
        }
        elseif ($bulan==9){
            $blnIndo = 'September';
        }
        elseif ($bulan==10){
            $blnIndo = 'Oktober';
        }
        elseif ($bulan==11){
            $blnIndo = 'November';
        }
        elseif ($bulan==12){
            $blnIndo = 'Desember';
        };

        Excel::create("Laporan Pilihan User ", function($excel) use ($listPilUser) {
            //  set property
            $excel->setTitle("Laporan Pilihan User");

            $excel->sheet('Toko Ahmad Motor', function($sheet) use ($listPilUser){
                $sheet->mergeCells('A1:E1');
                $sheet->cells('A1', function ($cells) use ($listPilUser){
                    $cells->setAlignment('center');
                    $cells->setFontWeight('bold');
                    $cells->setValue('Toko Ahmad Motor');
                });

                $sheet->mergeCells('A2:E2');
                $sheet->cells('A2', function ($cells) use ($listPilUser){
                    $cells->setAlignment('center');
                    $cells->setFontWeight('bold');
                    $cells->setValue('Laporan Pilihan User');
                });

                $sheet->mergeCells('A3:E3');

                $row = 4;
                $sheet->row($row, [
                    'No',
                    'Tanggal',
                    'Nama User',
                    'Pilihan User',
                    'Rekomendasi SPK'
                  ]);

                $no  = 0;
                $hal = 0;
                foreach($listPilUser as $no=>$data){
                  $sheet->row(++$row,[
                      ++$no,
                      date('d - m - Y', strtotime($data->tgl)),  
                      $data->nmUser,
                      $data->pilUser,
                      'No. Mesin : '. $data->noMesin.', '.
                      'Merk Motor : '.$data->merkMotor.', '.
                      'Nilai Topsis : '.$data->nilTopsis             
                    ]);
                }
                
                $no  = count($listPilUser) + 6;
                $hal = $no+1;

                $sheet->cells('E'.$no, function($cells){
                    $cells->setAlignment('right');
                    $cells->setValue('Banjarbaru, '. tglIndo(date("d-m-Y"),'2'));
                });

                $sheet->cells('E'.$hal, function($cells){
                    $cells->setAlignment('right');
                    $cells->setValue('Mengetahui,');
                });
            });
        })->export('xlsx');   
    }

    public function previewTopsis(){
        $listTopsis = nilai::listTopsis(); 
        return view('admin.laporan.topsisPreview',compact('listTopsis')); 
    }

    public function excelTopsis(){
        $listTopsis = nilai::listTopsis(); 
        Excel::create("Laporan Topsis ", function($excel) use ($listTopsis) {
            //  set property
            $excel->setTitle("Laporan Topsis");

            $excel->sheet('Toko Ahmad Motor', function($sheet) use ($listTopsis){
                $sheet->mergeCells('A1:E1');
                $sheet->cells('A1', function ($cells) use ($listTopsis){
                    $cells->setAlignment('center');
                    $cells->setFontWeight('bold');
                    $cells->setValue('Toko Ahmad Motor');
                });

                $sheet->mergeCells('A2:E2');
                $sheet->cells('A2', function ($cells) use ($listTopsis){
                    $cells->setAlignment('center');
                    $cells->setFontWeight('bold');
                    $cells->setValue('Laporan Kriteria');
                });

                $sheet->mergeCells('A3:E3');

                $row = 4;
                $sheet->row($row, [
                   'No',
                   'Kode Motor',
                   'Merk Motor',
                   'Jenis Motor',
                   'Nilai Topsis'
                  ]);

                $no  = 0;
                $hal = 0;
                foreach($listTopsis as $no=>$data){
                  $sheet->row(++$row,[
                      ++$no,
                      $data->kdMotor,
                      $data->merkMotor,
                      $data->jnsMotor,
                      number_format($data->topsis,5)
                    ]);
                  $no +=$no;
                }

                if ($no==2){
                    $no += 5;
                }
                else{
                    $no += 2;
                };

                $hal = $no+1;

                $sheet->cells('E'.$no, function($cells){
                    $cells->setValue('Banjarbaru, '. tglIndo(date("d-m-Y"),'2'));
                });

                $sheet->cells('E'.$hal, function($cells){
                    $cells->setValue('Mengetahui,');
                });
            });
        })->export('xlsx');
    }

}
