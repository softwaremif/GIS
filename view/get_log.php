<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
$bln=DATE('m');
$thn=DATE('Y');
$thn2=$thn-2;
$thn2b=$thn2-2000;

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'logtran.logdtime';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
$cari1  = isset($_POST['cari1']) ? ($_POST['cari1']) : false;
$cari2 = isset($_POST['cari2']) ? ($_POST['cari2']) : false;
$cari3 = isset($_POST['cari3']) ? ($_POST['cari3']) : false;
$cari4 = isset($_POST['cari4']) ? ($_POST['cari4']) : false;
$cari5 = isset($_POST['cari5']) ? ($_POST['cari5']) : false;

$offset = ($page-1) * $rows;

if($cari1){ $and1="and concat(ord.ordno,rkb.item,logtran.lognote) like '%$cari1%'"; }

if($cari4<>''){ $and4="and logtran.lognote like '%$cari4%'"; }

if($cari5<>''){ $and5="and logtran.lognote like '%$cari5%'"; }

if($cari2>0){ $and2="and MONTH(logtran.logdate)='$cari2'"; }
else { $and2="and MONTH(logtran.logdate)='$bln'"; } 

if($cari3>0){ $and3="where YEAR(logtran.logdate)='$cari3'"; }
else { $and3="where YEAR(logtran.logdate)='$thn'"; }

$rs = mysqli_query($koneksi,"select logtran.logdtime, logtran.logdate, logtran.logtime, logtran.logip, logtran.lognote,
logtran.sistem, ord.ordno, rkb.item, CONCAT(UPPER(SUBSTRING(user.login,1,1)),LOWER(SUBSTRING(user.login,2))) as login,
CONCAT(UPPER(SUBSTRING(fu.funm,1,1)),LOWER(SUBSTRING(fu.funm,2))) as funm, user.userpk
from logtran
left outer join ord on ord.ordpk=logtran.ordpk
left outer join rkb on rkb.rkbpk=logtran.rkbpk
left outer join user on user.userpk=ord.userpk
left outer join fu on fu.fupk=ord.fupk
$and3 $and1 $and2 $and4 $and5
ORDER BY $sort $order
LIMIT $rows OFFSET $offset");

$result = array();
$result['total'] = mysqli_num_rows(mysqli_query($koneksi,"select * from logtran
left outer join ord on ord.ordpk=logtran.ordpk
left outer join rkb on rkb.rkbpk=logtran.rkbpk
left outer join user on user.userpk=ord.userpk
left outer join fu on fu.fupk=ord.fupk
$and3 $and1 $and2 $and4 $and5"));
$row = array();

$k =$offset;

while($data=mysqli_fetch_array($rs)){
$k++;

if($data['userpk']>0){ $user=$data['login']; }
else { $user=$data['funm']; }

$row[] = array(
'no'=>$k,
'logdtime'=>$data['logdtime'],
'logdate'=>$data['logdate'],
'logtime'=>$data['logtime'],
'logip'=>$data['logip'],
'lognote'=>$data['lognote'],
'ordno'=>$data['ordno'],
'user'=>$user,
'item'=>$data['item'],
'sistem'=>$data['sistem']);
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
?>
