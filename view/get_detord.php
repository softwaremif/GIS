<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/tanggal.php";
include "../config/tanggal2.php";
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 4000;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'bdown.nour';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
$cari1 = isset($_POST['cari1']) ? ($_POST['cari1']) : false;
$cari3 = isset($_POST['cari3']) ? ($_POST['cari3']) : false;
$cari4 = isset($_POST['cari4']) ? ($_POST['cari4']) : false;
$cari5 = isset($_POST['cari5']) ? ($_POST['cari5']) : false;
$ord = isset($_GET['ord']) ? ($_GET['ord']) : false;

$cari3a = explode(",", $cari3);
$cari3b = implode("','", $cari3a);

$cari4a = explode(",", $cari4);
$cari4b = implode("','", $cari4a);

$cari5a = explode(",", $cari5);
$cari5b = implode("','", $cari5a);

//$cari2 = isset($_POST['cari2']) ? ($_POST['cari2']) : false;
//$cari3 = isset($_POST['cari3']) ? ($_POST['cari3']) : false;

$offset = ($page - 1) * $rows;

if ($cari3) {
    $and3 = "and bdown.country IN ('$cari3b')";
}
if ($cari4) {
    $and4 = "and bdown.color IN ('$cari4b')";
}
if ($cari5) {
    $and5 = "and bdown.secsz IN ('$cari5b')";
}

// if ($cari1) {
//     $and1 = "and concat(bdown.country,bdown.pono,bdown.opno,bdown.style,bdown.color) like '%$cari1%'";
// }

$and1 = "";
if ($cari1) {
    $cari1_values = explode(";", $cari1);
    $multiple_search = [];

    foreach ($cari1_values as $value) {
        $trimmed_value = trim($value);
        $multiple_search[] = "concat(bdown.country,bdown.pono,bdown.opno,bdown.style,bdown.color) like '%$trimmed_value%'";
    }

    $and1 = "AND (" . implode(" OR ", $multiple_search) . ")";
}

//else if($cari2){ $and2="and byr.byrpk='$cari2'"; }
//else if($cari3){ $and3="and ord.season like '%$cari3%'"; }

