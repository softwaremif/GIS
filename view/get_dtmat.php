<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/koneksi4b.php";
include "../config/truncate.php";
include "../config/tanggal.php";
$thn=DATE('Y');
$thn2=$thn-2;
$thn2b=$thn2-2000;

$bln=date("m");
$thn=date("Y");

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$ord = isset($_POST['ordpk']) ? ($_POST['ordpk']) : false;
$carim = isset($_POST['carim']) ? ($_POST['carim']) : false;
$crsts = isset($_POST['crsts']) ? ($_POST['crsts']) : false;
$crkel = isset($_POST['crkel']) ? ($_POST['crkel']) : false;

if($_SESSION['mat']==1){ $andpo="and rkb.kelnm='CUTTING'"; } 
if($_SESSION['mat']==2){ $andpo="and rkb.kelnm<>'CUTTING'"; }

if ($carim <> "") {
    // $and1 = "and concat(ord.ordno,byr.byrnm,ord.prodes,ord.season,ord.artno,fu.funm) like '%$cari1%'";
    $and1 = "";
    if ($carim) {
        $cari1_values = explode(";", $carim);
        $multiple_search = [];

        foreach ($cari1_values as $value) {
            $trimmed_value = trim($value);
            $multiple_search[] = "CONCAT(
    COALESCE(po.pono, ''), 
    COALESCE(rkb.item, ''), 
    COALESCE(sup.supnm, ''), 
    COALESCE(rkb.spec, '')
) LIKE '%$trimmed_value%'";
        }

        $and1 = "AND (" . implode(" OR ", $multiple_search) . ")";
    }
}

if($crkel <> ""){
$and2 = "and rkb.kelnm like '%$crkel%'";
} else {
$and2 = "";
}

if ($crsts) {
    if ($crsts == 0) {
    } else if ($crsts < 41) {
        $and3 = "and rkb.status='$crsts'";
    } else {
        $cari2b = substr($crsts, 1, 1);
        $and3 = "and rkb.status='4' and rkb.stspk='$cari2b'";
    }
}
$query="SELECT rkb.rkbpk, rkb.unit, cur.curid, rkb.item, rkb.spec, sup.supnm, rkb.colname,
rkb.price, rkb.pocons, po.pono, po.etd, rkb.ordpk, rkb.kelnm, po.popk, podt.price as pprice, podt.pocons as ppocons, po.etdal, po.eihl,
import.ETDA, import.EIH, po.polipk, rkb.status, rkb.stspk, po.fu, po.polipk
FROM rkb
left outer join podt on podt.rkbpk=rkb.rkbpk
left outer join po on po.popk=rkb.popk
LEFT OUTER JOIN sup on sup.suppk = rkb.suppk
LEFT OUTER JOIN cur on cur.curpk = rkb.curpk
left outer join importdt on importdt.popk=po.popk
left outer join import on import.importpk=importdt.importpk
WHERE rkb.ordpk='$ord' and rkb.spec<>'' $andpo $and1 $and2 $and3
group by rkb.rkbpk
ORDER BY rkb.kelnm asc, rkb.status asc, rkb.stspk asc";
// var_dump($query);
// die();
$rs = mysqli_query($koneksi,$query);
$result = array();

