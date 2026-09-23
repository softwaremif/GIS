<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../config/koneksi.php";
include "../config/koneksi4b.php";
include "../config/tanggal.php";
include "../config/tanggal2.php";
$thn=DATE('Y');
$thn2=$thn-2;
$thn2b=$thn2-2000;
$today=DATE('Y-m-d');

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 5000;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'ord.deldate';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';
$cari1 = isset($_POST['cari1']) ? ($_POST['cari1']) : false;
$cari2 = isset($_POST['cari2']) ? ($_POST['cari2']) : false;
$cari3 = isset($_POST['cari3']) ? ($_POST['cari3']) : false;
$cari4 = isset($_POST['cari4']) ? ($_POST['cari4']) : false;
$cari5 = isset($_POST['cari5']) ? ($_POST['cari5']) : false;
$cari7 = isset($_POST['cari7']) ? ($_POST['cari7']) : false;
$cari8 = isset($_POST['cari8']) ? ($_POST['cari8']) : false;
$byr0 = isset($_POST['byr0']) ? ($_POST['byr0']) : false;
$byr1 = isset($_POST['byr1']) ? ($_POST['byr1']) : false;
$prodes0 = isset($_POST['prodes0']) ? ($_POST['prodes0']) : false;
$prodes1 = isset($_POST['prodes1']) ? ($_POST['prodes1']) : false;
$season0 = isset($_POST['season0']) ? ($_POST['season0']) : false;
$season1 = isset($_POST['season1']) ? ($_POST['season1']) : false;

$offset = ($page-1) * $rows;

//byr
if($byr0==''){
$abyr = array($byr1);
}else if($byr1==''){
$abyr = array($byr0);
}else{
$abyr=array($byr0,$byr1);
}
$ibyr = implode("', '",$abyr);

//prodes
if($prodes0==''){
$aprodes = array($prodes1);
}else if($prodes1==''){
$aprodes = array($prodes0);
}else{
$aprodes=array($prodes0,$prodes1);
}
$iprodes = implode("', '",$aprodes);

//season
if($season0==''){
$aseason = array($season1);
}else if($season1==''){
$aseason = array($season0);
}else{
$aseason=array($season0,$season1);
}
$iseason = implode("', '",$aseason);

if($cari4==1){ $order="DESC"; } 
if($cari5==1){ $order="ASC"; }
else { $order="DESC"; }

if ($cari1<>"") {
    $and1 = "and concat(ord.ordno,byr.byrnm,ord.prodes,ord.season,ord.artno,fu.funm) like '%$cari1%'";
} else if($_GET['c1']<>""){
    $and1 = "and concat(ord.ordno,byr.byrnm,ord.prodes,ord.season,ord.artno,fu.funm) like '%$_GET[c1]%'";
} else {
    $and1="";
}

if ($cari2 > 0) {
    $and2 = "and byr.byrpk='$cari2'";
} else if($_GET['c2']){
    $and2 = "and byr.byrpk='$_GET[c2]'";
} else {
    $and2="";
}

if ($cari3) {
    if ($cari3 == "All") {
        $and3="";
    } else {
        $and3 = "and ord.season like '%$cari3%'";
    }
} else if($_GET['c3']){
    $and3 = "and ord.season like '%$_GET[c3]%'";
} else {
    $and3="";
}

if ($cari7) {
    $and5 = "and ord.fupk='$cari7'";
} else if ($_GET['c7']) {
    $and5 = "and ord.fupk='$_GET[c7]'";
} else {
    $and5="";
}

if ($cari8 > 0) {
    $and8 = "where YEAR(ord.datecreate)='$cari8'";
} else if ($_GET['c8'] > 0) {
    $and8 = "where YEAR(ord.datecreate)='$_GET[c8]'";
} else  {
    $and8 = "where YEAR(ord.datecreate)='$thn'";
}

if($byr0<>"" || $byr1<>""){
//$csupp="and sup.supnm LIKE '%$supp0%' or sup.supnm LIKE '%$supp1%'";
$cbyr="and byr.byrnm IN ('$ibyr')";
}
if($prodes0<>"" || $prodes1<>""){
$cprodes="and ord.prodes IN ('$iprodes')";
}
if($season0<>"" || $season1<>""){
$cseason="and ord.season IN ('$iseason')";
}

if($_SESSION['leader']>0){ $lead="and fu.team='$_SESSION[leader]'"; } 
// else { $lead=""; }

if($_SESSION['gusernm']=="exim" || $_SESSION['gusernm']=="finance"){
$bdown="and ord.ordqty>0";
}

