<?php
$thn=DATE('Y');
$today=DATE('Y-m-d');

if($_SESSION['spv']==1){ $and="and ord.fupk='$_SESSION[fu]'"; }
else { $and="and ord.userpk='$_SESSION[user]'"; }

$sqla = mysqli_query($koneksi,"select byr.byrnm, fu.funm, ord.srno, ord.ordpk, ord.ordno, ord.artno, ord.prodes, ord.stsemail,
ord.season, ord.buymonth, ord.deldate, ord.codate, ord.filenm, byr.byrpk, CONCAT(UPPER(SUBSTRING(user.login,1,1)),LOWER(SUBSTRING(user.login,2))) as login
FROM ord
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
left outer join user on user.userpk=ord.userpk
where YEAR(ord.datecreate)='$thn' $and");
while($data=mysqli_fetch_array($sqla)){
$ord=$data['ordpk'];

$sqlb=mysqli_query($koneksi,"select sched.cut, sched.ssew, sched.fsew, lin.linnm, sched.schedpk
from sched
left outer join ord on ord.ordpk=sched.ordpk
left outer join lin on lin.linpk=sched.linpk
where sched.ordpk='$data[ordpk]' order by sched.schedpk desc limit 1");
$dtb=mysqli_fetch_array($sqlb);  


$sqlcut1=mysqli_query($koneksi,"SELECT sum(pocons) as tpocons
FROM rkb
WHERE ordpk='$data[ordpk]' and kelnm like '%CUTTING%'");
$xcut1=mysqli_fetch_array($sqlcut1);

//DATA FROM LPB
$sqlcut2=mysqli_query($koneksi4,"SELECT SUM(qtydtg) as tqtydtg
FROM dtgdt
WHERE ordpk='$data[ordpk]' and stsunit='0' AND kelnm like '%CUTTING%'");
$xcut2=mysqli_fetch_array($sqlcut2);

$next=date("Y-m-d", strtotime("-14 days", strtotime($dtb['cut'])));
$next2=date("Y-m-d", strtotime("-7 days", strtotime($dtb['cut'])));
$next3=date("Y-m-d", strtotime("-3 days", strtotime($dtb['cut'])));
$next4=date("Y-m-d", strtotime($dtb['cut']));

$blntoday = date('m',strtotime($today));
$blncut = date('m',strtotime($dtb['cut']));
$thncut = date('Y',strtotime($dtb['cut']));

if($dtb['schedpk']>0 && $dtb['cut']<>'0000-00-00' || $dtb['cut']<>''){
if($blncut >= $blntoday && $thncut>=$thn){
if($xcut2['tqtydtg']>0){
if($xcut2['tqtydtg']<$xcut1['tpocons']){
if($data['stsemail']==0){
$result3 = mysqli_query($koneksi,"update ord set stsemail='1', dateemail='$next' where ordpk='$ord'");
}
if($data['stsemail']==1){
if($today>=$next){
$result3b = mysqli_query($koneksi,"update ord set stsemail='2', dateemail='$next2' where ordpk='$ord'");
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
//require_once "../parser-php-version.php";
ini_set('max_execution_time', 0);
date_default_timezone_set('Asia/Jakarta');
session_start();
//include "config/admin_session.php";
//include "../config/koneksi.php";
//include "config/truncate.php";
//include "config/tanggal.php";
require_once("class.phpmailer.php");
require_once("class.smtp.php");
$date=date("Y-m-d");
//$date="2022-10-18";
$fu=$_SESSION['fu'];
$user=$_SESSION['user'];
$ord=$data['ordpk'];
//$mat=2;
//$next=date("Y-m-d", strtotime("+1 days", strtotime($date)));
$cr=mysqli_query($koneksi,"select * from user where userpk='$user'");
$dt=mysqli_fetch_array($cr);
/*if($dt['login']=="hani"){
$login = "lina";
$to = "lina@ptmorich.com";
} else {*/
$login = $dt['login'];
$to = $dt['username'];  
/*}*/
//$tgl=tgl($date);
$cr1a=mysqli_query($koneksi,"select * from ord where ordpk='$ord'");
$dt1a=mysqli_fetch_array($cr1a);
$sql2=mysqli_query($koneksi,"select sched.cut, sched.ssew, sched.fsew, lin.linnm
from sched
left outer join ord on ord.ordpk=sched.ordpk
left outer join lin on lin.linpk=sched.linpk
where sched.ordpk='$ord' order by sched.schedpk desc limit 1");
$x2=mysqli_fetch_array($sql2);
if($x2['cut']=="0000-00-00" || $x2['cut']=="") { $cut="-"; }
else { $cut=tgl($x2['cut']); }

$mail = new PHPMailer();
$body ="
<div><b>Order $dt1a[ordno], Cutting soon </b></div> <br>
<div>
Hello, $login <br>
Your Order $dt1a[ordno] is planned to start cutting on $cut and some materials are still missing.<br>Here are the list of materials that need to be prepared for cutting:
</div><br>
<div style='font-family: Arial;font-style: normal;font-size: 16px;line-height: 20px;'><b>Material arrival records</b></div><br>
<div style='font-family: Arial;font-style: normal;font-size: 14px;line-height: 18px;'><b>$dt1a[ordno] - Cutting</b></div>";
$body .="
<table>
<tr style='color:rgba(0,0,0,0.38); font-weight:bold;'>
<th width='100px;'>PO</th>
<th width='150px;'>Item</th>
<th width='150px;'>Description</th>
<th width='125px;'>Supplier</th>
<th width='85px;'>Color</th>
<th width='85px;'>Price</th>
<th width='85px;'>Quantity</th>
<th width='85px;'>Arrival<br>qty</th>
<th width='85px;'>Balance</th>
<th width='100px;'>Delivery<br>ETD</th>
</tr>";
$cr2=mysqli_query($koneksi,"SELECT rkb.rkbpk, rkb.unit, cur.curid, rkb.item, rkb.spec, sup.supnm, rkb.colname,
rkb.price, rkb.pocons, po.pono, po.etd, rkb.ordpk, rkb.kelnm
FROM rkb
left outer join podt on podt.rkbpk=rkb.rkbpk
left outer join po on po.popk=podt.popk
LEFT OUTER JOIN sup on sup.suppk = po.suppk
LEFT OUTER JOIN cur on cur.curpk = podt.curpk
WHERE rkb.ordpk='$ord' and rkb.spec<>'' AND rkb.kelnm LIKE '%CUTTING%' ORDER BY podtpk ASC");
while($dt2=mysqli_fetch_array($cr2)){
if($dt2['curid']=="IDR"){
if($dt2['price']=="0.00000"){
$price="-";
} else {
$price=number_format($dt2['price'],0,".",",")." ".$dt2['curid'];
}
} else {
if($dt2['price']=="0.00000"){
$price="-";
} else {
$price=number_format($dt2['price'],3,".",",")." ".$dt2['curid'];
}
}
$pocons=number_format($dt2['pocons'],0,".",",")." ".$dt2['unit'];
$item=truncate(TRIM($dt2['item']),13);
$spec=truncate(TRIM($dt2['spec']),45);
$hari1=tgl($dt2['hari1']);
$pono=$dt2['pono'];
$supnm=$dt2['supnm'];
$colname=$dt2['colname'];
if($dt2['etd']=="0000-00-00" || $dt2['etd']=="") { $etd="-"; }
else { $etd=tgl($dt2['etd']); }

//require_once("../config/koneksi4.php");
$sqlcut=mysqli_query($koneksi4,"SELECT dtgdt.qtypo, SUM(dtgdt.qtydtg) as qtydtg, dtg.tgldtg, dtgdt.unitdtg
FROM dtgdt
LEFT OUTER JOIN dtg on dtg.dtgpk = dtgdt.dtgpk
WHERE dtgdt.rkbpk='$dt2[rkbpk]' AND dtgdt.kelnm LIKE '%CUTTING%'
GROUP BY dtgdt.rkbpk
ORDER BY dtgdt.rkbpk ASC");
$dtsqlcut=mysqli_fetch_array($sqlcut);

if($dtsqlcut['qtydtg']>=$dt2['pocons']){
$qtydtg="<span style='color:#19B715;cursor:pointer;'>".number_format($dtsqlcut['qtydtg'],0,".",",")." ".$dtsqlcut['unitdtg']."</span>";    
}else if($dtsqlcut['qtydtg']<$dt2['pocons'] && $dtsqlcut['qtydtg']<>0){
$qtydtg="<span style='color:#FF6B00;cursor:pointer;'>".number_format($dtsqlcut['qtydtg'],0,".",",")." ".$dtsqlcut['unitdtg']."</span>";    
}else{
$qtydtg=number_format($dtsqlcut['qtydtg'],0,".",",");
}


if(TRIM($dt2['unit']) <> TRIM($dtsqlcut['unitdtg']) && $dtsqlcut['qtydtg']>0 ){
$balance="<span style='color:#EF3B42'>Difference Unit</span>";  
}else{
$balance=$dtsqlcut['qtydtg'] - $dt2['pocons']." ".$dtsqlcut['unitdtg'];
if($balance<0){
$balance=substr($balance,1);    
}else if ($balance>0){
$balance="<span style='color: rgba(0, 0, 0, 0.38);'>+".$balance."</span>";     
}else{
$balance;   
}
}

$body .="
<tr>
<td>$pono</td>
<td>$item</td>
<td>$spec</td>
<td>$supnm</td>
<td>$colname</td>
<td>$price</td>
<td>$pocons</td>
<td>$qtydtg</td>
<td>$balance</td>
<td>$etd</td>
</tr>";
}
$body .="
</table> <br><br>
<div>
<a href='http://192.168.0.22/GIS/admin?hal=mat&ord=$ord' target='_blank'
style='
background:#000000;
border-radius:8px;
text-align:center;
color:#FFFFFF;
text-decoration:none;
align-items: center;
padding:8px;
gap:8px;
font-family: 'Arial';
font-style: normal;
font-weight: 400;
font-size: 14px;
line-height: 18px;
width: 170px;
height: 34px;'>
Open order details</a>
</div><br><br>";
$body .="
<div>
Kind Regards,<br>
morich notification system
</div> <br><br>";
$body .="
<br>
<div>
<i>create by IT - Dept</i>
</div>";//isi dari email
//$cr2c=mysqli_query($koneksi,"select * from rkb
//left outer join ord on ord.ordpk=rkb.ordpk
//left outer join bdown on bdown.ordpk=ord.ordpk
//where ord.fupk='$fu' and ord.userpk='$user' and rkb.hari2 <='$date' and rkb.status='1' and rkb.rkbsts='0' and bdown.tot >'1'
//order by ord.ordno ASC");
//while($dt2c=mysqli_fetch_array($cr2c)){

//}
$mail->IsSMTP(); // mengirimkan sinyal ke class PHPMail untuk menggunakan SMTP
$mail->SMTPDebug  = 1;                     // mengaktifkan debug mode (untuk ujicoba) 1 = Error dan pesan 2 = Pesan saja
$mail->SMTPAuth   = true;                  // aktifkan autentikasi SMTP
$mail->SMTPSecure = "";                 // jenis kemananan
$mail->Host       = "192.168.0.2";      // masukkan GMAIL sebagai smtp server
$mail->Port       = "587";                   // masukkan port yang digunakan oleh SMTP Gmail
$mail->Username   = "notif_gis@ptmorich.com";  // GMAIL username
$mail->Password   = "gis@2022";            // GMAIL password
$mail->SetFrom('notif_gis@ptmorich.com', 'morich notification system'); // masukkan alamat pengririm dan nama pengirim jika alamat email tidak sama, maka yang digunakan alamat email untuk username
$mail->Subject    = "order $dt1a[ordno] is cutting soon on $cut";//masukkan subject
$mail->MsgHTML($body);//masukkan isi dari email

//$address1 = "vichy@ptmorich.com";
//$mail->AddAddress($address1);
$address1 = $to;
$mail->AddAddress($address1, $login); 

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo; // jika pesan tidak terkirim
} else {
//jika pesan terkirim
}  
}
}
if($data['stsemail']==2){
if($today>=$next2){
$result3c = mysqli_query($koneksi,"update ord set stsemail='3', dateemail='$next3' where ordpk='$ord'");
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
//require_once "../parser-php-version.php";
ini_set('max_execution_time', 0);
date_default_timezone_set('Asia/Jakarta');
session_start();
//include "config/admin_session.php";
//include "../config/koneksi.php";
//include "config/truncate.php";
//include "config/tanggal.php";
require_once("class.phpmailer.php");
require_once("class.smtp.php");
$date=date("Y-m-d");
//$date="2022-10-18";
$fu=$_SESSION['fu'];
$user=$_SESSION['user'];
$ord=$data['ordpk'];
//$mat=2;
//$next=date("Y-m-d", strtotime("+1 days", strtotime($date)));
$cr=mysqli_query($koneksi,"select * from user where userpk='$user'");
$dt=mysqli_fetch_array($cr);
/*if($dt['login']=="hani"){
$login = "lina";
$to = "lina@ptmorich.com";
} else {*/
$login = $dt['login'];
$to = $dt['username'];  
/*}*/
//$tgl=tgl($date);
$cr1a=mysqli_query($koneksi,"select * from ord where ordpk='$ord'");
$dt1a=mysqli_fetch_array($cr1a);
$sql2=mysqli_query($koneksi,"select sched.cut, sched.ssew, sched.fsew, lin.linnm
from sched
left outer join ord on ord.ordpk=sched.ordpk
left outer join lin on lin.linpk=sched.linpk
where sched.ordpk='$ord' order by sched.schedpk desc limit 1");
$x2=mysqli_fetch_array($sql2);
if($x2['cut']=="0000-00-00" || $x2['cut']=="") { $cut="-"; }
else { $cut=tgl($x2['cut']); }

$mail = new PHPMailer();
$body ="
<div><b>Order $dt1a[ordno], Cutting soon </b></div> <br>
<div>
Hello, $login <br>
Your Order $dt1a[ordno] is planned to start cutting on $cut and some materials are still missing.<br>Here are the list of materials that need to be prepared for cutting:
</div><br>
<div style='font-family: Arial;font-style: normal;font-size: 16px;line-height: 20px;'><b>Material arrival records</b></div><br>
<div style='font-family: Arial;font-style: normal;font-size: 14px;line-height: 18px;'><b>$dt1a[ordno] - Cutting</b></div>";
$body .="
<table>
<tr style='color:rgba(0,0,0,0.38); font-weight:bold;'>
<th width='100px;'>PO</th>
<th width='150px;'>Item</th>
<th width='150px;'>Description</th>
<th width='125px;'>Supplier</th>
<th width='85px;'>Color</th>
<th width='85px;'>Price</th>
<th width='85px;'>Quantity</th>
<th width='85px;'>Arrival<br>qty</th>
<th width='85px;'>Balance</th>
<th width='100px;'>Delivery<br>ETD</th>
</tr>";
$cr2=mysqli_query($koneksi,"SELECT rkb.rkbpk, rkb.unit, cur.curid, rkb.item, rkb.spec, sup.supnm, rkb.colname,
rkb.price, rkb.pocons, po.pono, po.etd, rkb.ordpk, rkb.kelnm
FROM rkb
left outer join podt on podt.rkbpk=rkb.rkbpk
left outer join po on po.popk=podt.popk
LEFT OUTER JOIN sup on sup.suppk = po.suppk
LEFT OUTER JOIN cur on cur.curpk = podt.curpk
WHERE rkb.ordpk='$ord' and rkb.spec<>'' AND rkb.kelnm LIKE '%CUTTING%' ORDER BY podtpk ASC");
while($dt2=mysqli_fetch_array($cr2)){
if($dt2['curid']=="IDR"){
if($dt2['price']=="0.00000"){
$price="-";
} else {
$price=number_format($dt2['price'],0,".",",")." ".$dt2['curid'];
}
} else {
if($dt2['price']=="0.00000"){
$price="-";
} else {
$price=number_format($dt2['price'],3,".",",")." ".$dt2['curid'];
}
}
$pocons=number_format($dt2['pocons'],0,".",",")." ".$dt2['unit'];
$item=truncate(TRIM($dt2['item']),13);
$spec=truncate(TRIM($dt2['spec']),45);
$hari1=tgl($dt2['hari1']);
$pono=$dt2['pono'];
$supnm=$dt2['supnm'];
$colname=$dt2['colname'];
if($dt2['etd']=="0000-00-00" || $dt2['etd']=="") { $etd="-"; }
else { $etd=tgl($dt2['etd']); }

//require_once("../config/koneksi4.php");
$sqlcut=mysqli_query($koneksi4,"SELECT dtgdt.qtypo, SUM(dtgdt.qtydtg) as qtydtg, dtg.tgldtg, dtgdt.unitdtg
FROM dtgdt
LEFT OUTER JOIN dtg on dtg.dtgpk = dtgdt.dtgpk
WHERE dtgdt.rkbpk='$dt2[rkbpk]' AND dtgdt.kelnm LIKE '%CUTTING%'
GROUP BY dtgdt.rkbpk
ORDER BY dtgdt.rkbpk ASC");
$dtsqlcut=mysqli_fetch_array($sqlcut);

if($dtsqlcut['qtydtg']>=$dt2['pocons']){
$qtydtg="<span style='color:#19B715;cursor:pointer;'>".number_format($dtsqlcut['qtydtg'],0,".",",")." ".$dtsqlcut['unitdtg']."</span>";    
}else if($dtsqlcut['qtydtg']<$dt2['pocons'] && $dtsqlcut['qtydtg']<>0){
$qtydtg="<span style='color:#FF6B00;cursor:pointer;'>".number_format($dtsqlcut['qtydtg'],0,".",",")." ".$dtsqlcut['unitdtg']."</span>";    
}else{
$qtydtg=number_format($dtsqlcut['qtydtg'],0,".",",");
}


if(TRIM($dt2['unit']) <> TRIM($dtsqlcut['unitdtg']) && $dtsqlcut['qtydtg']>0 ){
$balance="<span style='color:#EF3B42'>Difference Unit</span>";  
}else{
$balance=$dtsqlcut['qtydtg'] - $dt2['pocons']." ".$dtsqlcut['unitdtg'];
if($balance<0){
$balance=substr($balance,1);    
}else if ($balance>0){
$balance="<span style='color: rgba(0, 0, 0, 0.38);'>+".$balance."</span>";     
}else{
$balance;   
}
}

$body .="
<tr>
<td>$pono</td>
<td>$item</td>
<td>$spec</td>
<td>$supnm</td>
<td>$colname</td>
<td>$price</td>
<td>$pocons</td>
<td>$qtydtg</td>
<td>$balance</td>
<td>$etd</td>
</tr>";
}
$body .="
</table> <br><br>
<div>
<a href='http://192.168.0.22/GIS/admin?hal=mat&ord=$ord' target='_blank'
style='
background:#000000;
border-radius:8px;
text-align:center;
color:#FFFFFF;
text-decoration:none;
align-items: center;
padding:8px;
gap:8px;
font-family: 'Arial';
font-style: normal;
font-weight: 400;
font-size: 14px;
line-height: 18px;
width: 170px;
height: 34px;'>
Open order details</a>
</div><br><br>";
$body .="
<div>
Kind Regards,<br>
morich notification system
</div> <br><br>";
$body .="
<br>
<div>
<i>create by IT - Dept</i>
</div>";//isi dari email
//$cr2c=mysqli_query($koneksi,"select * from rkb
//left outer join ord on ord.ordpk=rkb.ordpk
//left outer join bdown on bdown.ordpk=ord.ordpk
//where ord.fupk='$fu' and ord.userpk='$user' and rkb.hari2 <='$date' and rkb.status='1' and rkb.rkbsts='0' and bdown.tot >'1'
//order by ord.ordno ASC");
//while($dt2c=mysqli_fetch_array($cr2c)){


//}
$mail->IsSMTP(); // mengirimkan sinyal ke class PHPMail untuk menggunakan SMTP
$mail->SMTPDebug  = 1;                     // mengaktifkan debug mode (untuk ujicoba) 1 = Error dan pesan 2 = Pesan saja
$mail->SMTPAuth   = true;                  // aktifkan autentikasi SMTP
$mail->SMTPSecure = "";                 // jenis kemananan
$mail->Host       = "192.168.0.2";      // masukkan GMAIL sebagai smtp server
$mail->Port       = "587";                   // masukkan port yang digunakan oleh SMTP Gmail
$mail->Username   = "notif_gis@ptmorich.com";  // GMAIL username
$mail->Password   = "gis@2022";            // GMAIL password
$mail->SetFrom('notif_gis@ptmorich.com', 'morich notification system'); // masukkan alamat pengririm dan nama pengirim jika alamat email tidak sama, maka yang digunakan alamat email untuk username
$mail->Subject    = "order $dt1a[ordno] is cutting soon on $cut";//masukkan subject
$mail->MsgHTML($body);//masukkan isi dari email

//$address1 = "vichy@ptmorich.com";
//$mail->AddAddress($address1);
$address1 = $to;
$mail->AddAddress($address1, $login); 

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo; // jika pesan tidak terkirim
} else {
//jika pesan terkirim
}
}
}
if($data['stsemail']==3){
if($today>=$next3){
$result3d = mysqli_query($koneksi,"update ord set stsemail='4', dateemail='$next4' where ordpk='$ord'");
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
//require_once "../parser-php-version.php";
ini_set('max_execution_time', 0);
date_default_timezone_set('Asia/Jakarta');
session_start();
//include "config/admin_session.php";
//include "../config/koneksi.php";
//include "config/truncate.php";
//include "config/tanggal.php";
require_once("class.phpmailer.php");
require_once("class.smtp.php");
$date=date("Y-m-d");
//$date="2022-10-18";
$fu=$_SESSION['fu'];
$user=$_SESSION['user'];
$ord=$data['ordpk'];
//$mat=2;
//$next=date("Y-m-d", strtotime("+1 days", strtotime($date)));
$cr=mysqli_query($koneksi,"select * from user where userpk='$user'");
$dt=mysqli_fetch_array($cr);
/*if($dt['login']=="hani"){
$login = "lina";
$to = "lina@ptmorich.com";
} else {*/
$login = $dt['login'];
$to = $dt['username'];  
/*}*/
//$tgl=tgl($date);
$cr1a=mysqli_query($koneksi,"select * from ord where ordpk='$ord'");
$dt1a=mysqli_fetch_array($cr1a);
$sql2=mysqli_query($koneksi,"select sched.cut, sched.ssew, sched.fsew, lin.linnm
from sched
left outer join ord on ord.ordpk=sched.ordpk
left outer join lin on lin.linpk=sched.linpk
where sched.ordpk='$ord' order by sched.schedpk desc limit 1");
$x2=mysqli_fetch_array($sql2);
if($x2['cut']=="0000-00-00" || $x2['cut']=="") { $cut="-"; }
else { $cut=tgl($x2['cut']); }

$mail = new PHPMailer();
$body ="
<div><b>Order $dt1a[ordno], Cutting soon </b></div> <br>
<div>
Hello, $login <br>
Your Order $dt1a[ordno] is planned to start cutting on $cut and some materials are still missing.<br>Here are the list of materials that need to be prepared for cutting:
</div><br>
<div style='font-family: Arial;font-style: normal;font-size: 16px;line-height: 20px;'><b>Material arrival records</b></div><br>
<div style='font-family: Arial;font-style: normal;font-size: 14px;line-height: 18px;'><b>$dt1a[ordno] - Cutting</b></div>";
$body .="
<table>
<tr style='color:rgba(0,0,0,0.38); font-weight:bold;'>
<th width='100px;'>PO</th>
<th width='150px;'>Item</th>
<th width='150px;'>Description</th>
<th width='125px;'>Supplier</th>
<th width='85px;'>Color</th>
<th width='85px;'>Price</th>
<th width='85px;'>Quantity</th>
<th width='85px;'>Arrival<br>qty</th>
<th width='85px;'>Balance</th>
<th width='100px;'>Delivery<br>ETD</th>
</tr>";
$cr2=mysqli_query($koneksi,"SELECT rkb.rkbpk, rkb.unit, cur.curid, rkb.item, rkb.spec, sup.supnm, rkb.colname,
rkb.price, rkb.pocons, po.pono, po.etd, rkb.ordpk, rkb.kelnm
FROM rkb
left outer join podt on podt.rkbpk=rkb.rkbpk
left outer join po on po.popk=podt.popk
LEFT OUTER JOIN sup on sup.suppk = po.suppk
LEFT OUTER JOIN cur on cur.curpk = podt.curpk
WHERE rkb.ordpk='$ord' and rkb.spec<>'' AND rkb.kelnm LIKE '%CUTTING%' ORDER BY podtpk ASC");
while($dt2=mysqli_fetch_array($cr2)){
if($dt2['curid']=="IDR"){
if($dt2['price']=="0.00000"){
$price="-";
} else {
$price=number_format($dt2['price'],0,".",",")." ".$dt2['curid'];
}
} else {
if($dt2['price']=="0.00000"){
$price="-";
} else {
$price=number_format($dt2['price'],3,".",",")." ".$dt2['curid'];
}
}
$pocons=number_format($dt2['pocons'],0,".",",")." ".$dt2['unit'];
$item=truncate(TRIM($dt2['item']),13);
$spec=truncate(TRIM($dt2['spec']),45);
$hari1=tgl($dt2['hari1']);
$pono=$dt2['pono'];
$supnm=$dt2['supnm'];
$colname=$dt2['colname'];
if($dt2['etd']=="0000-00-00" || $dt2['etd']=="") { $etd="-"; }
else { $etd=tgl($dt2['etd']); }

//require_once("../config/koneksi4.php");
$sqlcut=mysqli_query($koneksi4,"SELECT dtgdt.qtypo, SUM(dtgdt.qtydtg) as qtydtg, dtg.tgldtg, dtgdt.unitdtg
FROM dtgdt
LEFT OUTER JOIN dtg on dtg.dtgpk = dtgdt.dtgpk
WHERE dtgdt.rkbpk='$dt2[rkbpk]' AND dtgdt.kelnm LIKE '%CUTTING%'
GROUP BY dtgdt.rkbpk
ORDER BY dtgdt.rkbpk ASC");
$dtsqlcut=mysqli_fetch_array($sqlcut);

if($dtsqlcut['qtydtg']>=$dt2['pocons']){
$qtydtg="<span style='color:#19B715;cursor:pointer;'>".number_format($dtsqlcut['qtydtg'],0,".",",")." ".$dtsqlcut['unitdtg']."</span>";    
}else if($dtsqlcut['qtydtg']<$dt2['pocons'] && $dtsqlcut['qtydtg']<>0){
$qtydtg="<span style='color:#FF6B00;cursor:pointer;'>".number_format($dtsqlcut['qtydtg'],0,".",",")." ".$dtsqlcut['unitdtg']."</span>";    
}else{
$qtydtg=number_format($dtsqlcut['qtydtg'],0,".",",");
}


if(TRIM($dt2['unit']) <> TRIM($dtsqlcut['unitdtg']) && $dtsqlcut['qtydtg']>0 ){
$balance="<span style='color:#EF3B42'>Difference Unit</span>";  
}else{
$balance=$dtsqlcut['qtydtg'] - $dt2['pocons']." ".$dtsqlcut['unitdtg'];
if($balance<0){
$balance=substr($balance,1);    
}else if ($balance>0){
$balance="<span style='color: rgba(0, 0, 0, 0.38);'>+".$balance."</span>";     
}else{
$balance;   
}
}

$body .="
<tr>
<td>$pono</td>
<td>$item</td>
<td>$spec</td>
<td>$supnm</td>
<td>$colname</td>
<td>$price</td>
<td>$pocons</td>
<td>$qtydtg</td>
<td>$balance</td>
<td>$etd</td>
</tr>";
}
$body .="
</table> <br><br>
<div>
<a href='http://192.168.0.22/GIS/admin?hal=mat&ord=$ord' target='_blank'
style='
background:#000000;
border-radius:8px;
text-align:center;
color:#FFFFFF;
text-decoration:none;
align-items: center;
padding:8px;
gap:8px;
font-family: 'Arial';
font-style: normal;
font-weight: 400;
font-size: 14px;
line-height: 18px;
width: 170px;
height: 34px;'>
Open order details</a>
</div><br><br>";
$body .="
<div>
Kind Regards,<br>
morich notification system
</div> <br><br>";
$body .="
<br>
<div>
<i>create by IT - Dept</i>
</div>";//isi dari email
//$cr2c=mysqli_query($koneksi,"select * from rkb
//left outer join ord on ord.ordpk=rkb.ordpk
//left outer join bdown on bdown.ordpk=ord.ordpk
//where ord.fupk='$fu' and ord.userpk='$user' and rkb.hari2 <='$date' and rkb.status='1' and rkb.rkbsts='0' and bdown.tot >'1'
//order by ord.ordno ASC");
//while($dt2c=mysqli_fetch_array($cr2c)){


//}
$mail->IsSMTP(); // mengirimkan sinyal ke class PHPMail untuk menggunakan SMTP
$mail->SMTPDebug  = 1;                     // mengaktifkan debug mode (untuk ujicoba) 1 = Error dan pesan 2 = Pesan saja
$mail->SMTPAuth   = true;                  // aktifkan autentikasi SMTP
$mail->SMTPSecure = "";                 // jenis kemananan
$mail->Host       = "192.168.0.2";      // masukkan GMAIL sebagai smtp server
$mail->Port       = "587";                   // masukkan port yang digunakan oleh SMTP Gmail
$mail->Username   = "notif_gis@ptmorich.com";  // GMAIL username
$mail->Password   = "gis@2022";            // GMAIL password
$mail->SetFrom('notif_gis@ptmorich.com', 'morich notification system'); // masukkan alamat pengririm dan nama pengirim jika alamat email tidak sama, maka yang digunakan alamat email untuk username
$mail->Subject    = "order $dt1a[ordno] is cutting soon on $cut";//masukkan subject
$mail->MsgHTML($body);//masukkan isi dari email

//$address1 = "vichy@ptmorich.com";
//$mail->AddAddress($address1);
$address1 = $to;
$mail->AddAddress($address1, $login); 

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo; // jika pesan tidak terkirim
} else {
//jika pesan terkirim
}
}
}

}  
}
}
}
}
?>