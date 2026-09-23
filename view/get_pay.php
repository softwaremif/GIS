<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/tanggal.php";

$bln = date("m");
$thn = date("Y");

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 4000;
//$rows = isset($_GET['rows']) ? intval($_GET['rows']) : false;
$cari4b = isset($_POST['cari4b']) ? ($_POST['cari4b']) : false;
/*if($cari4b){
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'po.dateupdt';
}else {
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'po.tglpo';
}*/
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

// if ($cari1) {
//     $and1 = "and concat(fu.funm,byr.byrnm,po.pono,sup.supnm,po.brg) like '%$cari1%'";
// }

$and1 = "";
if ($cari1) {
    $cari1_values = explode(";", $cari1);
    $multiple_search = [];

    foreach ($cari1_values as $value) {
        $trimmed_value = trim($value);
        $multiple_search[] = "concat(fu.funm,byr.byrnm,po.pono,sup.supnm,po.brg) like '%$trimmed_value%'";
    }

    $and1 = "AND (" . implode(" OR ", $multiple_search) . ")";
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

if ($cari5 > 0) {
    //if($cari1<>""){ $and4=""; }
//else {
    $and4 = "and MONTH(po.tglpo)='$cari5'";
    //}
} else {
    //if($cari1<>""){
    $and4 = "";
    //}
//else { $and4="and MONTH(po.tglpo)='$bln'"; }
}

if ($cari6 > 0) {
    $and5 = "and YEAR(po.tglpo)='$cari6'";
} else {
    $and5 = "and YEAR(po.tglpo)='$thn'";
}

if ($cari3 == 1) {
    $order = "po.tglpo desc, po.popk desc";
} else if ($cari4 == 1) {
    $order = "po.tglpo asc, po.popk asc";
} else if ($cari4b == 1) {
    $order = "po.tpo2 desc, po.tglpo desc";
} else {
    $order = "po.tglpo desc, po.popk desc";
}

$rs2 = mysqli_query($koneksi, "SELECT ord.ordpk, ord.ordno, fu.fupk, fu.funm, sup.suppk, sup.supnm, rpo.rpopk, rpo.tgljam, rkb.rkbpk,
po.popk, po.pono, po.brg, po.tgldel, po.postatpk, po.pur, sum(podt.pocons) as pocons, podt.unit, podt.colname, SUM(podt.price*podt.pocons) as price , cur.curpk,
po.etd, po.tglpo, cur.curid, po.dateupdt,po.tpo1, po.tpo2, byr.byrnm
FROM po
left outer join sup on sup.suppk=po.suppk
left outer join podt on podt.popk=po.popk
left outer join cur on cur.curpk=podt.curpk
left outer join ord on ord.ordpk=podt.ordpk
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
left outer join rkb on rkb.rkbpk=podt.rkbpk
left outer join rpo on rpo.rpopk=podt.rpopk
WHERE po.pur='$_SESSION[login]' and sup.supnm like '%STOCK%' and po.postatpk='1' and rkb.status='4' and po.ck<='1' $and1 $and2 $and4 $and5
group by po.popk");
while ($data2 = mysqli_fetch_array($rs2)) {
    $update1 = mysqli_query($koneksi, "update po set postatpk='4', pidate='$data2[tglpo]', email='1' where popk='$data2[popk]' and postatpk='1'");
    $update2 = mysqli_query($koneksi, "update rkb set status='6' where popk='$data2[popk]' and status='4'");
}

$rs3 = mysqli_query($koneksi, "SELECT ord.ordpk, ord.ordno, fu.fupk, fu.funm, sup.suppk, sup.supnm, rpo.rpopk, rpo.tgljam, rkb.rkbpk,
po.popk, po.pono, po.brg, po.tgldel, po.postatpk, po.pur, sum(podt.pocons) as pocons, podt.unit, podt.colname, SUM(podt.price*podt.pocons) as price , cur.curpk,
po.etd, po.tglpo, cur.curid, po.dateupdt,po.tpo1, po.tpo2, byr.byrnm
FROM po
left outer join sup on sup.suppk=po.suppk
left outer join podt on podt.popk=po.popk
left outer join cur on cur.curpk=podt.curpk
left outer join ord on ord.ordpk=podt.ordpk
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
left outer join rkb on rkb.rkbpk=podt.rkbpk
left outer join rpo on rpo.rpopk=podt.rpopk
WHERE po.pur='$_SESSION[login]' and sup.supnm like '%STOCK%' and po.postatpk='4' and rkb.status='4' and po.ck<='1' $and1 $and2 $and4 $and5
group by po.popk");
while ($data3 = mysqli_fetch_array($rs3)) {
    //$update1=mysqli_query($koneksi,"update po set postatpk='4', pidate='$data2[tglpo]', email='1' where popk='$data2[popk]' and postatpk='1'");
    $update3 = mysqli_query($koneksi, "update rkb set status='6' where popk='$data3[popk]' and status='4'");
}

$rs = mysqli_query($koneksi, "SELECT ord.ordpk, ord.ordno, fu.fupk, fu.funm, sup.suppk, sup.supnm, rpo.rpopk, rpo.tgljam, rkb.rkbpk,
po.pono, po.brg, po.tgldel, po.postatpk, po.popk, sum(podt.pocons) as pocons, podt.unit, podt.colname, SUM(podt.price*podt.pocons) as price ,
cur.curpk, cur.curid , po.etd, po.tglpo, po.tpo1, po.tpo2, byr.byrnm, podt.item, po.pidate, po.etdal, po.eihl, po.piform, po.polipk, po.paydate, po.mpaypk, po.invoiceno
FROM po
left outer join sup on sup.suppk=po.suppk
left outer join podt on podt.popk=po.popk
left outer join cur on cur.curpk=podt.curpk
left outer join ord on ord.ordpk=podt.ordpk
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
left outer join rkb on rkb.rkbpk=podt.rkbpk
left outer join rpo on rpo.rpopk=podt.rpopk
WHERE po.pur='$_SESSION[login]' and po.postatpk='4' and rkb.status between '3' and '6' $and1 $and2 $and4 $and5 $citem $csupp $ccol
group by po.popk
ORDER BY $order LIMIT $rows OFFSET $offset");
$result = array();
$result['total'] = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM po
left outer join sup on sup.suppk=po.suppk
left outer join cur on  cur.curpk=po.curpk
left outer join podt on podt.popk=po.popk
left outer join ord on ord.ordpk=podt.ordpk
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
left outer join rkb on rkb.rkbpk=podt.rkbpk
left outer join rpo on rpo.rpopk=podt.rpopk
WHERE po.pur='$_SESSION[login]' and po.postatpk='4' and rkb.status between '3' and '6' $and1 $and2 $and4 $and5 $citem $csupp $ccol
group by po.popk"));
$row = array();
$k = $offset;
while ($data = mysqli_fetch_array($rs)) {
    $k++;
    $dtitem = addslashes($data['item']);
    $updatepo = mysqli_query($koneksi, "update po set brg='$dtitem' where popk='$data[popk]'");
    
    $polipk = $data['polipk'];
    $po_id  = $data['popk'];

    // 1. TENTUKAN SUMBER DATA (IMPORT atau LOKAL)
    if ($polipk == 2) {
        // Hilangkan 'arrivalpk > 0' agar data tetap muncul meski barang belum sampai/arrival
        $query_import = mysqli_query($koneksi, "SELECT importdt.ETDV, importdt.ETDA, importdt.EIH 
            FROM importdt
            LEFT OUTER JOIN import ON import.importpk = importdt.importpk
            WHERE importdt.popk = '$po_id' 
            ORDER BY importdt.importdtpk DESC LIMIT 1");
        
        if ($query_import && mysqli_num_rows($query_import) > 0) {
            $dt_import  = mysqli_fetch_array($query_import);
            // Gunakan nama kolom sesuai hasil query analisa Anda (case sensitive)
            $v_etd  = $data['etd'];
            $v_eta  = $dt_import['ETDA'];
            $v_eih  = $dt_import['EIH'];
        } else {
            // Jika benar-benar tidak ada di tabel import, fallback ke tabel PO
            $v_etd  = $data['etd'];
            $v_eta  = '';
            $v_eih  = '';
        }
    } else {
        // JIKA BUKAN POLIPK 2 (LOKAL), AMBIL DARI TABEL PO
        $v_etd  = $data['etd'];
        $v_eta  = $data['etdal'];
        $v_eih  = $data['eihl'];
    }

    // 2. FORMAT TAMPILAN
    $etd = ($v_etd == "0000-00-00" || empty($v_etd)) ? "" : $v_etd;
    $etd2 = ($etd != "") ? tgl($etd) : "";

    $etdal = ($v_eta == "0000-00-00" || empty($v_eta)) ? "" : $v_eta;
    $etdal2 = ($etdal != "") ? tgl($etdal) : "";

    $eihl = ($v_eih == "0000-00-00" || empty($v_eih)) ? "" : $v_eih;
    $eihl2 = ($eihl != "") ? tgl($eihl) : "";


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

    // $pocons1=ceil($data['pocons']);
// $pocons=number_format($pocons1,0,".",",");

    $dtsum = mysqli_fetch_array(mysqli_query($koneksi, "select sum(pocons) as pocons from podt where popk='$data[popk]' and delsts='0' group by popk"));
    $pocons1 = ceil($dtsum['pocons']);
    $pocons = number_format($pocons1, 0, ".", ",");

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

    // if ($data['etd'] == "0000-00-00") {
    //     $etd = "";
    //     $etd2 = "";
    // } else {
    //     if ($data['etd'] == "") {
    //         $etd = "";
    //         $etd2 = "";
    //     } else {
    //         $etd = $data['etd'];
    //         $etd2 = tgl($data['etd']);
    //     }
    // }

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

    // if ($data['etdal'] == "0000-00-00") {
    //     $etdal = "";
    //     $etdal2 = "";
    // } else {
    //     if ($data['etdal'] == "") {
    //         $etdal = "";
    //         $etdal2 = "";
    //     } else {
    //         $etdal = $data['etdal'];
    //         $etdal2 = tgl($data['etdal']);
    //     }
    // }

    // if ($data['eihl'] == "0000-00-00") {
    //     $eihl = "";
    //     $eihl2 = "";
    // } else {
    //     if ($data['eihl'] == "") {
    //         $eihl = "";
    //         $eihl2 = "";
    //     } else {
    //         $eihl = $data['eihl'];
    //         $eihl2 = tgl($data['eihl']);
    //     }
    // }

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
        'byrnm' => $data['byrnm'],
        'fupk' => $data['fupk'],
        'funm' => $data['funm'],
        'suppk' => $data['suppk'],
        'supnm' => $data['supnm'],
        'rpopk' => $data['rpopk'],
        'rkbpk' => $data['rkbpk'],
        'popk' => $data['popk'],
        'pono' => $data['pono'],
        'brg' => $data['brg'],
        'pocons' => $pocons,
        'unit' => $data['unit'],
        'colname' => $data['colname'],
        'price' => $price,
        'price2' => $data['price'],
        'curpk' => $data['curpk'],
        'curid' => $data['curid'],
        'status' => $sts,
        'tgljam' => $tgljam,
        'tgljam2' => $tgljam2,
        'tgldel' => $tgldel,
        'tgldel2' => $tgldel2,
        'etd' => $etd,
        'etd2' => $etd2,
        'pidate' => $pidate,
        'pidate2' => $pidate2,
        'etdal' => $etdal,
        'etdal2' => $etdal2,
        'eihl' => $eihl,
        'eihl2' => $eihl2,
        'mpaypk' => $data['mpaypk'],
        'paydate' => $data['paydate'],
        'invoiceno' => $data['invoiceno'],
        'piform' => $data['piform'],
        'tglpo' => $tglpo,
        'dateupdt' => $data['dateupdt'],
        'tpo1' => $data['tpo1'],
        'tpo2' => $data['tpo2'],
        'tglpo2' => $tglpo2,
        'polipk' => $data['polipk']
    );
}
$result = array_merge($result, array('rows' => $row));
echo json_encode($result);

?>