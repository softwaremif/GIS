<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
$ord=$_GET['ord'];
$po=$_GET['po'];
$thn2=date("Y");
$bln2=date("m");

/*sinkron popk material(podt)*/
$cari4=mysqli_query($koneksi,"select po.postatpk, podt.popk, podt.rkbpk, rkb.stspk, rkb.status FROM podt
left outer join ord on ord.ordpk=podt.ordpk
left outer join po on po.popk=podt.popk
left outer join rkb on rkb.rkbpk=podt.rkbpk
where po.pur='$_SESSION[login]' and podt.popk='$po' and podt.delsts='0'");
while($dt4=mysqli_fetch_array($cari4)){
if($dt4['postatpk']==4){
$status=6;
} else {
$status=4;    
}
$update1=mysqli_query($koneksi,"update rkb set popk='$dt4[popk]', stspk='$dt4[stspk]', status='$status', rkbsts='1' where rkbpk='$dt4[rkbpk]' and popk is null");
$update1b=mysqli_query($koneksi,"update rkb set popk='$dt4[popk]', stspk='$dt4[stspk]', status='$status', rkbsts='1' where rkbpk='$dt4[rkbpk]' and popk='0'");
$update2=mysqli_query($koneksi,"update rpo set popk='$dt4[popk]', stspk='$dt4[stspk]', posts='1' where rkbpk='$dt4[rkbpk]' and popk='0'");
$update2b=mysqli_query($koneksi,"update rpo set popk='$dt4[popk]', stspk='$dt4[stspk]', posts='1' where rkbpk='$dt4[rkbpk]' and popk is null");
$update3=mysqli_query($koneksi,"update podt set stspk='$dt4[stspk]' where rkbpk='$dt4[rkbpk]' and stspk is null");
}
//$update4=mysqli_query($koneksi,"update po set ck='1' where ck='0' and popk='$po'");

/*podt.popk=0*/
/*$cari4a=mysqli_query($koneksi,"select podt.rkbpk FROM podt
left outer join ord on ord.ordpk=podt.ordpk
where podt.popk=0 $and2");
while($dt4a=mysqli_fetch_array($cari4a)){
$cari4b=mysqli_query($koneksi,"select po.popk, po.suppk, po.tgldel FROM po
where pourgpk='1' and postatpk='1' and tglpo='$hari' and pur='$_SESSION[login]' and suppk='$dt4a[suppk]' and ck='1'
order by popk desc limit 1");
while($dt4b=mysqli_fetch_array($cari4b)){
$update1=mysqli_query($koneksi,"update rkb set popk='$dt4b[popk]' where stspk='2' and status='4' and popk='0' and suppk='$dt4a[suppk]' and poreqdel='$dt4a[poreqdel]'");
$update2=mysqli_query($koneksi,"update rpo set popk='$dt4b[popk]' where stspk='2' and popk='0' and suppk='$dt4a[suppk]' and poreqdel='$dt4a[poreqdel]'");
$update3=mysqli_query($koneksi,"update podt set popk='$dt4b[popk]' where stspk='2' and popk='0' and suppk='$dt4a[suppk]'");
//$result3 = mysqli_query($koneksi,"update po set ck='1' where popk='$dt4b[popk]'");
}
}*/

/*$cari5=mysqli_query($koneksi,"select rkb.rkbpk FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
where ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord' and rkb.bdownqty='0' and rkb.status='4'");
while($dt5=mysqli_fetch_array($cari5)){
$update1=mysqli_query($koneksi,"update rkb set stspk=NULL, popk=NULL, poreqdel=NULL, podel=NULL, status='1' where rkbpk='$dt5[rkbpk]'");
$update2=mysqli_query($koneksi,"delete from rpo where rkbpk='$dt5[rkbpk]'");
$update3=mysqli_query($koneksi,"delete from podt where rkbpk='$dt5[rkbpk]'");
}*/
?>