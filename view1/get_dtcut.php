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


$rs = mysqli_query($koneksi,"SELECT rkb.rkbpk, rkb.unit, cur.curid, rkb.item, rkb.spec, sup.supnm, rkb.colname,
rkb.price, rkb.pocons, po.pono, po.etd, rkb.ordpk, rkb.kelnm, po.popk, podt.price as pprice, podt.pocons as ppocons, po.etdal, po.eihl,
import.ETDA, import.EIH, po.polipk
FROM rkb
left outer join podt on podt.rkbpk=rkb.rkbpk
left outer join po on po.popk=rkb.popk
LEFT OUTER JOIN sup on sup.suppk = rkb.suppk
LEFT OUTER JOIN cur on cur.curpk = rkb.curpk
left outer join importdt on importdt.popk=po.popk
left outer join import on import.importpk=importdt.importpk
WHERE rkb.ordpk='$ord' and rkb.spec<>'' AND rkb.kelnm LIKE '%CUTTING%' 
group by rkb.rkbpk
ORDER BY po.pono ASC");
$result = array();

$row = array();
$i=0;
while($data=mysqli_fetch_array($rs)){
$i++;
//SINKRON KELNM
//  include "../config/koneksi4.php";
$sql2a=mysqli_query($koneksi4,"SELECT * FROM dtgdt WHERE rkbpk='$data[rkbpk]'");
while($dtg2a=mysqli_fetch_array($sql2a)){
if($dtg2a['kelnm']==''){
$update2a=mysqli_query($koneksi4,"update dtgdt set kelnm='$data[kelnm]' where rkbpk='$data[rkbpk]' and ordpk='$ord'");    
}
}

// include "../config/koneksi4.php";
if($data['popk']>0){
$sqlcut=mysqli_query($koneksi4,"SELECT dtgdt.qtypo, SUM(dtgdt.qtydtg) as qtydtg, dtg.tgldtg, dtgdt.unitdtg
FROM dtgdt
LEFT OUTER JOIN dtg on dtg.dtgpk = dtgdt.dtgpk
WHERE dtgdt.rkbpk='$data[rkbpk]' AND dtgdt.kelnm LIKE '%CUTTING%'
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
'eih'=>$eih);
}

$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
?>