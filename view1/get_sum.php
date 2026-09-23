<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
//include "../config/koneksi.php";
include "../config/koneksi7.php";
include "../config/tanggal.php";
$thn=DATE('Y');
$thn2=$thn-2;
$thn2b=$thn2-2000;

$bln=date("m");
$thn=date("Y");

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'mkp.tglselesai';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
$cari1 = isset($_POST['cari1']) ? ($_POST['cari1']) : false;
$cari2 = isset($_POST['cari2']) ? ($_POST['cari2']) : false;
$cari3 = isset($_POST['cari3']) ? ($_POST['cari3']) : false;

$offset = ($page-1) * $rows;

if($_SESSION['gusernm']=="admin"){
$and2="";
} else {
$and2="and mkp.funame='$_SESSION[funm]'";   
}

if($cari3){
$and3="and concat(mkp.nokp,mkp.buyer) like '%$cari3%'";
}

if($cari1>0){
$and1="and MONTH(mkp.tglselesai)='$cari1'";
} else {
$and1="";
}

if($cari2>0){ $and="YEAR(mkp.tglselesai)='$cari2'"; }
else { $and="YEAR(mkp.tglselesai)='$thn'"; }

$rs = mysqli_query($koneksi,"select mkp.mkppk,mkp.nokp,mkp.buyer,mkp.tglselesai,mkp.qtyorder,mkp.kurs,mkp.funame,
sum(ship.jml*ship.hrgsat) as jmlhrg
FROM mkp
left outer join ship on ship.mkppk=mkp.mkppk
where $and $and1 $and2 $and3
group by mkp.mkppk ORDER BY $sort $order, mkp.funame asc
LIMIT $rows OFFSET $offset");

$result = array();
$result['total'] = mysqli_num_rows(mysqli_query($koneksi,"select * FROM mkp
left outer join ship on ship.mkppk=mkp.mkppk
where $and $and1 $and2 $and3
group by mkp.mkppk"));
$row = array();

$k =$offset;

while($data=mysqli_fetch_array($rs)){
$k++;

$sql2=mysqli_query($koneksi,"select sum(jpb.jmlhd)/mkp.kurs as jmlhd
FROM jpb
left outer join mkp on mkp.mkppk=jpb.mkppk
where mkp.mkppk='$data[mkppk]' and jpb.nolpb<'2000000'
group by mkp.mkppk");
$x2=mysqli_fetch_array($sql2);

$qty=number_format($data['qtyorder'],0,".",",");
$tglship=tgl($data['tglselesai']);
$pcs=$data['jmlhrg']/$data['qtyorder'];
$fob=number_format($pcs,2,".",",")." "."USD";
$hrg=number_format($data['jmlhrg'],2,".",",")." "."USD";
$cost=$x2['jmlhd'];
$pfob=($cost/$data['jmlhrg'])*100;
$pfob2=number_format($pfob,2,".",",")."%" ;
$cost2=number_format($cost,2,".",",")." "."USD";
$kurs=number_format($data['kurs'],2,".",",");

$row[] = array(
'no'=>$k,
'mkppk'=>$data['mkppk'],
'nokp'=>$data['nokp'],
'buyer'=>$data['buyer'],
'funame'=>$data['funame'],
'tglship'=>$tglship,
'qty'=>$qty,
'kurs'=>$kurs,
'fob'=>$fob,
'hrg'=>$hrg,
'cost'=>$cost2,
'pfob'=>$pfob2);
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
?>
