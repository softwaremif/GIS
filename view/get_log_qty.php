<?php

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/tanggal.php";
include "../config/tanggal2.php";

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'logdtime';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
$ordpk = isset($_GET['ordpk']) ? ($_GET['ordpk']) : false;

$offset = ($page - 1) * $rows;

$rs = mysqli_query($koneksi, "SELECT * FROM logtran WHERE ordpk='$ordpk' AND bdownpk IS NOT NULL AND bdownpk <> '' ORDER BY $sort $order");

$result = array();
$result['total'] = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM logtran WHERE ordpk='$ordpk' AND bdownpk IS NOT NULL AND bdownpk <> ''"));
$row = array();
$k = $offset;
while ($data = mysqli_fetch_array($rs)) {
    $k++;
    $row[] = array(
        'no' => $k,
        'datelog' => tglu($data['logdtime']),
        'action' => $data['lognote']);
}
$result = array_merge($result, array('rows' => $row));
echo json_encode($result);
?>