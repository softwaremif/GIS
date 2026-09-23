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


$offset = ($page-1) * $rows;

if($cari1<>""){
$and1="and concat(ord.ordno,rpo.item,sup.supnm) like '%$cari1%'";
}

if($cari2>1){
$and3="and byr.byrpk='$cari2'";   
}

if($cari3>1){
$and4="and YEAR(rpo.tgl)='$cari3'";   
} else {
$and4="and YEAR(rpo.tgl)='$thn'";
}

$cr=mysqli_query($koneksi,"select * from user where userpk='$user'");
$dt=mysqli_fetch_array($cr);

if($dt['spv']==1){ $and2="and fu.fupk='$dt[fupk]'"; }
else { $and2="and ord.userpk='$dt[userpk]'"; }

$result = mysqli_num_rows(mysqli_query($koneksi,"SELECT *  FROM rpo
LEFT OUTER JOIN ord ON ord.ordpk=rpo.ordpk
LEFT OUTER JOIN fu ON fu.fupk=ord.fupk
LEFT OUTER JOIN sup ON sup.suppk=rpo.suppk
LEFT OUTER JOIN cur ON  cur.curpk=rpo.curpk
left outer join byr on byr.byrpk=ord.byrpk
WHERE rpo.stspk='1' and rpo.popros='0' and rpo.popk='0' and rpo.suppk='1949' $and1 $and2 $and3 $and4"));

echo $result;
?>
