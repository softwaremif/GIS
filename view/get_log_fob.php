<?php

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/tanggal.php";
include "../config/tanggal2.php";
$thn = DATE('Y');
$thn2 = $thn - 2;
$thn2b = $thn2 - 2000;

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'logdtime';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
$ordpk = isset($_GET['ordpk']) ? ($_GET['ordpk']) : false;

$offset = ($page - 1) * $rows;

$rs = mysqli_query($koneksi,"select * from logcost
where ordpk='$ordpk'
ORDER BY $sort $order");

$result = array();
$result['total'] = mysqli_num_rows(mysqli_query($koneksi, "select * from logcost
where ordpk='$ordpk'"));
$row = array();

$k = $offset;

while ($data = mysqli_fetch_array($rs)) {
    $k++;

    $row[] = array(
        'no' => $k,
        'datelog' => tglu($data['logdtime']),
        'cm' => "$".$data['cm'],
        'mat' => "$".$data['mat'],
        'other' => "$".$data['other']);
}
$result = array_merge($result, array('rows' => $row));
echo json_encode($result);
?>
