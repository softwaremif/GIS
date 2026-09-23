<!-- <link rel="stylesheet" type="text/css" href="../media/jquery-easyui-1.9.15/themes/gray/easyui.css">
<link rel="stylesheet" type="text/css" href="../media/jquery-easyui-1.9.15/themes/icon.css">
<link rel="stylesheet" type="text/css" href="../media/jquery-easyui-1.9.15/themes/color.css">
<script type="text/javascript" src="../media/jquery-easyui-1.9.15/jquery.min.js"></script>
<script type="text/javascript" src="../media/jquery-easyui-1.9.15/jquery.easyui.min.js"></script> -->
<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/tanggal.php";
include "../config/truncate.php";

$ord = $_GET['ord'];
$sql = mysqli_query($koneksi, "SELECT SUM(tot) AS tot FROM bdown WHERE ordpk='$ord' and tot>'0' and color<>'' AND jenis LIKE '%DETAIL%' GROUP BY ordpk");
$dtsql = mysqli_fetch_array($sql);
$totqty = $dtsql['tot'];

$sqlcur = mysqli_query($koneksi, "select * from cur where curpk='2'");
$dtcur = mysqli_fetch_array($sqlcur);

$sqlc = mysqli_query($koneksi, "select * from costing where ordpk='$ord'");
$dtc = mysqli_fetch_array($sqlc);

if ($_GET['x'] == "sumpo") {
    $result1 = mysqli_num_rows(mysqli_query($koneksi, "select * FROM rkb
left outer join rpo on rpo.rkbpk=rkb.rkbpk
left outer join podt on podt.rkbpk=rkb.rkbpk
left outer join po on po.popk=podt.popk
left outer join ord on ord.ordpk=rkb.ordpk
left outer join sup on sup.suppk=rkb.suppk
left outer join cur on  cur.curpk=rkb.curpk
left outer join importdt on importdt.popk=podt.popk
left outer join import on import.importpk=importdt.importpk
where rkb.spec<>'' and ord.ordpk='$ord'
group by rkb.rkbpk"));

    $result2 = mysqli_num_rows(mysqli_query($koneksi, "select * FROM rkb
left outer join rpo on rpo.rkbpk=rkb.rkbpk
left outer join podt on podt.rkbpk=rkb.rkbpk
left outer join po on po.popk=podt.popk
left outer join ord on ord.ordpk=rkb.ordpk
left outer join sup on sup.suppk=rkb.suppk
left outer join cur on  cur.curpk=rkb.curpk
left outer join importdt on importdt.popk=podt.popk
left outer join import on import.importpk=importdt.importpk
where rkb.spec<>'' and ord.ordpk='$ord' and rkb.status between '4' and '6' and rkb.stspk between '2' and '5'
group by rkb.rkbpk"));

    $result = number_format($result2, 0, ".", ",") . "/" . number_format($result1, 0, ".", ",");
    echo $result;
}
if ($_GET['x'] == "sumreq") {
    $result1 = mysqli_num_rows(mysqli_query($koneksi, "select * FROM rkb
    left outer join rpo on rpo.rkbpk=rkb.rkbpk
    left outer join podt on podt.rkbpk=rkb.rkbpk
    left outer join po on po.popk=podt.popk
    left outer join ord on ord.ordpk=rkb.ordpk
    left outer join sup on sup.suppk=rkb.suppk
    left outer join cur on  cur.curpk=rkb.curpk
    left outer join importdt on importdt.popk=podt.popk
    left outer join import on import.importpk=importdt.importpk
    where rkb.spec<>'' and ord.ordpk='$ord'
    group by rkb.rkbpk"));

    $result2 = mysqli_num_rows(mysqli_query($koneksi, "select * FROM rkb
    left outer join rpo on rpo.rkbpk=rkb.rkbpk
    left outer join podt on podt.rkbpk=rkb.rkbpk
    left outer join po on po.popk=podt.popk
    left outer join ord on ord.ordpk=rkb.ordpk
    left outer join sup on sup.suppk=rkb.suppk
    left outer join cur on  cur.curpk=rkb.curpk
    left outer join importdt on importdt.popk=podt.popk
    left outer join import on import.importpk=importdt.importpk
    where rkb.spec<>'' and ord.ordpk='$ord' and rkb.status between '4' and '6' and rkb.stspk between '1' and '5'
    group by rkb.rkbpk"));

    $result = number_format($result2, 0, ".", ",") . "/" . number_format($result1, 0, ".", ",");
    echo $result;
}
if ($_GET['x'] == "cost1") {
    if ($dtc['costpk'] > 0) {
        $cost = $dtc['CM'] + $dtc['materials'] + $dtc['others'];
        $totcost = $dtcur['cursign'] . number_format($cost, 2, ".", ",");
    } else {
        $totcost = "<span style='color:#00000061;font-weight:400;'>N/A</span>";
    }
    echo $totcost;
}
if ($_GET['x'] == "cost2") {
    if ($dtc['costpk'] > 0) {
        $cost1 = $dtc['materials'] * $totqty;
        $cost2 = $dtcur['cursign'] . number_format($cost1, 2, ".", ",");
        $totcost = "<a href='javascript:void(0)' style='text-decoration:none; color:#000000;cursor:default;' title='$cost2' class='easyui-tooltip'>"
            . truncate($cost2, 10) .
            "</a>";
    } else {
        $totcost = "<span style='color:#00000061;font-weight:400;'>N/A</span>";
    }
    echo $totcost;
}
if ($_GET['x'] == "bqty") {
    echo "(" . number_format($totqty, 0, ".", ",") . ")";
}
?>