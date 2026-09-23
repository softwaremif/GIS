<?php
$host2 = "192.168.0.19";
$user2 = "user";
$pass2 = "user";
$db2 = "andon";
$koneksi11a = mysqli_connect($host2,$user2,$pass2,$db2);

if (!$koneksi11a) {
die("SERVER MAINTENANCE".mysqli_connect_error());
}
//mysqli_close($koneksi);
?>
