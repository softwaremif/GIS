<?php
session_start();
include "../config/koneksi.php";
include "../config/koneksi11a.php";
include "../config/koneksi103a.php";
include "../config/ip.php";

$ip=ip();
$browser=browser();
$sistem=$_SERVER['HTTP_USER_AGENT'];
$userlog=$_SESSION['login'];

if($_GET['x']=="order"){
$id = $_POST['id'];
$cr=mysqli_query($koneksi,"select * from ord where ordpk='$id'");
$dt=mysqli_fetch_array($cr);
$row = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM ord WHERE ordpk='$id'"));
if($row>0){
$text = mysqli_query($koneksi,"DELETE FROM ord WHERE ordpk='$id'");

$lognote="User " .$userlog. " delete data order " .$dt['ordno'];
$insert2=mysqli_query($koneksi,"insert into logtran set
logdtime=NOW(),
logdate=NOW(),
logtime=NOW(),
logip='$ip',
lognote='$lognote',
ordpk='$id',
sistem='$sistem'");
echo "<div class='text-infohijau'>Order data deleted &nbsp; &#10004; </div>";
}
else{
echo "<div class='text-infomerah'>No order data deleted &nbsp; &#x2573; </div>";
}
} if($_GET['x']=="orderimg"){
$id = $_POST['ordpk'];
$text = mysqli_query($koneksi,"DELETE FROM ord WHERE ordpk='$id'");
$text2 = mysqli_query($koneksi,"DELETE FROM rkb WHERE ordpk='$id' and hari1=CURDATE()");
// Return a success response with the statuspk
$response = [
    'success' => true,
    'message' => "<div class='text-infohijau' style='width:285px;'>Order data deleted &nbsp; &#10004; </div>",
    'ordpk' => $id // Add statuspk to the response
];
echo json_encode($response);
} if($_GET['x']=="qty"){
// $bdownpk = intval($_REQUEST['id']);
$bdownpk = $_GET['bdownpk'];
$cr=mysqli_query($koneksi,"select * from bdown
left outer join ord on ord.ordpk=bdown.ordpk
where bdown.bdownpk='$bdownpk'");
$dt=mysqli_fetch_array($cr);
$stsprod=$dt['stsprod'];
//country
$cr2a=mysqli_query($koneksi,"select * from bdown where country='$dt[country]'");
$dt2a=mysqli_num_rows($cr2a);
if($dt2a==1){
$del2a=mysqli_query($koneksi,"delete from bdown where jenis='FOOTER1' and sumby='country' and sumdata='$dt[country]'");
}
//color
$cr2b=mysqli_query($koneksi,"select * from bdown where color='$dt[color]'");
$dt2b=mysqli_num_rows($cr2b);
if($dt2b==1){
$del2b=mysqli_query($koneksi,"delete from bdown where jenis='FOOTER1' and sumby='color' and sumdata='$dt[color]'");
}

// if($stsprod==1){
// //delandon11
// $dela1=mysqli_query($koneksi11a,"delete from po where bdownpk='$bdownpk' and ordpk='$dt[ordpk]'");
// //delandon103
// $dela2=mysqli_query($koneksi103a,"delete from po where bdownpk='$bdownpk' and ordpk='$dt[ordpk]'");
// }

$sql = "delete from bdown where bdownpk='$bdownpk'";
@mysqli_query($koneksi,$sql);

$lognote="User " .$userlog. " delete data qty order " .$dt['ordno'];
$insert2=mysqli_query($koneksi,"insert into logtran set
logdtime=NOW(),
logdate=NOW(),
logtime=NOW(),
logip='$ip',
lognote='$lognote',
bdownpk='$bdownpk',
ordpk='$dt[ordpk]',
sistem='$sistem'");
//echo "<div class='text-infohijau'>Order data deleted &nbsp; &#10004; </div>";
// echo json_encode(array('success'=>true,
// 'msg'=>"<div class='text-infohijau' style='width:285px;'>Order breakdown deleted &nbsp; &#10004; </div>"));
echo "<div class='text-infohijau' style='width:285px;'>Order breakdown deleted &nbsp; &#10004;</div>";
} if($_GET['x']=="detpo"){
// $rkbpk =  $_GET['rkbpk'];
$po =  $_GET['po'];
$id = $_POST['id'];
$N = count($id);
for($i=0; $i < $N; $i++){
$sql = "update podt set delsts='1' where rkbpk='$id'";
$sql2 = "update po set tdel='1' where popk='$po'";
@mysqli_query($koneksi,$sql);
$update1g=mysqli_query($koneksi,"update rkb set stspk='1', status='4', newdate=NULL, popk=NULL where rkbpk='$id'");
$update1h=mysqli_query($koneksi,"update rpo set tgljam=NOW(), tgl=NOW(), stspk='1', newdate=NULL, posts='0', popk='0', popros='0' where rkbpk='$id'");
//$sql = "delete from podt where rkbpk='$rkbpk'";
//echo json_encode(array('success'=>true,
//'msg'=>"<div class='text-infohijau'>PO material deleted &nbsp; &#10004; </div>"));
// echo "<div class='text-infohijau' style='width:250px;'>Material data deleted &nbsp; <span style='cursor:pointer;text-decoration:underline' onclick='undo();'onmouseout='editrowa();'>Undo</span> &#10004; </div>";
if($sql){
echo json_encode(array('success'=>true, 'msg'=>"<div class='text-infohijau' style='width:475px;'>Material is removed from PO, material returns to request PO &nbsp; &#10004; </div>"));
} else {
echo json_encode(array('msg'=>"<div class='text-infomerah'>There is error remove material &nbsp; &#x2573; </div>"));
}
}

} if($_GET['x']=="detpomd"){
$rkbpk =  $_GET['rkbpk'];
$po =  $_GET['po'];
//$sql = "delete from podt where rkbpk='$rkbpk'";
$sql = "update podt set delsts='1' where rkbpk='$rkbpk'";
$sql2 = "update po set tdel='1' where popk='$po'";
@mysqli_query($koneksi,$sql);
$update1g=mysqli_query($koneksi,"update rkb set stspk='1', status='4', newdate=NULL, popk=NULL where rkbpk='$rkbpk'");
$update1h=mysqli_query($koneksi,"update rpo set tgljam=NOW(), tgl=NOW(), stspk='1', newdate=NULL, posts='0', popk='0', popros='1' where rkbpk='$rkbpk'");
//echo json_encode(array('success'=>true,
//'msg'=>"<div class='text-infohijau'>PO material deleted &nbsp; &#10004; </div>"));
echo "<div class='text-infohijau' style='width:365px;'>Material is removed from PO, material returns to request PO &nbsp; <span style='cursor:pointer;text-decoration:underline' onclick='undo();'onmouseout='editrowa();'>Undo</span> &#10004; </div>";
} if($_GET['x']=="mat"){
$id = $_POST['id'];
$N = count($id);
for($i=0; $i < $N; $i++){
$cr=mysqli_query($koneksi,"select * from rkb
left outer join ord on ord.ordpk=rkb.ordpk
where rkb.rkbpk='$id'");
$dt=mysqli_fetch_array($cr);
$lognote="User " .$userlog. " delete data material item " .$dt['item']. " order " . $dt['ordno'];
$insert2=mysqli_query($koneksi,"insert into logtran set
logdtime=NOW(),
logdate=NOW(),
logtime=NOW(),
logip='$ip',
lognote='$lognote',
ordpk='$dt[ordpk]',
rkbpk='$id',
sistem='$sistem'");
$sql = mysqli_query($koneksi,"delete from rkb where rkbpk='$id'");
// $text2 = mysqli_query($koneksi,"delete from rpo where rkbpk='$id'");
// $text3 = mysqli_query($koneksi,"delete from podt where rkbpk='$id'");
$text4 = mysqli_query($koneksi,"delete from memo where rkbpk='$id'");
if($sql){
echo json_encode(array('success'=>true, 'msg'=>"<div class='text-infohijau'>Material data deleted &nbsp; &#10004; </div>"));
} else {
echo json_encode(array('msg'=>"<div class='text-infomerah'>There is error remove material &nbsp; &#x2573; </div>"));
}
}
} if($_GET['x']=="mat3"){
$id = $_POST['id'];
$row = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM rkb WHERE rkbpk='$id'"));
if($row>0){
$cr=mysqli_query($koneksi,"select * from rkb
left outer join ord on ord.ordpk=rkb.ordpk
where rkb.rkbpk='$id'");
$dt=mysqli_fetch_array($cr);
$lognote="User " .$userlog. " delete data material item " .$dt['item']. " order " .$dt['ordno'];
$insert2=mysqli_query($koneksi,"insert into logtran set
logdtime=NOW(),
logdate=NOW(),
logtime=NOW(),
logip='$ip',
lognote='$lognote',
ordpk='$dt[ordpk]',
rkbpk='$id',
sistem='$sistem'");
$text = mysqli_query($koneksi,"delete from rkb where rkbpk='$id'");
// $text2 = mysqli_query($koneksi,"delete from rpo where rkbpk='$id'");
// $text3 = mysqli_query($koneksi,"delete from podt where rkbpk='$id'");
$text4 = mysqli_query($koneksi,"delete from memo where rkbpk='$id'");

echo "<div class='text-infohijau'>Material data deleted &nbsp; &#10004; </div>";
}
else{
echo "<div class='text-infomerah'>No material data deleted &nbsp; &#x2573; </div>";
}
} if($_GET['x']=="delsts"){
$cr=mysqli_query($koneksi,"select * from podt where popk='$_GET[popk]' and delsts='1'");
while($dt=mysqli_fetch_array($cr)){
$sql = mysqli_query($koneksi,"delete from podt where rkbpk='$dt[rkbpk]'");
$update1g=mysqli_query($koneksi,"update rkb set stspk=NULL, status='2', newdate=NULL, popk=NULL where rkbpk='$dt[rkbpk]'");
$update1h=mysqli_query($koneksi,"delete from rpo where rkbpk='$dt[rkbpk]'");
echo "<div class='text-infohijau'>Materials deleted permanently &nbsp;&nbsp; &#10004; </div>";
}
} if($_GET['x']=="undo"){
$rkbpk =  $_GET['rkbpk'];
$popk = $_GET['popk'];
$postatpk = $_GET['postatpk'];
$submitdate = $_GET['submitdate'];
if($postatpk==4){ $status=6; }
else { $status=4; }

//$sql = "delete from podt where rkbpk='$rkbpk'";
$sql = "update podt set delsts='0' where rkbpk='$rkbpk'";
@mysqli_query($koneksi,$sql);
$update1g=mysqli_query($koneksi,"update rkb set stspk='2', status='$status', newdate=NOW(), popk='$popk' where rkbpk='$rkbpk'");
$update1h=mysqli_query($koneksi,"update rpo set tgljam='$submitdate', tgl='$submitdate', stspk='2', newdate=NOW(), posts='0', popk='$popk', popros='1' where rkbpk='$rkbpk'");
//echo json_encode(array('success'=>true,
//'msg'=>"<div class='text-infohijau'>PO material deleted &nbsp; &#10004; </div>"));
echo "<div class='text-infohijau'>Undo success &nbsp; &#10004; </div>";
}  
?>