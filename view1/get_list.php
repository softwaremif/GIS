<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
$thn=DATE('Y');
$thn2=$thn-2;
$thn2b=$thn2-2000;

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'ordpk';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
$cari1 = isset($_POST['cari1']) ? ($_POST['cari1']) : false;
$cari2 = isset($_POST['cari2']) ? ($_POST['cari2']) : false;
$cari3 = isset($_POST['cari3']) ? ($_POST['cari3']) : false;
$cari4 = isset($_POST['cari4']) ? ($_POST['cari4']) : false;
$cari5 = isset($_POST['cari5']) ? ($_POST['cari5']) : false;

$offset = ($page-1) * $rows;

if($cari4==1){ $order="DESC"; } 
if($cari5==1){ $order="ASC"; }
else { $order="DESC"; }

if($cari1){ $and1="and concat(ord.ordno,byr.byrnm,ord.prodes,ord.season) like '%$cari1%'"; }
if($cari2>0){ $and2="and user.userpk='$cari2'"; }
if($cari3){ $and3="and ord.season like '%$cari3%'"; }

$rs = mysqli_query($koneksi,"select byr.byrnm, fu.funm, ord.srno, ord.ordpk, ord.ordno, ord.artno, ord.prodes,
ord.season, ord.buymonth, ord.deldate, ord.codate, ord.filenm, byr.byrpk, CONCAT(UPPER(SUBSTRING(user.login,1,1)),LOWER(SUBSTRING(user.login,2))) as login,
user.userpk,user.password,user.username,ord.fupk
FROM ord
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
left outer join user on user.userpk=ord.userpk
where ord.fupk='$_SESSION[fu]' and YEAR(ord.datecreate)>='$thn2'  $and1 $and2 $and3
ORDER BY $sort $order
LIMIT $rows OFFSET $offset");

$result = array();
$result['total'] = mysqli_num_rows(mysqli_query($koneksi,"select byr.byrnm, fu.funm, ord.srno, ord.ordpk, ord.ordno, ord.artno, ord.prodes,
ord.season, ord.buymonth, ord.deldate, ord.codate, ord.filenm, byr.byrpk, CONCAT(UPPER(SUBSTRING(user.login,1,1)),LOWER(SUBSTRING(user.login,2))) as login,
user.userpk,user.password,user.username,ord.fupk
FROM ord
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
left outer join user on user.userpk=ord.userpk
where ord.fupk='$_SESSION[fu]' and YEAR(ord.datecreate)>='$thn2' $and1 $and2 $and3"));
$row = array();

$k =$offset;

while($data=mysqli_fetch_array($rs)){
$k++;

if($data['login']==""){
    $handle="<span style='background-color: #BDBDBD;border-radius: 4px;color: #FFFFFF;font-size: 14px;'>&nbsp; Unssigned &nbsp;</span>";
    //$handle="Unssigned";
} else {
    $handle=$data['login'];
}

$username2=substr($data['username'],0,-13);

$row[] = array(
'no'=>$k,
'ordno'=>$data['ordno'],
'ordpk'=>$data['ordpk'],
'artno'=>$data['artno'],
'byrnm'=>$data['byrnm'],
'season'=>$data['season'],
'prodes'=>$data['prodes'],
'userpk'=>$data['userpk'],
'md2'=>$data['login'],
'login'=>$data['login'],
'fupk'=>$data['fupk'],
'username'=>$data['username'],
'username2'=>$username2,
'password'=>$data['password'],
'handle'=>$handle);
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
?>
