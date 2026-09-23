<?php
session_start();
include "../config/koneksi.php";
include "../config/koneksi11a.php";
include "../config/koneksi11s.php";
include "../config/koneksi11u.php";
include "../config/koneksi103a.php";
include "../config/tanggal2.php";
include "../config/ip.php";

$ip = ip();
$browser = browser();
$sistem = $_SERVER['HTTP_USER_AGENT'];
$userlog = $_SESSION['login'];
$sfu = $_SESSION['funm'];
$fu = $_SESSION['fu'];

$date = date("Y-m-d");
$next = date("Y-m-d", strtotime("+1 days", strtotime($date)));
$next2 = date("Y-m-d", strtotime("+2 days", strtotime($date)));
$next3 = date("Y-m-d", strtotime("+6 month", strtotime($date)));

$update=mysqli_query($koneksi,"update ord set stsprod='1', mif='$_POST[lokasi]', dateprod=NOW() where ordpk='$_POST[ordpk]'");

$sql=mysqli_query($koneksi,"select * from bdown where ordpk='$_POST[ordpk]' and jenis in ('detail') order by bdownpk asc");
while($dt=mysqli_fetch_array($sql)){
    $bdownpk = $dt['bdownpk'];
    $country = addslashes($dt['country']);
    $poref = $dt['poref'];
    $po = $dt['pono'];
    $dop = $dt['opno'];
    $style = $dt['style'];
    $color = TRIM($dt['color']);
    $fob = $dt['fob'];
    $ddp = $dt['ddp'];
    $secsz = $dt['secsz'];
    $gac = $dt['gac'];
    $pcd = $dt['pcd'];
    $s1 = $dt['s1'];
    $s2 = $dt['s2'];
    $s3 = $dt['s3'];
    $s4 = $dt['s4'];
    $s5 = $dt['s5'];
    $s6 = $dt['s6'];
    $s7 = $dt['s7'];
    $s8 = $dt['s8'];
    $s9 = $dt['s9'];
    $s10 = $dt['s10'];
    $s11 = $dt['s11'];
    $s12 = $dt['s12'];
    $s13 = $dt['s13'];
    $s14 = $dt['s14'];
    $s15 = $dt['s15'];
    $s16 = $dt['s16'];
    $s17 = $dt['s17'];
    $s18 = $dt['s18'];
    $s19 = $dt['s19'];
    $s20 = $dt['s20'];
    $s21 = $dt['s21'];
    $s22 = $dt['s22'];
    $s23 = $dt['s23'];
    $s24 = $dt['s24'];
    $s25 = $dt['s25'];
    $s26 = $dt['s26'];
    $s27 = $dt['s27'];
    $s28 = $dt['s28'];
    $s29 = $dt['s29'];
    $s30 = $dt['s30'];
    $s31 = $dt['s31'];
    $s32 = $dt['s32'];
    $s33 = $dt['s33'];
    $s34 = $dt['s34'];
    $s35 = $dt['s35'];
    $s36 = $dt['s36'];
    $s37 = $dt['s37'];
    $s38 = $dt['s38'];
    $s39 = $dt['s39'];
    $s40 = $dt['s40'];
    $stot = $s1 + $s2 + $s3 + $s4 + $s5 + $s6 + $s7 + $s8 + $s9 + $s10 + $s11 + $s12 + $s13 + $s14 + $s15 +
        $s16 + $s17 + $s18 + $s19 + $s20 + $s21 + $s22 + $s23 + $s24 + $s25 + $s26 + $s27 + $s28 + $s29 + $s30 +
        $s31 + $s32 + $s33 + $s34 + $s35 + $s36 + $s37 + $s38 + $s39 + $s40;
    $tot = $stot;

    $country2 = addslashes($country);
    $style2 = addslashes($style);
    $gac2 = tgl2b($gac);
    $pcd2 = tgl2b($pcd);

    //opno
    $cro = mysqli_query($koneksi, "select * from ord where ordpk='$_POST[ordpk]'");
    $dto = mysqli_fetch_array($cro);
    if ($dop <> "") {
        $OP = str_replace(' ', '', $dop);
    } else {
        $OP = $dto['ordno'];
    }

//andon11
$dtcek=mysqli_fetch_array(mysqli_query($koneksi11a,"select * from po where bdownpk='$dt[bdownpk]'"));
$query3a = mysqli_query($koneksi11a, "select userpk from user where fupk='$fu'");
$data3a = mysqli_fetch_array($query3a);
$userpk1 = $data3a['userpk'];
if($dtcek['bdownpk']>0){
$sql2 = mysqli_query($koneksi11a, "update po set
userpk='$userpk1',
mif='2',
OP='$OP',
style='$style2',
POno='$po',
qty='$tot',
material='$color',
GAC='$gac2',
customer='$country2',
secsz='$secsz',
poref='$poref',
qty1='$s1',
qty2='$s2',
qty3='$s3',
qty4='$s4',
qty5='$s5',
qty6='$s6',
qty7='$s7',
qty8='$s8',
qty9='$s9',
qty10='$s10',
qty11='$s11',
qty12='$s12',
qty13='$s13',
qty14='$s14',
qty15='$s15',
qty16='$s16',
qty17='$s17',
qty18='$s18',
qty19='$s19',
qty20='$s20',
qty21='$s21',
qty22='$s22',
qty23='$s23',
qty24='$s24',
qty25='$s25' where bdownpk='$dtcek[bdownpk]'");
} else {
$sql2 = mysqli_query($koneksi11a, "insert into po set
userpk='$userpk1',
mif='2',
bdownpk='$bdownpk',
ordpk='$_POST[ordpk]',
OP='$OP',
style='$style2',
POno='$po',
qty='$tot',
material='$color',
GAC='$gac2',
customer='$country2',
secsz='$secsz',
poref='$poref',
qty1='$s1',
qty2='$s2',
qty3='$s3',
qty4='$s4',
qty5='$s5',
qty6='$s6',
qty7='$s7',
qty8='$s8',
qty9='$s9',
qty10='$s10',
qty11='$s11',
qty12='$s12',
qty13='$s13',
qty14='$s14',
qty15='$s15',
qty16='$s16',
qty17='$s17',
qty18='$s18',
qty19='$s19',
qty20='$s20',
qty21='$s21',
qty22='$s22',
qty23='$s23',
qty24='$s24',
qty25='$s25'");  
}
//andon103
$dtcek2=mysqli_fetch_array(mysqli_query($koneksi103a,"select * from po where bdownpk='$dt[bdownpk]'"));
$query3b = mysqli_query($koneksi103a, "select userpk from user where fupk='$fu'");
$data3b = mysqli_fetch_array($query3b);
$userpk2 = $data3b['userpk'];
if($dtcek2['bdownpk']>0){
$sql2b = mysqli_query($koneksi103a, "update po set
userpk='$userpk2',
mif='1',
OP='$OP',
style='$style2',
POno='$po',
qty='$tot',
material='$color',
GAC='$gac2',
customer='$country2',
secsz='$secsz',
poref='$poref',
qty1='$s1',
qty2='$s2',
qty3='$s3',
qty4='$s4',
qty5='$s5',
qty6='$s6',
qty7='$s7',
qty8='$s8',
qty9='$s9',
qty10='$s10',
qty11='$s11',
qty12='$s12',
qty13='$s13',
qty14='$s14',
qty15='$s15',
qty16='$s16',
qty17='$s17',
qty18='$s18',
qty19='$s19',
qty20='$s20',
qty21='$s21',
qty22='$s22',
qty23='$s23',
qty24='$s24',
qty25='$s25' where bdownpk='$dtcek2[bdownpk]'");
} else {
$sql2b = mysqli_query($koneksi103a, "insert into po set
userpk='$userpk2',
mif='1',
bdownpk='$bdownpk',
ordpk='$_POST[ordpk]',
OP='$OP',
style='$style2',
POno='$po',
qty='$tot',
material='$color',
GAC='$gac2',
customer='$country2',
secsz='$secsz',
poref='$poref',
qty1='$s1',
qty2='$s2',
qty3='$s3',
qty4='$s4',
qty5='$s5',
qty6='$s6',
qty7='$s7',
qty8='$s8',
qty9='$s9',
qty10='$s10',
qty11='$s11',
qty12='$s12',
qty13='$s13',
qty14='$s14',
qty15='$s15',
qty16='$s16',
qty17='$s17',
qty18='$s18',
qty19='$s19',
qty20='$s20',
qty21='$s21',
qty22='$s22',
qty23='$s23',
qty24='$s24',
qty25='$s25'");  
}
}

$sqls=mysqli_query($koneksi,"select * from bdown where ordpk='$_POST[ordpk]' and jenis in ('header') order by bdownpk asc limit 1");
$dts=mysqli_fetch_array($sqls);
$s1 = $dts['s1'];
$s2 = $dts['s2'];
$s3 = $dts['s3'];
$s4 = $dts['s4'];
$s5 = $dts['s5'];
$s6 = $dts['s6'];
$s7 = $dts['s7'];
$s8 = $dts['s8'];
$s9 = $dts['s9'];
$s10 = $dts['s10'];
$s11 = $dts['s11'];
$s12 = $dts['s12'];
$s13 = $dts['s13'];
$s14 = $dts['s14'];
$s15 = $dts['s15'];
$s16 = $dts['s16'];
$s17 = $dts['s17'];
$s18 = $dts['s18'];
$s19 = $dts['s19'];
$s20 = $dts['s20'];
$s21 = $dts['s21'];
$s22 = $dts['s22'];
$s23 = $dts['s23'];
$s24 = $dts['s24'];
$s25 = $dts['s25'];
//sizeandon11
$sql2 = mysqli_query($koneksi11a, "update po set
size1='$s1',
size2='$s2',
size3='$s3',
size4='$s4',
size5='$s5',
size6='$s6',
size7='$s7',
size8='$s8',
size9='$s9',
size10='$s10',
size11='$s11',
size12='$s12',
size13='$s13',
size14='$s14',
size15='$s15',
size16='$s16',
size17='$s17',
size18='$s18',
size19='$s19',
size20='$s20',
size21='$s21',
size22='$s22',
size23='$s23',
size24='$s24',
size25='$s25' where ordpk='$_POST[ordpk]'");
//sizeandon103
$sql2b = mysqli_query($koneksi103a, "update po set
size1='$s1',
size2='$s2',
size3='$s3',
size4='$s4',
size5='$s5',
size6='$s6',
size7='$s7',
size8='$s8',
size9='$s9',
size10='$s10',
size11='$s11',
size12='$s12',
size13='$s13',
size14='$s14',
size15='$s15',
size16='$s16',
size17='$s17',
size18='$s18',
size19='$s19',
size20='$s20',
size21='$s21',
size22='$s22',
size23='$s23',
size24='$s24',
size25='$s25' where ordpk='$_POST[ordpk]'");
echo "<div class='text-infohijau' style='width:315px;'>Order sudah diteruskan ke produksi. &nbsp; &#10004; </div>";
?>