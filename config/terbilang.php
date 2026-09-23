<?php
function terbilang($n) {
  if ($n < 0) return 'minus ' . terbilang(-$n);
  else if ($n < 10) {
    switch ($n) {
      case 0: return 'zero';
      case 1: return 'one';
      case 2: return 'two';
      case 3: return 'three';
      case 4: return 'four';
      case 5: return 'five';
      case 6: return 'six';
      case 7: return 'seven';
      case 8: return 'eight';
      case 9: return 'nine';
    }
  }
  else if ($n < 100) {
    $kepala = floor($n/10);
    $sisa = $n % 10;
    if ($kepala == 1) {
      if ($sisa == 0) return 'ten';
      else if ($sisa == 1) return 'eleven';
      else if ($sisa == 2) return 'twelve';
      else if ($sisa == 3) return 'thirteen';
      else if ($sisa == 5) return 'fifteen';
      else if ($sisa == 8) return 'eighteen';
      else return terbilang($sisa) . 'teen';
    }
    else if ($kepala == 2) $hasil = 'twenty';
    else if ($kepala == 3) $hasil = 'thirty';
    else if ($kepala == 5) $hasil = 'fifty';
    else if ($kepala == 8) $hasil = 'eighty';
    else $hasil = terbilang($kepala) . 'ty';
  }
  else if ($n < 1000) {
    $kepala = floor($n/100);
    $sisa = $n % 100;
    if($sisa>1){ $hasil = terbilang($kepala) . ' hundred and'; }
    else { $hasil = terbilang($kepala) . ' hundred'; }
  }
  else if ($n < 1000000) {
    $kepala = floor($n/1000);
    $sisa = $n % 1000;
    $hasil = terbilang($kepala) . ' thousand';
  }
  else if ($n < 1000000000) {
    $kepala = floor($n/1000000);
    $sisa = $n % 1000000;
    $hasil = terbilang($kepala) . ' million';
  }
  else return false;

  if ($sisa > 0) $hasil .= ' ' . terbilang($sisa);
  return $hasil;
}
//if ($row_ar1['sum(ar.mdoc)']){
//echo (ucwords(Terbilang($row_ar1['sum(ar.mdoc)'])));

//}
?>