$row = array();
$i=0;
while($data=mysqli_fetch_array($rs)){
$i++;

    $stsb = "";
    $sts = "";

    $kelnm = RTRIM($data['kelnm']);
    if ($kelnm == 'CUTTING') {
        $kelnm2 = "<div style='width: 45px;height: 24px;background: #359DD9;border-radius: 8px;color:#FFFFFF;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 16px;'>C</div>";
    } else if ($kelnm == 'SEWING') {
        $kelnm2 = "<div style='width: 45px;height: 24px;background: #19B715;border-radius: 8px;color:#FFFFFF;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 16px;'>S</div>";
    } else if ($kelnm == 'FINISHING/PACKING') {
        $kelnm2 = "<div style='width: 45px;height: 24px;background: #FF6B00;border-radius: 8px;color:#FFFFFF;font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 16px;'>F</div>";
    } else {
        $kelnm2 = "<div></div>";
    }

//SINKRON KELNM
//  include "../config/koneksi4.php";
$sql2a=mysqli_query($koneksi4,"SELECT * FROM dtgdt WHERE rkbpk='$data[rkbpk]'");
while($dtg2a=mysqli_fetch_array($sql2a)){
if($dtg2a['kelnm']==''){
$update2a=mysqli_query($koneksi4,"update dtgdt set kelnm='$data[kelnm]' where rkbpk='$data[rkbpk]' and ordpk='$ord'");    
}
}

// include "../config/koneksi4.php";
$qtydtg="";
$balance="";
if($data['popk']>0){
$sqlcut=mysqli_query($koneksi4,"SELECT dtgdt.qtypo, SUM(dtgdt.qtydtg) as qtydtg, dtg.tgldtg, dtgdt.unitdtg
FROM dtgdt
LEFT OUTER JOIN dtg on dtg.dtgpk = dtgdt.dtgpk
WHERE dtgdt.rkbpk='$data[rkbpk]' AND dtgdt.kelnm='$data[kelnm]'
GROUP BY dtgdt.rkbpk
ORDER BY dtgdt.rkbpk ASC");
$dtsqlcut=mysqli_fetch_array($sqlcut);

if($dtsqlcut['qtydtg']>=$data['ppocons']){
$qtydtg="<span style='color:#19B715;cursor:pointer;'>".number_format($dtsqlcut['qtydtg'],0,".",",")." ".$dtsqlcut['unitdtg']."</span>";    
}else if($dtsqlcut['qtydtg']<$data['ppocons'] && $dtsqlcut['qtydtg']<>0){
$qtydtg="<span style='color:#FF6B00;cursor:pointer;'>".number_format($dtsqlcut['qtydtg'],0,".",",")." ".$dtsqlcut['unitdtg']."</span>";    
}else{
$qtydtg=number_format($dtsqlcut['qtydtg'],0,".",",");
}


if(TRIM($data['unit']) <> TRIM($dtsqlcut['unitdtg']) && $dtsqlcut['qtydtg']>0 ){
$balance="<span style='color:#EF3B42'>Difference Unit</span>";  
}else{
$balance=$dtsqlcut['qtydtg'] - $data['ppocons']." ".$dtsqlcut['unitdtg'];
if($balance<0){
$balance=substr($balance,1);    
}else if ($balance>0){
$balance="<span style='color: rgba(0, 0, 0, 0.38);'>+".$balance."</span>";     
}else{
$balance;   
}
}
if($data['curid']=="IDR"){
    if($data['pprice']=="0.00000"){
    $price="-";
    } else {
    $price=number_format($data['pprice'],0,".",",")." ".$data['curid'];
    }
    } else {
    if($data['pprice']=="0.00000"){
    $price="-";
    } else {
    $price=number_format($data['pprice'],3,".",",")." ".$data['curid'];
    }
    }
    $pocons=number_format($data['ppocons'],0,".",",")." ".$data['unit'];

}
else {
    if($data['curid']=="IDR"){
        if($data['price']=="0.00000"){
        $price="-";
        } else {
        $price=number_format($data['price'],0,".",",")." ".$data['curid'];
        }
        } else {
        if($data['price']=="0.00000"){
        $price="-";
        } else {
        $price=number_format($data['price'],3,".",",")." ".$data['curid'];
        }
        }
        $pocons=number_format($data['pocons'],0,".",",")." ".$data['unit'];
}

// include "../config/koneksi.php";

if($data['etd']=="" || $data['etd']=="0000-00-00"){ $etd="- - - "; }
else { $etd=tgl($data['etd']); }

if($data['polipk']==1){
$eta=$data['etdal'];
$eih=$data['eihl'];
} else {
$eta=$data['ETDA'];
$eih=$data['EIH'];
}

if($eta=="" || $eta=="0000-00-00"){ $eta="- - - "; }
else { $eta=tgl($eta); }

if($eih=="" || $eih=="0000-00-00"){ $eih="- - - "; }
else { $eih=tgl($eih); }

    $sql = mysqli_query($koneksi4, "SELECT SUM(qtydtg) as tqtydtg, unitdtg, kelnm, stsunit FROM dtgdt WHERE rkbpk='$data[rkbpk]' GROUP BY rkbpk");
    $dtg = mysqli_fetch_array($sql);

    $poconsa1 = $data['pocons'];
    $tqtydtg1 = $dtg['tqtydtg'];

    $poconsa = number_format($data['pocons'], 0, ".", ",");
    $tqtydtg = number_format($dtg['tqtydtg'], 0, ".", ",");
    $unitdtg = RTRIM($dtg['unitdtg']);
    $unitpo = RTRIM($data['unit']);

    $balance1 = ($dtg['tqtydtg'] - $data['pocons']) / $data['pocons'] * 100;
    $balance2 = number_format($balance1, 1, ".", ",");

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
                if ($data['fu'] <> '') {
                    if ($data['ck'] == 1) {
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

$row[] = array(
'rkbpk'=>$data['rkbpk'],    
'popk'=>$data['popk'],
'pono'=>$data['pono'],
'item'=>$data['item'],
'spec'=>$data['spec'],
'supnm'=>$data['supnm'],
'colname'=>$data['colname'],
'price'=>$price,
'pocons'=>$pocons,
'pocons2'=>$data['pocons'],
'qtydtg'=>$qtydtg,
'qtydtg2'=>$dtsqlcut['qtydtg'],
'balance'=>$balance,
'etd'=>$etd,
'eta'=>$eta,
'eih'=>$eih,
'status' => $sts,
'stsb' => $stsb,
'kelnm2' => $kelnm2
);
}

$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
?>