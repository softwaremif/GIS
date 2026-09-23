<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/koneksi4b.php";
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'rkb.kelnm';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
$cari1 = isset($_POST['cari1']) ? ($_POST['cari1']) : false;
$cari2 = isset($_POST['cari2']) ? ($_POST['cari2']) : false;
$cari3 = isset($_POST['cari3']) ? ($_POST['cari3']) : false;
$cari4 = isset($_POST['cari4']) ? ($_POST['cari4']) : false;
$cari5 = isset($_POST['cari5']) ? ($_POST['cari5']) : false;
$cariaz = isset($_POST['cariaz']) ? ($_POST['cariaz']) : false;
//$cari6 = isset($_POST['cari6']) ? ($_POST['cari6']) : false;
$ord = isset($_GET['ord']) ? ($_GET['ord']) : false;
$cek = isset($_GET['cek']) ? ($_GET['cek']) : false;
$type0 = isset($_POST['type0']) ? ($_POST['type0']) : false;
$type1 = isset($_POST['type1']) ? ($_POST['type1']) : false;
$type2 = isset($_POST['type2']) ? ($_POST['type2']) : false;
$spec0 = isset($_POST['spec0']) ? ($_POST['spec0']) : false;
$spec1 = isset($_POST['spec1']) ? ($_POST['spec1']) : false;
$col0 = isset($_POST['col0']) ? ($_POST['col0']) : false;
$col1 = isset($_POST['col1']) ? ($_POST['col1']) : false;

$offset = ($page - 1) * $rows;

