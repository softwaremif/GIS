<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'rkb.kelnm';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
/*$cari1 = isset($_POST['cari1']) ? ($_POST['cari1']) : false;
$cari2 = isset($_POST['cari2']) ? ($_POST['cari2']) : false;
$cari3 = isset($_POST['cari3']) ? ($_POST['cari3']) : false;
$cari4 = isset($_POST['cari4']) ? ($_POST['cari4']) : false;
$cari5 = isset($_POST['cari5']) ? ($_POST['cari5']) : false;
$cari6 = isset($_POST['cari6']) ? ($_POST['cari6']) : false;*/
$ord = isset($_GET['ord']) ? ($_GET['ord']) : false;
$cek = isset($_GET['cek']) ? ($_GET['cek']) : false;
/*$type0 = isset($_POST['type0']) ? ($_POST['type0']) : false;
$type1 = isset($_POST['type1']) ? ($_POST['type1']) : false;
$spec0 = isset($_POST['spec0']) ? ($_POST['spec0']) : false;
$spec1 = isset($_POST['spec1']) ? ($_POST['spec1']) : false;
$col0 = isset($_POST['col0']) ? ($_POST['col0']) : false;
$col1 = isset($_POST['col1']) ? ($_POST['col1']) : false;*/

$offset = ($page - 1) * $rows;

//type
/*if($type0==''){
$atype = array($type1);
}else if($type1==''){
$atype = array($type0);
}else{
$atype=array($type0,$type1);
}
$itype = implode("', '",$atype);

//spec
if($spec0==''){
$aspec = array($spec1);
}else if($spec1==''){
$aspec = array($spec0);
}else{
$aspec=array($spec0,$spec1);
}
$ispec = implode("', '",$aspec);

//color
if($col0==''){
$acol = array($col1);
}else if($col1==''){
$acol = array($col0);
}else{
$acol=array($col0,$col1);
}
$icol = implode("', '",$acol);

if($cari4==1){ $order="DESC"; } 
if($cari5==1){ $order="ASC"; }
else { $order="DESC"; }

if($cari1<>""){
$and1="and concat(rkb.item,sup.supnm,rkb.spec,rkb.sizegar,rkb.unit,rkb.colname) like '%$cari1%'";
}
if($cari2<>""){ $and2="and rkb.status='$cari2'"; }
if($cari3<>""){ $and3="and sup.supnm like '%$cari3%'"; }
/*if($cari6<>""){
if($cari6=="ALL"){ $and5=""; }
else { $and5="and rkb.kelnm like '%$cari6%'"; }
}*/

if ($cek > 0) {
    $and4 = "and rkb.status='$cek'";
}

/*if($type0<>"" || $type1<>""){
//$csupp="and sup.supnm LIKE '%$supp0%' or sup.supnm LIKE '%$supp1%'";
$ctype="and rkb.kelnm IN ('$itype')";
}
if($spec0<>"" || $spec1<>""){
$cspec="and rkb.spec IN ('$ispec')";
}
if($col0<>"" || $col1<>""){
$ccol="and rkb.colname IN ('$icol')";
}*/

