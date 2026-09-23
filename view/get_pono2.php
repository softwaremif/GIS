<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/tanggal.php";

$pono   = $_POST['pono'];

$result = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM podt
LEFT OUTER JOIN po ON po.popk=podt.popk
LEFT OUTER JOIN ord ON ord.ordpk=podt.ordpk
LEFT OUTER JOIN sup ON sup.suppk=podt.suppk
WHERE ord.fupk='$_SESSION[fu]' AND podt.cek<>'4' AND sup.supnm NOT LIKE '%STOCK%' AND po.pono LIKE '%$pono%'
GROUP BY po.popk"));

echo $result;
?>