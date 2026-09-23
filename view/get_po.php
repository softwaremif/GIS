<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/koneksi4b.php";
include "../config/tanggal.php";
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'po.pono';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
$cari1 = isset($_POST['cari1']) ? ($_POST['cari1']) : false;
$cari2 = isset($_POST['cari2']) ? ($_POST['cari2']) : false;
$cari3 = isset($_POST['cari3']) ? ($_POST['cari3']) : false;
$type0 = isset($_POST['type0']) ? ($_POST['type0']) : false;
$type1 = isset($_POST['type1']) ? ($_POST['type1']) : false;
$spec0 = isset($_POST['spec0']) ? ($_POST['spec0']) : false;
$spec1 = isset($_POST['spec1']) ? ($_POST['spec1']) : false;
$col0 = isset($_POST['col0']) ? ($_POST['col0']) : false;
$col1 = isset($_POST['col1']) ? ($_POST['col1']) : false;
$cari4 = isset($_POST['cari4']) ? ($_POST['cari4']) : false;
$cari5 = isset($_POST['cari5']) ? ($_POST['cari5']) : false;
$cariaz = isset($_POST['cariaz']) ? ($_POST['cariaz']) : false;
/*$cek = isset($_GET['cek']) ? ($_GET['cek']) : false;*/
$ord = isset($_GET['ord']) ? ($_GET['ord']) : false;

$offset = ($page - 1) * $rows;

//type
if ($type0 == '') {
    $atype = array($type1);
} else if ($type1 == '') {
    $atype = array($type0);
} else {
    $atype = array($type0, $type1);
}
$itype = implode("', '", $atype);

//spec
if ($spec0 == '') {
    $aspec = array($spec1);
} else if ($spec1 == '') {
    $aspec = array($spec0);
} else {
    $aspec = array($spec0, $spec1);
}
$ispec = implode("', '", $aspec);

//color
if ($col0 == '') {
    $acol = array($col1);
} else if ($col1 == '') {
    $acol = array($col0);
} else {
    $acol = array($col0, $col1);
}
$icol = implode("', '", $acol);

if ($cari4 == 1) {
    $orderby = ",rpo.tgljam desc";
} else if ($cari5 == 1) {
    $orderby = ",rpo.tgljam asc";
} else if ($cariaz == 1) {
    $orderby = ",rkb.item asc";
} else {
    $orderby = ",rpo.tgljam desc";
}

// if ($cari1 <> "") {
//     $and1 = "and concat(rkb.item,sup.supnm,rkb.spec,po.pono) like '%$cari1%'";
// }

$and1 = "";
if ($cari1) {
    $cari1_values = explode(";", $cari1);
    $multiple_search = [];

    foreach ($cari1_values as $value) {
        $trimmed_value = trim($value);
        $multiple_search[] = "concat(rkb.item,sup.supnm,rkb.spec,po.pono) like '%$trimmed_value%'";
    }

    $and1 = "AND (" . implode(" OR ", $multiple_search) . ")";
}

if ($cari2 <> "") {
    if ($cari2 == 0) {
    } else {
        $and2 = "and po.postatpk='$cari2'";
    }
}

if ($cari3 <> "") {
    if ($cari3 == 0) {
    } else {
        $and3 = "and sup.suppk='$cari3'";
    }
}

/*if($cek>0){ $and4="and.rkb.sts='$cek'"; }*/

if ($type0 <> "" || $type1 <> "") {
    //$csupp="and sup.supnm LIKE '%$supp0%' or sup.supnm LIKE '%$supp1%'";
    $ctype = "and rkb.item IN ('$itype')";
}
if ($spec0 <> "" || $spec1 <> "") {
    $cspec = "and rkb.spec IN ('$ispec')";
}
if ($col0 <> "" || $col1 <> "") {
    $ccol = "and rkb.colname IN ('$icol')";
}

