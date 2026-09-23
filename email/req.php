<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
//require_once "../parser-php-version.php";
ini_set('max_execution_time', 0);
date_default_timezone_set('Asia/Jakarta');
session_start();
//include "../config/admin_session.php";
//include "../config/koneksi.php";
//include "../config/truncate.php";
//include "../config/tanggal.php";
require_once("class.phpmailer.php");
require_once("class.smtp.php");
$date=date("Y-m-d");
//$date="2022-10-11";
$next=date("Y-m-d", strtotime("+1 days", strtotime($date)));
$fu=$_SESSION['fu'];
$user=$_SESSION['user'];

/*request po*/
$cr=mysqli_query($koneksi,"select * from user
left outer join fu on fu.fupk=user.fupk
where user.userpk='$user'");
$dt=mysqli_fetch_array($cr);
$login = $dt['login']."/".$dt['funm'];
$from = $dt['username'];
$tgl=tgl($date);

$cr1a=mysqli_query($koneksi,"select count(*) as tot from rpo
left outer join ord on ord.ordpk=rpo.ordpk
where ord.fupk='$fu' and ord.userpk='$user' and rpo.tgl='$date' and rpo.posts='0' and rpo.email='0' group by rpo.tgl");
$dt1a=mysqli_fetch_array($cr1a);
$total=$dt1a['tot'];
if($total>0){ $total2=$data['tot']; }
else {
$cr2a=mysqli_query($koneksi,"select count(*) as tot from rpo
left outer join ord on ord.ordpk=rpo.ordpk
where ord.fupk='$fu' and rpo.tgl='$date' and rpo.posts='0' and rpo.email='0' group by rpo.tgl");
$dt2a=mysqli_fetch_array($cr2a);
$total2=$dt2a['tot']; 
}

if($total2>0){
if($total>0){
$cr2c=mysqli_query($koneksi,"select * from rpo
left outer join ord on ord.ordpk=rpo.ordpk
where ord.fupk='$fu' and ord.userpk='$user' and rpo.tgl='$date' and rpo.posts='0' and rpo.email='0'
group by rpo.kelnm order by rpo.kelnm asc limit 2");
} else {
$cr2c=mysqli_query($koneksi,"select * from rpo
left outer join ord on ord.ordpk=rpo.ordpk
where ord.fupk='$fu' and rpo.tgl='$date' and rpo.posts='0' and rpo.email='0'
group by rpo.kelnm order by rpo.kelnm asc limit 2");  
}
while($dt2c=mysqli_fetch_array($cr2c)){
$mat=TRIM($dt2c['kelnm']);
if($mat=="CUTTING"){
$cr1=mysqli_query($koneksi,"select count(*) as tot from rpo
left outer join ord on ord.ordpk=rpo.ordpk
where ord.fupk='$fu' and ord.userpk='$user' and rpo.tgl='$date' and rpo.posts='0' and rpo.email='0' and rpo.kelnm='CUTTING' group by rpo.tgl");
$dt1=mysqli_fetch_array($cr1);
$tot=$dt1['tot'];
if($tot>0){ $tot2=$tot; }
else {
$cr2=mysqli_query($koneksi,"select count(*) as tot from rpo
left outer join ord on ord.ordpk=rpo.ordpk
where ord.fupk='$fu' and rpo.tgl='$date' and rpo.posts='0' and rpo.email='0' and rpo.kelnm='CUTTING' group by rpo.tgl");
$dt2=mysqli_fetch_array($cr2);
$tot2=$dt2['tot'];
}
$to="Purchasing (fabric)";
$mail = new PHPMailer();
$body ="
<div><b>$tot2 new purchase requests</b></div> <br>
<div>
Hello, $to <br>
Your have $tot2 new purchase requests. Please see the following list and process for purchasing.
</div> <br><br>
Requester: $login on $tgl <br>";
$body .="
<table>
<tr style='color:rgba(0,0,0,0.38); font-weight:bold;'>
<td width='150px;'>Item</td>
<td width='450px;'>Description</td>
<td width='150px;'>Supplier</td>
<td width='100px;'>Color</td>
<td width='100px;'>Order no</td>
</tr>";
if($tot>0){
$cr2=mysqli_query($koneksi,"select * from rpo
left outer join ord on ord.ordpk=rpo.ordpk
where ord.fupk='$fu' and ord.userpk='$user' and rpo.tgl='$date' and rpo.posts='0' and rpo.email='0' and rpo.kelnm='CUTTING' order by rpo.item asc");
} else {
$cr2=mysqli_query($koneksi,"select * from rpo
left outer join ord on ord.ordpk=rpo.ordpk
where ord.fupk='$fu' and rpo.tgl='$date' and rpo.posts='0' and rpo.email='0' and rpo.kelnm='CUTTING' order by rpo.item asc");
}
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
$result3 = mysqli_query($koneksi,"update rpo set email='1', hari='$next' where rpopk='$dt2[rpopk]'");
}
$body .="
</table> <br><br>
<div>
Kind Regards,<br>
morich notification system
</div> <br><br>";
/*$cr2b=mysqli_query($koneksi,"select * from rpo
left outer join ord on ord.ordpk=rpo.ordpk
where ord.fupk='$fu' and rpo.tgl='$date' and rpo.posts='0' and rpo.email='0' and rpo.kelnm='CUTTING'
group by ord.ordpk order by ord.ordno asc");
while($dt2b=mysqli_fetch_array($cr2b)){*/
$body .="
<div>
<a href='http://morich.com/GIS/admin.php?hal=new' target='_blank'
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
//}
$body .="
<br>
<div>
<i>create by IT - Dept</i>
</div>";
} else {
$cr1=mysqli_query($koneksi,"select count(*) as tot from rpo
left outer join ord on ord.ordpk=rpo.ordpk
where ord.fupk='$fu' and ord.userpk='$user' and rpo.tgl='$date' and rpo.posts='0' and rpo.email='0' and rpo.kelnm<>'CUTTING' group by rpo.tgl");
$dt1=mysqli_fetch_array($cr1);
$tot=$dt1['tot'];
if($tot>0){ $tot2=$tot; }
else {
$cr2=mysqli_query($koneksi,"select count(*) as tot from rpo
left outer join ord on ord.ordpk=rpo.ordpk
where ord.fupk='$fu' and rpo.tgl='$date' and rpo.posts='0' and rpo.email='0' and rpo.kelnm<>'CUTTING' group by rpo.tgl");
$dt2=mysqli_fetch_array($cr2);
$tot2=$dt2['tot'];
}
$to="Purchasing (accessories)";
$mail = new PHPMailer();
$body ="
<div><b>$tot2 new purchase requests</b></div> <br>
<div>
Hello, $to <br>
Your have $tot2 new purchase requests. Please see the following list and process for purchasing.
</div> <br><br>
Requester: $login on $tgl <br>";
$body .="
<table>
<tr style='color:rgba(0,0,0,0.38); font-weight:bold;'>
<td width='150px;'>Item</td>
<td width='450px;'>Description</td>
<td width='150px;'>Supplier</td>
<td width='100px;'>Color</td>
<td width='100px;'>Order no</td>
</tr>";
if($tot>0){
$cr2=mysqli_query($koneksi,"select * from rpo
left outer join ord on ord.ordpk=rpo.ordpk
where ord.fupk='$fu' and ord.userpk='$user' and rpo.tgl='$date' and rpo.posts='0' and rpo.email='0' and rpo.kelnm<>'CUTTING' order by rpo.item asc");
} else {
$cr2=mysqli_query($koneksi,"select * from rpo
left outer join ord on ord.ordpk=rpo.ordpk
where ord.fupk='$fu' and rpo.tgl='$date' and rpo.posts='0' and rpo.email='0' and rpo.kelnm<>'CUTTING' order by rpo.item asc");
}
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
$result3 = mysqli_query($koneksi,"update rpo set email='1', hari='$next' where rpopk='$dt2[rpopk]'");
}
$body .="
</table> <br><br>
<div>
Kind Regards,<br>
morich notification system
</div> <br><br>";
/*$cr2b=mysqli_query($koneksi,"select count(*) as tot from rpo
left outer join ord on ord.ordpk=rpo.ordpk
where ord.fupk='$fu' and rpo.tgl='$date' and rpo.posts='0' and rpo.email='0' and rpo.kelnm<>'CUTTING'
group by ord.ordpk order by ord.ordno asc");
while($dt2b=mysqli_fetch_array($cr2b)){*/
$body .="
<div>
<a href='http://morich.com/GIS/admin.php?hal=new' target='_blank'
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
//}
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
$mail->SetFrom('notif_gis@ptmorich.com', 'morich notification system'); // masukkan alamat pengririm dan nama pengirim jika alamat email tidak sama, maka yang digunakan alamat email untuk username
$mail->Subject    = "$tot new purchase requests";//masukkan subject
$mail->MsgHTML($body);//masukkan isi dari email

if($mat=="CUTTING"){
$cr3=mysqli_query($koneksi,"select * from user where material='1' order by login asc");
while($dt3=mysqli_fetch_array($cr3)){
$to=$dt3['username'];
$nama=$dt3['login'];
$address1 = $to;
$mail->AddAddress($address1, $nama);
}
} else {
$cr3=mysqli_query($koneksi,"select * from user where material='2' order by login asc");
while($dt3=mysqli_fetch_array($cr3)){
$to=$dt3['username'];
$nama=$dt3['login'];
$address1 = $to;
$mail->AddAddress($address1, $nama);  
}
}
/*$address1 = "erwin@ptmorich.com";
$mail->AddAddress($address1, "erwin");*/

/*$address1 = "vichy@ptmorich.com";
$mail->AddAddress($address1, "vichy");*/

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo; // jika pesan tidak terkirim
} else {
//jika pesan terkirim
}
}
}
?>