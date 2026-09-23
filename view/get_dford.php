<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/koneksi4b.php";
include "../config/koneksi11a.php";
include "../config/koneksi11s.php";
include "../config/tanggal.php";
include "../config/tanggal2.php";
$thn = DATE('Y');
$thn2 = $thn - 2;
$thn2b = $thn2 - 2000;
$today = DATE('Y-m-d');

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 5000;
if($_GET['p']==1){
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'cut';
} else {
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'ord.deldate';    
}
$order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';
$cari1 = isset($_POST['cari1']) ? ($_POST['cari1']) : false;
$c1 = isset($_POST['c1']) ? ($_POST['c1']) : false;
$cari2 = isset($_POST['cari2']) ? ($_POST['cari2']) : false;
$cari3 = isset($_POST['cari3']) ? ($_POST['cari3']) : false;
$cari4 = isset($_POST['cari4']) ? ($_POST['cari4']) : false;
$cari5 = isset($_POST['cari5']) ? ($_POST['cari5']) : false;
$cari7 = isset($_POST['cari7']) ? ($_POST['cari7']) : false;
$cari8 = isset($_POST['cari8']) ? ($_POST['cari8']) : false;
$byr0 = isset($_POST['byr0']) ? ($_POST['byr0']) : false;
$byr1 = isset($_POST['byr1']) ? ($_POST['byr1']) : false;
$prodes0 = isset($_POST['prodes0']) ? ($_POST['prodes0']) : false;
$prodes1 = isset($_POST['prodes1']) ? ($_POST['prodes1']) : false;
$season0 = isset($_POST['season0']) ? ($_POST['season0']) : false;
$season1 = isset($_POST['season1']) ? ($_POST['season1']) : false;
$cutdesc = isset($_POST['cutdesc']) ? ($_POST['cutdesc']) : false;
$cutasc = isset($_POST['cutasc']) ? ($_POST['cutasc']) : false;
$filterCut = isset($_POST['filterCut']) ? ($_POST['filterCut']) : false;

$offset = ($page - 1) * $rows;

//byr
if ($byr0 == '') {
    $abyr = array($byr1);
} else if ($byr1 == '') {
    $abyr = array($byr0);
} else {
    $abyr = array($byr0, $byr1);
}
$ibyr = implode("', '", $abyr);

//prodes
if ($prodes0 == '') {
    $aprodes = array($prodes1);
} else if ($prodes1 == '') {
    $aprodes = array($prodes0);
} else {
    $aprodes = array($prodes0, $prodes1);
}
$iprodes = implode("', '", $aprodes);

//season
if ($season0 == '') {
    $aseason = array($season1);
} else if ($season1 == '') {
    $aseason = array($season0);
} else {
    $aseason = array($season0, $season1);
}
$iseason = implode("', '", $aseason);

if($_GET['p']==1){
if ($cari4 == 1) {
    $sort="ord.deldate";
    $order = "DESC";
}
if ($cari5 == 1) {
    $sort="ord.deldate";
    $order = "ASC";
}
if ($cutdesc == 1) {
    $sort="cut";
    $order = "DESC";
}
if ($cutasc == 1) {
    $sort="cut";
    $order = "ASC";
}
else {
    $order = "DESC";
}
} else {
if ($cari4 == 1) {
    $order = "DESC";
}
if ($cari5 == 1) {
    $order = "ASC";
} else {
    $order = "DESC";
}
}

if ($cari1 <> "") {
    // $and1 = "and concat(ord.ordno,byr.byrnm,ord.prodes,ord.season,ord.artno,fu.funm) like '%$cari1%'";
    $and1 = "";
    if ($cari1) {
        $cari1_values = explode(";", $cari1);
        $multiple_search = [];

        foreach ($cari1_values as $value) {
            $trimmed_value = trim($value);
            $multiple_search[] = "CONCAT(
    COALESCE(ord.ordno, ''), 
    COALESCE(byr.byrnm, ''), 
    COALESCE(ord.prodes, ''), 
    COALESCE(ord.season, ''), 
    COALESCE(ord.artno, ''), 
    COALESCE(fu.funm, ''), 
    COALESCE(pono, '')
) LIKE '%$trimmed_value%'";
        }

        $and1 = "AND (" . implode(" OR ", $multiple_search) . ")";
    }
} else if ($_GET['c1'] <> "") {
    // $and1 = "and concat(ord.ordno,byr.byrnm,ord.prodes,ord.season,ord.artno,fu.funm) like '%$_GET[c1]%'";
    $and1 = "";
    if ($c1) {
        $c1_values = explode(";", $c1);
        $multiple_search = [];

        foreach ($c1_values as $value) {
            $trimmed_value = trim($value);
            $multiple_search[] = "CONCAT(
    COALESCE(ord.ordno, ''), 
    COALESCE(byr.byrnm, ''), 
    COALESCE(ord.prodes, ''), 
    COALESCE(ord.season, ''), 
    COALESCE(ord.artno, ''), 
    COALESCE(fu.funm, ''), 
    COALESCE(pono, '')
) LIKE '%$trimmed_value%'";
        }

        $and1 = "AND (" . implode(" OR ", $multiple_search) . ")";
    }
} else {
    $and1 = "";
}

