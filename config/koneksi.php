<?php
$host = "192.168.0.11";
$user = "user";
$pass = "user";
$db = "sig";
$koneksi = mysqli_connect($host,$user,$pass,$db);

$host2 = "192.168.0.4";
$user2 = "user";
$pass2 = "user";
$db2 = "mif";
$koneksi4 = mysqli_connect($host2,$user2,$pass2,$db2);

if (!$koneksi || !$koneksi4) {
die("SERVER MAINTENANCE".mysqli_connect_error());
}
//mysqli_close($koneksi);
?>
