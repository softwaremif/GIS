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

/*$cari2=mysqli_query($koneksi,"select rpo.rkbpk FROM rpo
left outer join ord on ord.ordpk=rpo.ordpk
where YEAR(rpo.tgl)='$thn2' and MONTH(rpo.tgl)>='$bln2' and rpo.stspk is null $and");*/

/*sinkron stspk material(rpo)*/
/*$cari2=mysqli_query($koneksi,"select rpo.rkbpk FROM rpo
left outer join ord on ord.ordpk=rpo.ordpk
where rpo.tgl between '$bln3' and '$hari' and rpo.stspk is null $and");
while($dt2=mysqli_fetch_array($cari2)){
$cari2b=mysqli_query($koneksi,"select rkb.rkbpk, rkb.stspk, rkb.podel FROM rkb where rkbpk='$dt2[rkbpk]'");
$dt2b=mysqli_fetch_array($cari2b);
if($dt2b['stspk']>1){
$update1=mysqli_query($koneksi,"update rkb set submit='1', status='4', stspk='$dt2b[stspk]', rkbsts='1', poreqdel='$dt2b[podel]' where rkbpk='$dt2b[rkbpk]'");
$update2=mysqli_query($koneksi,"update rpo set submit='1', stspk='$dt2b[stspk]', email='1', poreqdel='$dt2b[podel]' where rkbpk='$dt2b[rkbpk]'");
} else {
$update1=mysqli_query($koneksi,"update rkb set submit='1', status='4', stspk='1', rkbsts='1', poreqdel='$dt2b[podel]' where rkbpk='$dt2b[rkbpk]'");
$update2=mysqli_query($koneksi,"update rpo set submit='1', stspk='1', email='1', poreqdel='$dt2b[podel]' where rkbpk='$dt2b[rkbpk]'");
}
}*/

/*$cari3=mysqli_query($koneksi,"select podt.popk, podt.rkbpk FROM podt
left outer join ord on ord.ordpk=podt.ordpk
left outer join po on po.popk=podt.popk
where YEAR(po.tglpo)='$thn2' and MONTH(po.tglpo)='$bln1' and podt.popk>0 $and2");*/

/*sinkron popk material(podt)*/
/*$cari3=mysqli_query($koneksi,"select podt.popk, podt.rkbpk FROM podt
left outer join ord on ord.ordpk=podt.ordpk
left outer join po on po.popk=podt.popk
where po.tglpo between '$bln3' and '$hari' and podt.popk>0 and po.postatpk<=3 $and2");
while($dt3=mysqli_fetch_array($cari3)){
$cari3b=mysqli_query($koneksi,"select rkb.rkbpk, rkb.popk, rkb.stspk, rkb.status FROM rkb where rkbpk='$dt3[rkbpk]'");
$dt3b=mysqli_fetch_array($cari3b);
if($dt3b['stspk']>1){
if($dt3b['status']<>3){
$update1=mysqli_query($koneksi,"update rkb set popk='$dt3[popk]', stspk='$dt3b[stspk]', status='4' where rkbpk='$dt3b[rkbpk]'");
} 
$update2=mysqli_query($koneksi,"update rpo set popk='$dt3[popk]', stspk='$dt3b[stspk]', posts='1' where rkbpk='$dt3b[rkbpk]'");
$update3=mysqli_query($koneksi,"update podt set stspk='$dt3b[stspk]' where rkbpk='$dt3b[rkbpk]'");
} else {
if($dt3b['status']<>3){
$update1=mysqli_query($koneksi,"update rkb set popk='$dt3[popk]', stspk='2', status='4' where rkbpk='$dt3b[rkbpk]'");
}
$update2=mysqli_query($koneksi,"update rpo set popk='$dt3[popk]', stspk='2', posts='1', popros='1' where rkbpk='$dt3b[rkbpk]'");
$update3=mysqli_query($koneksi,"update podt set stspk='2' where rkbpk='$dt3b[rkbpk]'");	
}
}*/

/*podt.popk=0*/
$cari4=mysqli_query($koneksi,"select podt.rkbpk FROM podt
left outer join ord on ord.ordpk=podt.ordpk
where podt.popk=0");
while($dt4=mysqli_fetch_array($cari4)){
$update1=mysqli_query($koneksi,"update rkb set stspk='1', popk=NULL where rkbpk='$dt4[rkbpk]'");
$update2=mysqli_query($koneksi,"update rpo set stspk='1', popros='0', popk=NULL where rkbpk='$dt4[rkbpk]'");
$update3=mysqli_query($koneksi,"delete from podt where rkbpk='$dt4[rkbpk]' and popk='0'");	    
}

/*rpo.popk=0*/
$cari4b=mysqli_query($koneksi,"SELECT * FROM rpo
left outer join ord on ord.ordpk=rpo.ordpk
WHERE rpo.popk='0' AND rpo.popros='1' AND rpo.stspk='2' AND rpo.newdate>'0'");
while($dt4b=mysqli_fetch_array($cari4b)){
$update1b=mysqli_query($koneksi,"update rkb set stspk='1', popk=NULL where rkbpk='$dt4b[rkbpk]'");
$update2b=mysqli_query($koneksi,"update rpo set stspk='1', popros='0', popk=NULL where rkbpk='$dt4b[rkbpk]'");    
}

/*$cari4=mysqli_query($koneksi,"select po.popk, podt.podtpk FROM po
left outer join podt on podt.popk=po.popk
where YEAR(po.tglpo)='$thn2' and MONTH(po.tglpo)='$bln1' and po.pur='$_SESSION[login]'");
while($dt4=mysqli_fetch_array($cari4)){
if($dt4['podtpk']>0){ }
else {
$update1=mysqli_query($koneksi,"update rkb set popk=NULL, stspk='1' where stspk='2' and status='4' and rkbsts='1' and popk='$dt4[popk]'");
$update2=mysqli_query($koneksi,"update rpo set popk=NULL, stspk='1', posts='0', popros='0' where stspk='2' and posts='1' and popros='1' and popk='$dt4[popk]'");
}
}*/
/*$cari4=mysqli_query($koneksi,"select * FROM podt
left outer join ord on ord.ordpk=podt.ordpk
left outer join po on po.popk=podt.popk
where YEAR(po.tglpo)='$thn2' and MONTH(po.tglpo)='$bln1' and podt.stspk='2' and podt.popk>0 $and2");
while($dt4=mysqli_fetch_array($cari4)){
$update1=mysqli_query($koneksi,"update rkb set popk='$dt4[popk]', stspk='2' where rkbpk='$dt4[rkbpk]'");
$update2=mysqli_query($koneksi,"update rpo set popk='$dt4[popk]', stspk='2', posts='1' where rkbpk='$dt4[rkbpk]'");
}*/
?>