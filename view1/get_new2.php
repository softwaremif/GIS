<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/tanggal.php";

$bln=date("m");
$thn=date("Y");

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'fu.funm';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';

$offset = ($page-1) * $rows;

if($_SESSION['mat']==1) { $and3="and rpo.kelnm='CUTTING'"; }
else { $and3="and rpo.kelnm<>'CUTTING'"; }

$rs = mysqli_query($koneksi,"SELECT *  FROM rpo
LEFT OUTER JOIN ord ON ord.ordpk=rpo.ordpk
LEFT OUTER JOIN fu ON fu.fupk=ord.fupk
LEFT OUTER JOIN sup ON sup.suppk=rpo.suppk
LEFT OUTER JOIN cur ON  cur.curpk=rpo.curpk
LEFT OUTER JOIN rkb ON rkb.rkbpk=rpo.rkbpk
WHERE rpo.stspk='1' and ord.fupk<>'' $and3
group by fu.fupk
ORDER BY $sort $order");

$result = array();
$result['total'] = mysqli_num_rows(mysqli_query($koneksi,"SELECT *  FROM rpo
LEFT OUTER JOIN ord ON ord.ordpk=rpo.ordpk
LEFT OUTER JOIN fu ON fu.fupk=ord.fupk
LEFT OUTER JOIN sup ON sup.suppk=rpo.suppk
LEFT OUTER JOIN cur ON  cur.curpk=rpo.curpk
LEFT OUTER JOIN rkb ON rkb.rkbpk=rpo.rkbpk
WHERE rpo.stspk='1' and ord.fupk<>'' $and3
group by fu.fupk"));
$row = array();

while($data=mysqli_fetch_array($rs)){
$row[] = array(
'fupk'=>$data['fupk'],
'funm'=>$data['funm']);
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
?>
