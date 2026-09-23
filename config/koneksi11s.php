<?php
$host2 = "192.168.0.11";
$user2 = "user";
$pass2 = "user";
$db2 = "sample";
$koneksi11s = mysqli_connect($host2,$user2,$pass2,$db2);

if (!$koneksi11s) {
die("SERVER MAINTENANCE".mysqli_connect_error());
}
//mysqli_close($koneksi);
?>
