<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/tanggal.php";

$pono   = $_POST['pono'];

$result = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM po where pono like '%$pono%'"));

echo $result;
?>