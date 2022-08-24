<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('hari')) {
    function hari($lang){
      if($lang == 'indonesia')
      {
          $hari = Date('w');
          switch ($hari) {
              case 1:
                  $hari = "Senin";
                  break;
              case 2:
                  $hari = "Selasa";
                  break;
              case 3:
                  $hari = "Rabu";
                  break;
              case 4:
                  $hari = "Kamis";
                  break;
              case 5:
                  $hari = "Jum'at";
                  break;
              case 6:
                  $hari = "Sabtu";
                  break;
              case 7:
                  $hari = "Minggu";
                  break;
              default:
                  $hari = Date('l');
                  break;
          }
          return $hari;
        }
        if($lang = 'english')
        {
          $hari = Date('l');
          return $hari;
        }
  }
}
if (!function_exists('bulan')) {
    function bulan($lang){
      if($lang == 'indonesia')
      {
          $bulan = Date('m');
          switch ($bulan) {
              case 1:
                  $bulan = "Januari";
                  break;
              case 2:
                  $bulan = "Februari";
                  break;
              case 3:
                  $bulan = "Maret";
                  break;
              case 4:
                  $bulan = "April";
                  break;
              case 5:
                  $bulan = "Mei";
                  break;
              case 6:
                  $bulan = "Juni";
                  break;
              case 7:
                  $bulan = "Juli";
                  break;
              case 8:
                  $bulan = "Agustus";
                  break;
              case 9:
                  $bulan = "September";
                  break;
              case 10:
                  $bulan = "Oktober";
                  break;
              case 11:
                  $bulan = "November";
                  break;
              case 12:
                  $bulan = "Desember";
                  break;
              default:
                  $bulan = Date('F');
                  break;
          }
          return $bulan;
        }
        if($lang = 'english')
        {
          $bulan = Date('m');
          return $bulan;
        }
    }
}
/**
 * Fungsi untuk membuat tanggal dalam format bahasa indonesia
 * @param void
 * @return string format tanggal sekarang (contoh: 22 Desember 2016)
 */
if (!function_exists('tgl_default')) {
    function tgl_default($lang) {
        $tgl_default = hari($lang).", ".Date('d') . " " .bulan($lang). " ".Date('Y');
        return $tgl_default;
    }
}

if (!function_exists('bln')) {
    function bln($b){
        switch ($b) {
            case 1:
                $bulan = "Januari";
                break;
            case 2:
                $bulan = "Februari";
                break;
            case 3:
                $bulan = "Maret";
                break;
            case 4:
                $bulan = "April";
                break;
            case 5:
                $bulan = "Mei";
                break;
            case 6:
                $bulan = "Juni";
                break;
            case 7:
                $bulan = "Juli";
                break;
            case 8:
                $bulan = "Agustus";
                break;
            case 9:
                $bulan = "September";
                break;
            case 10:
                $bulan = "Oktober";
                break;
            case 11:
                $bulan = "November";
                break;
            case 12:
                $bulan = "Desember";
                break;
            default:
                $bulan = Date('F');
                break;
        }
        return $bulan;
    }
}

if (!function_exists('tgl_indo')) {
    function tgl_indo($tg) {
        $tgl = explode('-', $tg);
        $tgl_default = "".$tgl[2] . " " .bln($tgl[1]). " ".$tgl[0];
        return $tgl_default;
    }
}

