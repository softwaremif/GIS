<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/tanggal.php";
//include "../action/sinkron2.php";

$bln=date("m");
$thn=date("Y");

$cari1 = $_POST['cari1'];
$cari2 = $_GET['cari2']; 
$cari3 = $_GET['cari3'];
$user = $_GET['user'];


if($cari1<>""){
$and1="and concat(po.pono,po.brg,sup.supnm) like '%$cari1%'";
}

if($cari2>1){
$and3="and byr.byrpk='$cari2'";   
}

if($cari3>1){
$and4="and YEAR(po.tglpo)='$cari3'";   
} else {
$and4="and YEAR(po.tglpo)='$thn'";
}

$cr=mysqli_query($koneksi,"select * from user
left outer join fu on fu.fupk=user.fupk
where user.userpk='$user'");
$dt=mysqli_fetch_array($cr);

if($dt['spv']==1){ $and2="and fu.fupk='$dt[fupk]' and po.fu='$dt[funm]'"; }
else { $and2="and ord.userpk='$dt[userpk]' and po.fu='$dt[funm]'"; }

$result= mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM podt
left outer join rpo on rpo.rpopk=podt.rpopk
left outer join po on po.popk=podt.popk
LEFT OUTER JOIN ord ON ord.ordpk=podt.ordpk
LEFT OUTER JOIN fu ON fu.fupk=ord.fupk
LEFT OUTER JOIN sup ON sup.suppk=podt.suppk
LEFT OUTER JOIN cur ON  cur.curpk=podt.curpk
left outer join byr on byr.byrpk=ord.byrpk
WHERE podt.stspk='2' and po.pur is null $and1 $and2 $and3 $and4
group by po.popk"));

echo $result;
?>
