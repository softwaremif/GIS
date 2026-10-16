<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
mysqli_set_charset($koneksi, "utf8mb4");
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 4000;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'ord.ordno';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
$po = isset($_GET['po']) ? ($_GET['po']) : false;
$caria = isset($_POST['caria']) ? ($_POST['caria']) : false;
$delsts = isset($_GET['delsts']) ? ($_GET['delsts']) : false;
$uom = isset($_POST['uom']) ? ($_POST['uom']) : false;

$unit1 = isset($_POST['unit1']) ? ($_POST['unit1']) : false;
$unit2 = isset($_POST['unit2']) ? ($_POST['unit2']) : false;

$offset = ($page - 1) * $rows;

/*$crs=mysqli_query($koneksi,"select * from rkb where popk='$po'");
while($dts=mysqli_fetch_array($crs)){
$specs=addslashes($dts['spec']);
$updts=mysqli_query($koneksi,"update rpo set spec='$specs' where rkbpk='$dts[rkbpk]'");
$updts2=mysqli_query($koneksi,"update podt set spec='$specs' where rkbpk='$dts[rkbpk]'");
}*/


// if($caria){
// $and1="and concat(ord.ordno,podt.spec,podt.colname,podt.colcode,podt.sizegar) like '%$caria%'";
// }

$and1 = "";
if ($caria) {
    $cari1_values = explode(";", $caria);
    $multiple_search = [];

    foreach ($cari1_values as $value) {
        $trimmed_value = trim($value);
        $multiple_search[] = "concat(ord.ordno,podt.spec,podt.colname,podt.colcode,podt.sizegar) like '%$trimmed_value%'";
    }

    $and1 = "AND (" . implode(" OR ", $multiple_search) . ")";
}

if ($delsts > 0) {
    $and2 = "and podt.delsts='0'";
}

