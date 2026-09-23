<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
//require_once "../parser-php-version.php";
ini_set('max_execution_time', 0);
date_default_timezone_set('Asia/Jakarta');
session_start();
//include "config/admin_session.php";
//include "config/koneksi.php";
//include "config/truncate.php";
//include "config/tanggal.php";
require_once("class.phpmailer.php");
require_once("class.smtp.php");
$date=date("Y-m-d");
//$date="2022-10-18";
$fu=$_SESSION['fu'];
$user=$_SESSION['user'];
//$mat=2;
$next=date("Y-m-d", strtotime("+1 days", strtotime($date)));

$cr=mysqli_query($koneksi,"select * from user where userpk='$user'");
$dt=mysqli_fetch_array($cr);
/*if($dt['login']=="hani"){
$login = "lina";
$to = "lina@ptmorich.com";
} else {*/
$login = $dt['login'];
$to = $dt['username'];  
/*}*/
$tgl=tgl($date);
$cr1a=mysqli_query($koneksi,"select count(*) as tot from rkb
left outer join ord on ord.ordpk=rkb.ordpk
left outer join bdown on bdown.ordpk=ord.ordpk
where ord.fupk='$fu' and ord.userpk='$user' and rkb.hari2 <='$date' and rkb.status='1' and rkb.rkbsts='0' and bdown.tot >'1'
group by rkb.hari2");
$dt1a=mysqli_fetch_array($cr1a);
$total=$dt1a['tot'];
if($total>0){
$mail = new PHPMailer();
$body ="
<div><b>$total materials still in progress</b></div> <br>
<div>
Hello, $login <br>
You have $total materials that are still waiting for completion. Check the listed materials below and complete their
purchase information!
</div> <br><br>";
$body .="
<table>
<tr style='color:rgba(0,0,0,0.38); font-weight:bold;'>
<td width='150px;'>Item</td>
<td width='450px;'>Description</td>
<td width='100px;'>Created on</td>
<td width='100px;'>Order no</td>
</tr>";
$cr2=mysqli_query($koneksi,"select * from rkb
left outer join ord on ord.ordpk=rkb.ordpk
left outer join bdown on bdown.ordpk=ord.ordpk
where ord.fupk='$fu' and ord.userpk='$user' and rkb.hari2 <='$date' and rkb.status='1' and rkb.rkbsts='0' and bdown.tot >'1'
order by ord.ordno ASC");
while($dt2=mysqli_fetch_array($cr2)){
$item=truncate(TRIM($dt2['item']),13);
$desc=truncate(TRIM($dt2['spec']),45);
$hari1=tgl($dt2['hari1']);
$order=$dt2['ordno'];
$body .="
<tr>
<td>$item</td>
<td>$desc</td>
<td>$hari1</td>
<td>$order</td>
</tr>";
}
$body .="
</table> <br><br>
<div>
Kind Regards,<br>
morich notification system
</div> <br><br>";
$cr2b=mysqli_query($koneksi,"select * from rkb
left outer join ord on ord.ordpk=rkb.ordpk
left outer join bdown on bdown.ordpk=ord.ordpk
where ord.fupk='$fu' and ord.userpk='$user' and rkb.hari2 <='$date' and rkb.status='1' and rkb.rkbsts='0' and bdown.tot >'1'
group by ord.ordpk");
while($dt2b=mysqli_fetch_array($cr2b)){
$body .="
<div>
<a href='http://morich.com/GIS/admin?hal=detmat&ord=$dt2b[ordpk]&dt=1' target='_blank'
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
</div>";//isi dari email
$cr2c=mysqli_query($koneksi,"select * from rkb
left outer join ord on ord.ordpk=rkb.ordpk
left outer join bdown on bdown.ordpk=ord.ordpk
where ord.fupk='$fu' and ord.userpk='$user' and rkb.hari2 <='$date' and rkb.status='1' and rkb.rkbsts='0' and bdown.tot >'1'
order by ord.ordno ASC");
while($dt2c=mysqli_fetch_array($cr2c)){
$result3 = mysqli_query($koneksi,"update rkb set hari2='$next' where rkbpk='$dt2c[rkbpk]'");
}
$mail->IsSMTP(); // mengirimkan sinyal ke class PHPMail untuk menggunakan SMTP
$mail->SMTPDebug  = 1;                     // mengaktifkan debug mode (untuk ujicoba) 1 = Error dan pesan 2 = Pesan saja
$mail->SMTPAuth   = true;                  // aktifkan autentikasi SMTP
$mail->SMTPSecure = "";                 // jenis kemananan
$mail->Host       = "192.168.0.2";      // masukkan GMAIL sebagai smtp server
$mail->Port       = "587";                   // masukkan port yang digunakan oleh SMTP Gmail
$mail->Username   = "notif_gis@ptmorich.com";  // GMAIL username
$mail->Password   = "gis@2022";            // GMAIL password
$mail->SetFrom('notif_gis@ptmorich.com', 'morich notification system'); // masukkan alamat pengririm dan nama pengirim jika alamat email tidak sama, maka yang digunakan alamat email untuk username
$mail->Subject    = "$total materials still in progress";//masukkan subject
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
?>