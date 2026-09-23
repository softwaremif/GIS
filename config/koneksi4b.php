<?php
$host = "192.168.0.4";
$user = "user";
$pass = "user";
$db = "mif";
$koneksi4 = mysqli_connect($host,$user,$pass,$db);

if (!$koneksi4) {
die("SERVER MAINTENANCE".mysqli_connect_error());
}
//mysqli_close($koneksi);
?>