$rs = mysqli_query($koneksi, "select * FROM bdown
left outer join ord on ord.ordpk=bdown.ordpk
where ord.ordpk='$ord'
AND (bdown.jenis IN ('DETAIL','HEADER')) $and1 $and3 $and4 $and5
AND (bdown.jenis <> 'DETAIL' OR (bdown.jenis = 'DETAIL' AND bdown.color <> ''))
GROUP BY 
  CASE WHEN bdown.jenis = 'HEADER' THEN bdown.jenis ELSE bdown.bdownpk END
ORDER BY
CASE WHEN bdown.jenis = 'DETAIL' THEN bdown.nour END ASC, 
bdown.bdownpk ASC
LIMIT $rows OFFSET $offset");

$result = array();
$result['total'] = mysqli_num_rows(mysqli_query($koneksi, "select * FROM bdown
left outer join ord on ord.ordpk=bdown.ordpk
where ord.ordpk='$ord'
AND (jenis IN ('DETAIL','HEADER')) $and1 $and3 $and4 $and5
AND (bdown.jenis <> 'DETAIL' OR (bdown.jenis = 'DETAIL' AND bdown.color <> ''))
GROUP BY 
  CASE WHEN bdown.jenis = 'HEADER' THEN bdown.jenis ELSE bdown.bdownpk END"));
$row = array();

$k = $offset;
$activeSize = [];
while ($data = mysqli_fetch_array($rs)) {
    $k++;

    //$btn = '<a href="?hal=detord&ord='.$data['ordpk'].'" style="text-decoration:none;">'.$data['ordno'].'</a>';
    if (TRIM($data['jenis']) == "HEADER") {
        $po = "";
        $op = "";
        $style = "";
        $color = "";
        $gac = "";
        $pcd = "";
        $fob = "";
        $ddp = "";
        $secsz = "";
        $stsprod = $data['stsprod'];

        $country = $data['country'];
        // $s1 = $data['s1'];
        // $s2 = $data['s2'];
        // $s3 = $data['s3'];
        // $s4 = $data['s4'];
        // $s5 = $data['s5'];
        // $s6 = $data['s6'];
        // $s7 = $data['s7'];
        // $s8 = $data['s8'];
        // $s9 = $data['s9'];
        // $s10 = $data['s10'];
        // $s11 = $data['s11'];
        // $s12 = $data['s12'];
        // $s13 = $data['s13'];
        // $s14 = $data['s14'];
        // $s15 = $data['s15'];
        // $s16 = $data['s16'];
        // $s17 = $data['s17'];
        // $s18 = $data['s18'];
        // $s19 = $data['s19'];
        // $s20 = $data['s20'];
        // $s21=$data['s21'];
        // $s22=$data['s22'];
        // $s23=$data['s23'];
        // $s24=$data['s24'];
        // $s25=$data['s25'];

        for ($i = 1; $i <= 25; $i++) {
            $activeSize[$i] = ($data['s' . $i] !== "" && $data['s' . $i] !== null);
            ${'s' . $i} = $activeSize[$i] ? $data['s' . $i] : "";
        }

        $tot = "";
    } else if (TRIM($data['jenis']) == "DETAIL") {
        $qcountry = mysqli_query($koneksi, "select * from bdown where ordpk='$ord' and sumby='country' and jenis='FOOTER1' order by sumdata asc");
        while ($dcountry = mysqli_fetch_array($qcountry)) {
            if ($dcountry['sumdata'] == $data['country']) {
            } else {
                $delctr = mysqli_query($koneksi, "delete from bdown where bdownpk='$dcountry[bdownpk]'");
            }
        }

        $qcolor = mysqli_query($koneksi, "select * from bdown where ordpk='$ord' and sumby='color' and jenis='FOOTER1' order by sumdata asc");
        while ($dcolor = mysqli_fetch_array($qcolor)) {
            if ($dcolor['sumdata'] == $data['color']) {
            } else {
                $delcol = mysqli_query($koneksi, "delete from bdown where bdownpk='$dcolor[bdownpk]'");
            }
        }

        $po = $data['pono'];
        $op = $data['opno'];
        $style = $data['style'];
        $color = $data['color'];
        $fob = $data['FOB'];
        $ddp = $data['DDP'];
        $secsz = $data['secsz'];
        $country = $data['country'];
        $stsprod = $data['stsprod'];

        if ($data['gac'] == "0000-00-00") {
            $gac = "";
            $gac2 = "";
        } else {
            if ($data['gac'] == "") {
                $gac = "";
                $gac2 = "";
            } else {
                $gac = $data['gac'];
                $gac2 = tgl2($data['gac']);
            }
        }

        if ($data['pcd'] == "0000-00-00") {
            $pcd = "";
            $pcd2 = "";
        } else {
            if ($data['pcd'] == "") {
                $pcd = "";
                $pcd2 = "";
            } else {
                $pcd = $data['pcd'];
                $pcd2 = tgl2($data['pcd']);
            }
        }

        for ($i = 1; $i <= 25; $i++) {
            if (!empty($activeSize[$i])) {
                ${'s' . $i} = ($data['s' . $i] < 1) ? "0" : $data['s' . $i];
            } else {
                ${'s' . $i} = "";
            }
        }
// if($data['s26']<1){ $s26="0"; } else { $s26=$data['s26']; }
// if($data['s27']<1){ $s27="0"; } else { $s27=$data['s27']; }
// if($data['s28']<1){ $s28="0"; } else { $s28=$data['s28']; }
// if($data['s29']<1){ $s29="0"; } else { $s29=$data['s29']; }
// if($data['s30']<1){ $s30="0"; } else { $s30=$data['s30']; }
// if($data['s31']<1){ $s31="0"; } else { $s31=$data['s31']; }
// if($data['s32']<1){ $s32="0"; } else { $s32=$data['s32']; }
// if($data['s33']<1){ $s33="0"; } else { $s33=$data['s33']; }
// if($data['s34']<1){ $s34="0"; } else { $s34=$data['s34']; }
// if($data['s35']<1){ $s35="0"; } else { $s35=$data['s35']; }
// if($data['s36']<1){ $s36="0"; } else { $s36=$data['s36']; }
// if($data['s37']<1){ $s37="0"; } else { $s37=$data['s37']; }
// if($data['s38']<1){ $s38="0"; } else { $s38=$data['s38']; }
// if($data['s39']<1){ $s39="0"; } else { $s39=$data['s39']; }
// if($data['s40']<1){ $s40="0"; } else { $s40=$data['s40']; }
        if ($data['tot'] < 1) {
            $tot = "0";
        } else {
            $tot = $data['tot'];
        }
    } /*else if($data['jenis']=="FOOTER"){
   $po="";
   $op="";
   $style="";
   $color="";
   $gac="";
   if($data['s1']<1){ $s1="0"; } else { $s1=$data['s1']; }
   if($data['s2']<1){ $s2="0"; } else { $s2=$data['s2']; }
   if($data['s3']<1){ $s3="0"; } else { $s3=$data['s3']; }
   if($data['s4']<1){ $s4="0"; } else { $s4=$data['s4']; }
   if($data['s5']<1){ $s5="0"; } else { $s5=$data['s5']; }
   if($data['s6']<1){ $s6="0"; } else { $s6=$data['s6']; }
   if($data['s7']<1){ $s7="0"; } else { $s7=$data['s7']; }
   if($data['s8']<1){ $s8="0"; } else { $s8=$data['s8']; }
   if($data['s9']<1){ $s9="0"; } else { $s9=$data['s9']; }
   if($data['s10']<1){ $s10="0"; } else { $s10=$data['s10']; }
   if($data['s11']<1){ $s11="0"; } else { $s11=$data['s11']; }
   if($data['s12']<1){ $s12="0"; } else { $s12=$data['s12']; }
   if($data['s13']<1){ $s13="0"; } else { $s13=$data['s13']; }
   if($data['s14']<1){ $s14="0"; } else { $s14=$data['s14']; }
   if($data['s15']<1){ $s15="0"; } else { $s15=$data['s15']; }
   if($data['tot']<1){ $tot="0"; } else { $tot=$data['tot']; } 
   }*/
    if (TRIM($data['jenis']) == "HEADER") {
        $row[] = array(
            'no' => $k,
            'jenis' => $data['jenis'],
            'ordpk' => $data['ordpk'],
            'ordno' => $data['ordno'],
            'bdownpk' => $data['bdownpk'],
            'country' => $country,
            'poref' => $data['poref'],
            'pono' => $po,
            'opno' => $op,
            'style' => $style,
            'stsprod' => $stsprod,
            'copy' => $data['copy'],
            'color' => $color,
            'fob' => $fob,
            'ddp' => $ddp,
            'secsz' => $secsz,
            'gac' => $gac,
            'gac2' => $gac2,
            'pcd' => $pcd,
            'pcd2' => $pcd2,
            's1' => $s1,
            's2' => $s2,
            's3' => $s3,
            's4' => $s4,
            's5' => $s5,
            's6' => $s6,
            's7' => $s7,
            's8' => $s8,
            's9' => $s9,
            's10' => $s10,
            's11' => $s11,
            's12' => $s12,
            's13' => $s13,
            's14' => $s14,
            's15' => $s15,
            's16' => $s16,
            's17' => $s17,
            's18' => $s18,
            's19' => $s19,
            's20' => $s20,
            's21'=>$s21,
's22'=>$s22,
's23'=>$s23,
's24'=>$s24,
's25'=>$s25,
// 's26'=>$s26,
// 's27'=>$s27,
// 's28'=>$s28,
// 's29'=>$s29,
// 's30'=>$s30,
// 's31'=>$s31,
// 's32'=>$s32,
// 's33'=>$s33,
// 's34'=>$s34,
// 's35'=>$s35,
// 's36'=>$s36,
// 's37'=>$s37,
// 's38'=>$s38,
// 's39'=>$s39,
// 's40'=>$s40,
            'tot' => $tot
        );
    } else {
        if ($data['country'] == "" && $data['color'] == "") {
        } else {
            $row[] = array(
                'no' => $k,
                'jenis' => $data['jenis'],
                'ordpk' => $data['ordpk'],
                'ordno' => $data['ordno'],
                'bdownpk' => $data['bdownpk'],
                'country' => $country,
                'poref' => $data['poref'],
                'pono' => $po,
                'opno' => $op,
                'style' => $style,
                'stsprod' => $stsprod,
                'copy' => $data['copy'],
                'color' => $color,
                'fob' => $fob,
                'ddp' => $ddp,
                'secsz' => $secsz,
                'gac' => $gac,
                'gac2' => $gac2,
                'pcd' => $pcd,
                'pcd2' => $pcd2,
                's1' => $s1,
                's2' => $s2,
                's3' => $s3,
                's4' => $s4,
                's5' => $s5,
                's6' => $s6,
                's7' => $s7,
                's8' => $s8,
                's9' => $s9,
                's10' => $s10,
                's11' => $s11,
                's12' => $s12,
                's13' => $s13,
                's14' => $s14,
                's15' => $s15,
                's16' => $s16,
                's17' => $s17,
                's18' => $s18,
                's19' => $s19,
                's20' => $s20,
                's21'=>$s21,
's22'=>$s22,
's23'=>$s23,
's24'=>$s24,
's25'=>$s25,
// 's26'=>$s26,
// 's27'=>$s27,
// 's28'=>$s28,
// 's29'=>$s29,
// 's30'=>$s30,
// 's31'=>$s31,
// 's32'=>$s32,
// 's33'=>$s33,
// 's34'=>$s34,
// 's35'=>$s35,
// 's36'=>$s36,
// 's37'=>$s37,
// 's38'=>$s38,
// 's39'=>$s39,
// 's40'=>$s40,
                'tot' => $tot
            );
        }
    }
}

/*$rs1 = mysqli_query($koneksi,"select * FROM bdown
left outer join ord on ord.ordpk=bdown.ordpk
where ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord' and bdown.jenis='HEADER' order by bdown.bdownpk asc");
//LIMIT $rows OFFSET $offset");
$header = array();
while($data1=mysqli_fetch_array($rs1)){
$po="";
$op="";
$style="";
$color="";
$gac="";
$s1=$data1['s1'];
$s2=$data1['s2'];
$s3=$data1['s3'];
$s4=$data1['s4'];
$s5=$data1['s5'];
$s6=$data1['s6'];
$s7=$data1['s7'];
$s8=$data1['s8'];
$s9=$data1['s9'];
$s10=$data1['s10'];
$s11=$data1['s11'];
$s12=$data1['s12'];
$s13=$data1['s13'];
$s14=$data1['s14'];
$s15=$data1['s15'];
$tot="";

$header[] = array(
'jenis'=>$data1['jenis'],
'ordpk'=>$data1['ordpk'],
'ordno'=>$data1['ordno'],
'bdownpk'=>$data1['bdownpk'],
'country'=>$data1['country'],
'pono'=>$po,
'opno'=>$op,
'style'=>$style,
'color'=>$color,
'gac'=>$gac,
's1'=>$s1,
's2'=>$s2,
's3'=>$s3,
's4'=>$s4,
's5'=>$s5,
's6'=>$s6,
's7'=>$s7,
's8'=>$s8,
's9'=>$s9,
's10'=>$s10,
's11'=>$s11,
's12'=>$s12,
's13'=>$s13,
's14'=>$s14,
's15'=>$s15,
'tot'=>$tot);
}*/

$qrytpo=mysqli_query($koneksi,"SELECT 
    COALESCE(COUNT(DISTINCT CASE WHEN pono <> '' THEN pono END), 0) AS total_pono,
    COALESCE(COUNT(DISTINCT CASE WHEN style <> '' THEN style END), 0) AS total_style
FROM bdown
WHERE ordpk = '$ord' AND jenis = 'DETAIL' AND color<>''");
$bycol = array();
while($dttpo=mysqli_fetch_array($qrytpo)){
$bycol[] = array(
    'secsz' => 'By Color',
    'country' => 'Number of PO : '.$dttpo['total_pono'].'',
    'poref' => 'Number of Style : '.$dttpo['total_style'].'',
);
}

//footer_color
$rs2 = mysqli_query($koneksi, "SELECT bdown.color, bdown.country, ord.ordpk, 
SUM(bdown.s1) AS s1,
SUM(bdown.s2) AS s2,
SUM(bdown.s3) AS s3,
SUM(bdown.s4) AS s4,
SUM(bdown.s5) AS s5,
SUM(bdown.s6) AS s6,
SUM(bdown.s7) AS s7,
SUM(bdown.s8) AS s8,
SUM(bdown.s9) AS s9,
SUM(bdown.s10) AS s10,
SUM(bdown.s11) AS s11,
SUM(bdown.s12) AS s12,
SUM(bdown.s13) AS s13,
SUM(bdown.s14) AS s14,
SUM(bdown.s15) AS s15,
SUM(bdown.s16) AS s16,
SUM(bdown.s17) AS s17,
SUM(bdown.s18) AS s18,
SUM(bdown.s19) AS s19,
SUM(bdown.s20) AS s20,
SUM(bdown.s21) AS s21,
SUM(bdown.s22) AS s22,
SUM(bdown.s23) AS s23,
SUM(bdown.s24) AS s24,
SUM(bdown.s25) AS s25,
SUM(bdown.s26) AS s26,
SUM(bdown.s27) AS s27,
SUM(bdown.s28) AS s28,
SUM(bdown.s29) AS s29,
SUM(bdown.s30) AS s30,
SUM(bdown.s31) AS s31,
SUM(bdown.s32) AS s32,
SUM(bdown.s33) AS s33,
SUM(bdown.s34) AS s34,
SUM(bdown.s35) AS s35,
SUM(bdown.s36) AS s36,
SUM(bdown.s37) AS s37,
SUM(bdown.s38) AS s38,
SUM(bdown.s39) AS s39,
SUM(bdown.s40) AS s40
FROM bdown
LEFT OUTER JOIN ord ON ord.ordpk=bdown.ordpk
where ord.ordpk='$ord' and bdown.color<>'' $and1 $and3 $and4 AND bdown.jenis='DETAIL' and bdown.tot>'0'
GROUP BY bdown.color order by bdown.color asc");
$entry = array();
while ($row2 = mysqli_fetch_array($rs2)) {

    // for ($i = 1; $i <= 25; $i++) {
    //     $key = 's' . $i;
    //     ${$key} = ($row2[$key] < 1) ? "0" : $row2[$key];
    // }
        for ($i = 1; $i <= 25; $i++) {
        $key = 's' . $i;
        // Ikuti status aktif dari HEADER:
        // - aktif (ada size di header) & qty < 1 -> tampil "0"
        // - tidak aktif (tidak ada size di header) -> tetap kosong ""
        if (!empty($activeSize[$i])) {
            ${$key} = ($row2[$key] < 1) ? "0" : $row2[$key];
        } else {
            ${$key} = "";
        }
    }

// baris $tot masih di-comment di kode asli, jadi tetap dipisah (tidak ikut loop s1-s25)
// if ($row2['tot'] < 1) {
//     $tot = "0";
// } else {
//     $tot = $row2['tot'];
// }
    $total = $s1 + $s2 + $s3 + $s4 + $s5 + $s6 + $s7 + $s8 + $s9 + $s10 + $s11 + $s12 + $s13 + $s14 + $s15 +
        $s16 + $s17 + $s18 + $s19 + $s20 + $s21 + $s22 + $s23 + $s24 + $s25 + $s26 + $s27 + $s28 + $s29 + $s30 +
        $s31 + $s32 + $s33 + $s34 + $s35 + $s36 + $s37 + $s38 + $s39 + $s40;

    //if($cari3=="Place"){$ftr=$row2['country'];}
//else if($cari3=="Color"){$ftr=$row2['color'];}
//else {$ftr=$row2['color'];}

    $ftr = $row2['color'];
    $entry[] = array(
        'secsz' => $ftr,
        's1' => $s1,
        's2' => $s2,
        's3' => $s3,
        's4' => $s4,
        's5' => $s5,
        's6' => $s6,
        's7' => $s7,
        's8' => $s8,
        's9' => $s9,
        's10' => $s10,
        's11' => $s11,
        's12' => $s12,
        's13' => $s13,
        's14' => $s14,
        's15' => $s15,
        's16' => $s16,
        's17' => $s17,
        's18' => $s18,
        's19' => $s19,
        's20' => $s20,
        's21'=>$s21,
        's22'=>$s22,
        's23'=>$s23,
        's24'=>$s24,
        's25'=>$s25,
        // 's26'=>$s26,
        // 's27'=>$s27,
        // 's28'=>$s28,
        // 's29'=>$s29,
        // 's30'=>$s30,
        // 's31'=>$s31,
        // 's32'=>$s32,
        // 's33'=>$s33,
        // 's34'=>$s34,
        // 's35'=>$s35,
        // 's36'=>$s36,
        // 's37'=>$s37,
        // 's38'=>$s38,
        // 's39'=>$s39,
        // 's40'=>$s40,
        'tot' => "<b>" . $total . "<b>"
    );

    $cr = mysqli_query($koneksi, "select * from bdown where ordpk='$ord' and sumby='color' and sumdata='$ftr' and jenis='FOOTER1'");
    $dt = mysqli_fetch_array($cr);
    $bdownpk = $dt['bdownpk'];
    $cr1 = mysqli_query($koneksi, "select * from bdown where ordpk='$ord' and jenis='DETAIL' order by nour desc limit 1");
    $dt1 = mysqli_fetch_array($cr1);
    $nour = $dt1['nour'] + 1;
    if ($bdownpk > 0) {
        $update = mysqli_query($koneksi, "update bdown set
        sumdata='$ftr',
        nour='$nour',
        s1='$s1',
        s2='$s2',
        s3='$s3',
        s4='$s4',
        s5='$s5',
        s6='$s6',
        s7='$s7',
        s8='$s8',
        s9='$s9',
        s10='$s10',
        s11='$s11',
        s12='$s12',
        s13='$s13',
        s14='$s14',
        s15='$s15',
        s16='$s16',
        s17='$s17',
        s18='$s18',
        s19='$s19',
        s20='$s20',
        s21='$s21',
        s22='$s22',
        s23='$s23',
        s24='$s24',
        s25='$s25',
        s26='$s26',
        s27='$s27',
        s28='$s28',
        s29='$s29',
        s30='$s30',
        s31='$s31',
        s32='$s32',
        s33='$s33',
        s34='$s34',
        s35='$s35',
        s36='$s36',
        s37='$s37',
        s38='$s38',
        s39='$s39',
        s40='$s40',
        tot='$total' where bdownpk='$bdownpk'");
        $cr2 = mysqli_query($koneksi, "select * from rkb where ordpk='$ord' and bdownpk='$bdownpk' and popk is null and stspk is null");
        while ($dt2 = mysqli_fetch_array($cr2)) {
            for ($i = 1; $i <= 25; $i++) {
            $kolom = 's' . $i;
            $sVal = ${$kolom}; // ambil nilai $s1, $s2, ... $s25

            if ($dt2['kolom'] == $kolom) {
                $totcons = $sVal * $dt2['estcons'];

                $f1a = substr($dt2['f1'], 0, 1);
                $f1b = substr($dt2['f1'], 1, 10);
                $f2a = substr($dt2['f2'], 0, 1);
                $f2b = substr($dt2['f2'], 1, 10);

                if ($f1a == "-") {
                    $totcons2 = $totcons - $f1b;
                } else if ($f1a == "*") {
                    $totcons2 = $totcons * $f1b;
                } else if ($f1a == "/") {
                    $totcons2 = $totcons / $f1b;
                } else {
                    $totcons2 = $totcons + $f1b;
                }

                if ($f2a == "-") {
                    $totcons3 = $totcons2 - $f2b;
                } else if ($f2a == "*") {
                    $totcons3 = $totcons2 * $f2b;
                } else if ($f2a == "/") {
                    $totcons3 = $totcons2 / $f2b;
                } else {
                    $totcons3 = $totcons2 + $f2b;
                }

                if ($totcons3 > 0) {
                    $ttotcons = $totcons3;
                } else if ($totcons2 > 0) {
                    $ttotcons = $totcons2;
                } else {
                    $ttotcons = $totcons;
                }

                $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);

                $sql2  = mysqli_query($koneksi, "update rkb  set pocons='$pocons', totcons='$ttotcons', bdownqty='$sVal' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='$kolom'");
                $sql2b = mysqli_query($koneksi, "update rpo  set pocons='$pocons', totcons='$ttotcons', bdownqty='$sVal' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='$kolom'");
                $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$sVal' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='$kolom'");
            }
        }
            // if ($dt2['kolom'] == "s1") {
            //     $totcons = $s1 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s1' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s1'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s1' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s1'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s1' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s1'");
            // }
            // if ($dt2['kolom'] == "s2") {
            //     $totcons = $s2 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s2' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s2'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s2' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s2'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s2' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s2'");
            // }
            // if ($dt2['kolom'] == "s3") {
            //     $totcons = $s3 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s3' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s3'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s3' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s3'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s3' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s3'");
            // }
            // if ($dt2['kolom'] == "s4") {
            //     $totcons = $s4 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s4' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s4'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s4' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s4'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s4' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s4'");
            // }
            // if ($dt2['kolom'] == "s5") {
            //     $totcons = $s5 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s5' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s5'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s5' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s5'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s5' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s5'");
            // }
            // if ($dt2['kolom'] == "s6") {
            //     $totcons = $s6 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s6' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s6'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s6' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s6'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s6' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s6'");
            // }
            // if ($dt2['kolom'] == "s7") {
            //     $totcons = $s7 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s7' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s7'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s7' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s7'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s7' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s7'");
            // }
            // if ($dt2['kolom'] == "s8") {
            //     $totcons = $s8 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s8' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s8'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s8' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s8'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s8' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s8'");
            // }
            // if ($dt2['kolom'] == "s9") {
            //     $totcons = $s9 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s9' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s9'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s9' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s9'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s9' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s9'");
            // }
            // if ($dt2['kolom'] == "s10") {
            //     $totcons = $s10 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s10' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s10'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s10' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s10'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s10' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s10'");
            // }
            // if ($dt2['kolom'] == "s11") {
            //     $totcons = $s11 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s11' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s11'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s11' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s11'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s11' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s11'");
            // }
            // if ($dt2['kolom'] == "s12") {
            //     $totcons = $s12 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons',  bdownqty='$s12' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s12'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s12' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s12'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s12' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s12'");
            // }
            // if ($dt2['kolom'] == "s13") {
            //     $totcons = $s13 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s13' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s13'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s13' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s13'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s13' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s13'");
            // }
            // if ($dt2['kolom'] == "s14") {
            //     $totcons = $s14 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s14' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s14'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s14' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s14'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s14' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s14'");
            // }
            // if ($dt2['kolom'] == "s15") {
            //     $totcons = $s15 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s15' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s15'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s15' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s15'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s15' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s15'");
            // }
            // if ($dt2['kolom'] == "s16") {
            //     $totcons = $s16 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s16' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s16'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s16' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s16'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s16' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s16'");
            // }
            // if ($dt2['kolom'] == "s17") {
            //     $totcons = $s17 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s17' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s17'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s17' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s17'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s17' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s17'");
            // }
            // if ($dt2['kolom'] == "s18") {
            //     $totcons = $s18 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s18' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s18'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s18' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s18'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s18' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s18'");
            // }
            // if ($dt2['kolom'] == "s19") {
            //     $totcons = $s19 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s19' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s19'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s19' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s19'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s19' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s19'");
            // }
            // if ($dt2['kolom'] == "s20") {
            //     $totcons = $s20 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s20' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s20'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s20' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s20'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s20' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s20'");
            // }
            // if($dt2['kolom']=="s21"){
// $totcons=$s21*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s21' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s21'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s21' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s21'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s21' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s21'");
// }
// if($dt2['kolom']=="s22"){
// $totcons=$s22*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s22' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s22'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s22' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s22'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s22' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s22'");
// }
// if($dt2['kolom']=="s23"){
// $totcons=$s23*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s23' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s23'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s23' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s23'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s23' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s23'");
// }
// if($dt2['kolom']=="s24"){
// $totcons=$s24*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s24' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s24'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s24' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s24'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s24' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s24'");
// }
// if($dt2['kolom']=="s25"){
// $totcons=$s25*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s25' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s25'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s25' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s25'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s25' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s25'");
// }
// if($dt2['kolom']=="s26"){
// $totcons=$s26*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s26' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s26'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s26' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s26'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s26' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s26'");
// }
// if($dt2['kolom']=="s27"){
// $totcons=$s27*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s27' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s27'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s27' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s27'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s27' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s27'");
// }
// if($dt2['kolom']=="s28"){
// $totcons=$s28*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s28' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s28'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s28' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s28'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s28' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s28'");
// }
// if($dt2['kolom']=="s29"){
// $totcons=$s29*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s29' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s29'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s29' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s29'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s29' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s29'");
// }
// if($dt2['kolom']=="s30"){
// $totcons=$s30*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s30' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s31'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s30' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s31'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s30' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s31'");
// }
// if($dt2['kolom']=="s31"){
// $totcons=$s31*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s31' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s31'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s31' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s31'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s31' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s31'");
// }
// if($dt2['kolom']=="s32"){
// $totcons=$s32*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s32' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s32'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s32' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s32'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s32' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s32'");
// }
// if($dt2['kolom']=="s33"){
// $totcons=$s33*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s33' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s33'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s33' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s33'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s33' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s33'");
// }
// if($dt2['kolom']=="s34"){
// $totcons=$s34*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s34' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s34'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s34' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s34'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s34' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s34'");
// }
// if($dt2['kolom']=="s35"){
// $totcons=$s35*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s35' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s35'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s35' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s35'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s35' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s35'");
// }
// if($dt2['kolom']=="s36"){
// $totcons=$s36*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s36' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s36'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s36' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s36'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s36' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s36'");
// }
// if($dt2['kolom']=="s37"){
// $totcons=$s37*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s37' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s37'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s37' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s37'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s37' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s37'");
// }
// if($dt2['kolom']=="s38"){
// $totcons=$s38*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s38' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s38'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s38' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s38'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s38' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s38'");
// }
// if($dt2['kolom']=="s39"){
// $totcons=$s39*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s39' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s39'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s39' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s39'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s39' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s39'");
// }
// if($dt2['kolom']=="s40"){
// $totcons=$s40*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s40' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s40'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s40' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s40'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s40' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s40'");
// }
// if($dt2['kolom']=="tot"){
// $totcons=$total*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }
// //$totcons=$dt2['estcons'];
// $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// //$pocons=$dt2['allowman'];
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$total' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='tot'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$total' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and andbdownpk='$bdownpk' and kolom='tot'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$total' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and and bdownpk='$bdownpk' and kolom='tot'");
// }
        }
    } else {
        $update = mysqli_query($koneksi, "insert into bdown set
        nour='$nour',
        s1='$s1',
        s2='$s2',
        s3='$s3',
        s4='$s4',
        s5='$s5',
        s6='$s6',
        s7='$s7',
        s8='$s8',
        s9='$s9',
        s10='$s10',
        s11='$s11',
        s12='$s12',
        s13='$s13',
        s14='$s14',
        s15='$s15',
        s16='$s16',
        s17='$s17',
        s18='$s18',
        s19='$s19',
        s20='$s20',
        s21='$s21',
        s22='$s22',
        s23='$s23',
        s24='$s24',
        s25='$s25',
        s26='$s26',
        s27='$s27',
        s28='$s28',
        s29='$s29',
        s30='$s30',
        s31='$s31',
        s32='$s32',
        s33='$s33',
        s34='$s34',
        s35='$s35',
        s36='$s36',
        s37='$s37',
        s38='$s38',
        s39='$s39',
        s40='$s40',
        tot='$total',
        ordpk='$ord',
        sumby='color',
        sumdata='$ftr',
        jenis='FOOTER1'");
    }
}

$rs2b = mysqli_query($koneksi, "SELECT ord.ordpk,
SUM(bdown.s1) AS s1,
SUM(bdown.s2) AS s2,
SUM(bdown.s3) AS s3,
SUM(bdown.s4) AS s4,
SUM(bdown.s5) AS s5,
SUM(bdown.s6) AS s6,
SUM(bdown.s7) AS s7,
SUM(bdown.s8) AS s8,
SUM(bdown.s9) AS s9,
SUM(bdown.s10) AS s10,
SUM(bdown.s11) AS s11,
SUM(bdown.s12) AS s12,
SUM(bdown.s13) AS s13,
SUM(bdown.s14) AS s14,
SUM(bdown.s15) AS s15,
SUM(bdown.s16) AS s16,
SUM(bdown.s17) AS s17,
SUM(bdown.s18) AS s18,
SUM(bdown.s19) AS s19,
SUM(bdown.s20) AS s20,
SUM(bdown.s21) AS s21,
SUM(bdown.s22) AS s22,
SUM(bdown.s23) AS s23,
SUM(bdown.s24) AS s24,
SUM(bdown.s25) AS s25,
SUM(bdown.s26) AS s26,
SUM(bdown.s27) AS s27,
SUM(bdown.s28) AS s28,
SUM(bdown.s29) AS s29,
SUM(bdown.s30) AS s30,
SUM(bdown.s31) AS s31,
SUM(bdown.s32) AS s32,
SUM(bdown.s33) AS s33,
SUM(bdown.s34) AS s34,
SUM(bdown.s35) AS s35,
SUM(bdown.s36) AS s36,
SUM(bdown.s37) AS s37,
SUM(bdown.s38) AS s38,
SUM(bdown.s39) AS s39,
SUM(bdown.s40) AS s40
FROM bdown
LEFT OUTER JOIN ord ON ord.ordpk=bdown.ordpk
where ord.ordpk='$ord' $and1 $and3 $and4 AND bdown.jenis='DETAIL' 
and bdown.color<>'' and bdown.tot>'0'
group by ord.ordpk");
$entryb = array();
while ($row2b = mysqli_fetch_array($rs2b)) {

    // for ($i = 1; $i <= 25; $i++) {
    //     $key = 's' . $i;
    //     ${$key . 'b'} = ($row2b[$key] < 1) ? "0" : $row2b[$key];
    // }
    for ($i = 1; $i <= 25; $i++) {
        $key = 's' . $i;
        // Ikuti status aktif dari HEADER:
        // - aktif (ada size di header) & qty < 1 -> tampil "0"
        // - tidak aktif (tidak ada size di header) -> tetap kosong ""
        if (!empty($activeSize[$i])) {
            ${$key . 'b'} = ($row2b[$key] < 1) ? "0" : $row2b[$key];
        } else {
            ${$key . 'b'} = "";
        }
    }

    $gtotal = $s1b + $s2b + $s3b + $s4b + $s5b + $s6b + $s7b + $s8b + $s9b + $s10b + $s11b + $s12b + $s13b + $s14b + $s15b +
        $s16b + $s17b + $s18b + $s19b + $s20b + $s21b + $s22b + $s23b + $s24b + $s25b + $s26b + $s27b + $s28b + $s29b + $s30b +
        $s31b + $s32b + $s33b + $s34b + $s35b + $s36b + $s37b + $s38b + $s39b + $s40b;

    $entryb[] = array(
        'secsz' => "<b>TOTAL</b>",
        's1' => "<b>" . $s1b . "</b>",
        's2' => "<b>" . $s2b . "</b>",
        's3' => "<b>" . $s3b . "</b>",
        's4' => "<b>" . $s4b . "</b>",
        's5' => "<b>" . $s5b . "</b>",
        's6' => "<b>" . $s6b . "</b>",
        's7' => "<b>" . $s7b . "</b>",
        's8' => "<b>" . $s8b . "</b>",
        's9' => "<b>" . $s9b . "</b>",
        's10' => "<b>" . $s10b . "</b>",
        's11' => "<b>" . $s11b . "</b>",
        's12' => "<b>" . $s12b . "</b>",
        's13' => "<b>" . $s13b . "</b>",
        's14' => "<b>" . $s14b . "</b>",
        's15' => "<b>" . $s15b . "</b>",
        's16' => "<b>" . $s16b . "</b>",
        's17' => "<b>" . $s17b . "</b>",
        's18' => "<b>" . $s18b . "</b>",
        's19' => "<b>" . $s19b . "</b>",
        's20' => "<b>" . $s20b . "</b>",
        's21'=> "<b>".$s21b."</b>",
        's22'=> "<b>".$s22b."</b>",
        's23'=> "<b>".$s23b."</b>",
        's24'=> "<b>".$s24b."</b>",
        's25'=> "<b>".$s25b."</b>",
        // 's26'=> "<b>".$s26b."</b>",
        // 's27'=> "<b>".$s27b."</b>",
        // 's28'=> "<b>".$s28b."</b>",
        // 's29'=> "<b>".$s29b."</b>",
        // 's30'=> "<b>".$s30b."</b>",
        // 's31'=> "<b>".$s31b."</b>",
        // 's32'=> "<b>".$s32b."</b>",
        // 's33'=> "<b>".$s33b."</b>",
        // 's34'=> "<b>".$s34b."</b>",
        // 's35'=> "<b>".$s35b."</b>",
        // 's36'=> "<b>".$s36b."</b>",
        // 's37'=> "<b>".$s37b."</b>",
        // 's38'=> "<b>".$s38b."</b>",
        // 's39'=> "<b>".$s39b."</b>",
        // 's40'=> "<b>".$s40b."</b>",
        'tot' => "<b>" . $gtotal . "</b>"
    );

    $cr = mysqli_query($koneksi, "select * from bdown where ordpk='$ord' and sumby='total' and jenis='FOOTER1'");
    $dt = mysqli_fetch_array($cr);
    $bdownpk = $dt['bdownpk'];
    $cr1 = mysqli_query($koneksi, "select * from bdown where ordpk='$ord' and  jenis='FOOTER1' order by nour desc limit 1");
    $dt1 = mysqli_fetch_array($cr1);
    $nour = $dt1['nour'] + 1;
    if ($bdownpk > 0) {
        $update = mysqli_query($koneksi, "update bdown set
        nour='$nour',
        s1='$s1b',
        s2='$s2b',
        s3='$s3b',
        s4='$s4b',
        s5='$s5b',
        s6='$s6b',
        s7='$s7b',
        s8='$s8b',
        s9='$s9b',
        s10='$s10b',
        s11='$s11b',
        s12='$s12b',
        s13='$s13b',
        s14='$s14b',
        s15='$s15b',
        s16='$s16b',
        s17='$s17b',
        s18='$s18b',
        s19='$s19b',
        s20='$s20b',
        s21='$s21b',
        s22='$s22b',
        s23='$s23b',
        s24='$s24b',
        s25='$s25b',
        s26='$s26b',
        s27='$s27b',
        s28='$s28b',
        s29='$s29b',
        s30='$s30b',
        s31='$s31b',
        s32='$s32b',
        s33='$s33b',
        s34='$s34b',
        s35='$s35b',
        s36='$s36b',
        s37='$s37b',
        s38='$s38b',
        s39='$s39b',
        s40='$s40b',
        tot='$gtotal' where bdownpk='$bdownpk'");
        $cr2 = mysqli_query($koneksi, "select * from rkb where ordpk='$ord' and bdownpk='$bdownpk' and popk is null and stspk is null");
        while ($dt2 = mysqli_fetch_array($cr2)) {
            for ($i = 1; $i <= 25; $i++) {
                $kolom = 's' . $i;
                $sVal = ${$kolom . 'b'}; // ambil nilai $s1b, $s2b, ... $s25b

                if ($dt2['kolom'] == $kolom) {
                    $totcons = $sVal * $dt2['estcons'];

                    $f1a = substr($dt2['f1'], 0, 1);
                    $f1b = substr($dt2['f1'], 1, 10);
                    $f2a = substr($dt2['f2'], 0, 1);
                    $f2b = substr($dt2['f2'], 1, 10);

                    if ($f1a == "-") {
                        $totcons2 = $totcons - $f1b;
                    } else if ($f1a == "*") {
                        $totcons2 = $totcons * $f1b;
                    } else if ($f1a == "/") {
                        $totcons2 = $totcons / $f1b;
                    } else {
                        $totcons2 = $totcons + $f1b;
                    }

                    if ($f2a == "-") {
                        $totcons3 = $totcons2 - $f2b;
                    } else if ($f2a == "*") {
                        $totcons3 = $totcons2 * $f2b;
                    } else if ($f2a == "/") {
                        $totcons3 = $totcons2 / $f2b;
                    } else {
                        $totcons3 = $totcons2 + $f2b;
                    }

                    if ($totcons3 > 0) {
                        $ttotcons = $totcons3;
                    } else if ($totcons2 > 0) {
                        $ttotcons = $totcons2;
                    } else {
                        $ttotcons = $totcons;
                    }

                    $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);

                    $sql2  = mysqli_query($koneksi, "update rkb  set pocons='$pocons', totcons='$ttotcons', bdownqty='$sVal' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='$kolom'");
                    $sql2b = mysqli_query($koneksi, "update rpo  set pocons='$pocons', totcons='$ttotcons', bdownqty='$sVal' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='$kolom'");
                    $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$sVal' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='$kolom'");
                }
            }
            // if ($dt2['kolom'] == "s1") {
            //     $totcons = $s1b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s1b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s1'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s1b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s1'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s1b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s1'");
            // }
            // if ($dt2['kolom'] == "s2") {
            //     $totcons = $s2b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s2b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s2'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s2b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s2'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s2b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s2'");
            // }
            // if ($dt2['kolom'] == "s3") {
            //     $totcons = $s3b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s3b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s3'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s3b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s3'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s3b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s3'");
            // }
            // if ($dt2['kolom'] == "s4") {
            //     $totcons = $s4b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s4b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s4'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s4b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s4'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s4b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s4'");
            // }
            // if ($dt2['kolom'] == "s5") {
            //     $totcons = $s5b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s5b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s5'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s5b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s5'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s5b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s5'");
            // }
            // if ($dt2['kolom'] == "s6") {
            //     $totcons = $s6b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s6b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s6'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s6b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s6'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s6b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s6'");
            // }
            // if ($dt2['kolom'] == "s7") {
            //     $totcons = $s7b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s7b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s7'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s7b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s7'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s7b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s7'");
            // }
            // if ($dt2['kolom'] == "s8") {
            //     $totcons = $s8b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s8b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s8'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s8b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s8'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s8b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s8'");
            // }
            // if ($dt2['kolom'] == "s9") {
            //     $totcons = $s9b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s9b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s9'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s9b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s9'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s9b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s9'");
            // }
            // if ($dt2['kolom'] == "s10") {
            //     $totcons = $s10b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s10b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s10'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s10b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s10'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s10b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s10'");
            // }
            // if ($dt2['kolom'] == "s11") {
            //     $totcons = $s11b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s11b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s11'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s11b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s11'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s11b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s11'");
            // }
            // if ($dt2['kolom'] == "s12") {
            //     $totcons = $s12b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons',  bdownqty='$s12b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s12'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s12b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s12'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s12b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s12'");
            // }
            // if ($dt2['kolom'] == "s13") {
            //     $totcons = $s13b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s13b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s13'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s13b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s13'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s13b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s13'");
            // }
            // if ($dt2['kolom'] == "s14") {
            //     $totcons = $s14b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s14b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s14'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s14b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s14'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s14b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s14'");
            // }
            // if ($dt2['kolom'] == "s15") {
            //     $totcons = $s15b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s15b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s15'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s15b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s15'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s15b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s15'");
            // }
            // if ($dt2['kolom'] == "s16") {
            //     $totcons = $s16b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s16b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s16'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s16b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s16'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s16b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s16'");
            // }
            // if ($dt2['kolom'] == "s17") {
            //     $totcons = $s17b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s17b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s17'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s17b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s17'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s1b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s17'");
            // }
            // if ($dt2['kolom'] == "s18") {
            //     $totcons = $s18b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s18b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s18'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s18b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s18'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s18b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s18'");
            // }
            // if ($dt2['kolom'] == "s19") {
            //     $totcons = $s19b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s19b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s19'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s19b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s19'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s19b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s19'");
            // }
            // if ($dt2['kolom'] == "s20") {
            //     $totcons = $s20b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s20b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s20'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s20b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s20'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s20b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s20'");
            // }
            // if ($dt2['kolom'] == "s21") {
            //     $totcons = $s21b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s21b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s21'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s21b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s21'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s21b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s21'");
            // }
            // if ($dt2['kolom'] == "s22") {
            //     $totcons = $s22b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s22b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s22'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s22b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s22'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s22b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s22'");
            // }
            // if ($dt2['kolom'] == "s23") {
            //     $totcons = $s23b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s23b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s23'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s23b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s23'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s23b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s23'");
            // }
            // if ($dt2['kolom'] == "s24") {
            //     $totcons = $s24b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s24b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s24'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s24b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s24'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s24b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s24'");
            // }
            // if ($dt2['kolom'] == "s25") {
            //     $totcons = $s25b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s25b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s25'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s25b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s25'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s25b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s25'");
            // }
            // if ($dt2['kolom'] == "s26") {
            //     $totcons = $s26b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s26b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s26'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s26b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s26'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s26b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s26'");
            // }
            // if ($dt2['kolom'] == "s27") {
            //     $totcons = $s27b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s27b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s27'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s27b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s27'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s27b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s27'");
            // }
            // if ($dt2['kolom'] == "s28") {
            //     $totcons = $s28b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s28b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s28'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s28b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s28'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s28b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s28'");
            // }
            // if ($dt2['kolom'] == "s29") {
            //     $totcons = $s29b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s29b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s29'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s29b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s29'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s29b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s29'");
            // }
            // if ($dt2['kolom'] == "s30") {
            //     $totcons = $s30b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s30b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s30'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s30b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s30'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s30b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s30'");
            // }
            // if ($dt2['kolom'] == "s31") {
            //     $totcons = $s31b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s31b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s31'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s31b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s31'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s31b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s31'");
            // }
            // if ($dt2['kolom'] == "s32") {
            //     $totcons = $s32b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s32b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s32'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s32b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s32'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s32b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s32'");
            // }
            // if ($dt2['kolom'] == "s33") {
            //     $totcons = $s33b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s33b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s33'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s33b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s33'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s33b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s33'");
            // }
            // if ($dt2['kolom'] == "s34") {
            //     $totcons = $s34b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s34b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s34'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s34b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s34'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s34b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s34'");
            // }
            // if ($dt2['kolom'] == "s35") {
            //     $totcons = $s35b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s35b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s35'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s35b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s35'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s35b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s35'");
            // }
            // if ($dt2['kolom'] == "s36") {
            //     $totcons = $s36b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s36b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s36'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s36b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s36'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s36b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s36'");
            // }
            // if ($dt2['kolom'] == "s37") {
            //     $totcons = $s37b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s37b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s37'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s37b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s37'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s37b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s37'");
            // }
            // if ($dt2['kolom'] == "s38") {
            //     $totcons = $s38b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s38b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s38'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s38b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s38'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s38b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s38'");
            // }
            // if ($dt2['kolom'] == "s39") {
            //     $totcons = $s39b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s39b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s39'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s39b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s39'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s39b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s39'");
            // }
            // if ($dt2['kolom'] == "s40") {
            //     $totcons = $s40b * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s40b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s40'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s40b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s40'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s40b' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s40'");
            // }
            // if ($dt2['kolom'] == "tot") {
            //     $totcons = $gtotal * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$gtotal' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='tot'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$gtotal' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='tot'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$gtotal' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='tot'");
            // }
        }
    } else {
        $update = mysqli_query($koneksi, "insert into bdown set
            nour='$nour',
            s1='$s1b',
            s2='$s2b',
            s3='$s3b',
            s4='$s4b',
            s5='$s5b',
            s6='$s6b',
            s7='$s7b',
            s8='$s8b',
            s9='$s9b',
            s10='$s10b',
            s11='$s11b',
            s12='$s12b',
            s13='$s13b',
            s14='$s14b',
            s15='$s15b',
            s16='$s16',
            s17='$s17',
            s18='$s18',
            s19='$s19',
            s20='$s20',
            s21='$s21',
            s22='$s22',
            s23='$s23',
            s24='$s24',
            s25='$s25',
            s26='$s26',
            s27='$s27',
            s28='$s28',
            s29='$s29',
            s30='$s30',
            s31='$s31',
            s32='$s32',
            s33='$s33',
            s34='$s34',
            s35='$s35',
            s36='$s36',
            s37='$s37',
            s38='$s38',
            s39='$s39',
            s40='$s40',
            tot='$gtotal',
            ordpk='$ord',
            sumby='total',
            jenis='FOOTER1'");
    }
}

$bycontry = array();
$bycontry[] = array(
    'secsz' => 'By Place',
);

//footer_country
$rs2c = mysqli_query($koneksi, "SELECT bdown.color, bdown.country, ord.ordpk, 
SUM(bdown.s1) AS s1,
SUM(bdown.s2) AS s2,
SUM(bdown.s3) AS s3,
SUM(bdown.s4) AS s4,
SUM(bdown.s5) AS s5,
SUM(bdown.s6) AS s6,
SUM(bdown.s7) AS s7,
SUM(bdown.s8) AS s8,
SUM(bdown.s9) AS s9,
SUM(bdown.s10) AS s10,
SUM(bdown.s11) AS s11,
SUM(bdown.s12) AS s12,
SUM(bdown.s13) AS s13,
SUM(bdown.s14) AS s14,
SUM(bdown.s15) AS s15,
SUM(bdown.s16) AS s16,
SUM(bdown.s17) AS s17,
SUM(bdown.s18) AS s18,
SUM(bdown.s19) AS s19,
SUM(bdown.s20) AS s20,
SUM(bdown.s21) AS s21,
SUM(bdown.s22) AS s22,
SUM(bdown.s23) AS s23,
SUM(bdown.s24) AS s24,
SUM(bdown.s25) AS s25,
SUM(bdown.s26) AS s26,
SUM(bdown.s27) AS s27,
SUM(bdown.s28) AS s28,
SUM(bdown.s29) AS s29,
SUM(bdown.s30) AS s30,
SUM(bdown.s31) AS s31,
SUM(bdown.s32) AS s32,
SUM(bdown.s33) AS s33,
SUM(bdown.s34) AS s34,
SUM(bdown.s35) AS s35,
SUM(bdown.s36) AS s36,
SUM(bdown.s37) AS s37,
SUM(bdown.s38) AS s38,
SUM(bdown.s39) AS s39,
SUM(bdown.s40) AS s40
FROM bdown
LEFT OUTER JOIN ord ON ord.ordpk=bdown.ordpk
where ord.ordpk='$ord' and bdown.country<>'' and bdown.color<>'' $and1 $and3 $and4 AND bdown.jenis='DETAIL' and bdown.tot>'0'
GROUP BY bdown.country order by bdown.country asc");
$entryc = array();
while ($row2c = mysqli_fetch_array($rs2c)) {

    // for ($i = 1; $i <= 25; $i++) {
    //     $key = 's' . $i;
    //     ${$key . 'c'} = ($row2c[$key] < 1) ? "0" : $row2c[$key];
    // }
    for ($i = 1; $i <= 25; $i++) {
        $key = 's' . $i;
        // Ikuti status aktif dari HEADER:
        // - aktif (ada size di header) & qty < 1 -> tampil "0"
        // - tidak aktif (tidak ada size di header) -> tetap kosong ""
        if (!empty($activeSize[$i])) {
            ${$key . 'c'} = ($row2c[$key] < 1) ? "0" : $row2c[$key];
        } else {
            ${$key . 'c'} = "";
        }
    }

    $totalc = $s1c + $s2c + $s3c + $s4c + $s5c + $s6c + $s7c + $s8c + $s9c + $s10c + $s11c + $s12c + $s13c + $s14c + $s15c +
        $s16c + $s17c + $s18c + $s19c + $s20c + $s21c + $s22c + $s23c + $s24c + $s25c + $s26c + $s27c + $s28c + $s29c + $s30c +
        $s31c + $s32c + $s33c + $s34c + $s35c + $s36c + $s37c + $s38c + $s39c + $s40c;

    //if($cari3=="Place"){$ftr=$row2['country'];}
//else if($cari3=="Color"){$ftr=$row2['color'];}
//else {$ftr=$row2['color'];}

    $ftrc = $row2c['country'];
    $entryc[] = array(
        'secsz' => $ftrc,
        's1' => $s1c,
        's2' => $s2c,
        's3' => $s3c,
        's4' => $s4c,
        's5' => $s5c,
        's6' => $s6c,
        's7' => $s7c,
        's8' => $s8c,
        's9' => $s9c,
        's10' => $s10c,
        's11' => $s11c,
        's12' => $s12c,
        's13' => $s13c,
        's14' => $s14c,
        's15' => $s15c,
        's16' => $s16c,
        's17' => $s17c,
        's18' => $s18c,
        's19' => $s19c,
        's20' => $s20c,
        's21'=> $s21c,
        's22'=> $s22c,
        's23'=> $s23c,
        's24'=> $s24c,
        's25'=> $s25c,
        // 's26'=> $s26c,
        // 's27'=> $s27c,
        // 's28'=> $s28c,
        // 's29'=> $s29c,
        // 's30'=> $s30c,
        // 's31'=> $s31c,
        // 's32'=> $s32c,
        // 's33'=> $s33c,
        // 's34'=> $s34c,
        // 's35'=> $s35c,
        // 's36'=> $s36c,
        // 's37'=> $s37c,
        // 's38'=> $s38c,
        // 's39'=> $s39c,
        // 's40'=> $s40c,
        'tot' => "<b>" . $totalc . "<b>"
    );

    $cr = mysqli_query($koneksi, "select * from bdown where ordpk='$ord' and sumby='country' and sumdata='$ftrc' and jenis='FOOTER1'");
    $dt = mysqli_fetch_array($cr);
    $bdownpk = $dt['bdownpk'];
    $cr1 = mysqli_query($koneksi, "select * from bdown where ordpk='$ord' and jenis='DETAIL' order by nour desc limit 1");
    $dt1 = mysqli_fetch_array($cr1);
    $nour = $dt1['nour'] + 1;
    if ($bdownpk > 0) {
        $update = mysqli_query($koneksi, "update bdown set
        sumdata='$ftrc',
        nour='$nour',
        s1='$s1c',
        s2='$s2c',
        s3='$s3c',
        s4='$s4c',
        s5='$s5c',
        s6='$s6c',
        s7='$s7c',
        s8='$s8c',
        s9='$s9c',
        s10='$s10c',
        s11='$s11c',
        s12='$s12c',
        s13='$s13c',
        s14='$s14c',
        s15='$s15c',
        s16='$s16c',
        s17='$s17c',
        s18='$s18c',
        s19='$s19c',
        s20='$s20c',
        s21='$s21c',
        s22='$s22c',
        s23='$s23c',
        s24='$s24c',
        s25='$s25c',
        s26='$s26c',
        s27='$s27c',
        s28='$s28c',
        s29='$s29c',
        s30='$s30c',
        s31='$s31c',
        s32='$s32c',
        s33='$s33c',
        s34='$s34c',
        s35='$s35c',
        s36='$s36c',
        s37='$s37c',
        s38='$s38c',
        s39='$s39c',
        s40='$s40c',
        tot='$totalc' where bdownpk='$bdownpk'");
        $cr2 = mysqli_query($koneksi, "select * from rkb where ordpk='$ord' and bdownpk='$bdownpk' and popk is null and stspk is null");
        while ($dt2 = mysqli_fetch_array($cr2)) {
            for ($i = 1; $i <= 25; $i++) {
            $kolom = 's' . $i;
            $sVal = ${$kolom . 'c'}; // ambil nilai $s1c, $s2c, ... $s25c

            if ($dt2['kolom'] == $kolom) {
                    $totcons = $sVal * $dt2['estcons'];

                    $f1a = substr($dt2['f1'], 0, 1);
                    $f1b = substr($dt2['f1'], 1, 10);
                    $f2a = substr($dt2['f2'], 0, 1);
                    $f2b = substr($dt2['f2'], 1, 10);

                    if ($f1a == "-") {
                        $totcons2 = $totcons - $f1b;
                    } else if ($f1a == "*") {
                        $totcons2 = $totcons * $f1b;
                    } else if ($f1a == "/") {
                        $totcons2 = $totcons / $f1b;
                    } else {
                        $totcons2 = $totcons + $f1b;
                    }

                    if ($f2a == "-") {
                        $totcons3 = $totcons2 - $f2b;
                    } else if ($f2a == "*") {
                        $totcons3 = $totcons2 * $f2b;
                    } else if ($f2a == "/") {
                        $totcons3 = $totcons2 / $f2b;
                    } else {
                        $totcons3 = $totcons2 + $f2b;
                    }

                    if ($totcons3 > 0) {
                        $ttotcons = $totcons3;
                    } else if ($totcons2 > 0) {
                        $ttotcons = $totcons2;
                    } else {
                        $ttotcons = $totcons;
                    }

                    $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);

                    $sql2  = mysqli_query($koneksi, "update rkb  set pocons='$pocons', totcons='$ttotcons', bdownqty='$sVal' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='$kolom'");
                    $sql2b = mysqli_query($koneksi, "update rpo  set pocons='$pocons', totcons='$ttotcons', bdownqty='$sVal' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='$kolom'");
                    $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$sVal' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='$kolom'");
                }
            }
            // if ($dt2['kolom'] == "s1") {
            //     $totcons = $s1c * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s1c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s1'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s1c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s1'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s1c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s1'");
            // }
            // if ($dt2['kolom'] == "s2") {
            //     $totcons = $s2c * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s2c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s2'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s2c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s2'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s2c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s2'");
            // }
            // if ($dt2['kolom'] == "s3") {
            //     $totcons = $s3c * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s3c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s3'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s3c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s3'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s3c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s3'");
            // }
            // if ($dt2['kolom'] == "s4") {
            //     $totcons = $s4c * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = $ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman'];
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s4c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s4'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s4c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s4'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s4c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s4'");
            // }
            // if ($dt2['kolom'] == "s5") {
            //     $totcons = $s5c * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s5c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s5'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s5c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s5'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s5c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s5'");
            // }
            // if ($dt2['kolom'] == "s6") {
            //     $totcons = $s6c * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s6c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s6'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s6c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s6'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s6c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s6'");
            // }
            // if ($dt2['kolom'] == "s7") {
            //     $totcons = $s7c * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s7c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s7'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s7c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s7'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s7c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s7'");
            // }
            // if ($dt2['kolom'] == "s8") {
            //     $totcons = $s8c * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s8c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s8'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s8c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s8'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s8c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s8'");
            // }
            // if ($dt2['kolom'] == "s9") {
            //     $totcons = $s9c * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s9c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s9'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s9c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s9'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s9c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s9'");
            // }
            // if ($dt2['kolom'] == "s10") {
            //     $totcons = $s10c * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s10c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s10'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s10c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s10'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s10c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s10'");
            // }
            // if ($dt2['kolom'] == "s11") {
            //     $totcons = $s11c * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s11c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s11'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s11c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s11'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s11c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s11'");
            // }
            // if ($dt2['kolom'] == "s12") {
            //     $totcons = $s12c * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons',  bdownqty='$s12c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s12'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s12c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s12'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s12c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s12'");
            // }
            // if ($dt2['kolom'] == "s13") {
            //     $totcons = $s13c * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s13c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s13'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s13c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s13'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s13c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s13'");
            // }
            // if ($dt2['kolom'] == "s14") {
            //     $totcons = $s14c * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s14c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s14'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s14c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s14'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s14c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s14'");
            // }
            // if ($dt2['kolom'] == "s15") {
            //     $totcons = $s15c * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s15c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s15'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s15c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s15'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s15c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s15'");
            // }
            // if ($dt2['kolom'] == "s16") {
            //     $totcons = $s16c * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s16c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s16'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s16c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s16'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s16c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s16'");
            // }
            // if ($dt2['kolom'] == "s17") {
            //     $totcons = $s17c * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s17c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s17'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s17c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s17'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s17c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s17'");
            // }
            // if ($dt2['kolom'] == "s18") {
            //     $totcons = $s18c * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s18c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s18'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s18c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s18'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s18c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s18'");
            // }
            // if ($dt2['kolom'] == "s19") {
            //     $totcons = $s19c * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s19c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s19'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s19c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s19'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s19c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s19'");
            // }
            // if ($dt2['kolom'] == "s20") {
            //     $totcons = $s20 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s20c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s20'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s20c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s20'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s20c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s20'");
            // }
            // if($dt2['kolom']=="s21"){
// $totcons=$s21c*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s21c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s21'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s21c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s21'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s21c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s21'");
// }
// if($dt2['kolom']=="s22"){
// $totcons=$s22c*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s22c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s22'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s22c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s22'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s22c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s22'");
// }
// if($dt2['kolom']=="s23"){
// $totcons=$s23c*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s23c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s23'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s23c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s23'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s23c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s23'");
// }
// if($dt2['kolom']=="s24"){
// $totcons=$s24c*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s24c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s24'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s24c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s24'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s24c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s24'");
// }
// if($dt2['kolom']=="s25"){
// $totcons=$s25c*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s25c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s25'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s25c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s25'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s25c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s25'");
// }
// if($dt2['kolom']=="s26"){
// $totcons=$s26c*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s26c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s26'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s26c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s26'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s26c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s26'");
// }
// if($dt2['kolom']=="s27"){
// $totcons=$s27c*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s27c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s27'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s27c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s27'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s27c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s27'");
// }
// if($dt2['kolom']=="s28"){
// $totcons=$s28c*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s28c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s28'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s28c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s28'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s28c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s28'");
// }
// if($dt2['kolom']=="s29"){
// $totcons=$s29c*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s29c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s29'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s29c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s29'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s29c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s29'");
// }
// if($dt2['kolom']=="s30"){
// $totcons=$s30c*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s30c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s31'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s30c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s31'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s30c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s31'");
// }
// if($dt2['kolom']=="s31"){
// $totcons=$s31c*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s31c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s31'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s31c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s31'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s31c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s31'");
// }
// if($dt2['kolom']=="s32"){
// $totcons=$s32c*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s32c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s32'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s32c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s32'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s32c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s32'");
// }
// if($dt2['kolom']=="s33"){
// $totcons=$s33c*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s33c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s33'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s33c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s33'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s33c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s33'");
// }
// if($dt2['kolom']=="s34"){
// $totcons=$s34c*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s34c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s34'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s34c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s34'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s34c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s34'");
// }
// if($dt2['kolom']=="s35"){
// $totcons=$s35c*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s35c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s35'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s35c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s35'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s35c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s35'");
// }
// if($dt2['kolom']=="s36"){
// $totcons=$s36c*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s36c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s36'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s36c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s36'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s36c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s36'");
// }
// if($dt2['kolom']=="s37"){
// $totcons=$s37c*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s37c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s37'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s37c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s37'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s37c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s37'");
// }
// if($dt2['kolom']=="s38"){
// $totcons=$s38c*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s38c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s38'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s38c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s38'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s38c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s38'");
// }
// if($dt2['kolom']=="s39"){
// $totcons=$s39c*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s39c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s39'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s39c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s39'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s39c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s39'");
// }
// if($dt2['kolom']=="s40"){
// $totcons=$s40c*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s40c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s40'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s40c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s40'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s40c' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s40'");
// }
// if($dt2['kolom']=="tot"){
// $totcons=$totalc*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }
// //$totcons=$dt2['estcons'];
// $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// //$pocons=$dt2['allowman'];
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$totalc' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='tot'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$totalc' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and andbdownpk='$bdownpk' and kolom='tot'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$totalc' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and and bdownpk='$bdownpk' and kolom='tot'");
// }
        }
    } else {
        $update = mysqli_query($koneksi, "insert into bdown set
        nour='$nour',
        s1='$s1c',
        s2='$s2c',
        s3='$s3c',
        s4='$s4c',
        s5='$s5c',
        s6='$s6c',
        s7='$s7c',
        s8='$s8c',
        s9='$s9c',
        s10='$s10c',
        s11='$s11c',
        s12='$s12c',
        s13='$s13c',
        s14='$s14c',
        s15='$s15c',
        s16='$s16',
        s17='$s17',
        s18='$s18',
        s19='$s19',
        s20='$s20',
        s21='$s21',
        s22='$s22',
        s23='$s23',
        s24='$s24',
        s25='$s25',
        s26='$s26',
        s27='$s27',
        s28='$s28',
        s29='$s29',
        s30='$s30',
        s31='$s31',
        s32='$s32',
        s33='$s33',
        s34='$s34',
        s35='$s35',
        s36='$s36',
        s37='$s37',
        s38='$s38',
        s39='$s39',
        s40='$s40',
        tot='$totalc',
        ordpk='$ord',
        sumby='country',
        sumdata='$ftrc',
        jenis='FOOTER1'");
    }
}

$bysecsz = array();
$bysecsz[] = array(
    'secsz' => 'By Sec. Size',
);

//footer_secsz
$rs2d = mysqli_query($koneksi, "SELECT bdown.secsz, bdown.country, ord.ordpk, 
SUM(bdown.s1) AS s1,
SUM(bdown.s2) AS s2,
SUM(bdown.s3) AS s3,
SUM(bdown.s4) AS s4,
SUM(bdown.s5) AS s5,
SUM(bdown.s6) AS s6,
SUM(bdown.s7) AS s7,
SUM(bdown.s8) AS s8,
SUM(bdown.s9) AS s9,
SUM(bdown.s10) AS s10,
SUM(bdown.s11) AS s11,
SUM(bdown.s12) AS s12,
SUM(bdown.s13) AS s13,
SUM(bdown.s14) AS s14,
SUM(bdown.s15) AS s15,
SUM(bdown.s16) AS s16,
SUM(bdown.s17) AS s17,
SUM(bdown.s18) AS s18,
SUM(bdown.s19) AS s19,
SUM(bdown.s20) AS s20,
SUM(bdown.s21) AS s21,
SUM(bdown.s22) AS s22,
SUM(bdown.s23) AS s23,
SUM(bdown.s24) AS s24,
SUM(bdown.s25) AS s25,
SUM(bdown.s26) AS s26,
SUM(bdown.s27) AS s27,
SUM(bdown.s28) AS s28,
SUM(bdown.s29) AS s29,
SUM(bdown.s30) AS s30,
SUM(bdown.s31) AS s31,
SUM(bdown.s32) AS s32,
SUM(bdown.s33) AS s33,
SUM(bdown.s34) AS s34,
SUM(bdown.s35) AS s35,
SUM(bdown.s36) AS s36,
SUM(bdown.s37) AS s37,
SUM(bdown.s38) AS s38,
SUM(bdown.s39) AS s39,
SUM(bdown.s40) AS s40
FROM bdown
LEFT OUTER JOIN ord ON ord.ordpk=bdown.ordpk
where ord.ordpk='$ord' and bdown.secsz<>'' and bdown.color<>'' $and1 $and3 $and4 AND bdown.jenis='DETAIL' and bdown.tot>'0'
GROUP BY bdown.secsz order by bdown.secsz asc");
$entryd = array();
while ($row2d = mysqli_fetch_array($rs2d)) {

    // for ($i = 1; $i <= 25; $i++) {
    //     $key = 's' . $i;
    //     ${$key} = ($row2d[$key] < 1) ? "0" : $row2d[$key];
    // }
        for ($i = 1; $i <= 25; $i++) {
        $key = 's' . $i;
        // Ikuti status aktif dari HEADER:
        // - aktif (ada size di header) & qty < 1 -> tampil "0"
        // - tidak aktif (tidak ada size di header) -> tetap kosong ""
        if (!empty($activeSize[$i])) {
            ${$key} = ($row2d[$key] < 1) ? "0" : $row2d[$key];
        } else {
            ${$key} = "";
        }
    }

    if ($row2d['tot'] < 1) {
        $tot = "0";
    } else {
        $tot = $row2d['tot'];
    }
    $total = $s1 + $s2 + $s3 + $s4 + $s5 + $s6 + $s7 + $s8 + $s9 + $s10 + $s11 + $s12 + $s13 + $s14 + $s15 +
        $s16 + $s17 + $s18 + $s19 + $s20 + $s21 + $s22 + $s23 + $s24 + $s25 + $s26 + $s27 + $s28 + $s29 + $s30 +
        $s31 + $s32 + $s33 + $s34 + $s35 + $s36 + $s37 + $s38 + $s39 + $s40;

    //if($cari3=="Place"){$ftr=$row2['country'];}
//else if($cari3=="Color"){$ftr=$row2['color'];}
//else {$ftr=$row2['color'];}

    $ftr = $row2d['secsz'];
    $entryd[] = array(
        'secsz' => $ftr,
        's1' => $s1,
        's2' => $s2,
        's3' => $s3,
        's4' => $s4,
        's5' => $s5,
        's6' => $s6,
        's7' => $s7,
        's8' => $s8,
        's9' => $s9,
        's10' => $s10,
        's11' => $s11,
        's12' => $s12,
        's13' => $s13,
        's14' => $s14,
        's15' => $s15,
        's16' => $s16,
        's17' => $s17,
        's18' => $s18,
        's19' => $s19,
        's20' => $s20,
        's21'=>$s21,
        's22'=>$s22,
        's23'=>$s23,
        's24'=>$s24,
        's25'=>$s25,
        // 's26'=>$s26,
        // 's27'=>$s27,
        // 's28'=>$s28,
        // 's29'=>$s29,
        // 's30'=>$s30,
        // 's31'=>$s31,
        // 's32'=>$s32,
        // 's33'=>$s33,
        // 's34'=>$s34,
        // 's35'=>$s35,
        // 's36'=>$s36,
        // 's37'=>$s37,
        // 's38'=>$s38,
        // 's39'=>$s39,
        // 's40'=>$s40,
        'tot' => "<b>" . $total . "<b>"
    );

    $cr = mysqli_query($koneksi, "select * from bdown where ordpk='$ord' and sumby='secsz' and sumdata='$ftr' and jenis='FOOTER1'");
    $dt = mysqli_fetch_array($cr);
    $bdownpk = $dt['bdownpk'];
    $cr1 = mysqli_query($koneksi, "select * from bdown where ordpk='$ord' and jenis='DETAIL' order by nour desc limit 1");
    $dt1 = mysqli_fetch_array($cr1);
    $nour = $dt1['nour'] + 1;
    if ($bdownpk > 0) {
        $update = mysqli_query($koneksi, "update bdown set
                    sumdata='$ftr',
                    nour='$nour',
                    s1='$s1',
                    s2='$s2',
                    s3='$s3',
                    s4='$s4',
                    s5='$s5',
                    s6='$s6',
                    s7='$s7',
                    s8='$s8',
                    s9='$s9',
                    s10='$s10',
                    s11='$s11',
                    s12='$s12',
                    s13='$s13',
                    s14='$s14',
                    s15='$s15',
                    s16='$s16',
                    s17='$s17',
                    s18='$s18',
                    s19='$s19',
                    s20='$s20',
                    s21='$s21',
                    s22='$s22',
                    s23='$s23',
                    s24='$s24',
                    s25='$s25',
                    s26='$s26',
                    s27='$s27',
                    s28='$s28',
                    s29='$s29',
                    s30='$s30',
                    s31='$s31',
                    s32='$s32',
                    s33='$s33',
                    s34='$s34',
                    s35='$s35',
                    s36='$s36',
                    s37='$s37',
                    s38='$s38',
                    s39='$s39',
                    s40='$s40',
                    tot='$total' where bdownpk='$bdownpk'");
        $cr2 = mysqli_query($koneksi, "select * from rkb where ordpk='$ord' and bdownpk='$bdownpk' and popk is null and stspk is null");
        while ($dt2 = mysqli_fetch_array($cr2)) {
            for ($i = 1; $i <= 25; $i++) {
            $kolom = 's' . $i;
            $sVal = ${$kolom}; // ambil nilai $s1, $s2, ... $s25 (variable variable)

            if ($dt2['kolom'] == $kolom) {
                    $totcons = $sVal * $dt2['estcons'];

                    $f1a = substr($dt2['f1'], 0, 1);
                    $f1b = substr($dt2['f1'], 1, 10);
                    $f2a = substr($dt2['f2'], 0, 1);
                    $f2b = substr($dt2['f2'], 1, 10);

                    if ($f1a == "-") {
                        $totcons2 = $totcons - $f1b;
                    } else if ($f1a == "*") {
                        $totcons2 = $totcons * $f1b;
                    } else if ($f1a == "/") {
                        $totcons2 = $totcons / $f1b;
                    } else {
                        $totcons2 = $totcons + $f1b;
                    }

                    if ($f2a == "-") {
                        $totcons3 = $totcons2 - $f2b;
                    } else if ($f2a == "*") {
                        $totcons3 = $totcons2 * $f2b;
                    } else if ($f2a == "/") {
                        $totcons3 = $totcons2 / $f2b;
                    } else {
                        $totcons3 = $totcons2 + $f2b;
                    }

                    if ($totcons3 > 0) {
                        $ttotcons = $totcons3;
                    } else if ($totcons2 > 0) {
                        $ttotcons = $totcons2;
                    } else {
                        $ttotcons = $totcons;
                    }

                    $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);

                    $sql2  = mysqli_query($koneksi, "update rkb  set pocons='$pocons', totcons='$ttotcons', bdownqty='$sVal' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='$kolom'");
                    $sql2b = mysqli_query($koneksi, "update rpo  set pocons='$pocons', totcons='$ttotcons', bdownqty='$sVal' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='$kolom'");
                    $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$sVal' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='$kolom'");
                }
            }
            // if ($dt2['kolom'] == "s1") {
            //     $totcons = $s1 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s1' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s1'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s1' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s1'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s1' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s1'");
            // }
            // if ($dt2['kolom'] == "s2") {
            //     $totcons = $s2 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s2' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s2'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s2' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s2'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s2' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s2'");
            // }
            // if ($dt2['kolom'] == "s3") {
            //     $totcons = $s3 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s3' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s3'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s3' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s3'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s3' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s3'");
            // }
            // if ($dt2['kolom'] == "s4") {
            //     $totcons = $s4 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s4' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s4'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s4' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s4'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s4' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s4'");
            // }
            // if ($dt2['kolom'] == "s5") {
            //     $totcons = $s5 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s5' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s5'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s5' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s5'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s5' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s5'");
            // }
            // if ($dt2['kolom'] == "s6") {
            //     $totcons = $s6 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s6' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s6'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s6' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s6'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s6' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s6'");
            // }
            // if ($dt2['kolom'] == "s7") {
            //     $totcons = $s7 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s7' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s7'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s7' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s7'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s7' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s7'");
            // }
            // if ($dt2['kolom'] == "s8") {
            //     $totcons = $s8 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s8' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s8'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s8' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s8'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s8' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s8'");
            // }
            // if ($dt2['kolom'] == "s9") {
            //     $totcons = $s9 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s9' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s9'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s9' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s9'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s9' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s9'");
            // }
            // if ($dt2['kolom'] == "s10") {
            //     $totcons = $s10 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s10' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s10'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s10' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s10'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s10' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s10'");
            // }
            // if ($dt2['kolom'] == "s11") {
            //     $totcons = $s11 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s11' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s11'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s11' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s11'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s11' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s11'");
            // }
            // if ($dt2['kolom'] == "s12") {
            //     $totcons = $s12 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons',  bdownqty='$s12' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s12'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s12' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s12'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s12' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s12'");
            // }
            // if ($dt2['kolom'] == "s13") {
            //     $totcons = $s13 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s13' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s13'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s13' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s13'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s13' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s13'");
            // }
            // if ($dt2['kolom'] == "s14") {
            //     $totcons = $s14 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s14' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s14'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s14' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s14'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s14' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s14'");
            // }
            // if ($dt2['kolom'] == "s15") {
            //     $totcons = $s15 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s15' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s15'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s15' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s15'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s15' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s15'");
            // }
            // if ($dt2['kolom'] == "s16") {
            //     $totcons = $s16 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s16' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s16'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s16' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s16'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s16' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s16'");
            // }
            // if ($dt2['kolom'] == "s17") {
            //     $totcons = $s17 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s17' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s17'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s17' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s17'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s17' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s17'");
            // }
            // if ($dt2['kolom'] == "s18") {
            //     $totcons = $s18 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s18' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s18'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s18' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s18'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s18' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s18'");
            // }
            // if ($dt2['kolom'] == "s19") {
            //     $totcons = $s19 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s19' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s19'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s19' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s19'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s19' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s19'");
            // }
            // if ($dt2['kolom'] == "s20") {
            //     $totcons = $s20 * $dt2['estcons'];

            //     $f1a = substr($dt2['f1'], 0, 1);
            //     $f1b = substr($dt2['f1'], 1, 10);
            //     $f2a = substr($dt2['f2'], 0, 1);
            //     $f2b = substr($dt2['f2'], 1, 10);

            //     if ($f1a == "-") {
            //         $totcons2 = $totcons - $f1b;
            //     } else if ($f1a == "*") {
            //         $totcons2 = $totcons * $f1b;
            //     } else if ($f1a == "/") {
            //         $totcons2 = $totcons / $f1b;
            //     } else {
            //         $totcons2 = $totcons + $f1b;
            //     }

            //     if ($f2a == "-") {
            //         $totcons3 = $totcons2 - $f2b;
            //     } else if ($f2a == "*") {
            //         $totcons3 = $totcons2 * $f2b;
            //     } else if ($f2a == "/") {
            //         $totcons3 = $totcons2 / $f2b;
            //     } else {
            //         $totcons3 = $totcons2 + $f2b;
            //     }

            //     if ($totcons3 > 0) {
            //         $ttotcons = $totcons3;
            //     } else if ($totcons2 > 0) {
            //         $ttotcons = $totcons2;
            //     } else {
            //         $ttotcons = $totcons;
            //     }

            //     $pocons = ceil($ttotcons + (($ttotcons * $dt2['allowcons']) / 100) + $dt2['qrs'] + $dt2['allowman']);
            //     $sql2 = mysqli_query($koneksi, "update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s20' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s20'");
            //     $sql2b = mysqli_query($koneksi, "update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s20' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s20'");
            //     $sql2c = mysqli_query($koneksi, "update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s20' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s20'");
            // }
            // if($dt2['kolom']=="s21"){
// $totcons=$s21*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s21' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s21'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s21' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s21'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s21' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s21'");
// }
// if($dt2['kolom']=="s22"){
// $totcons=$s22*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s22' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s22'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s22' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s22'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s22' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s22'");
// }
// if($dt2['kolom']=="s23"){
// $totcons=$s23*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s23' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s23'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s23' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s23'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s23' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s23'");
// }
// if($dt2['kolom']=="s24"){
// $totcons=$s24*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s24' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s24'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s24' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s24'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s24' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s24'");
// }
// if($dt2['kolom']=="s25"){
// $totcons=$s25*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s25' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s25'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s25' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s25'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s25' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s25'");
// }
// if($dt2['kolom']=="s26"){
// $totcons=$s26*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s26' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s26'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s26' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s26'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s26' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s26'");
// }
// if($dt2['kolom']=="s27"){
// $totcons=$s27*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s27' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s27'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s27' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s27'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s27' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s27'");
// }
// if($dt2['kolom']=="s28"){
// $totcons=$s28*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s28' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s28'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s28' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s28'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s28' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s28'");
// }
// if($dt2['kolom']=="s29"){
// $totcons=$s29*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s29' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s29'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s29' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s29'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s29' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s29'");
// }
// if($dt2['kolom']=="s30"){
// $totcons=$s30*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s30' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s31'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s30' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s31'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s30' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s31'");
// }
// if($dt2['kolom']=="s31"){
// $totcons=$s31*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s31' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s31'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s31' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s31'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s31' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s31'");
// }
// if($dt2['kolom']=="s32"){
// $totcons=$s32*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s32' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s32'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s32' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s32'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s32' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s32'");
// }
// if($dt2['kolom']=="s33"){
// $totcons=$s33*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s33' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s33'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s33' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s33'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s33' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s33'");
// }
// if($dt2['kolom']=="s34"){
// $totcons=$s34*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s34' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s34'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s34' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s34'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s34' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s34'");
// }
// if($dt2['kolom']=="s35"){
// $totcons=$s35*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s35' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s35'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s35' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s35'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s35' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s35'");
// }
// if($dt2['kolom']=="s36"){
// $totcons=$s36*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s36' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s36'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s36' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s36'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s36' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s36'");
// }
// if($dt2['kolom']=="s37"){
// $totcons=$s37*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s37' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s37'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s37' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s37'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s37' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s37'");
// }
// if($dt2['kolom']=="s38"){
// $totcons=$s38*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s38' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s38'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s38' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s38'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s38' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s38'");
// }
// if($dt2['kolom']=="s39"){
// $totcons=$s39*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s39' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s39'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s39' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s39'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s39' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s39'");
// }
// if($dt2['kolom']=="s40"){
// $totcons=$s40*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }

            // $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$s40' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s40'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$s40' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s40'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$s40' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='s40'");
// }
// if($dt2['kolom']=="tot"){
// $totcons=$total*$dt2['estcons'];

            // $f1a = substr($dt2['f1'],0,1);
// $f1b = substr($dt2['f1'],1,10);
// $f2a = substr($dt2['f2'],0,1);
// $f2b = substr($dt2['f2'],1,10);

            // if($f1a=="-"){
// $totcons2=$totcons-$f1b;
// } else if($f1a=="*"){
// $totcons2=$totcons*$f1b;
// } else if($f1a=="/"){
// $totcons2=$totcons/$f1b;
// } else {
// $totcons2=$totcons+$f1b;
// }

            // if($f2a=="-"){
// $totcons3=$totcons2-$f2b;
// } else if($f2a=="*"){
// $totcons3=$totcons2*$f2b;
// } else if($f2a=="/"){
// $totcons3=$totcons2/$f2b;
// } else {
// $totcons3=$totcons2+$f2b;
// }

            // if($totcons3>0){
// $ttotcons=$totcons3;
// } else if($totcons2>0){
// $ttotcons=$totcons2;
// } else {
// $ttotcons=$totcons;    
// }
// //$totcons=$dt2['estcons'];
// $pocons=ceil($ttotcons+(($ttotcons*$dt2['allowcons'])/100)+$dt2['qrs']+$dt2['allowman']);
// //$pocons=$dt2['allowman'];
// $sql2=mysqli_query($koneksi,"update rkb set pocons='$pocons', totcons='$ttotcons', bdownqty='$total' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and bdownpk='$bdownpk' and kolom='tot'");
// $sql2b=mysqli_query($koneksi,"update rpo set pocons='$pocons', totcons='$ttotcons', bdownqty='$total' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and andbdownpk='$bdownpk' and kolom='tot'");
// $sql2c=mysqli_query($koneksi,"update podt set pocons='$pocons', totcons='$ttotcons', bdownqty='$total' where rkbpk='$dt2[rkbpk]' and ordpk='$ord' and and bdownpk='$bdownpk' and kolom='tot'");
// }
        }
    } else {
        $update = mysqli_query($koneksi, "insert into bdown set
        nour='$nour',
        s1='$s1',
        s2='$s2',
        s3='$s3',
        s4='$s4',
        s5='$s5',
        s6='$s6',
        s7='$s7',
        s8='$s8',
        s9='$s9',
        s10='$s10',
        s11='$s11',
        s12='$s12',
        s13='$s13',
        s14='$s14',
        s15='$s15',
        s16='$s16',
        s17='$s17',
        s18='$s18',
        s19='$s19',
        s20='$s20',
        s21='$s21',
        s22='$s22',
        s23='$s23',
        s24='$s24',
        s25='$s25',
        s26='$s26',
        s27='$s27',
        s28='$s28',
        s29='$s29',
        s30='$s30',
        s31='$s31',
        s32='$s32',
        s33='$s33',
        s34='$s34',
        s35='$s35',
        s36='$s36',
        s37='$s37',
        s38='$s38',
        s39='$s39',
        s40='$s40',
        tot='$total',
        ordpk='$ord',
        sumby='secsz',
        sumdata='$ftr',
        jenis='FOOTER1'");
    }
}

$bypcd = array();
$bypcd[] = array(
    'secsz' => 'By PCD',
);

//footer_pcd
$rs2e = mysqli_query($koneksi, "SELECT bdown.pcd, bdown.country, ord.ordpk, 
SUM(bdown.s1) AS s1,
SUM(bdown.s2) AS s2,
SUM(bdown.s3) AS s3,
SUM(bdown.s4) AS s4,
SUM(bdown.s5) AS s5,
SUM(bdown.s6) AS s6,
SUM(bdown.s7) AS s7,
SUM(bdown.s8) AS s8,
SUM(bdown.s9) AS s9,
SUM(bdown.s10) AS s10,
SUM(bdown.s11) AS s11,
SUM(bdown.s12) AS s12,
SUM(bdown.s13) AS s13,
SUM(bdown.s14) AS s14,
SUM(bdown.s15) AS s15,
SUM(bdown.s16) AS s16,
SUM(bdown.s17) AS s17,
SUM(bdown.s18) AS s18,
SUM(bdown.s19) AS s19,
SUM(bdown.s20) AS s20,
SUM(bdown.s21) AS s21,
SUM(bdown.s22) AS s22,
SUM(bdown.s23) AS s23,
SUM(bdown.s24) AS s24,
SUM(bdown.s25) AS s25,
SUM(bdown.s26) AS s26,
SUM(bdown.s27) AS s27,
SUM(bdown.s28) AS s28,
SUM(bdown.s29) AS s29,
SUM(bdown.s30) AS s30,
SUM(bdown.s31) AS s31,
SUM(bdown.s32) AS s32,
SUM(bdown.s33) AS s33,
SUM(bdown.s34) AS s34,
SUM(bdown.s35) AS s35,
SUM(bdown.s36) AS s36,
SUM(bdown.s37) AS s37,
SUM(bdown.s38) AS s38,
SUM(bdown.s39) AS s39,
SUM(bdown.s40) AS s40
FROM bdown
LEFT OUTER JOIN ord ON ord.ordpk=bdown.ordpk
where ord.ordpk='$ord' and bdown.pcd<>'0000-00-00' and bdown.pcd is not null and bdown.color<>'' $and1 $and3 $and4 AND bdown.jenis='DETAIL' and bdown.tot>'0'
GROUP BY bdown.pcd order by bdown.pcd asc");
$entrye = array();
while ($row2e = mysqli_fetch_array($rs2e)) {

    // for ($i = 1; $i <= 25; $i++) {
    //     $key = 's' . $i;
    //     ${$key} = ($row2e[$key] < 1) ? "0" : $row2e[$key];
    // }
    for ($i = 1; $i <= 25; $i++) {
        $key = 's' . $i;
        // Ikuti status aktif dari HEADER:
        // - aktif (ada size di header) & qty < 1 -> tampil "0"
        // - tidak aktif (tidak ada size di header) -> tetap kosong ""
        if (!empty($activeSize[$i])) {
            ${$key} = ($row2e[$key] < 1) ? "0" : $row2e[$key];
        } else {
            ${$key} = "";
        }
    }

    if ($row2e['tot'] < 1) {
        $tot = "0";
    } else {
        $tot = $row2e['tot'];
    }
    $total = $s1 + $s2 + $s3 + $s4 + $s5 + $s6 + $s7 + $s8 + $s9 + $s10 + $s11 + $s12 + $s13 + $s14 + $s15 +
        $s16 + $s17 + $s18 + $s19 + $s20 + $s21 + $s22 + $s23 + $s24 + $s25 + $s26 + $s27 + $s28 + $s29 + $s30 +
        $s31 + $s32 + $s33 + $s34 + $s35 + $s36 + $s37 + $s38 + $s39 + $s40;

    //if($cari3=="Place"){$ftr=$row2['country'];}
//else if($cari3=="Color"){$ftr=$row2['color'];}
//else {$ftr=$row2['color'];}

    $ftr = $row2e['pcd'];
    $entrye[] = array(
        'secsz' => tgl2($ftr),
        's1' => $s1,
        's2' => $s2,
        's3' => $s3,
        's4' => $s4,
        's5' => $s5,
        's6' => $s6,
        's7' => $s7,
        's8' => $s8,
        's9' => $s9,
        's10' => $s10,
        's11' => $s11,
        's12' => $s12,
        's13' => $s13,
        's14' => $s14,
        's15' => $s15,
        's16' => $s16,
        's17' => $s17,
        's18' => $s18,
        's19' => $s19,
        's20' => $s20,
        's21'=>$s21,
        's22'=>$s22,
        's23'=>$s23,
        's24'=>$s24,
        's25'=>$s25,
        // 's26'=>$s26,
        // 's27'=>$s27,
        // 's28'=>$s28,
        // 's29'=>$s29,
        // 's30'=>$s30,
        // 's31'=>$s31,
        // 's32'=>$s32,
        // 's33'=>$s33,
        // 's34'=>$s34,
        // 's35'=>$s35,
        // 's36'=>$s36,
        // 's37'=>$s37,
        // 's38'=>$s38,
        // 's39'=>$s39,
        // 's40'=>$s40,
        'tot' => "<b>" . $total . "<b>"
    );

    $cr = mysqli_query($koneksi, "select * from bdown where ordpk='$ord' and sumby='pcd' and sumdata='$ftr' and jenis='FOOTER1'");
    $dt = mysqli_fetch_array($cr);
    $bdownpk = $dt['bdownpk'];
    $cr1 = mysqli_query($koneksi, "select * from bdown where ordpk='$ord' and jenis='DETAIL' order by nour desc limit 1");
    $dt1 = mysqli_fetch_array($cr1);
    $nour = $dt1['nour'] + 1;
    if ($bdownpk > 0) {
        $update = mysqli_query($koneksi, "update bdown set
        sumdata='$ftr',
        nour='$nour',
        s1='$s1',
        s2='$s2',
        s3='$s3',
        s4='$s4',
        s5='$s5',
        s6='$s6',
        s7='$s7',
        s8='$s8',
        s9='$s9',
        s10='$s10',
        s11='$s11',
        s12='$s12',
        s13='$s13',
        s14='$s14',
        s15='$s15',
        s16='$s16',
        s17='$s17',
        s18='$s18',
        s19='$s19',
        s20='$s20',
        s21='$s21',
        s22='$s22',
        s23='$s23',
        s24='$s24',
        s25='$s25',
        s26='$s26',
        s27='$s27',
        s28='$s28',
        s29='$s29',
        s30='$s30',
        s31='$s31',
        s32='$s32',
        s33='$s33',
        s34='$s34',
        s35='$s35',
        s36='$s36',
        s37='$s37',
        s38='$s38',
        s39='$s39',
        s40='$s40',
        tot='$total' where bdownpk='$bdownpk'");
    } else {
        $update = mysqli_query($koneksi, "insert into bdown set
        nour='$nour',
        s1='$s1',
        s2='$s2',
        s3='$s3',
        s4='$s4',
        s5='$s5',
        s6='$s6',
        s7='$s7',
        s8='$s8',
        s9='$s9',
        s10='$s10',
        s11='$s11',
        s12='$s12',
        s13='$s13',
        s14='$s14',
        s15='$s15',
        s16='$s16',
        s17='$s17',
        s18='$s18',
        s19='$s19',
        s20='$s20',
        s21='$s21',
        s22='$s22',
        s23='$s23',
        s24='$s24',
        s25='$s25',
        s26='$s26',
        s27='$s27',
        s28='$s28',
        s29='$s29',
        s30='$s30',
        s31='$s31',
        s32='$s32',
        s33='$s33',
        s34='$s34',
        s35='$s35',
        s36='$s36',
        s37='$s37',
        s38='$s38',
        s39='$s39',
        s40='$s40',
        tot='$total',
        ordpk='$ord',
        sumby='pcd',
        sumdata='$ftr',
        jenis='FOOTER1'");
    }
}

// $bycolsz = array();
// $bycolsz[] = array(
//     'secsz' => 'By Secsz & Col',
// );

// //footer_colsz
// $rs2f = mysqli_query($koneksi, "SELECT bdown.color, bdown.secsz, ord.ordpk, 
// SUM(bdown.s1) AS s1,
// SUM(bdown.s2) AS s2,
// SUM(bdown.s3) AS s3,
// SUM(bdown.s4) AS s4,
// SUM(bdown.s5) AS s5,
// SUM(bdown.s6) AS s6,
// SUM(bdown.s7) AS s7,
// SUM(bdown.s8) AS s8,
// SUM(bdown.s9) AS s9,
// SUM(bdown.s10) AS s10,
// SUM(bdown.s11) AS s11,
// SUM(bdown.s12) AS s12,
// SUM(bdown.s13) AS s13,
// SUM(bdown.s14) AS s14,
// SUM(bdown.s15) AS s15,
// SUM(bdown.s16) AS s16,
// SUM(bdown.s17) AS s17,
// SUM(bdown.s18) AS s18,
// SUM(bdown.s19) AS s19,
// SUM(bdown.s20) AS s20,
// SUM(bdown.s21) AS s21,
// SUM(bdown.s22) AS s22,
// SUM(bdown.s23) AS s23,
// SUM(bdown.s24) AS s24,
// SUM(bdown.s25) AS s25,
// SUM(bdown.s26) AS s26,
// SUM(bdown.s27) AS s27,
// SUM(bdown.s28) AS s28,
// SUM(bdown.s29) AS s29,
// SUM(bdown.s30) AS s30,
// SUM(bdown.s31) AS s31,
// SUM(bdown.s32) AS s32,
// SUM(bdown.s33) AS s33,
// SUM(bdown.s34) AS s34,
// SUM(bdown.s35) AS s35,
// SUM(bdown.s36) AS s36,
// SUM(bdown.s37) AS s37,
// SUM(bdown.s38) AS s38,
// SUM(bdown.s39) AS s39,
// SUM(bdown.s40) AS s40
// FROM bdown
// LEFT OUTER JOIN ord ON ord.ordpk=bdown.ordpk
// where ord.ordpk='$ord' and bdown.secsz<>'' and bdown.color<>'' $and1 $and3 $and4 AND bdown.jenis='DETAIL' and bdown.tot>'0'
// GROUP BY bdown.color, bdown.secsz order by bdown.color asc, bdown.secsz asc");
// $entryf = array();
// while ($row2f = mysqli_fetch_array($rs2f)) {

//     for ($i = 1; $i <= 25; $i++) {
//         $key = 's' . $i;
//         ${$key} = ($row2f[$key] < 1) ? "0" : $row2f[$key];
//     }
//     if ($row2f['tot'] < 1) {
//         $tot = "0";
//     } else {
//         $tot = $row2f['tot'];
//     }
//     $total = $s1 + $s2 + $s3 + $s4 + $s5 + $s6 + $s7 + $s8 + $s9 + $s10 + $s11 + $s12 + $s13 + $s14 + $s15 +
//         $s16 + $s17 + $s18 + $s19 + $s20 + $s21 + $s22 + $s23 + $s24 + $s25 + $s26 + $s27 + $s28 + $s29 + $s30 +
//         $s31 + $s32 + $s33 + $s34 + $s35 + $s36 + $s37 + $s38 + $s39 + $s40;

//     //if($cari3=="Place"){$ftr=$row2['country'];}
// //else if($cari3=="Color"){$ftr=$row2['color'];}
// //else {$ftr=$row2['color'];}

//     $ftr = $row2f['secsz']."/".$row2f['color'];
//     $entryf[] = array(
//         'secsz' =>$ftr,
//         's1' => $s1,
//         's2' => $s2,
//         's3' => $s3,
//         's4' => $s4,
//         's5' => $s5,
//         's6' => $s6,
//         's7' => $s7,
//         's8' => $s8,
//         's9' => $s9,
//         's10' => $s10,
//         's11' => $s11,
//         's12' => $s12,
//         's13' => $s13,
//         's14' => $s14,
//         's15' => $s15,
//         's16' => $s16,
//         's17' => $s17,
//         's18' => $s18,
//         's19' => $s19,
//         's20' => $s20,
//         's21'=>$s21,
//         's22'=>$s22,
//         's23'=>$s23,
//         's24'=>$s24,
//         's25'=>$s25,
//         // 's26'=>$s26,
//         // 's27'=>$s27,
//         // 's28'=>$s28,
//         // 's29'=>$s29,
//         // 's30'=>$s30,
//         // 's31'=>$s31,
//         // 's32'=>$s32,
//         // 's33'=>$s33,
//         // 's34'=>$s34,
//         // 's35'=>$s35,
//         // 's36'=>$s36,
//         // 's37'=>$s37,
//         // 's38'=>$s38,
//         // 's39'=>$s39,
//         // 's40'=>$s40,
//         'tot' => "<b>" . $total . "<b>"
//     );

//     $cr = mysqli_query($koneksi, "select * from bdown where ordpk='$ord' and sumby='colsz' and sumdata='$ftr' and jenis='FOOTER1'");
//     $dt = mysqli_fetch_array($cr);
//     $bdownpk = $dt['bdownpk'];
//     $cr1 = mysqli_query($koneksi, "select * from bdown where ordpk='$ord' and jenis='DETAIL' order by nour desc limit 1");
//     $dt1 = mysqli_fetch_array($cr1);
//     $nour = $dt1['nour'] + 1;
//     if ($bdownpk > 0) {
//         $update = mysqli_query($koneksi, "update bdown set
//         sumdata='$ftr',
//         nour='$nour',
//         s1='$s1',
//         s2='$s2',
//         s3='$s3',
//         s4='$s4',
//         s5='$s5',
//         s6='$s6',
//         s7='$s7',
//         s8='$s8',
//         s9='$s9',
//         s10='$s10',
//         s11='$s11',
//         s12='$s12',
//         s13='$s13',
//         s14='$s14',
//         s15='$s15',
//         s16='$s16',
//         s17='$s17',
//         s18='$s18',
//         s19='$s19',
//         s20='$s20',
//         s21='$s21',
//         s22='$s22',
//         s23='$s23',
//         s24='$s24',
//         s25='$s25',
//         s26='$s26',
//         s27='$s27',
//         s28='$s28',
//         s29='$s29',
//         s30='$s30',
//         s31='$s31',
//         s32='$s32',
//         s33='$s33',
//         s34='$s34',
//         s35='$s35',
//         s36='$s36',
//         s37='$s37',
//         s38='$s38',
//         s39='$s39',
//         s40='$s40',
//         tot='$total' where bdownpk='$bdownpk'");
//     } else {
//         $update = mysqli_query($koneksi, "insert into bdown set
//         nour='$nour',
//         s1='$s1',
//         s2='$s2',
//         s3='$s3',
//         s4='$s4',
//         s5='$s5',
//         s6='$s6',
//         s7='$s7',
//         s8='$s8',
//         s9='$s9',
//         s10='$s10',
//         s11='$s11',
//         s12='$s12',
//         s13='$s13',
//         s14='$s14',
//         s15='$s15',
//         s16='$s16',
//         s17='$s17',
//         s18='$s18',
//         s19='$s19',
//         s20='$s20',
//         s21='$s21',
//         s22='$s22',
//         s23='$s23',
//         s24='$s24',
//         s25='$s25',
//         s26='$s26',
//         s27='$s27',
//         s28='$s28',
//         s29='$s29',
//         s30='$s30',
//         s31='$s31',
//         s32='$s32',
//         s33='$s33',
//         s34='$s34',
//         s35='$s35',
//         s36='$s36',
//         s37='$s37',
//         s38='$s38',
//         s39='$s39',
//         s40='$s40',
//         tot='$total',
//         ordpk='$ord',
//         sumby='colsz',
//         sumdata='$ftr',
//         jenis='FOOTER1'");
//     }
// }

$footer = array_merge($bycol, $entry, $entryb);

if (!empty($entryc)) {
    $footer = array_merge($footer, $bycontry, $entryc, $entryb);
}

if (!empty($entryd)) {
    $footer = array_merge($footer, $bysecsz, $entryd, $entryb);
}

if (!empty($entrye)) {
    $footer = array_merge($footer, $bypcd, $entrye, $entryb);
}

// if (!empty($entryf)) {
//     $footer = array_merge($footer, $bycolsz, $entryf, $entryb);
// }

$result = array_merge($result, ['rows' => $row], ['footer' => $footer]);

// print_r($entryd);
echo json_encode($result);
?>