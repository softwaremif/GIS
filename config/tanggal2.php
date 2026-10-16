<?php
    function tgl2($tgl){
      $tanggal  = substr($tgl,8,2);
      $bulan    = getBulanin(substr($tgl,5,2));
      $tahun    = substr($tgl,0,4);
      return $tanggal."/".$bulan."/".$tahun;         
    }
    function tgl2b($tgl){
      $tanggal  = substr($tgl,0,2);
      $bulan    = getBulanin(substr($tgl,3,2));
      $tahun    = substr($tgl,6,4);
      return $tahun."-".$bulan."-".$tanggal;
    }
    // Cek tahun tanggal dd/mm/yyyy maksimal tahun berjalan + $rentang.
    // $kolom = ['PCD' => '29/12/2026', ...]; mengembalikan label yang salah.
    function tahun_lewat_batas($kolom, $rentang = 2){
      $maks  = (int) date('Y') + $rentang;
      $salah = [];
      foreach ($kolom as $label => $tgl) {
        $tahun = (int) substr(trim((string) $tgl), 6, 4);
        if ($tahun > $maks) $salah[] = $label;
      }
      return $salah;
    }
    function getBulanin($bln){
      switch ($bln){
        case 1: 
          return "01";
          break;
        case 2:
          return "02";
          break;
        case 3:
          return "03";
          break;
        case 4:
          return "04";
          break;
        case 5:
          return "05";
          break;
        case 6:
          return "06";
          break;
        case 7:
          return "07";
          break;
        case 8:
          return "08";
          break;
        case 9:
          return "09";
          break;
        case 10:
          return "10";
          break;
        case 11:
          return "11";
          break;
        case 12:
          return "12";
          break;
    }
} 
?>
