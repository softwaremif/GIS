<?php
    function tgl($tgl){
      $tanggal  = substr($tgl,8,2);
      $bulan    = getBulan(substr($tgl,5,2));
      $tahun    = substr($tgl,0,4);
      $time     = substr($tgl,11,8);
      if($time>0){
      return $tanggal." ".$bulan." ".$tahun.",".$time;   
      } else {
      return $tanggal." ".$bulan." ".$tahun;   
      }      
    }  

    function tglu($tgl){
      $tanggal  = substr($tgl,8,2);
      $bulan    = getBulan(substr($tgl,5,2));
      $tahun    = substr($tgl,0,4);
      $time     = substr($tgl,11,8);
      if($time>0){
      return $tanggal." ".$bulan." ".$tahun.",".$time;  
      } else {
      return $tanggal." ".$bulan." ".$tahun;   
      }        
    }  

    function getBulan($bln){
      switch ($bln){
        case 1: 
          return "Jan";
          break;
        case 2:
          return "Feb";
          break;
        case 3:
          return "Mar";
          break;
        case 4:
          return "Apr";
          break;
        case 5:
          return "May";
          break;
        case 6:
          return "Jun";
          break;
        case 7:
          return "Jul";
          break;
        case 8:
          return "Aug";
          break;
        case 9:
          return "Sep";
          break;
        case 10:
          return "Oct";
          break;
        case 11:
          return "Nov";
          break;
        case 12:
          return "Dec";
          break;
    }
} 
?>