if ($cari2 > 0) {
    $and2 = "and byr.byrpk='$cari2'";
} else if ($_GET['c2']) {
    $and2 = "and byr.byrpk='$_GET[c2]'";
} else {
    $and2 = "";
}

if ($cari3) {
    if ($cari3 == "All") {
        $and3 = "";
    } else {
        $and3 = "and ord.season like '%$cari3%'";
    }
} else if ($_GET['c3']) {
    $and3 = "and ord.season like '%$_GET[c3]%'";
} else {
    $and3 = "";
}

if ($cari7) {
    $and5 = "and ord.fupk='$cari7'";
} else if ($_GET['c7']) {
    $and5 = "and ord.fupk='$_GET[c7]'";
} else {
    $and5 = "";
}

if ($cari8 > 0) {
    $and8 = "where YEAR(ord.datecreate)='$cari8'";
} else if ($_GET['c8'] > 0) {
    $and8 = "where YEAR(ord.datecreate)='$_GET[c8]'";
} else {
    if($_GET['p']==1){
    $and8 = "where 1=1";
    } else {
    $and8 = "where YEAR(ord.datecreate)='$thn'";
    }
}

if ($byr0 <> "" || $byr1 <> "") {
    //$csupp="and sup.supnm LIKE '%$supp0%' or sup.supnm LIKE '%$supp1%'";
    $cbyr = "and byr.byrnm IN ('$ibyr')";
}
if ($prodes0 <> "" || $prodes1 <> "") {
    $cprodes = "and ord.prodes IN ('$iprodes')";
}
if ($season0 <> "" || $season1 <> "") {
    $cseason = "and ord.season IN ('$iseason')";
}

if ($_SESSION['leader'] > 0) {
    if($_SESSION['login']=="anggia"){
    $lead="and fu.team in (1,2)";
    } else {
    $lead="and fu.team='$_SESSION[leader]'";	
    }
    $bdown = "";
}
else { 
    $lead=""; 
    $bdown = "and ord.ordqty>0";
}

function getDateRange($val, $today)
{
    switch ($val) {

        case 'today':
            return [$today, $today];

        case '1w':
            return [
                $today,
                date('Y-m-d', strtotime('+1 week'))
            ];

        case '2w':
            return [
                $today,
                date('Y-m-d', strtotime('+2 week'))
            ];

        case '1m':
            // bulan ini
            return [
                date('Y-m-01'),
                date('Y-m-t')
            ];

        case '1mn':
            // bulan depan
            return [
                date('Y-m-01', strtotime('+1 month')),
                date('Y-m-t', strtotime('+1 month'))
            ];

        case '3m':
            return [
                $today,
                date('Y-m-d', strtotime('+3 month'))
            ];

        case '6m':
            return [
                $today,
                date('Y-m-d', strtotime('+6 month'))
            ];

        case 'year':
            return [
                date('Y-01-01'),
                date('Y-12-31')
            ];

        default:
            return null;
    }
}


/* ================= FILTER ================= */
$rangeCut = getDateRange($filterCut ?? '', $today);

/* ================= WHERE ================= */
$andcutt = "";

/* ===== CUT ===== */
if ($rangeCut) {

    $andcutt .= "
    and ordschedlc2.cutdate
    BETWEEN '{$rangeCut[0]}'
    AND '{$rangeCut[1]}'
    ";
}

// if ($_SESSION['gusernm'] == "exim" || $_SESSION['gusernm'] == "finance") {
    // $bdown = "and ord.ordqty>0";
// }

