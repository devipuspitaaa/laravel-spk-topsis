<?php
	function tglIndo($tanggal, $status){
	    //$tgl_now = date("d-m-Y");
        $tgl_now = $tanggal;
        $hari = date("l");

        switch ($hari) {
            case 'Sunday':
                $hari_indo = "Minggu";
                break;
                  
            case 'Monday':
                $hari_indo = "Senin";
                break;

            case 'Tuesday':
                $hari_indo = "Selasa";
                break;

            case 'Wednesday':
                $hari_indo = "Rabu";
                break;

            case 'Thursday':
                $hari_indo = "Kamis";
                break;

            case 'Friday':
                $hari_indo = "Jum"."'"."at";
                break;

            case 'Saturday':
                $hari_indo = "Sabtu";
                break;

            default:
                $hari_indo = " ";
                break;
        };

        $tgl = explode("-", $tgl_now);
        	switch ($tgl[1]) {
                case '01':
                    $bln_indo = "Januari";
                    break;
                    
                case '02':
                    $bln_indo = "Februari";
                    break;

                case '03':
                    $bln_indo = "Maret";
                    break;

                case '04':
                    $bln_indo = "April";
                    break;

                case '05':
                    $bln_indo = "Mei";
                    break;

                case '06':
                    $bln_indo = "Juni";
                    break;

                case '07':
                    $bln_indo = "Juli";
                    break;

                case '08':
                    $bln_indo = "Agustus";
                    break;

                case '09':
                    $bln_indo = "September";
                    break;

                case '10':
                    $bln_indo = "Oktober";
                    break;

                case '11':
                    $bln_indo = "November";
                    break;

                case '12':
                    $bln_indo = "Desember";
                    break;

                default:
                    $bln_indo = "";
                    break;
            };

        if ($status==1){
        	$tgl_indo = $hari_indo.', '.$tgl[0].' '.$bln_indo.' '.$tgl[2];	
        }    
        elseif ($status==2){
        	$tgl_indo = $hari_indo.' '.$tgl[0].' '.$bln_indo.' '.$tgl[2];	
        }
         
        return $tgl_indo;  
	};
 ?>