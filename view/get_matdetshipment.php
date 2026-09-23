<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 4000;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'podt.item';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
$po = isset($_GET['po']) ? ($_GET['po']) : false;
$importpk = isset($_GET['importpk']) ? ($_GET['importpk']) : false;
$caria = isset($_POST['caria']) ? ($_POST['caria']) : false;
$delsts = isset($_POST['delsts']) ? ($_POST['delsts']) : false;

$offset = ($page - 1) * $rows;

/* $crs=mysqli_query($koneksi,"select * from rkb where popk='$po'");
  while($dts=mysqli_fetch_array($crs)){
  $specs=addslashes($dts['spec']);
  $updts=mysqli_query($koneksi,"update rpo set spec='$specs' where rkbpk='$dts[rkbpk]'");
  $updts2=mysqli_query($koneksi,"update podt set spec='$specs' where rkbpk='$dts[rkbpk]'");
  } */


if ($caria) {
    $and1 = "and concat(ord.ordno,podt.spec,podt.colname,podt.colcode,podt.sizegar) like '%$caria%'";
}

if ($delsts) {
    $and2 = "and podt.delsts<>'$delsts'";
}

$rs = mysqli_query($koneksi, "select * from importdt
left outer join podt on podt.podtpk=importdt.podtpk
left outer join sup on sup.suppk=podt.suppk
left outer join cur on cur.curpk=podt.curpk
where importdt.popk='$po' and importdt.importpk='$importpk'
ORDER BY $sort $order
LIMIT $rows OFFSET $offset");
$result = array();
$result['total'] = mysqli_num_rows(mysqli_query($koneksi, "select * from importdt
left outer join podt on podt.podtpk=importdt.podtpk
left outer join sup on sup.suppk=podt.suppk
left outer join cur on cur.curpk=podt.curpk
where importdt.popk='$po' and importdt.importpk='$importpk'"));
$row = array();
$k = $offset;
while ($data = mysqli_fetch_array($rs)) {
    $k++;
    if ($data['curpk'] == 3) {
        $cursign = "&#8364;";
    } else {
        $cursign = $data['cursign'];
    }

    if ($data['status'] == 1) {
        $sts = "In progress";
    } else if ($data['status'] == 2) {
        $sts = "Ready for PO";
    } else if ($data['status'] == 3) {
        $sts = "Need revision";
    } else if ($data['status'] == 4) {
        $sts = "PO in process";
    } else if ($data['status'] == 5) {
        $sts = "In Revised";
    } else if ($data['status'] == 6) {
        $sts = "Purchased";
    } else {
        $sts = "In progress";
    }

    /* if($data['piqty']>0){ $piqty1=$data['piqty']; }
      else { $piqty1=$data['pocons']; }

      if($data['piprice']>0){ $piprice1=$data['piprice']; }
      else { $piprice1=$data['price']; }

      if($data['piunit']){ $piunit1=$data['piunit']; }
      else { $piunit1=$data['unit']; } */

//$piqty1=ceil($data['pocons']);
    if ($data['unit'] == "KG" || $data['unit'] == "DZN" || $data['unit'] == "RIM") {
        $piqty1 = $data['pocons'] - $qrs;
    } else {
        $piqty1 = ceil($data['pocons'] - $qrs);
    }

    $piprice1 = $data['price'];
    $piunit1 = $data['unit'];

    if ($data['curid'] == "IDR") {
        if ($data['price'] == "0.00000" || $data['price'] == "") {
            $price = "-";
            $total = "-";
        } else {
            $price = number_format($data['price'], 2, ".", ",");
            $tot = $data['price'] * ceil($data['pocons']);
            $total = $cursign . " " . number_format($tot, 2, ".", ",");
        }

        if ($piprice1 == "0.00000" || $piprice1 == "") {
            $piprice = "";
            $piprice2 = "";
            $total2 = "";
        } else {
            $piprice = number_format($piprice1, 2, ".", ",");
            $piprice2 = number_format($piprice1, 2, ".", ",");
            $tot2 = $piprice1 * $piqty1;
            $total2 = $cursign . " " . number_format($tot2, 2, ".", ",");
        }
    } else {
        if ($data['price'] == "0.00000" || $data['price'] == "") {
            $price = "";
            $total = "-";
        } else {
            $price = number_format($data['price'], 5, ".", ",");
            $tot = $data['price'] * ceil($data['pocons']);
            $total = $cursign . " " . number_format($tot, 5, ".", ",");
        }

        if ($piprice1 == "0.00000" || $piprice1 == "") {
            $piprice = "";
            $piprice2 = "";
            $total2 = "";
        } else {
            $piprice = number_format($piprice1, 5, ".", ",");
            $piprice2 = number_format($piprice1, 5, ".", ",");
            $tot2 = $piprice1 * $piqty1;
            $total2 = $cursign . " " . number_format($tot2, 5, ".", ",");
        }
    }

    $crq = mysqli_query($koneksi, "select * from rkb where rkbpk='$data[rkbpk]'");
    $dtq = mysqli_fetch_array($crq);
    if ($data['qrs'] > 0) {
        $qrs = $data['qrs'];
    } else {
        if ($dtq['qrs'] > 0) {
            if ($data['uqrs'] == 1) {
                $qrs = $data['qrs'];
            } else {
                $updt = mysqli_query($koneksi, "update podt set qrs='$dtq[qrs]' where rkbpk='$data[rkbpk]'");
            }
        } else {
            $qrs = $data['qrs'];
        }
    }

    $qty = number_format($data['bdownqty'], 0, ".", ",");
//$pocons1=ceil($data['pocons']);
    if ($data['unit'] == "KG" || $data['unit'] == "DZN" || $data['unit'] == "RIM") {
        $pocons1 = $data['pocons'] - $qrs;
    } else {
        $pocons1 = ceil($data['pocons'] - $qrs);
    }

    $pocons = number_format($pocons1, 2, ".", ",");

    if ($piqty1 == "0.00") {
        $piqty = "";
        $piqty2 = "";
    } else {
        $piqty = number_format($piqty1, 2, ".", ",");
        $piqty2 = $piqty1;
    }

    $kelnm = RTRIM($data['kelnm']);

//$btn = "<input type='text' style='width:75px;' id='piqty2' value='$piqty2'>";
//$btn2 = "<input type='text' style='width:75px;' id='piprice2' value='$piprice2'>";
    $specb = preg_replace('/[^a-zA-Z"#()_,%+-;�$�&>=�:�″½″→~*–®¼"]/', ' ', $data['spec']);
    $specadd = preg_replace('/[^a-zA-Z"#()_,%+-;�$�&>=�:�″½″→~*–®¼"]/', ' ', $data['specadd']);
    $sup = TRIM($data['supnm']);
    $supnm2 = substr(TRIM($data['supnm']), 0, 5);
    /* if($supnm2=="STOCK"){
      if($specadd<>""){
      if($data['kelnm']=="cutting"){
      $spec=TRIM($specb)."-".TRIM($specadd);
      } else {
      $spec=TRIM($specb);
      }
      } else {
      $spec=TRIM($specb);
      }
      } else { */
    $spec = TRIM($specb);
//}
    $sizeb = preg_replace('/[^a-zA-Z"#()_,%+-;�$�&>=�:�″½″→~*–®¼"]/', ' ', $data['sizegar']);
    $sizegar = TRIM($sizeb);

    $spec1b = preg_replace('/[^a-zA-Z"#()_,%+-;�$�&>=�:�″½″→~*–®¼"]/', ' ', $data['spec1']);
    $spec1c = TRIM($spec1b);
    $spec2b = preg_replace('/[^a-zA-Z"#()_,%+-;�$�&>=�:�″½″→~*–®¼"]/', ' ', $data['spec2']);
    $spec2c = TRIM($spec2b);
    $spec3b = preg_replace('/[^a-zA-Z"#()_,%+-;�$�&>=�:�″½″→~*–®¼"]/', ' ', $data['spec3']);
    $spec3c = TRIM($spec3b);
    $spec4b = preg_replace('/[^a-zA-Z"#()_,%+-;�$�&>=�:�″½″→~*–®¼"]/', ' ', $data['spec4']);
    $spec4c = TRIM($spec4b);
    $spec5b = preg_replace('/[^a-zA-Z"#()_,%+-;�$�&>=�:�″½″→~*–®¼"]/', ' ', $data['spec5']);
    $spec5c = TRIM($spec5b);
    $spec6b = preg_replace('/[^a-zA-Z"#()_,%+-;�$�&>=�:�″½″→~*–®¼"]/', ' ', $data['spec6']);
    $spec6c = TRIM($spec6b);
    $spec7b = preg_replace('/[^a-zA-Z"#()_,%+-;�$�&>=�:�″½″→~*–®¼"]/', ' ', $data['spec7']);
    $spec7c = TRIM($spec7b);
    $spec8b = preg_replace('/[^a-zA-Z"#()_,%+-;�$�&>=�:�″½″→~*–®¼"]/', ' ', $data['spec8']);
    $spec8c = TRIM($spec8b);

    $cr = mysqli_query($koneksi, "select * from po where popk='$data[popk]'");
    $dt = mysqli_fetch_array($cr);

    /* $btn = '<a href="?hal=detord&ord='.$data['ordpk'].'" style="text-decoration:none;">'.$data['ordno'].'</a>';
      if($data['sts']==1){ $sts="In progress"; }
      if($data['sts']==2){ $sts="Ready for PO"; } */
    if ($dt['postatpk'] == 1 && $data['popk'] > 1) {
        $sts = "Awating PI";
    } else if ($dt['postatpk'] == 2) {
        $sts = "In Revision";
    } else if ($dt['postatpk'] == 3) {
        $sts = "PO Cancel";
    } else if ($dt['postatpk'] == 4) {
        $sts = "Purchased";
    }
//else if($dt['postatpk']==1){ $sts="PO in process"; }
    else {
        $sts = "PO in process";
    }

    if ($data['stspk'] == 1) {
        $rev = "Req PO";
    } else if ($data['stspk'] == 2) {
        $rev = "PO Ready";
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
        } else if ($dt['status'] == 3) {
            $rev = "Need revision";
        } else {
            $rev = "";
        }
    }

//    $row[] = array(
//        'no' => $k,
//        'rev' => $rev,
//        'ordpk' => $data['ordpk'],
//        'ordno' => $data['ordno'],
//        'suppk' => $data['suppk'],
//        'supnm' => $data['supnm'],
//        'sup' => $data['sup'],
//        'popk' => $data['popk'],
//        'rkbpk' => $data['rkbpk'],
//        'delsts' => $data['delsts'],
//        'nour' => $data['nour'],
//        'item' => $data['item'],
//        'itemadd' => $data['itemadd'],
//        'spec1' => $spec1c,
//        'spec2' => $spec2c,
//        'spec3' => $spec3c,
//        'spec4' => $spec4c,
//        'spec5' => $spec5c,
//        'spec6' => $spec6c,
//        'spec7' => $spec7c,
//        'spec8' => $spec8c,
//        'sizegar' => $sizegar,
//        'qty' => $qty,
//        'unit' => $data['unit'],
//        'colname' => TRIM($data['colname']),
//        'colcode' => TRIM($data['colcode']),
//        'price' => $price,
//        'price2' => $data['price'],
//        'curpk' => $data['curpk'],
//        'curid' => $data['curid'],
//        'kelnm' => $kelnm,
//        'bdownqty' => $data['bdownqty'],
//        'kolom' => $data['kolom'],
//        'bdownpk' => $data['bdownpk'],
//        'allowcons' => $data['allowcons'],
//        'negocons' => $data['negocons'],
//        'estcons' => $data['estcons'],
//        'varcons' => $data['varcons'],
//        'totcons' => $data['totcons'],
//        'qrs' => $qrs,
//        'pocons' => $pocons,
//        'pocons1' => $pocons1,
//        'status' => $sts,
//        'stspk' => $data['stspk'],
//        'poreqdel' => $data['poreqdel'],
//        'podel' => $data['podel'],
//        'allowman' => $data['allowman'],
//        'total' => $total,
//        'total2' => $total2,
//        'piqty' => $piqty,
//        'piqty2' => $piqty2,
//        'piprice' => $piprice,
//        'piprice2' => $piprice2,
//        'piunit' => $piunit1,
//        'piqty2btn' => $btn,
//        'piprice2btn' => $btn2,
//        'tpodt' => $data['tpodt'],
//        'prodes' => $data['prodes']);
//}
//$result = array_merge($result, array('rows' => $row));
//echo json_encode($result);
//


// $jumlah = $pocons;
// $temukan = ".00";
// $ganti_dengan = "";
// $jumlah_baru = str_replace($temukan,$ganti_dengan,$jumlah);
$jumlah_baru1 = number_format($data['pocons'],2, ".", ",");

$jumlah_baru = number_format($data['qtys'],2, ".", ",");

    $row[] = array(
        'item' => $data['item'],
        'spec' => $spec,
        'supnm' => $data['supnm'],
        'colname' => TRIM($data['colname']),
        'price' => $data['curid'].' '.$price,
        'pocons1' => $jumlah_baru1.' '.$data['unit'],
        'pocons' => $jumlah_baru.' '.$data['unit']);
}
$result = array_merge($result, array('rows' => $row));
echo json_encode($result);
?>




