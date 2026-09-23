<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi4.php";
include "../config/tanggal.php";

date_default_timezone_set('Asia/Jakarta');

//$result = mysqli_fetch_array(mysqli_query($koneksi,"select * FROM dtg where jamposting is not null order by tglinput desc limit 1"));
$result = mysqli_fetch_array(mysqli_query($koneksi,"select * FROM dtg order by tglinput desc limit 1"));

//$result2 = mysqli_fetch_array(mysqli_query($koneksi,"select * FROM dtg where tglinput='$result[tglinput]' and jamposting is not null order by jamposting desc limit 1"));
$result2 = mysqli_fetch_array(mysqli_query($koneksi,"select * FROM dtg where tglinput='$result[tglinput]' order by jamposting desc limit 1"));

if($result2['jamposting']>0){
$day = date('l', strtotime($result['tglinput']));
$hasil = $day.",". " ". tgl($result['tglinput']) ." ". $result2['jamposting'];
} else {
$hasil = date('l, d/M/Y  H:i:s');    
}

echo $hasil;
?>