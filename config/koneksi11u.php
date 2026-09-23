<?php
$host = "192.168.0.11";
$user = "user";
$pass = "user";
$db = "akses";
$koneksi11u = mysqli_connect($host,$user,$pass,$db);

if (!$koneksi11u) {
die("SERVER MAINTENANCE".mysqli_connect_error());
}
//mysqli_close($koneksi);
?>
