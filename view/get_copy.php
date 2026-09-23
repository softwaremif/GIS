<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/tanggal.php";

$ord   = $_POST['ord'];

$result = mysqli_num_rows(mysqli_query($koneksi,"select * FROM rkb where ordpk='$ord' and copy='5'"));

echo $result;
?>