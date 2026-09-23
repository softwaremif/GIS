<?php
$host = "192.168.0.4";
$user = "user";
$pass = "user";
$db = "mif";
$koneksi = mysqli_connect($host,$user,$pass,$db);

if (!$koneksi) {
die("SERVER MAINTENANCE".mysqli_connect_error());
}
//mysqli_close($koneksi);
?>