$rs = mysqli_query($koneksi, "SELECT rkb.rkbpk, rkb.item, rkb.spec, rkb.colname, rkb.sizegar, rkb.unit, podt.bdownqty, podt.pocons, cur.curpk, cur.cursign, podt.item as poitem, podt.spec as pospec, podt.colname as pocolname, podt.sizegar as posizegar, podt.unit as pounit, podt.colcode as pocolcode,
rkb.piqty, rkb.piunit, rkb.piprice, rkb.curpk as rcurpk, rkb.pocons as rpocons, rkb.qrs as rqrs, rkb.price as rprice, podt.uqrs, podt.qrs, podt.podtpk, podt.price, ord.ordpk, ord.ordno, cur.curid, rkb.stspk, podt.popk, podt.delsts,
podt.hspec1,podt.hspec2,podt.hspec3,podt.hspec4,podt.hspec5,podt.hspec6,podt.hspec7,podt.hspec8,podt.spec1,podt.spec2,podt.unit2,podt.fabwidth,podt.fablength,podt.perpcs,podt.copy,
podt.spec3,podt.spec4,podt.spec5,podt.spec6,podt.spec7,podt.spec8,podt.tspec, rkb.colcode, ord.prodes, podt.specadd, sup.supnm, podt.tpodt, podt.kelnm, podt.pocons2, podt.price2, podt.qrs2
FROM podt
left outer join po on po.popk=podt.popk
left outer join rkb on podt.rkbpk=rkb.rkbpk
left outer join ord on ord.ordpk=podt.ordpk
left outer join sup on sup.suppk=po.suppk
left outer join cur on cur.curpk=podt.curpk
WHERE podt.popk='$po' and podt.stspk>='1' $and1 $and2
GROUP BY podt.rkbpk
ORDER BY $sort $order
LIMIT $rows OFFSET $offset");
$result = array();
$result['total'] = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM podt
left outer join po on po.popk=podt.popk
left outer join rkb on podt.rkbpk=rkb.rkbpk
left outer join ord on ord.ordpk=podt.ordpk
left outer join sup on sup.suppk=po.suppk
left outer join cur on cur.curpk=podt.curpk
WHERE podt.popk='$po' and podt.stspk>='1' $and1 $and2 
GROUP BY podt.rkbpk"));
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

    /*if($data['piqty']>0){ $piqty1=$data['piqty']; }
else { $piqty1=$data['pocons']; }

if($data['piprice']>0){ $piprice1=$data['piprice']; }
else { $piprice1=$data['price']; }

if($data['piunit']){ $piunit1=$data['piunit']; }
else { $piunit1=$data['unit']; }*/

    //$piqty1=ceil($data['pocons']);

    $qrs = $data['qrs'];
    $rqrs = $data['rqrs'];

    if ($data['unit'] == "KG" || $data['unit'] == "DZN" || $data['unit'] == "RIM" || $data['unit'] == "GROSS") {
        $piqty1 = $data['pocons'] - $qrs;
    } else {
        $piqty1 = ceil($data['pocons'] - $qrs);
    }

    $piprice1 = $data['price'];
    $piunit1 = $data['unit'];

    $cur = mysqli_query($koneksi, "select * from cur where curpk='$data[rcurpk]'");
    $dtcur = mysqli_fetch_array($cur);
    if ($dtcur['curpk'] == 3) {
        $dtcursign = "&#8364;";
    } else {
        $dtcursign = $dtcur['cursign'];
    }

    $perpcs1 = number_format($data['perpcs'], 0, ".", ",");
    $fabwidth1 = number_format($data['fabwidth'], 0, ".", ",");
    $fablength1 = number_format($data['fablength'], 0, ".", ",");

    $qty = number_format($data['bdownqty'], 0, ".", ",");
    //$pocons1=ceil($data['pocons']);


    if ($data['unit2'] <> '') {
        if ($uom == 1) {
            $unitpo = $data['unit'];
            $pocons1 = $data['pocons'] - $qrs;
            $qrs1 = $data['qrs'];
        } else {
            $unitpo = $data['unit2'];
            $pocons1 = $data['pocons2'];
            $qrs1 = $data['qrs2'];
        }
        $unit = $data['unit'];
        $rpocons1 = $data['rpocons'] - $rqrs;

        if ($pocons1 > $rpocons1) {
            $cek = 1;
        } else {
            $cek = 0;
        }

        $pocons = number_format($pocons1, 4, ".", ",");
        $rpocons = number_format($rpocons1, 3, ".", ",");

        if ($piqty1 == "0.00") {
            $piqty = "";
            $piqty2 = "";
        } else {
            $piqty = number_format($piqty1, 3, ".", ",");
            $piqty2 = $piqty1;
        }
    } else {
        $unit = $data['unit'];
        $unitpo = $data['unit'];
        if ($uom == 1) {
            $qrs1 = $data['qrs'];
        } else {
            $qrs1 = $data['qrs2'];
        }
        // $price = $price;
        // $price=number_format($data['price'],3,".",",");

        if ($data['unit'] == "KG" || $data['unit'] == "DZN" || $data['unit'] == "RIM" || $data['unit'] == "GROSS") {
            $pocons1 = $data['pocons'] - $qrs;
            $rpocons1 = $data['rpocons'] - $rqrs;
        } else {
            $pocons1 = $data['pocons'] - $qrs;
            $rpocons1 = $data['rpocons'] - $rqrs;
        }

        if ($pocons1 > $rpocons1) {
            $cek = 1;
        } else {
            $cek = 0;
        }

        // $rprice = number_format($rprice1, 5, ".", ",");
        // $price = number_format($price1, 5, ".", ",");

        $pocons = number_format($pocons1, 2, ".", ",");
        $rpocons = number_format($rpocons1, 2, ".", ",");
        $poconsLus = number_format($poconsLus1, 2, ".", ",");
        $poconsLusPo = number_format($poconsLusPo1, 2, ".", ",");
        $poconsDzn = number_format($poconsDzn1, 2, ".", ",");
        $poconsDznPo = number_format($poconsDznPo1, 2, ".", ",");
        $yard1 = number_format($yard, 2, ".", ",");

        if ($piqty1 == "0.00") {
            $piqty = "";
            $piqty2 = "";
        } else {
            $piqty = number_format($piqty1, 3, ".", ",");
            $piqty2 = $piqty1;
        }
    }

    // if($data['unit']=="KG" || $data['unit']=="DZN" || $data['unit']=="RIM" || $data['unit']=="GROSS"){
    // $pocons1=$data['pocons']-$qrs;  
    // $rpocons1=$data['rpocons']-$rqrs;   
    // } else {
    // $pocons1=ceil($data['pocons']-$qrs);
    // $rpocons1=ceil($data['rpocons']-$rqrs);
    // }

    // if($pocons1>$rpocons1){ $cek=1; }
    // else { $cek=0; }

    // $pocons=number_format($pocons1,3,".",",");
    // $rpocons=number_format($rpocons1,3,".",",");

    // if($piqty1=="0.00"){ $piqty=""; $piqty2=""; }
    // else {
    // $piqty=number_format($piqty1,3,".",","); $piqty2=$piqty1;
    // }

    $trpocons1 = $trpocons1 + $rpocons1;

    if ($dtcur['curid'] == "IDR") {
        if ($data['rprice'] == "0.00000" || $data['rprice'] == "") {
            $rprice = "-";
            $rtotal = "-";
        } else {
            if ($data['unit'] == "KG" || $data['unit'] == "DZN" || $data['unit'] == "RIM" || $data['unit'] == "GROSS") {
                $rprice = number_format($data['rprice'], 3, ".", ",");
                $rtot = $data['rprice'] * $data['rpocons'];
                $rtotal = $dtcursign . "" . number_format($rtot, 3, ".", ",");
            } else {
                $rprice = number_format($data['rprice'], 3, ".", ",");
                $rtot = $data['rprice'] * ceil($data['rpocons']);
                $rtotal = $dtcursign . "" . number_format($rtot, 3, ".", ",");
            }
        }
    } else {
        if ($data['rprice'] == "0.00000" || $data['rprice'] == "") {
            $rprice = "";
            $rtotal = "-";
        } else {
            if ($data['unit'] == "KG" || $data['unit'] == "DZN" || $data['unit'] == "RIM" || $data['unit'] == "GROSS") {
                $rprice = number_format($data['rprice'], 5, ".", ",");
                $rtot = $data['rprice'] * $data['rpocons'];
                $rtotal = $dtcursign . "" . number_format($rtot, 5, ".", ",");
            } else {
                $rprice = number_format($data['rprice'], 5, ".", ",");
                $rtot = $data['rprice'] * ceil($data['rpocons']);
                $rtotal = $dtcursign . "" . number_format($rtot, 5, ".", ",");
            }
        }
    }

    $trtotal1 = $trtotal1 + $rtot;

    if ($uom == 1) {
        $unitpo_p = $data['unit'];
        $qrs1_p = $data['qrs'];
    } else {
        $unitpo_p = $data['unit2'];
        $qrs1_p = $data['qrs2'];
    }

    if ($data['curid'] == "IDR") {
        if ($data['price'] == "0.00000" || $data['price'] == "") {
            $price = "-";
            $total = "-";
        } else {
            if ($unitpo_p == "KG" || $unitpo_p == "DZN" || $unitpo_p == "RIM" || $unitpo_p == "GROSS") {
                if ($data['unit'] <> '') {
                    if ($uom == 1) {
                        $price = number_format($data['price'], 3, ".", ",");
                        $tot = $data['price'] * $data['pocons'];
                    } else {
                        $price = number_format($data['price2'], 3, ".", ",");
                        $tot = $data['price2'] * $data['pocons2'];
                    }
                } else {
                    $price = number_format($data['price'], 3, ".", ",");
                }
                $total = $cursign . "" . number_format($tot, 3, ".", ",");
            } else {
                if ($unitpo_p <> '') {
                    if ($uom == 1) {
                        $price = number_format($data['price'], 3, ".", ",");
                    } else {
                        $price = number_format($data['price2'], 3, ".", ",");
                    }
                } else {
                    $price = number_format($data['price'], 3, ".", ",");
                }
                $tot = $data['price'] * $data['pocons'];
                $total = $cursign . "" . number_format($tot, 0, ".", ",");
            }
        }

        // if($piprice1=="0.00000" || $piprice1==""){
        // $piprice="";
        // $piprice2="";
        // $total2="";
        // } else {
        // $piprice=number_format($piprice1,3,".",",");
        // $piprice2=number_format($piprice1,3,".",",");
        // $tot2=$piprice1*$piqty1;
        // $total2=$cursign." ".number_format($tot2,3,".",",");
        // }
    } else {
        if ($data['price'] == "0.00000" || $data['price'] == "") {
            $price = "";
            $total = "-";
        } else {
            if ($data['unit'] == "KG" || $data['unit'] == "DZN" || $data['unit'] == "RIM" || $data['unit'] == "GROSS") {
                if ($data['unit'] <> '') {
                    if ($uom == 1) {
                        $price = number_format($data['price'], 5, ".", ",");
                    } else {
                        $price = number_format($data['price2'], 5, ".", ",");
                    }
                } else {
                    $price = number_format($data['price'], 5, ".", ",");
                }
                $tot = $data['price'] * $data['pocons'];
                $total = $cursign . "" . number_format($tot, 5, ".", ",");
            } else {
                if ($data['unit'] <> '') {
                    if ($uom == 1) {
                        $price = number_format($data['price'], 5, ".", ",");
                    } else {
                        $price = number_format($data['price2'], 5, ".", ",");
                    }
                } else {
                    $price = number_format($data['price'], 5, ".", ",");
                }
                $tot = $data['price'] * ceil($data['pocons']);
                $total = $cursign . "" . number_format($tot, 5, ".", ",");
            }
        }

        // if($piprice1=="0.00000" || $piprice1==""){
        // $piprice="";
        // $piprice2="";
        // $total2="";
        // } else {
        // $piprice=number_format($piprice1,5,".",",");
        // $piprice2=number_format($piprice1,5,".",",");
        // $tot2=$piprice1*$piqty1;
        // $total2=$cursign." ".number_format($tot2,5,".",",");
        // }
    }

    // $crq=mysqli_query($koneksi,"select * from rkb where rkbpk='$data[rkbpk]'");
    // $dtq=mysqli_fetch_array($crq);
    // if($data['qrs']>0){ $qrs=$data['qrs']; }
    // else {
    // if($dtq['qrs']>0){
    // if($data['uqrs']==1){ $qrs=$data['qrs']; }
    // else { $updt=mysqli_query($koneksi,"update podt set qrs='$dtq[qrs]' where rkbpk='$data[rkbpk]'"); }
    // } else {
    // $qrs=$data['qrs'];
    // }
    // }

    // $rqrs=$data['rqrs'];

    $sqlk = mysqli_query($koneksi, "select * from kurs order by kurspk desc limit 1");
    $dtk = mysqli_fetch_array($sqlk);

    if ($data['price'] > 0) {
        if ($dtcur['curpk'] == 2) {
            if ($data['curpk'] == 1) {
                $pprice1 = $data['price'];
                $rprice1 = $data['rprice'] * $dtk['rupiah'];
                $pprice2 = number_format($pprice1, 2, ".", "");
                $rprice2 = number_format($rprice1, 2, ".", "");
            } else {
                $pprice1 = $data['price'];
                $rprice1 = $data['rprice'];
                $pprice2 = number_format($pprice1, 5, ".", "");
                $rprice2 = number_format($rprice1, 5, ".", "");
            }
        } else {
            $pprice1 = $data['price'];
            $rprice1 = $data['rprice'];
            $pprice2 = number_format($pprice1, 2, ".", "");
            $rprice2 = number_format($rprice1, 2, ".", "");
        }

        if ($pprice2 > $rprice2) {
            $cek2 = 1;
        } else {
            $cek2 = 0;
        }
    }

    $kelnm = RTRIM($data['kelnm']);

    //$btn = "<input type='text' style='width:75px;' id='piqty2' value='$piqty2'>";
    //$btn2 = "<input type='text' style='width:75px;' id='piprice2' value='$piprice2'>";
    $specb = preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰ï¿=¥Ã¨"]/', ' ', $data['spec']);
    $specadd = preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰ï¿=¥Ã¨"]/', ' ', $data['specadd']);
    $sup = TRIM($data['supnm']);
    $supnm2 = substr(TRIM($data['supnm']), 0, 5);
    /*if($supnm2=="STOCK"){
if($specadd<>""){
if($data['kelnm']=="cutting"){
$spec=TRIM($specb)."-".TRIM($specadd);
} else {
$spec=TRIM($specb); 
}
} else {
$spec=TRIM($specb);    
}
} else {*/
    $spec = TRIM($specb);
    //}
    $sizeb = preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰ï¿=¥Ã¨"]/', ' ', $data['sizegar']);
    $sizegar = TRIM($sizeb);

    $spec1b = preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰ï¿=¥Ã¨"]/', ' ', $data['spec1']);
    $spec1c = TRIM($spec1b);
    $spec2b = preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰ï¿=¥Ã¨"]/', ' ', $data['spec2']);
    $spec2c = TRIM($spec2b);
    $spec3b = preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰ï¿=¥Ã¨"]/', ' ', $data['spec3']);
    $spec3c = TRIM($spec3b);
    $spec4b = preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰ï¿=¥Ã¨"]/', ' ', $data['spec4']);
    $spec4c = TRIM($spec4b);
    $spec5b = preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰ï¿=¥Ã¨"]/', ' ', $data['spec5']);
    $spec5c = TRIM($spec5b);
    $spec6b = preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰ï¿=¥Ã¨"]/', ' ', $data['spec6']);
    $spec6c = TRIM($spec6b);
    $spec7b = preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰ï¿=¥Ã¨"]/', ' ', $data['spec7']);
    $spec7c = TRIM($spec7b);
    $spec8b = preg_replace('/[^a-zA-Z"#()_,%+-;–$“&>=”:â€â€³Â½â€³â†’~*â€“Â®Â¼Ã©Â±Ã‰ï¿=¥Ã¨"]/', ' ', $data['spec8']);
    $spec8c = TRIM($spec8b);

    $cr = mysqli_query($koneksi, "select * from po where popk='$data[popk]'");
    $dt = mysqli_fetch_array($cr);

    /*$btn = '<a href="?hal=detord&ord='.$data['ordpk'].'" style="text-decoration:none;">'.$data['ordno'].'</a>';
if($data['sts']==1){ $sts="In progress"; }
if($data['sts']==2){ $sts="Ready for PO"; }*/
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

    $row[] = array(
        'no' => $k,
        'rev' => $rev,
        'ordpk' => $data['ordpk'],
        'ordno' => $data['ordno'],
        'suppk' => $data['suppk'],
        'supnm' => $data['supnm'],
        'sup' => $data['sup'],
        'popk' => $data['popk'],
        'rkbpk' => $data['rkbpk'],
        'delsts' => $data['delsts'],
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
        'hspec7' => $data['hspec7'],
        'hspec8' => $data['hspec8'],
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
        'colname' => TRIM($data['colname']),
        'colcode' => TRIM($data['colcode']),
        'price' => $price,
        'price2' => $data['price'],
        'rprice' => $rprice,
        'rprice2' => $data['rprice'],
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
        'qrs' => $qrs,
        'qrs1' => $qrs1,
        'pocons' => $pocons,
        'pocons1' => $pocons1,
        'rqrs' => $rqrs,
        'rpocons' => $rpocons,
        'rpocons1' => $rpocons1,
        'trpocons1' => $trpocons1,
        'cek' => $cek,
        'cek2' => $cek2,
        'status' => $sts,
        'stspk' => $data['stspk'],
        'poreqdel' => $data['poreqdel'],
        'podel' => $data['podel'],
        'allowman' => $data['allowman'],
        'total' => $total,
        'total2' => $total2,
        'rtotal' => $rtotal,
        'trtotal1' => $trtotal1,
        'tprice1' => $tprice1,
        'rtotal2' => $rtotal2,
        'piqty' => $piqty,
        'piqty2' => $piqty2,
        'piprice' => $piprice,
        'piprice2' => $piprice2,
        'piunit' => $piunit1,
        'piqty2btn' => $btn,
        'piprice2btn' => $btn2,
        'tpodt' => $data['tpodt'],
        'prodes' => $data['prodes'],
        'unit' => $unit,
        'unitcnv' => $unitpo,
        'copy' => $data['copy'],
        'poitem' => $data['poitem'],
        'pospec' => $data['pospec'],
        'pocolname' => TRIM($data['pocolname']),
        'posizegar' => $data['posizegar'],
        'pounit' => $data['pounit'],
        'pocolcode' => TRIM($data['pocolcode']),
    );
}
$result = array_merge($result, array('rows' => $row));
echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