//type
if ($type0 == '') {
    $atype = array($type1, $type2);
} else if ($type1 == '') {
    $atype = array($type0, $type2);
} else if ($type2 == '') {
    $atype = array($type0, $type1);
} else {
    $atype = array($type0, $type1, $type2);
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

if($cari4==1){ $orderby=",rkb.item desc, rkb.nour asc"; } 
else if($cari5==1){ $orderby=",rkb.item asc, rkb.nour asc"; }
else if($cariaz==1){ $orderby=",rkb.item asc, rkb.nour asc"; }
else { $orderby=",rkb.item desc, rkb.nour desc"; }

// $orderby=",rkb.item desc, rkb.nour desc";

if ($cari1 <> "") {
    $and1 = "and concat(rkb.item,sup.supnm,rkb.spec,rkb.itemadd,rkb.colname) like '%$cari1%'";
}

if ($cari2 <> "") {
    if ($cari2 == 0) {
    } else if ($cari2 < 41) {
        $and2 = "and rkb.status='$cari2'";
    } else {
        $cari2b = substr($cari2, 1, 1);
        $and2 = "and rkb.status='4' and rkb.stspk='$cari2b'";
    }
}

if ($cari3 <> "") {
    if ($cari3 == 0) {
    } else {
        $and3 = "and sup.suppk='$cari3'";
    }
}
/*if($cari6<>""){
if($cari6=="ALL"){ $and5=""; }
else { $and5="and rkb.kelnm like '%$cari6%'"; }
}*/

if ($cek > 0) {
    $and4 = "and rkb.status='$cek'";
}

if ($type0 <> "" || $type1 <> "" || $type2 <> "") {
    //$csupp="and sup.supnm LIKE '%$supp0%' or sup.supnm LIKE '%$supp1%'";
    $ctype = "and rkb.kelnm IN ('$itype')";
}
if ($spec0 <> "" || $spec1 <> "") {
    $cspec = "and rkb.spec IN ('$ispec')";
}
if ($col0 <> "" || $col1 <> "") {
    $ccol = "and rkb.colname IN ('$icol')";
}

// include "../config/koneksi.php";
$rs = mysqli_query($koneksi, "select rkb.ordpk, ord.ordno, rkb.suppk, sup.supnm, rkb.rkbpk, rkb.nour, rkb.item,
rkb.itemadd, rkb.spec, rkb.specadd, rkb.tspec, rkb.hspec1, rkb.hspec2, rkb.hspec3, rkb.hspec4, rkb.hspec5,
rkb.hspec6, rkb.hspec7, rkb.hspec8, rkb.spec1, rkb.spec2, rkb.spec3, rkb.spec4, rkb.spec5, rkb.spec6, rkb.spec7, rkb.spec8,
rkb.sizegar, rkb.unit, rkb.colname, rkb.colcode, rkb.price, rkb.curpk, cur.curid, rkb.kelnm, rkb.bdownqty,
rkb.kolom, rkb.bdownpk, rkb.allowcons, rkb.negocons, rkb.estcons, rkb.varcons, rkb.totcons, rkb.qrs, rkb.pocons,
rkb.poreqdel, rkb.podel, rkb.status, rkb.stspk, rkb.allowman, rkb.popk, po.postatpk, po.pono, rkb.piqty,
rkb.piprice, po.piform, po.pidate, po.tgldel, po.etd, rpo.tgljam, rkb.rumus, rkb.f1, rkb.f2, rkb.copy, po.polipk,
import.stsimpk, podt.pocons as ppocons, podt.qrs as pqrs, podt.price as pprice, podt.curpk as pcurpk, rkb.matusage
FROM rkb
left outer join rpo on rpo.rkbpk=rkb.rkbpk
left outer join podt on podt.rkbpk=rkb.rkbpk
left outer join po on po.popk=podt.popk
left outer join ord on ord.ordpk=rkb.ordpk
left outer join sup on sup.suppk=rkb.suppk
left outer join cur on  cur.curpk=rkb.curpk
left outer join importdt on importdt.popk=podt.popk
left outer join import on import.importpk=importdt.importpk
where rkb.spec<>'' and ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord' $and1 $and2 $and3 $and4
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
left outer join importdt on importdt.popk=podt.popk
left outer join import on import.importpk=importdt.importpk
where rkb.spec<>'' and ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord' $and1 $and2 $and3 $and4
$ctype $cspec $ccol
group by rkb.rkbpk"));
$row = array();

$k = $offset;
while ($data = mysqli_fetch_array($rs)) {
    $k++;

    $qrs = $data['pqrs'];
    $rqrs = $data['qrs'];

    if ($data['unit'] == "KG" || $data['unit'] == "DZN" || $data['unit'] == "RIM" || $data['unit'] == "GROSS") {
        $pocons1 = $data['ppocons'] - $qrs;
        $rpocons1 = $data['pocons'] - $rqrs;
    } else {
        $pocons1 = ceil($data['ppocons'] - $qrs);
        $rpocons1 = ceil($data['pocons'] - $rqrs);
    }

    if ($pocons1 > $rpocons1) {
        $cekover = 1;
    } else {
        $cekover = 0;
    }

    $sqlk = mysqli_query($koneksi, "select * from kurs order by kurspk desc limit 1");
    $dtk = mysqli_fetch_array($sqlk);

    if ($data['popk'] > 0) {
        if ($data['pprice'] > 0) {
            if ($data['curpk'] == 2) {
                if ($data['pcurpk'] == 1) {
                    $pprice = $data['pprice'];
                    $rprice = $data['price'] * $dtk['rupiah'];
                    $pprice2 = number_format($pprice, 2, ".", "");
                    $rprice2 = number_format($rprice, 2, ".", "");
                } else {
                    $pprice = $data['pprice'];
                    $rprice = $data['price'];
                    $pprice2 = number_format($pprice, 5, ".", "");
                    $rprice2 = number_format($rprice, 5, ".", "");
                }
            } else {
                $pprice = $data['pprice'];
                $rprice = $data['price'];
                $pprice2 = number_format($pprice, 2, ".", "");
                $rprice2 = number_format($rprice, 2, ".", "");
            }

            if ($pprice2 > $rprice2) {
                $cekover2 = 1;
            } else {
                $cekover2 = 0;
            }
        }
    } else {
        $cekover2 = 0;
    }

    // if($data['pprice']>0){
// if($data['pprice']>$data['price']){ $cekover2=1; }
// else { $cekover2=0; }
// }

    // include "../config/koneksi4.php";
    $sql = mysqli_query($koneksi4, "SELECT SUM(qtydtg) as tqtydtg, unitdtg, kelnm, stsunit FROM dtgdt WHERE rkbpk='$data[rkbpk]' GROUP BY rkbpk");
    $dtg = mysqli_fetch_array($sql);

    $poconsa1 = $data['pocons'];
    $tqtydtg1 = $dtg['tqtydtg'];

    $poconsa = number_format($data['pocons'], 0, ".", ",");
    $tqtydtg = number_format($dtg['tqtydtg'], 0, ".", ",");
    $unitdtg = RTRIM($dtg['unitdtg']);
    $unitpo = RTRIM($data['unit']);

    $balance = ($dtg['tqtydtg'] - $data['pocons']) / $data['pocons'] * 100;
    $balance2 = number_format($balance, 1, ".", ",");

    //SINKRON KELNM
//  include "../config/koneksi4.php";
    $sql2a = mysqli_query($koneksi4, "SELECT * FROM dtgdt WHERE rkbpk='$data[rkbpk]'");
    while ($dtg2a = mysqli_fetch_array($sql2a)) {
        if ($dtg2a['kelnm'] == '') {
            $update2a = mysqli_query($koneksi4, "update dtgdt set kelnm='$data[kelnm]' where rkbpk='$data[rkbpk]' and ordpk='$ord'");
        }
    }

    if (TRIM($dtg['unitdtg']) <> TRIM($data['unit'])) {
        $update2 = mysqli_query($koneksi4, "update dtgdt set stsunit='1' where rkbpk='$data[rkbpk]' and ordpk='$ord'");
    }

    // include "../config/koneksi.php";
//$btn = '<a href="?hal=detord&ord='.$data['ordpk'].'" style="text-decoration:none;">'.$data['ordno'].'</a>';
    $cr2 = mysqli_query($koneksi, "select * from po where popk='$data[popk]'");
    $dt2 = mysqli_fetch_array($cr2);
    if ($dt2['ck'] == 0) {
        if ($dt2['pur'] == "Rita") {
            $pono2 = $dt2['pono'];
        } else if ($dt2['pur'] == "Theresia") {
            $pono2 = $dt2['pono'];
        } else {
            if ($dt2['postatpk'] > 1) {
                $pono2 = $dt2['pono'];
            } else {
                $pono2 = "";
            }
        }
    } else if ($dt2['ck'] == 1) {
        $pono2 = $dt2['pono'];
    } else {
        $pono2 = "";
    }

    if ($data['status'] == 1) {
        $sts = "In progress";
    } else if ($data['status'] == 2) {
        $sts = "Ready for PO";
    } else if ($data['status'] == 3) {
        $sts = "Need revision";
    } else if ($data['status'] == 4) {
        if ($data['popk'] > 0) {
            if ($tqtydtg1 > 0) {
                if ($poconsa1 == $tqtydtg1 && $unitpo == $unitdtg) {
                    // $sts="<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color:#19B715;cursor:pointer' onclick='info();'>Complete</span>";    
                    $stsb = "In House";
                    $sts = "1";
                    $update = mysqli_query($koneksi, "update podt set cek = '4' WHERE rkbpk='$data[rkbpk]'");
                } else if ($tqtydtg1 > $poconsa1 && $unitpo == $unitdtg) {
                    $stsb = "In House<span style='color:white;'> (+" . $balance2 . "%)</span>";
                    $sts = "2";
                    // $sts="<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color:#19B715;cursor:pointer' onclick='info();'>Complete<span style='color:#FF6B00;'>(+".$balance2."%)</span></span>";    
                    $update = mysqli_query($koneksi, "update podt set cek = '4' WHERE rkbpk='$data[rkbpk]'");
                } else if ($tqtydtg1 < $poconsa1 && $unitpo == $unitdtg) {
                    $stsb = "Partial In";
                    $sts = "3";
                } else if ($tqtydtg1 < $poconsa1 && $unitpo != $unitdtg) {
                    $stsb = "Unit Difference";
                    $sts = "4";
                }
            } else {
                if ($data['stspk'] == 4) {
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
            }
        } else {
            if ($data['stspk'] == 1) {
                $sts = "Req PO";
            } else if ($data['stspk'] == 2) {
                if ($dt2['fu'] <> '') {
                    if ($dt2['ck'] == 1) {
                        $sts = "PO Ready";
                    } else {
                        $sts = "Req PO";
                    }
                } else {
                    $sts = "PO Ready";
                }
            }
        }
    } else if ($data['status'] == 5) {
        $sts = "In Revision";
    } else if ($data['status'] == 6 && $tqtydtg1 == 0 || $tqtydtg1 == "") {
        if ($data['stspk'] == 4) {
            $sts = "Req Revised";
        } else if ($data['stspk'] == 5) {
            //$sts="Ready Revised";
// $sts="Purchased"; 
            if ($data['polipk'] == 2) {
                $crim = mysqli_query($koneksi, "select * from importdt
        left outer join import on import.importpk=importdt.importpk
        where importdt.popk='$data[popk]' order by import.importpk desc limit 1");
                $dtim = mysqli_fetch_array($crim);

                // $totship = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM  importdt WHERE importpk='$dtim[importpk]'
                // group by popk"));

                if ($dtim['importpk'] > 1) {
                    if ($dtim['stsimpk'] == 0) {
                        // $sts="Schedule";
                        $sts = '<input type="text" name="scheduled" id="scheduled" value="Scheduled" size="6" style="padding: 2px 3px;text-align:center; border-radius:5px;border:0px solid #000000;font-weight:400;font-size:14px;color:#FFFFFF;background-color: rgba(133, 133, 133, 1);" readonly>';
                    } else if ($dtim['stsimpk'] == 1) {
                        // $sts="En Route";
                        $sts = "<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;padding: 2px 3px;text-align:center; border-radius:5px;border:0px solid rgba(25, 183, 21, 1);color:#FFFFFF;background-color: black;cursor:pointer' onclick='info($data[popk],$data[rkbpk]);'>En Route</span>";
                        // $sts='<input type="text" name="enroute" id="enroute" value="En Route" size="6" style="padding: 2px 3px;text-align:center; border-radius:5px;border:0px solid #000000;font-weight:400;font-size:14px;color:#FFFFFF;background-color: black;" readonly>';
                    } else if ($dtim['stsimpk'] == 2) {
                        // $sts="Arrived IDN";
                        $sts = '<input type="text" name="arrived" id="arrived" value="Arrived IDN" size="6" style="padding: 2px 3px;text-align:center; border-radius:5px;border:0px solid #000000;font-weight:400;font-size:14px;color:#FFFFFF;background-color: rgba(53, 157, 217, 1);" readonly>';
                    } else if ($dtim['stsimpk'] == 3) {
                        // $sts="In House";
                        // $sts="<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;padding: 2px 3px;text-align:center; border-radius:5px;border:0px solid rgba(25, 183, 21, 1);color:red;background-color: rgba(25, 183, 21, 1);cursor:pointer' onclick='info();'>In House</span>";    
                    } else {
                        $sts = "PI received";
                    }
                } else {
                    $sts = "PI received";
                }
            } else {
                $sts = "PI received";
            }
        } else {
            if ($data['polipk'] == 2) {
                $crim = mysqli_query($koneksi, "select * from importdt
left outer join import on import.importpk=importdt.importpk
where importdt.popk='$data[popk]' order by import.importpk desc limit 1");
                $dtim = mysqli_fetch_array($crim);

                // $totship = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM importdt WHERE importpk='$dtim[importpk]'
// group by popk"));

                if ($dtim['importpk'] > 1) {
                    if ($dtim['stsimpk'] == 0) {
                        // $sts="Schedule";
                        $sts = '<input type="text" name="scheduled1" id="scheduled1" value="Scheduled" size="6" style="padding: 2px 3px;text-align:center; border-radius:5px;border:0px solid #000000;font-weight:400;font-size:14px;color:#FFFFFF;background-color: rgba(133, 133, 133, 1);" readonly>';
                        // $sts='<input type="text" name="schedule" id="schedule" value="Schedule" size="7" style="padding: 2px 4px;text-align:center; border-radius:5px;border:0px solid #000000;font-weight:400;font-size:14px;color:#FFFFFF;background-color: #BDBDBD;;" readonly>';
                    } else if ($dtim['stsimpk'] == 1) {
                        // $sts="En Route";
                        $sts = "<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;padding: 2px 3px;text-align:center; border-radius:5px;border:0px solid rgba(25, 183, 21, 1);color:#FFFFFF;background-color: black;cursor:pointer' onclick='info($data[popk],$data[rkbpk]);'>En Route</span>";
                        // $sts='<input type="text" name="enroute1" id="enroute1" value="En Route" size="6" style="padding: 2px 3px;text-align:center; border-radius:5px;border:0px solid #000000;font-weight:400;font-size:14px;color:#FFFFFF;background-color: black;" readonly>';
                    } else if ($dtim['stsimpk'] == 2) {
                        // $sts="Arrived IDN";
                        $sts = '<input type="text" name="arrived1" id="arrived1" value="Arrived IDN" size="6" style="padding: 2px 3px;text-align:center; border-radius:5px;border:0px solid #000000;font-weight:400;font-size:14px;color:#FFFFFF;background-color: rgba(53, 157, 217, 1);" readonly>';
                    } else if ($dtim['stsimpk'] == 3) {
                        // $sts="<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;padding: 2px 3px;text-align:center; border-radius:5px;border:0px solid rgba(25, 183, 21, 1);color:#FFFFFF;background-color: rgba(25, 183, 21, 1);cursor:pointer' onclick='info();'>In House</span>";    
                        // $sts="In House";
                    } else {
                        $sts = "PI received";
                    }
                } else {
                    $sts = "PI received";
                }
            } else {
                $sts = "PI received";
            }
        }
    } else if ($data['status'] == 6 && $poconsa1 == $tqtydtg1 && $unitpo == $unitdtg) {
        // $sts="<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color:#19B715;cursor:pointer' onclick='info();'>Complete</span>";    
        $stsb = "In House";
        $sts = "1";
        $update = mysqli_query($koneksi, "update podt set cek = '4' WHERE rkbpk='$data[rkbpk]'");
    } else if ($data['status'] == 6 && $tqtydtg1 > $poconsa1 && $unitpo == $unitdtg) {
        $stsb = "In House<span style='color:white;'> (+" . $balance2 . "%)</span>";
        $sts = "2";
        // $sts="<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color:#19B715;cursor:pointer' onclick='info();'>Complete<span style='color:#FF6B00;'>(+".$balance2."%)</span></span>";    
        $update = mysqli_query($koneksi, "update podt set cek = '4' WHERE rkbpk='$data[rkbpk]'");
    } else if ($data['status'] == 6 && $tqtydtg1 < $poconsa1 && $unitpo == $unitdtg) {
        $stsb = "Partial In";
        $sts = "3";
    } else if ($data['status'] == 6 && $tqtydtg1 < $poconsa1 && $unitpo != $unitdtg) {
        $stsb = "Unit Difference";
        $sts = "4";
    }
    // else { $sts="In progress"; }

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
    if ($kelnm == 'CUTTING') {
        $kelnm2 = "<div style='width: 45px;height: 24px;background: #359DD9;border-radius: 8px;color:#FFFFFF;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 16px;'>C</div>";
    } else if ($kelnm == 'SEWING') {
        $kelnm2 = "<div style='width: 45px;height: 24px;background: #19B715;border-radius: 8px;color:#FFFFFF;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 16px;'>S</div>";
    } else {
        $kelnm2 = "<div style='width: 45px;height: 24px;background: #FF6B00;border-radius: 8px;color:#FFFFFF;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 16px;'>F</div>";
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
    //$sizegar=TRIM($data['sizegar']);

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

    $pono3 = '<a href="admin?hal=detpopur&x=1&po=' . $data['popk'] . '&mat=1&ord=' . $data['ordpk'] . '" style="text-decoration:none;font-family:arial;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(53, 157, 217, 1);">' . $pono2 . '</a>';

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
        'kelnm2' => $kelnm2,
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
        'pocons2b' => $data['pocons'],
        'cekover' => $cekover,
        'cekover2' => $cekover2,
        'status' => $sts,
        'stsb' => $stsb,
        'status2' => $data['status'],
        'stspk' => $data['stspk'],
        'poreqdel' => $data['poreqdel'],
        'podel' => $data['podel'],
        //'allowman'=>$data['allowman'],
        'allowman' => $allowman,
        'memonm' => $dt['memonm'],
        'tgl2' => $dt['tgl2'],
        'popk' => $data['popk'],
        'postatpk' => $dt2['postatpk'],
        'pur' => $dt2['pur'],
        'pono' => $pono2,
        'ponoblue' => $pono3,
        'fup' => $dt2['fu'],
        'rumus' => $data['rumus'],
        'f1' => $data['f1'],
        'f2' => $data['f2'],
        'copy' => $data['copy'],
        'piform' => $data['piform'],
        'stsimpk' => $data['stsimpk'],
        'importpk' => $dtim['importpk'],
        'tqtydtg' => $tqtydtg,
        'poconsa' => $poconsa,
        'unitpo' => $unitpo,
        'unitdtg' => $unitdtg,
        'totship' => $totship,
        'nilai_usage2' => $data['matusage']
    );
}

$result = array_merge($result, array('rows' => $row));
echo json_encode($result);
?>