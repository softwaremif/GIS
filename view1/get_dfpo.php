<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/tanggal.php";

$bln = date("m");
$thn = date("Y");

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
//$rows = isset($_GET['rows']) ? intval($_GET['rows']) : false;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'po.tglpo';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
$cari1 = isset($_POST['cari1']) ? ($_POST['cari1']) : false;
$cari2 = isset($_POST['cari2']) ? ($_POST['cari2']) : false;
$cari3 = isset($_POST['cari3']) ? ($_POST['cari3']) : false;
$cari4 = isset($_POST['cari4']) ? ($_POST['cari4']) : false;
$cari5 = isset($_POST['cari5']) ? ($_POST['cari5']) : false;
$cari6 = isset($_POST['cari6']) ? ($_POST['cari6']) : false;
$item0 = isset($_POST['item0']) ? ($_POST['item0']) : false;
$item1 = isset($_POST['item1']) ? ($_POST['item1']) : false;
$supp0 = isset($_POST['supp0']) ? ($_POST['supp0']) : false;
$supp1 = isset($_POST['supp1']) ? ($_POST['supp1']) : false;
$col0 = isset($_POST['col0']) ? ($_POST['col0']) : false;
$col1 = isset($_POST['col1']) ? ($_POST['col1']) : false;

$offset = ($page - 1) * $rows;

//item
if ($item0 == '') {
    $aitem = array($item1);
} else if ($item1 == '') {
    $aitem = array($item0);
} else {
    $aitem = array($item0, $item1);
}
$iitem = implode("', '", $aitem);

//supplier
if ($supp0 == '') {
    $asupp = array($supp1);
} else if ($supp1 == '') {
    $asupp = array($supp0);
} else {
    $asupp = array($supp0, $supp1);
}
$isupp = implode("', '", $asupp);

//color
if ($col0 == '') {
    $acol = array($col1);
} else if ($col1 == '') {
    $acol = array($col0);
} else {
    $acol = array($col0, $col1);
}
$icol = implode("', '", $acol);

if ($cari3 == 1) {
    $order = "DESC";
}
if ($cari4 == 1) {
    $order = "ASC";
} else {
    $order = "DESC";
}

if ($cari1) {
    $and1 = "AND CONCAT(fu.funm, byr.byrnm, po.pono, po.brg, sup.supnm) LIKE '%$cari1%'";

    $and4 = "";

    $and5 = "";
    
} else {
    $and1 = "";

    if ($cari5 > 0) {
        $and4 = "AND MONTH(po.tglpo)='$cari5'";
    } else {
        $and4 = "and MONTH(po.tglpo)='$bln'";
    }

    if ($cari6 > 0) {
        $and5 = "AND YEAR(po.tglpo)='$cari6'";
    } else {
        $and5 = "and YEAR(po.tglpo)='$thn'";
    }
}

if ($cari2 > 0) {
    $and2 = "and fu.fupk='$cari2'";
}

if ($item0 <> "" || $item1 <> "") {
    $citem = "and po.brg IN ('$iitem')";
}
if ($supp0 <> "" || $supp1 <> "") {
    $csupp = "and sup.supnm IN ('$isupp')";
}
if ($col0 <> "" || $col1 <> "") {
    $ccol = "and podt.colname IN ('$icol')";
}

// if ($cari5 > 0) {
//     $and4 = "and MONTH(po.tglpo)='$cari5'";
// } else {
//     $and4 = "and MONTH(po.tglpo)='$bln'";
// }

// if ($cari6 > 0) {
//     $and5 = "and YEAR(po.tglpo)='$cari6'";
// } else {
//     $and5 = "and YEAR(po.tglpo)='$thn'";
// }

if ($_SESSION['leader'] > 0) {
    $lead = "and fu.team='$_SESSION[leader]'";
}

