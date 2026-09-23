<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
//require_once "../parser-php-version.php";
ini_set('max_execution_time', 0);
date_default_timezone_set('Asia/Jakarta');
//session_start();
//include "../config/admin_session.php";
//include "../config/koneksi.php";
include "../config/truncate.php";
include "../config/tanggal.php";
require_once("class.phpmailer.php");
require_once("class.smtp.php");
$date=date("Y-m-d");
//$date="2022-10-18";
$next=date("Y-m-d", strtotime("+1 days", strtotime($date)));

/*revised material*/
if($_GET['id']=="rev1"){
$cr=mysqli_query($koneksi,"select * from user where fupk='$_GET[fu]'");
$dt=mysqli_fetch_array($cr);
if($dt['login']=="hani"){
$login = "lina";
$to = "lina@ptmorich.com";
} else {
$login = $dt['login'];
$to = $dt['email'];  
}

$mail = new PHPMailer();
$body ="
<div><b>{#] orders returned for revision</b></div> <br>
<div>
Hello, $login <br>
Your purchase requests have been returned for revision. The materials are:
</div> <br><br>";
$body .="
<table>
<tr style='color:rgba(0,0,0,0.38); font-weight:bold;'>
<td width='150px;'>Item</td>
<td width='450px;'>Description</td>
<td width='150px;'>Supplier</td>
<td width='100px;'>Color</td>
</tr>";
$cr2=mysqli_query($koneksi,"select * from memo
left outer join rkb on rkb.rkbpk=memo.rkbpk
where memo.cek='1' and memo.user='$_GET[user]' and memo.fupk='$_GET[fu]'
and memo.memonm is null and memo.tgl1='$date' and memo.email='0'
group by rkb.rkbpk order by rkb.ordpk asc");
while($dt2=mysqli_fetch_array($cr2)){
$item=truncate(TRIM($dt2['item']),13);
$spec=truncate(TRIM($dt2['spec']),45);
$sup=truncate(TRIM($dt2['sup']),13);
$col=truncate(TRIM($dt2['colname']),8);
$body .="
<tr>
<td>$item</td>
<td>$spec</td>
<td>$sup</td>
<td>$col</td>
</tr>";
}
$body .="
</table> <br><br>
<div>
Kind Regards,<br>
GIS notification system
</div> <br><br>";
$cr2b=mysqli_query($koneksi,"select * from memo
left outer join rkb on rkb.rkbpk=memo.rkbpk
where memo.cek='1' and memo.user='$_GET[user]' and memo.fupk='$_GET[fu]'
and memo.memonm is null and memo.tgl1='$date' and memo.email='0'
group by rkb.ordpk order by rkb.ordpk asc");
while($dt2b=mysqli_fetch_array($cr2b)){
$body .="
<div>
<a href='http://192.168.0.22/GISL2/admin.php?hal=detmat&ord=$dt2b[ordpk]&dt=3' target='_blank'
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
Check materials</a>
</div>";
}
$body .="
<br>
<div>
<i>create by IT - Dept</i>
</div>"; //isi dari email
$mail->IsSMTP(); // mengirimkan sinyal ke class PHPMail untuk menggunakan SMTP
$mail->SMTPDebug  = 1;                     // mengaktifkan debug mode (untuk ujicoba) 1 = Error dan pesan 2 = Pesan saja
$mail->SMTPAuth   = true;                  // aktifkan autentikasi SMTP
$mail->SMTPSecure = "";                 // jenis kemananan
$mail->Host       = "192.168.0.2";      // masukkan GMAIL sebagai smtp server
$mail->Port       = "587";                   // masukkan port yang digunakan oleh SMTP Gmail
$mail->Username   = "notif_gis@ptmorich.com";  // GMAIL username
$mail->Password   = "gis@2022";            // GMAIL password
$mail->SetFrom('notif_gis@ptmorich.com', 'GIS notification system'); // masukkan alamat pengririm dan nama pengirim jika alamat email tidak sama, maka yang digunakan alamat email untuk username
$mail->Subject    = "{#] orders returned for revision";//masukkan subject
$mail->MsgHTML($body);//masukkan isi dari email

/*$address1 = $to;
$mail->AddAddress($address1, $login);*/
$address1 = "erwin@ptmorich.com";
$mail->AddAddress($address1, "erwin");

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo; // jika pesan tidak terkirim
} else {
//jika pesan terkirim
}
}
/*revised PO*/
if($_GET['id']=="rev2"){
$cr1=mysqli_query($koneksi, "select * from rkb
left outer join ord on ord.ordpk=rkb.ordpk
left outer join po on po.popk=rkb.popk
where rkb.popk='$_GET[po]' group by ord.fupk");
$dt1=mysqli_fetch_array($cr1);
$pono=$dt1['pono'];
$memo=$_GET['memo'];

$cr=mysqli_query($koneksi,"select * from user where fupk='$dt1[fupk]'");
$dt=mysqli_fetch_array($cr);
if($dt['login']=="hani"){
$login = "lina";
$to = "lina@ptmorich.com";
} else {
$login = $dt['login'];
$to = $dt['email'];  
}

$mail = new PHPMailer();
$body ="
<div><b>PO $pono has been revision</b></div> <br>
<div>
Hello, $login <br>
Your purchase requests have been returned for revision. The materials are:
</div> <br><br>
<div><b>PO $pono</b></div> <br>
<div> *note : $memo </div> <br>";
$body .="
<table>
<tr style='color:rgba(0,0,0,0.38); font-weight:bold;'>
<td width='150px;'>Item</td>
<td width='450px;'>Description</td>
<td width='150px;'>Supplier</td>
<td width='100px;'>Color</td>
<td width='100px;'>Order no</td>
</tr>";
$cr2=mysqli_query($koneksi,"select * from rkb
left outer join ord on ord.ordpk=rkb.ordpk
left outer join po on po.popk=rkb.popk
where rkb.popk='$_GET[po]'
order by ord.ordno asc");
while($dt2=mysqli_fetch_array($cr2)){
$item=truncate(TRIM($dt2['item']),13);
$spec=truncate(TRIM($dt2['spec']),45);
$sup=truncate(TRIM($dt2['sup']),13);
$col=truncate(TRIM($dt2['colname']),8);
$body .="
<tr>
<td>$item</td>
<td>$spec</td>
<td>$sup</td>
<td>$col</td>
<td>$dt2[ordno]</td>
</tr>";
}
$body .="
</table> <br><br>
<div>
Kind Regards,<br>
GIS notification system
</div> <br><br>";
$cr2b=mysqli_query($koneksi,"select * from rkb
left outer join ord on ord.ordpk=rkb.ordpk
left outer join po on po.popk=rkb.popk
where rkb.popk='$_GET[po]'
group by ord.ordpk order by ord.ordno asc");
while($dt2b=mysqli_fetch_array($cr2b)){
$body .="
<div>
<a href='http://192.168.0.22/GISL2/admin.php?hal=detmat&ord=$dt2b[ordpk]&dt=3' target='_blank'
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
Check materials</a>
</div> <br>";
}
$body .="
<div>
<i>create by IT - Dept</i>
</div>"; //isi dari email
$mail->IsSMTP(); // mengirimkan sinyal ke class PHPMail untuk menggunakan SMTP
$mail->SMTPDebug  = 1;                     // mengaktifkan debug mode (untuk ujicoba) 1 = Error dan pesan 2 = Pesan saja
$mail->SMTPAuth   = true;                  // aktifkan autentikasi SMTP
$mail->SMTPSecure = "";                 // jenis kemananan
$mail->Host       = "192.168.0.2";      // masukkan GMAIL sebagai smtp server
$mail->Port       = "587";                   // masukkan port yang digunakan oleh SMTP Gmail
$mail->Username   = "notif_gis@ptmorich.com";  // GMAIL username
$mail->Password   = "gis@2022";            // GMAIL password
$mail->SetFrom('notif_gis@ptmorich.com', 'GIS notification system'); // masukkan alamat pengririm dan nama pengirim jika alamat email tidak sama, maka yang digunakan alamat email untuk username
$mail->Subject    = "PO $pono has been revision";//masukkan subject
$mail->MsgHTML($body);//masukkan isi dari email

/*$address1 = $to;
$mail->AddAddress($address1, $login);*/
$address1 = "erwin@ptmorich.com";
$mail->AddAddress($address1, $login);

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo; // jika pesan tidak terkirim
} else {
//jika pesan terkirim
}
}
/*PO issued*/
if($_GET['id']=="po"){
$cr1=mysqli_query($koneksi, "select * from rkb
left outer join ord on ord.ordpk=rkb.ordpk
left outer join po on po.popk=rkb.popk
where rkb.popk='$_GET[po]' group by ord.fupk");
$dt1=mysqli_fetch_array($cr1);
$pono=$dt1['pono'];

$cr=mysqli_query($koneksi,"select * from user where fupk='$dt1[fupk]'");
$dt=mysqli_fetch_array($cr);
if($dt['login']=="hani"){
$login = "lina";
$to = "lina@ptmorich.com";
} else {
$login = $dt['login'];
$to = $dt['email'];  
}

$mail = new PHPMailer();
$body ="
<div><b>PO $pono has been issued</b></div> <br>
<div>
Hello, $login <br>
Your purchase requests has been processed. It will now wait for supplier feedback.
</div> <br><br>
<div><b>PO $pono</b></div> <br>";
$body .="
<table>
<tr style='color:rgba(0,0,0,0.38); font-weight:bold;'>
<td width='150px;'>Item</td>
<td width='450px;'>Description</td>
<td width='150px;'>Supplier</td>
<td width='100px;'>Color</td>
<td width='100px;'>Order no</td>
</tr>";
$cr2=mysqli_query($koneksi,"select * from rkb
left outer join ord on ord.ordpk=rkb.ordpk
left outer join po on po.popk=rkb.popk
where rkb.popk='$_GET[po]'
order by ord.ordno asc");
while($dt2=mysqli_fetch_array($cr2)){
$item=truncate(TRIM($dt2['item']),13);
$spec=truncate(TRIM($dt2['spec']),45);
$sup=truncate(TRIM($dt2['sup']),13);
$col=truncate(TRIM($dt2['colname']),8);
$body .="
<tr>
<td>$item</td>
<td>$spec</td>
<td>$sup</td>
<td>$col</td>
<td>$dt2[ordno]</td>
</tr>";
}
$body .="
</table> <br><br>
<div>
Kind Regards,<br>
GIS notification system
</div> <br><br>";
$cr2b=mysqli_query($koneksi,"select * from rkb
left outer join ord on ord.ordpk=rkb.ordpk
left outer join po on po.popk=rkb.popk
where rkb.popk='$_GET[po]'
group by ord.ordpk order by ord.ordno asc");
while($dt2b=mysqli_fetch_array($cr2b)){
$body .="
<div>
<a href='http://192.168.0.22/GISL2/admin.php?hal=pur&ord=$dt2b[ordpk]' target='_blank'
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
Check materials</a>
</div> <br>";
}
$body .="
<div>
<i>create by IT - Dept</i>
</div>"; //isi dari email
$mail->IsSMTP(); // mengirimkan sinyal ke class PHPMail untuk menggunakan SMTP
$mail->SMTPDebug  = 1;                     // mengaktifkan debug mode (untuk ujicoba) 1 = Error dan pesan 2 = Pesan saja
$mail->SMTPAuth   = true;                  // aktifkan autentikasi SMTP
$mail->SMTPSecure = "";                 // jenis kemananan
$mail->Host       = "192.168.0.2";      // masukkan GMAIL sebagai smtp server
$mail->Port       = "587";                   // masukkan port yang digunakan oleh SMTP Gmail
$mail->Username   = "notif_gis@ptmorich.com";  // GMAIL username
$mail->Password   = "gis@2022";            // GMAIL password
$mail->SetFrom('notif_gis@ptmorich.com', 'GIS notification system'); // masukkan alamat pengririm dan nama pengirim jika alamat email tidak sama, maka yang digunakan alamat email untuk username
$mail->Subject    = "PO $pono has been issued";//masukkan subject
$mail->MsgHTML($body);//masukkan isi dari email

/*$address1 = $to;
$mail->AddAddress($address1, $login);*/
$address1 = "erwin@ptmorich.com";
$mail->AddAddress($address1, "erwin");

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo; // jika pesan tidak terkirim
} else {
//jika pesan terkirim
}
}
/*PO confrimed*/
if($_GET['id']=="pay"){
$cr1=mysqli_query($koneksi, "select * from rkb
left outer join ord on ord.ordpk=rkb.ordpk
left outer join po on po.popk=rkb.popk
where rkb.popk='$_GET[po]' group by ord.fupk");
$dt1=mysqli_fetch_array($cr1);
$pono=$dt1['pono'];

$cr=mysqli_query($koneksi,"select * from user where fupk='$dt1[fupk]'");
$dt=mysqli_fetch_array($cr);
if($dt['login']=="hani"){
$login = "lina";
$to = "lina@ptmorich.com";
} else {
$login = $dt['login'];
$to = $dt['email'];  
}

$mail = new PHPMailer();
$body ="
<div><b>PO $pono order has been confirmed</b></div> <br>
<div>
Hello, $login <br>
A purchase order has been confirmed by the supplier and will soon be shipped.
</div> <br><br>
<div><b>PO $pono</b></div> <br>";
$body .="
<table>
<tr style='color:rgba(0,0,0,0.38); font-weight:bold;'>
<td width='150px;'>Item</td>
<td width='450px;'>Description</td>
<td width='150px;'>Supplier</td>
<td width='100px;'>Color</td>
<td width='100px;'>Order no</td>
</tr>";
$cr2=mysqli_query($koneksi,"select * from rkb
left outer join ord on ord.ordpk=rkb.ordpk
left outer join po on po.popk=rkb.popk
where rkb.popk='$_GET[po]'
order by ord.ordno asc");
while($dt2=mysqli_fetch_array($cr2)){
$item=truncate(TRIM($dt2['item']),13);
$spec=truncate(TRIM($dt2['spec']),45);
$sup=truncate(TRIM($dt2['sup']),13);
$col=truncate(TRIM($dt2['colname']),8);
$body .="
<tr>
<td>$item</td>
<td>$spec</td>
<td>$sup</td>
<td>$col</td>
<td>$dt2[ordno]</td>
</tr>";
}
$body .="
</table> <br><br>
<div>
Kind Regards,<br>
GIS notification system
</div> <br><br>";
$cr2b=mysqli_query($koneksi,"select * from rkb
left outer join ord on ord.ordpk=rkb.ordpk
left outer join po on po.popk=rkb.popk
where rkb.popk='$_GET[po]'
group by ord.ordpk order by ord.ordno asc");
while($dt2b=mysqli_fetch_array($cr2b)){
$body .="
<div>
<a href='http://192.168.0.22/GISL2/admin.php?hal=pur&ord=$dt2b[ordpk]' target='_blank'
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
Check materials</a>
</div> <br>";
}
$body .="
<div>
<i>create by IT - Dept</i>
</div>"; //isi dari email
$mail->IsSMTP(); // mengirimkan sinyal ke class PHPMail untuk menggunakan SMTP
$mail->SMTPDebug  = 1;                     // mengaktifkan debug mode (untuk ujicoba) 1 = Error dan pesan 2 = Pesan saja
$mail->SMTPAuth   = true;                  // aktifkan autentikasi SMTP
$mail->SMTPSecure = "";                 // jenis kemananan
$mail->Host       = "192.168.0.2";      // masukkan GMAIL sebagai smtp server
$mail->Port       = "587";                   // masukkan port yang digunakan oleh SMTP Gmail
$mail->Username   = "notif_gis@ptmorich.com";  // GMAIL username
$mail->Password   = "gis@2022";            // GMAIL password
$mail->SetFrom('notif_gis@ptmorich.com', 'GIS notification system'); // masukkan alamat pengririm dan nama pengirim jika alamat email tidak sama, maka yang digunakan alamat email untuk username
$mail->Subject    = "PO $pono order has been confirmed";//masukkan subject
$mail->MsgHTML($body);//masukkan isi dari email

/*$address1 = $to;
$mail->AddAddress($address1, $login);*/
$address1 = "erwin@ptmorich.com";
$mail->AddAddress($address1, "erwin");

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo; // jika pesan tidak terkirim
} else {
//jika pesan terkirim
}
}
/*request po*/
if($_GET['id']=="req"){
$cr=mysqli_query($koneksi,"select * from user where fupk='$_GET[fu]'");
$dt=mysqli_fetch_array($cr);
$login = $dt['login'];
$from = $dt['email'];
$tgl=tgl($date);

$mail = new PHPMailer();
if($_GET['mat']==1){
$cr1=mysqli_query($koneksi,"select count(*) as tot from rpo
where tgl='$date' and kelnm='CUTTING' and email='0' group by tgl");
$dt1=mysqli_fetch_array($cr1);
$tot=$dt1['tot'];
$to="Purchasing (fabric)";
$body ="
<div><b>{#] new purchase requests</b></div> <br>
<div>
Hello, $to <br>
Your have $tot new purchase requests. Please see the following list and process for purchasing.
</div> <br><br>
Requester: $login on $tgl <br>";
$body .="
<table>
<tr style='color:rgba(0,0,0,0.38); font-weight:bold;'>
<td width='150px;'>Item</td>
<td width='450px;'>Description</td>
<td width='150px;'>Supplier</td>
<td width='100px;'>Color</td>
</tr>";
$cr2=mysqli_query($koneksi,"select * from rpo
where tgl='$date' and kelnm='CUTTING' and email='0' order by item asc");
while($dt2=mysqli_fetch_array($cr2)){
$item=truncate(TRIM($dt2['item']),13);
$spec=truncate(TRIM($dt2['spec']),45);
$sup=truncate(TRIM($dt2['sup']),13);
$col=truncate(TRIM($dt2['colname']),8);
$body .="
<tr>
<td>$item</td>
<td>$spec</td>
<td>$sup</td>
<td>$col</td>
</tr>";
}
$body .="
</table> <br><br>
<div>
Kind Regards,<br>
GIS notification system
</div> <br><br>";
$cr2b=mysqli_query($koneksi,"select * from rpo where tgl='$date' and kelnm='CUTTING' and email='0'
group by ordpk order by item asc");
while($dt2b=mysqli_fetch_array($cr2b)){
$body .="
<div>
<a href='http://192.168.0.22/GISL2/admin.php?hal=new' target='_blank'
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
Check materials</a>
</div>";
}
$body .="
<br>
<div>
<i>create by IT - Dept</i>
</div>";
} if($_GET['mat']==2){
$cr1=mysqli_query($koneksi,"select count(*) as tot from rpo
where tgl='$date' and kelnm<>'CUTTING' and email='0' group by tgl");
$dt1=mysqli_fetch_array($cr1);
$tot=$dt1['tot'];
$to="Purchasing (accessories)";
$body ="
<div><b>{#] new purchase requests</b></div> <br>
<div>
Hello, $to <br>
Your have $tot new purchase requests. Please see the following list and process for purchasing.
</div> <br><br>
Requester: $login on $tgl <br>";
$body .="
<table>
<tr style='color:rgba(0,0,0,0.38); font-weight:bold;'>
<td width='150px;'>Item</td>
<td width='450px;'>Description</td>
<td width='150px;'>Supplier</td>
<td width='100px;'>Color</td>
</tr>";
$cr2=mysqli_query($koneksi,"select * from rpo where tgl='$date' and kelnm<>'CUTTING' and email='0' order by item asc");
while($dt2=mysqli_fetch_array($cr2)){
$item=truncate(TRIM($dt2['item']),13);
$spec=truncate(TRIM($dt2['spec']),45);
$sup=truncate(TRIM($dt2['sup']),13);
$col=truncate(TRIM($dt2['colname']),8);
$body .="
<tr>
<td>$item</td>
<td>$spec</td>
<td>$sup</td>
<td>$col</td>
</tr>";
}
$body .="
</table> <br><br>
<div>
Kind Regards,<br>
GIS notification system
</div> <br><br>";
$cr2b=mysqli_query($koneksi,"select * from rpo where tgl='$date' and kelnm<>'CUTTING' and email='0'
group by ordpk order by item asc");
while($dt2b=mysqli_fetch_array($cr2b)){
$body .="
<div>
<a href='http://192.168.0.22/GISL2/admin.php?hal=new' target='_blank'
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
Check materials</a>
</div>";
}
$body .="
<br>
<div>
<i>create by IT - Dept</i>
</div>";  
}//isi dari email
$mail->IsSMTP(); // mengirimkan sinyal ke class PHPMail untuk menggunakan SMTP
$mail->SMTPDebug  = 1;                     // mengaktifkan debug mode (untuk ujicoba) 1 = Error dan pesan 2 = Pesan saja
$mail->SMTPAuth   = true;                  // aktifkan autentikasi SMTP
$mail->SMTPSecure = "";                 // jenis kemananan
$mail->Host       = "192.168.0.2";      // masukkan GMAIL sebagai smtp server
$mail->Port       = "587";                   // masukkan port yang digunakan oleh SMTP Gmail
$mail->Username   = "notif_gis@ptmorich.com";  // GMAIL username
$mail->Password   = "gis@2022";            // GMAIL password
$mail->SetFrom('notif_gis@ptmorich.com', 'GIS notification system'); // masukkan alamat pengririm dan nama pengirim jika alamat email tidak sama, maka yang digunakan alamat email untuk username
$mail->Subject    = "{#] new purchase requests";//masukkan subject
$mail->MsgHTML($body);//masukkan isi dari email

/*if($_GET['mat']==1){
$cr3=mysqli_query($koneksi,"select * from user where material='1' order by login asc");
while($dt3=mysqli_fetch_array($cr3)){
$email=$dt3['email'];
$nama=$dt3['login'];
$address1 = $email;
$mail->AddAddress($address1, $nama);
} if($_GET['mat']==2){
$cr3=mysqli_query($koneksi,"select * from user where material='2' order by login asc");
while($dt3=mysqli_fetch_array($cr3)){
$email=$dt3['email'];
$nama=$dt3['login'];
$address1 = $email;
$mail->AddAddress($address1, $nama);  
}*/
$address1 = "erwin@ptmorich.com";
$mail->AddAddress($address1, "erwin");

/*$address1 = "vichy@ptmorich.com";
$mail->AddAddress($address1, "vichy");*/

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo; // jika pesan tidak terkirim
} else {
//jika pesan terkirim
}
}
?>