// $orderby=",byr.byrnm asc, ord.ordno asc";
$query = "select byr.byrnm, fu.funm, ord.srno, ord.ordpk, ord.ordno, ord.artno, ord.prodes, ord.stage,
ord.season, ord.buymonth, ord.deldate, ord.codate, ord.filenm, byr.byrpk, costing.CM, 
CONCAT(UPPER(SUBSTRING(user.login,1,1)),LOWER(SUBSTRING(user.login,2))) as login, ord.stsfoto, ord.statuspk, ord.foto, ord.foto2,
GROUP_CONCAT(DISTINCT TRIM(bdown.pono) ORDER BY bdown.pono ASC) as pono, ord.stsprod, ord.datecreate,
ordschedlc2.ordschedpk, ordschedlc2.cutdate AS cut, ordschedlc2.startdate2 AS ssew, ordschedlc2.packingdate AS fsew, lin.linnm
FROM ord
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
left outer join user on user.userpk=ord.userpk
left outer join costing on costing.ordpk=ord.ordpk
LEFT OUTER JOIN bdown ON bdown.ordpk = ord.ordpk
LEFT OUTER JOIN ordschedlc2 ON ordschedlc2.ordpk=ord.ordpk
LEFT OUTER JOIN schedlc ON schedlc.schedlcpk=ordschedlc2.schedlcpk
LEFT OUTER JOIN lin ON lin.linpk=schedlc.linpk
$and8 $and1 $and2 $and3 $and4 $and5 $lead $cbyr $cprodes $cseason $bdown $andcutt
GROUP BY ord.ordpk
ORDER BY $sort $order
LIMIT $rows OFFSET $offset";
$rs = mysqli_query($koneksi, $query);
// if($_SESSION['spv']==1){ $and4=""; }
// else { $and4="and ord.userpk='$_SESSION[user]'"; }
$result = array();
$result['total'] = mysqli_num_rows(mysqli_query($koneksi, "select * FROM ord
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
left outer join user on user.userpk=ord.userpk
left outer join costing on costing.ordpk=ord.ordpk
LEFT OUTER JOIN bdown ON bdown.ordpk = ord.ordpk
LEFT OUTER JOIN ordschedlc2 ON ordschedlc2.ordpk=ord.ordpk
LEFT OUTER JOIN schedlc ON schedlc.schedlcpk=ordschedlc2.schedlcpk
LEFT OUTER JOIN lin ON lin.linpk=schedlc.linpk
$and8 $and1 $and2 $and3 $and4 $and5 $lead $cbyr $cprodes $cseason $bdown
GROUP BY ord.ordpk"));
$row = array();

$k = $offset;

while ($data = mysqli_fetch_array($rs)) {
    $k++;
    if ($data['deldate'] == "0000-00-00" || $data['deldate'] == "") {
        $deldate = "-";
        $deldate2 = "-";
    } else {
        $deldate = $data['deldate'];
        $deldate2 = tgl($data['deldate']);
    }

    if ($data['datecreate'] == "0000-00-00" || $data['datecreate'] == "") {
        $datecreate = "-";
        $datecreate2 = "-";
    } else {
        $datecreate = $data['datecreate'];
        $datecreate2 = tgl($data['datecreate']);
    }


    // $sql2 = mysqli_query($koneksi, "select sched.schedpk, sched.cut, sched.ssew, sched.fsew, lin.linnm
    //     from sched
    //     left outer join ord on ord.ordpk=sched.ordpk
    //     left outer join lin on lin.linpk=sched.linpk
    //     where sched.ordpk='$data[ordpk]' 
    //     order by sched.schedpk asc limit 1");
    // $x2 = mysqli_fetch_array($sql2);

    // $sql2=mysqli_query($koneksi,"SELECT ordschedlc2.ordschedpk, ordschedlc2.cutdate AS cut, ordschedlc2.startdate2 AS ssew, ordschedlc2.packingdate AS fsew, lin.linnm
    //     FROM ordschedlc2
    //     LEFT OUTER JOIN ord ON ord.ordpk=ordschedlc2.ordpk
    //     LEFT OUTER JOIN schedlc ON schedlc.schedlcpk=ordschedlc2.schedlcpk
    //     LEFT OUTER JOIN lin ON lin.linpk=schedlc.linpk
    //     WHERE ordschedlc2.ordpk='$data[ordpk]' ORDER BY ordschedlc2.ordschedpk ASC LIMIT 1");
    // $x2=mysqli_fetch_array($sql2);

    $updtsched = mysqli_query($koneksi, "update ord set schedcut='$data[cut]' where ordpk='$data[ordpk]' ");
    if ($data['cut'] == "0000-00-00" || $data['cut'] == "") {
        $cut = "-";
    } else {
        $cut = tgl($data['cut']);
    }

    if ($data['ssew'] == "0000-00-00" || $data['ssew'] == "") {
        $ssew = "-";
    } else {
        $ssew = tgl($data['ssew']);
    }

    if ($data['fsew'] == "0000-00-00" || $data['fsew'] == "") {
        $fsew = "-";
    } else {
        $fsew = tgl($data['fsew']);
    }

    if ($data['linnm'] == "") {
        $linnm = "-";
    } else {
        $linnm = $data['linnm'];
    }

    $sql2c = mysqli_query($koneksi, "SELECT * FROM costing WHERE ordpk='$data[ordpk]'");
    $x2c = mysqli_fetch_array($sql2c);

    $fob = $x2c['CM'] + $x2c['materials'] + $x2c['others'];
    if ($fob > 0) {
        $fob2 = "$" . number_format($fob, 4, ".", ",", );
    } else {
        $fob2 = "-";
    }

    $sql2b = mysqli_query($koneksi, "select sum(tot) as tot from bdown
        where ordpk='$data[ordpk]' and jenis='DETAIL' and color<>'' group by ordpk");   
    $x2b = mysqli_fetch_array($sql2b);
    if ($x2b['tot'] > 0) {
        $qty = number_format($x2b['tot'], 0, ".", ",");
        $updtqty = mysqli_query($koneksi, "update ord set ordqty='$x2b[tot]' where ordpk='$data[ordpk]' ");
    } else {
        $qty = "-";
        $updtqty = mysqli_query($koneksi, "update ord set ordqty='' where ordpk='$data[ordpk]' ");
    }

    //$btn = '<a href="?hal=detord&ord='.$data['ordpk'].'" style="text-decoration:none;">'.$data['ordno'].'</a>';
//$baris = "<input type='text' id='baris' name='baris' value='$result[total]'>";
    $prodes = preg_replace('/[^a-zA-Z""#()_%+-;]/', ' ', $data['prodes']);
    $artno = preg_replace('/[^a-zA-Z""#()_%+-;]/', ' ', $data['artno']);

    //Cutting
// include "../config/koneksi.php";
    $sqlcut1 = mysqli_query($koneksi, "SELECT sum(pocons) as tpocons
        FROM rkb
        WHERE ordpk='$data[ordpk]' and kelnm like '%CUTTING%'");
    $xcut1 = mysqli_fetch_array($sqlcut1);
    $tpoconscut = number_format($xcut1['tpocons'], 0, "", "");
    $rkbcut = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM rkb
        WHERE ordpk='$data[ordpk]' and kelnm like '%CUTTING%'"));

    // include "../config/koneksi4.php";
    $sqlcut2 = mysqli_query($koneksi4, "SELECT SUM(qtydtg) as tqtydtg
        FROM dtgdt
        WHERE ordpk='$data[ordpk]' and stsunit='0' AND kelnm like '%CUTTING%'");
    $xcut2 = mysqli_fetch_array($sqlcut2);
    $tqtydtgcut = number_format($xcut2['tqtydtg'], 0, "", "");
    $rkbcut2 = mysqli_num_rows(mysqli_query($koneksi4, "SELECT * FROM dtgdt
        WHERE ordpk='$data[ordpk]' and stsunit='0' and kelnm like '%CUTTING%' group by rkbpk"));
    //}

    if ($tqtydtgcut > 0) {
        if ($rkbcut == $rkbcut2) {
            if ($tpoconscut <= $tqtydtgcut) {
                $stssew = "<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 12px;line-height: 16px;color:#19B715;cursor:pointer;'>Complete</span>";
            } else if ($tpoconscut > $tqtydtgcut) {
                $stscut = "<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 12px;line-height: 16px;color:#359DD9;cursor:pointer;'>Partial in</span>";
            } else {
                $stscut = "";
            }
        } else {
            $stscut = "<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 12px;line-height: 16px;color:#359DD9;cursor:pointer;'>Partial in</span>";
        }
    } else {
        $stscut = "";
    }
    // $cutt = $cut . "<br>" . $stscut;

    //if($cut<>"-"){
//if($today>=$cut){
//if($data['stsemail']==0){
//if($tqtydtgcut>0){
//if($tpoconscut>$tqtydtgcut){
//include "../email/emailcut.php?ord=$data[ordpk]";    
//}
//}
//}   
//}
//}

    //Sewing
// include "../config/koneksi.php";
    $sqlsew1 = mysqli_query($koneksi, "SELECT sum(pocons) as tpocons
        FROM rkb
        WHERE ordpk='$data[ordpk]' and kelnm like '%SEWING%'");
    $xsew1 = mysqli_fetch_array($sqlsew1);
    $tpoconssew = number_format($xsew1['tpocons'], 0, "", "");
    $rkbsew = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM rkb
        WHERE ordpk='$data[ordpk]' and kelnm like '%SEWING%'"));

    // include "../config/koneksi4.php";
    $sqlsew2 = mysqli_query($koneksi4, "SELECT SUM(qtydtg) as tqtydtg
        FROM dtgdt
        WHERE ordpk='$data[ordpk]' and stsunit='0' AND kelnm like '%SEWING%'");
    $xsew2 = mysqli_fetch_array($sqlsew2);
    $tqtydtgsew = number_format($xsew2['tqtydtg'], 0, "", "");
    $rkbsew2 = mysqli_num_rows(mysqli_query($koneksi4, "SELECT * FROM dtgdt
    WHERE ordpk='$data[ordpk]' and stsunit='0' and kelnm like '%SEWING%' group by rkbpk"));

    if ($tqtydtgsew > 0) {
        if ($rkbsew == $rkbsew2) {
            if ($tpoconssew <= $tqtydtgsew) {
                $stssew = "<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 12px;line-height: 16px;color:#19B715;cursor:pointer;'>Complete</span>";
            } else if ($tpoconssew > $tqtydtgsew) {
                $stssew = "<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 12px;line-height: 16px;color:#359DD9;cursor:pointer;'>Partial in</span>";
            } else {
                $stssew = "";
            }
        } else {
            $stssew = "<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 12px;line-height: 16px;color:#359DD9;cursor:pointer;'>Partial in</span>";
        }
    } else {
        $stssew = "";
    }
    // $sseww = $ssew . "<br>" . $stssew;

    //FINISHING /PACKING
// include "../config/koneksi.php";
    $sqlfin1 = mysqli_query($koneksi, "SELECT sum(pocons) as tpocons, rkbpk
        FROM rkb
        WHERE ordpk='$data[ordpk]' and kelnm like '%FINISHING/PACKING%'
        group by ordpk");
    $xfin1 = mysqli_fetch_array($sqlfin1);
    $tpoconsfin = number_format($xfin1['tpocons'], 0, "", "");
    $rkbfin = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM rkb
        WHERE ordpk='$data[ordpk]' and kelnm like '%FINISHING/PACKING%'"));

    // include "../config/koneksi4.php";
    $sqlfin2 = mysqli_query($koneksi4, "SELECT SUM(qtydtg) as tqtydtg, rkbpk
        FROM dtgdt
        WHERE ordpk='$data[ordpk]' and stsunit='0' AND kelnm like '%FINISHING/PACKING%'
        group by ordpk");
    $xfin2 = mysqli_fetch_array($sqlfin2);
    $tqtydtgfin = number_format($xfin2['tqtydtg'], 0, "", "");
    $rkbfin2 = mysqli_num_rows(mysqli_query($koneksi4, "SELECT * FROM dtgdt
        WHERE ordpk='$data[ordpk]' and stsunit='0' and kelnm like '%FINISHING/PACKING%' group by rkbpk"));

    if ($tqtydtgfin > 0) {
        if ($rkbfin == $rkbfin2) {
            if ($tpoconsfin <= $tqtydtgfin) {
                $stsfin = "<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 12px;line-height: 16px;color:#19B715;cursor:pointer;'>Complete</span>";
            } else if ($tpoconsfin > $tqtydtgfin) {
                $stsfin = "<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 12px;line-height: 16px;color:#359DD9;cursor:pointer;'>Partial in</span>";
            } else {
                $stsfin = "";
            }
        } else {
            $stsfin = "<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 12px;line-height: 16px;color:#359DD9;cursor:pointer;'>Partial in</span>";
        }
    } else {
        $stsfin = "";
    }
    // $fseww = $fsew . "<br>" . $stsfin;

        //JASA
    // include "../config/koneksi.php";
    $sqljs1 = mysqli_query($koneksi, "SELECT sum(pocons) as tpocons, rkbpk
    FROM rkb
    WHERE ordpk='$data[ordpk]' and kelnm like '%JASA%'
    group by ordpk");
    $xjs1 = mysqli_fetch_array($sqljs1);
    $tpoconsjs = number_format($xjs1['tpocons'], 0, "", "");
    $rkbjs = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM rkb
    WHERE ordpk='$data[ordpk]' and kelnm like '%JASA%'"));

    // include "../config/koneksi4.php";
    $sqljs2 = mysqli_query($koneksi4, "SELECT SUM(qtydtg) as tqtydtg, rkbpk
    FROM dtgdt
    WHERE ordpk='$data[ordpk]' and stsunit='0' AND kelnm like '%JASA%'
    group by ordpk");
    $xjs2 = mysqli_fetch_array($sqljs2);
    $tqtydtgjs = number_format($xjs2['tqtydtg'], 0, "", "");
    $rkbjs2 = mysqli_num_rows(mysqli_query($koneksi4, "SELECT * FROM dtgdt
    WHERE ordpk='$data[ordpk]' and stsunit='0' and kelnm like '%JASA%' group by rkbpk"));

    if ($tqtydtgjs > 0) {
        if ($rkbjs == $rkbjs2) {
            if ($tpoconsjs <= $tqtydtgjs) {
                $stsjs = "<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 12px;line-height: 16px;color:#19B715;cursor:pointer;'>Complete</span>";
            } else if ($tpoconsjs > $tqtydtgjs) {
                $stsjs = "<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 12px;line-height: 16px;color:#359DD9;cursor:pointer;'>Partial in</span>";
            } else {
                $stsjs = "";
            }
        } else {
            $stsjs = "<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 12px;line-height: 16px;color:#359DD9;cursor:pointer;'>Partial in</span>";
        }
    } else {
        $stsjs = "";
    }
    // $fseww = $fsew . "<br>" . $stsjs;

    //STATUS
// if($x2['cut']<>'0000-00-00' || $x2['cut']<>''  || $x2['ssew']<>'0000-00-00' || $x2['ssew']<>'' || $x2['fsew']<>'0000-00-00' || $x2['fsew']<>''){
    
    // if($x2['schedpk']>0){    
    //     if ($today >= $x2['fsew'] && $x2['fsew'] <> '') {
    //         $status = "<span style='background-color:#FE6600;padding:5px;color:#FFFFFF;font-size:12px;border-radius:5px;'>FINISHING</span>";
    //     } else if ($today >= $x2['ssew'] && $x2['ssew'] <> '') {
    //         $status = "<span style='background-color:#19B715;padding:5px;color:#FFFFFF;font-size:12px;border-radius:5px;'>SEWING</span>";
    //     } else if ($today >= $x2['cut'] && $x2['cut'] <> '') {
    //         $status = "<span style='background-color:#0B89D2;padding:5px;color:#FFFFFF;font-size:12px;border-radius:5px;'>CUTTING</span>";
    //     } else {
    //         $status = "<span style='background-color:#858585;padding:5px;color:#FFFFFF;font-size:12px;border-radius:5px;'>scheduled</span>";
    //     }   
    //     } else {
    //     if($data['stsprod']==1) {
    //         $status = "<span style='background-color:#858585;padding:5px;color:#FFFFFF;font-size:12px;border-radius:5px;'>unscheduled</span>";
    //     } else {
    //         $status = "<span style='color:#00000061'>N/A</span>";
    //     }
    //     }

    //Kondisi status baru
    if ($data['ordschedpk'] > 0) {
        // if ($data['cut'] <= $today) {
        if ($data['ssew'] <= $today) {
            //     $stsprod = '<div style="width:83px;height:20px;display: inline-flex;padding: 2px 4px;justify-content: center;align-items: flex-start;border-radius: 4px;background:#19B715;color:#FFFFFF;font-size: 12px;font-style: normal;font-weight: 700;line-height: 16px;">Complete</div>';
            //   } else {
            $stsprod = '<div style="width:83px;height:20px;display: inline-flex;padding: 2px 4px;justify-content: center;align-items: flex-start;border-radius: 4px;background:#0B89D2;color:#FFFFFF;font-size: 12px;font-style: normal;font-weight: 700;line-height: 16px;">Production</div>';
            //   }
        } else {
            $stsprod = '<div style="width:83px;height:20px;display: inline-flex;padding: 2px 4px;justify-content: center;align-items: flex-start;border-radius: 4px;background:#FF6B00;color:#FFFFFF;font-size: 12px;font-style: normal;font-weight: 700;line-height: 16px;">Scheduled</div>';
        }
    } else if ($data['stsprod'] == 1) {
        $stsprod = '<div style="width:83px;height:20px;display: inline-flex;padding: 2px 4px;justify-content: center;align-items: flex-start;border-radius: 4px;background:#858585;color:#FFFFFF;font-size: 12px;font-style: normal;font-weight: 700;line-height: 16px;">No Schedule</div>';
    } else {
        $stsprod = '<div style="width:83px;height:20px;display: inline-flex;padding: 2px 4px;justify-content: center;align-items: flex-start;border-radius: 4px;background:#BDBDBD;color:#FFFFFF;font-size: 12px;font-style: normal;font-weight: 700;line-height: 16px;">Draft</div>';
    }

    // $act = "<div style='font-family: Arial;font-style: normal;font-weight: 700;font-size: 20px;line-height: 26px;color:#000000;'>&#10247;</div>";

    // $act = "<img src='css/images/More.png' width='24px' height='24px'></img>";
    $act = "";

    if ($data['season'] <> "") {
        $dtseason = $data['season'];
    } else {
        $dtseason = "";
    }

    $sql2d = mysqli_query($koneksi, "select * from bdown
    where ordpk='$data[ordpk]' and jenis='DETAIL' and gac>0 order by gac asc limit 1");
    $x2d = mysqli_fetch_array($sql2d);
    if ($x2d['gac'] == "0000-00-00" || $x2d['gac'] == "") {
        $gac = "";
    } else {
        $gac = tgl($x2d['gac']);
    }

    if ($deldate2 > 0) {
        $deldate2 = $deldate2;
    } else {
        $deldate2 = $gac;
        $updtdeldate = mysqli_query($koneksi, "update ord set deldate='$x2d[gac]' where ordpk='$data[ordpk]'");
    }

    //pono
    $crpo=mysqli_query($koneksi,"select pono from bdown where ordpk='$data[ordpk]' and pono<>'' and jenis='DETAIL' and tot>'0'
    group by pono order by pono asc");
    $ponoArray = [];
    while($dtpo=mysqli_fetch_array($crpo)){
        $ponoArray[] = TRIM($dtpo['pono']);
    }
    $ponoString = implode(', ', $ponoArray);

    $srno = $data['srno'];
    $stsfoto = $data['stsfoto'];
    $foto1 = $data['foto'];
    $dtsr = mysqli_fetch_array(mysqli_query($koneksi11s,"select * from request where srno='$srno'"));
    $srpk = $dtsr['srpk'];

    if ($srpk) {
    $dtfoto = mysqli_fetch_array(mysqli_query($koneksi11s,"select * from status where srpk='$srpk' order by statuspk desc limit 1")); 
    $foto2 = $dtfoto['foto'];  
    }

    // if($foto <> ""){
    //     $img='<img src="http://192.168.0.22/SOM/public/foto/'.$foto.'" width="60" height="60">';
    // }else{
    // if($stsfoto==1){
    //     $img='<img src="foto/'.$foto1.'" width="60" height="60">';
    // } else {
    //     $img='<img src="http://192.168.0.22/SOM/public/foto/no-img.png" width="60" height="60">';
    // }
    // }

    if ($stsfoto == 1) {
        if ($foto1 <> "") {
            $img = '<img src="http://192.168.0.22/GIS/foto/' . $foto1 . '" width="60" height="60">';
        } else {
            $img = '<img src="http://192.168.0.22/SOM/public/foto/no-img.png" width="60" height="60">';
        }
    } else if ($stsfoto == 2) {
        if ($foto1 <> "") {
            $img = '<img src="http://192.168.0.22/production/public/foto/' . $foto1 . '" width="60" height="60">';
        } else {
            $img = '<img src="http://192.168.0.22/SOM/public/foto/no-img.png" width="60" height="60">';
        }
    } else {
        if ($foto2 <> "") {
            $img = '<img src="http://192.168.0.22/SOM/public/foto/' . $foto2 . '" width="60" height="60">';
        } else {
            $img = '<img src="http://192.168.0.22/SOM/public/foto/no-img.png" width="60" height="60">';
        }
    }

                // hitung total output
    // $qryout = mysqli_query($koneksi11a, "SELECT SUM(output.jmlpcs) as jmlpcs 
    // FROM output
    // LEFT JOIN status ON status.statuspk = output.statuspk
    // LEFT JOIN po ON po.popk = status.popk
    // WHERE po.ordpk = '$data[ordpk]' AND output.statuspk > 0 
    // AND output.jnspk IN (2, 6) AND output.hari > 0 
    // AND output.linepk > 0 AND output.material IS NOT NULL AND output.size IS NOT NULL
    // GROUP BY po.ordpk");
    // $dtout = mysqli_fetch_array($qryout);

    // $packed = $dtout['jmlpcs'] ?? 0;

    //SMV
    $querysmv = mysqli_query($koneksi11s, "SELECT dsmv.totsmv 
    FROM status 
    LEFT JOIN request ON request.srpk = status.srpk
    LEFT JOIN stage ON stage.stagepk = status.stagepk
    LEFT JOIN dsmv ON dsmv.statuspk = status.statuspk
    WHERE request.srno = '$srno' AND dsmv.totsmv IS NOT NULL AND dsmv.totsmv > 0 
    ORDER BY status.statuspk DESC LIMIT 1");
    $dtsmv = mysqli_fetch_array($querysmv);

    $smv2 = $dtsmv['totsmv'];


    //stagenm
    if($data['statuspk']>0){
    $andsr="and status.statuspk='$data[statuspk]'";
    }

    $querystage = mysqli_query($koneksi11s, "SELECT status.srpk, status.statuspk, status.stagepk, 
    stage.stagenm, status.samplenm, request.srno 
    FROM status 
    LEFT JOIN request ON request.srpk = status.srpk
    LEFT JOIN stage ON stage.stagepk = status.stagepk
    LEFT JOIN dsmv ON dsmv.statuspk = status.statuspk
    WHERE request.srno = '$data[srno]' $andsr
    ORDER BY status.statuspk DESC LIMIT 1");
    $dtstagenm = mysqli_fetch_array($querystage);

    if($dtstagenm['stagepk']==8){
    $stagenm = $dtstagenm['samplenm'];
    } else {
    $stagenm = $dtstagenm['stagenm'];
    }

    if($_SESSION['mat']==1){ $andrkb="and rkb.kelnm='CUTTING'"; $andpo="and podt.kelnm='CUTTING'"; } 
    if($_SESSION['mat']==2){ $andrkb="and rkb.kelnm<>'CUTTING'"; $andpo="and podt.kelnm<>'CUTTING'"; }

    $totmat1 = mysqli_num_rows(mysqli_query($koneksi, "select * FROM rkb
            where rkb.spec<>'' and rkb.ordpk='$data[ordpk]' $andrkb
            group by rkb.rkbpk"));

    $totmat2 = mysqli_num_rows(mysqli_query($koneksi, "select * FROM podt
            where podt.spec<>'' and podt.ordpk='$data[ordpk]' $andpo
            group by podt.rkbpk"));

    if($totmat1==$totmat2){ $issued="All PO issued"; }
    else { $issued="PO issued";}

    $totmat = number_format($totmat2, 0, ".", ",") . "/" . number_format($totmat1, 0, ".", ",").'<br>'.$issued;
    $totmat2 = number_format($totmat2, 0, ".", ",") . "/" . number_format($totmat1, 0, ".", ",").' '.$issued;

    // include "../config/koneksi.php";
    $row[] = array(
        'no' => $k,
        'totmat' => $totmat,
        'totmat2' => $totmat2,
        'ordinf' => $img,
        'ordpk' => $data['ordpk'],
        // 'ordno1' => $btn,
        'ordno' => $data['ordno'],
        // 'pono' => $ponoString,
        'pono' => $data['pono'],
        'byrnm' => $data['byrnm'],
        'byrpk' => $data['byrpk'],
        'prodes' => $prodes,
        'season' => $dtseason,
        'funm' => $data['funm'],
        'filenm' => $data['filenm'],
        'srno' => $data['srno'],
        'stagenm' => $stagenm,
        'artno' => $artno,
        'deldate' => $deldate,
        'deldate2' => $deldate2,
        'datecreate2' => $datecreate2,
        'fob' => $fob2,
        'cut' => $cut,
        'ssew' => $ssew,
        'fsew' => $fsew,
        'stscut' => $stscut,
        'stsssew' => $stssew,
        'stsfsew' => $stsfin,
        'stsjs' => $stsjs,
        'linnm' => $linnm,
        'qty' => $qty,
        'act' => $act,
        'status' => $stsprod,
        'stage' => $data['stage'],
        'user' => $data['login'],
        // 'packed' => number_format($packed, 0, ".",","),
        'smv' => $smv2
    );
}
$result = array_merge($result, array('rows' => $row));
echo json_encode($result);
?>