$rs = mysqli_query($koneksi, "SELECT ord.ordpk, ord.ordno, fu.fupk, fu.funm, sup.suppk, sup.supnm, podt.rpopk, podt.rkbpk,
po.pono, po.brg, po.tgldel, po.postatpk, po.popk, sum(podt.pocons) as pocons, podt.unit, podt.item, podt.colname, SUM(podt.price*podt.pocons) as price,
cur.curpk, cur.curid , po.etd, po.tglpo, byr.byrnm
FROM po
left outer join sup on sup.suppk=po.suppk
left outer join podt on podt.popk=po.popk
left outer join cur on cur.curpk=podt.curpk
left outer join ord on ord.ordpk=podt.ordpk
left outer join fu on fu.fupk=ord.fupk
left outer join byr on byr.byrpk=ord.byrpk
-- left outer join rkb on rkb.rkbpk=podt.rkbpk
-- left outer join rpo on rpo.rpopk=podt.rpopk
WHERE po.postatpk between '1' and '4' $and1 $and2 $and4 $and5 $lead $citem $csupp $ccol
group by po.popk
ORDER BY $sort $order, po.tgldel desc LIMIT $rows OFFSET $offset");
$result = array();
$result['total'] = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM po
left outer join sup on sup.suppk=po.suppk
left outer join cur on  cur.curpk=po.curpk
left outer join podt on podt.popk=po.popk
left outer join ord on ord.ordpk=podt.ordpk
left outer join fu on fu.fupk=ord.fupk
left outer join byr on byr.byrpk=ord.byrpk
-- left outer join rkb on rkb.rkbpk=podt.rkbpk
-- left outer join rpo on rpo.rpopk=podt.rpopk
WHERE po.postatpk between '1' and '4' $and1 $and2 $and4 $and5 $lead $citem $csupp $ccol
group by po.popk"));
$row = array();
$k = $offset;
while ($data = mysqli_fetch_array($rs)) {
    $k++;
    //$btn = '<a href="#" style="text-decoration:none;">GET</a>';
    if ($data['postatpk'] == 1) {
        $sts = "Awaiting PI";
    } else if ($data['postatpk'] == 2) {
        $sts = "In Revision";
    } else if ($data['postatpk'] == 3) {
        $sts = "PO Cancel";
    } else if ($data['postatpk'] == 4) {
        $sts = "Purchased";
    } else {
        $sts = "Awaiting PI";
    }

    if ($data['curid'] == "IDR") {
        if ($data['price'] == "0.00000" || $data['price'] == "") {
            $price = "-";
            $total = "-";
        } else {
            $price = number_format($data['price'], 2, ".", ",") . " " . $data['curid'];
            $tot = $data['price'] * $data['pocons'];
            $total = $data['curid'] . " " . number_format($tot, 2, ".", ",");
        }
    } else {
        if ($data['price'] == "0.00000" || $data['price'] == "") {
            $price = "-";
            $total = "-";
        } else {
            $price = number_format($data['price'], 2, ".", ",") . " " . $data['curid'];
            $tot = $data['price'] * $data['pocons'];
            $total = $data['curid'] . " " . number_format($tot, 2, ".", ",");
        }
    }

    $pocons1 = ceil($data['pocons']);
    $pocons = number_format($pocons1, 0, ".", ",");

    // if ($data['tgljam'] == "0000-00-00 00:00:00") {
    //     $tgljam = "";
    //     $tgljam2 = "";
    // } else {
    //     if ($data['tgljam'] == "") {
    //         $tgljam = "";
    //         $tgljam2 = "";
    //     } else {
    //         $tgljam = $data['tgljam'];
    //         $tgljam2 = tgl($data['tgljam']);
    //     }
    // }

    if ($data['tgldel'] == "0000-00-00") {
        $tgldel = "";
        $tgldel2 = "";
    } else {
        if ($data['tgldel'] == "") {
            $tgldel = "";
            $tgldel2 = "";
        } else {
            $tgldel = $data['tgldel'];
            $tgldel2 = tgl($data['tgldel']);
        }
    }

    if ($data['etd'] == "0000-00-00") {
        $etd = "";
        $etd2 = "";
    } else {
        if ($data['etd'] == "") {
            $etd = "";
            $etd2 = "";
        } else {
            $etd = $data['etd'];
            $etd2 = tgl($data['etd']);
        }
    }

    if ($data['tglpo'] == "0000-00-00") {
        $tglpo = "";
        $tglpo2 = "";
    } else {
        if ($data['tglpo'] == "") {
            $tglpo = "";
            $tglpo2 = "";
        } else {
            $tglpo = $data['tglpo'];
            $tglpo2 = tgl($data['tglpo']);
        }
    }

    $row[] = array(
        'no' => $k,
        'ordpk' => $data['ordpk'],
        'ordno' => $data['ordno'],
        'fupk' => $data['fupk'],
        'funm' => $data['funm'],
        'byrnm' => $data['byrnm'],
        'suppk' => $data['suppk'],
        'supnm' => $data['supnm'],
        // 'rpopk' => $data['rpopk'],
        'rkbpk' => $data['rkbpk'],
        'popk' => $data['popk'],
        'pono' => $data['pono'],
        'brg' => $data['item'],
        'pocons' => $pocons,
        'unit' => $data['unit'],
        'colname' => $data['colname'],
        'price' => $price,
        'price2' => $data['price'],
        'curpk' => $data['curpk'],
        'curid' => $data['curid'],
        'status' => $sts,
        // 'tgljam' => $tgljam,
        // 'tgljam2' => $tgljam2,
        'tgldel' => $tgldel,
        'tgldel2' => $tgldel2,
        'etd' => $etd,
        'etd2' => $etd2,
        'tglpo' => $tglpo,
        'tglpo2' => $tglpo2
    );
}
$result = array_merge($result, array('rows' => $row));
echo json_encode($result);

?>