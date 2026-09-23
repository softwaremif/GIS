<?php
$host2 = "192.168.0.11";
$user2 = "user";
$pass2 = "user";
$db2 = "sig";
$koneksi = mysqli_connect($host2,$user2,$pass2,$db2);

if (!$koneksi) {
die("SERVER MAINTENANCE".mysqli_connect_error());
}
//mysqli_close($koneksi);
?>