// $orderby=",byr.byrnm asc, ord.ordno asc";

$rs = mysqli_query($koneksi,"select byr.byrnm, fu.funm, ord.srno, ord.ordpk, ord.ordno, ord.artno, ord.prodes, ord.stage,
ord.season, ord.buymonth, ord.deldate, ord.codate, ord.filenm, byr.byrpk, costing.CM, CONCAT(UPPER(SUBSTRING(user.login,1,1)),LOWER(SUBSTRING(user.login,2))) as login
FROM ord
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
left outer join user on user.userpk=ord.userpk
left outer join costing on costing.ordpk=ord.ordpk
$and8 $and1 $and2 $and3 $and4 $and5 $lead $cbyr $cprodes $cseason $bdown
ORDER BY $sort $order
LIMIT $rows OFFSET $offset");
// if($_SESSION['spv']==1){ $and4=""; }
// else { $and4="and ord.userpk='$_SESSION[user]'"; }
$result = array();
$result['total'] = mysqli_num_rows(mysqli_query($koneksi,"select byr.byrnm, fu.funm, ord.srno, ord.ordpk, ord.ordno, ord.stage, ord.artno, ord.prodes,
ord.season, ord.buymonth, ord.deldate, ord.codate, ord.filenm, byr.byrpk, costing.CM, CONCAT(UPPER(SUBSTRING(user.login,1,1)),LOWER(SUBSTRING(user.login,2))) as login
FROM ord
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
left outer join user on user.userpk=ord.userpk
left outer join costing on costing.ordpk=ord.ordpk
$and8 $and1 $and2 $and3 $and4 $and5 $lead $cbyr $cprodes $cseason $bdown"));
$row = array();

$k =$offset;

while($data=mysqli_fetch_array($rs)){
$k++;
if($data['deldate']=="0000-00-00" || $data['deldate']==""){ $deldate=""; $deldate2=""; }
else { $deldate=$data['deldate']; $deldate2=tgl($data['deldate']); }

$sql2=mysqli_query($koneksi,"select sched.cut, sched.ssew, sched.fsew, lin.linnm
from sched
left outer join ord on ord.ordpk=sched.ordpk
left outer join lin on lin.linpk=sched.linpk
where sched.ordpk='$data[ordpk]' order by sched.schedpk asc limit 1");
$x2=mysqli_fetch_array($sql2);
$updtsched=mysqli_query($koneksi,"update ord set schedcut='$x2[cut]' where ordpk='$data[ordpk]' ");
if($x2['cut']=="0000-00-00" || $x2['cut']=="") { $cut="-"; }
else { $cut=tgl($x2['cut']); }

if($x2['ssew']=="0000-00-00" || $x2['ssew']=="") { $ssew="-"; }
else { $ssew=tgl($x2['ssew']); }

if($x2['fsew']=="0000-00-00" || $x2['fsew']=="") { $fsew="-"; }
else { $fsew=tgl($x2['fsew']); }

if($x2['linnm']==""){ $linnm="-"; } else { $linnm=$x2['linnm']; }

$sql2c=mysqli_query($koneksi,"SELECT * FROM costing WHERE ordpk='$data[ordpk]'");
$x2c=mysqli_fetch_array($sql2c);

$fob=$x2c['CM'] + $x2c['materials'] + $x2c['others'];
if($fob>0){
    $fob2= "$".number_format($fob,2,".",",",);
}else{
    $fob2= "-";
}

$sql2b=mysqli_query($koneksi,"select sum(tot) as tot from bdown
where ordpk='$data[ordpk]' and jenis='DETAIL' and color<>'' group by ordpk");
$x2b=mysqli_fetch_array($sql2b);
if($x2b['tot']>0){
    $qty=number_format($x2b['tot'],0,".",",");
    $updtqty=mysqli_query($koneksi,"update ord set ordqty='$x2b[tot]' where ordpk='$data[ordpk]' ");
} else {
    $qty="-";
}

//$btn = '<a href="?hal=detord&ord='.$data['ordpk'].'" style="text-decoration:none;">'.$data['ordno'].'</a>';
//$baris = "<input type='text' id='baris' name='baris' value='$result[total]'>";
$prodes=preg_replace('/[^a-zA-Z""#()_%+-;]/', ' ', $data['prodes']);
$artno=preg_replace('/[^a-zA-Z""#()_%+-;]/', ' ', $data['artno']);

//Cutting
// include "../config/koneksi.php";
$sqlcut1=mysqli_query($koneksi,"SELECT sum(pocons) as tpocons
FROM rkb
WHERE ordpk='$data[ordpk]' and kelnm like '%CUTTING%'");
$xcut1=mysqli_fetch_array($sqlcut1);
$tpoconscut=number_format($xcut1['tpocons'],0,"","");
$rkbcut=mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM rkb
WHERE ordpk='$data[ordpk]' and kelnm like '%CUTTING%'"));

// include "../config/koneksi4.php";
$sqlcut2=mysqli_query($koneksi4,"SELECT SUM(qtydtg) as tqtydtg
FROM dtgdt
WHERE ordpk='$data[ordpk]' and stsunit='0' AND kelnm like '%CUTTING%'");
$xcut2=mysqli_fetch_array($sqlcut2);
$tqtydtgcut=number_format($xcut2['tqtydtg'],0,"","");
$rkbcut2=mysqli_num_rows(mysqli_query($koneksi4,"SELECT * FROM dtgdt
WHERE ordpk='$data[ordpk]' and stsunit='0' and kelnm like '%CUTTING%' group by rkbpk"));
//}

if($tqtydtgcut>0){
if($rkbcut==$rkbcut2){
if($tpoconscut<=$tqtydtgcut){
    $stssew="<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 12px;line-height: 16px;color:#19B715;cursor:pointer;'>Complete</span>";
}else if($tpoconscut>$tqtydtgcut){
    $stscut="<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 12px;line-height: 16px;color:#359DD9;cursor:pointer;'>Partial in</span>";
}else{
    $stscut="";
}
} else {
$stscut="<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 12px;line-height: 16px;color:#359DD9;cursor:pointer;'>Partial in</span>";
}
}
else{
    $stscut="";
}
$cutt=$cut."<br>".$stscut;

//if($cut<>"-"){
//if($today>=$cut){
//if($data['stsemail']==0){
//if($tqtydtgcut>0){
//if($tpoconscut>$tqtydtgcut){
//include "../email/emailcut.php?ord=$data[ordpk]";    
//}
//}
//}   
//}
//}

//Sewing
// include "../config/koneksi.php";
$sqlsew1=mysqli_query($koneksi,"SELECT sum(pocons) as tpocons
FROM rkb
WHERE ordpk='$data[ordpk]' and kelnm like '%SEWING%'");
$xsew1=mysqli_fetch_array($sqlsew1);
$tpoconssew=number_format($xsew1['tpocons'],0,"","");
$rkbsew=mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM rkb
WHERE ordpk='$data[ordpk]' and kelnm like '%SEWING%'"));

// include "../config/koneksi4.php";
$sqlsew2=mysqli_query($koneksi4,"SELECT SUM(qtydtg) as tqtydtg
FROM dtgdt
WHERE ordpk='$data[ordpk]' and stsunit='0' AND kelnm like '%SEWING%'");
$xsew2=mysqli_fetch_array($sqlsew2);
$tqtydtgsew=number_format($xsew2['tqtydtg'],0,"","");
$rkbsew2=mysqli_num_rows(mysqli_query($koneksi4,"SELECT * FROM dtgdt
WHERE ordpk='$data[ordpk]' and stsunit='0' and kelnm like '%SEWING%' group by rkbpk"));

if($tqtydtgsew>0){
if($rkbsew==$rkbsew2){
if($tpoconssew<=$tqtydtgsew){
    $stssew="<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 12px;line-height: 16px;color:#19B715;cursor:pointer;'>Complete</span>";
}else if($tpoconssew>$tqtydtgsew){
    $stssew="<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 12px;line-height: 16px;color:#359DD9;cursor:pointer;'>Partial in</span>";
}else{
    $stssew="";
}
} else {
$stssew="<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 12px;line-height: 16px;color:#359DD9;cursor:pointer;'>Partial in</span>";
}
}
else{
    $stssew="";
}
$sseww=$ssew."<br>".$stssew;

//FINISHING /PACKING
// include "../config/koneksi.php";
$sqlfin1=mysqli_query($koneksi,"SELECT sum(pocons) as tpocons, rkbpk
FROM rkb
WHERE ordpk='$data[ordpk]' and kelnm like '%FINISHING/PACKING%'
group by ordpk");
$xfin1=mysqli_fetch_array($sqlfin1);
$tpoconsfin=number_format($xfin1['tpocons'],0,"","");
$rkbfin=mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM rkb
WHERE ordpk='$data[ordpk]' and kelnm like '%FINISHING/PACKING%'"));

// include "../config/koneksi4.php";
$sqlfin2=mysqli_query($koneksi4,"SELECT SUM(qtydtg) as tqtydtg, rkbpk
FROM dtgdt
WHERE ordpk='$data[ordpk]' and stsunit='0' AND kelnm like '%FINISHING/PACKING%'
group by ordpk");
$xfin2=mysqli_fetch_array($sqlfin2);
$tqtydtgfin=number_format($xfin2['tqtydtg'],0,"","");
$rkbfin2=mysqli_num_rows(mysqli_query($koneksi4,"SELECT * FROM dtgdt
WHERE ordpk='$data[ordpk]' and stsunit='0' and kelnm like '%FINISHING/PACKING%' group by rkbpk"));

if($tqtydtgfin>0){
if($rkbfin==$rkbfin2){
if($tpoconsfin<=$tqtydtgfin){
    $stsfin="<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 12px;line-height: 16px;color:#19B715;cursor:pointer;'>Complete</span>";
}else if($tpoconsfin>$tqtydtgfin){
    $stsfin="<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 12px;line-height: 16px;color:#359DD9;cursor:pointer;'>Partial in</span>";
}else{
    $stsfin="";
}
} else {
$stsfin="<span style='font-family: arial;font-style: normal;font-weight: 400;font-size: 12px;line-height: 16px;color:#359DD9;cursor:pointer;'>Partial in</span>";
}
}
else{
    $stsfin="";
}
$fseww=$fsew."<br>".$stsfin;

//STATUS
// if($x2['cut']<>'0000-00-00' || $x2['cut']<>''  || $x2['ssew']<>'0000-00-00' || $x2['ssew']<>'' || $x2['fsew']<>'0000-00-00' || $x2['fsew']<>''){
if($today>=$x2['fsew'] && $x2['fsew']<>''){
    $status="<span style='background-color:#FE6600;padding:5px;color:#FFFFFF;font-size:12px;border-radius:5px;'>FINISHING</span>";
}else if($today>=$x2['ssew'] && $x2['ssew']<>''){
    $status="<span style='background-color:#19B715;padding:5px;color:#FFFFFF;font-size:12px;border-radius:5px;'>SEWING</span>";
}else if($today>=$x2['cut'] && $x2['cut']<>''){
    $status="<span style='background-color:#0B89D2;padding:5px;color:#FFFFFF;font-size:12px;border-radius:5px;'>CUTTING</span>";
}else{
    $status="<span style='color:#00000061'>N/A</span>";
}
// }else{
//     $status="-";
// }

// $act = "<div style='font-family: Arial;font-style: normal;font-weight: 700;font-size: 20px;line-height: 26px;color:#000000;'>&#10247;</div>";

// $act = "<img src='css/images/More.png' width='24px' height='24px'></img>";
$act = "";

if($data['season']<>""){
$dtseason=$data['season'];
} else {
$dtseason="";
}

$sql2d=mysqli_query($koneksi,"select * from bdown
where ordpk='$data[ordpk]' and jenis='DETAIL' and gac>0 order by gac asc limit 1");
$x2d=mysqli_fetch_array($sql2d);
if($x2d['gac']=="0000-00-00" || $x2d['gac']==""){ $gac=""; }
else { $gac=tgl($x2d['gac']); }

if($deldate2>0){ 
$deldate2=$deldate2; 
}
else { 
$deldate2=$gac; 
$updtdeldate=mysqli_query($koneksi,"update ord set deldate='$x2d[gac]' where ordpk='$data[ordpk]'");
}

// include "../config/koneksi.php";
$row[] = array(
'no'=>$k,
'ordpk'=>$data['ordpk'],
'ordno1'=>$btn,
'ordno'=>$data['ordno'],
'byrnm'=>$data['byrnm'],
'byrpk'=>$data['byrpk'],
'prodes'=>$prodes,
'season'=>$dtseason,
'funm'=>$data['funm'],
'filenm'=>$data['filenm'],
'srno'=>$data['srno'],
'artno'=>$artno,
'deldate'=>$deldate,
'deldate2'=>$deldate2,
'fob'=>$fob2,
'cut'=>$cut,
'ssew'=>$ssew,
'fsew'=>$fsew,
'stscut'=>$stscut,
'stsssew'=>$stssew,
'stsfsew'=>$stsfin,
'linnm'=>$linnm,
'qty'=>$qty,
'act'=>$act,
'status'=>$status,
'stage'=>$data['stage'],
'user'=>$data['login']);
}
$result=array_merge($result,array('rows'=>$row));
echo json_encode($result);
?>