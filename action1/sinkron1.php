<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
$ord=$_GET['ord'];
$po=$_GET['po'];
$thn2=date("Y");
$bln2=date("m");

/*sinkron status material(rpo)*/
$cari2=mysqli_query($koneksi,"select rpo.rkbpk FROM rpo
left outer join ord on ord.ordpk=rpo.ordpk
where ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord'");
while($dt2=mysqli_fetch_array($cari2)){
$cari2b=mysqli_query($koneksi,"select rkb.rkbpk, rkb.podel FROM rkb where rkbpk='$dt2[rkbpk]'");
$dt2b=mysqli_fetch_array($cari2b);
if($dt2b['status']==1){
$update1=mysqli_query($koneksi,"update rkb set status='4', stspk='1', rkbsts='1', poreqdel='$dt2b[podel]' where rkbpk='$dt2b[rkbpk]'");
$update2=mysqli_query($koneksi,"update rpo set stspk='1', email='1', poreqdel='$dt2b[podel]' where rkbpk='$dt2b[rkbpk]'");
} 
}
/*sinkron stspk material(podt)*/
$cari3=mysqli_query($koneksi,"select podt.rkbpk FROM podt
left outer join ord on ord.ordpk=podt.ordpk
where ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord'");
while($dt3=mysqli_fetch_array($cari3)){
$cari3b=mysqli_query($koneksi,"select rkb.rkbpk FROM rkb where rkbpk='$dt3[rkbpk]'");
$dt3b=mysqli_fetch_array($cari3b);
if($dt3b['status']==4){
$update1=mysqli_query($koneksi,"update rkb set stspk='2' where rkbpk='$dt3b[rkbpk]'");
$update2=mysqli_query($koneksi,"update rpo set stspk='2', posts='1', popros='1' where rkbpk='$dt3b[rkbpk]'");
$update3=mysqli_query($koneksi,"update podt set stspk='2' where rkbpk='$dt3b[rkbpk]'");
} /*if($dt3b['status']==3){
$update1=mysqli_query($koneksi,"update rkb set stspk=NULL where rkbpk='$dt3b[rkbpk]'");
$update2=mysqli_query($koneksi,"update rpo set stspk='5', posts='1' where rkbpk='$dt3b[rkbpk]'");
}*/
}
/*sinkron status readyforpo(rkb)*/
$cari4=mysqli_query($koneksi,"select rkb.rkbpk FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
where ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord' and rkb.status='1' and rkb.pocons>0");
while($dt4=mysqli_fetch_array($cari4)){
$update1=mysqli_query($koneksi,"update rkb set status='2' where rkbpk='$dt4[rkbpk]'");
}
/*sinkron status inprogress(rkb)*/
$cari5=mysqli_query($koneksi,"select rkb.rkbpk FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
where ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord' and rkb.status is null");
while($dt5=mysqli_fetch_array($cari5)){
$update1=mysqli_query($koneksi,"update rkb set status='1' where rkbpk='$dt5[rkbpk]'");
}
?>