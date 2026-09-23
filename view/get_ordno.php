<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/tanggal.php";

$ord   = $_POST['ord'];

$result = mysqli_fetch_array(mysqli_query($koneksi,"select * FROM ord where ordpk='$ord'"));

$result=$result['ordno'].",".$result['filenm'];
echo $result;
?>