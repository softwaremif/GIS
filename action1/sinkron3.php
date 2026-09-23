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

/*sinkron popk po per hari*/
/*$cari3=mysqli_query($koneksi,"select po.popk, po.suppk, po.tgldel FROM po
where pourgpk='1' and polipk='$_GET[sts]' and postatpk='1' and tglpo='$hari' and pur='$_SESSION[login]' and ck='0'
order by popk desc limit 1");
while($dt3=mysqli_fetch_array($cari3)){
$update1=mysqli_query($koneksi,"update rkb set popk='$dt3[popk]' where stspk='2' and status='4' and popk='0' and suppk='$dt3[suppk]' and poreqdel='$dt3[tgldel]'");
$update2=mysqli_query($koneksi,"update rpo set popk='$dt3[popk]' where stspk='2' and popk='0' and suppk='$dt3[suppk]' and poreqdel='$dt3[tgldel]'");
//$update3=mysqli_query($koneksi,"update podt set popk='$dt3[popk]' where stspk='2' and popk='0' and suppk='$dt3[suppk]'");
$result3 = mysqli_query($koneksi,"update po set ck='1' where popk='$dt3[popk]'");
}*/

/*podt.popk=0*/
/*if($_GET['sts']>0){
$cari4b=mysqli_query($koneksi,"select po.popk, po.suppk, po.tgldel FROM po
where pourgpk='1' and polipk='$_GET[sts]' and postatpk='1' and tglpo='$hari' and pur='$_SESSION[login]' and ck='0'
order by popk desc limit 1");
$dt4b=mysqli_fetch_array($cari4b);

$cari4=mysqli_query($koneksi,"select podt.rkbpk, podt.suppk FROM podt
left outer join ord on ord.ordpk=podt.ordpk
where podt.popk=0 $and2");
while($dt4=mysqli_fetch_array($cari4)){
/*$update1=mysqli_query($koneksi,"update rkb set stspk='1' where rkbpk='$dt4[rkbpk]'");
$update2=mysqli_query($koneksi,"update rpo set stspk='1', popros='0' where rkbpk='$dt4[rkbpk]'");
$update3=mysqli_query($koneksi,"delete from podt where rkbpk='$dt4[rkbpk]' and popk='0'");*/

/*$update1=mysqli_query($koneksi,"update rkb set popk='$dt4b[popk]' where stspk='2' and status='4' and popk='0' and rkbpk='$dt4[rkbpk]' and suppk='$dt4[suppk]' and poreqdel='$dt4b[tgldel]'");
$update2=mysqli_query($koneksi,"update rpo set popk='$dt4b[popk]' where stspk='2' and popk='0' and rkbpk='$dt4[rkbpk]' and suppk='$dt4[suppk]' and poreqdel='$dt4b[tgldel]'");
$update3=mysqli_query($koneksi,"update podt set popk='$dt4b[popk]' where stspk='2' and popk='0' and rkbpk='$dt4[rkbpk]' and suppk='$dt4[suppk]'");
$result3 = mysqli_query($koneksi,"update po set ck='1' where popk='$dt4b[popk]'");
}
}*/

/*$cari3b=mysqli_query($koneksi,"select rkb.rkbpk, rkb.popk FROM rkb
left outer join rpo on rpo.rkbpk=rkb.rkbpk
where rpo.stspk='2' and rkb.popk>'0' and YEAR(rpo.tgl)='$thn2' and MONTH(rpo.tgl)='$bln1' $and");*/

/*sinkron popk rkb*/
/*$cari3b=mysqli_query($koneksi,"select rkb.rkbpk, rkb.popk FROM rkb
left outer join rpo on rpo.rkbpk=rkb.rkbpk
where rpo.stspk='2' and rkb.popk>'0' and rpo.tgl between '$bln3' and '$hari' $and
group by rkb.rkbpk");
while($dt3b=mysqli_fetch_array($cari3b)){
$update2=mysqli_query($koneksi,"update rpo set popk='$dt3b[popk]' where stspk='2' and popk='0' and rkbpk='$dt3b[rkbpk]'");
$update3=mysqli_query($koneksi,"update podt set popk='$dt3b[popk]' where stspk='2' and popk='0' and rkbpk='$dt3b[rkbpk]'");
}*/
?>