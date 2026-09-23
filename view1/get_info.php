<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/truncate.php";
$thn=DATE('Y');
$thn2=$thn-2;
$thn2b=$thn2-2000;

$bln=date("m");
$thn=date("Y");

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$pono = isset($_POST['pono']) ? ($_POST['pono']) : false;
$rkbpk = isset($_POST['rkbpk']) ? ($_POST['rkbpk']) : false;


include "../config/koneksi.php";
$rkb1= mysqli_query($koneksi,"select * from podt
where rkbpk=$rkbpk");
$rkb2=mysqli_fetch_array($rkb1);

$crim=mysqli_query($koneksi,"select import.vassalnm, podt.popk, import.importpk from importdt
left outer join import on import.importpk=importdt.importpk
left outer join podt on podt.popk=importdt.popk
where importdt.popk='$rkb2[popk]' AND importdt.podtpk='$rkb2[podtpk]' group by importdt.popk");
$dtim=mysqli_fetch_array($crim);


$vassal="<span style='font-family:arial;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(53, 157, 217, 1);'>".$dtim['vassalnm']."&nbsp</span>";

include "../config/koneksi4.php";
$rs = mysqli_query($koneksi,"SELECT dtg.tgldtg, dtgdt.qtydtg, dtgdt.unitdtg, dtgdt.popk, dtgdt.podtpk FROM dtgdt
LEFT OUTER JOIN dtg ON dtg.dtgpk=dtgdt.dtgpk
WHERE dtgdt.nopo='$pono' AND dtgdt.rkbpk='$rkbpk'
ORDER BY dtg.tgldtg ASC");
$result = array();

$row = array();
$i=0;
while($data=mysqli_fetch_array($rs)){
$i++;
$qtydtg=number_format($data['qtydtg'],0,".",",");
$qty="<span style='font-family:arial;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.6);'>".$qtydtg."&nbsp;".$data['unitdtg']."&nbsp;received</span>";


$row[] = array(
// 'vassalnm'=>$dtim['vassalnm'],
'vassalnm'=>$vassal,
'qtydtg'=>$qty,
'tgldtg'=>$data['tgldtg'],
'popk'=>$dtim['popk'],
'importpk'=>$dtim['importpk'],);

// 'vassalnm'=>$dtim['vassalnm']);
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
?>