$rs = mysqli_query($koneksi, "select * FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
left outer join cur on  cur.curpk=rkb.curpk
left outer join sup on sup.suppk=rkb.suppk
where rkb.spec<>'' and ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord' and rkb.stspk is null and rkb.status<=3 $and1 $and2 $and3 $and4
$ctype $cspec $ccol
ORDER BY $sort $order, rkb.nour desc, rkb.rkbpk desc");

$result = array();
$result['total'] = mysqli_num_rows(mysqli_query($koneksi, "select * FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
left outer join cur on  cur.curpk=rkb.curpk
left outer join sup on sup.suppk=rkb.suppk
where rkb.spec<>'' and ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord' and rkb.stspk is null and rkb.status<=3 $and1 $and2 $and3 $and4
$ctype $cspec $ccol"));
$row = array();

$k = $offset;
while ($data = mysqli_fetch_array($rs)) {
    $k++;

    //$btn = '<a href="?hal=detord&ord='.$data['ordpk'].'" style="text-decoration:none;">'.$data['ordno'].'</a>';
    if ($data['status'] == 1) {
        $sts = "In progress";
    } else if ($data['status'] == 2) {
        $sts = "Ready for PO";
    } else if ($data['status'] == 3) {
        $sts = "Need revision";
    } else if ($data['status'] == 4) {
        if ($data['stspk'] == 1) {
            $sts = "Req PO";
        } else if ($data['stspk'] == 2) {
            $sts = "PO Ready";
        } else if ($data['stspk'] == 4) {
            $sts = "Req Revised";
        } else if ($data['stspk'] == 5) {
            $sts = "Ready Revised";
        } else if ($data['stspk'] == 6) {
            $sts = "Req Cancel";
        } else if ($data['stspk'] == 7) {
            $sts = "Cancel PO";
        } else {
            $sts = "PO in process";
        }
    } else if ($data['status'] == 5) {
        $sts = "In Revision";
    } else if ($data['status'] == 6) {
        $sts = "Purchased";
    } else {
        $sts = "In progress";
    }

    if ($data['curid'] == "IDR") {
        if ($data['price'] == "0.00000") {
            $price = "-";
            $total = "-";
        } else {
            $price = number_format($data['price'], 0, ".", ",") . " " . $data['curid'];
            $price2 = number_format($data['price'], 0, ".", "");
            $tot = $data['price'] * $data['pocons'];
            $total = $data['curid'] . " " . number_format($tot, 0, ".", ",");
        }
    } else {
        if ($data['price'] == "0.00000") {
            $price = "-";
            $total = "-";
        } else {
            $price = number_format($data['price'], 3, ".", ",") . " " . $data['curid'];
            $price2 = number_format($data['price'], 3, ".", "");
            $tot = $data['price'] * $data['pocons'];
            $total = $data['curid'] . " " . number_format($tot, 3, ".", ",");
        }
    }

    $qty = number_format($data['bdownqty'], 0, ".", ",");
    $pocons = number_format($data['pocons'], 0, ".", ",");
    $kelnm = RTRIM($data['kelnm']);

    $cr = mysqli_query($koneksi, "select * from memo where rkbpk='$data[rkbpk]' and cek=1 order by memopk desc");
    $dt = mysqli_fetch_array($cr);

    $cr2 = mysqli_query($koneksi, "select * from po where popk='$data[popk]'");
    $dt2 = mysqli_fetch_array($cr2);

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
        $hspec1 = $data['hspec1'];
        $hspec2 = $data['hspec2'];
        $hspec3 = $data['hspec3'];
        $hspec4 = $data['hspec4'];
        $hspec5 = $data['hspec5'];
        $hspec6 = $data['hspec6'];
        $hspec7 = $data['hspec7'];
        $hspec8 = $data['hspec8'];
        $spec1 = $data['spec1'];
        $spec2 = $data['spec2'];
        $spec3 = $data['spec3'];
        $spec4 = $data['spec4'];
        $spec5 = $data['spec5'];
        $spec6 = $data['spec6'];
        $spec7 = $data['spec7'];
        $spec8 = $data['spec8'];
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

    if ($data['suppk'] == "1949") {
        $supnm2 = "<font style='color:rgba(0, 0, 0, 0.38)'>$data[supnm]</font>";
    } else {
        $supnm2 = $data['supnm'];
    }

    $row[] = array(
        'no' => $k,
        'ordpk' => $data['ordpk'],
        'ordno' => $data['ordno'],
        'suppk' => $data['suppk'],
        'supnm' => $data['supnm'],
        'supnm2' => $supnm2,
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
        'price2' => $data['price'],
        //'price2'=>$data['price'],
        'price' => $price,
        'curpk' => $data['curpk'],
        'curid' => $data['curid'],
        'kelnm' => $kelnm,
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
        'stspk' => $data['stspk'],
        'poreqdel' => $data['poreqdel'],
        'podel' => $data['podel'],
        //'allowman'=>$data['allowman'],
        'allowman' => $allowman,
        'memonm' => $dt['memonm'],
        'tgl2' => $dt['tgl2'],
        'popk' => $data['popk'],
        'pono' => $dt2['pono'],
        'rumus' => $data['rumus'],
        'f1' => $data['f1'],
        'f2' => $data['f2'],
        'nilai_usage2' => $data['matusage'],
    );
}
$result = array_merge($result, array('rows' => $row));
echo json_encode($result);
?>