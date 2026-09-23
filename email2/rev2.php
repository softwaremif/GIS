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
//$date="2022-10-18";
$next=date("Y-m-d", strtotime("+1 days", strtotime($date)));
$user=$_SESSION['login'];

/*revised PO*/
$cr2c=mysqli_query($koneksi,"select * from memo
left outer join rkb on rkb.rkbpk=memo.rkbpk
left outer join ord on ord.ordpk=rkb.ordpk
left outer join po on po.popk=rkb.popk
where memo.cek='1' and memo.user='$user' and memo.tgl1='$date' and memo.email='0' and memo.po='1'
group by po.popk, ord.fupk order by ord.fupk asc");
while($dt2c=mysqli_fetch_array($cr2c)){
$popk=$dt2c['popk'];
$pono=$dt2c['pono'];
$memo=$dt2c['memonm'];
$fu=$dt2c['fupk'];
$cr=mysqli_query($koneksi,"select * from user where fupk='$fu'");
$dt=mysqli_fetch_array($cr);
if($dt['login']=="hani"){
$login = "lina";
$to = "lina@ptmorich.com";
} else {
$login = $dt['login'];
$to = $dt['username'];  
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
where rkb.popk='$popk'
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
morich notification system
</div> <br><br>";
$cr2b=mysqli_query($koneksi,"select * from rkb
left outer join ord on ord.ordpk=rkb.ordpk
left outer join po on po.popk=rkb.popk
where rkb.popk='$popk'
group by ord.ordpk order by ord.ordno asc");
while($dt2b=mysqli_fetch_array($cr2b)){
$body .="
<div>
<a href='http://morich.com/GIS/admin.php?hal=detmat&ord=$dt2b[ordpk]&dt=3' target='_blank'
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
$mail->SetFrom('notif_gis@ptmorich.com', 'morich notification system'); // masukkan alamat pengririm dan nama pengirim jika alamat email tidak sama, maka yang digunakan alamat email untuk username
$mail->Subject    = "PO $pono has been revision";//masukkan subject
$mail->MsgHTML($body);//masukkan isi dari email

$address1 = $to;
$mail->AddAddress($address1, $login);
/*$address1 = "erwin@ptmorich.com";
$mail->AddAddress($address1, "erwin");*/

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo; // jika pesan tidak terkirim
} else {
//jika pesan terkirim
}
$result3 = mysqli_query($koneksi,"update memo set email='1' where cek='1' and user='$user' and tgl1='$date' and email='0' and po='1'");
}