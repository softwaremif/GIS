<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/tanggal.php";
include "../config/tanggal2.php";
$thn = DATE('Y');
$thnd = DATE('Y') + 1;
$bln = DATE('m');
$tanggal=DATE('Y-m-t');
$bul=date('Y-m-d', strtotime('-4 month', strtotime($tanggal)));
$thn2 = $thn - 2;
$thn2b = $thn2 - 2000;

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 4000;
//$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'ord.ordpk';
//$order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';
$cari1 = isset($_POST['cari1']) ? ($_POST['cari1']) : false;
$cari2 = isset($_POST['cari2']) ? ($_POST['cari2']) : false;
$cari3 = isset($_POST['cari3']) ? ($_POST['cari3']) : false;
$cari4 = isset($_POST['cari4']) ? ($_POST['cari4']) : false;
$cari5 = isset($_POST['cari5']) ? ($_POST['cari5']) : false;
$cari7 = isset($_POST['cari7']) ? ($_POST['cari7']) : false;
$cari8 = isset($_POST['cari8']) ? ($_POST['cari8']) : false;
$cari9 = isset($_POST['cari9']) ? ($_POST['cari9']) : false;
$filterCut = isset($_POST['filterCut']) ? ($_POST['filterCut']) : false;
$ord  = $_POST['ord'] ?? '';
// $pono = $_POST['pono'] ?? '';

$offset = ($page - 1) * $rows;

