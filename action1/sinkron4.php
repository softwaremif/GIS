<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
$ord=$_GET['ord'];
$po=$_GET['po'];
$thn2=date("Y");
$bln2=date("m");

/*sinkron popk material(podt)*/
$cari4=mysqli_query($koneksi,"select podt.popk, podt.rkbpk, rkb.stspk FROM podt
left outer join ord on ord.ordpk=podt.ordpk
left outer join po on po.popk=podt.popk
left outer join rkb on rkb.rkbpk=podt.rkbpk
where ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord' and podt.popk>'0' and podt.delsts='0'");
while($dt4=mysqli_fetch_array($cari4)){
$update1=mysqli_query($koneksi,"update rkb set popk='$dt4[popk]', stspk='$dt4[stspk]', status='4', rkbsts='1' where rkbpk='$dt4[rkbpk]' and popk is null");
$update2=mysqli_query($koneksi,"update rpo set popk='$dt4[popk]', stspk='$dt4[stspk]', posts='1' where rkbpk='$dt4[rkbpk]' and popk='0'");
$update2b=mysqli_query($koneksi,"update rpo set popk='$dt4[popk]', stspk='$dt4[stspk]', posts='1' where rkbpk='$dt4[rkbpk]' and popk is null");
$update3=mysqli_query($koneksi,"update podt set stspk='$dt4[stspk]' where rkbpk='$dt4[rkbpk]' and stspk is null");
}

/*$cari5=mysqli_query($koneksi,"select rkb.rkbpk FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
where ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord' and rkb.bdownqty='0' and rkb.status='4'");
while($dt5=mysqli_fetch_array($cari5)){
$update1=mysqli_query($koneksi,"update rkb set stspk=NULL, popk=NULL, poreqdel=NULL, podel=NULL, status='1' where rkbpk='$dt5[rkbpk]'");
$update2=mysqli_query($koneksi,"delete from rpo where rkbpk='$dt5[rkbpk]'");
$update3=mysqli_query($koneksi,"delete from podt where rkbpk='$dt5[rkbpk]'");
}*/
?>