<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/tanggal.php";
$cari1 = $_POST['cari1'];
$cari2 = $_GET['cari2']; 
$cari3 = $_GET['cari3'];
$ord   = $_GET['ord'];
$type0 = $_GET['type0'];
$type1 = $_GET['type1'];
$spec0 = $_GET['spec0'];
$spec1 = $_GET['spec1'];
$col0  = $_GET['col0'];
$col1  = $_GET['col1'];

//type
if($type0==''){
$atype = array($type1);
}else if($type1==''){
$atype = array($type0);
}else{
$atype=array($type0,$type1);
}
$itype = implode("', '",$atype);

//spec
if($spec0==''){
$aspec = array($spec1);
}else if($spec1==''){
$aspec = array($spec0);
}else{
$aspec=array($spec0,$spec1);
}
$ispec = implode("', '",$aspec);

//color
if($col0==''){
$acol = array($col1);
}else if($col1==''){
$acol = array($col0);
}else{
$acol=array($col0,$col1);
}
$icol = implode("', '",$acol);

if($cari1<>""){
$and1="and concat(rkb.item,sup.supnm,rkb.spec,rkb.unit,rkb.colname,po.pono) like '%$cari1%'";
}
if($cari2<>""){ $and2="and po.postatpk='$cari2'"; }
if($cari3<>""){ $and3="and sup.supnm like '%$cari3%'"; }

if($type0<>"" || $type1<>""){
//$csupp="and sup.supnm LIKE '%$supp0%' or sup.supnm LIKE '%$supp1%'";
$ctype="and rkb.item IN ('$itype')";
}
if($spec0<>"" || $spec1<>""){
$cspec="and rkb.spec IN ('$ispec')";
}
if($col0<>"" || $col1<>""){
$ccol="and rkb.colname IN ('$icol')";
}

$result = mysqli_num_rows(mysqli_query($koneksi,"select * FROM rkb
left outer join rpo on rpo.rkbpk=rkb.rkbpk
left outer join podt on podt.rkbpk=rkb.rkbpk
left outer join po on po.popk=podt.popk
left outer join ord on ord.ordpk=rkb.ordpk
left outer join sup on sup.suppk=rkb.suppk
left outer join cur on  cur.curpk=rkb.curpk
where ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord' and rkb.status='6' $and1 $and2 $and3 $ctype $cspec $ccol"));

echo $result;
?>