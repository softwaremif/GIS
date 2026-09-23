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
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'logchange';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
$importpkb = isset($_POST['importpkb']) ? ($_POST['importpkb']) : false;

$offset = ($page - 1) * $rows;

$rs = mysqli_query($koneksi, "SELECT datelog, logchange FROM
(SELECT logdate4 AS datelog, lognm AS logchange
FROM logim4
WHERE importpk='$importpkb'
UNION
SELECT logdate1 AS datelog, logvassal AS logchange
FROM logim1
WHERE importpk='$importpkb'
UNION
SELECT logdate2 AS datelog, logd AS logchange
FROM logim2
WHERE importpk='$importpkb'
UNION
SELECT logdate2 AS datelog, logamount AS logchange
FROM logim2
WHERE importpk='$importpkb'
UNION
SELECT logdate2 AS datelog, loggw AS logchange
FROM logim2
WHERE importpk='$importpkb'
UNION
SELECT logdate3 AS datelog, logetd AS logchange
FROM logim3
WHERE importpk='$importpkb'
UNION
SELECT logdate3 AS datelog, logeta AS logchange
FROM logim3
WHERE importpk='$importpkb'
UNION
SELECT logdate3 AS datelog, logeih AS logchange
FROM logim3
WHERE importpk='$importpkb'
UNION
SELECT logdate1 AS datelog, logtype AS logchange
FROM logim1
WHERE importpk='$importpkb') AS test
WHERE logchange IS NOT NULL
ORDER BY $sort $order");

$result = array();
$result['total'] = mysqli_num_rows(mysqli_query($koneksi, "SELECT datelog, logchange FROM
(SELECT logdate1 AS datelog, logtype AS logchange
FROM logim1
WHERE importpk='$importpkb'
UNION
SELECT logdate1 AS datelog, logvassal AS logchange
FROM logim1
WHERE importpk='$importpkb'
UNION
SELECT logdate2 AS datelog, logd AS logchange
FROM logim2
WHERE importpk='$importpkb'
UNION
SELECT logdate2 AS datelog, logamount AS logchange
FROM logim2
WHERE importpk='$importpkb'
UNION
SELECT logdate2 AS datelog, loggw AS logchange
FROM logim2
WHERE importpk='$importpkb'
UNION
SELECT logdate3 AS datelog, logetd AS logchange
FROM logim3
WHERE importpk='$importpkb'
UNION
SELECT logdate3 AS datelog, logeta AS logchange
FROM logim3
WHERE importpk='$importpkb'
UNION
SELECT logdate3 AS datelog, logeih AS logchange
FROM logim3
WHERE importpk='$importpkb') AS test
WHERE logchange IS NOT NULL"));
$row = array();

$k = $offset;

while ($data = mysqli_fetch_array($rs)) {
    $k++;

    $row[] = array(
        'no' => $k,
        'datelog' => $data['datelog'],
        'logchange' => $data['logchange']);
}
$result = array_merge($result, array('rows' => $row));
echo json_encode($result);
?>