if($cari9=="1"){
    $width1="0"; $width2="290"; $width3="300"; $style1="display:none"; $style2=""; $style3="";
}elseif($cari9=="1,2"){
    $width1="0"; $width2="0"; $width3="300"; $style1="display:none"; $style2="display:none"; $style3="";
}elseif($cari9=="1,3"){
    $width1="0"; $width2="290"; $width3="0"; $style1="display:none"; $style2=""; $style3="display:none";
}elseif($cari9=="1,2,3"){
    $width1="0"; $width2="0"; $width3="0"; $style1="display:none"; $style2="display:none"; $style3="display:none";
}elseif($cari9=="1,3,2"){
    $width1="0"; $width2="0"; $width3="0"; $style1="display:none"; $style2="display:none"; $style3="display:none";
}elseif($cari9=="2"){
    $width1="290"; $width2="0"; $width3="300"; $style1=""; $style2="display:none"; $style3="";
}elseif($cari9=="2,1"){
    $width1="0"; $width2="0"; $width3="300"; $style1="display:none"; $style2="display:none"; $style3="";
}elseif($cari9=="2,3"){
    $width1="290"; $width2="0"; $width3="0"; $style1=""; $style2="display:none"; $style3="display:none";
}elseif($cari9=="2,1,3"){
    $width1="0"; $width2="0"; $width3="0"; $style1="display:none"; $style2="display:none"; $style3="display:none";
}elseif($cari9=="2,3,1"){
    $width1="0"; $width2="0"; $width3="0"; $style1="display:none"; $style2="display:none"; $style3="display:none";
}elseif($cari9=="3"){
    $width1="290"; $width2="290"; $width3="0"; $style1=""; $style2=""; $style3="display:none";
}elseif($cari9=="3,1"){
    $width1="0"; $width2="290"; $width3="0"; $style1="display:none"; $style2=""; $style3="display:none";
}elseif($cari9=="3,2"){
    $width1="290"; $width2="0"; $width3="0"; $style1=""; $style2="display:none"; $style3="display:none";
}elseif($cari9=="3,1,2"){
    $width1="0"; $width2="0"; $width3="0"; $style1="display:none"; $style2="display:none"; $style3="display:none";
}elseif($cari9=="3,2,1"){
    $width1="0"; $width2="0"; $width3="0"; $style1="display:none"; $style2="display:none"; $style3="display:none";
}else{
    $width1="290"; $width2="290"; $width3="300"; $style1=""; $style2=""; $style3="";
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

if ($cari4 == 1) { $sort = "ordschedlc2.cutdate"; $order = "DESC"; }
else if($cari5 == 1){ $sort = "ordschedlc2.cutdate"; $order="ASC"; }
else { $sort = "ordschedlc2.cutdate"; $order = "DESC"; }

if($_SESSION['mat']==1){ $andpo="and podt.kelnm='CUTTING'"; } 
if($_SESSION['mat']==2){ $andpo="and podt.kelnm<>'CUTTING'"; }

if ($cari1) {
    $sqlpo=mysqli_query($koneksi,"select podt.rkbpk, podt.unit, cur.curid, podt.item, podt.spec, sup.supnm, podt.colname,
    podt.price, podt.pocons, po.pono, po.etd, podt.ordpk, podt.kelnm, po.popk, podt.price as pprice, podt.pocons as ppocons, po.etdal, po.eihl,
    import.ETDA, import.EIH, po.polipk
    FROM podt
    left outer join po on po.popk=podt.popk
    left outer join ord on ord.ordpk=podt.ordpk
    left outer join sup on sup.suppk=podt.suppk
    left outer join cur on  cur.curpk=podt.curpk
    left outer join importdt on importdt.popk=po.popk
    left outer join import on import.importpk=importdt.importpk
    where podt.cek<>'4' and YEAR(po.tglpo) between '$thn' and '$thnd' and sup.supnm NOT LIKE '%STOCK%' and po.pono like '%$cari1%' $andpo  
    GROUP BY po.pono");
    $dtpo=mysqli_fetch_array($sqlpo);

        if($dtpo['pono']<>''){
            $pono=$dtpo['pono'];
        }else{
            $pono="";
        }

    $and1 = "and concat(ord.ordno,byr.byrnm,ord.prodes,ord.season,ord.artno,fu.funm,po.pono) like '%$cari1%'";
} else {
    $pono="";
}

// if($cari1){
//     $and1b = "and concat(ord.ordno,po.pono) like '%$cari1%'";
// }

// if ($cari3>0){
//     $and3 = "and MONTH(ordschedlc2.cutdate)='$cari3'";
// } else {
//     $and3 = "and ordschedlc2.cutdate BETWEEN '$bul' AND '$tanggal'";
// }

// var_dump($and3);

if ($cari2 > 0) {
    $and2 = "and byr.byrpk='$cari2'";
}

// if ($_SESSION['spv'] == 1) {
//     $and4 = "";
// } else {
//     $and4 = "and ord.userpk='$_SESSION[user]'";
// }

if ($cari7) {
    $and5 = "and ord.fupk='$cari7'";
}

// if ($cari8 > 0) {
//     $and8 = "and YEAR(ordschedlc2.cutdate)='$cari8' and YEAR(ord.datecreate)='$cari8' and ord.fupk>'0' and ord.byrpk>'0'";
// } else {
//     $and8 = "and YEAR(ordschedlc2.cutdate)='$thn' and YEAR(ord.datecreate)='$thn' and ord.fupk>'0' and ord.byrpk>'0'";
// }

if($_SESSION['leader']>0){ $lead="and fu.team='$_SESSION[leader]'"; } 

            $rs = mysqli_query($koneksi, "select po.pono, byr.byrnm, fu.funm, ord.srno, ord.ordpk, ord.ordno, ord.stage, ord.artno, 
                    ord.prodes, ord.season, ord.buymonth, ord.deldate, ord.codate, ord.filenm, byr.byrpk, lin.linnm,
                    CONCAT(UPPER(SUBSTRING(user.login,1,1)),LOWER(SUBSTRING(user.login,2))) as login, ordschedlc2.cutdate AS cut, ordschedlc2.startdate2 AS ssew, ordschedlc2.packingdate AS fsew
                    FROM ord
                    LEFT OUTER JOIN podt ON podt.ordpk=ord.ordpk
                    LEFT OUTER JOIN po ON po.popk=podt.popk
                    left outer join byr on byr.byrpk=ord.byrpk
                    left outer join fu on fu.fupk=ord.fupk
                    left outer join user on user.userpk=ord.userpk
                    LEFT OUTER JOIN ordschedlc2 ON ordschedlc2.ordpk=ord.ordpk
                    LEFT OUTER JOIN schedlc ON schedlc.schedlcpk=ordschedlc2.schedlcpk
                    LEFT OUTER JOIN lin ON lin.linpk=schedlc.linpk
                    where podt.cek <> '4' and YEAR(ordschedlc2.cutdate) between '$thn' and '$thnd'
                    $and8 $and1 $and2 $and3 $and4 $and5 $lead $andcutt
                    group by ord.ordpk
                    ORDER BY $sort $order, ord.ordno asc
                    LIMIT $rows OFFSET $offset");

$result = array();

$result['total'] = mysqli_num_rows(mysqli_query($koneksi, "select po.pono, byr.byrnm, fu.funm, ord.srno, ord.ordpk, ord.ordno, ord.stage, ord.artno, 
                    ord.prodes, ord.season, ord.buymonth, ord.deldate, ord.codate, ord.filenm, byr.byrpk, lin.linnm,
                    CONCAT(UPPER(SUBSTRING(user.login,1,1)),LOWER(SUBSTRING(user.login,2))) as login, ordschedlc2.cutdate AS cut, ordschedlc2.startdate2 AS ssew, ordschedlc2.packingdate AS fsew
                    FROM ord
                    LEFT OUTER JOIN podt ON podt.ordpk=ord.ordpk
                    LEFT OUTER JOIN po ON po.popk=podt.popk
                    left outer join byr on byr.byrpk=ord.byrpk
                    left outer join fu on fu.fupk=ord.fupk
                    left outer join user on user.userpk=ord.userpk
                    LEFT OUTER JOIN ordschedlc2 ON ordschedlc2.ordpk=ord.ordpk
                    LEFT OUTER JOIN schedlc ON schedlc.schedlcpk=ordschedlc2.schedlcpk
                    LEFT OUTER JOIN lin ON lin.linpk=schedlc.linpk
                    where podt.cek <> '4' and YEAR(ordschedlc2.cutdate) between '$thn' and '$thnd'
                    $and8 $and1 $and2 $and3 $and4 $and5 $lead $andcutt
                    group by ord.ordpk"));
                    $row = array();

$k = $offset;
// var_dump(mysqli_fetch_array($rs));
while ($data = mysqli_fetch_array($rs)) {
    $k++;

    // $sqlpo=mysqli_query($koneksi,"SELECT po.pono, podt.rkbpk, podt.unit, cur.curid, podt.item, podt.spec, sup.supnm, podt.colname,
    // podt.price, podt.pocons, po.pono, po.etd, podt.ordpk, podt.kelnm, po.popk, podt.price AS pprice, podt.pocons AS ppocons, po.etdal, po.eihl,
    // import.ETDA, import.EIH, po.polipk
    // FROM podt
    // LEFT OUTER JOIN po ON po.popk=podt.popk
    // LEFT OUTER JOIN ord ON ord.ordpk=podt.ordpk
    // LEFT OUTER JOIN sup ON sup.suppk=podt.suppk
    // LEFT OUTER JOIN cur ON  cur.curpk=podt.curpk
    // LEFT OUTER JOIN importdt ON importdt.popk=po.popk
    // LEFT OUTER JOIN import ON import.importpk=importdt.importpk
    // WHERE ord.ordpk='$data[ordpk]' AND podt.cek<>'4' AND sup.supnm NOT LIKE '%STOCK%'
    // GROUP BY po.pono");
    // $dtpo=mysqli_fetch_array($sqlpo);

    //     if($dtpo['pono']<>''){
    //         $pono=$dtpo['pono'];
    //     }else{
    //         $pono="";
    //     }


    // $sql2 = mysqli_query($koneksi, "SELECT ordschedlc2.cutdate AS cut, ordschedlc2.startdate2 AS ssew, ordschedlc2.packingdate AS fsew, lin.linnm
    //     FROM ordschedlc2
    //     LEFT OUTER JOIN ord ON ord.ordpk=ordschedlc2.ordpk
    //     LEFT OUTER JOIN schedlc ON schedlc.schedlcpk=ordschedlc2.schedlcpk
    //     LEFT OUTER JOIN lin ON lin.linpk=schedlc.linpk
    //     WHERE ordschedlc2.ordpk='$data[ordpk]' ORDER BY ordschedlc2.ordschedpk ASC LIMIT 1");
    // $x2 = mysqli_fetch_array($sql2);
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

    $crcek1=mysqli_num_rows(mysqli_query($koneksi,"select * from podt where ordpk='$data[ordpk]' and cek <> '4' and kelnm like '%cutting%'"));
    $crcek2=mysqli_num_rows(mysqli_query($koneksi,"select * from podt where ordpk='$data[ordpk]' and cek <> '4' and kelnm like '%sewing%'"));
    $crcek3=mysqli_num_rows(mysqli_query($koneksi,"select * from podt where ordpk='$data[ordpk]' and cek <> '4' and kelnm like '%finishing%'"));
   
    $crcek1a=mysqli_num_rows(mysqli_query($koneksi,"select * from podt where ordpk='$data[ordpk]' and kelnm like '%cutting%'"));
    $crcek2a=mysqli_num_rows(mysqli_query($koneksi,"select * from podt where ordpk='$data[ordpk]' and kelnm like '%sewing%'"));
    $crcek3a=mysqli_num_rows(mysqli_query($koneksi,"select * from podt where ordpk='$data[ordpk]' and kelnm like '%finishing%'"));

    $crcek1b=mysqli_num_rows(mysqli_query($koneksi,"select * from rkb where ordpk='$data[ordpk]' and item <> '' and spec <> '' and popk>'0' and kelnm like '%cutting%'"));
    $crcek2b=mysqli_num_rows(mysqli_query($koneksi,"select * from rkb where ordpk='$data[ordpk]' and item <> '' and spec <> '' and popk>'0' and kelnm like '%sewing%'"));
    $crcek3b=mysqli_num_rows(mysqli_query($koneksi,"select * from rkb where ordpk='$data[ordpk]' and item <> '' and spec <> '' and popk>'0' and kelnm like '%finishing%'"));

    $cut2 = tgl($data['cut']);
    $ssew2 = tgl($data['ssew']);
    $fsew2 = tgl($data['fsew']);

    if($crcek1b>0){
    if($crcek1b>$crcek1a){
    $stscek1 = "Cutting ($cut)";
    } else {
    if($crcek1>0){
    $stscek1 = "Cutting ($cut)";
    } else {
    $stscek1 = "Cutting ($cut)
    <input type='text' name='on' id='on' value='Complete' size='10' style='padding: 2px 4px;text-align:center; border-radius:5px;border:0px solid #000000;font-weight:400;font-size:14px;color:#FFFFFF;background-color:#19B715;' readonly>";
    }
    }
    } else {
    $stscek1 = "Cutting ($cut)";    
    }

    if($crcek2b>0){
    if($crcek2b>$crcek2a){
    $stscek2 = "Sewing ($ssew)";
    } else {
    if($crcek2>0){
    $stscek2 = "Sewing ($ssew)";
    } else {
    $stscek2 = "Sewing ($ssew)
    <input type='text' name='on' id='on' value='Complete' size='10' style='padding: 2px 4px;text-align:center; border-radius:5px;border:0px solid #000000;font-weight:400;font-size:14px;color:#FFFFFF;background-color:#19B715;' readonly>";
    }
    }
    } else {
    $stscek2 = "Sewing ($ssew)";    
    }

    if($crcek3b>0){
    if($crcek3b>$crcek3a){
    $stscek3 = "Finishing ($fsew)";
    } else {
    if($crcek3>0){
    $stscek3 = "Finishing ($fsew)";
    } else {
    $stscek3 = "Finishing ($fsew)
    <input type='text' name='on' id='on' value='Complete' size='10' style='padding: 2px 4px;text-align:center; border-radius:5px;border:0px solid #000000;font-weight:400;font-size:14px;color:#FFFFFF;background-color:#19B715;' readonly>";
    }
    }
    } else {
    $stscek3 = "Finishing ($fsew)";  
    }  

    $linnm2 = TRIM($linnm);
    if($_GET['p']==1){
    // if($_SESSION['mat']==1){
    // $orderno = "<table>
    // <tr>
    // <td width='200' style='border:none;'><span style='font-size:14px;font-weight:700;color:#000000DE;'> $data[ordno] </span> &nbsp;</td>
    // <td width='100' style='border:none;'><span style='font-size:14px;font-weight:700;color:#00000061;'> ($linnm2) </span></td>
    // <td width='".$width1."' style='border:none;'><span style='font-size:14px;font-weight:700;color:rgba(0, 0, 0, 0.60);".$style1."'> $stscek1 </span></td>
    // </tr>
    // <td style='border:none;'><span style='font-size:14px;color:#000000DE;'>$data[byrnm]</span></td>
    // <td style='border:none;'><span style='font-size:14px;color:#000000DE;'>$data[funm]</span></td>
    // <tr>
    // </tr>
    // </table>";
    // } else {
    $orderno = "<table>
    <tr>
    <td width='200' style='border:none;'><span style='font-size:14px;font-weight:700;color:#000000DE;'> $data[ordno] </span> &nbsp;</td>
    <td width='100' style='border:none;'><span style='font-size:14px;font-weight:700;color:#00000061;'> ($linnm2) </span></td>
    <td width='".$width1."' style='border:none;'><span style='font-size:14px;font-weight:700;color:rgba(0, 0, 0, 0.60);".$style1."'> $stscek1 </span></td>
    <td width='".$width2."' style='border:none;'><span style='font-size:14px;font-weight:700;color:rgba(0, 0, 0, 0.60);".$style2."'> $stscek2 </span></td>
    <td width='".$width3."' style='border:none;'><span style='font-size:14px;font-weight:700;color:rgba(0, 0, 0, 0.60);".$style3."'> $stscek3 </span></td>
    </tr>
    </tr>
    <td style='border:none;'><span style='font-size:14px;color:#000000DE;'>$data[byrnm]</span></td>
    <td style='border:none;'><span style='font-size:14px;color:#000000DE;'>$data[funm]</span></td>
    <tr>
    </table>";
    // }
    } else {
    $orderno = "<table>
    <tr>
    <td width='200' style='border:none;'><span style='font-size:14px;font-weight:700;color:#000000DE;'> $data[ordno] </span> &nbsp;</td>
    <td width='100' style='border:none;'><span style='font-size:14px;font-weight:700;color:#00000061;'> ($linnm2) </span></td>
    <td width='".$width1."' style='border:none;'><span style='font-size:14px;font-weight:700;color:rgba(0, 0, 0, 0.60);".$style1."'> $stscek1 </span></td>
    <td width='".$width2."' style='border:none;'><span style='font-size:14px;font-weight:700;color:rgba(0, 0, 0, 0.60);".$style2."'> $stscek2 </span></td>
    <td width='".$width3."' style='border:none;'><span style='font-size:14px;font-weight:700;color:rgba(0, 0, 0, 0.60);".$style3."'> $stscek3 </span></td>
    </tr>
    </tr>
    <td style='border:none;'><span style='font-size:14px;color:#000000DE;'>$data[byrnm]</span></td>
    <td style='border:none;'><span style='font-size:14px;color:#000000DE;'>$data[funm]</span></td>
    <tr>
    </table>";
    }

    // include "../config/koneksi.php";
    $row[] = array(
        'no' => $k,
        'ordpk' => $data['ordpk'],
        'orderno' => $orderno,
        'pono' => $pono,
        'ordno' => $data['ordno']);
    }

$result = array_merge($result, array('rows' => $row));
echo json_encode($result);