$rs = mysqli_query($koneksi, "select rkb.ordpk, ord.ordno, rkb.suppk, sup.supnm, rkb.rkbpk, rkb.nour, rkb.item,
rkb.itemadd, rkb.spec, rkb.specadd, rkb.tspec, rkb.hspec1, rkb.hspec2, rkb.hspec3, rkb.hspec4, rkb.hspec5,
rkb.hspec6, rkb.hspec7, rkb.hspec8, rkb.spec1, rkb.spec2, rkb.spec3, rkb.spec4, rkb.spec5, rkb.spec6, rkb.spec7, rkb.spec8,
rkb.sizegar, rkb.unit, rkb.colname, rkb.colcode, rkb.price, rkb.curpk, cur.curid, rkb.kelnm, rkb.bdownqty,
rkb.kolom, rkb.bdownpk, rkb.allowcons, rkb.negocons, rkb.estcons, rkb.varcons, rkb.totcons, rkb.qrs, rkb.pocons,
rkb.poreqdel, rkb.podel, rkb.status, rkb.stspk, rkb.allowman, rkb.popk, po.postatpk, po.pono, rkb.piqty,
rkb.piprice, po.piform, po.pidate, po.tgldel, po.etd, rpo.tgljam, rkb.revdate, rkb.candate, rkb.matusage, rkb.mtypepk,
rkb.codenm
FROM rkb
left outer join rpo on rpo.rkbpk=rkb.rkbpk
left outer join podt on podt.rkbpk=rkb.rkbpk
left outer join po on po.popk=podt.popk
left outer join ord on ord.ordpk=rkb.ordpk
left outer join sup on sup.suppk=rkb.suppk
left outer join cur on  cur.curpk=rkb.curpk
where rkb.spec<>'' and ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord' and rkb.status>='3' $and1 $and2 $and3
$ctype $cspec $ccol
group by rkb.rkbpk
order by $sort $order $orderby");

$result = array();
$result['total'] = mysqli_num_rows(mysqli_query($koneksi, "select * FROM rkb
left outer join rpo on rpo.rkbpk=rkb.rkbpk
left outer join podt on podt.rkbpk=rkb.rkbpk
left outer join po on po.popk=podt.popk
left outer join ord on ord.ordpk=rkb.ordpk
left outer join sup on sup.suppk=rkb.suppk
left outer join cur on  cur.curpk=rkb.curpk
where rkb.spec<>'' and ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord' and rkb.status>='3' $and1 $and2 $and3
$ctype $cspec $ccol
group by rkb.rkbpk"));
$row = array();

$k = $offset;
while ($data = mysqli_fetch_array($rs)) {
    $k++;

    // include "../config/koneksi4.php";
    $sql = mysqli_query($koneksi4, "SELECT SUM(qtydtg) as tqtydtg, unitdtg, kelnm FROM dtgdt WHERE rkbpk='$data[rkbpk]' GROUP BY rkbpk");
    $dtg = mysqli_fetch_array($sql);

    $poconsa1 = $data['pocons'];
    $tqtydtg1 = $dtg['tqtydtg'];

    $poconsa = number_format($data['pocons'], 0, ".", ",");
    $tqtydtg = number_format($dtg['tqtydtg'], 0, ".", ",");
    $unitdtg = RTRIM($dtg['unitdtg']);
    $unitpo = RTRIM($data['unit']);

    $balance = ($dtg['tqtydtg'] - $data['pocons']) / $data['pocons'] * 100;
    $balance2 = number_format($balance, 1, ".", ",");

    // include "../config/koneksi.php";
    $cr = mysqli_query($koneksi, "select * from po where popk='$data[popk]'");
    $dt = mysqli_fetch_array($cr);
    if ($dt['ck'] == 0) {
        if ($dt['pur'] == "Rita") {
            $pono2 = $dt['pono'];
        } else if ($dt['pur'] == "Theresia") {
            $pono2 = $dt['pono'];
        } else {
            if ($dt['postatpk'] > 1) {
                $pono2 = $dt['pono'];
            } else {
                $pono2 = "";
            }
        }
    } else if ($dt['ck'] == 1) {
        $pono2 = $dt['pono'];
    } else {
        $pono2 = "";
    }


    /*$btn = '<a href="?hal=detord&ord='.$data['ordpk'].'" style="text-decoration:none;">'.$data['ordno'].'</a>';
    if($data['sts']==1){ $sts="In progress"; }
    if($data['sts']==2){ $sts="Ready for PO"; }*/
    if ($dt['postatpk'] == 1 && $data['popk'] > 1) {
        if ($dt['fu'] <> '') {
            if ($dt['ck'] == 1) {
                $sts = "Awating PI";
            } else {
                $sts = "PO in process";
            }
        } else {
            $sts = "Awating PI";
        }
    } else if ($dt['postatpk'] == 2) {
        $sts = "In Revision";
    } else if ($dt['postatpk'] == 3) {
        $sts = "PO Cancel";
    } else if ($dt['postatpk'] == 4 && $tqtydtg1 == 0 || $tqtydtg1 == "") {
        $sts = "Purchased";
    } else if ($dt['postatpk'] == 4 && $poconsa1 == $tqtydtg1) {
        $stsb = "In House";
        $sts = "1";
        // $sts="<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color:#19B715;cursor:pointer' onclick='info();'>Complete</span>";    
    } else if ($dt['postatpk'] == 4 && $tqtydtg1 > $poconsa1 && $unitpo == $unitdtg) {
        $stsb = "In House<span style='color:white;'> (+" . $balance2 . "%)</span>";
        $sts = "2";
        // $sts="<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color:#19B715;cursor:pointer' onclick='info();'>Complete<span style='color:#FF6B00;'>(+".$balance2."%)</span></span>";    
    } else if ($dt['postatpk'] == 4 && $tqtydtg1 < $poconsa1 && $unitpo == $unitdtg) {
        $stsb = "Partial In";
        $sts = "3";
        // $sts="<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color:#359DD9;cursor:pointer' onclick='info();'>Partial In</span>";    
    } else if ($dt['postatpk'] == 4 && $tqtydtg1 < $poconsa1 && $unitpo != $unitdtg) {
        $stsb = "Unit Difference";
        $sts = "4";
        // $sts="<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color:#EF3B42;cursor:pointer' onclick='info();'>Unit Difference</span>";    
    }
    // else { $sts="In progress"; }

    $qty = number_format($data['bdownqty'], 0, ".", ",");
    $pocons = number_format($data['pocons'], 0, ".", ",");
    $kelnm = TRIM($data['kelnm']);

    /* if($data['piqty']>0){ $piqty1=$data['piqty']; }
    else { $piqty1=$data['pocons']; }

    if($data['piprice']>0){ $piprice1=$data['piprice']; }
    else { $piprice1=$data['price']; }

    if($data['piunit']){ $piunit1=$data['piunit']; }
    else { $piunit1=$data['unit']; }*/

    $piqty1 = $data['pocons'];
    $piprice1 = $data['price'];
    $piunit1 = $data['unit'];

    if ($piqty1 == "0.00") {
        $piqty = "";
        $piqty2 = "";
    } else {
        $piqty = number_format($piqty1, 0, ".", ",");
        $piqty2 = $piqty1;
    }
    //$pitot=$data['piqty']*$data['piprice'];

    if ($data['curid'] == "IDR") {
        if ($data['price'] == "0.00000" || $data['price'] == "") {
            $price = "-";
            $total = "-";
        } else {
            $price = number_format($data['price'], 2, ".", ",") . " " . $data['curid'];
            $tot = $data['price'] * $data['pocons'];
            $total = number_format($tot, 2, ".", ",") . " " . $data['curid'];
        }

        if ($piprice1 == "0.00000" || $piprice1 == "") {
            $piprice = "";
            $piprice2 = "";
            $total2 = "";
        } else {
            $piprice = number_format($piprice1, 2, ".", ",") . " " . $data['curid'];
            $piprice2 = number_format($piprice1, 2, ".", ",");
            $tot2 = $piprice1 * $piqty1;
            $total2 = number_format($tot2, 2, ".", ",") . " " . $data['curid'];
        }
    } else {
        if ($data['price'] == "0.00000" || $data['price'] == "") {
            $price = "";
            $total = "-";
        } else {
            $price = number_format($data['price'], 5, ".", ",") . " " . $data['curid'];
            $tot = $data['price'] * $data['pocons'];
            $total = number_format($tot, 5, ".", ",") . " " . $data['curid'];
        }

        if ($piprice1 == "0.00000" || $piprice1 == "") {
            $piprice = "";
            $piprice2 = "";
            $total2 = "";
        } else {
            $piprice = number_format($piprice1, 5, ".", ",") . " " . $data['curid'];
            $piprice2 = number_format($piprice1, 5, ".", ",");
            $tot2 = $piprice1 * $piqty1;
            $total2 = number_format($tot2, 5, ".", ",") . " " . $data['curid'];
        }
    }

    if ($data['pidate'] == "0000-00-00") {
        $pidate = "";
        $pidate2 = "";
    } else {
        if ($data['pidate'] == "") {
            $pidate = "";
            $pidate2 = "";
        } else {
            $pidate = $data['pidate'];
            $pidate2 = tgl($data['pidate']);
        }
    }

    if ($dt['tgldel'] == "0000-00-00") {
        $tgldel = "";
        $tgldel2 = "";
    } else {
        if ($dt['tgldel'] == "") {
            $tgldel = "";
            $tgldel2 = "";
        } else {
            $tgldel = $data['tgldel'];
            $tgldel2 = tgl($dt['tgldel']);
        }
    }

    if ($dt['etd'] == "0000-00-00") {
        $etd = "";
        $etd2 = "";
    } else {
        if ($dt['etd'] == "") {
            $etd = "";
            $etd2 = "";
        } else {
            $etd = $dt['etd'];
            $etd2 = tgl($dt['etd']);
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

    if ($data['revdate'] == "0000-00-00 00:00:00") {
        $revdate = "";
        $revdate2 = "";
    } else {
        if ($data['revdate'] == "") {
            $revdate = "";
            $revdate2 = "";
        } else {
            $revdate = $data['tgljam'];
            $revdate2 = tgl($data['tgljam']);
        }
    }

    if ($data['candate'] == "0000-00-00 00:00:00") {
        $candate = "";
        $candate2 = "";
    } else {
        if ($data['candate'] == "") {
            $candate = "";
            $candate2 = "";
        } else {
            $candate = $data['candate'];
            $candate2 = tgl($data['candate']);
        }
    }

    // include "../config/koneksi.php";
    $crim2 = mysqli_query($koneksi, "select * from importdt
left outer join import on import.importpk=importdt.importpk
where importdt.popk='$data[popk]' order by import.importpk desc limit 1");
    $dtim2 = mysqli_fetch_array($crim2);

    $totship = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM importdt WHERE importpk='$dtim2[importpk]'
group by popk"));

    // include "../config/koneksi.php";
    $cr = mysqli_query($koneksi, "select * from memo where rkbpk='$data[rkbpk]' and cek=1 order by memopk desc");
    $dt = mysqli_fetch_array($cr);

    $allowman = number_format($data['allowman'], 0, ".", "");
    if ($data['tspec'] == 1) {
        $hspec1 = "";
        $hspec2 = "";
        $hspec3 = "";
        $hspec4 = "";
        $hspec5 = "";
        $hspec6 = "";
        $hspec7 = "";
        $hspec8 = "";
        $spec1 = "";
        $spec2 = "";
        $spec3 = "";
        $spec4 = "";
        $spec5 = "";
        $spec6 = "";
        $spec7 = "";
        $spec8 = "";
    } else {
        $hspec1 = $data["hspec1"];
        $hspec2 = $data["hspec2"];
        $hspec3 = $data["hspec3"];
        $hspec4 = $data["hspec4"];
        $hspec5 = $data["hspec5"];
        $hspec6 = $data["hspec6"];
        $hspec7 = $data["hspec7"];
        $hspec8 = $data["hspec8"];
        $spec1 = $data["spec1"];
        $spec2 = $data["spec2"];
        $spec3 = $data["spec3"];
        $spec4 = $data["spec4"];
        $spec5 = $data["spec5"];
        $spec6 = $data["spec6"];
        $spec7 = $data["spec7"];
        $spec8 = $data["spec8"];
    }

    $specb = preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰ï¿=¥Ã¨"]/', ' ', $data['spec']);
    $spec = TRIM($specb);
    $sizeb = preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰ï¿=¥Ã¨"]/', ' ', $data['sizegar']);
    $sizegar = TRIM($sizeb);

    $spec1b = preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰ï¿=¥Ã¨"]/', ' ', $spec1);
    $spec1c = TRIM($spec1b);
    $spec2b = preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰ï¿=¥Ã¨"]/', ' ', $spec2);
    $spec2c = TRIM($spec2b);
    $spec3b = preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰ï¿=¥Ã¨"]/', ' ', $spec3);
    $spec3c = TRIM($spec3b);
    $spec4b = preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰ï¿=¥Ã¨"]/', ' ', $spec4);
    $spec4c = TRIM($spec4b);
    $spec5b = preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰ï¿=¥Ã¨"]/', ' ', $spec5);
    $spec5c = TRIM($spec5b);
    $spec6b = preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰ï¿=¥Ã¨"]/', ' ', $spec6);
    $spec6c = TRIM($spec6b);
    $spec7b = preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰ï¿=¥Ã¨"]/', ' ', $spec7);
    $spec7c = TRIM($spec7b);
    $spec8b = preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰ï¿=¥Ã¨"]/', ' ', $spec8);
    $spec8c = TRIM($spec8b);

    $specadd1 = preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰ï¿=¥Ã¨"]/', ' ', $data['specadd']);
    $specadd = TRIM($specadd1);

    if ($data['stspk'] == 1) {
        $rev = "Req PO";
    } else if ($data['stspk'] == 2) {
        if ($dt['fu'] <> '') {
            if ($dt['ck'] == 1) {
                $rev = "PO Ready";
            } else {
                $rev = "Req PO";
            }
        } else {
            $rev = "PO Ready";
        }
    } else if ($data['stspk'] == 4) {
        $rev = "Req Revised";
    } else if ($data['stspk'] == 5) {
        $rev = "Ready Revised";
    } else if ($data['stspk'] == 6) {
        $rev = "Req Cancel";
    } else if ($data['stspk'] == 7) {
        $rev = "Cancel PO";
    } else {
        if ($dt['postatpk'] == 2) {
            $rev = "Req Revised";
        } else if ($data['status'] == 3) {
            $rev = "Need revision";
        } else {
            $rev = "";
        }
    }

    $pono3 = '<a href="admin?hal=detpopur&x=1&po=' . $data['popk'] . '&pur=1&ord=' . $data['ordpk'] . '" style="text-decoration:none;font-family:arial;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(53, 157, 217, 1);">' . $pono2 . '</a>';

    $row[] = array(
        'no' => $k,
        'ordpk' => $data['ordpk'],
        'ordno' => $data['ordno'],
        'suppk' => $data['suppk'],
        'supnm' => $data['supnm'],
        'sup' => $data['sup'],
        'rkbpk' => $data['rkbpk'],
        'nour' => $data['nour'],
        'item' => $data['item'],
        'itemadd' => $data['itemadd'],
        'spec' => $spec,
        'specadd' => $specadd,
        'tspec' => $data['tspec'],
        'h1' => $hspec1,
        'h2' => $hspec2,
        'h3' => $hspec3,
        'h4' => $hspec4,
        'h5' => $hspec5,
        'h6' => $hspec6,
        'hspec1' => $hspec1,
        'hspec2' => $hspec2,
        'hspec3' => $hspec3,
        'hspec4' => $hspec4,
        'hspec5' => $hspec5,
        'hspec6' => $hspec6,
        'hspec7' => $hspec7,
        'hspec8' => $hspec8,
        'spec1' => $spec1c,
        'spec2' => $spec2c,
        'spec3' => $spec3c,
        'spec4' => $spec4c,
        'spec5' => $spec5c,
        'spec6' => $spec6c,
        'spec7' => $spec7c,
        'spec8' => $spec8c,
        'sizegar' => $sizegar,
        'qty' => $qty,
        'unit' => $data['unit'],
        'colname' => $data['colname'],
        'colcode' => $data['colcode'],
        'price' => $price,
        'price2' => $data['price'],
        'curpk' => $data['curpk'],
        'curid' => $data['curid'],
        'kelnm' => $kelnm,
        'mtype' => $data['mtypepk'],
        'codenm' => $data['codenm'],
        'bdownqty' => $data['bdownqty'],
        'kolom' => $data['kolom'],
        'bdownpk' => $data['bdownpk'],
        'allowcons' => $data['allowcons'],
        'negocons' => $data['negocons'],
        'estcons' => $data['estcons'],
        'varcons' => $data['varcons'],
        'totcons' => $data['totcons'],
        'qrs' => $data['qrs'],
        'pocons1' => $data['pocons'],
        'pocons2' => $pocons,
        'status' => $sts,
        'stsb' => $stsb,
        'stspk' => $data['stspk'],
        'poreqdel' => $data['poreqdel'],
        'podel' => $data['podel'],
        'allowman' => $allowman,
        'popk' => $data['popk'],
        'postatpk' => $dt['postatpk'],
        'pono' => $pono2,
        'ponoblue' => $pono3,
        'fup' => $dt['fu'],
        'piqty' => $piqty,
        'piprice' => $piprice,
        'pitot' => $total2,
        'piform' => $data['piform'],
        'pidate' => $pidate,
        'pidate2' => $pidate2,
        'tgldel' => $tgldel,
        'tgldel2' => $tgldel2,
        'etd' => $etd,
        'etd2' => $etd2,
        'tgljam' => $tgljam,
        'tgljam2' => $tgljam2,
        'poreqdel' => $poreqdel,
        'poreqdel2' => $poreqdel2,
        'rev' => $rev,
        'rumus' => $data['rumus'],
        'f1' => $data['f1'],
        'f2' => $data['f2'],
        'revdate2' => $revdate2,
        'candate2' => $candate2,
        // 'stsimpk'=>$data['stsimpk'],
// 'importpk'=>$dtim['importpk'],
        'tqtydtg' => $tqtydtg,
        'poconsa' => $poconsa,
        'unitpo' => $unitpo,
        'unitdtg' => $unitdtg,
        'totship' => $totship,
        'nilai_usage2' => $data['matusage'],
    );
}
$result = array_merge($result, array('rows' => $row));
echo json_encode($result);
?>