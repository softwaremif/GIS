<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/tanggal.php";

$popk   = $_POST['po'];

$result = mysqli_num_rows(mysqli_query($koneksi,"select * FROM podt where popk='$popk' and copy='3'"));

echo $result;
?>