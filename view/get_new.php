<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/tanggal.php";
//include "../action/sinkron2.php";
mysqli_set_charset($koneksi, "utf8mb4");
$bln = date("m");
$thn = date("Y");

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 4000;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'rpo.tgljam';
//$order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
$cari1 = isset($_POST['cari1']) ? ($_POST['cari1']) : false;
$cari2 = isset($_POST['cari2']) ? ($_POST['cari2']) : false;
$cari3 = isset($_POST['cari3']) ? ($_POST['cari3']) : false;
$cari4 = isset($_POST['cari4']) ? ($_POST['cari4']) : false;
$cari5 = isset($_POST['cari5']) ? ($_POST['cari5']) : false;
$cari6 = isset($_POST['cari6']) ? ($_POST['cari6']) : false;
$cari7 = isset($_POST['cari7']) ? ($_POST['cari7']) : false;
$supp0 = isset($_POST['supp0']) ? ($_POST['supp0']) : false;
$supp1 = isset($_POST['supp1']) ? ($_POST['supp1']) : false;
$col0 = isset($_POST['col0']) ? ($_POST['col0']) : false;
$col1 = isset($_POST['col1']) ? ($_POST['col1']) : false;
$spec0 = isset($_POST['spec0']) ? ($_POST['spec0']) : false;
$spec1 = isset($_POST['spec1']) ? ($_POST['spec1']) : false;

$offset = ($page - 1) * $rows;

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

//spec
if ($spec0 == '') {
    $aspec = array($spec1);
} else if ($spec1 == '') {
    $aspec = array($spec0);
} else {
    $aspec = array($spec0, $spec1);
}
$ispec = implode("', '", $aspec);

if ($cari3 == 1) {
    $order = "DESC";
}
if ($cari4 == 1) {
    $order = "ASC";
} else {
    $order = "DESC";
}

// if ($cari1 <> "") {
//     $and1 = "and concat(fu.funm,ord.ordno,rpo.item,rpo.spec,sup.supnm,byr.byrnm) like '%$cari1%'";
// }

$and1 = "";
if ($cari1) {
    $cari1_values = explode(";", $cari1);
    $multiple_search = [];

    foreach ($cari1_values as $value) {
        $trimmed_value = trim($value);
        $multiple_search[] = "concat(fu.funm,ord.ordno,rpo.item,rpo.spec,sup.supnm,byr.byrnm) like '%$trimmed_value%'";
    }

    $and1 = "AND (" . implode(" OR ", $multiple_search) . ")";
}

if ($_SESSION['mat'] == 1) {
    // $and3 = "and rpo.kelnm='CUTTING'";
    $and3 = "and (rpo.kelnm LIKE '%CUTTING%' or rpo.kelnm LIKE '%JASA%')";
} else if ($_SESSION['mat'] == 2) {
    // $and3 = "and rpo.kelnm<>'CUTTING'";
    $and3 = "and (rpo.kelnm LIKE '%SEWING%' or rpo.kelnm LIKE '%FINISHING%')";
} 

if ($cari5 > 0) {
    //if($cari1<>""){ $and4=""; }
//else {
    $and4 = "and MONTH(rpo.tgl)='$cari5'";
    //}
} else {
    //if($cari1<>""){
    $and4 = "";
    //}
//else { $and4="and MONTH(po.tglpo)='$bln'"; }
}

if ($cari6 > 0) {
    $and5 = "and YEAR(rpo.tgl)='$cari6'";
} else {
    $and5 = "and YEAR(rpo.tgl)='$thn'";
}

if ($cari7) {
    $and6 = "and rpo.kelnm like '%$cari7%'";
} 
// else {
//     if ($_SESSION['mat'] == 1) {
//         $and6 = "";
//     } else {
//         $and6 = "and rpo.kelnm like '%SEWING%'";
//     }
// }

if ($cari2 > 0) {
    $and2 = "and fu.fupk='$cari2'";
}
//else { $and2="and fu.fupk='$data2[fupk]'"; }

if ($supp0 <> "" || $supp1 <> "") {
    //$csupp="and sup.supnm LIKE '%$supp0%' or sup.supnm LIKE '%$supp1%'";
    $csupp = "and sup.supnm IN ('$isupp')";
}
if ($col0 <> "" || $col1 <> "") {
    $ccol = "and rpo.colname IN ('$icol')";
}
if ($spec0 <> "" || $spec1 <> "") {
    $cspec = "and rpo.spec IN ('$ispec')";
}


