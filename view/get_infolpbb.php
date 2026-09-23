<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/truncate.php";
$thn=DATE('Y');
$thn2=$thn-2;
$thn2b=$thn2-2000;

$bln=date("m");
$thn=date("Y");


$rkbpk = $_POST['rkbpk']; 
$popk = $_GET['popk'];
// $popk = $_POST['popk'];
include "../config/koneksi4.php";
$rs = mysqli_query($koneksi,"SELECT sum(dtgdt.qtydtg) as tqtydtg, dtgdt.unitdtg FROM dtgdt
LEFT OUTER JOIN dtg ON dtg.dtgpk=dtgdt.dtgpk
WHERE dtgdt.popk='$popk' AND dtgdt.rkbpk='$rkbpk'
group by dtgdt.nopo
ORDER BY dtg.tgldtg ASC");
$dt= mysqli_fetch_array($rs);

include "../config/koneksi.php";
if($dt['tqtydtg']>0){
$rs2 = mysqli_query($koneksi,"SELECT pocons, unit from podt
WHERE rkbpk='$rkbpk'
group by rkbpk");
$dt2= mysqli_fetch_array($rs2);
} else {
$rs2 = mysqli_query($koneksi,"SELECT pocons, unit from rkb
WHERE rkbpk='$rkbpk'
group by rkbpk");
$dt2= mysqli_fetch_array($rs2);
}

$blnc=(($dt['tqtydtg']-$dt2['pocons'])/$dt2['pocons'])*100;

if($blnc>=3){
$balance="<span style='font-family: Arial;font-style: normal;font-weight: 400;font-size: 12px;line-height: 16px;color:#FF6B00'>(!) 3% more than ordered quantity.</span>";
}else{
$balance="";
}
echo number_format($dt['tqtydtg'],0,".",",")." ".$dt['unitdtg']."/".number_format($dt2['pocons'],0,".",",")." ".$dt2['unit']." have arrived.<br>&nbsp;&nbsp;&nbsp;&nbsp;".$balance;

?>