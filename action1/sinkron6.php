<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
$ord=$_GET['ord'];
$po=$_GET['po'];
$thn2=date("Y");
$bln1=date("m");
$bln2=$bln1-1;
$hari=date("Y-m-d");
$bln3=date("Y-m-d", strtotime("-3 days", strtotime($hari)));

/*variable kelnm material*/
if($_SESSION['mat']==1) { $and="and rpo.kelnm='CUTTING'"; $and2="and podt.kelnm='CUTTING'"; }
else { $and="and rpo.kelnm<>'CUTTING'"; $and2="and podt.kelnm<>'CUTTING'"; }
//$updt1=mysqli_query($koneksi,"update po set pourgpk='1' where pourgpk='0'");
//$updt2=mysqli_query($koneksi,"update rpo set posts='1' where stspk='2' and posts='0'");

/*sinkron popk material(podt)*/
/*$cari3=mysqli_query($koneksi,"select podt.popk, podt.rkbpk FROM podt
left outer join ord on ord.ordpk=podt.ordpk
left outer join po on po.popk=podt.popk
where po.tglpo between '$bln3' and '$hari' and podt.popk>0 and po.postatpk=4 $and2");
while($dt3=mysqli_fetch_array($cari3)){
$update1=mysqli_query($koneksi,"update rkb set popk='$dt3[popk]', status='6' where rkbpk='$dt3[rkbpk]'");
$update2=mysqli_query($koneksi,"update rpo set popk='$dt3[popk]', where rkbpk='$dt3[rkbpk]'");
}*/
?>