/*rpo.popk>0 & stspk=1*/
$cari4a = mysqli_query($koneksi, "select rpo.rkbpk FROM rpo
left outer join ord on ord.ordpk=rpo.ordpk
where rpo.popk>'0' and rpo.stspk='1' and rpo.popros='0'");
while ($dt4a = mysqli_fetch_array($cari4a)) {
    $cr = mysqli_query($koneksi, "select rkbpk,stspk from podt where rkbpk='$dt4a[rkbpk]'");
    $dt = mysqli_fetch_array($cr);
    if ($dt['stspk'] == 2) {
        $update1a = mysqli_query($koneksi, "update rkb set stspk='2' where rkbpk='$dt[rkbpk]'");
        $update2a = mysqli_query($koneksi, "update rpo set stspk='2', popros='1' where rkbpk='$dt[rkbpk]'");
    }
}

/*podt.popk=0*/
$cari4 = mysqli_query($koneksi, "select podt.rkbpk FROM podt
left outer join ord on ord.ordpk=podt.ordpk
where podt.popk='0'");
while ($dt4 = mysqli_fetch_array($cari4)) {
    $update1 = mysqli_query($koneksi, "update rkb set stspk='1', popk=NULL where rkbpk='$dt4[rkbpk]'");
    $update2 = mysqli_query($koneksi, "update rpo set stspk='1', popros='0', popk='0' where rkbpk='$dt4[rkbpk]'");
    $update3 = mysqli_query($koneksi, "delete from podt where rkbpk='$dt4[rkbpk]' and popk='0'");
}

/*rpo.popk=0*/
$cari4b = mysqli_query($koneksi, "SELECT * FROM rpo
left outer join ord on ord.ordpk=rpo.ordpk
WHERE rpo.popk='0' AND rpo.popros='1' AND rpo.stspk='2' AND rpo.newdate>'0'");
while ($dt4b = mysqli_fetch_array($cari4b)) {
    $update1b = mysqli_query($koneksi, "update rkb set stspk='1', popk=NULL where rkbpk='$dt4b[rkbpk]'");
    $update2b = mysqli_query($koneksi, "update rpo set stspk='1', popros='0', popk='0' where rkbpk='$dt4b[rkbpk]'");
}

$rs = mysqli_query($koneksi, "SELECT *  FROM rpo
LEFT OUTER JOIN ord ON ord.ordpk=rpo.ordpk
LEFT OUTER JOIN fu ON fu.fupk=ord.fupk
LEFT OUTER JOIN sup ON sup.suppk=rpo.suppk
LEFT OUTER JOIN cur ON  cur.curpk=rpo.curpk
left outer join byr on byr.byrpk=ord.byrpk
WHERE rpo.stspk='1' and rpo.popros='0' and rpo.popk='0' and ord.fupk<>'' and rpo.rkbpk<>'' and rpo.item<>'' $and1 $and2 $and3 $and4 $and5 $and6 $csupp $ccol $cspec
ORDER BY $sort $order, fu.funm asc, rpo.item asc
LIMIT $rows OFFSET $offset");

$result = array();
$result['total'] = mysqli_num_rows(mysqli_query($koneksi, "SELECT *  FROM rpo
LEFT OUTER JOIN ord ON ord.ordpk=rpo.ordpk
LEFT OUTER JOIN fu ON fu.fupk=ord.fupk
LEFT OUTER JOIN sup ON sup.suppk=rpo.suppk
LEFT OUTER JOIN cur ON  cur.curpk=rpo.curpk
left outer join byr on byr.byrpk=ord.byrpk
WHERE rpo.stspk='1' and rpo.popros='0' and rpo.popk='0' and ord.fupk<>'' and rpo.rkbpk<>'' and rpo.item<>'' $and1 $and2 $and3 $and4 $and5 $and6 $csupp $ccol $cspec"));
$row = array();

$k = $offset;
mysqli_set_charset($koneksi, "utf8mb4");
while ($data = mysqli_fetch_array($rs)) {
    $k++;

    // $dt2 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT pono FROM po WHERE polipk='3' order by popk desc limit 1"));

    // $lastNo = $dt2['pono'] ?? '';

    // if ($lastNo != '') {
    //     $angka = (int) substr($lastNo, 2);
    //     $next  = $angka + 1;
    // } else {
    //     $next = 1;
    // }

    //$snno = 'SN' . str_pad($next, 7, '0', STR_PAD_LEFT);

    //$btn = '<a href="javascript:void(0)" style="text-decoration:none;">GET</a>';
    if ($data['curid'] == "IDR") {
        if ($data['price'] == "0.00000") {
            $price = "-";
            $total = "-";
        } else {
            $price = number_format($data['price'], 2, ".", ",") . " " . $data['curid'];
            $tot = $data['price'] * $data['pocons'];
            $total = $data['curid'] . " " . number_format($tot, 2, ".", ",");
        }
    } else {
        if ($data['price'] == "0.00000") {
            $price = "-";
            $total = "-";
        } else {
            $price = number_format($data['price'], 5, ".", ",") . " " . $data['curid'];
            $tot = $data['price'] * $data['pocons'];
            $total = $data['curid'] . " " . number_format($tot, 5, ".", ",");
        }
    }

    $qty = number_format($data['bdownqty'], 0, ".", ",");
    $pocons1 = ceil($data['pocons']);
    $pocons = number_format($pocons1, 0, ".", ",");

    if ($data['poreqdel'] == "0000-00-00") {
        $poreqdel = "";
        $poreqdel2 = "";
    } else {
        if ($data['poreqdel'] == "") {
            $poreqdel = "";
            $poreqdel2 = "";
        } else {
            $poreqdel = $data['poreqdel'];
            $poreqdel2 = tgl($data['poreqdel']);
        }
    }

    if ($data['tgljam'] == "0000-00-00 00:00:00") {
        $tgljam = "";
        $tgljam2 = "";
    } else {
        if ($data['tgljam'] == "") {
            $tgljam = "";
            $tgljam2 = "";
        } else {
            $tgljam = $data['tgljam'];
            $tgljam2 = tgl($data['tgljam']);
        }
    }

    // $specb = preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰ï¿=¥Ã¨"]/', ' ', $data['spec']);
    // $spec = TRIM($specb);
    $spec = TRIM($data['spec']);
    $sizeb = preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰ï¿=¥Ã¨"]/', ' ', $data['sizegar']);
    $sizegar = TRIM($sizeb);

    if ($data['suppk'] == "1949") {
        $supnm2 = "<font style='color:rgba(0, 0, 0, 0.38)'>Unassigned</font>";
    } else {
        $supnm2 = $data['supnm'];
    }

    $row[] = array(
        'no' => $k,
        'ordpk' => $data['ordpk'],
        'ordno' => $data['ordno'],
        'fupk' => $data['fupk'],
        'funm' => $data['funm'],
        'byrnm' => $data['byrnm'],
        'suppk' => $data['suppk'],
        'supnm2' => $supnm2,
        'supnm' => $data['supnm'],
        'sup' => $data['sup'],
        'rpopk' => $data['rpopk'],
        'rkbpk' => $data['rkbpk'],
        'nour' => $data['nour'],
        'item' => $data['item'],
        'itemadd' => $data['itemadd'],
        'spec' => $spec,
        'specadd' => $data['specadd'],
        'tspec' => $data['tspec'],
        'hspec1' => $data['hspec1'],
        'hspec2' => $data['hspec2'],
        'hspec3' => $data['hspec3'],
        'hspec4' => $data['hspec4'],
        'hspec5' => $data['hspec5'],
        'hspec6' => $data['hspec6'],
        'spec1' => $data['spec1'],
        'spec2' => $data['spec2'],
        'spec3' => $data['spec3'],
        'spec4' => $data['spec4'],
        'spec5' => $data['spec5'],
        'spec6' => $data['spec6'],
        'sizegar' => $sizegar,
        'qty' => $qty,
        'unit' => $data['unit'],
        'colname' => $data['colname'],
        'colcode' => $data['colcode'],
        'price' => $price,
        'price2' => $data['price'],
        'curpk' => $data['curpk'],
        'curid' => $data['curid'],
        // 'kelnm' => $kelnm,
        'bdownqty' => $data['bdownqty'],
        'kolom' => $data['kolom'],
        'bdownpk' => $data['bdownpk'],
        'allowcons' => $data['allowcons'],
        'negocons' => $data['negocons'],
        'estcons' => $data['estcons'],
        'varcons' => $data['varcons'],
        'totcons' => $data['totcons'],
        'qrs' => $data['qrs'],
        'pocons' => $pocons,
        // 'satus' => $sts,
        'stspk' => $data['stspk'],
        'poreqdel' => $poreqdel,
        'poreqdel2' => $poreqdel2,
        /*'podel'=>$data['podel'],*/
        'tgljam' => $tgljam,
        'tgljam2' => $tgljam2
    );
}
// $result = array_merge($result, array('rows' => $row));
// echo json_encode($result);

$result = array_merge($result, array('rows' => $row));

// Kirim ke browser dengan mempertahankan karakter asli Unicode
echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
?>